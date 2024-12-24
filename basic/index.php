<?php

include("includes/dbconnect.php");

$category=isset($_GET["category"])?$_GET["category"]:"all";
if($category == "all")
{
    $qry = "select * from product";
}
else
{
    $qry = "select * from product where productcategory = '$category'";
}

$result = mysqli_query($connect,$qry);

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <?php include("includes/headercdn.php") ?>
   <link href="css/style.css" rel="stylesheet">
   <style>
    body{
        background-color: #526D82;
    }

   </style>
</head>
<body>
    <?php include("homenav.php") ?>
    <div class="container-fluid mt-5">
        <div class="row category-buttons">
            <div class="col-12 text-center">
                <button class="btn btn-primary filter-button m-2" data-filter="all" onclick="filterProducts('all')">All</button>
                <button class="btn btn-secondary filter-button m-2" data-filter="Electronics" onclick="filterProducts('Electronics')">Electronics</button>
                <button class="btn btn-secondary filter-button m-2" data-filter="Fashion" onclick="filterProducts('Fashion')">Fashion</button>
                <button class="btn btn-secondary filter-button m-2" data-filter="Homeappliances" onclick="filterProducts('Homeappliances')">Home Appliances</button>
                <button class="btn btn-secondary filter-button m-2" data-filter="Toys" onclick="filterProducts('Toys')">Toys</button>
            </div>
        </div>
        <div class="row">
            <!-- Card 1 -->

            <?php while($data = mysqli_fetch_assoc($result))
            
            {
                $imagepath = "assets/".$data['productcategory']."/".$data['productimg'];
                ?>
            <div class="col-md-4 mb-4 product-card" <?php echo $data['productcategory']; ?> data-category="electronics">
                <div class="card">
                    <img src="<?php echo $imagepath ?>" class="card-img-top img-fluid " style="width:auto;" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data["productname"]; ?></h5>
                        <strong class="card-title"><?php echo $data["productprice"]; ?></strong>
                        <p class="card-text rating">Rating: ★★★★☆</p>
                        <a href="product.php?pid=<?php echo $data['productid']; ?>" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            
            <?php
            }
            ?>
        </div>
    </div>

   <?php include("includes/footercdn.php") ?>
   <script type="text/javascript" src="js/script.js"></script>
   <script>
    document.querySelectorAll('.filter-button').forEach(button=>{
        button.addEventListener('click',()=>{
            const category = button.getAttribute('data-filter');
            window.location.href = `?category=`+category;
        });
    });
    </script>

</body>
</html>