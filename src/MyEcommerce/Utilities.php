<?php

//A function to check if the user in the session (i.e. the logged in user) is an admin
function isAdmin()
{	//If the user is not logged in, redirect to the login page
    if (!isset($_SESSION["myUser"])) {
        header("Location: index.php"); 
        exit;
		//Checking the user type by using the getter function from user object classs
    } else if ($_SESSION["myUser"]->getUserType() != 0) {
        header("Location: Welcome.php");
        exit;
    }
}

//A check to see if the user is logged in, if not redirect them to the login page
function isLoggedIn() {
    if (!isset($_SESSION["myUser"])) {
        header("Location: index.php");
        exit;
    }
}

