<?php
$id = 25;
$menuItem = new MenuItem();
$footers = $menuItem->selectParent($id);
//print_r($footers);
//die;
?>
<footer>
  <div class="top-footer">
    <div class="container">
      <div class="row row-eq-height">
        <?php
        foreach ($footers as $footer) {
          ?>
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="footer-content">

              <div class="footer-headings">
                <h5 data-toggle="collapse" data-target=".footer-links1"><?php echo $footer['title']; ?></h5>
              </div>

              <ul class="footer-links footer-links1 collapse" >
                <?php
                $childs = $menuItem->selectChilds($footer['id']);
//              print_r($childs);die;
                foreach ($childs as $child) {
                  ?>
                  <li>
                    <a href="#"><?php echo $child['title']; ?></a>
                  </li>

                  <?php
                }
                ?>
              </ul>
            </div>
          </div>
          <?php
        }
        ?>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="footer-content">
            <div>
              <a href="index.php"><img src="img/logo/group-19.png" id="footer-logo"></a>
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
</div>
<div class="copy-right">  
  &COPY; 2017 Sciences University All Right Reserved
</div>
</footer>