<style>
    @import url("https://fonts.googleapis.com/css2?family=Blinker&display=swap");
    @import url("https://fonts.googleapis.com/css2?family=Sunflower:wght@300&display=swap");

    #Business__Features {
        width: 100%;
        border-bottom: 2px solid orange;
        background-color: #004599;
        padding: 5px 10px 5px 10px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #feature {
        color: white;
    }

    #features li {
        display: inline-block;
        padding: 0 225px 0 225px;
    }

    #features {
        text-align: center;
    }

    .slideshow-container {
        max-width: 100%;
        position: relative;
        margin: auto;
    }

    .mySlides {
        display: none;
        padding-left: 40%;
        border: 2px solid #bbb;
        background-color: #e8ebe9;
    }

    .slideshow-numbertext {
        color: black;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 140;
    }

    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }

    .products {
        width: 100%;
        height: 100%;
        margin: 80px auto;
		margin-top: 100px;
        background: #FFFFFF;
        box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
        border-radius: 6px;
        border: 2px solid orange;
        display: flex;
        flex-direction: row;
    }

    .best-selling {
		width: 100%;
        padding: 30px 50px;
        height: 220px;
        display: flex;
        justify-content: space-between;
		border-bottom: 2px solid grey;
    }

    #item1 {
        display: inline-block;
        width: 200px;
        margin-bottom: 2px;
    }

    #basket-btn {
        border: 2px solid orange;
        background-color: orange;
        border-radius: 10px;
        font-family: "Sunflower", sans-serif;
        color: white;
        font-size: 14px;
        padding: 2px 8px 2px 8px;
        cursor: pointer;
        float: left;
    }

    #myItems-btn {
        background-color: transparent;
        border: 0px;
        float: right;
        margin-right: 70px;
        margin-top: 6px;
    }
	
	.errorMessage {
		color: red;
		margin-left: 30px;
		margin-top: 10px;
	}

    #messages {
        border: 2px solid orange;
        background-color: #00224B;
        width: 25%;
        margin-left: auto;
        margin-right: auto;
    }

    #messages p {
        font-size: 24px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    .Messages {
        color: white;
        margin-top: 25px;
    }
</style>
<?php require_once("/xampp/htdocs/MyEcommerce/Styles/header.php"); ?>