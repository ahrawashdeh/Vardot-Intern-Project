<?php
session_start();
if (!(isset($_SESSION['username']))) {
  header('location: login.php');
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
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

  </div>
  <!-- /.container-fluid -->

  <?php
  require_once './footer.php';
  ?>
</body>

</html>
