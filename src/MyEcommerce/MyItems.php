<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
session_start();
isLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
    <title>MyElectronics - MyItems</title>
    <?php
    require_once("/xampp/htdocs/MyEcommerce/Styles/BasketStyles.php");
    ?>
</head>
<body>
<?php include "NavigationBar.php"; ?>
<div class="basket">
        <h1 id="title">Your saved Items</h1>
        <hr>

        <?php
            $myItems = array();
            if (isset($_SESSION["userItems"])) {
                $myItems = $_SESSION["userItems"];
            }
            foreach($myItems as $id=>$details) {
                $product = $details[0];
                ?>
                <div class="item" id="item<?=$id?>">
                    <div id="remove">
                        <button id="removeButton" onclick='removeFromMyItems(<?=$id?>)'><i class="fas fa-trash-alt"></i></button>
                    </div>

                    <div class="image" id="image<?=$id?>">
                        <?php
							echo '<img src="data:image/png;base64,'.base64_encode($product->getProductImage()).'" alt="'.$product->getProductName().'" style="width:40%">';
						?>
                    </div>

                    <div class="description" id="description<?=$id?>">
                        <span><?=$product->getProductDes()?></span> 
                    </div>

                    <div id="itemPrice">
                        <input type="hidden" id="price<?=$id?>" value="">
                        <span>Price: £<?=$product->getProductPrice()?></span>
                    </div>

                    <div class="moveBtn">
                        <button id="moveButton" onclick="addToBasket(<?=$product->getProductID()?>)"><i class="fas fa-shopping-basket">   Move to Basket</i></button>
                    </div>
                </div>
                <?php
            }
        ?>
        
        
    </div>
    <script>
		//Returns the href (URL) of the current page and refresh the page, 
		//also send the product to the server (e.g. addToBasketProcess) to add it to the basket
        function addToBasket(id) {
            window.location.href = "Processors/addToBasketProcess.php?Product="+id;
        }
		
		//Returns the href (URL) of the current page and refresh the page and sends the product to the server 
		//to remove it from the the my items section
		function removeFromMyItems(id) {
			window.location.href = "Processors/removeFromMyItems.php?Product="+id;
		}
    </script>
</body>
    
