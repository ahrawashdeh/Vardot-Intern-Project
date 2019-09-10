<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/Cards.php';
//$db = new DB_conn();
//$conn = $db->connect();


if (isset($_GET['id'])) {
  $uid = $_GET['id'];
  $card = new Cards();
  $result = $card->selectOne($uid);
//  print_r($result);die;
//  echo $result['imgID'];die();
  try {
    $img = $card->retrieveImg($result['imgID']);
  } catch (Exception $ex) {
    
  }
//  var_dump($img);die;
}

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $url = $_POST['url'];
  $author = $_POST['author'];
  $authorID = $_SESSION['authorID'];

  $card = new Cards();


  $target_dir = "/var/www/html/science-university-website/SU-Website/img/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $target = basename($_FILES['image']['name']);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }
  }
// Check if file already exists
//  if (file_exists($target_file)) {
//    echo "Sorry, file already exists.";
//    $uploadOk = 0;
//  }
// Check file size
  if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
// Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
// Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      //header('Location: news.php');
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  if ($uploadOk == 1) {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image = $_FILES["image"]['name'];
    $alt = $_POST['alt'];
    $target = basename($image);
    $card->insertImg($authorID, $target, $alt);
    $imgId = $card->selectImgId();
  } else {
    $imgId = $result['imgID'];
  }

//  var_dump($_POST);die;
//  if (strlen($_POST['image']) == 0) {
//    $imgId = $result['imgID'];
//  } else {
//
//  }
//  print_r($target_file);die();
  //var_dump($img);die;
  $field = [
      'title' => $title,
      'url' => $url,
      'author' => $author,
      'authorID' => $authorID,
      'imgID' => $imgId
  ];

  $id = $_POST['id'];
//  $news->updateAlt($alt, $imgId);
  $card->update($field, $id);
}
?>
<?php
require_once './header.php';
?>
<div id="content-wrapper">

  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">View Cards</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">View Cards</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="Enter Title"
                 value="<?php echo $result['title']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="image">Image</label> <br>
          <img class="content-img" src="<?php echo '../img/' . $img['source']; ?>">
        </div>


        <div class="form-group">
          <label for="alt">Alternative</label>
          <input type="text" name="alt" class="form-control" placeholder="Alternative" value="<?php echo $img['alt'] ?>" disabled>
        </div>

        <div class="form-group">
          <label for="date">URL</label>
          <input type="text" name="url" class="form-control" placeholder="URL" value="<?php echo $result['url']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="author">Author</label>

          <input type="text" name="author" class="form-control" placeholder="Author" value="<?php echo $result['author']; ?>" disabled>
        </div>


      </form>
    </div>

  </div>
  <?php
  require_once './footer.php';
  ?>
</body>

</html>
