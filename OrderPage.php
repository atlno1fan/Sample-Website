<?php 
session_start();

if(!isset($_SESSION['Order_ID'])){
	header("Location: Location_page.php");
    exit();
}
if(isset($_GET['Item_ID'])) {
	require 'Additional_files/database_handler_script.php';

	$id = mysqli_real_escape_string($conn, $_GET['Item_ID']);

	$sql = "SELECT * FROM item_info WHERE Item_ID ='$id'";
	$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");
	$result = mysqli_fetch_array($result);
}
?>
<!DOCTYPE html>
<html>

  	<head>
    	<link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    	<link rel="stylesheet" type="text/css" href="Ordering-style.css">
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
		      	<h1>Specify Order Details</h1>
		      	<div class="popular-items-container">
		     	   <div class="item-container">
						<img src='Images/<?php echo $result['Item_pic_dir'] ?>' alt='item img'}>
						<h2><?php echo $result['Item_name'] ?></h2>
						<h2>RM <?php echo $result['Item_price']?></h2>
				        <form action="Additional_files/item_addition_script.php" method="post">
				        	<input type="text" name="item_name" value= "<?php echo $result['Item_name'] ?>" hidden>
				        	<input type="text" name="item_ID" value= "<?php echo $result['Item_ID'] ?>" hidden>
							<input type="text" name="item_price" value= "<?php echo $result['Item_price'] ?>" hidden>
							<input type="text" name="order_id" value= "<?php $_SESSION['Order_ID'] ?>" hidden>
				        	<p>Addons RM 1.50</p>
		  					<select name="addon">
							<?php 

							$sql = "SELECT * FROM addons";
							$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");
							if (mysqli_num_rows($result) > 0) {
				        		while($row = mysqli_fetch_array($result)){
									echo "<option value='{$row['Addon_ID']}'>{$row['Addon_name']}</option>";
								}
							}
							?>
							</select>
							<select name = quantity>
								<option value = "1">1</option>
								<option value = "2">2</option>
								<option value = "3">3</option>
								<option value = "4">4</option>
								<option value = "5">5</option>
								<option value = "6">6</option>
								<option value = "7">7</option>
								<option value = "8">8</option>
								<option value = "9">9</option>
								<option value = "10">10</option>
							</select>

		      		</div><!-- end of item-container-->
				</div><!-- end of popular-items-container-->
          <!-- Submission or Cancellation -->
            <button type="submit" name="order_submit">Add to Cart</button>
        	</form>
        	<a href="Menu.php"><button name="cancel">Go back to Menu</button></a>
		    </section>
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