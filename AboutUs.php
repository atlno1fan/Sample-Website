<?php session_start();
?>
<!DOCTYPE html>
<html>
<!-- The About Us Page-->
  	<head>
  		<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="About-us-style.css">
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
  	</head>

	<body>

	    <header>
		    <div id="header-container">
		      <div class= img-container>
		        <a href="Index.php"><img id="logo" src="Images/Logo1.png"></a>
		      </div>
		      <div class="nav-container">
		        <nav>
		          <ul>
		            <li><a href="Index.php">Home</a></li>
		            <li><a href="Menu.php">Menu</a></li>
		            <li><a href="Promotions.php">Promotions</a></li>
		            <li><a href="AboutUs.php" class="current-page">About Us</a></li>
		            <li>
		            	<?php
			                if (isset($_SESSION['Username'])){   //Check whether user is logged in or not
			                  echo '<div class="logoutform"><form method="POST" action="Additional_files/logout_script.php">
			                        <button type="submit" name="logout_submit"class="logoutbtn">Logout</button>
			                        </form> </div>';
			                }
			                else {
			                 echo '<form method="POST" action="Additional_files/login_script.php"> 
			                       <input type="text" name="email" placeholder="E-mail">  
			                       <input type="password" name="pass" placeholder="Password">
			                       <button type="submit" name="login_submit" class="loginbtn">Login</button>  <button class="signupbtn"><a href="signup.php">Sign Up</a></button>
			                       </form>';
			             
			                      $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; //check if error code is in url and display appropriate error
			                      if (strpos($fullUrl, "error=noinput") == true ) {
			                      echo '<p class="error">Fields are Empty</p><br>';
			                      }
			                      else if (strpos($fullUrl, "error=wrongpassword") == true ) {
			                      echo '<p class="error">Wrong Passsword! </p><br>';
			                      }
			                      else if (strpos($fullUrl, "login=success") == true ) {
			                      echo '<p class="error">You have logged in successfully! </p><br>';
			                      }
			                      else if (strpos($fullUrl, "error=nouser") == true ) {
			                      echo '<p class="error">User not Found! </p><br>';
			                      }
			                    }
             			 ?>      
          			</li>
		          </ul>
		        </nav>
		      </div><!-- end of nav-conatiner -->
		    </div><!-- end of header-conatiner -->
		</header>
		<div class="main-container">
			<section class="About-us2">
	    		<img src="Images/Banner2.jpg">
	    		
	    	</section>
			<section class="About-us1">
				<div class="aboutus-container1">
				<img src="Images/13.png">
				</div><!-- end of aboutus-container1-->
				<div class="aboutus-container2">
					<h1>Our Story</h1>
					<p>The philosophy of Richiamo Coffee can be summed up in three simple words: Product, Service and Atmosphere.</p>

					<p>At Richiamo Coffee we aim to give our customers a unique experience with every sip of our coffee or taste of our snacks. Surrounded by a cozy and atmosphere and served by our friendly staff, customers are made to feel at ease as if they were sitting at home in their living room.</p>

					<p>The Company is guided by its firm belief in ensuring consistent supply of quality products and providing excellent service to its customers and is steered by dedicated team to continuously achieve the organizational Vision and Mission.</p>
				</div><!-- end of aboutus-container2-->
	    	</section>
	    	<section class="Locations">
	    		<h1>Our Locations</h1>
	    		<ol>
	    			<li>📍UUM, Sintok</li>
	    			<li>📍IIUM, Gombak</li>
	    			<li>📍Gurney Mall, UTMKL</li>
	    			<li>📍USM Penang</li>
	    			<li>📍UiTM Puncak Alam</li>
	    			<li>📍Hospital UiTM Sg Buloh</li>
	    			<li>📍UiTM Alor Gajah</li>
	    			<li>📍Kota Bharu, Kelantan</li>
	    			<li>📍Seksyen 7, Shah Alam</li>
	    			<li>📍UPSI Tanjung Malim</li>
	    			<li>📍UNIMAS, Kuching</li>
	    			<li>📍Taylor’s Lakeside Campus</li>
	    			<li>📍Asia e University, SS15</li>
	    			<li>📍UNICITY Mall, Seremban 3</li>
	    			<li>📍UTM, Skudai</li>
	    			<li>📍Laman Areca, Nilai</li>
	    			<li>📍UiTM Shah Alam 🔜</li>
	    			<li>📍Jalan Diplomatik, Putrajaya</li>
	    			<li>📍Draw Bridge, KT 🔜</li>
	    			<li>📍Jalan Raja Laut, KL 🔜</li>
	    		</ol>
	    	</section>
		</div><!-- end of main-container-->
		<br>
	  	<footer>
			<div class="footer-container">
			  <img src="Images/RC-logo-white.png">
			  <ul>
			    <li><a href="Index.php">Home</a></li>
			    <li><a href="Menu.php">Menu</a></li>
			    <li><a href="Promotions.php">Promotions</a></li>
			    <li><a href="AboutUs.php">About Us</a></li>
			  </ul>
			</div>
		</footer>