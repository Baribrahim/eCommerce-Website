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

#title {
    padding: 10px 20px 30px 20px;
    height: 60px;
    border-bottom: 1px solid #ffc04c;
    font-size: 36px;
    font-weight: 400;
}

.basket {
  width: 50%;
  height: 50%;
  margin: 80px 40px;
  background: #FFFFFF;
  box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  float: left;
}

.item {
  padding: 20px 30px;
  height: 120px;
  display: flex;
  justify-content: space-between;
}

.item:nth-child(3) {
  border-bottom:  5px solid #E1E8EE;
}

#remove {
  position: relative;
  padding-top: 5px;
  margin-right: 30px;
  align-self: center;
}

#removeButton {
  display: inline-block;
  Cursor: pointer;
  align-self: center;
  width: 50px;
  height: 50px;
  background: none;
  border-style: none;
}

.image {
  margin-right: 10px;
  margin-left: 10px;
  width: 500px;
  align-self: center
}
 
.description {
  padding-top: 5px;
  margin-right: 40px;
  width: 250px;
  align-self: center
}
 
.description span {
  display: block;
  font-size: 14px;
  color: #43484D;
  font-weight: 400;
  align-self: center
}
 
.description span:first-child {
  margin-bottom: 5px;
  align-self: center
}
.description span:last-child {
  font-weight: 300;
  margin-top: 8px;
  align-self: center
}

.quantity {
  padding-top: 5px;
  margin-right: 30px;
  align-self: center
}


.quantity input {
  -webkit-appearance: none;
  border: 1px solid grey;
  border-radius: 5px;
  text-align: center;
  width: 30px;
  font-size: 16px;
  color: #43484D;
  font-weight: 200;
  align-self: center
}

#itemPrice {
  width: 83px;
  padding-top: 5px;
  margin-right: 12px;
  text-align: center;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
  align-self: center;
}

.totall {
  width: 100px;
  padding-top: 5px;
  text-align: center;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
  align-self: center;
}

#moveButton {
	padding-top: 20px;
	display: inline-block;
	Cursor: pointer;
	align-self: center;
	width: 50px;
	height: 50px;
	background: none;
	border-style: none;
}

.totalPrice {
  width: 30%;
  height: 35%;
  margin: 80px 80px;
  background: #FFFFFF;
  box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  float: right;
}

.costs {
	padding: 10px 20px 30px 20px;
    height: 40px;
    font-size: 16px;
    font-weight: 400;
	display: flex;
	justify-content: space-between;
}

.checkout {
	width: 50%;
	color: white;
	background-color: orange;
	border-radius: 5px;
	border: none;
	margin-left: auto;
    margin-right: auto;
	margin-top: 10px;
	text-align: center;
}

.applyBtn {
	width: 150%;
	color: white;
	background-color: orange;
	border-radius: 6px;
	border: none;
	margin-top: 5px;
}

.checkout:hover {
	background-color: #e89805;
}

.applyBtn:hover {
	background-color: #e89805
}

.line {
	width: 90%;
	margin-left: auto;
    margin-right: auto;
}

.textInput {
	width: 120px;
	height: 25px;
	border: none;
	border-bottom: 2px solid orange;
}

.errorMessage {
    color: red;
    margin-left: 500px;
  }

</style>
<?php require_once("/xampp/htdocs/MyEcommerce/Styles/header.php"); ?>