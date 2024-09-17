<?php
	require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
    require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
	require_once("/xampp/htdocs/MyEcommerce/Classes/BasketObject.php");
    require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
    session_start();
	
	if (!isset($_REQUEST["Product"])) {
        header("Location: /MyEcommerce/Welcome.php");
        exit;
    }

    $productId = $_REQUEST["Product"]; //Requests the product id from the function defined in welcome.php
    $product = Product::loadProductById($productId); //Load all the product's details from the product object
    $basket = new Basket(array());
    if (isset($_SESSION["userBasket"])) {
        $basket = $_SESSION["userBasket"];
    }
	
	if (isset($_REQUEST["flag"])) { //Checks if flag exists and is set to true in the basket.php file
		//Retrieve the quantity from the basket.php file
		$quantity = $_REQUEST["quantity"];
		//Use the updateQuantity function defined in the basket object to change the quantity of the product
		$basket->updateQuantity($product, $quantity);
		echo $basket->printBasket();
	} else {
		//If the product was removed, update the session
		if ($basket->removeFromBasket($product)) {
			$_SESSION["userBasket"] = $basket;
			header("Location: /MyEcommerce/Basket.php");
		} else {
			header("Location: /MyEcommerce/Basket.php?error=Item not found");
		}
	}
?>