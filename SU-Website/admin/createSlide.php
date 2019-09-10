<?php

session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/Slides.php';
//$db = new DB_conn();
//$conn = $db->connect();
$check_ = 0;
if (isset($_POST['submit'])) {

  $text = $_POST['text'];
  $order = $_POST['order'];
  $authorID = $_SESSION['authorID'];
  $alt = $_POST['alt'];

  $slide = new Slides();

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

  $imgName = $target;
  $c = 0;
  $target_file1 = $target_dir . basename($_FILES["image"]["name"]);
// Check if file already exists
  while (file_exists($target_file1)) {
    $imgName = $c . $target;
    $c++;
    $target_file1 = $target_dir . $imgName;
  }
  $target_file = $target_dir . $imgName;


//  if (file_exists($target_file)) {
//    echo "Sorry, file already exists.";
//    $uploadOk = 0;
//  }
// Check file size
//  if ($_FILES["image"]["size"] > 500000) {
//    echo "Sorry, your file is too large.";
//    $uploadOk = 0;
//  }
// Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
// Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      //header('Location: news.php');
    } else {
      //echo "Sorry, there was an error uploading your file.";
    }
  }


//  $image = $_FILES['image']['name'];
//  $target = basename($image);

  $slide->insertImg($authorID, $imgName, $alt);

  $result = $slide->selectImgId();
//  echo $result;die();

  $field = [
      'slideText' => $text,
      'slideOrder' => $order,
      'authorID' => $authorID,
      'imgID' => $result
  ];
  if ($slide->insert($field)) {
    $check_ = 1;
  }
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
      <li class="breadcrumb-item active">Add Slide</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">Add Slide</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="title" class="labels">Text</label>
          <input type="text" class="form-control" name="text" maxlength="50" aria-describedby="emailHelp" placeholder="Enter Slide Text" required>
        </div>
        <div class="form-group">
          <label for="title" class="labels">Order</label>
          <input type="number" class="form-control" name="order" min="1" aria-describedby="emailHelp" placeholder="Order" required>
        </div>
        <div class="form-group">
          <label for="image" class="labels">Image</label>
          <input type="file" name="image" class="form-control" placeholder="Image" required>
        </div>
        <div>
          <label for="image" class="labels">Alternative</label>
          <input type="text" name="alt" class="form-control" maxlength="15" placeholder="Alternative" required>
        </div><br>




        <input type="submit" name="submit" class="btn btn-primary">
        <!--              <button type="submit" class="btn btn-primary">Submit</button>-->
      </form>
    </div>

  </div>

<?php
require_once './footer.php';


if ($check_ == 1) {
  echo "<script type='text/javascript'>swal('Slide Added');</script>";
}
?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'slides.php';
  });
</script>
</html>
