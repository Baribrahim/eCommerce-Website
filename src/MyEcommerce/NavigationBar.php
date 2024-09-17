
<header id="navBar">
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <div class="welcome">
		<i class="fas fa-user-circle"> </i>
		<span class="welcomeText">
			Hello, 
			<?php 
				//Check to see if the user is in the session (i.e. logged in), then print their first name
				//Otherwise, print a message saying Sign in
				if(isset($_SESSION["myUser"])) {
					echo $_SESSION["myUser"]->getFirstName();
				} else {
					echo "Sign in";
				}
			?>
			!
		</span> 
	  </div>
	  <hr>
	  <div class="main_sections">
		  <a href="#">Purchase History</a>
		  <a href="#">Bestsellers</a>
		  <a href="#">Deals</a>
		  <a href="#">New Releases</a>
	  </div>
	  <hr>
	  <div class="sidebar_headings">
		<h1 class="welcomeText">Categories<h1>
		<ul class="sidebar_links">
			<li>
				<a href="#">Laptops</a>
			</li>
			<li>
				<a href="#">Smart Phones</a>
			</li>
			<li>
				<a href="#">Tablets</a>
			</li>
			<li>
				<a href="#">TVs</a>
			</li>
			<li>
				<a href="#">Electronic Accessories</a>
			</li>
		</ul>
	  </div>
	  <hr>
	  <div class="sidebar_headings">
		<h1 class="welcomeText">Help & Settings<h1>
		<ul class="sidebar_links">
			<li>
				<a href="#">Contact Us</a>
			</li>
			<li>
				<a href="#">About Us</a>
			</li>
			<li>
				<a href="#">Currency settings</a>
			</li>
			<li>
				<a href="Processors/LogOut.php">
				<?php
					//if the user is in the session (i.e. logged in) make the function of the link to log out
					if(isset($_SESSION["myUser"])) {
						echo "Log Out";
					}
				?>
				</a>
				<a href="index.php">
				<?php
					//if the user is in the session (i.e. logged in) make the function of the link to log in
					if(!isset($_SESSION["myUser"])) {
						echo "Log In";
					}
				?>
				</a>
			</li>
		</ul>
	  </div>
	</div>
	<span style="font-size:25px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
	<a href="Welcome.php"><h1 id="logo">MyElectronics <i class="fas fa-tag"></i> </h1></a>
	
	<input type="text" placeholder="Search..." name="searchBar" id="search">
	<nav>
		<ul class="nav__links">
			<li>
				<div class="dropdown">
					<i class="fas fa-user-circle"> </i>
					<button class="dropbtn">My Account</button>
					<div class="dropdown-content">
						<?php
						if (isset($_SESSION["myUser"])) {
						?>
							<a href="#">Purchase History</a>
							<a href="Processors/LogOut.php">Log Out</a>
						<?php  } else { ?>
							<a href="index.php">Log In</a>
						<?php  } ?>
					</div>
				</div>
			</li>
			<li>
				<a href="MyItems.php"><i class="far fa-heart"></i> My Items</a>
			</li>
			<li><a href="Basket.php"><i class="fas fa-shopping-basket"></i> Basket</a></li>
			<?php
			//Check the user's user type, if its 0 then make the admin link appear in the header
			if (isset($_SESSION["myUser"]) && $_SESSION["myUser"]->getUserType() == 0) {
			?>
				<li><a href="Admin.php"><i class="fas fa-user-tie"></i> Admin</a></li>
			<?php  } ?>
		</ul>
	</nav>
</header>
<script>
	//functions to open and collapse the sidebar navigation by chaning its width
	function openNav() {
	  document.getElementById("mySidenav").style.width = "300px";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	}
</script>