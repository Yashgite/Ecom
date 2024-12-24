<?php
session_start();
if(isset($_SESSION["uid"]))
{
    header("location:user.php");
}
else if(isset($_SESSION["admineid"]))
    {
        header("location:admin/admindashboard.php");
    }

if(isset($_POST["login_btn"]))
{
    include("includes/dbconnect.php");

    $email= mysqli_real_escape_string($connect,$_POST["email"]);
    $pass= mysqli_real_escape_string($connect,$_POST["password"]);

    $qry= "SELECT * FROM `users` WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($connect,$qry);

    $row_affected= mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    $id = $data["id"];

    /* Admin code start */
if($email=="admin@gmail.com" && $pass="admin@123")
{
    $_SESSION["admineid"] = $email;
    header("location:admin/admindashboard.php");
}
    /* Admin code end */
else
{

    if($row_affected>0)
    {
        $_SESSION["uid"] = $id;

    }
    else
    {
        echo "invalid username and passsword";
    }
}

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    body {
      background-image: url(background.jpeg);
      background-size: cover;
      background-position: center; /* Centers the image */
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-form {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px #0000001a;
    }
  </style>
</head>
<body>
    
    <div class="container">
       <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-form">
                <h1>Log in </h1>       
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <div>
                            <input class="form-contol" type="email" placeholder="Enter email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div>
                            <input class="form-contol" type="password" placeholder="Enter password" name="password">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="login_btn">Log in</button>
                        <div class="mt-2">
                            <p>Don't have an account? <a href="register.php">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
       </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>