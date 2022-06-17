<?php 
session_start();
require 'Additional_files/database_handler_script.php';

if(!isset($_SESSION['Username']) || $_SESSION['Username'] !== "Admin"){
	header("Location: index.php");
	exit();
}
$sql ="SELECT * FROM order_items";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

$hotbeverages = 0;
$coldbeverages = 0;
$icebeverages = 0;
$desserts = 0;
$meals = 0;
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)){
		$sql ="SELECT * FROM item_info WHERE Item_ID = {$row['Item_ID']}";
		$rslt = mysqli_query($conn, $sql) or die("Bad Query:$sql");
		if (mysqli_num_rows($rslt) > 0) {
			while($row = mysqli_fetch_array($rslt)){
				if ($row['Category'] == "hot_beverages"){
					$hotbeverages = $hotbeverages + 1;
				}
				else if ($row['Category'] == "cold_beverages"){
					$coldbeverages = $coldbeverages + 1;
				}
				else if ($row['Category'] == "desserts"){
					$desserts = $desserts + 1;
				}
				else if ($row['Category'] == "meals"){
					$meals = $meals + 1;
				}
				if ($row['Category'] == "ice_blended"){
					$icebeverages = $icebeverages + 1;
				}
			}	
		}
	}
}

$Total = $meals + $desserts + $hotbeverages + $coldbeverages + $icebeverages;
$percentage = 0;

?>

<!DOCTYPE html>
<html>

	<head>
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="Admin_view_style.css">
    	<style type="text/css">
			.bar
			{
			    background-color: #0f0f0f;
			    position: relative;
			    height: 30px;
			    border:1px solid #0f0f0f;
			}
		</style>
  	</head>
  	<body>
	  	<div class="container">
	  		<div class="menu_items">
		  		<nav>
		  			<ul>
		  				<li><img id="logo" src="Images/Logo1.png"></li>
		  				<li class="active_tab"><a href="Admin_view_overview.php">Overview</a></li>
		  				<li><a href="Admin_view_products.php">Products</a></li>
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
				<div class="partition">

					<div id="barcontainer" style="width:200px;">
						<h2>Items Sold per Category</h2>
						Hot Beverages <?php $percentage = ($hotbeverages/$Total)*100; $percentage_dispalyed = sprintf("%0.2f",$percentage);  echo "({$percentage_dispalyed}%)";?>
	    				<div id="bar1" class="bar" style="width:<?php echo "{$percentage}%"; ?>;"></div>
	    				<hr>
	    				Cold Beverages <?php $percentage = ($coldbeverages/$Total)*100; $percentage_dispalyed = sprintf("%0.2f",$percentage);  echo "({$percentage_dispalyed}%)";?>
	    				<div id="bar2" class="bar" style="width:<?php echo "{$percentage}%"; ?>;"></div>
	    				<hr>
	    				Ice Blended Beverages <?php $percentage = ($icebeverages/$Total)*100; $percentage_dispalyed = sprintf("%0.2f",$percentage);  echo "({$percentage_dispalyed}%)";?>
	    				<div id="bar2" class="bar" style="width:<?php echo "{$percentage}%"; ?>;"></div>
	    				<hr>
	    				Desserts <?php $percentage = ($desserts/$Total)*100; $percentage_dispalyed = sprintf("%0.2f",$percentage);  echo "({$percentage_dispalyed}%)";?>
	    				<div id="bar3" class="bar" style="width:<?php echo "{$percentage}%"; ?>;"></div>
	    				 <hr>
	    				Meals <?php $percentage = ($meals/$Total)*100; $percentage_dispalyed = sprintf("%0.2f",$percentage);  echo "({$percentage_dispalyed}%)";?>
	    				<div id="bar4" class="bar" style="width:<?php echo "{$percentage}%"; ?>;"></div>
	    				<?php echo"<h3>Total Number of Items Sold: {$Total}</h3>";?>
					</div> <!-- end of barcontainer-->

					<div class = "part">
						<div class="part_in"><h2>Total Number of Orders Fullfilled</h2>
						<?php 
							$sql = "SELECT * FROM order_info WHERE Order_status = 'ready-for-delievry'";
							$result = mysqli_query($conn,$sql) or die ("Bad Query:$sql");
							$counter = 0;
								while($row = mysqli_fetch_array($result)){
									if(mysqli_num_rows($result) > 0){
										$counter = $counter + 1;
									}
								}
								echo "<p>{$counter}</p>";
						?>
						</div><!-- end of part-->
						<div class="part_in"><h2>Number of Registered Users</h2>
						<?php 
							$sql = "SELECT * FROM user_info WHERE Barista_status = 0 AND Admin_status = 0";
							$result = mysqli_query($conn,$sql) or die ("Bad Query:$sql");
							$number = 0;
								while($row = mysqli_fetch_array($result)){
									if(mysqli_num_rows($result) > 0){
										$number = $number + 1;
									}
								}
								echo "<p>{$number}</p>";
						?>
						</div><!-- end of part_in-->

						<div class="part_in"><h2> Total Revenue</h2>
						<?php 
							$sql = "SELECT * FROM order_info";
							$result = mysqli_query($conn,$sql) or die ("Bad Query:$sql");
							$revenue = 0;
								while($row = mysqli_fetch_array($result)){
									if(mysqli_num_rows($result) > 0){
										$revenue = $revenue + $row['Total'];
									}
								}
								$revenue_displayed = sprintf("%0.2f",$revenue);
								echo "<p>RM {$revenue_displayed}</p>";
						?>
						</div><!-- end of part_in-->

					</div>
					<div class="part">
						<div class="item-display">
							<h2>Recently Ordered Items</h2>
							<?php 
								$sql = "SELECT * FROM order_items LIMIT 3";
								$result = mysqli_query($conn,$sql) or die ("Bad Query:$sql");
								while($row = mysqli_fetch_array($result)){
									if(mysqli_num_rows($result) > 0){
										$Item_ID = $row['Item_ID'];
		        						$Addon_ID = $row['Addon_ID'];
		        						$sql = "SELECT * FROM item_info WHERE item_ID ='".$Item_ID."'";
										$values = mysqli_query($conn, $sql) or die("Bad Query:$sql");
										
										if (mysqli_num_rows($values) > 0) {
				        					while($row = mysqli_fetch_array($values)){
				        						echo "
				        						<div class='items'> 
				        						<img src='Images/{$row['Item_pic_dir']}'>
				        						<p>{$row['Item_name']} <br>RM {$row['Item_price']}</p>
				        						</div>
				        						";
				        					}
				        				}
									}
								}
							?>
						</div><!-- end of item-display-->
					</div><!-- end of part-->
				</div><!-- end of partition-->
				<div class="partition-2">
					<div class= "recent">
						<h2>Most Recent Orders</h2>
						<div class="items-2">
							<table class="table-style">
								<thead>
									<th>Order ID</th>
									<th>Items Ordered</th>
									<th>Order Total</th>
									<th>Order Location</th>
								</thead>
								<tbody>
									<?php
										$sql = "SELECT * FROM order_info LIMIT 3";
										$result = mysqli_query($conn,$sql) or die("Bad Query:$sql");

										if (mysqli_num_rows($result) > 0) {
				        					while($row = mysqli_fetch_array($result)){
					        					$orderID = $row['Order_ID'];
					        					$orderPrice = $row['Total'];
					        					$orderLocationID = $row['Location_ID'];

					        					echo "<tr>";
					        					echo "<td>{$orderID}</td>";
					        					$sql = "SELECT * FROM order_items WHERE Order_ID = {$orderID}";
					        					$res = mysqli_query($conn,$sql) or die("Bad Query:$sql");
					        					echo "<td>";
					        					if (mysqli_num_rows($res) > 0) {
					        						while($row = mysqli_fetch_array($res)){
					        							$itemID = $row['Item_ID'];
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
					        							echo "<td>{$row['Location_name']}</td>";
					        						}
					        					}
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


