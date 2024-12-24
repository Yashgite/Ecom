<?php

include("includes/headercdn.php");
include("includes/dbconnect.php");
$companyname = "ezShop";
$companyemail = "ezshop.ac.in";
$companymobile = "8529637415";

session_start();
$id  = $_SESSION["uid"];
$qry = "select fullname, contact, email from users where id = '$id'";
$result = mysqli_query($connect, $qry);

$data = mysqli_fetch_assoc($result);

$delname = $data["fullname"];
$delmob = $data["contact"];
$delemail = $data["email"];


$oid = $_GET["oid"];

$qry2 = "select * from order_details where oid = '$oid'";
$result2 = mysqli_query($connect, $qry2);
$data2 = mysqli_fetch_assoc($result2);

$pid = $data2["productid"];

$qry3 = "select productname, productprice from product where productid = '$pid'";
$result3 = mysqli_query($connect, $qry3);
$data3 = mysqli_fetch_assoc($result3);

?>

<style>
	.invoice {
		max-width: 1000px;
		margin:auto;
		border: 1px solid black;
		height: 70vh;
	}

	.invoice-content {
		padding:20px 30px;
		font-size: 16px;
	}
</style>


<div class="invoice">
	<div class="invoice-content">
		<div class="text-center">
		<h3> <?php echo $companyname ?> </h3>
		<p> Mobile -<?php echo $companymobile ?>  | Email -<?php echo $companyemail ?> </p>
		</div>
		<hr>
        <div class="text-center">
		<h3> Name - <?php echo $delname ?> </h3>
		<p> Mobile - <?php echo  $delmob ?>  | Email - <?php echo $delemail ?> </p>
		<p> Address - <?php echo $data2["address"]; ?> </p>
        </div>
		<hr>
		<h4> Product Details </h4>
		<table class="table">
			<tr>
				<th> S. No. </th>
				<th> Product Name </th>
				<th> Product Price </th>
				<th> Quantity </th>
				<th> Total Price </th>
				<th> Date </th>
			</tr>
			<tr>
				<td> 1.  </td>
				<td> <?php echo $data3['productname']; ?> </td>
				<td> <?php echo $data3['productprice']; ?> </td>
				<td> <?php echo $data2['quantity']; ?> </td>
				<td> <?php echo $data2['totalprice']; ?> </td>
				<td> <?php echo $data2['uploaded_at']; ?> </td>
			</tr>
		</table>			
	</div>
</div>

<?php include("includes/footercdn.php"); ?>

<script>
	window.print();
</script>