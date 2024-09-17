<?php

class Product {

	//Attributes of a product object
    private $productID;
    private $productName;
	private $productStatus;
    private $productPrice;
    private $productImage;
    private $productDescription;
    private $productStock;
	
	//A constructor used to create a new instance of a product object
    public function __construct($id, $name, $status, $price, $image, $des, $st) {
        $this->productID = $id;
        $this->productName = $name;
		$this->productStatus = $status;
        $this->productPrice = $price;
        $this->productImage = $image;
        $this->productDescription = $des;
        $this->productStock = $st;
    }
	
	//Getters & Setters functions
    function getProductID()
    {
        return $this->productID;
    }

    function setProductID($id)
    {
        $this->productID = $id;
    }

    function getProductName()
    {
        return $this->productName;
    }

    function setProductName($name)
    {
        $this->productName = $name;
    }
	
	function getProductStatus()
    {
        return $this->productStatus;
    }

    function setProductStatus($status)
    {
        $this->productStatus = $status;
    }

    function getProductPrice()
    {
        return $this->productPrice;
    }

    function setProductPrice($price)
    {
        $this->productPrice = $price;
    }

    function getProductImage()
    {
        return $this->productImage;
    }

    function setProductImage($image)
    {
        $this->productImage = $image;
    }

    function getProductDes()
    {
        return $this->productDescription;
    }

    function setProductDes($des)
    {
        $this->productDescription = $des;
    }

    function getProductStock()
    {
        return $this->productStock;
    }

    function setProductStock($st)
    {
        $this->productStock = $st;
    }

	//This function use the hardcoded html code to print a product with all its details everytime its called
    function printHTML() {
        $html = '
            <div class="item" id="item'.$this->productID.'">
                <div id="remove">
                    <button id="removeButton">Remove</button>
                </div>

                <div id="image'.$this->productID.'">
                    <img src="'.$this->productImage.'" style="width:50%">
                </div>

                <div id="description'.$this->productID.'">
                    <span>'.$this->productName.'</span>
                    <span>'.$this->productDescription.'</span>
                    <span>Silver</span>
                </div>

                <div id="quantity'.$this->productID.'">
                    <label for="_quantity">Quantity</label>
                    <input onclick="updateTotal(1)" id="amount1" type="number" min="1" value="1">
                </div>
            
                <div id="itemPrice">
                    <input type="hidden" id="price1" value="549">
                    <span>Price: '.$this->productPrice.'</span>
                </div>

                <div id="total1">
                    <label for="_total">Total:</label>
                    <span>£549</span>
                </div>
            </div>
            ';
        return $html;
    }
	
	//This function is used to print products in the welcome page as it holds the add to basket/my items buttons
	//Even though its called print best selling products, it can be used for any product
    function printBestSellingProduct() {
        $html = '<div>
            <div id="item1">
			
                <div id="image'.$this->productID.'">
                    <img src="data:image/png;base64,'.base64_encode($this->productImage).'" alt="'.$this->productName.'" style="width:40%">
                </div>

                <div id="name'.$this->productID.'">
                    <span>'.$this->productName.'</span>
                </div>

                <div id="itemPrice">
                    <span>Price: £'.$this->productPrice.'</span>
                </div>

                <div>
                    <button id="basket-btn" onclick="addToBasket('.$this->productID.')">Add to Basket</button>
                </div>

                <div>
                    <button id="myItems-btn" onclick="addToMyItems('.$this->productID.')"><i class="far fa-heart"></i></button>
                </div>
            </div>
        </div>';
        return $html;
    }
	
	//Retrieve the data of all the products in the database
    public static function loadAllProducts() {
        $mysqli = new mysqli("localhost", "root", "", "e-commerce");
        $stmt = $mysqli->prepare("SELECT * FROM eProducts");
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $products = [];
        while ($row=$res->fetch_assoc()) {
            $myProduct = new Product($row["ProductID"], $row["ProductName"], $row["Status"], $row["ProductPrice"], $row["ProductImage"], $row["ProductDescription"], $row["ProductStock"]);
            $products[] = $myProduct;
        }
        return $products;
    }
	
	//Retrieve the data of a product with a given id
    public static function loadProductById($id) {
        $mysqli = new mysqli("localhost", "root", "", "e-commerce");
        $stmt = $mysqli->prepare("SELECT * FROM eProducts WHERE ProductID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc(); 
            $myProduct = new Product($row["ProductID"], $row["ProductName"], $row["Status"], $row["ProductPrice"], $row["ProductImage"], $row["ProductDescription"], $row["ProductStock"]);
            return $myProduct;
        }
        return null;
        
    }
}
?>

