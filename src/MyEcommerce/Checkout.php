<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/BasketObject.php");
session_start();
isLoggedIn();
?>
<html>
<head>
</head>
	<link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
	<?php
    $myErrors = array();
    if (isset($_SESSION["allerrors"])) {
        $myErrors = $_SESSION["allerrors"];
        unset($_SESSION["allerrors"]);
    }
    ?>
	<title>MyElectronics - Checkout</title>
	<?php
		require_once("/xampp/htdocs/MyEcommerce/Styles/CheckoutStyles.php");
	?>
<body>
	<?php include "NavigationBar.php"; ?>
	<div class="Checkout">
		<form id="checkoutForm" action="/MyEcommerce/Processors/DoCheckout.php" method="post">
			<div id="shippingDetails">
				<h1>Shipping Details</h1>
				<div id="inputs1">
					<p id="Label">First Name</p>
					<p><input class="textInput" type="text" name="Fname" /></p>
					<?php
						if (in_array("Fname", $myErrors)) {
							echo "<p class='errorMessage'>First name is not valid</p>";
						}
					?>
					<p id="Label">Last Name</p>
					<p><input class="textInput" type="text" name="Lname" /></p>
					<?php
						if (in_array("Lname", $myErrors)) {
							echo "<p class='errorMessage'>Last Name is not valid</p>";
						}
					?>
					
					<p id="Label">Phone Number</p>
					<p><input class="textInput" type="text" name="pNum" /></p>
					<?php
						if (in_array("pNum", $myErrors)) {
							echo "<p class='errorMessage'>Phone Number is not valid</p>";
						}
					?>
				</div id="inputs2">
					<p id="Label">Country</p>
					<p><input class="textInput" type="text" name="country" /></p>
					<?php
						if (in_array("country", $myErrors)) {
							echo "<p class='errorMessage'>Country is not valid</p>";
						}
					?>
					
					<p id="Label">Address</p>
					<p><input class="textInput" type="text" name="address" placeholder="E.g. Door Num + Street Name" /></p>
					<?php
						if (in_array("address", $myErrors)) {
							echo "<p class='errorMessage'>Address is not valid</p>";
						}
					?>
					
					<p id="Label">Postcode</p>
					<p><input class="textInput" type="text" name="postcode" /></p>
					<?php
						if (in_array("postcode", $myErrors)) {
							echo "<p class='errorMessage'>Postcode is invalid</p>";
						}
					?>
				<div>
				</div>
			</div>
			<div id ="cardDetails">
				<h1>Card Details</h1>
				<div id="cardNum">
					<p id="Label">Card Number</p>
					<p><input class="textInput" type="text" name="cardNum" /></p>
					<?php
						if (in_array("cardNum", $myErrors)) {
							echo "<p class='errorMessage'>Card Number is not valid</p>";
						}
					?>
				</div>
				<input class="textInput" type="text" name="exp" placeholder="Expiry Date" style="width:40%; float:left"/>
				<input class="textInput" type="text" name="cvv" placeholder="CVV" style="width:30%; float:right"/>
				<?php
						if (in_array("exp", $myErrors)) {
							echo "<p class='errorMessage'>Expiry Date is not valid</p>";
						} 
						
						if (in_array("cvv", $myErrors)) {
							echo "<p class='errorMessage'>CVV is not valid</p>";
						}
				?>
				<input type="checkbox" id="saveCard" name="saveCard">
				<label for="saveCard">Save Card for Future Purchases</label><br>
				<input type="submit" class="applyBtn" value="Save"></input>
			</div>
		</form>
	</div>
</body>
</html>