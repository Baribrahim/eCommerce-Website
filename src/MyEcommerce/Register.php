<html>

<head>
    <title>Register</title>
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
    <script src="jquery-3.6.0.min.js"></script>
    <script>
		//2 functions that use jquery to switch between two divs
		//RegForm part 1 & part 2
        function Next(hide, show) {
            $("#" + hide).toggle();
            $("#" + show).toggle();
        }

        function Previous(show, hide) {
            $("#" + show).toggle();
            $("#" + hide).toggle();
        }
    </script>

</head>

</body>
<?php include "NavigationBar.php"; ?>
<div id="RegDiv">
    <form id="RegForm" action="/MyEcommerce/Processors/DoRegister.php" method="post">
        <h1>Create an account</h1>
        <div id="part1">
            <p id="Label">First Name</p>
            <p><input class="textInput" type="text" name="Fname" /></p>
            <?php
            if (in_array("Fname", $myErrors)) {
                echo "<p class='errorMessage'>First Name is not valid</p>";
            }
            ?>
            <p id="Label">Last Name</p>
            <p><input class="textInput" type="text" name="Lname" /></p>
            <?php
            if (in_array("Lname", $myErrors)) {
                echo "<p class='errorMessage'>Last name is not valid</p>";
            }
            ?>

            <p id="Label">Email Address</p>
            <p><input class="textInput" type="text" name="email" /></p>
            <?php
            if (in_array("email", $myErrors)) {
                echo "<p class='errorMessage'>Email is not valid</p>";
            }
            ?>

            <p id="Label">Password</p>
            <p><input class="textInput" type="password" name="password" /></p>
            <?php
            if (in_array("password", $myErrors)) {
                echo "<p class='errorMessage'>Password is not valid</p>";
            }
            ?>

            <p id="Label">Password Confirmation</p>
            <p><input class="textInput" type="password" name="passwordCon" /></p>
            <?php
            if (in_array("passwordCon", $myErrors)) {
                echo "<p class='errorMessage'>Passwords does not match</p>";
            }
            ?>

            <p><input class="standardButton" type="button" value="Next" onclick="Next('part1','part2')"></p>
        </div>
        <div id="part2" style="display: none;">
            <p id="Label">Phone Number</p>
            <p><input class="textInput" type="text" name="pNum" /></p>
            <?php
            if (in_array("pNum", $myErrors)) {
                echo "<p class='errorMessage'>Phone Number is not valid</p>";
            }
            ?>
            <p id="Label">Country</p>
            <p><input class="textInput" type="text" name="country" /></p>
            <?php
            if (in_array("country", $myErrors)) {
                echo "<p class='errorMessage'>Country is not valid</p>";
            }
            ?>

            <p id="Label">City</p>
            <p><input class="textInput" type="text" name="city" /></p>
            <?php
            if (in_array("city", $myErrors)) {
                echo "<p class='errorMessage'>City is not valid</p>";
            }
            ?>

            <p id="Label">Address</p>
            <p><input class="textInput" type="text" name="address" placeholder="E.g. Door Num + Street Name" /></p>
            <?php
            if (in_array("address", $myErrors)) {
                echo "<p class='errorMessage'>Address is not valid</p>";
            }
            ?>

            <p id="Label">Postcode</p>
            <p><input class="textInput" type="text" name="postcode" /></p>
            <?php
            if (in_array("postcode", $myErrors)) {
                echo "<p class='errorMessage'>Postcode invalid</p>";
            }
            ?>

            <p><input class="standardButton" type="button" value="Previous" onclick="Previous('part1','part2')"></p>
            <p><input class="standardButton" type="submit" value="Submit"></p>
        </div>


    </form>
</div>

</body>

</html>