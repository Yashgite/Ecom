<?php

session_start();
if (!$_SESSION["uid"]) {
  header("location:login.php");
}

include("includes/dbconnect.php");
$id = $_SESSION["uid"];
$qry = "select * from users where id='$id'";
$result = mysqli_query($connect, $qry);
$data = mysqli_fetch_assoc($result);


/* Change password code start */
if (isset($_POST["updatepassbtn"])) 
{
  $op = $_POST["op"];

  if ($op == $data["password"])
  {
    $np = $_POST["np"];
    $rp = $_POST["rp"];

    if ($np == $rp) 
    {
      if ($np != $data["password"])
       {
          $qry = "UPDATE `users` SET `password`='$np' WHERE id = '$id'";
          $result = mysqli_query($connect, $qry);
          if ($result) 
          {
            ?><script> alert("Password Changed Successfully");</script><?php
          }
        } 
        else
        {
          ?><script> alert("New password should not be match with Old password");</script><?php
        }
      } 
      else 
      {
        ?><script> alert("Password do not match, Re-enter the password");</script><?php
      }
  } 
  else 
  {
    ?><script> alert("Old password is incoorect");</script><?php
  }
}
          /* code end */

          /* Edit profile code Start*/

          if (isset($_POST["editbtn"])) 
          {
            $fn = $_POST["fullname"];
            $email = $_POST["email"];
            $con = $_POST["contact"];

            $qry = "UPDATE `users` SET `fullname`='$fn',`email`='$email',`contact`='$con' WHERE id='$id'";
            $result = mysqli_query($connect, $qry);
            if ($result)
            {
              ?><script>alert("Profile update Successfully")</script><?php
            } 
            else 
            {
              ?><script> alert("Something went Wrong")</script><?php
            }
          }

          /* code end*/



              ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .sidebar a {
      color: black;
      text-decoration: none;
    }

    #userprofile img {
      max-height: 300px;
    }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ezShop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
        <span class="navbar-text">

          <strong>(<?php echo $data["fullname"]; ?>)</strong>

          <button class="btn btn-primary"><a href="logout.php" style="text-decoration: none;"> Log out </a></button>
        </span>
      </div>
    </div>
  </nav>

  <div class="row">
    <div class="col-md-3">
      <ul class="list-group sidebar">
        <li class="list-group-item"><a href="#userprofile" data-toggle="tab"> Profile</a></li>
        <li class="list-group-item"><a href="#editprf" data-toggle="tab"> Edit Profile</a></li>
        <li class="list-group-item"><a href="#changepwd" data-toggle="tab"> Change Password</a></li>
        <li class="list-group-item"><a href="#orderhistory" data-toggle="tab"> Order History</a></li>
        <li class="list-group-item"><a href="logout.php">logout</a></li>
      </ul>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane active" id="userprofile">
          <?php include("userprofile.php"); ?>
        </div>
        <div class="tab-pane" id="editprf">
          <?php include("editprofile.php"); ?>
        </div>
        <div class="tab-pane" id="changepwd">
          <?php include("changepwd.php"); ?>
        </div>
        <div class="tab-pane" id="orderhistory">
          <?php include("orderhistory.php"); ?>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>