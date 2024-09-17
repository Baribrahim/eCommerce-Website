<?php

require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/BasketObject.php");
session_start();

//Retrieving the data inputted by the user in the checkout page
$fname = $_POST["Fname"];
$lname = $_POST["Lname"];
$pNum = $_POST["pNum"];
$country = $_POST["country"];
$address = $_POST["address"];
$postcode = $_POST["postcode"];
$cardNum = $_POST["cardNum"];
$cvv = $_POST["cvv"];
$saveCard = null;
if (isset($_POST["saveCard"])) {
	$saveCard = $_POST["saveCard"];
} else {
	$saveCard = null;
}


$exp = $_POST["exp"];
//Make the expiration date in the format month/year
$cardDate = DateTime::createFromFormat('m/y', $exp);
$currentDate = new DateTime('now');

//A variable that stores the difference between the current date and the card date
$interval = $currentDate->diff($cardDate);

$pNumPattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

$messages = array();
$errors = array();
$vals = array();

foreach (["Fname", "Lname", "pNum", "country", "address", "postcode", "cardNum", "exp", "cvv"] as $val) {
	//A check to see if the user has inputted something into the fields or left it blank
    if (!isset($_POST[$val]) || strlen($_POST[$val]) == 0) {
        $errors[] = $val;
    }
    $vals[$val] = $_POST[$val];
}

//Validating all the inputs
if (!preg_match("/^[a-zA-z]*$/", $fname)) {
    $errors[] = "Fname";
}

if (!preg_match("/^[a-zA-z]*$/", $lname)) {
    $errors[] = "Lname";
}

if (!preg_match($pNumPattern, $_POST["pNum"])) {
    $errors[] = "pNum";
}

if (!preg_match("/^[a-zA-z]*$/", $_POST["country"])) {
    $errors[] = "country";
}

if (!preg_match('/[A-Za-z0-9\-\\,.]+/', $_POST["address"])) {
    $errors[] = "address";
}

//Validating bank card number
function validatecard($number)
 {
    global $type;

    $cardtype = array(
        "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard" => "/^5[1-5][0-9]{14}$/",
        "amex"       => "/^3[47][0-9]{13}$/",
        "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
    );

    if (preg_match($cardtype['visa'],$number))
    {
		$type= "visa";
        return "visa";
	
    }
    else if (preg_match($cardtype['mastercard'],$number))
    {
		$type= "mastercard";
        return "mastercard";
    }
    else if (preg_match($cardtype['amex'],$number))
    {
		$type= "amex";
        return "amex";
	
    }
    else if (preg_match($cardtype['discover'],$number))
    {
		$type= "discover";
        return "discover";
    }
    else
    {
        return false;
    } 
 }
 
 if (validatecard($cardNum) == false) {
	$errors[] = "cardNum";
 }
 
 //Check to see if the interval is a negative value
 // 1 means negative, 0 means otherwise
 if ($interval->invert == 1) {
	$errors[] = "exp";
}

if (!preg_match('/^[0-9]{3,4}$/', $_POST["cvv"])) {
    $errors[] = "cvv";
}

//Retrieving the user id from the session using the getter from the user object
$userID = $_SESSION["myUser"]->getUserId();

if (sizeof($errors) == 0) {
	$basket = new Basket(array());
	if (isset($_SESSION["userBasket"])) {
		$basket = $_SESSION["userBasket"];
	}
	$price = $basket->getSubTotal();
	$mysqli = new mysqli("localhost", "root", "", "e-commerce");
	//Accessing card details in the payment methods table to check if it already exists
	if (isset($saveCard)) {
		$stmt = $mysqli->prepare("SELECT * FROM `epayment_methods` WHERE CardNumber=?");
		$stmt->bind_param("i", $cardNum);
		$stmt->execute();
		$res = $stmt->get_result();
		$stmt->close();
		if ($res->num_rows == 1) {
			$row = $res->fetch_assoc();
            $messages[] = "card is already saved";
		} else {
			//Saving the card into the database using SQL
			$regQuery = "INSERT INTO `epayment_methods` (`CustomerID`, `CardNumber`, `Exp_Date`, `CVV`) VALUES (?, ?, ?, ?)";
			$stmt2 = $mysqli->prepare($regQuery);
			$stmt2->bind_param("iisi", $userID, $cardNum, $exp, $cvv);
			$stmt2->execute();
			$stmt2->close();
            $messages[] = "card has been saved";
		}
	}
	if (!isset($saveCard)){
		$orderQuery = "INSERT INTO `eorders` (`UserID`, `PaymentID`, `totalPrice`) VALUES (?, ?, ?)";
		$stmt1 = $mysqli->prepare($orderQuery);
		$stmt1->bind_param("iii", $userID, $cardNum, $price);
		$stmt1->execute();
		$stmt1->close();
	}
	//Adding the order to the orders table
	$orderQuery = "INSERT INTO `eorders` (`UserID`, `PaymentID`, `totalPrice`) VALUES (?, ?, ?)";
	$stmt1 = $mysqli->prepare($orderQuery);
	$stmt1->bind_param("iii", $userID, $row["CardID"], $price);
	$stmt1->execute();
	$stmt1->close();
	$messages[] = "Order has been submitted";
	$_SESSION["allmessages"] = $messages;
	header("Location: /MyEcommerce/Welcome.php");
	exit;
} else {
    $_SESSION["allerrors"] = $errors;
    $p = http_build_query($vals);
    header("Location: /MyEcommerce/Checkout.php?error=Failed Validation&" . $p);
    exit;
}
?>