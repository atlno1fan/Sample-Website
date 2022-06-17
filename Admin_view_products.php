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
	  		</div>
			<div class="main_container">
				<div class="main">
					<div class="partition-2">
						<div class= "recent">
							<h2>Products</h2>
							<div class="items-2">
								<table class="table-style">
									<thead>
										<th>
											<form action='Admin_view_product_script.php' method='post'>
											<button type='submit' name='add_item'>Add Item</button>
											</form>
										</th>
										<th>Item ID</th>
										<th>Item Name</th>
										<th>Category</th>
										<th>Item Price</th>
										<th>Item Picture</th>
										<th>Item Quantity</th>
									</thead>
									<tbody>
										<?php 

											$sql = "SELECT * FROM item_info";
											$result = mysqli_query($conn,$sql) or die("Bad Query: $sql");

											if (mysqli_num_rows($result) > 0) {
					        						while($row = mysqli_fetch_array($result)){

					        							echo "
					        							<tr>
					        							<td><form action='Admin_view_product_script.php' method='post'>
			        									<input type = 'text' name = 'item_id' value = '{$row['Item_ID']}' hidden>
			        									<button type='submit' name='update_item'>Update</button>
			        									</form><form action='Admin_view_product_script.php' method='post'>
			        									<input type = 'text' name = 'item_id' value = '{$row['Item_ID']}' hidden><button type='submit' name='delete_item'>Delete</button></form></td>
					        							<td>{$row['Item_ID']}</td>
					        							<td>{$row['Item_name']}</td>
					        							<td>{$row['Category']}</td>
					        							<td>RM {$row['Item_price']}</td>
					        							<td><img src='Images/{$row['Item_pic_dir']}'></td>
					        							<td>{$row['Item_quantity']}</td>
					        							</tr>";
					        						}
					        					}
										?>
									</tbody>
								</table>
							</div><!-- end of items-2 -->
						</div><!-- end of recent-->
					</div><!-- end of partition-2 -->
				</div><!-- end of main-->
			</div><!-- end of main-container-->
		</div><!-- end of container-->
	</body>
</html>