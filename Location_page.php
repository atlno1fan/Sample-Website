<?php session_start();
require 'Additional_files/database_handler_script.php';
$sql = "SELECT * FROM delivery_locations";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

?>

<!DOCTYPE html>
<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="Home-style.css">
    	<link rel="stylesheet" type="text/css" href="form.css">
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
  	</head>

	<body>

	    <header>
		    <div id="header-container">
		      <div class= img-container>
		        <a href="Index.php"><img id="logo" src="Images/Logo1.png"></a>
		      </div><!--end of img-container -->
		      <div class="nav-container">
		        <nav>
		          <ul>
		            <li><a href="Index.php">Home</a></li>
		            <li><a href="Menu.php" class="current-page">Menu</a></li>
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
		      </div><!--end of nav-container -->
		    </div><!--end of header-container -->
		</header>


		<div class="main-container">
			<section class="ordering-section">
				<h1>Please Choose your desired delivery location</h1>
				<br>
				<form action="Additional_files/location_script.php" method="post">
					<select name="location">
					<?php 
					if (mysqli_num_rows($result) > 0) {
		        		while($row = mysqli_fetch_array($result)){
							echo "<option value='{$row['Location_ID']}'>{$row['Location_name']}</option>";
						}
					}
					?>
					</select>
					<br>
					<br>
					<button type="submit" name="location_submit">Confirm Location</button>
				</form>
				<br>
			</section>
		</div><!--end of main-container -->


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
		    </div><!--end of footer-container -->
		</footer>

	</body>
</html>