<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targetDir = "files/";
    $targetFile = $targetDir . basename($_FILES["imgfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["imgfile"]["tmp_name"]);
    if ($check === false) {
        echo "Error: File is not an image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Error: File already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES["imgfile"]["size"] > 5 * 1024 * 1024) {
        echo "Error: File is too large. Please choose a smaller file.";
        $uploadOk = 0;
    }

    // Allow only certain image file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Error: Your file was not uploaded.";
    } else {
        // Move the file to the specified directory
        if (move_uploaded_file($_FILES["imgfile"]["tmp_name"], $targetFile)) {
            $filename = htmlspecialchars(basename($_FILES['imgfile']["name"]));
            $iname = $conn->real_escape_string($_POST['imgname']);
            $desc = $conn->real_escape_string($_POST['desc']);
            $price = $conn->real_escape_string($_POST['price']);
            $category = $conn->real_escape_string($_POST['category']);
            $type = $conn->real_escape_string($_POST['type']);

            $stmt = $conn->prepare("INSERT INTO  menu (image, iname, description, price, category, type) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $filename, $iname, $desc, $price, $category, $type);

            if ($stmt->execute()) {
                echo "<p class='text-success text-center'>The file " . $filename . " has been uploaded and saved in the database</p>";
                echo "Data inserted";
            } else {
                echo "There was an error uploading this file to the database.";
            }

            $stmt->close();
        } else {
            echo "Error: There was an error uploading your file.";
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
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="post">
        <label for="image">Add Image</label>
        <input type="file" name="imgfile">
        <label for="name">Name of Item</label>
        <input type="text" name="imgname">
        <label for="desc">Description of Item</label>
        <input type="text" name="desc">
        <label for="price">Price of Item</label>
        <input type="number" name="price">
        <label for="catr">Category of Item</label>
        <select name="category">
            <option value="burger">Burger</option>
            <option value="salad">Salad</option>
            <option value="cake">Cakes</option>
            <option value="drinks">Drinks</option>
            <option value="pizza">Pizza</option>
            <option value="chicken">Chicken</option>
        </select>
        <label>Type</label>
        <select name="type" id="type">
            <option value="veg.png">Veg</option>
            <option value="nonveg.png">NonVeg</option>
            <option value="">None</option>
        </select>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
