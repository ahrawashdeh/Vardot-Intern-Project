<?php
require_once './config/DB_conn.php';
require_once './admin/Classes/News.php';
require_once './admin/Classes/Image.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>News</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/output.css">
    <link rel="stylesheet" href="style/inner_pages_style//academics.css">
    <link rel="stylesheet" href="style/inner_pages_style/news-style.css">

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
    $id = $_GET['newsID'];
    $newsImage = new Image();
    $news = new News();
    $result = $news->selectOne($id);
    $imageResult = $newsImage->selectOne($result['imgID']);

    $newsResult = $news->selectAllNews();
    ?>

    <div class="body-wrapper">
      <div class="academic-title">
        <h2>Sciences University News</h2> 
      </div>

      <div class="news-wrapper">
        <div class="container">

          <div class="row">
            <div class="col-xl-4 col-lg-4">

              <div class="articls">
                <h1><a href="#" class="news">NEWS</a></h1>
                <?php
                $len = count($newsResult);
                $i = 0;
                foreach ($newsResult as $row2) {
                  ?>
                  <article>
                    <span class="date"><?php echo $row2['DATE_FORMAT(date,"%M %e %Y")']; ?></span>
                    <a href="news.php?newsID=<?php echo $row2['id'];?>"><p class="title"><?php echo $row2['title']; ?></p></a>
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

            <div class="col-xl-8 col-lg-8">
              <img src = img/<?php echo $imageResult['source'] ?> class="articls-img">
              <div class="art">
                <article>
                  <h2 class="articls-titles"><?php echo $result['title']; ?></h2>
                  <p>
                    <?php
                    echo $result['body'];
                    ?>
                  </p>

                </article>

              </div>
            </div>


          </div>

        </div>
      </div>
    </div>


    <?php
    require_once("footer.php");
    ?>
  </body>
</html>
