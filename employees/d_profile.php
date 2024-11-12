<?php
session_start(); 
include('../connection.php');

$var = 1;
$msg = '';


if (isset($_POST['picked'])) {
  $updatedAdd ="picked";
  $username= $conn->real_escape_string($_POST['username']);
  $orderid= $conn->real_escape_string($_POST['orderid']);
  $picked_by=$_SESSION['employee_username'];
  $updateSql = "UPDATE orders SET orderstatus = ?,picked_by=? WHERE orderid = ? AND username=?";
  $updateStmt2 = $conn->prepare($updateSql);
  $updateStmt2->bind_param("ssss", $updatedAdd,$picked_by, $orderid,$username);
  $updateStmt2->execute();

  if ($updateStmt2->affected_rows > 0) {
      include "../updated.html";
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
        background-color: #ecf0f5;
      }
      header {
        display: flex;
        justify-content: space-between;
        height: 9vh;
        background-color: rgb(60, 141, 188);
        padding: 0 2rem;
        align-items: center;
        color: white;
      }

      .img {
        width: 50%;
        height: 50%;
      }
      header img {
        height: 40px;
        width: 40px;
      }
      .logo {
        width: 38%;
        font-size: 2rem;
      }
      .admin_profile {
        width: 10%;
        display: flex;
        align-items: center;
        justify-content: end;
      }
      main {
        display: flex;
        justify-content: space-between;
      }
      .side_bar {
        width: calc(18% + 3px);
        background-color: #222d32;
        height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .main_content {
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        /* align-items: center; */
        width: 80%;
      }
      .profile {
        display: flex;
        gap: 1rem;
        padding: 1rem;
      }

      .img2 img {
        height: 40px;
        width: 40px;
      }
      .name p {
        margin: 0.2rem;
        color: white;
        font-size: 0.8rem;
      }
      .links {
        padding: 0.7rem 1rem;
        border-left: 3px solid #1e2429;
      }
      .links:hover {
        background-color: #1e2429;
        border-left: 3px solid #2289de;
      }
      .links a {
        text-decoration: none;
        color: rgb(216, 212, 212);
        font-size: 0.9rem;
        font-weight: 200;
      }
      /* .main_content{

       } */
      .heading {
        margin-top: 1rem;
        font-size: 1.7rem;
        font-weight: 300;
        width: 100%;
        margin-bottom: 1rem;
        color: rgb(62, 62, 62);
      }
      .movie_container {
        background-color: white;
        width: 98%;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-items: center;
        padding: 1rem 0;
      }
      .movie {
        width: 95%;
        display: flex;
        justify-content: space-between;
        background-color: #f4f4f4;
        padding: 0.7rem 1rem;
        margin: 0.1rem 0;
        border-radius: 0.2rem;
        border-left: 2px solid #f4f4f4;
      }
      hr {
        border-top: 2px solid rgb(60, 141, 188);
        width: 98%;
        border-radius: 20px;
        margin: 0;
        margin-bottom: 10px;
      }
      footer{
        width: 102%;
        background-color: #222d32;
        padding: 1.3rem 1rem;
        color: white;
        font-size: 0.8rem;
        margin-top: auto;
        transform: translateX(-25px);
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
  </head>
  <body>
    <header>
      <div class="logo">BROTHER'S RESTAURANT</div>
      <div class="admin_profile">
        <div class="img">
        <img src="admin-icn.png" alt="" style="border-radius:50%;"/>
        </div>
        <p>Employee</p>
      </div>
    </header>
    <main>
      <div class="side_bar">
        <div class="profile">
         
          <div class="name">
            <p><?php echo$_SESSION['employee_name']; ?></p>
            <div
              style="
                display: flex;
                align-items: center;
                gap: 10px;
                color: white;
                font-size: 0.8rem;
              "
            >
              <div
                style="
                  height: 10px;
                  width: 10px;
                  border-radius: 50%;
                  background-color: green;
                "
              ></div>
              Online
            </div>
          </div>
        </div>
        <div class="links" style=" background-color: #1e2429;
        border-left: 3px solid #2289de;">
          <a href="d_profile.php" >HOME</a>
        </div>
        <div class="links">
          <a href="d_delivered.php">Picked Orders</a>
        </div>
        <div class="links" >
          <a href="d_details.php">Profile Details</a>
        </div>
        <div class="links">
          <a href="logout.php">Log Out</a>
        </div>
      </div>

      <div class="main_content">
        <div class="heading">Today's Porduct Deliveries</div>
        <div class="movie_container">
          <hr />
          <?php
              if(isset($_GET['delete_id'])){
                $delete_id=$_GET['delete_id'];
                $sql="DELETE FROM tbl_movie WHERE movie_id= $delete_id";
                if ($conn->query($sql) === TRUE) {
                  echo "Record deleted successfully";
                } else {
                  echo "Error deleting record: " . $conn->error;
                }
              }
              $sql = "SELECT * FROM orders WHERE orderstatus='dispatched' AND cancle_status='0'";
        $sql.= " GROUP BY orderid";
              $result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table >
       <tr >
       <th>S.No.</th>
       <th>Item</th>
       <th>Name</th>
       <th>Address</th>
       <th>Phone no.</th>
       <th>Quantity</th>
       <th>Price</th>
       <th>Order Id</th>
       <th>Payment Status</th>
       <th>Order Date</th>
       <th>Status</th>
       <th>Pick</th>
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
          $usrn=$row2['username'];
          $name="";
          $phone="";
          $address="";
          $sql4 = "SELECT * FROM formdata WHERE username='$usrn'";
          $result4 = $conn->query($sql4);
          {
            $row4=$result4->fetch_assoc();
            $name=$row4['name'];
            $phone=$row4['phone'];
            $address=$row4['address'];
          }
        echo "
<tr>
<td>" . $var++ . "</td>
<td>" . $row2['item'] . "</td>
<td>" . $name. "</td>
<td><span style='background-color: grey;
color: white;
border-radius: 0.6rem;
padding: 0.1rem 0.3rem;'>" . $address. "</span></td>
<td><a style='text-decoration:none;' href='tel:".$phone."'>" . $phone. "</a></td>
<td><span class='screen_cell'>" . $row2['quantity'] . "</span></td>
<td>" . $row2['price'] . "</td>
<td><span class='time_cell'>" . $row2['orderid'] . "</span></td>
<td><span class='screen_cell'>" . $row2['status'] . "</span></td>
<td>" . $row2['createdat'] . "</td>
<td><span class='time_cell'>".$row2['orderstatus'] .
            "</span></td>
<td><form action='d_profile.php' method='post'>
<input type='hidden' name='orderid' value='".$row2['orderid']."'/>
<input type='hidden' name='username' value='".$row2['username']."'/>
<button type='submit'  class='btn btn-sm btn-primary'  name='picked'>  Pick
</button></form></td>

<tr>";
// <tr>";
        }
        $prev_id=$row['orderid'];
    }
    echo "</table>";
}else{
  echo "No Dispatched Orders";
}
              
          ?>
        </div>
        <footer>
          © 2024 Brother Resturant. All rights reserved
      </footer>
      </div>
    </main>
  </body>
  <?php
    $conn->close();
  ?>
</html>
