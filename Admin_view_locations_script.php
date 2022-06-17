<?php 
session_start();
require 'Additional_files/database_handler_script.php';
if(!isset($_SESSION['Username']) || $_SESSION['Username'] !== "Admin"){
	header("Location: index.php");
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="Admin_view_style.css">
  	</head>
  	<body>
	  	<div class="container">
	  		<div class="menu_items">
		  		<nav>
		  			<ul>
		  				<li><img id="logo" src="Images/Logo1.png"></li>
		  				<li><a href="Admin_view_overview.php">Overview</a></li>
		  				<li><a href="Admin_view_products.php">Products</a></li>
		  				<li><a href="Admin_view_orders.php">Orders</a></li>
		  				<li class="active_tab"><a href="Admin_view_baristas.php">Baristas</a></li>
		  				<li><a href="Admin_view_user.php">Users</a></li>
		  				<li><a href="Admin_view_locations.php">Delivery Locations</a></li>
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
				                       <button type="submit" name="login_submit" class="loginbtn">Login</button>  <button class="signupbtn"><a href="signup.php" >Sign Up</a></button>
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
	  		</div><!-- end of menu_items-->
			<div class="main_container">
				<div class="main">
					<div class="partition-2">
						<div class= "recent">
							<h2>Users</h2>
							<div class="items-2">
								<?php

									if (isset($_POST['update_location'])) {
										$locationID = $_POST['location_id'];
										$sql = "SELECT * FROM delivery_locations WHERE Location_ID = {$locationID}";
										$result = mysqli_query($conn,$sql) or die("Bad Query:$sql");


										if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_array($result)){
												echo "
												
												<form action='Additional_files/Admin_view_script.php' method='post'>
												<p>Update Location Information</p>
												<p>Location Name</p><input type = 'text' name = 'location_name' value = '{$row['Location_name']}' required>
												<input type = 'text' name = 'location_id' value = '{$locationID}' hidden>
												<br>
												<br><br>
												<button type='submit' name='update_location' class='big_btn'>Confirm Update</button> <br>
												<button name='back' class='big_btn'><a href = 'Admin_view_locations.php' class='btn'>Go Back</a></button>
												</form>";
											}
										}

									}

									if (isset($_POST['add_location'])) {

												echo "
												<form action='Additional_files/Admin_view_script.php' method='post'>
												<p>Add New Location</p>
												<p>Location Name</p><input type = 'text' name = 'location_name' pattern = '^[A-Za-z0-9]{2,15}$' title='Please input a valid name' value = '' placeholder ='Name' required>
												<button type='submit' name='add_location' class='big_btn'>Add Location</button> <br>
												<button name='back' class='big_btn'><a href = 'Admin_view_locations.php' class='btn'>Go Back</a></button>
												</form>";
									}

									if (isset($_POST['delete_location'])){
										$locationID = $_POST['location_id'];
										$sql = "SELECT * FROM delivery_locations WHERE Location_ID = {$locationID}";
										$result = mysqli_query($conn,$sql) or die("Bad Query:$sql");


										if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_array($result)){

												echo"
												<form action='Additional_files/Admin_view_script.php' method='post'>
												<p>Are you sure you want to delete this loaction?</p>
												<p>Name: {$row['Location_name']}</p>
												
												<input type = 'text' name = 'location_id' value = '{$locationID}' hidden>
												<button type='submit' name='delete_location' class='big_btn'>Delete Location</button> <br>
												<button name='back' class='big_btn'><a href = 'Admin_view_locations.php' class='btn'>Go Back</a></button>
												</form>

												";
											}
										}
									}
								?>
							</div><!-- end of items-2 -->
						</div><!-- end of recent-->
					</div><!-- end of partition-2 -->
				</div><!-- end of main-->
			</div><!-- end of main-container-->
		</div><!-- end of container-->
	</body>
</html>