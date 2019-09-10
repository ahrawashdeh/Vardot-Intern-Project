<?php
require_once './config/DB_conn.php';
require_once './admin/Classes/Events.php';
require_once './admin/Classes/Image.php';
require_once './admin/Classes/News.php';
?>
<!DOCTYPE html>
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
    require_once("header.php");
    ?>
    <?php
    $id = $_GET['eventID'];

    $news = new News();
    $result = $news->selectOne($id);

    $eventImage = new Image();
    $event = new Events();
    $eventResult = $event->selectEventById($id)[0];
//    print_r($eventResult);die;
    $imageResult = $eventImage->selectOne($eventResult['imgID']);

    
    $date = $eventResult['DATE_FORMAT(content.date,"%M %e %Y")'];
    $startTime = $eventResult['startTime'];
    $startTime = date('h:i a', strtotime($startTime));
    $endTime = $eventResult['endTime'];
    $endTime = date('h:i a', strtotime($endTime));
    $fullTime = $startTime . ' ' . '-' . ' ' . $endTime;
    $month = substr($date, 0, stripos($date, ' '));
    $monLength = strlen($month);
    $day = substr($date, $monLength, 3);
    ?>
    <!-- End of the Header-->

    <div class="body-wrapper">
      <div class="academic-title">
        <h2>Sciences University Events</h2>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="card">
              <img src = img/<?php echo $imageResult['source'] ?> class="card-img-top" alt="...">
              <img src="img/shape/shape-copy.png" class="shape">
              <p class="shape-num"><?php echo $day?></p>
              <p class="shape-text"><?php echo $month?></p>
              <div class="card-body">                
                <div>
                  <span class="event-date time"> <?php echo $fullTime?>.</span>
                  <span class="event-date"><?php echo $eventResult['campus'] ?></span>
                </div>
                <div>
                  <a href="#">
                    <h6><?php echo $eventResult['title'];?></h6>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <article>
              <h4><?php echo $eventResult['title'];?></h4>
              <?php 
                  echo $eventResult['body'];
              ?>
            </article>

          </div>
        </div>
      </div>
      <br><br>

    </div>


<?php
require_once("footer.php");
?>

  </body>
</html>
