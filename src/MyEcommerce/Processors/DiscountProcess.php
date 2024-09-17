<?php
	require_once("/xampp/htdocs/MyEcommerce/Classes/BasketObject.php");
	session_start();

	$errors = array();
	
	$mysqli = new mysqli("localhost", "root", "", "e-commerce");
	$stmt = $mysqli->prepare("SELECT * FROM `ediscounts` WHERE `StartDate` <= CURDATE() AND `EndDate`>= CURDATE() AND `DiscountCode` = ?");
	$stmt->bind_param("s", $_POST["discountCode"]);
	$stmt->execute();
	$res = $stmt->get_result();
	$stmt->close();
	//The above code retrieve any discount code that is valid from the discounts table in the DB 
	//By checking its start date and end date and comparing it to the current date
	
	if ($res->num_rows == 1) { 
		$row = $res->fetch_assoc(); //An array that stores the results from the discount table
		$discountAmount = $row["DiscountAmount"]; 
		$basket = new Basket(array());
		if (isset($_SESSION["userBasket"])) {
			$basket = $_SESSION["userBasket"];
		}
		$basket->addDiscountCode($_POST["discountCode"], $discountAmount); 
		//the above addDiscountCode function comes from the basket class 
		//It sets the values of the private attributes discountCode and discountPercentage in the basket class
		
		$_SESSION["userBasket"] = $basket;
		header("Location: /MyEcommerce/Basket.php");
	} else {
		$errors[] = "No discount available"; 
		$_SESSION["discountErrors"] = $errors;
		header("Location: /MyEcommerce/Basket.php?DiscountError=No Discount Available");
	}
?>