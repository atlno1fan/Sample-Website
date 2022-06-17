<?php 
session_start();
require 'Additional_files/database_handler_script.php';

$sql = "SELECT * FROM item_info";
$result = mysqli_query($conn, $sql) or die("Bad Query:$sql");

if(!isset($_SESSION['Username'])){
  header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html>

  <head>
      <link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="Admin_view_style.css">
      <style>
      .btn {
      	display: flex;
      	justify-content: center;
      } 
      .btn input{
      	width:50%;
      }

      .btn button{
      	width: 20%;
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
              <h2>Item Inventory Update</h2>
              <div class="items-2">
		        	<table class="table-style">
		        		<thead>
		        			<th>No.</th>
		        			<th>Item Name</th>
		        			<th>Item Category</th>
		        			<th>Available Quantity</th>
		        		</thead>
		        		<tbody>
				        	<?php
				        		$number = 1;
				        		if (mysqli_num_rows($result) > 0) {
				        			while($row = mysqli_fetch_array($result)){
				        				echo"<tr>
				        						<td>{$number}</td>
				        						<td>{$row['Item_name']}</td>
				        						<td>{$row['Category']}</td>
				        						<td><form action='Additional_files/barista_actions.php' method='post' class='btn'><input value='{$row['Item_quantity']}' name='quantity' type='text'>
				        						<input value='{$row['Item_ID']}' name='itemID' type='text' hidden>
				        						<button type='submit' value='change_quantity'>Save changes</button>
				        						</form></td>
				        					</tr>";
				        				$number = $number + 1;
				        				}
				        			}
				        	?>
		        		</tbody>
		        	</table>
              </div><!-- end of items-2-->
            </div> <!-- end of recent-->
          </div><!-- end of partition-2 -->
        </div><!-- end of main-->
      </div><!-- end of main-container-->
    </div><!-- end of container-->
  </body>
</html>