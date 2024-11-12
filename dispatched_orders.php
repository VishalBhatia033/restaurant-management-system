<?php
session_start();
include "connection.php";
$var = 1;
$msg = '';

if (isset($_POST['change'])) {
    $updatedAdd = $conn->real_escape_string($_POST['orderstatus']);
 $usernames= $conn->real_escape_string($_POST['username']);

    // $updateSql = "UPDATE orders SET orderstatus = ? WHERE orderid = ? AND username=?";
    $updateSql = "UPDATE orders SET orderstatus = ? WHERE orderid = ? ";
    $updateStmt2 = $conn->prepare($updateSql);
    $updateStmt2->bind_param("si", $updatedAdd, $_POST['orderid']);
    $updateStmt2->execute();

    if ($updateStmt2->affected_rows > 0) {
        include "updated.html";
        // Redirect or further processing
    } else {
        if ($updateStmt2->error) {
            echo "Error updating record: " . $updateStmt2->error;
        } else {
            echo "No changes were made to the record.";
        }
    }
}

if (isset($_POST['change1'])) {
    $updatedAdd = $conn->real_escape_string($_POST['orderstatus']);
 $usernames= $conn->real_escape_string($_POST['username']);

    $updateSql = "UPDATE orders SET orderstatus = ? WHERE orderid = ? AND username=?";
    $updateStmt2 = $conn->prepare($updateSql);
    $updateStmt2->bind_param("sis", $updatedAdd, $_POST['orderid'],$_POST['username']);
    $updateStmt2->execute();

    if ($updateStmt2->affected_rows > 0) {
        include "updated.html";
        // Redirect or further processing
    } else {
        if ($updateStmt2->error) {
            echo "Error updating record: " . $updateStmt2->error;
        } else {
            echo "No changes were made to the record.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
   

    
   
    header {
        display: flex;
        justify-content: space-between;
        height: 11vh;
        background-color: rgb(60, 141, 188);
        padding: 0 2rem;
        align-items: center;
        color: white;
        margin:0;
      }
      .img {
        width: 50%;
        height: 50%;
      }
      header a{
        text-decoration:none;
        color:white;
      }
      .logo:hover{
        color:white;
      }
      header img {
        height: 40px;
        width: 40px;
        border-radius:50%;

      }
      .logo {
        font-size: 2rem;
        margin-left:2%;
      }
      .admin_profile {
        width: 20%;
        display: flex;
        align-items: center;
        justify-content: end;
        gap:1rem;
      }
      .filter {
        display: flex;
        padding: 0 1rem;
        gap: 1rem;
        align-items: center;
      }

      .filter a {
        text-decoration: none;
        color: black;
        border: 1px solid rgb(190, 190, 190);
        padding: 0.4rem 1rem;
        border-radius: 18px;
        font-size: 0.8rem;
        box-shadow: 1px 1px 6px rgb(190, 190, 190);
      }
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
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap" rel="stylesheet">
    <title>Document</title>
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
    <div class="container-fluid" style="width:96%">
    <div class="filter" style='margin-top:2rem;align-items:center;'>
      <a href='manageorder.php' class="bt" >Pending Orders</a>
        <a href='confirmed_orders.php' class="bt" >Confirmed Orders</a>
        <a href='dispatched_orders.php' class="bt"  style='background-color:rgb(60, 141, 188);color:white;' >Dispatched Orders</a>
        <a href='picked.php' class="bt">Picked Orders</a>
        <a href='delivered_orders.php' class="bt" >Delivered Orders</a>
        <a href='cancled_orders.php' class="bt">Cancled Orders</a>
    </div>

    <div style='display:flex;justify-content:center; padding:1.5rem 0;padding-top:3rem;'>
            <form method="POST" action="dispatched_orders.php" class='' style='width:93%;display:flex;gap:2rem;
            align-items:center;'>
                <div style='display:flex;
            align-items:center;gap:1rem; width:25%;'>
                    <label for="">from: </label>
                    <input class="form-control" style='width:80%' name="from" type="date">
                </div>
                <div style='display:flex;
            align-items:center;gap:1rem; width:25%;'>
                    <label for="">to: </label>
                    <input class="form-control" style='width:80%' name="to" type="date">
                </div>

                <input type="submit" name="filter" value="Filter" style='color: white; background-color:#085fd1;
                border:none; outline:none;padding:0.4rem 1.6rem;border-radius:4px;'>
            </form>
        </div>

        <div style='display:flex;justify-content:center; padding:1.5rem 0;padding-top:3rem;'>
                <form method="POST" action="dispatched_orders.php" class='' style='width:93%;display:flex;gap:2rem;
            align-items:center;'>
                    <div style='display:flex;
            align-items:center;gap:1rem; width:45%;'>
                        <label style="width:35%;" for="">Search by Order ID: </label>
                        <input class="form-control" style='width:80%' name="order_id" type="text"
                            placeholder="Search for Order by order ID">
                    </div>
                    <input type="submit" name="id_search" value="Filter" style='color: white; background-color:#00C700;
                border:none; outline:none;padding:0.4rem 1.6rem;border-radius:4px;'>
                </form>
            </div>



        <h2 class='mt-5' style='margin:0;font-size:2rem;font-weight:600;text-align:center;margin:2rem 0;'>Dispatched orders</h2>

        <?php
        if(isset($_POST['filter'])){
          $from = date("Y-m-d", strtotime($_POST['from']));
          $to = date("Y-m-d", strtotime($_POST['to']));
          $sql="SELECT * FROM orders WHERE createdat BETWEEN '$from' AND  '$to' AND orderstatus='dispatched' AND cancle_status='0'  ORDER by id DESC";
        }else{
          $sql = "SELECT * FROM orders WHERE orderstatus='dispatched' AND cancle_status='0'"; 
        $sql.= " GROUP BY orderid";
        
        }
        if(isset($_POST['id_search'])){
          $order_id=$_POST['order_id'];
          $sql="SELECT * FROM orders WHERE orderid='$order_id' AND orderstatus='dispatched' AND cancle_status='0'";
        }else{
          $sql = "SELECT * FROM orders WHERE orderstatus='dispatched' AND cancle_status='0'";
        $sql.= " GROUP BY orderid";
        }

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table_container' ><table >
       <tr >
       <th>S.No.</th>
       <th>Item</th>
       <th>User Id</th>
       <th>Quantity</th>
       <th>Price</th>
       <th>Order Id</th>
       <th>Status</th>
       <th>Order Date</th>
       <th>Change Status</th>
       </tr>";
       $prev_id=0;
       while ($row = $result->fetch_assoc()) {
           $orderid=$row['orderid'];
           if($orderid==$prev_id){
             continue;
           }
           $sql2="SELECT * FROM orders WHERE orderid='$orderid'";
           $result2=$conn->query($sql2);
           $var=1;
        $s=1;
        echo"<tr>
        <td colspan='9' class='text-danger' style='font-weight:bold;'>Order ".$s."</td>
        </tr>";
        $s++;
        while($row2=$result2->fetch_assoc()){
        echo "
<tr>
<td>" . $var++ . "</td>
<td>" . $row2['item'] . "</td>
<td>" . $row2['username'] . "</td>
<td><span class='screen_cell'>" . $row2['quantity'] . "</span></td>
<td>" . $row2['price'] . "</td>
<td><span class='time_cell'>" . $row2['orderid'] . "</span></td>
<td><span class='screen_cell'>" . $row2['status'] . "</span></td>
<td>" . $row2['createdat'] . "</td>
<td>" . "<form action='' method='post'>" .
            '<input type="hidden" name="orderid" value="' . $row2['orderid'] . '"/>' .
            '<input type="hidden" name="username" value="' . $row2['username'] . '"/>' .
            '<select name="orderstatus" >
                <option value="delivered">'.$row2['orderstatus'].'</option>
                <option value="delivered">Delivered</option>
            </select>
            ' .
            "<button type='submit'class='btn btn-sm btn-success'  value='change1' name='change1'>
                Submit
            </button>"
            . "</form>" .
            "</td>
<tr>";
// <tr>";
        }
        $prev_id=$row['orderid'];
    }
    echo "</table></div>";
}else{
  echo "<p class='text-center'>No Products Found</p>";
}

?>

    </div>
</main>
<div class="side" style="width:100%;background-color: rgb(60, 141, 188);min-height:9vh;
    color:white;font-size:0.9rem;padding-left:4%;padding-top:0.6rem;">
    Copyright © 2024 Brother's Resturant. All rights reserved
    </div>

</body>

</html>