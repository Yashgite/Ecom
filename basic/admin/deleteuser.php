<?php

$uid = $_GET["uid"];
include("../includes/dbconnect.php");

$qry = "DELETE from `users` where id = '$uid'";
$result = mysqli_query($connect,$qry);

$row = mysqli_affected_rows($connect);

if($row>0)
{
    ?> <script> alert("User delete successfully");</script> <?php
     header("location:admindashboard.php");

}
else
{
    ?> <script> alert("Something went wrong");</script> <?php

}

?>