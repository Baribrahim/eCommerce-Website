<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
session_start();
isLoggedIn();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
    <title>MyElectronics - Basket</title>
    <?php
    require_once("/xampp/htdocs/MyEcommerce/Styles/BasketStyles.php");
    ?>
</head>
<body>
	<?php include "NavigationBar.php"; ?>
    <div class="basket">
        <h1 id="title">Items in your Basket</h1>
		<?php 
			if(isset($_REQUEST["error"])) {
				echo "<p>Unable to delete Item</p>";
			}
		?>
        <hr>

	<?php
		$basket = array();
		if (isset($_SESSION["userBasket"])) {
			$basket = $_SESSION["userBasket"];
		}
		foreach($basket as $id=>$details) {
			$product = $details[0];
	?>
			<div class="item" id="item<?=$id?>">
				<div id="remove">
					<button id="removeButton" onclick='removeFromBasket(<?=$id?>)'><i class="fas fa-trash-alt"></i></button>
				</div>

				<div class="image" id="image<?=$id?>">
					<?php
						echo '<img src="data:image/png;base64,'.base64_encode($product->getProductImage()).'" alt="'.$product->getProductName().'" style="width:50%">';
					?>
				</div>

				<div class="description" id="description<?=$id?>">
					<span><?=$product->getProductDes()?></span>
				</div>

				<div class="quantity" id="quantity<?=$id?>">
					<label for="_quantity">Quantity</label>
					<input onclick="updateTotal(<?=$id?>)" id="amount<?=$id?>" type="number" min="1" value="<?=$details[1]?>" style="width:50%">
				</div>

				<div id="itemPrice">
					<input type="hidden" id="price<?=$id?>" value="<?=$product->getProductPrice()?>">
					<span>Price: £<?=$product->getProductPrice()?></span>
				</div>

				<div class="total "id="total<?=$id?>">
					<label for="_total">Total:</label>
					<span>£<?=$product->getProductPrice() * $details[1]?></span>
				</div>
			</div>
			<?php
		}
	?>
	<?php
		$total = 0;
		$vat = 0;
		$totalAmount = 0;
		foreach($basket as $id=>$details) {
			$product = $details[0];
			$total = $total + $product->getProductPrice() * $details[1];
		}
		$vat = $total * 0.2;
		$totalAmount = $total + $vat;
	?>
    </div>
	<form action="Processors/DiscountProcess.php" method="post">
		<div class="totalPrice">
			<h1 id="title">Total</h1>
			<span class="costs" >Sub-Total:<span style="margin-left:180px;"> <?php echo "£" . number_format($total, 2); ?></span></span>
			<span class="costs">VAT (20%):<span style="margin-left:190px;"> <?php echo "£" . number_format($vat, 2); ?></span></span>
			<hr class="line">
			<span class="costs">Total Amount:<span style="margin-left:150px;" name="totalAmount"> <?php echo "£" . number_format($totalAmount, 2); ?></span></span>
			<span class="costs">Discount Code: <input class="textInput" type="text" name="discountCode" /><span style="margin-left:90px;"><input type="submit" class="applyBtn" value="Apply"></input></span></span>
			<button class="checkout">Check Out</button>
		</div>
	</form>
    

    <script>
        function updateTotal(id) {
            var a = document.getElementById("amount" + id).value;
            var b = document.getElementById("price" + id).value;
            var c = a * b;
            document.getElementById("total" + id).innerHTML = "Total: " + "£" + c;
        }
		
		function removeFromBasket(id) {
			window.location.href = "Processors/removeFromBasket.php?Product="+id;
		}
		
    </script>
</body>
</html>


<!--INSERT INTO `eproducts` (`ProductID`, `ProductName`, `ProductSKU`, `ProductPrice`, `ProductImage`, `ProductDescription`, `ProductStock`) VALUES (NULL, ?, ?, ?, ?, '?', '?');-->
