<?php session_start();
?>
<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="Signup-style.css">
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
    	<style>
    		.error {
    			color: #000000;
    		}
    	</style>
  	</head>

	<body>

	    <header>
		    <div id="header-container">
		      <div class= img-container>
		        <a href="Index.php"><img id="logo" src="Images/Logo1.png"></a>
		      </div><!-- end of img-container-->
		      <div class="nav-container">
		        <nav>
		          <ul>
		            <li><a href="Index.php">Home</a></li>
		            <li><a href="Menu.php">Menu</a></li>
		            <li><a href="Promotions.php">Promotions</a></li>
		            <li><a href="AboutUs.php">About Us</a></li>
		            <li>
		            	<?php
			                if (isset($_SESSION['Username'])){
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
			             
			                      $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
		      </div><!-- end of nav-container-->
		    </div><!-- end of header-container-->
		</header>
		
	 	<div class="main-container">
			<div class="signupform">
				<h1>Sign Up</h1>
				<form action="Additional_files/signup_script.php" method="post">
					<p>Username</p><input type="text" name="uid" placeholder="Username"><br><br>
					<p>E-mail</p><input type="text" name="email" placeholder="E-mail"><br><br>
					<p>Phone Number</p><input type="text" name="phone_number" placeholder="Phone Number"><br><br>
					<p>Password</p><input type="password" name="pass" placeholder="Password"><br>
					<P>Password must be  at <b>least 4 characters long and has a capital letter, a small letter and a number.</b></p>
					<p>Confirm Password</p><input type="password" name="pass-confirm" placeholder="Confirm Password"><br><br>
					<button type="submit" name="signup_submit">Sign Up</button>
				</form>
				<?php 
					$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

					if (strpos($fullUrl, "error=emptyfields") == true ) {
						echo '<p class="error">Form is empty!</p><br>';
					}
					else if (strpos($fullUrl, "error=invalidemail") == true ) {
						echo '<p class="error">Invalid Email!</p><br>';
					}
					else if (strpos($fullUrl, "error=username") == true ) {
						echo '<p class="error">Invalid Username. Has to be at least 2 letters and only letters,numbers and whitespace allowed!</p><br>';
					}
					else if (strpos($fullUrl, "error=passwordcheck") == true ) {
						echo '<p class="error">Passwords do not match!</p><br>';
					}
					else if (strpos($fullUrl, "error=invalidnumber") == true ) {
						echo '<p class="error">Invalid Phone Number. Must be 10 digits long!</p><br>';
					}
					else if (strpos($fullUrl, "error=invalidpass") == true ) {
						echo '<p class="error">Password must be at least 4 characters and must contain a number, a lower case letter, and an upper case letter.</p><br>';
					}
					else if (strpos($fullUrl, "error=mysqlerror") == true ) {
						echo '<p class="error">MySQL Error!</p><br>';
					}
					else if (strpos($fullUrl, "signup=success") == true ) {
						echo '<p class="success">You have Successfully Signed Up!</p><br>';
					}
					else if (strpos($fullUrl, "error=usertaken") == true ) {
		                      echo '<p class="error">User taken! </p><br>';
		                      }
				?>
			</div><!-- end of signupform-->
		</div><!-- end of main-container-->
		<br>

	    <footer>
		    <div class="footer-container">
		      <img src="Images/RC-logo-white.png">
		      <ul>
		        <li><a href="Index.php">Home</a></li>
		        <li><a href="Menu.php">Menu</a></li>
		        <li><a href="Promotions.php">Promotions</a></li>
		        <li><a href="About.php">About Us</a></li>
		      </ul>
		    </div>
	  	</footer>
	</body>
</html>