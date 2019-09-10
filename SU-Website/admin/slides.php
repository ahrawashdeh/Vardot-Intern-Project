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
if (isset($_GET['del'])) {

  $id = $_GET['del'];
  $slide = new Slides();
  if ($slide->del($id)) {
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
      <li class="breadcrumb-item active">Add Slides</li>
    </ol>

  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <a href="createSlide.php" class="btn btn-primary mb-2" >Add Slides</a>
    <div class="jumbotron">
      <h4 class="mb-4">All Slides</h4>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Text</th>
            <th scope="col">Order</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $slide = new Slides();
          $rows = $slide->select();

          foreach ($rows as $row) {
            ?>
            <tr>
              <th scope = "row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['slideText']; ?></td>                    
              <td><?php echo $row['slideOrder']; ?></td>

              <td>
                <a class = "btn btn-sm btn-info" href = "viewSlide.php?id=<?php echo $row['id'] ?>">View</a> &nbsp;
                <a class = "btn btn-sm btn-primary" href = "editSlide.php?id=<?php echo $row['id'] ?>">Edit</a> &nbsp;
                <a class = "btn btn-sm btn-danger" href = "slides.php?del=<?php echo $row['id']; ?>">Delete</a>
              </td>
            </tr>
            <?php
          }
          ?>

        </tbody>
      </table>
    </div>

  </div>

  <?php
  require_once './footer.php';

  if ($check_ == 1) {
    echo "<script type='text/javascript'>swal('Slide Deleted');</script>";
  }
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'slides.php';
  });
</script>
</html>
