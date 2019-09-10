<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}

require_once '../config/DB_conn.php';
require_once 'Classes/Users.php';
//$db = new DB_conn();
//$conn = $db->connect();
$check_ = 0;
if (isset($_GET['del'])) {

  $id = $_GET['del'];
  $user = new Users();
  if($user->del($id)) {
    $check_ = 1;
    //echo $check_;die;
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
      <li class="breadcrumb-item active">Add Users</li>
    </ol>

  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <a href="createUser.php" class="btn btn-primary mb-2" >Add Users</a>
    <div class="jumbotron">
      <h4 class="mb-4">All Users</h4>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Permission</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $user = new Users();
          $rows = $user->select();

          foreach ($rows as $row) {
            ?>
            <tr>
              <th scope = "row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['username']; ?></td>                    
              <td><?php echo $row['permission']; ?></td>
              <td>
                <a class = "btn btn-sm btn-danger" href = "users.php?del=<?php echo $row['id']; ?>">Delete</a>
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
    echo "<script type='text/javascript'>swal('User Deleted');</script>";
  }
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'users.php';
  });
</script>
</html>
