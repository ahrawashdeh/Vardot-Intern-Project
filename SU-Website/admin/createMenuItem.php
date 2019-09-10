<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/MenuItem.php';
//$db = new DB_conn();
//$conn = $db->connect();
$check_ = 0;
if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $url = $_POST['url'];
  $menuOrder = $_POST['menuOrder'];
  $islinkable = $_POST['islinkable'];
  $authorID = $_SESSION['authorID'];
  $menuID = $_POST['menuID'];
  $parent = $_POST['parent'];
  $newSction = $_POST['newSction'];

  $menu = new MenuItem();

  if($menu->insert($title, $url, $menuOrder, $authorID, $parent, $islinkable, $menuID)) {
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
      <li class="breadcrumb-item active">Add Menu Item</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">Add Menu Item</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="title" class="labels">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
        </div>
        <div class="form-group">
          <label for="menuID" class="labels">Menu Type</label><br>
          <select name="menuID">

            <option value="null">..</option>
            <?php
            $menu = new MenuItem();
            $menuTypes = $menu->selectMenuType();
            foreach ($menuTypes as $row) {
              ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['typeName']; ?></option>                  
              <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="parent">Menu Parent</label><br>
          <select name="parent">
            <option value="null" selected>..</option>
            <?php
            $menuItems = $menu->selectMenuItem();
            //print_r($menuItems);die;
            foreach ($menuItems as $row) {
              ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>                  
              <?php
            }
            ?>
          </select>
        </div>
<!--        <div class="form-group">
          <label for="newSction">New Section</label><br>
          <select name="newSction">
            <option value=0 selected>..</option>
            <option value=1>Yes</option>
            <option value=2>No</option>
          </select>
        </div>-->

        <div class="form-group">
          <label for="url">URL</label>
          <input type="text" name="url" class="form-control" placeholder="URL">
        </div>
        <div class="form-group">
          <label for="menuOrder" class="labels">Menu Order</label>
          <input type="number" min="1" name="menuOrder" class="form-control" placeholder="Menu Order" required>
        </div>
<!--        <div class="form-group">
          <label for="islinkable">is Linkable</label>
          <input type="text" name="islinkable" class="form-control" placeholder="is Linkable" required>
        </div>-->
        <div class="form-group">
          <label for="islinkable">is Linkable</label><br>
          <select name="islinkable">
            <option value=0 selected>..</option>
            <option value=1>Yes</option>
            <option value=2>No</option>
          </select>
        </div>
        <!--        <div class="form-group">
                  <label for="islinkable">Parent</label>
                  <input type="text" name="parent" class="form-control" placeholder="Parent" required>
                </div>-->

        <input type="submit" name="submit" class="btn btn-primary">
        <!--              <button type="submit" class="btn btn-primary">Submit</button>-->
      </form>
    </div>

  </div>

  <?php
  require_once './footer.php';
  if ($check_ == 1) {
    echo "<script type='text/javascript'>swal('Menu Item Added');</script>";
  } 
  ?>
</body>
<script>
  $(".swal-button").click(function () {
    window.location.href = 'menuItem.php';
  });
</script>
</html>
