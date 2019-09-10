<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
}
require_once '../config/DB_conn.php';
require_once 'Classes/MenuItem.php';
//$db = new DB_conn();
//$conn = $db->connect();

if (isset($_GET['id'])) {
  $uid = $_GET['id'];
  $menu = new MenuItem();
  $result = $menu->selectOne($uid);
  // print_r($result);
}

if (isset($_POST['submit'])) {

  $title = $_POST['title'];
  $url = $_POST['url'];
  $menuOrder = $_POST['menuOrder'];
  $islinkable = $_POST['islinkable'];
  $parent = $_POST['parent'];
  $authorID = $_SESSION['authorID'];
  $menuID = $_POST['menuID'];



  $field = [
      'title' => $title,
      'url' => $url,
      'menuOrder' => $menuOrder,
      'islinkable' => $islinkable,
      'authorID' => $authorID,
      'menuID' => $menuID,
          //'parentID' => $parent
  ];
  $id = $_POST['id'];
  $menu->updateParentID($parent, $id);
  $menu->update($field, $id);
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
      <li class="breadcrumb-item active">View Menu Item</li>
    </ol>
    <!-- Page Content -->
  </div>
  <!-- /.container-fluid -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h4 class="mb-4">View Menu Item</h4>

      <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?php echo $result['title']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="menuID">Menu Type</label><br>
          <select name="menuID" disabled>

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
          <select name="parent" disabled>
            <option value="null">..</option>
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
        <div class="form-group">
          <label for="newSction">New Section</label><br>
          <select name="newSction" disabled>
            <option value=0 <?php
            if ($result['newSction'] != 1 && $result['newSction'] != 2) {
              echo "selected";
            }
            ?>>..</option>
            <option value=1 <?php
            if ($result['newSction'] == 1) {
              echo "selected";
            }
            ?> >Yes</option>
            <option value=2 <?php
            if ($result['newSction'] == 2) {
              echo "selected";
            }
            ?>>No</option>
          </select>
        </div>
        <div class="form-group">
          <label for="url">URL</label>
          <input type="text" name="url" class="form-control" placeholder="URL" value="<?php echo $result['url']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="menuOrder">Menu Order</label>
          <input type="number" min="1" name="menuOrder" class="form-control" placeholder="Menu Order" value="<?php echo $result['MenuOrder']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="islinkable">is Linkable</label><br>
          <select name="islinkable" disabled>
            <option value=0 <?php
            if ($result['islinkable'] != 1 && $result['islinkable'] != 2) {
              echo "selected";
            }
            ?>>..</option>
            <option value=1 <?php
            if ($result['islinkable'] == 1) {
              echo "selected";
            }
            ?> >Yes</option>
            <option value=2 <?php
            if ($result['islinkable'] == 2) {
              echo "selected";
            }
            ?>>No</option>
          </select>
        </div>
      </form>
    </div>

  </div>

  <?php
  require_once './footer.php';
  ?>
</body>

</html>
