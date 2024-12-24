
<?php

$uid = $_GET["uid"];  // Get the value from URL

include("../includes/dbconnect.php");

$qry = "DELETE FROM `users` WHERE id='$uid'"; 
$result = mysqli_query($connect, $qry);

$row = mysqli_num_rows($result);

if ($row > 0) {
    ?><script> alert("Record is deleted <?php echo $uid; ?>"); </script><?php
} else {
    ?><script>alert("Something went wrong"); </script><?php
}

header("Location: admindashboard.php");

?>
