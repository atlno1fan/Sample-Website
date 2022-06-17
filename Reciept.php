<?php session_start();
require 'Additional_files/database_handler_script.php';

$sql = "SELECT * FROM order_items WHERE Order_ID ='".$_SESSION['Order_ID']."'";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

?>

<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="cart-style.css">
    	<link rel="stylesheet" type="text/css" href="Signup-style.css">
    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
    	<!-- has to be here for buttons to display properly-->
    	<style>
			.btn{
				color: #000000;
				text-decoration: none;
				padding: 25px 92px 25px 92px;
			}

			.link {
				padding: 10px;
				text-decoration: none;
				color: #000000;
			}

			.btn:hover, .btn:focus, .link:focus, .link:hover {
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
					<h1>Reciept</h1>
					<h2>Thanks for Ordering! Your order will be delivered soon!</h2>
					<?php 
			        	$sql = "SELECT * FROM order_info WHERE Order_ID ='".$_SESSION['Order_ID']."'";
						$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

				        if (mysqli_num_rows($result) > 0) {
		        			while($row = mysqli_fetch_array($result)){
		        				$Location_details = $row['Location_comment']; 
								$sql = "SELECT * FROM delivery_locations WHERE Location_ID = {$row['Location_ID']}";
								$value = mysqli_query($conn,$sql) or die ("Bad Query: $sql");
								if (mysqli_num_rows($value) > 0) {
		        					while($row = mysqli_fetch_array($value)){
										echo "<p><b>Chosen Location:</b> {$row['Location_name']} <br><p><b>Location Details:</b> {$Location_details}<br>";
									}
								}
							}
						}
					?>
					<table class="table-style">
		    		<thead>
						<tr>
							<th></th>
							<th>Item Name</th>
							<th>Item Price</th>
							<th>Item Quantity</th>
							<th>Add on</th>
							<th>Add on Price </th>
							<th>Item Total Price</th>
						</tr>
					</thead>
					<tbody>
			      			<?php
			      				$sql = "SELECT * FROM order_items WHERE Order_ID ='".$_SESSION['Order_ID']."'";
								$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");
			        			if (mysqli_num_rows($result) > 0) {
			        				$number = 1;
			        				$Total = 0;
			        				$itemTotal = 0;
			        				while($row = mysqli_fetch_array($result)){
			        						$Item_ID = $row['Item_ID'];
			        						$Order_ID = $row['Order_ID'];
			        						$Addon_ID = $row['Addon_ID'];
			        						$Quantity = $row['Quantity'];

			        					echo"<tr>
			        						<td>{$number}</td>";
			        							$sql = "SELECT * FROM item_info WHERE item_ID ='".$Item_ID."'";
												$values = mysqli_query($conn, $sql) or die("Bad Query:$sql");
												if (mysqli_num_rows($values) > 0) {
			        								while($row = mysqli_fetch_array($values)){
			        									$Item_price = $row['Item_price'];
			        									echo "<td>{$row['Item_name']}</td>
			        									<td>RM {$row['Item_price']}</td>";
			        								}
			        							}

			        							echo "	
			        									<td>{$Quantity}</td>";

			        							$sql = "SELECT * FROM addons WHERE Addon_ID ='".$Addon_ID."'";
												$values = mysqli_query($conn, $sql) or die("Bad Query:$sql");
												if (mysqli_num_rows($values) > 0) {
			        								while($row = mysqli_fetch_array($values)){
			        									$Addon_price = $row['Addon_price'];
			        									echo "<td>{$row['Addon_name']}</td>
			        									<td>RM {$row['Addon_price']}</td>";
			        								}
			        							}

												$total_item_price = ($Item_price + $Addon_price)*$Quantity ;
												$total_to_be_dispalyed = sprintf("%0.2f",$total_item_price);
			        							echo "<td>RM {$total_to_be_dispalyed}</td>";
			        							
			        					echo"</tr>";
			        					$number = $number + 1;
			        					$Total = $total_item_price + $Total;
			        					$total_dispalyed = sprintf("%0.2f",$Total);
			        					$itemTotal = $itemTotal + $Quantity;

			        				}
			        			}
			        			echo "<tr><td></td><td></td><td></td><td></td><td></td>

			        					<td><b>Total</b></td>
			        					<td><b>RM {$total_dispalyed}<b></td></tr>";
			        					session_unset();
										session_destroy();
			       			?>
		       		</tbody>
		        </table>
		        <br>
						<div class="middle">
						<button><a href = "Index.php" class="link">Back Homepage</a></button></div><!-- end of middle-->
					
					
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
	    </div><!-- end of footer-container-->
  </footer>