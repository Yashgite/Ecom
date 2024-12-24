<?php

include("../includes/dbconnect.php");
$qry = "select * from users";
$result = mysqli_query($connect,$qry);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
            <h1 class="mt-5 mb-4">Welcome to manage user</h1>
            <table class="table border">
                <tr>
                    <th>Sr. no</th>
                    <th>Name</th>
                    <th>Email id</th>
                    <th>Password</th>
                    <th>Contact</th>
                    <th>photo</th>
                    <th>Action</th>
                </tr>
                <?php

                    $count =1;
                    while($data = mysqli_fetch_assoc($result))
                    {
                        $imagepath = "../images/".$data["photo"];
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $data["fullname"]; ?></td>
                    <td><?php echo $data["email"]; ?></td>
                    <td><?php echo $data["password"]; ?></td>
                    <td><?php echo $data["contact"]; ?></td>
                    <td><img src="<?php echo $imagepath; ?>" width="60"/></td>
                    <td><a href="deleteuser.php?uid=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure you want to Delete the user')"><i class="bi bi-trash3"></i></a></td>
                </tr>
                <?php
                    }
                ?>
            </table>
            </div>
        </div>
    </div>
</body>
</html>