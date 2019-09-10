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
if (isset($_GET['del'])) {
  $id = $_GET['del'];

  $event = new Events();
  if($event->del($id)) {
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
        <a href="index.php"> Dashboard </a>
      </li>
      <li class="breadcrumb-item active">Add Events</li>
    </ol>

    <!-- Page Content -->
    <div class="container mt-4">
      <a href="createEvent.php" class="btn btn-primary mb-2">Add Events</a>
      <div class="jumbotron">

        <h4 class="mb-4">All Events </h4>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Author</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $event = new Events();
            $rows = $event->select();

            foreach ($rows as $row) {
              ?>
              <tr>
                <th scope = "row"><?php echo $row['id']; ?></th>
                <td><?php echo $row['author']; ?></td>

                <td>
                  <a class = "btn btn-sm btn-info" href = "viewEvent.php?id=<?php echo $row['id'] ?>">View</a> &nbsp;
                  <a class = "btn btn-sm btn-primary" href = "editEvent.php?id=<?php echo $row['id'] ?>">Edit</a> &nbsp;
                  <a class = "btn btn-sm btn-danger"href = "events.php?del=<?php echo $row['id']; ?>">Delete</a>
                </td>
              </tr>
              <?php
            }
            ?>

          </tbody>
        </table>
      </div>

    </div>



  </div>
  <!-- /.container-fluid -->
  <?php
  require_once './footer.php';
  if ($check_ == 1) {
    echo "<script type='text/javascript'>swal('Event Deleted');</script>";
  } 
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'events.php';
  });
</script>
</html>
