<?php
include "connection.php";
$err="";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targetDir = "files/";
    $targetFile = $targetDir . basename($_FILES["imgfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["imgfile"]["tmp_name"]);
    if ($check === false) {
        $err= "Error: File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        $err= "Error: File already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    // if ($_FILES["imgfile"]["size"] > 5 * 1024 * 1024) {
    //     $err= "Error: File is too large. Please choose a smaller file.";
    //     $uploadOk = 0;
    // }

    // Allow only certain image file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        $err= "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $err= $err;
    } else {
        // Move the file to the specified directory
        if (move_uploaded_file($_FILES["imgfile"]["tmp_name"], $targetFile)) {
            $filename = htmlspecialchars(basename($_FILES['imgfile']["name"]));
            $iname = $conn->real_escape_string($_POST['imgname']);
            $desc = $conn->real_escape_string($_POST['desc']);
            $price = $conn->real_escape_string($_POST['price']);
            $type = $conn->real_escape_string($_POST['type']);
            $code = $conn->real_escape_string($_POST['code']);

            $stmt = $conn->prepare("INSERT INTO  menu (image, iname, description, price, type,code) VALUES (?, ?, ?, ?, ?,?)");
            $stmt->bind_param("ssssss", $filename, $iname, $desc, $price,$type,$code);

            if ($stmt->execute()) {
                $err="<p class='text-success text-center'>The file " . $filename . " has been uploaded and saved in the database</p>";
                $err= "Data inserted";
            } else {
                $err= "There was an error uploading this file to the database.";
            }

            $stmt->close();
        } else {
            $err= "Error: There was an error uploading your file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <style>
    table {
        width: 93%;
        padding: 1rem;
        font-size: 0.8rem;
    }

    th {
        text-align: start;
    }

    th,
    tr,
    td {
        padding: 0.7rem 0;
        text-align: center;
    }



    td {
        border-top: 1px solid rgb(229, 229, 229);
    }

    .table_container {
        display: flex;
        justify-content: center;
        background-color: white;
        margin-bottom: 4rem;


    }

    .screen_cell {
        background-color: #00A65A;
        color: white;
        border-radius: 0.6rem;
        padding: 0.1rem 0.3rem;
    }

    .time_cell {
        background-color: #367FA9;
        color: white;
        border-radius: 0.6rem;
        padding: 0.1rem 0.3rem;
    }

    header {
        display: flex;
        justify-content: space-between;
        height: 11vh;
        background-color: rgb(60, 141, 188);
        padding: 0 2rem;
        align-items: center;
        color: white;
        margin: 0;
    }

    .img {
        width: 50%;
        height: 50%;
    }

    header a {
        text-decoration: none;
        color: white;
    }

    .logo:hover {
        color: white;
    }

    header img {
        height: 40px;
        width: 40px;
        border-radius: 50%;

    }

    .logo {
        font-size: 2rem;
        margin-left:2%;
    }
    label{
        margin-bottom:0.3rem;
      }

    .admin_profile {
        width: 20%;
        display: flex;
        align-items: center;
        justify-content: end;
        gap: 1rem;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add items/Brother's</title>
</head>

<body>
    <header>
        <a href="admin.php" class="logo">Brother's Resturant</a>
        <div class="admin_profile">
            <a style="text-decoration:none;color:white;" href="admin.php">Back to Admin Page</a>
            <div class='widt:20%' class="img">
                <img src="admin.jfif" alt="" />
            </div>
        </div>
    </header>

    <main style='display:flex;'>
        <div class="side" style="width:4%;background-color: rgb(60, 141, 188);min-height:100vh;">

        </div>
        <div class="add " style='display:flex;justify-content:space-around;width:96%'>

            <?php
?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" style="width:35%;margin:3rem 0;" enctype="multipart/form-data" method="post">
                <h3 style="margin-bottom:2rem;">Add New Item</h3>
                <label for="image">Add Image</label><br>
                <input type="file" name="imgfile" class="form-control"><br>
                <label for="name">Name of Item</label><br>
                <input type="text" name="imgname" class="form-control"><br>
                <label for="name">Item Code</label><br>
                <input type="text" name="code" class="form-control"><br>
                <label for="desc">Description of Item</label><br>
                <input type="text" name="desc" class="form-control"><br>
                <label for="price">Price of Item</label><br>
                <input type="number" name="price" class="form-control"><br>
                <label>Type</label><br>
                <select name="type" id="type" class="form-control">
                    <option value="veg">Veg</option>
                    <option value="nonveg">NonVeg</option>
                    <option value="offer">Offers</option>
                </select><br>
                <button type="submit" name="submit" class="btn btn-success">Add Item</button>
                <div><?php echo $err; ?></div>
            </form>
            <div class="next" style='width:55%;margin:1.5rem 0;'>
            <h3 style='margin:2.2rem 0;'>Manage Items</h3>
                <?php

$sql="SELECT * FROM menu";
$result=$conn->query($sql);

if(isset($_GET['delete_id'])){
    $delete_id=$conn->real_escape_string($_GET['delete_id']);
    $delete_sql="DELETE FROM menu WHERE id=?";
    $delete_stmt=$conn->prepare($delete_sql);
    $delete_stmt->bind_param("i",$delete_id);
    $delete_stmt->execute();
    $delete_stmt->close();
    echo"data deleted";
    // header("Location: storeadditems.php");
    exit;
}
if($result->num_rows>0){
    echo"<table class=' mt-4' style='width:100%'>
    <tr >
    <th>Id</th>
    <th>Item Name</th>
    <th>Code</th>
    <th>Price</th>
    <th>Type</th>
    <th>Delete</th>
    </tr>";
    while($row=$result->fetch_assoc()){
    echo"<tr>
    <td ><span class='screen_cell'>" .$row["id"]."</span></td>
    <td>" .htmlspecialchars($row["iname"])."</td>
    <td><span class='screen_cell'>" .htmlspecialchars($row["code"])."</span></td>
    <td>" .$row["price"]."</td>
    <td><span class='time_cell'>" .htmlspecialchars($row["type"])."</span></td>

    <td>
    <a href='storeadditems.php?delete_id=" . $row["id"]."'class='btn btn-danger btn-sm' >Delete</a>
    </td>
    </tr>";
    }
    echo"</table>";
    }else{
    echo "0 results";
    }
    $conn->close();

    ?>

            </div>


        </div>
        </div>
    </main>
    <div class="side" style="width:100%;background-color: rgb(60, 141, 188);min-height:9vh;
    color:white;font-size:0.9rem;padding-left:4%;padding-top:0.6rem;">
        Copyright © 2024 Brother's Resturant. All rights reserved
    </div>

</body>

</html>