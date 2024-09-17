<html>

<head>
	<title>Login - MyEcommerce</title>
	<link rel="stylesheet" href="/MyEcommerce/fontawesome/css/all.css">
	<?php
	session_start();
	require_once("/xampp/htdocs/MyEcommerce/Styles/AccountsStyles.php");
	$myErrors = array();
	if (isset($_SESSION["allerrors"])) {
		$myErrors = $_SESSION["allerrors"];
		unset($_SESSION["allerrors"]);
	}
	?>

	<head>
		</body>
		<?php include "NavigationBar.php"; ?>
		<div id="LoginDiv">
			<form id="loginForm" action="/MyEcommerce/Processors/DoLogin.php" method="post">
				<h1>Please Log in</h1>

				<p id="usernameLabel">Email Address</p>

				<p><input class="textInput" type="text" name="email" /></p>

				<p id="passwordLabel">Password</p>

				<p><input class="textInput" type="password" name="password" /></p>

				<?php
				if (in_array("password", $myErrors) || in_array("email", $myErrors)) {

					echo "<p class='errorMessage'>Email or Password is invalid</p>";
				}
				?>

				<p><input class="standardButton" type="submit" value="Log in" /></p>

				<a href="Register.php" target="_blank" id="regLink">Click here to Register</a>
			</form>
		</div>
		</body>

</html>