<?php
//Log the users out by removing them from the session
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
session_start();
session_unset();
session_destroy();

header("Location: /MyEcommerce/index.php");
