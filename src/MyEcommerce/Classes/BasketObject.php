<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");


class Basket {
	
	//Basket Object Attributes
    private $products;
    private $discountCode;
	private $discountPercentage;
	private $discountAmount;
	
	//A constructor used to create a new instance of a basket object
    public function __construct($ps) {
        $this->products = $ps;
        $this->discountCode = null;
		$this->discountPercentage = 0;
		$this->discountAmount = 0;
    }
	
	//This fucntion gets the product id from the product class 
	//Then checks if that product id exists in the products array in this class 
	//if yes it increases it quantity in the basket by one, if not then add it to the basket
	function addToBasket($product) {
		$productId = $product->getProductID();
		if (array_key_exists($productId, $this->products)) {
			$this->products[$productId] = [$product, $this->products[$productId][1] + 1];
		} else {
			$this->products[$productId] = [$product, 1];
		}
	} 
	
	//This works similar to add to basket, the only difference is that it unsets that product id from the products array
	//which means deleting that item from the basket
	function removeFromBasket($product) {
		$productId = $product->getProductID();
		if (array_key_exists($productId, $this->products)) {
			unset($this->products[$productId]);
			return true;
		} else {
			return false;
		}
	}
	
	//Update quantity function is called in the removeFromBasket.php file
	//To allow the user to decrease the quantity of an item 
	function updateQuantity($product, $quantity) {
		if ($quantity == 0) {
			$this->removeFromBasket($product);
		} else {
			$productId = $product->getProductID();
			$this->products[$productId] = [$product, $quantity];
		}
	}
	
	//This is a setter function that updates the values of the private attributes discountCode and discountPercentage 
	//This function is used in the discountProcess.php file
	function addDiscountCode($code, $percentage) {
		$this->discountCode = $code;
		$this->discountPercentage = $percentage;
	} 
	
	function getTotal() {
		$total = 0;
		$vat = 0;
		$totalAmount = 0;
		foreach($this->products  as $id=>$details) {
			$product = $details[0];
			$total = $total + $product->getProductPrice() * $details[1];
		}
		$vat = $total * 0.2;
		return [$total, $vat];
	}

	//Calculates the discount amount using percentage, total price and VAT
	function getDiscountAmount() {
		return $this->discountPercentage * ($this->getTotal()[0] + $this->getTotal()[1]);
	}

	//Calculates the sub total of an order
	function getSubTotal() {
		$sub_total = ($this->getTotal()[0] + $this->getTotal()[1]);	
		if ($this->discountCode != null) {
			$sub_total = $sub_total - $this->getDiscountAmount();
		}
		return $sub_total;
	}
	
	//The print Basket function uses the HTML code that was hard-coded in the basket page
	//The function prints the basket every time its called
	function printBasket() {
		//the values in the products array has been updated in the addToBasketProcess.php 
		//Therefore, now we set it to a variable so we can use it inside the print basket function and update the basket
        $basket = $this->products; 
		$html = '<div class="basket">
        <h1 id="title">Items in your Basket</h1>';
		
		if(isset($_REQUEST["error"])) {
			$html .= '<p>Unable to delete this Item</p>';
		}
		
        $html .= '<hr>';
		
		//Using hardcoded HTML code to print each product with the below details such as image, description etc.
		foreach($basket as $id=>$details) {
			$product = $details[0];
			$html .= '<div class="item" id="item'.$id.'">
				<div id="remove">
					<button id="removeButton" onclick="removeFromBasket('.$id.')"><i class="fas fa-trash-alt"></i></button>
				</div>

				<div class="image" id="image'.$id.'">
					<img src="data:image/png;base64,'.base64_encode($product->getProductImage()).'" alt="'.$product->getProductName().'" style="width:50%">
					
				</div>

				<div class="description" id="description'.$id.'">
					<span>'.$product->getProductDes().'</span>
				</div>

				<div class="quantity" id="quantity'.$id.'">
					<label for="_quantity">Quantity</label>
					<input data-lastVal="'.$details[1].'" onclick="updateTotal('.$id.')" id="amount'.$id.'" type="number" min="0" value="'.$details[1].'" style="width:50%">
				</div>

				<div id="itemPrice">
					<input type="hidden" id="price'.$id.'" value="'.$product->getProductPrice().'">
					<span>Price: £'.$product->getProductPrice().'</span>
				</div>

				<div class="totall" id="total'.$id.'">
					<label for="_total">Total:</label>
					<span>£'.$product->getProductPrice() * $details[1].'</span>
				</div>
			</div>';
		}

		$totals = $this->getTotal();
		$total = $totals[0];
		$vat = $totals[1];
		$html .= '</div>
			<form action="Processors/DiscountProcess.php" method="post">
			<div class="totalPrice">
			<h1 id="title">Total</h1>
			<span class="costs" >Sub-Total (ex VAT):<span style="margin-left:130px;"> '."£" . number_format($total, 2).'</span></span>
			<span class="costs">VAT (20%):<span style="margin-left:190px;"> '."£" . number_format($vat, 2).'</span></span>';
		if ($this->discountCode != null) { //if there is a valid discount code then apply it and output the discount amount
			$html .= '<span class="costs">Discount Amount:<span style="margin-left:150px;"> '."£" . number_format($this->getDiscountAmount(), 2).'</span></span>
			<hr class="line"><span class="costs">Total:<span style="margin-left:150px;" name="totalAmount"> '."£" . number_format($this->getSubTotal(), 2) .'</span></span>';
		} else { //otherwise, just output the sub-total
			$html.=	'<hr class="line"><span class="costs">Total:<span style="margin-left:150px;" name="totalAmount"> '."£" . number_format($this->getSubTotal(), 2) .'</span></span>
				<span class="costs">Discount Code: <input class="textInput" type="text" name="discountCode" />
				<span style="margin-left:90px;"><input type="submit" class="applyBtn" value="Apply"></input></span></span>';
		}
		
		//if there is no products in the basket and the user clicked on checkout, redirect them to the welcome page
		//Otherwise, redirect them to the checkout page
		if (sizeof($this->products) == 0){ 
			$html.=	'<a href="Welcome.php" class="checkout">Check Out</a></div>
			</form>';
		} else {
			$html.=	'<a href="Checkout.php" class="checkout">Check Out</a></div>
			</form>';
		}
		return $html;
    }
}
?>