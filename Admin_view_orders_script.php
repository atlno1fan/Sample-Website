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
    	<style type="text/css">
    		.radio-btn{
    			display: flex;
    			margin: 20px;
    			height: 20px; 
    	</style>
  	</head>
  	<body>
	  	<div class="container">
	  		<div class="menu_items">
		  		<nav>
		  			<ul>
		  				<li><img id="logo" src="Images/Logo1.png"></li>
		  				<li><a href="Admin_view_overview.php">Overview</a></li>
		  				<li class="active_tab"><a href="Admin_view_products.php">Products</a></li>
		  				<li><a href="Admin_view_orders.php">Orders</a></li>
		  				<li><a href="Admin_view_baristas.php">Baristas</a></li>
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
							<h2>Order Information for Order No. <?php  echo "{$_POST['order_id']}"; ?></h2>
							<div class="items-2">
								<?php 
									if (isset($_POST['delete_order'])) {
										echo"
										<form action='Additional_files/Admin_view_script.php' method='post'>
										<input type = 'text' name = 'order_id' value = '{$_POST['order_id']}' hidden>
										<p>Are you sure you want to delete this order?</p>
										<table class='table-style'>
											<thead>
												<th>Order ID</th>
												<th>Items Ordered</th>
												<th>Order Total</th>
												<th>Order Location</th>
											</thead>
											<tbody>";
										
											$sql = "SELECT * FROM order_info WHERE Order_ID = {$_POST['order_id']}";
											$result = mysqli_query($conn,$sql) or die("Bad Query:$sql");

											if (mysqli_num_rows($result) > 0) {
					        					while($row = mysqli_fetch_array($result)){
						        					$orderID = $row['Order_ID'];
						        					$orderPrice = $row['Total'];
						        					$orderLocationID = $row['Location_ID'];

						        					echo "<tr>";
						        					echo "
						        						<td>{$orderID}</td>
						        						";
						        					$sql = "SELECT * FROM order_items WHERE Order_ID = {$orderID}";
						        					$res = mysqli_query($conn,$sql) or die("Bad Query:$sql");
						        					echo "<td>";
						        					if (mysqli_num_rows($res) > 0) {
						        						while($row = mysqli_fetch_array($res)){
						        							$itemID = $row['Order_ID'];
						        							$itemQuantity = $row['Quantity'];
						        							$sql = "SELECT * FROM Item_info WHERE Item_ID = {$itemID}";
						        							$rslt = mysqli_query($conn,$sql) or die("Bad Query:$sql");
						        							if (mysqli_num_rows($rslt) > 0) {
						        								while($row = mysqli_fetch_array($rslt)){
								        							echo "{$row['Item_name']} x {$itemQuantity}<br>";
								        						}
								        					}
						        						}
						        					}
						        					echo "</td>
						        					<td>RM {$orderPrice}</td>";

						        					$sql = "SELECT * FROM delivery_locations WHERE Location_ID = {$orderLocationID}";
						        					$results = mysqli_query($conn,$sql) or die("Bad Query:$sql");
						        					if (mysqli_num_rows($results) > 0) {
						        						while($row = mysqli_fetch_array($results)){
						        							echo "<td>{$row['Location_name']}</td></tr> </tbody>
															</table><br>
															<button type='submit' name='delete_order' class='big_btn'>Delete Order</button> <br>
															<button name='back' class='big_btn'><a href = 'Admin_view_orders.php' class='btn'>Go Back</a></button>
															</form>";
						        						}
						        					}
						        				}
					        				}
									}

									if (isset($_POST['add_order'])) {

										header("Location: Location_page.php");
    									exit();			
									}

								?>
							</div><!-- end of items-2 -->
						</div><!-- end of recent-->
					</div><!-- end of partition-2 -->
				</div><!-- end of main-->
			</div>	<!-- end of main-container-->
		</div><!-- end of container-->
	</body>
</html>