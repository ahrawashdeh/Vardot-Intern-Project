<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
?>
<?php
require_once '../config/DB_conn.php';
require_once 'Classes/ContactUs.php';
//$db = new DB_conn();
//$conn = $db->connect();
$check_ = 0;
if (isset($_GET['del'])) {

  $id = $_GET['del'];
  $contact = new ContactUs();
  if($contact->del($id)) {
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
      <li class="breadcrumb-item active">All Contacts</li>
    </ol>

  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">

    <div class="jumbotron">
      <h4 class="mb-4">All Contacts</h4>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $contact = new ContactUs();
          $rows = $contact->select();

          foreach ($rows as $row) {
            ?>
            <tr>
              <th scope = "row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['fullName']; ?></td>                    
              <td><?php echo $row['phone']; ?></td>
              <td><?php echo $row['email']; ?></td>
              
              <td>
                <a class = "btn btn-sm btn-info" href = "viewContacts.php?id=<?php echo $row['id'] ?>">View</a> &nbsp;
                <a class = "btn btn-sm btn-danger" href = "contactUs.php?del=<?php echo $row['id']; ?>">Delete</a>
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
    echo "<script type='text/javascript'>swal('Contact Deleted');</script>";
  } 
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'contactUs.php';
  });
</script>
</html>
