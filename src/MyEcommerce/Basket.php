<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/BasketObject.php");
session_start();
isLoggedIn();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
	<?php
    $myErrors = array();
	//A check to see if there are any errors from the discount code input
    if (isset($_SESSION["discountErrors"])) {
        $myErrors = $_SESSION["discountErrors"];
        unset($_SESSION["discountErrors"]);
    }
    ?>
    <title>MyElectronics - Basket</title>
	<script src="/MyEcommerce/jquery-3.6.0.min.js"></script>
    <?php
    require_once("/xampp/htdocs/MyEcommerce/Styles/BasketStyles.php");
    ?>
	<script>
		//This function updates the total price in the basket based on the quantity input with the id amount
		function updateTotal(id) {
			var a = document.getElementById("amount" + id);
			var url = "addToBasketProcess.php";
			if (a.value < a.getAttribute('data-lastVal')) {
				url = "removeFromBasket.php";
			}
			
			//Sending product data to the server (e.g. addToBasketProcess)
			$.post("/MyEcommerce/Processors/"+url, 
					{ Product: id, flag: true, quantity: a.value}, 
					function( html ) {
						$("#basketPage").html(html);
					}
			);
        }
		
		//Returns the href (URL) of the current page and refresh the page to remove a product from the the basket 
		function removeFromBasket(id) {
			window.location.href = "Processors/removeFromBasket.php?Product="+id;
		}
    </script>
</head>
<body>
	<?php include "NavigationBar.php"; ?>
	<div id="basketPage">
	<?php 
		$basket = new Basket(array(), array());
		if (isset($_SESSION["userBasket"])) {
			$basket = $_SESSION["userBasket"];
		}
		//uses the function from the basket object to print the basket
		echo $basket->printBasket();

		if (in_array("No discount available", $myErrors)) {
			echo "<p class='errorMessage'>Discount unavailable</p>";
		}
	?>
    </div>
</body>
</html>


