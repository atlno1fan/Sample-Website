<?php session_start();
require 'Additional_files/database_handler_script.php';

$sql = "SELECT * FROM order_info WHERE Order_ID ='".$_SESSION['Order_ID']."'";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");


?>
<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="Signup-style.css">
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
    	<style>
			.btn{
				color: #000000;
				text-decoration: none;
				padding: 25px 92px 25px 92px;
			}

			.btn:hover, .btn:focus {
				color:#ffffff;
			}

			.small-btn {
				max-width: 150px;
				text-align: center;
			}
			.small-btn a{
				color: #000000;
				text-decoration: none;
				padding: 20px 23px 20px 20px;
				font-size: 0.8em;
			}

			.small-btn a:hover, .small-btn a:focus {
				color:#ffffff;
			}

    	</style>
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
		      </div><!--end of nav-container-->
		    </div><!--end of header-container-->
		</header>
		
		 	<div class="main-container">
				<div class="signupform">
					<h1>Checkout</h1>
					<form action="Additional_files/checkout_script.php" method="post">
							<?php 
			                if (isset($_SESSION['Username'])){

			                	echo "
			                		<p>Name</p><input type='text' name='name' value='{$_SESSION['Username']}' required><br><br>
									<p>E-mail</p><input type='text' name='email' value='{$_SESSION['User_email']}' required><br><br>
									<p>Phone Number</p><input type='text' name='phone_number' value='{$_SESSION['User_phone_num']}' required><br><br>";
			                }
			                else {
			                	echo "
			                		<p>Name</p><input type='text' name='name' placeholder='Name' required><br><br>
									<p>E-mail</p><input type='text' name='email' placeholder='E-mail' required><br><br>
									<p>Phone Number</p><input type='text' name='phone_number' placeholder='Phone Number' required><br><br>";
			                }

							if (mysqli_num_rows($result) > 0) {
			        			while($row = mysqli_fetch_array($result)){
									$sql = "SELECT * FROM delivery_locations WHERE Location_ID = {$row['Location_ID']}";
									$value = mysqli_query($conn,$sql) or die ("Bad Query: $sql");
									if (mysqli_num_rows($value) > 0) {
			        					while($row = mysqli_fetch_array($value)){
											echo "<p><b>Chosen Location:</b> {$row['Location_name']} <button class = 'small-btn'><a href='Update_Location.php'>Change</a></button></p>";
										}
									}
								}
							}
						?>
						<p>Location Details</p><input type="textbox" name="location_details" placeholder="Location Details" required><br><br>
						<button type="submit" name="checkout_submit">Pay with Cash</button>
						<button><a href = "Cart.php" class="btn">Back to Cart</a></button>
					</form>
					<?php 
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

						if (strpos($fullUrl, "error=emptyfields") == true ) {
							echo '<p class="error">Form is empty!</p><br>';
						}
						else if (strpos($fullUrl, "error=invalidemail") == true ) {
							echo '<p class="error">Invalid Email!</p><br>';
						}
						else if (strpos($fullUrl, "error=invalidname") == true ) {
							echo '<p class="error">Invalid Name. Has to be at least 2 letters</p><br>';
						}
						else if (strpos($fullUrl, "error=invalidnumber") == true ) {
							echo '<p class="error">Invalid Phone Number.</p><br>';
						}
						else if (strpos($fullUrl, "error=mysqlerror") == true ) {
							echo '<p class="error">MySQL Error!</p><br>';
						}
						else if (strpos($fullUrl, "order=success") == true ) {
							echo '<p class="success">You have Successfully Ordered!</p><br>';
							header("Location:../index.php?order=success");
	        				exit();
						}
					?>
				</div><!--end of signupform-->
			</div><!--end of main-container-->
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
	    </div><!--end of footer-container-->
  </footer>