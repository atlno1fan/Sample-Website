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

    <!--has to be here for slideshow to work -->
    <style type="text/css">
      .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        transition: background-color 0.6s ease;
      }

      .active {
        background-color: #717171;
      }
      .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
      }

      @-webkit-keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
      }

      @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
      }

      /* On smaller screens, decrease text size */
      @media only screen and (max-width: 300px) {
        .text {font-size: 11px}
      }
    </style> 
  </head>

  <body>

  <header>
    <div id="header-container">
      <div class= img-container>
        <a href="Index.php"><img id="logo" src="Images/Logo1.png"></a>
      </div><!--end of img-container -->
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
      </div><!--end of nav-container -->
    </div><!--end of header-container -->
  </header>

  <div class="main-container">
    <section class="ordering-section">
      <h1>Popular Items</h1>
      <div class="popular-items-container">
        
        <div class="item-container">
          <a href="http://localhost/SELabProject/OrderPage.php?Item_ID=12"><img src="Images/earl grey.png" alt="item1">
          <h2>Earl Grey</h2></a>
        </div><!--end of item-container -->
        
        <div class="item-container">
          <a href="OrderPage.php?Item_ID=31"><img src="Images/iced-coffee-png-12.png" alt="item2">
          <h2>Mochaccino</h2></a>
        </div><!--end of item-container -->
        
        <div class="item-container">
          <a href="OrderPage.php?Item_ID=3"><img src="Images/cappuccino.png" alt="item3">
          <h2>Cappuccino</h2></a>
        </div><!--end of item-container -->
      </div><!--end of main-container -->
      <a href="Location_page.php"><button>Start Your Order!</button></a>
    </section>


    <section class="promo-section">
      <div>
        <p>Promotions</p>
        <div class="slideshow-container">
          <div class="mySlides fade">
            <img src="Images/1.jfif">
          </div><!--end of slideshow-container -->

          <div class="mySlides fade">
            <img src="Images/2.jfif">
          </div><!--end of slideshow-container -->
        </div>
        <div style="text-align:center">
  <!-- Dots are invisible but have to be there for javascript -->
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>
      </div>
    </section>

  </div><!--end of main-container -->
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
    </div><!--end of footer-container -->
  </footer>

  <script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}    
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active";
      setTimeout(showSlides, 4000); // Change image every 4 seconds
    }
  </script>
  </body>

</html> 
