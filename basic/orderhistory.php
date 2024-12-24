<?php

$id = $_SESSION["uid"];
include("includes/dbconnect.php");
$qry = "select * from order_details where uid ='$id'";
$result = mysqli_query($connect,$qry);


?>
<h1 class="mb-5"> Order History </h1>
            <table class="table">
                <tr>
                    <th>Sr. no</th>
                    <th>Product image</th>
                    <th>Product</th>
                    <th>Product Price</th>
                    <th>Product Category</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                $count = 1;
                while($data = mysqli_fetch_assoc($result))
                {
                    $pid = $data["productid"];
                    $qry2 = "select productname, productprice, productcategory, productimg from product where productid = '$pid'";
                    $result2 = mysqli_query($connect, $qry2);
                    $data2 = mysqli_fetch_assoc($result2);
            
                    $imgpath = "assets/".$data2['productcategory']."/".$data2['productimg'];
                    ?>
                <tr>
                    <td><?php echo $count++ ?></td>
                    <td> <img src="<?php echo $imgpath ?>" width="60px" height="60px"> </td>
                    <td><?php echo $data2["productname"] ?></td>
                    <td><?php echo $data2["productprice"] ?></td>
                    <td><?php echo $data2["productcategory"] ?></td>
                    <td><?php echo  $data["quantity"] ?></td>
                    <td><?php echo  $data["totalprice"] ?></td>
                    <td><?php echo  $data["uploaded_at"] ?></td>
                    <td> <a href="print.php?oid=<?php echo $data['oid'] ?>" class="btn btn-success"> Print </a> </td>
                </tr>
                <?php
                }
                ?>

            </table>