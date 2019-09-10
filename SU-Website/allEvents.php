<!DOCType html>
<?php
require_once './config/DB_conn.php';
require_once './admin/Classes/Events.php';
require_once './admin/Classes/Image.php';
?>
<html>
  <head>
    <title>Events</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/output.css">
    <link rel="stylesheet" href="style/inner_pages_style/academics.css">
    <link rel="shortcut icon" href="img/logo/group-4.png">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i,600,600i,700,700i,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,700i,800,900&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--Js File -->
    <script src="js_src/Js.js"></script>
    <!-- jQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>

    <?php
    require_once ("header.php");
    ?>

    <div class="body-wrapper">
      <div class="container">
        <div class="academic-title">
          <h2>Event Calendar</h2>
        </div>
        <div class="para">
          <p>Upcoming events happening on the Sciences campus</p>
        </div>
      </div>

      <?php
      $eventImage = new Image();
      $event = new Events();
      $rows3 = $event->selectAllEvent();
      ?>
      <!--               Events Section              -->
      <div class="events-wrapper">
        <div class="container">
          <div class="h-name">
            <h2><a href="#" class="news">events</a></h2>
          </div>
          <div class="row">
            <?php
            foreach ($rows3 as $row3) {

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
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 events mb-4">
                <div class="event" >
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
                      echo substr($row3['body'], 0, 110) . "...";;
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

    </div>

    <?php
    require_once ("footer.php");
    ?>

  </body>
</html>
