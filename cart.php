<?php 
session_start();
require 'Additional_files/database_handler_script.php';

$sql = "SELECT * FROM order_items WHERE Order_ID ='".$_SESSION['Order_ID']."'";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");


?>


<!DOCTYPE html>
<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="Menu-display-style.css">

    	<link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
    	<style type="text/css">
    		.item img{
    			height: 120px;
    		}
    		.menu_items_container {
    			display: grid;
    			grid-template-columns: auto auto auto;
    			justify-content: center;
    		}
    		.item{
    			
    			text-align: left;
    			
    			border: 2px solid #000000;
    			margin: 10px;
    			padding: 10px;
    		}

    		.item button{
    			background-color: #ffffff;
    			border: 2px solid #000000;
    			font-size: 1.05em;
    			width: 30px;
    			margin: 5px;
    		}
    		.item input{
    			border: 2px solid #000000;
    		}
    		.middle {
    			justify-content: center;
    			text-align: center;
    		}

    		.butt button{
				padding: 15px;
				margin: 0 auto;
				font-size: 1.15em;
				background-color: #ffffff;
				border: 2.5px solid #0f0f0f;
				font-family: 'Sanchez', serif;
				font-weight: 700;
				color: #0f0f0f;
				border-radius: 8px;
				-webkit-transition-duration: 0.4s;
			    transition-duration: 0.4s;
			    transition: transform 1s;
			}

			.butt a{
				text-decoration: none;
				color: #000000;
				padding: 15px;
			}
			.butt button:hover,.butt button:focus, .butt a:hover, .butt a:focus{
				background-color:#0f0f0f;
				border-radius: 8px;
				color: #ffffff;
				transform: scale(0.90);
			}
    	</style>
  	</head>

	<body>

	    <header>
		    <div id="header-container">
		      <div class= img-container>
		        <a href="Index.php"><img id="logo" src="Images/Logo1.png"></a>
		      </div><!--end of img-container-->
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
		      </div><!--end of nav-container-->
		    </div><!--end of header-conatiner-->
		</header>

		<div class="main-container">
		    <section class="menu-section">
		      	<h1>Cart</h1>
		      	<div class="menu-items-container">
		        	<?php
			        			if (mysqli_num_rows($result) > 0) {
			        				$number = 1;
			        				$Total = 0;
			        				$itemTotal = 0;
			        				while($row = mysqli_fetch_array($result)){
			        						$Item_ID = $row['Item_ID'];
			        						$Order_ID = $row['Order_ID'];
			        						$Addon_ID = $row['Addon_ID'];
			        						$Quantity = $row['Quantity'];

			        					echo"<div class='item'><div>
			        					<form action='Additional_files/item_quantity_update_delete.php' method='post'>
			        						    	<input type = 'text' name = 'order_id' value = '{$Order_ID}' hidden>
			        								<input type = 'text' name = 'item_id' value = '{$Item_ID}' hidden>
			        								<input type = 'text' name = 'addon_id' value = '{$Addon_ID}' hidden>
			        								<button type='submit' name='delete_item'>-</button>{$number}</form></div>
			        						";
			        							$sql = "SELECT * FROM item_info WHERE item_ID ='".$Item_ID."'";
												$values = mysqli_query($conn, $sql) or die("Bad Query:$sql");
												if (mysqli_num_rows($values) > 0) {
			        								while($row = mysqli_fetch_array($values)){
			        									$Item_price = $row['Item_price'];
			        									echo "<div class='middle'><div><img src='Images/{$row['Item_pic_dir']}'></div><div>
			        									{$row['Item_name']}
			        									RM {$row['Item_price']}</div>";
			        								}
			        							}

			        							echo "<div><form action='Additional_files/item_quantity_update_delete.php' method='post'>	
			        									<button type='submit' name='quantity_increase'>+</button>
			        									<input type = 'text' name = 'quantity' value='{$Quantity}' readonly> 
			        									<input type = 'text' name = 'order_id' value = '{$Order_ID}' hidden>
			        									<input type = 'text' name = 'item_id' value = '{$Item_ID}' hidden>
			        									<input type = 'text' name = 'addon_id' value = '{$Addon_ID}' hidden>
			        									<button type='submit' name='quantity_decrease'>-</button>
			        								  </form></div>";

			        							$sql = "SELECT * FROM addons WHERE Addon_ID ='".$Addon_ID."'";
												$values = mysqli_query($conn, $sql) or die("Bad Query:$sql");
												if (mysqli_num_rows($values) > 0) {
			        								while($row = mysqli_fetch_array($values)){
			        									$Addon_price = $row['Addon_price'];
			        									echo "<div>Addon : {$row['Addon_name']}</div><div>
			        									Addon Price : RM {$row['Addon_price']}";
			        								}
			        							}

												$total_item_price = ($Item_price + $Addon_price)*$Quantity ;
												$total_to_be_dispalyed = sprintf("%0.2f",$total_item_price);
			        							echo "<br>Total Item Price: RM {$total_to_be_dispalyed}</div></div></div>";
			        							
			        					
			        					$number = $number + 1;
			        					$Total = $total_item_price + $Total;
			        					$total_dispalyed = sprintf("%0.2f",$Total);
			        					$itemTotal = $itemTotal + $Quantity;

			        				}
			        			}
			        			echo "</div><br><b>Order Total: RM {$total_dispalyed}<b><br>";
			       			?>
		        <br>
		        <?php
		        echo "<form action='Additional_files/checkout_script.php' method='post' class='butt'>
			        					<input type='text' value = '{$Total}' name='order_total' hidden>
			        					<input type='text' value = '{$itemTotal}' name='item_total' hidden>
			        					<button type= 'submit' name='checkout'>Checkout</button>
			        					<button><a href='Menu.php'>Go Back To Menu</a></button>
			        					</form>";
		        ?>
		    </section>
		    <br>
		</div><!--end of main-container-->
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
	</body>
</html>
