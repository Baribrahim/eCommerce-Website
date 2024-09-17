<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
session_start();

if (!isset($_REQUEST["Product"])) {
    header("Location: /MyEcommerce/Welcome.php");
    exit;
}

$productId = $_REQUEST["Product"]; //Request the product id from the $.post function defined in welcome.php
$product = Product::loadProductById($productId); //Load all the product's details from the product object
$myItems = array();
if (isset($_SESSION["userItems"])) {
    $myItems = $_SESSION["userItems"];
} //Check if a my items section exists in the session and if yes it adds it to the array

if (array_key_exists($productId, $myItems)) { //check if a specific product id exists in my items array
    echo "Item already exists";
} else {
    $myItems[$productId] = [$product]; //add the product id to the array
}

$_SESSION["userItems"] = $myItems; //store the array myItems in the session
header("Location: /MyEcommerce/Welcome.php");
?>