<?php
session_start();
include "connection.php";
$total_price="";
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
        $updatedAdd= $conn->real_escape_string($_POST['address']);
        $updatedCity = $conn->real_escape_string($_POST['city']);
        $updatedState = $conn->real_escape_string($_POST['state']);
        $updatedPhone = $conn->real_escape_string($_POST['phone']);
        $updatedPin = $conn->real_escape_string($_POST['pin']);
       
        // Update SQL query
        $updateSql = "UPDATE formdata SET   address = ?,city = ?,state= ? ,phone=?,pin=? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssiii", $updatedAdd,$updatedCity, $updatedState, $updatedPhone,$updatedPin, $edit_id);
        $updateStmt->execute();
    
        if ($updateStmt->affected_rows > 0) {
            echo "Record updated successfully";
            // Redirect or further processing
        } else {
            if($updateStmt->error) {
                echo "Error updating record: " . $updateStmt->error;
            } else {
                echo "No changes were made to the record.";
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
    #tre {
        margin-top: 50px;
        color: white;
        padding: 10px;
    }
    </style>

    <link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brother's/bill</title>
</head>

<body style='
        background-image:url(./images/bar.jpeg);
        background-repeat:no-repeat;
        background-size:cover;
        padding-bottom:4rem;
        padding-top:4rem;


'>
    <div class="contianer-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-dark" id='tre'>
                <h3>Billing Details</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>City:</label>
                        <input type="text" name="city" value="<?php echo htmlspecialchars($row['city']); ?>"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>State:</label>
                        <input type="text" name="state" value="<?php echo htmlspecialchars($row['state']); ?>"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pin:</label>
                        <input type="text" name="pin" value="<?php echo htmlspecialchars($row['pin']); ?>"
                            class="form-control">
                    </div>
                    <br>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <!-- <a href="index.php">Back</a> -->
                </form>

            </div>
            <div class="col-md-4 mt-2 p-3 ms-4  bg-dark">
                <h3 class="text-white text-center">Your Order</h3>
                <?php

    $status="";
    if (isset($_POST['action']) && $_POST['action']=="remove"){
    if(!empty($_SESSION["shopping_cart"])) {
        foreach($_SESSION["shopping_cart"] as $key => $value) {
            if($_POST["code"] == $key){
            unset($_SESSION["shopping_cart"][$key]);
            $status = "<div class='box' style='color:red;'>
            Product is removed from your cart!</div>";
            }
            if(empty($_SESSION["shopping_cart"]))
            unset($_SESSION["shopping_cart"]);
                }		
            }
    }
    
    
    ?>

                <?php
    if(isset($_SESSION["shopping_cart"])){
        $total_price = 0;
    ?>
                <table class="table bg-light">
                    <tbody>
                        <tr class='bg-light'>
                            <td></td>
                            <td>ITEM NAME</td>
                            <td>QUANTITY</td>
                            <td>UNIT PRICE</td>
                            <td>ITEMS TOTAL</td>
                        </tr>
                        <?php		
    foreach ($_SESSION["shopping_cart"] as $product){
    ?>
                        <tr>
                            <td><img src='files/<?php echo $product["image"];?>' width="80" height="60" /></td>
                            <td><?php echo $product["name"]; $_SESSION["pname"]=$product["name"];?><br />
                                <form method='post' action=''>
                                    <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                    <!-- <input type='hidden' name='action' value="remove" /> -->
                                    <!-- <button type='submit' class='remove border-1 text-white bg-danger'>Remove Item</button> -->
                                </form>
                            </td>
                            <td>
                                <form method='post' action='<?php echo $_SERVER['PHP_SELF'];?>'>
                                    <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                    <input type='hidden' name='action' value="change" />
                                    <select name='quantity' class='quantity' onchange="this.form.submit()" disabled>
                                        <option <?php if($product["quantity"]==1) echo "selected";?> value="1">1
                                        </option>
                                        <option <?php if($product["quantity"]==2) echo "selected";?> value="2">2
                                        </option>
                                        <option <?php if($product["quantity"]==3) echo "selected";?> value="3">3
                                        </option>
                                        <option <?php if($product["quantity"]==4) echo "selected";?> value="4">4
                                        </option>
                                        <option <?php if($product["quantity"]==5) echo "selected";?> value="5">5
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo "Rs.".$product["price"]; ?></td>
                            <td><?php echo "Rs.".$product["price"]*$product["quantity"]; ?></td>
                        </tr>
                        <?php
    $total_price += ($product["price"]*$product["quantity"]);
    }}
    $_SESSION["total"]=$total_price;
    ?>
                        <tr>
                            <td colspan="5" align="right">
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <br>
        <div class="bts text-center">
            <a href="gate.php" class=" btn btn-success" style="margin-left:30px;">
                <strong>Proceed to Pay <?php echo "Rs. ".$total_price; ?></strong>

            </a>
            <a href="cart.php" class="btn btn-primary">Back</a>
        </div>
</body>

</html>