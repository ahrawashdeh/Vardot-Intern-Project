<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/ContactUs.php';
//$db = new DB_conn();
//$conn = $db->connect();


if (isset($_GET['id'])) {
  $uid = $_GET['id'];
  $contact = new ContactUs();
  $result = $contact->selectOne($uid);
  // print_r($result);die;
//  echo $result['imgID'];die();
//  var_dump($img);die;
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
      <li class="breadcrumb-item active">View Contacts</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">View Contacts</h4>

      <form action="" method="post">

        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <div class="form-group">
          <label for="title">Full Name</label>
          <input type="text" class="form-control" name="title" aria-describedby="emailHelp" placeholder="Enter Title"
                 value="<?php echo $result['fullName']; ?>" disabled>
        </div>


        <div class="form-group">
          <label for="alt">Phone</label>
          <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $result['phone'] ?>" disabled>
        </div>
        <div class="form-group">
          <label for="date">Email</label>
          <input type="text" name="email" class="form-control" placeholder="email" value="<?php echo $result['email']; ?>" disabled>
        </div> 
        <div class="form-group">
          <label for="body">Message</label>
          <textarea name="message" class="form-control" placeholder="Message" disabled><?php echo $result['message']; ?></textarea>
        </div>


      </form>
    </div>

  </div>

<?php
require_once './footer.php';
?>
</body>

</html>
