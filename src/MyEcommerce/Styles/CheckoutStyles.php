<style>
* {
  box-sizing: border-box;
}
 
html,
body {
  width: 100%;
  height: 100%;
  margin: 0;
}

.Checkout {
    margin: 100% auto;
    margin-top: 7%;
    margin-right: auto;
	margin-left: auto;
    width: 60%;
    height: 475px;
    border: 2px solid orange;
    border-radius: 10px;
    padding: 0% 2%;
    background-color: #00224B;
  }
  
  #shippingDetails {
	  width: 60%;
	  height: 450px;
	  float: left;
	  margin-top: 10px;
	  color: white;
	  text-align: center;
  }
  
  /***************** border: 2px solid white; *****************/
  #cardDetails {
	  width: 40%;
	  height: 450px;
	  float: right;
	  margin-top: 10px;
	  color: white;
	  font-size: 14px;
	  text-align: center;
  }
  
  .textInput {
    padding: 3 20px;
	margin: 12px 20px 12px 20px;
	border: none;
	border-bottom: 2px solid orange;
	text-align: center;
  }
  
  #inputs1 {
	  margin-top: 15px;
  }
  
  #cardNum {
	  margin-top: 22px;
  }
  
  .applyBtn {
	width: 25%;
	height: 5%;
	color: white;
	background-color: orange;
	border-radius: 6px;
	border: none;
	margin-top: 70%;
	margin-left: 70%;
}
 
 .applyBtn:hover {
	background-color: #e89805;
}

 #saveCard {
	margin-top: 5%;
	margin-left: 5%;
}

.errorMessage {
    color: red;
  }

</style>
<?php require_once("/xampp/htdocs/MyEcommerce/Styles/header.php"); ?>