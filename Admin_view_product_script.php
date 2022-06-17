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
							<h2>Products</h2>
							<div class="items-2">
								<?php 
									if (isset($_POST['update_item'])) {
										$itemID = $_POST['item_id'];
										$sql = "SELECT * FROM item_info WHERE Item_ID = {$itemID}";
										$result = mysqli_query($conn,$sql) or die("Bad Query:$sql");


										if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_array($result)){
												echo "
												
												<form action='Additional_files/Admin_view_script.php' method='post'>
												<p>Update Item Information</p>
												<p>Item Name</p><input type = 'text' name = 'item_name' value = '{$row['Item_name']}' required>
												<input type = 'text' name = 'item_id' value = '{$itemID}' hidden>
												<br>";

												if($row['Category'] == "ice_blended"){
													echo "<p>Item Category</p><div class='radio-btn'><input type='radio' name='item_category' value='ice_blended' checked>Ice Blended
  													<input type='radio' name='item_category' value='hot_beverages'>Hot Beverages
  													<input type='radio' name='item_category' value='cold_beverages'>Cold Beverages
  													<input type='radio' name='item_category' value='meals'>Meals
													<input type='radio' name='item_category' value='desserts'> Desserts</div>";
												}
												else if($row['Category'] == "hot_beverages"){
													echo "<p>Item Category</p><div class='radio-btn'><input type='radio' name='item_category' value='ice_blended'>Ice Blended
  													<input type='radio' name='item_category' value='hot_beverages' checked>Hot Beverages
  													<input type='radio' name='item_category' value='cold_beverages'>Cold Beverages
  													<input type='radio' name='item_category' value='meals'>Meals
													<input type='radio' name='item_category' value='desserts'> Desserts</div>";
												}
												else if($row['Category'] == "cold_beverages"){
													echo "<p>Item Category</p><div class='radio-btn'><input type='radio' name='item_category' value='ice_blended'>Ice Blended
  													<input type='radio' name='item_category' value='hot_beverages'>Hot Beverages
  													<input type='radio' name='item_category' value='cold_beverages' checked>Cold Beverages
  													<input type='radio' name='item_category' value='meals'>Meals
													<input type='radio' name='item_category' value='desserts'> Desserts</div>";
												}
												else if($row['Category'] == "meals"){
													echo "<p>Item Category</p><div class='radio-btn'><input type='radio' name='item_category' value='ice_blended'>Ice Blended
  													<input type='radio' name='item_category' value='hot_beverages'>Hot Beverages
  													<input type='radio' name='item_category' value='cold_beverages'>Cold Beverages
  													<input type='radio' name='item_category' value='meals' checked>Meals
													<input type='radio' name='item_category' value='desserts'> Desserts</div>";
												}
												else if($row['Category'] == "desserts"){
													echo "<p>Item Category</p><div class='radio-btn'><input type='radio' name='item_category' value='ice_blended'>Ice Blended
  													<input type='radio' name='item_category' value='hot_beverages'>Hot Beverages
  													<input type='radio' name='item_category' value='cold_beverages'>Cold Beverages
  													<input type='radio' name='item_category' value='meals'>Meals
													<input type='radio' name='item_category' value='desserts' checked> Desserts</div>";
												}
												echo "
												<br>
												<p>Item Price</p><input type = 'text' pattern = '\d+(\.\d{2})?' title= 'Price has to be in two decimal space' name = 'item_price' value = '{$row['Item_price']}' required>
												<br>
												<p>Item Picture Name</p><input type = 'text' pattern='^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$' title = 'Please enter a valid file name' name = 'item_pic' value = '{$row['Item_pic_dir']}' required>
												<br>
												<p>Item Quantity</p><input type = 'text' name = 'item_quantity' pattern ='[0-9]+' title='Please enter a valid number' value = '{$row['Item_quantity']}' required>
												<br><br>
												<button type='submit' name='update_item' class='big_btn'>Confirm Update</button> <br>
												<button name='back' class='big_btn'><a href = 'Admin_view_products.php' class='btn'>Go Back</a></button>
												</form>";
											}
										}

									}

									if (isset($_POST['add_item'])) {

												echo "
												
												<form action='Additional_files/Admin_view_script.php' method='post'>
												<p>Add New Item</p>
												<p>Item Name</p><input type = 'text' name = 'item_name' value = '' placeholder='Item Name' required>
												<br>
												<p>Item Category</p>
												<select name = 'item_category' required>
													<option value = 'hot_beverages'>Hot Beverages</option>
													<option value = 'cold_beverages'>Cold Beverages</option>
													<option value = 'ice_blended'>Ice Blended</option>
													<option value = 'desserts'>Desserts</option>
													<option value = 'meals'>Meals</option>
												</select>
												<br>
												<p>Item Price</p><input type = 'text' name = 'item_price' pattern = '\d+(\.\d{2})?' title= 'Price has to be in two decimal space' value = '' placeholder='Item Price' required>
												<br>
												<p>Item Picture Name</p><input type = 'text' name = 'item_pic' value = ''  pattern='^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$' title = 'Please enter a valid file name' placeholder='Item Picture Name' required>
												<br>
												<p>Item Quantity</p><input type = 'text' name = 'item_quantity' pattern ='[0-9]+' title='Please enter a valid number' value = '' placeholder='Item Quantity Available' required>
												<br><br>
												<button type='submit' name='add_item' class='big_btn'>Add Item</button> <br>
												<button name='back' class='big_btn'><a href = 'Admin_view_products.php' class='btn'>Go Back</a></button>
												</form>";
									}

									if(isset($_POST['delete_item'])){
										$itemID = $_POST['item_id'];
										$sql = "SELECT * FROM item_info WHERE Item_ID = {$itemID}";
										$result = mysqli_query($conn,$sql) or die("Bad Query:$sql");


										if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_array($result)){

												echo"
												<form action='Additional_files/Admin_view_script.php' method='post'>
												<p>Are you sure you want to delete this record?</p>
												<p>Name: {$row['Item_name']}</p>
												<p>Price: RM{$row['Item_price']}</p>
												<p>Item Picture:<br> <img src='Images/{$row{'Item_pic_dir'}}'></p>
												<p>Item Category: {$row['Category']}</p>
												<p> Item Quantity: {$row['Item_quantity']}</p>
												<input type = 'text' name = 'item_id' value = '{$itemID}' hidden>
												<button type='submit' name='delete_item' class='big_btn'>Delete Item</button> <br>
												<button name='back' class='big_btn'><a href = 'Admin_view_products.php' class='btn'>Go Back</a></button>
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