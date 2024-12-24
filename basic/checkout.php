<?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$quantity = $_POST["quantity"];
$productid = $_POST["productid"];
$price = $_POST["price"];
$totalprice = $quantity*$price;
}

session_start();
if(!isset($_SESSION["uid"]))
{

	header("location:login.php");
	exit;
}

$id = $_SESSION["uid"];

include("includes/dbconnect.php");

$qry = "select * from users where id = '$id'";
$result = mysqli_query($connect, $qry);

$data = mysqli_fetch_assoc($result);


if(isset($_POST["final_btn"])){
    $address = $_POST["address"];
    $cardnum = $_POST["cardNumber"];
    $cvv = $_POST["cvv"];
    $date = $_POST["expiryDate"];
    $productid = $_POST["productid"];

    $qry = "INSERT INTO `order_details`(`oid`, `uid`, `productid`, `quantity`, `totalprice`, `debitcard`, `address`, `cvv`, `exp_date`, `uploaded_at`) 
    VALUES (NULL,'$id','$productid','$quantity','$totalprice','$cardnum','$address','$cvv','$date',now())"; 

    $result = mysqli_query($connect,$qry);

    if($result){
        ?><script> alert("Product purchase successfully"); </script> <?php
    }
    else{
        ?><script> alert("Something went wrong"); </script> <?php

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <?php include("includes/headercdn.php"); ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Checkout</h2>
        <form id="checkoutForm" method="post">
        <input type="hidden" class="form-control" name="productid" value="<?php echo $productid ?>">
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $data['fullname'] ?>">
                <span class="error" id="fullnameError"></span>
            </div>
            <div class="form-group">
                <label for="address">Delivery Address:</label>
                <input type="text" class="form-control" id="address" name="address">
                <span class="error" id="addressError"></span>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" readonly>
                <span class="error" id="priceError"></span>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity ?>" readonly>
                <span class="error" id="quantityError"></span>
            </div>
            <div class="form-group">
                <label for="totalPrice">Total Price:</label>
                <input type="number" class="form-control" id="totalPrice" name="totalPrice" value="<?php echo $totalprice; ?>" readonly>
                <span class="error" id="totalPriceError"></span>
            </div>
            <div class="form-group">
                <label for="cardNumber">Debit Card Number:</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                <span class="error" id="cardNumberError"></span>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv">
                <span class="error" id="cvvError"></span>
            </div>
            <div class="form-group">
                <label for="expiryDate">Expiry Date:</label>
                <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY">
                <span class="error" id="expiryDateError"></span>
            </div>
            <button type="submit" class="btn btn-primary" name="final_btn">Submit</button>
        </form>
    </div>

    <?php include("includes/footercdn.php"); ?>

    <script type="js/script.js"></script>
    <script>
        $(document).ready(function () {
            function validateForm() {
                let isValid = true;
                $(".error").text(""); // Clear all error messages

                // Full Name validation
                if ($("#fullname").val().trim() === "") {
                    $("#fullnameError").text("Full Name is required.");
                    isValid = false;
                }

                // Address validation
                if ($("#address").val().trim() === "") {
                    $("#addressError").text("Address is required.");
                    isValid = false;
                }

                // Email validation
                const email = $("#email").val().trim();
                if (email === "") {
                    $("#emailError").text("Email ID is required.");
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $("#emailError").text("Invalid Email ID.");
                    isValid = false;
                }

                // Price validation
                const price = $("#price").val();
                if (price === "" || price <= 0) {
                    $("#priceError").text("Price must be a positive number.");
                    isValid = false;
                }

                // Quantity validation
                const quantity = $("#quantity").val();
                if (quantity === "" || quantity <= 0) {
                    $("#quantityError").text("Quantity must be a positive number.");
                    isValid = false;
                } else {
                    const totalPrice = price * quantity;
                    $("#totalPrice").val(totalPrice);
                }

                // Debit Card Number validation
                const cardNumber = $("#cardNumber").val().trim();
                if (cardNumber === "") {
                    $("#cardNumberError").text("Debit Card Number is required.");
                    isValid = false;
                } else if (!/^\d{16}$/.test(cardNumber)) {
                    $("#cardNumberError").text("Debit Card Number must be 16 digits.");
                    isValid = false;
                }

                // CVV validation
                const cvv = $("#cvv").val().trim();
                if (cvv === "") {
                    $("#cvvError").text("CVV is required.");
                    isValid = false;
                } else if (!/^\d{3}$/.test(cvv)) {
                    $("#cvvError").text("CVV must be 3 digits.");
                    isValid = false;
                }

                // Expiry Date validation
                const expiryDate = $("#expiryDate").val().trim();
                if (expiryDate === "") {
                    $("#expiryDateError").text("Expiry Date is required.");
                    isValid = false;
                } else if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
                    $("#expiryDateError").text("Expiry Date must be in MM/YY format.");
                    isValid = false;
                }

                return isValid;
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            $("#checkoutForm").on("submit", function (e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
