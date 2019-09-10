<?php

require_once './config/DB_conn.php';
require_once './admin/Classes/Slides.php';
require_once './admin/Classes/Image.php';
require_once './admin/Classes/News.php';
require_once './admin/Classes/ContactUs.php';
require_once './admin/Classes/Events.php';
require_once './admin/Classes/Cards.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SU Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS style -->
    <link rel="stylesheet" href="style/output.css">
    <link rel="shortcut icon" href="img/logo/group-4.png">
    <!--  FontAwesome   -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i,600,600i,700,700i,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,700i,800,900&display=swap" rel="stylesheet">
    <!-- Bootstrap links-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--  Js File      -->
    <script src="js_src/Js.js"></script>
    <!--  jQuery CDN   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  </head>
  <body>
    <?php
    require_once 'header.php';
    ?>
    <!--            END OF THE HEADER      -->
    <?php
    if (isset($_GET['submitForm'])) {
      $fullName = $_GET['fullName'];
      $phoneNumber = $_GET['phoneNumber'];
      $email = $_GET['email'];
      $message = $_GET['message'];

      $cont = new ContactUs();
      $cont->insert($fullName, $phoneNumber, $email, $message);

      header("location: index.php");
    }
    ?>

    <?php
    $slideImage = new Image();

    $slide = new Slides();
    $slideRows = $slide->select();
    $slideRowsLength = count($slideRows);
    $minOrder = $slide->selectMinOrder();
    // print_r($minOrder);die;
    //print_r($slideRows);die;
    ?>

    <!--      SLIDER       -->
    <div class="slider-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- The slideshow -->
            <div class="carousel-inner">
              <?php
              foreach ($slideRows as $row) {
                $res1 = $slideImage->selectOne($row['imgID']);
//                print_r($res1);die;
                ?>
                <div class="carousel-item <?php
                if ($row['slideOrder'] == $minOrder) {
                  echo 'active';
                } else {
                  echo null;
                }
                ?>">

                  <img src = img/<?php echo $res1['source'] ?> alt="IT Faculty">           
                  <div class="box">
                    <?php
                    echo $row['slideText'];
                    ?>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
            <!-- Indicators -->
            <ul class="carousel-indicators dots ">
              <?php
              for ($index = 0; $index < $slideRowsLength; $index++) {
                if ($index == 0) {
                  ?>
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <?php } else {
                  ?>

                  <li data-target="#myCarousel" data-slide-to="<?php echo $index ?>"></li>
                  <?php
                }
              }
              ?>

            </ul>
          </div>
        </div>
      </div>          
    </div>

    <!--            END OF SLIDER          -->



    <div class="imgs-wrapper">
      <div class="container">
        <div class="row">
          <!--      Cards Section       -->
          <?php
          $cardImage = new Image();
          $card = new Cards();

          $cardRows = $card->selectCards();

//          echo '<pre>';
//          print_r($rows);
//          echo '</pre>';
//          die;
          ?>
          <div class="col-xl-6 ">
            <div class="row row-imgs">
              <?php
              foreach ($cardRows as $row1) {
                $res2 = $cardImage->selectOne($row1['imgID']);
//                print_r($res2);
//                die;
                ?>
                <div class="col-md-6">
                  <div class="content-wrapper">

                    <div>
                      <a href="<?php echo $row1['url']; ?>"><img  src = img/<?php echo $res2['source'] ?> class="b-img">
                        <div class="img-title"><?php echo $row1['title']; ?></div></a>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>

            </div>
          </div>

          <!-- News Section-->

          <?php
          $news = new News();
          $newsRows = $news->selectNews();
          // print_r($newsRows);die;
          ?>
          <div class="col-xl-6 ">
            <div class="row">
              <div class="articls">
                <h1><a class="news">NEWS</a></h1>
                <?php
                $len = count($newsRows);
                $i = 0;
                foreach ($newsRows as $row2) {
                  ?>
                  <article>

                    <span><?php echo $row2['DATE_FORMAT(date,"%M %e %Y")']; ?></span>

                    <a href="news.php?newsID=<?php echo $row2['id']; ?>"><p class="title"><?php echo $row2['title']; ?></p></a>

                    <p class="articls-content"><?php echo substr($row2['body'], 0, 140) . "..." ?> </p>
                    <a class="read-more" href="news.php?newsID=<?php echo $row2['id']; ?>">read more</a>
                    <br>
                    <?php
                    if ($i != $len - 1) {
                      echo '<hr>';
                    }
                    $i++;
                    ?>

                  </article>
                  <?php
                }
                ?>
              </div>
            </div>
          </div>

          <!--            End of News Section      -->
        </div>
      </div>
    </div>

    <!--            Numbers Section         -->
    <div class="numbers-wrapper">
      <div class="container">
        <div class="row section">
          <div class="col-lg-4  section-img">
            <div class="numbers-content">
              <img src="img/bitmap/group-11.png" class="content-img"><br>
              <span class="num count-number" data-to="90" data-speed="1500"></span><span>+</span>                       
              <p class="content-text"> Profession-ready degree programs</p>
            </div>
          </div>
          <div class="col-lg-4 section-img">
            <div class="numbers-content">
              <img src="img/bitmap/group-12.png" class="content-img"><br>
              <span>#</span><span class="num count-number" data-to="1" data-speed="1500"></span>                      
              <p class="content-text">Our MBA for salary-to-debt ratio</p>
            </div>
          </div>
          <div class="col-lg-4 section-img">
            <div class="numbers-content">
              <img src="img/bitmap/noun-64173-cc.png" class="content-img"><br>
              <span class="num count-number" data-to="100000" data-speed="1500"></span>                      
              <p id="last-content"> Sciences University alumni Worldwide</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--               End of Numbers              -->

    <?php
    $eventImage = new Image();
    $event = new Events();
    $eventRows = $event->selectEvent();
    ?>
    <!--               Events Section              -->
    <div class="events-wrapper">
      <div class="container">
        <div class="h-name">
          <h2><a href="allEvents.php" class="news">events</a></h2>
        </div>
        <div class="row">
          <?php
          foreach ($eventRows as $row3) {

            $res = $eventImage->selectOne($row3['imgID']);
//            print_r($res['source']);
//            die;



            $date = $row3['DATE_FORMAT(content.date,"%M %e %Y")'];
            $startTime = $row3['startTime'];
            $startTime = date('h:i a', strtotime($startTime));
            $endTime = $row3['endTime'];
            $endTime = date('h:i a', strtotime($endTime));
            $fullTime = $startTime . ' ' . '-' . ' ' . $endTime;
            $month = substr($date, 0, stripos($date, ' '));
            $monLength = strlen($month);
            $day = substr($date, $monLength, 3);
            ?>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 events">
              <div class="event">
                <div>
                  <a href="scienceUniversityEvent.php?eventID=<?php echo $row3['id']; ?>">
                    <img src = img/<?php echo $res['source'] ?> class="event-img">
                  </a>
                  <img src="img/shape/shape-copy.png" class="shape">
                  <p class="shape-num"><?php echo $day; ?></p>
                  <p class="shape-text"><?php echo $month; ?></p>
                </div>
                <div class="event-content">
                  <div>
                    <span class="event-date time"> 
                      <?php
                      echo $fullTime;
                      ?>.</span>
                    <span class="event-date"><?php echo $row3['campus']; ?></span>
                  </div>
                  <div>
                    <a href="scienceUniversityEvent.php?eventID=<?php echo $row3['id']; ?>">
                      <h6><?php echo $row3['title']; ?></h6>
                    </a>
                  </div>
                  <div class="event-text">
                    <?php
                    echo substr($row3['body'], 0, 110) . "...";
                    ?>
                  </div>
                  <div class="event-read-more">
                    <a href="scienceUniversityEvent.php?eventID=<?php echo $row3['id']; ?>"> learn more </a>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!--              The End of Events Section             -->

    <!--               Apply Content                        -->
    <div class="apply">
      <div class="container">
        <div class="apply-content">
          admissions are now open for 2017/2018 intake
        </div>
        <div class="apply-now">
          <button id="apply-btn" class="btn-hover"> apply now!</button>
        </div>
      </div>
    </div>
    <!--               Apply Content End         -->


    <!--               Form Section              -->

    <div class="form-wrapper">
      <div class="container">
        <div class="form">
          <div class="alert-wrapper">
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Thank You For Filling out Our Form!
            </div>
          </div>
          <div class="h-name">
            <h2><span id="get-in-touch">get in touch</span></h2>
          </div>
          <form action="/" method="GET" id="s-form">
            <div class="f-row">
              <input type="text" name="fullName" placeholder="Full Name" required>
              <input type="tel" name="phoneNumber" placeholder="Phone Number" pattern="[0-9]{10}" required>
            </div>
            <div class="s-row">
              <input type="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>
            <div class="t-row">
              <textarea rows="7" name="message" placeholder="Message" maxlength="50"></textarea>
            </div>
            <span id="chars">50</span><span id="chars-text"> Characters Remaining</span>
            <div class="btn">
              <button type="submit" name="submitForm" class="btn-hover" id="sumbit-btn">SUBMIT</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--            End of Form Section            -->

    <!--            END OF THE BODY               -->
    <?php
    require_once 'footer.php';
    ?>

  </body>
</html>
