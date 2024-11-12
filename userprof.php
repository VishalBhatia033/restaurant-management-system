<?php
session_start();
include "connection.php";
$msg="";
    if(isset($_SESSION['new'])) {
        $edit_id = $_SESSION['new'];
        $sql = "SELECT * FROM formdata WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Now $row contains the data of the record to be edited
        } else {
            echo "No record found";
            // Redirect or handle the error
        }
    } else {
        echo "No ID provided";
        // Redirect or handle the error
    }
    
    if(isset($_POST['update'])) {
        // Get the updated data from the form
        $updatedName= $conn->real_escape_string($_POST['name']);
        $updatedAdd= $conn->real_escape_string($_POST['address']);
        $updatedCity = $conn->real_escape_string($_POST['city']);
        $updatedState = $conn->real_escape_string($_POST['state']);
        $updatedPhone = $conn->real_escape_string($_POST['phone']);
        $updatedPin = $conn->real_escape_string($_POST['pin']);
       
        // Update SQL query
        $updateSql = "UPDATE formdata SET name=?,address = ?,city = ?,state= ? ,phone=?,pin=? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssssiii",$updatedName, $updatedAdd,$updatedCity, $updatedState, $updatedPhone,$updatedPin, $edit_id);
        $updateStmt->execute();
    
        if ($updateStmt->affected_rows > 0) {
            $msg= "Record updated successfully";
            // Redirect or further processing
        } else {
            if($updateStmt->error) {
                $msg= "Error updating record: " . $updateStmt->error;
            } else {
                $msg= "No changes were made to the record.";
            }
        }
        $updateStmt->close();
    }
    $conn->close();
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
         body{
        background-image:url(./images/bar.jpeg);
        background-size:cover;
        background-repeat:no-repeat;
    }

        
            form{
    background-image:url(./images/back2.jpg);
    background-size:cover;
    padding:10px 20px;margin-top: 10px;
    margin:0 auto;
    color:white;
    font-weight:bold;
    font-size:22px;
}
        
    </style>
    <link rel="icon" href="./images/icon.ico" type="image/x-icon">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brother's/Edit Details</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form-group" style="width:50%;">
           
           <div class="form-group">
               <label>Name:</label>
               <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control">
           </div>
       
           <div class="form-group">
               <label>Address:</label>
               <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" class="form-control">
           </div>
           
           <div class="form-group">
               <label>City:</label>
               <input type="text" name="city" value="<?php echo htmlspecialchars($row['city']); ?>" class="form-control">
           </div>
           
           <div class="form-group">
               <label>State:</label>
               <input type="text" name="state" value="<?php echo htmlspecialchars($row['state']); ?>" class="form-control">
           </div>
           <div class="form-group">
               <label>Phone Number:</label>
               <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" class="form-control">
           </div>
           <div class="form-group">
               <label>Pin:</label>
               <input type="text" name="pin" value="<?php echo htmlspecialchars($row['pin']); ?>" class="form-control">
           </div>
          <br>
          <?php echo "<span class='text-success bg-white'>". $msg."</span>"."</br>" ?>
           <button type="submit" name="update" class="btn btn-primary">Update</button>
           <a href="logout.php" class="btn btn-danger">Back</a>
           <!-- <a href="index.php">Back</a> -->
       </form>
</body>
</html>