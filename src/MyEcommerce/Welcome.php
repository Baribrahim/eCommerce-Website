<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
require_once("/xampp/htdocs/MyEcommerce/Classes/ProductObject.php");
session_start();
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
$myMessages = array();
    if (isset($_SESSION["allmessages"])) {
        $myMessages = $_SESSION["allmessages"];
        unset($_SESSION["allmessages"]);
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
	<?php
	require_once("/xampp/htdocs/MyEcommerce/Styles/WelcomeStyles.php");
	?>
    <title>MyElectronics - Home</title>
</head>

<body>
	<?php
	include "NavigationBar.php";
	?>
    <div id="Business__Features">
        <ul id="features">
            <li id="feature">Free Delivery</li>
            <li id="feature">24/7</li>
            <li id="feature">Order online & collect</li>
        </ul>
    </div>
    <div id="slideshow-container">
        <div class="mySlides">
            <div class="slideshow-numbertext">1 / 3</div>
            <img src="/MyEcommerce/Images/g_10212880.PNG" style="width:30%">
        </div>

        <div class="mySlides">
            <div class="slideshow-numbertext">2 / 3</div>
            <img src="/MyEcommerce/Images/iphone12.PNG" style="width:30%">
        </div>

        <div class="mySlides">
            <div class="slideshow-numbertext">3 / 3</div>
            <img src="/MyEcommerce/Images/C223NA-GJ0014_1_Classic.PNG" style="width:30%">
        </div>
    </div>
    <br>
    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

    <div id="messages">
        <?php
			//Check to see which message to print after the user submits an order (after checkout)
            if (in_array("card is already saved", $myMessages)) {
                echo "<p class='Messages'>This Card is already saved</p>";
            } else if (in_array("card has been saved", $myMessages)) {
                echo "<p class='Messages'>Order has been submitted, and card has been saved</p>";
            } else if (in_array("Order has been submitted", $myMessages)) {
                echo "<p class='Messages'>Order has been submitted</p>";
            }
        ?>
    </div>

    <div class="products">
		<div class="best-selling">
			<div id="title">
				<h1 style="text-align:center">Best Selling Products</h1>
			</div>
        <?php
			//load all the products from the database
            $theProducts = Product::loadAllProducts();
            for ($i = 0; $i < sizeof($theProducts); $i++) {
				//Loop through the array of products and check the status of each product
				if ($theProducts[$i]->getProductStatus() == "BestSelling") 
				{
					//Print that product in this div
					echo $theProducts[$i]->printBestSellingProduct();
				}
            }
			if(isset($_REQUEST["StockError"])) {
				echo "<p class='errorMessage'>Item Out Of Stock</p>";
			}
        ?>
		</div>
    </div>

    <script>
		//Creating a slideshow
        var slideIndex = 0
        showSlides()

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
			
			//loop through the number of slides and display each slide
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
			//if all slides has been displayed, start again from the first slide
            if (slideIndex > slides.length) slideIndex = 1

            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000);
        }
		
		//Returns the href (URL) of the current page and refresh the page, 
		//also send the product to the server (e.g. addToBasketProcess) to add it to the basket
        function addToBasket(id) {
            window.location.href = "Processors/addToBasketProcess.php?Product="+id;
        }
		
		//Returns the href (URL) of the current page and refresh the page, 
		//also send the product to the server (e.g. addToMyItemsProcess) to add it to the my items section
        function addToMyItems(id) {
            window.location.href = "Processors/addToMyItemsProcess.php?Product="+id;
        }
		
		//It hides the messages printed after the user has submitted an order, after 3 seconds
        var timeout = document.getElementById('messages');
        setTimeout(hideElement, 3000); //milliseconds until timeout//
        function hideElement() {
            timeout.style.display = 'none';
        }
    </script>
</body>

</html>