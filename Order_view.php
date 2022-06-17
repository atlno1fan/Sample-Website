<?php
session_start();
require 'Additional_files/database_handler_script.php';
$order_ID = $_POST['orderID'];

if(!isset($_SESSION['Username'])){
  header("Location: index.php");
  exit();
}

$sql = "SELECT * FROM order_items WHERE Order_ID = {$order_ID}";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

?>
<!DOCTYPE html>
<html>

  <head>
      <link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="Admin_view_style.css">
      <style>

      .btn button {
      	width: 300px;
      	padding: 10px;
      }

      .btn button a{
      	text-decoration: none;
      	color: #000000;
      	padding: 10px 5px 10px 5px;
      }

      button a:hover, button a:focus{
      	color: #ffffff;
      }
  	</style>
  </head>
  <body>
    <div class="container">
      <div class="menu_items">
        <nav>
          <ul>
            <li><img id="logo" src="Images/Logo1.png"></li>
            <li><a href="barista_homepage.php">Orders to be Prepared</a></li>
            <li><a href="Inventory_update.php">Update Inventory</a></li>
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
      </div><!--end of menu_items -->
    <div class="main_container">
      <div class="main">
        <div class="partition-2">
          <div class= "recent">
	        	<h2>Order Details for Order ID <?php echo"{$order_ID}" ?></h2>
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
		        			if (mysqli_num_rows($result) > 0) {
		        				$number = 1;
		        				$Total = 0;
		        				$itemTotal = 0;
		        				while($row = mysqli_fetch_array($result)){
		        						$Item_ID = $row['Item_ID'];
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

		        							echo "<td>{$Quantity}</td>";

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
		        				}
		        			}
		        			echo "<tr><td><td/>
		        					<td><td/>
		        					<td></td>
		        					<td><b>Total</b></td>
		        					<td><b>RM {$total_dispalyed}<b></td></tr>";
		       			?>
	       		</tbody>
	        </table>
	        <br>
	        <?php
	        echo "<form action='Additional_files/barista_actions.php' method='post' class='btn'>
		        					<input type='text' value='{$order_ID}' name='orderID' hidden>
		        					<button type= 'submit' name='change_order_status'>Order Ready</button>
		        					<button><a href='barista_homepage.php'>Go Back To Available Orders</a></button>
		        					</form>";
	        ?>
            </div><!-- end of recent-->
          </div><!-- end of partition-2 -->
        </div><!-- end of main-->
      </div><!-- end of main-container-->
    </div><!-- end of container-->  
  </body>
</html>