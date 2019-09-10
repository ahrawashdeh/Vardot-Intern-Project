<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/Events.php';
//$db = new DB_conn();
//$conn = $db->connect();

$check_ = 0;
if (isset($_GET['id'])) {
  $uid = $_GET['id'];
  $event = new Events();
  $result = $event->selectOne($uid);

// print_r($result);die;
//  echo $result['imgID'];die();
  try {
    $content = $event->retrieveContent($result['contentID']);
    //print_r($content);die;
    $img = $event->retrieveImg($content['imgID']);
  } catch (Exception $ex) {
    
  }

//  var_dump($img);die;
}

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $body = $_POST['body'];
  $startTime = $_POST['startTime'];
  $endTime = $_POST['endTime'];
  $date = $_POST['date'];
  $campus = $_POST['campus'];
  $author = $_POST['author'];
  $authorID = $_SESSION['authorID'];
  $alt = $_POST['alt'];

  $event = new Events();


  $target_dir = "/var/www/html/science-university-website/SU-Website/img/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $target = basename($_FILES['image']['name']);
  if ($target === null) {
    $target = $img['source'];
  }
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


// Check if file already exists
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
//  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//    $uploadOk = 0;
//  }
// Check if $uploadOk is set to 0 by an error
//  if ($uploadOk == 0) {
//    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
//  } else {
//    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//      //header('Location: news.php');
//    } else {
//      echo "Sorry, there was an error uploading your file.";
//    }
//  }

  if ($uploadOk == 1) {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image = $_FILES["image"]['name'];
    $alt = $_POST['alt'];
    $target = basename($image);
    $event->insertImg($authorID, $imgName, $alt);
    $imgId = $event->selectImgId();
  } else {
    $imgId = $content['imgID'];
  }


  if (strtotime($endTime) - strtotime($startTime) <= 0) {
    $check_ = 1;
  }

  if ($check_ == 0) {
    $field = [
        'startTime' => $startTime,
        'endTime' => $endTime,
        'campus' => $campus,
        'contentID' => $result['contentID']
    ];

    $field2 = [
        'title' => $title,
        'body' => $body,
        'date' => $date,
        'author' => $author,
        'contentType' => 2,
        'imgID' => $imgId
        
            
    ];

    $id = $_POST['id'];
    $event->update($field, $id);
    $event->update2($field2, $result['contentID']);
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
      <li class="breadcrumb-item active">Edit Event</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">Edit Event</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <div class="form-group">
          <label for="title" class="labels">Title</label>
          <input type="text" class="form-control" name="title" maxlength="100" aria-describedby="emailHelp" placeholder="Enter Title"
                 value="<?php echo $content['title']; ?>">
        </div>
        <div class="form-group">
          <label for="body" class="labels">Body</label>
          <textarea class="ckeditor" name="body" class="form-control" placeholder="Body"><?php echo $content['body']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="date" class="labels">Image</label>
          <input type="file" name="image" class="form-control" placeholder="Image">
        </div>
        <img class="content-img" src="<?php echo '../img/' . $img['source']; ?>">

        <div class="form-group">
          <label for="alt" class="labels">Alternative</label>
          <input type="text" name="alt" class="form-control" maxlength="15" placeholder="Alternative" value="<?php echo $img['alt'] ?>">
        </div>

        <div class="form-group">
          <label for="date" class="labels">Date</label>
          <input type="date" name="date" class="form-control" placeholder="Date" value="<?php echo $content['date']; ?>">
        </div>
        <div class="form-group">
          <label for="author" class="labels">Author</label>

          <input type="text" name="author" class="form-control" placeholder="Author" value="<?php echo $content['author']; ?>">
        </div>
        <div class="form-group">
          <label for="author" class="labels">Start Time</label>

          <input type="time" name="startTime" class="form-control" placeholder="Start Time" value="<?php echo $result['startTime']; ?>">
        </div>
        <div class="form-group">
          <label for="author" class="labels">End Time</label>

          <input type="time" name="endTime" class="form-control" placeholder="End Time" value="<?php echo $result['endTime']; ?>">
        </div>
        <!--              <div class="form-group">
                        <label for="author">Campus</label>
        
                        <input type="text" name="campus" class="form-control" placeholder="Campus" value="<?php echo $result['campus']; ?>">
                      </div>-->
        <div class="form-group">
          <label for="campus" class="labels">Campus</label> <br>
          <select name="campus" required>
            <option value="">None</option>
            <option value="<?php echo $result['campus']; ?>" selected=""><?php echo $result['campus']; ?></option>
            <option value="Ajloun">Ajloun</option>
            <option value="Irbid">Irbid</option>
            <option value="Amman">Amman</option>
            <option value="Zarqaa">Zarqaa</option>
            <option value="Aqaba">Aqaba</option>
            <option value="Salt">Salt</option>
          </select>
          <!--<input type="text" name="campus" class="form-control" placeholder="Campus" required>-->
        </div>

        <input type="submit" name="submit" class="btn btn-primary">

      </form>
    </div>

  </div>

  <?php
  require_once './footer.php';

  if ($check_ == 1) {
    echo "<script type='text/javascript'>swal('End Time Cant be Before Start Time');</script>";
  }
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'events.php';
  });
</script>
</html>
