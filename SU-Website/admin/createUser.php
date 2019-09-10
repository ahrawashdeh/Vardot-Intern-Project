<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/Users.php';
//$db = new DB_conn();
//$conn = $db->connect();

$u = new Users();
$r = $u->select();
//print_r($r);
//die;

if (isset($_POST['submit'])) {

  $username_ = $_POST['username'];
  $password_ = sha1($_POST['password']);
  $cpassword = sha1($_POST['cpassword']);
  $permission = $_POST['permission'];


  $check = 0;
  $user = new Users();

  $field = [
      'username' => $username_,
      'password' => $password_,
      'permission' => $permission,
  ];

  $allUsers = $user->select();
  //print_r($allUsers);die;

  foreach ($allUsers as $value) {
    if ($username_ == $value['username']) {
      $check = 2;
    }
  }
  if ($password_ !== $cpassword) {
    $check = 1;
  }

  if ($check === 0) {
    $user->insert($field);
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
      <li class="breadcrumb-item active">Add User</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">Add User</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="title" class="labels">Username</label>
          <input type="text" class="form-control" name="username"  placeholder="Enter Username" required>
        </div>
        <div class="form-group">
          <label for="password" class="labels">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group">
          <label for="cpassword" class="labels">Confirm Password</label>
          <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
        </div>


        <!--        <div class="form-group">
                  <label for="image">Permission</label>
                  <input type="text" name="permission" class="form-control" placeholder="Permission" required="">
                </div>-->
        <div class="form-group">
          <label for="permission" class="labels">Permission</label> <br>
          <select name="permission" required>
            <option value="">None</option>
            <option value="Super Admin">Super Admin</option>
            <option value="Student">Student</option>

          </select>
          <!--<input type="text" name="campus" class="form-control" placeholder="Campus" required>-->
        </div>



        <input type="submit" name="submit" class="btn btn-primary">

      </form>
    </div>

  </div>

  <?php
  require_once './footer.php';

  global $check;


  if ($check == 1) {
    echo "<script type='text/javascript'>swal('Your password and confirmation password do not match');</script>";
  } elseif ($check == 2) {
    echo "<script type='text/javascript'>swal('Username Already Exist');</script>";
  }
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'createUser.php';
  });
</script>
</html>
