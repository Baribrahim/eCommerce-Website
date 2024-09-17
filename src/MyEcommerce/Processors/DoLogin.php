<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
session_start();

//Using Regular Expressions to find a pattern in the data
$isUppercase = preg_match('@[A-Z]@', $_POST["password"]);
$isLowercase = preg_match('@[a-z]@', $_POST["password"]);
$atLeastOneNumber = preg_match('@[0-9]@', $_POST["password"]);

$errors = array();
$vals = array();

//Checks if the user inputted something into the email input in the login page using the attribute name of the input tag
//if no then add an error
//if yes then add it to the vals array
foreach (["email"] as $val) {
	if (!isset($_POST[$val]) || strlen($_POST[$val]) == 0) {
		$errors[] = $val;
	}
	$vals[$val] = $_POST[$val];
}

//Validate the pattern of the email 
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || !isset($_POST["email"])) {
	$errors[] = "email";
}

//Validate the password
if (!isset($_POST["password"]) || !$isUppercase || !$isLowercase || !$atLeastOneNumber || strlen($_POST["password"]) < 8) {
	$errors[] = "password";
}


if (sizeof($errors) == 0) {
	//if there are no errors make a link with the database
	$mysqli = new mysqli("localhost", "root", "", "e-commerce");
	$stmt = $mysqli->prepare("SELECT * FROM eUsers WHERE Email=?"); //retrieve the details of a user based on their email
	//using prepared statements to prevent SQL Injections
	$stmt->bind_param("s", $_POST["email"]);
	$stmt->execute();
	$res = $stmt->get_result();
	$stmt->close();
	//check if any results were found
	if ($res->num_rows == 1) {
		$row = $res->fetch_assoc();
		//Compare the inputted password to the password in the database
		if (password_verify($_POST["password"], $row["Password"])) {
			$myUser = new User($row["UserID"], $row["UserType"], $row["FirstName"], $row["LastName"], $row["Email"]);
			$_SESSION["myUser"] = $myUser;
			header("Location: /MyEcommerce/Welcome.php");
			exit;
		} else {
			$errors[] = "password";
			$_SESSION["allerrors"] = $errors;
			header("Location: /MyEcommerce/index.php?error=Failed Validation&" . $p);
			exit;
		}
	} else {
		$errors[] = "email";
		$errors[] = "password";
		$_SESSION["allerrors"] = $errors;
		header("Location: /MyEcommerce/index.php");
		exit;
	}
} else {
	$_SESSION["allerrors"] = $errors;
	$p = http_build_query($vals);
	header("Location: /MyEcommerce/index.php?error=Failed Validation&" . $p);
	exit;
}
