<?php
session_start();
if(!isset($_SESSION["admineid"]))
{
  header("location:../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<?php include("../includes/headercdn.php"); ?>
</head>
<body>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#addproduct">Add Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#manageuser">Manage User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#activity">Activity</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../logout.php">logout</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="addproduct">
    <?php include("addproduct.php"); ?>
  </div>
  <div class="tab-pane container fade" id="manageuser">
  <?php include("manageuser.php"); ?>
  </div>
  <div class="tab-pane container fade" id="activity">
  <?php include("activity.php"); ?>
  </div>
</div>

<?php include("../includes/footercdn.php"); ?>
</body>
</html>