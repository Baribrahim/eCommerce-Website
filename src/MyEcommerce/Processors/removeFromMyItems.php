<?php
	require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
    require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
    require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
    session_start();
	
	if (!isset($_REQUEST["Product"])) {
        header("Location: /MyEcommerce/Welcome.php");
        exit;
    }
	
	//This following code works in a similar way to the remove from basket process
    $productId = $_REQUEST["Product"];
    $myItems = array();
    if (isset($_SESSION["userItems"])) {
        $myItems = $_SESSION["userItems"];
    }
	
	//If a product exists then detete it from my items and update the session
	if (array_key_exists($productId, $myItems)) {
		unset($myItems[$productId]);
		$_SESSION["userItems"] = $myItems;
		header("Location: /MyEcommerce/MyItems.php");
    } else {
		header("Location: /MyEcommerce/MyItems.php?error=Item not found");
	}
?>