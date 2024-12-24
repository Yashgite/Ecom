<?php

if(isset($_POST["upload_button"]))
{
    $connect = mysqli_connect("localhost:3307","root","","imgdb");
    $file = $_FILES["photo"];
    $org_name = $_FILES["photo"]["name"];
    $size = $_FILES["photo"]["size"];
    $type = $_FILES["photo"]["type"];
    $file_name = $_FILES["photo"]["tmp_name"];

    $arr = array("jpg","png","jpeg");
    $file_info = explode(".",$org_name);
    $file_extension = strtolower($file_info[1]);

    $valid_extension = in_array($file_extension,$arr);

    if($valid_extension)
    {

        if($size>100000 && $size<500000)
        {
            move_uploaded_file($file_name,"images/".$org_name);
            $qry = "INSERT INTO `users_photo`(`photo_name`) VALUES ('$org_name')";
            $res = mysqli_query($connect, $qry);
            if($res)
            {
                echo "successfully upload";
            }
            else
            {
                echo "Something went wrong";
            }
        }
        else
        {
            echo "invalid size";
        }
    }
    else
    {
        echo "invalid extension";
    }


}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    Photo - <input type="file" name="photo"></br></br>
    <button type="submit" name="upload_button" >Submit</button>
</form>    
    
</body>
</html>