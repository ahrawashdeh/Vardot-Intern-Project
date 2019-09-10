<?php

require_once 'Classes/User.php';

if (isset($_SESSION['username'])) {
  header('location: index.php');
}

$obj = new User();
$obj->login();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/loginstyle.css">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="../../style/output.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i,600,600i,700,700i,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,700i,800,900&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="../../js_src/Js.js"></script>
  </head>
  <body>

    <header>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-2">
            <div>
              <a href="../../index.php">
                <img src="../../img/logo/group-4.png" class="logo">
              </a>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-10">

            <div class="search-icon">
              <form id="f-form">
                <input type="text" placeholder="Type to Search" id="search" required>
                <input type="submit" id="search-submit">

              </form>
              <i class="fas fa-search type"></i>      
              <i class="fas fa-times back"></i>
            </div>

            <div class="social-icons">
              <a href="http://linkedin.com" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
              <a href="http://youtube.com" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
              <a href="http://instagram.com" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
              <a href="http://twitter.com" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
              <a href="http://facebook.com" target="_blank" class="facebook"><i class="fab fa-facebook-f facebook"></i></a>
            </div>
          </div>
        </div>
      </div>
      <!--        MENU        -->

      <div class="nav-wrapper">
        <div class="container-fluid">
          <div class="row">
            <nav class="navbar navbar-expand-md nav-color navbar-dark">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="m-auto navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="../../about.php">ABOUT</a>
                  </li>                                    
                  <li class="nav-item">
                    <a class="nav-link" href="../../academics.php">ACADEMICS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../../admission.php">ADMISSIONS</a>
                  </li>  
                  <li class="nav-item">
                    <a class="nav-link" href="../../news.php">NEWS</a>
                  </li>  
                  <li class="nav-item">
                    <a class="nav-link" href="../../event.php">EVENTS</a>
                  </li>  
                  <li class="nav-item">
                    <a class="nav-link" href="../../contact.php">CONTACT US</a>
                  </li>  
                </ul>
              </div>  
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!--     END OF THE MENU     -->
    <!--            END OF THE HEADER      -->
    <!--            END OF THE HEADER      -->


    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
          <img src="../../img/logo/group-4.png" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form method="POST" action="login.php">
          <input type="text" id="login" class="fadeIn second" name="username" placeholder="username" required>
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required>
<!--          <input type="submit" name="login" class="fadeIn fourth" value="Log In">-->
          <button name="login" type="submit" class="fadeIn fourth" >Log In</button>

          <?php
          if (isset($_POST['login'])) {
            if (isset($_SESSION['err'])) {
              echo '<div class="alert alert-danger">' . $_SESSION['err'] . '</div>';

              unset($_SESSION['err']);
            }
          }
          ?>

        </form>

        <!-- Remind Password -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

      </div>
    </div>

    <footer>
      <div class="top-footer">
        <div class="container">
          <div class="row row-eq-height">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="footer-content">
                <div class="footer-headings">
                  <h5 data-toggle="collapse" data-target=".footer-links1">explore</h5>
                </div>
                <ul class="footer-links footer-links1 collapse" >
                  <li>
                    <a href="#">Privacy and Cookies</a>
                  </li>
                  <li>
                    <a href="#">Legal Information</a>
                  </li>
                  <li>
                    <a href="#">About the University</a>
                  </li>
                  <li>
                    <a href="#">News and Events</a>
                  </li>
                  <li>
                    <a href="#">Research</a>
                  </li>
                  <li>
                    <a href="#">Schools and Departments</a>
                  </li>
                  <li>
                    <a href="#">International</a>
                  </li>
                  <li>
                    <a href="#">Job Vacancies</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="footer-content">
                <div class="footer-headings">
                  <h5 data-toggle="collapse" data-target=".footer-links2">quick links</h5>
                </div>
                <ul class="footer-links footer-links2 collapse">
                  <li>
                    <a href="#">Online Payments</a>
                  </li>
                  <li>
                    <a href="#">Library</a>
                  </li>
                  <li>
                    <a href="#">Alumni</a>
                  </li>
                  <li>
                    <a href="#">Community Information</a>
                  </li>
                </ul>
                <div id="using-our-site">
                  <h5 data-toggle="collapse" data-target=".footer-links3">using our site</h5>
                </div>
                <ul class="footer-links footer-links3 collapse">
                  <li>
                    <a href="#">Accessibilty</a>
                  </li>
                  <li>
                    <a href="#">Freedom of Information</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="footer-content">
                <div class="footer-headings">
                  <h5 data-toggle="collapse" data-target=".footer-links4">how to find us</h5>
                </div>
                <div class="find-us">
                  <ul class="footer-links4 collapse">
                    <li>
                      <a href="#"><i class="fas fa-phone"></i></a>
                      <span>+ 1 (408) 703 8738</span>
                    </li>
                    <li>
                      <a href="#"><i class="fas fa-phone"></i></a>
                      <span>+ 962 6 581 7612</span>
                    </li>
                    <li>
                      <a href="#"><i class="fas fa-envelope"></i></a>
                      <a href="mailto:info@SciencesUniversity.ed"><span class="email-contact">info@SciencesUniversity.edu</span></a>
                    </li>
                    <li>
                      <a href="#"><i class="fas fa-envelope"></i></a>
                      <a href="#"><span>Contact Us</span></a>
                    </li>
                    <li>
                      <a href="#"><i class="fas fa-map-marker-alt"></i></a>
                      <a href="#"><span>Find Us</span></a>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="footer-content">
                <div>
                  <a href="../../index.php"><img src="../../img/logo/group-19.png" id="footer-logo"></a>
                </div>
                <h5 id="follow-us">follow us</h5>
                <div class="footer-social-icons">
                  <a href="http://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                  <a href="http://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                  <a href="http://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                  <a href="http://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                  <a href="http://facebook.com" target="_blank"><i class="fab fa-facebook-f facebook"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copy-right">  
        &COPY; 2017 Sciences University All Right Reserved
      </div>
    </footer>


  </body>
</html>