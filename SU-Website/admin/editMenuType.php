<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/MenuType.php';
//$db = new DB_conn();
//$conn = $db->connect();

$check_ = 0;
if (isset($_GET['id'])) {
  $uid = $_GET['id'];
  $menuType = new MenuType();
  $result = $menuType->selectOne($uid);
//  print_r($result);
//  echo $result['imgID'];die();
//  var_dump($img);die;
}

if (isset($_POST['submit'])) {
  $type = $_POST['typeName'];

  $authorID = $_SESSION['authorID'];

  $menuType = new MenuType();


  $field = [
      'typeName' => $type,
      'authorID' => $authorID,
  ];

  $id = $_POST['id'];
//  $news->updateAlt($alt, $imgId);
  if($menuType->update($field, $id)) {
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
      <li class="breadcrumb-item active">Edit Menu Type</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">Edit Menu Type</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <div class="form-group">
          <label for="typeName" class="labels">Type</label>
          <input type="text" class="form-control" name="typeName" placeholder="Enter Type"
                 value="<?php echo $result['typeName']; ?>">
        </div>

        <input type="submit" name="submit" class="btn btn-primary">

      </form>
    </div>

  </div>


  <?php
  require_once './footer.php';
  
  if ($check_ == 1) {
    echo "<script type='text/javascript'>swal('Menu Type Updated);</script>";
  }
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'menuType.php';
  });
</script>
</html>
