<?php
require_once("/xampp/htdocs/MyEcommerce/Classes/UserObject.php");
session_start();
require_once("/xampp/htdocs/MyEcommerce/Utilities.php");
isAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
    <title>MyElectronics - Admin</title>
    <?php
		require_once("/xampp/htdocs/MyEcommerce/Styles/header.php"); 
    ?>
</head>

<body>
<?php include "NavigationBar.php"; ?>

</body>

</html>