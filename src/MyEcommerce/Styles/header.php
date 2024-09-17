<style>
    @import url("https://fonts.googleapis.com/css2?family=Sunflower:wght@300&display=swap");

    /***************** HEADER STYLES *****************/
	
	* {
		box-sizing: border-box;
		margin: 0;
		padding: 0;
	}

	 html {
		height: 100%;
	}

	 body {
		font-family: "Sunflower", sans-serif;
		height: 100%;
	}
	
    li,
    a {
        font-family: "Sunflower", sans-serif;
        font-weight: 500px;
        font-size: 22px;
        color: white;
        text-decoration: none;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 30px 3%;
        background-color: #00224B;
    }

    .nav__links {
        list-style: none;
    }

    .nav__links li {
        display: inline-block;
        padding: 0 5px 0 5px;
    }

    .nav__links li a {
        transition: all 0.3s ease 0s;
    }

    .nav__links li a:hover {
        color: #ff8c00;
    }
	
	/***************** My Account STYLES *****************/

    .dropbtn {
        cursor: pointer;
        background-color: transparent;
        border-color: transparent;
        font-family: "Sunflower", sans-serif;
        font-weight: 500px;
        font-size: 22px;
        color: white;
        text-decoration: none;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    #search {
        padding: 10px 20px;
        border-radius: 10px;
        width: 30%;
    }

    #logo {
        color: #ffc04c;
        cursor: pointer;
    }

    i {
        color: #ffc04c;
        cursor: pointer;
    }

    i:hover {
        color: #ff8c00;
    }
	
	/***************** Sidebar STYLES *****************/
	
	.sidenav {
	  height: 100%;
	  width: 0;
	  position: fixed;
	  z-index: 1;
	  top: 0;
	  left: 0;
	  background-color: #00224B;
	  overflow-x: hidden;
	  transition: 0.5s;
	  padding-top: 60px;
	}
	/***#00224B***/
	/***#ffc04c***/
	.sidenav a {
	  padding: 8px 8px 8px 32px;
	  text-decoration: none;
	  font-size: 25px;
	  color: #white;
	  display: block;
	  transition: 0.3s;
	}

	.sidenav a:hover {
	  color: #ffc04c;
	}

	.sidenav .closebtn {
	  position: absolute;
	  top: 0;
	  right: 10px;
	  font-size: 36px;
	  margin-left: 50px;
	}
	
	.welcome {
		background-color: #00224B;
	}
	
	.welcome i {
		margin-top: 5px;
		margin-bottom: 20px;
		padding-top: 10px;
		padding-left: 30px;
		font-size: 24px;
		color: #ffc04c;
	}
	
	.welcomeText {
		color: white;
		font-size: 24px;
	}
	
	.main_sections {
		margin-top: 20px;
		margin-bottom: 20px;
	}
	
	.sidebar_headings {
		margin-top: 20px;
		margin-bottom: 20px;
		margin-left: 18px;
	}
	
	.sidebar_links {
		margin-left: 18px;
	}
	
	.sidebar_links a {
		font-size: 20px;
	}
</style>