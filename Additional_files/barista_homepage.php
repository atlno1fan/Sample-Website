<?php session_start();
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, intial-scale =1">
    <link rel="stylesheet" type="text/css" href="Header-Footer-style.css">
    <link rel="stylesheet" type="text/css" href="Home-style.css">
    <link href="https://fonts.googleapis.com/css?family=Sanchez|Zilla+Slab&display=swap" rel="stylesheet">
  </head>

  <body>

  <header>
    <div id="header-container">
      <div class= img-container>
        <a href="Index.php"><img id="logo" src="Images/Logo1.png"></a>
      </div>
      <div class="nav-container">
        <nav>
          <ul>
            <li><a href="Index.php" class="current-page">Home</a></li>
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
      </div>
    </div>
  </header>

  <div class="main-container">
    <section class="ordering-section">
      <a href="Inventory_update.php"><button>Update Item Inventory Quantity</button></a>
      <a href="View_orders.php"><button>View Available Orders</button></a>
    </section>

  </div>
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
