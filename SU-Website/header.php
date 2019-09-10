<?php
require_once './config/DB_conn.php';
require_once './admin/Classes/MenuItem.php';
?>
<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-2">
        <div>
          <a href="index.php">
            <img src="img/logo/group-4.png" class="logo">
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
  <?php
  $id = 24;
  $menuItem = new MenuItem();
  $headers = $menuItem->selectMenuItemById($id);
  //print_r($headers);die;
  ?>
  <div class="nav-wrapper">
    <div class="container-fluid">
      <div class="row">
        <nav class="navbar navbar-expand-md nav-color navbar-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="m-auto navbar-nav">
              <?php
              foreach ($headers as $header) {
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $header['url'] ?>"><?php echo $header['title'] ?></a>
                </li>   
                <?php
              }
//                
              ?>

            </ul>
          </div>  
        </nav>
      </div>
    </div>
  </div>
</header>
<!--     END OF THE MENU     -->
<!--            END OF THE HEADER      -->