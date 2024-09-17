<?php

require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
session_start();

//Retrieving the data of all the inputs from the register page
$fname = $_POST["Fname"];
$lname = $_POST["Lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$passwordCon = $_POST["passwordCon"];
$pNum = $_POST["pNum"];
$country = $_POST["country"];
$city = $_POST["city"];
$address = $_POST["address"];
$postcode = $_POST["postcode"];

//Regular Expressions
$isUppercase = preg_match('@[A-Z]@', $password);
$isLowercase = preg_match('@[a-z]@', $password);
$atLeastOneNumber = preg_match('@[0-9]@', $password);

$pNumPattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

$errors = array();
$vals = array();

//A check to see if the user has inputted something or left it blank
foreach (["Fname", "Lname", "email", "password", "passwordCon", "pNum", "country", "city", "address", "postcode"] as $val) {
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


if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || !isset($_POST["email"])) {
    $errors[] = "email";
}

if (!isset($password) || !$isUppercase || !$isLowercase || !$atLeastOneNumber || strlen($password) < 8) {
    $errors[] = "password";
}

if ($password != $passwordCon) {
    $errors[] = "passwordCon";
}

//Hashing the password using a built-in function
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if (!preg_match($pNumPattern, $_POST["pNum"])) {
    $errors[] = "pNum";
}

if (!preg_match("/^[a-zA-z]*$/", $_POST["country"])) {
    $errors[] = "country";
}

if (!preg_match("/^[a-zA-z]*$/", $_POST["city"])) {
    $errors[] = "city";
}

if (!preg_match('/[A-Za-z0-9\-\\,.]+/', $_POST["address"])) {
    $errors[] = "address";
}


if (sizeof($errors) == 0) {
	//if there are no errors make a link with the database
    $mysqli = new mysqli("localhost", "root", "", "e-commerce");
	//retrieve the details of the user based on their email
	$stmt = $mysqli->prepare("SELECT * FROM `eusers` WHERE Email=?");
	//using prepared statements to prevent SQL Injections
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$res = $stmt->get_result();
	$stmt->close();
	if ($res->num_rows > 0) {
		$row = $res->fetch_assoc();
		//Check to see if the email used to register already exists in the database
		$errors[] = "email";
		$_SESSION["allerrors"] = $errors;
		$p = http_build_query($vals);
		header("Location: /MyEcommerce/Register.php?error=Failed Validation&" . $p);
		exit;
	} else {
		//Adding the user's details to the database
		$regQuery = "INSERT INTO `eusers` (`UserType`, `FirstName`, `LastName`, `Email`, `Password`, `phoneNumber`, `Country`, `City`, `Address`, `Postcode`, `loginDate`) VALUES ('1', ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())";
		$stmt1 = $mysqli->prepare($regQuery);
		$stmt1->bind_param("ssssissss", $fname, $lname, $email, $hashedPassword, $pNum, $country, $city, $address, $postcode);
		$stmt1->execute();
		$stmt1->close();
		header("Location: /MyEcommerce/Welcome.php");
		exit;
	}
} else {
    $_SESSION["allerrors"] = $errors;
    $p = http_build_query($vals);
    header("Location: /MyEcommerce/Register.php?error=Failed Validation&" . $p);
    exit;
}
