<?php 
session_start();
require 'Additional_files/database_handler_script.php';

$sql = "SELECT * FROM order_info WHERE Order_status = 'to-be-prepared'";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");


?>

<!DOCTYPE html>
<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="barista-style.css">
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
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
		      </div><!-- end of nav-container-->
		    </div><!-- end of header-container-->
		</header>

		<div class="main-container">
		    <section class="ordering-section">
		      	<h1>Update the quantity based on inventory</h1>
		      	<div class="menu-items-container">
		        	<table class="table-style">
		        		<thead>
		        			<th></th>
		        			<th>Order no.</th>
		        			<th>Customer Name</th>
		        			<th>Number of Items</th>
		        			<th>Order Price</th>
		        			<th>Customer Address</th>
		        			<th>Address Comments</th>
		        			<th>Customer E-mail</th>
		        			<th>Customer Phone Number</th>
		        			<th></th>
		        		</thead>
		        		<tbody>
				        	<?php
				        		$number = 1;
				        		if (mysqli_num_rows($result) > 0) {

				        			while($row = mysqli_fetch_array($result)){
				        				$Location_comment = $row['Location_comment'];
				        				$email = $row['email'];
				        				$Phone_number = $row['Phone_number'];
				        				$orderID = $row['Order_ID'];
				        				echo"<tr>
				        						<td>{$number}</td>
				        						<td>{$row['Order_ID']}</td>
				        						<td>{$row['Name']}</td>
				        						<td>{$row['Item_quantity_ordered']}</td>
				        						<td>{$row['Total']}</td>";
				        						$sql = "SELECT * FROM delivery_locations WHERE Location_ID = {$row['Location_ID']}";
												$values = mysqli_query($conn, $sql) or die("Bad Query:$sql");
												if (mysqli_num_rows($values) > 0) {
			        								while($row = mysqli_fetch_array($values)){
			        								$locationName = $row['Location_name'];
			        								echo"<td>{$locationName}</td>";
			        								}
			        							}
				        						echo"<td>{$Location_comment}</td>
				        						<td>{$email}</td>
				        						<td>{$Phone_number}</td>
				        						<td><form action='Order_view.php' method='post'><input value='{$orderID}' name='orderID' type='text' hidden>
				        						<button type='submit' value='View_order'>View Order Items</button>
				        						</form></td>
				        					</tr>";
				        				$number = $number + 1;
				        				}
				        			}
				        	?>
		        		</tbody>
		        	</table>
		        	<br>
		        	<a href="barista_homepage.php"><button>Go back to homepage</button></a>
		        </div><!-- end of menu-items-container-->
		    </section>
		    <br>
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
		    </div><!-- end of footer-container-->
		</footer>
	</body>
</html>
