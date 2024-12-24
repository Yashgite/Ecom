<?php

if(isset($_POST["addproduct-btn"]))
{
    include("../includes/dbconnect.php");

    $pname = $_POST["productname"];
    $pcat = $_POST["productcategory"];
    $pprice = $_POST["productprice"];
    $avail = $_POST["available"];
    $pdesc = $_POST["productdescription"];

    $filename = $_FILES["productimg"]["tmp_name"];
    $orgname = $_FILES["productimg"]["name"];
    $filesize = $_FILES["productimg"]["size"];

    $file_info = explode(".",$orgname);
    $fileext = strtolower($file_info[1]);
    $allowtypes = array("jpg","png","jpeg");


    move_uploaded_file($filename,"../assets/".$pcat."/".$orgname); 
    $qry ="INSERT INTO `product`(`productid`, `productname`, `productcategory`, `productprice`, `available`, `productdescription`, `productimg`) 
    VALUES (NULL,'$pname','$pcat','$pprice','$avail','$pdesc','$orgname')";
    $result = mysqli_query($connect,$qry);

            if($result)
            {
                ?><script> alert("Product Added Successsfully - <?php echo $pname; ?>");</script><?php
            }
            else
            {
                ?><script> alert("Failed to add Product - <?php echo $pname; ?>");</script><?php
            }

}

?>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="registration-form">
          <h2 class="text-center">Add product</h2>
          <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label for="fullname">Product Name</label>
              <input type="text" class="form-control" id="productname" name="productname"  required>
            </div>

            <div class="form-group">
              <label for="productcategory">Product Category</label>
              <select class="form-control" name="productcategory" id="productcategory">
                <option value="Homeappliances">Homeappliences</option>
                <option value="Fashion">Fashion</option>
                <option value="Electronics">Electronics</option>
                <option value="Toys">Toys</option>
              </select>
            </div>

            <div class="form-group">
              <label for="productprice">Product Price</label>
              <input type="number" class="form-control" id="productprice" name="productprice" >
            </div>

            <div class="form-group">
              <label for="available">Available</label>
              <input type="number" class="form-control" id="available" name="available" >
            </div>

            <div class="form-group">
              <label for="productdescription">Product Description</label>
              <textarea class="form-control" name="productdescription"></textarea>
            </div>

            <div class="form-group">
              <label for="file">Product Image</label>
              <input type="file" class="form-control" id="file" name="productimg"  required>
            </div>

              <button type="submit" class="btn btn-primary btn-block" name="addproduct-btn">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>