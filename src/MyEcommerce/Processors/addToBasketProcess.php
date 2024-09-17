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
    } //Checks if a basket exists in the session and if yes it adds it to the array
	
	if ($product->getProductStock() > 0) {
		$basket->addToBasket($product); //a function defined in produc object class 
		$_SESSION["userBasket"] = $basket;
	} //if there is enough stock then add the product to the basket
	
	if (isset($_REQUEST["flag"])) {
		echo $basket->printBasket();
	} //checks if the flag defined in basket.php is set to true and 
	  //if yes print the basket and change any content e.g. quantity
	else if ($product->getProductStock() > 0) {
		header("Location: /MyEcommerce/Welcome.php");
	} else {
		header("Location: /MyEcommerce/Welcome.php?StockError=Item Out of Stock");
	}
	
?>