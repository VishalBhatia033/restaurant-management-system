<?php
session_start();
include "connection.php";
$var=1;
$num=0;

if(isset($_SESSION['new'])) {
    $edit_id = $_SESSION['new'];
    $sql = "SELECT * FROM formdata WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
    }
} else {
    echo "No ID provided";
}

if(isset($_POST['update'])) {
    $updatedAdd= $conn->real_escape_string($_POST['address']);
    $updatedCity = $conn->real_escape_string($_POST['city']);
    $updatedState = $conn->real_escape_string($_POST['state']);
    $updatedPhone = $conn->real_escape_string($_POST['phone']);
    $updatedPin = $conn->real_escape_string($_POST['pin']);
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
    // $updateStmt->close();
}
// $conn->close();

 

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

        li{
            list-style-type: none;
        }
        li a{color:white;
            text-decoration: none;
        }
        .col-3{
            height: 20%;
        }
        .box{
            /* margin-left:10%; */
            display: none;
        }
        table{text-align:center;
            width:100%;
            margin-top: 10%;
            color: #000;
            background-color:#f7f5f0;
        }
        th{padding: 9px;
            background-color:gray;
        }
        form{
            margin-left: 10px;
            padding:3px;
            width: 100%;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Brother's</title>
</head>
<body>
    <header>
     <?php   include "nav2.php";?>
    </header>
    <br>
    <br>
<main>
<div class="row p-0" style="height: 700px;" >
<div class="col-lg-4 bg-dark text-white text-center mt-5 pt-3">
    <li><a href="#div1" onclick=abc()>Manage Profile</a></li>
    <hr>
    <li><a href="manageorder.php">Manage Orders</a></li>
    <hr>
    <li><a href="storeadditems.php" onclick="">Manage items</a></li>
    <hr>
    <li><a href="manageuser.php">Manage User Data</a></li>
    <hr>
    <li><a href="#div3"onclick="abcde()">Contact us Data</a></li>
    <hr>
</div>

<div class="col-lg-8  mt-5  pt-5 p-0">
<div class="row text-warning ms-5">
    <div class="col-md-3 ms-5 p-4 bg-light"><h2 class='text-center'>Total Users</h2><h3  class='text-center'><?php 
    $sql3="SELECT * FROM formdata WHERE prole='1'";
    if($result=mysqli_query($conn,$sql3)){
        $rowcount=mysqli_num_rows($result);
        echo $rowcount;
    }
    ?></h3></div>
    <div class="col-md-3 ms-5  p-4 bg-light"><h2 class='text-center'>Orders</h2><h3 class='text-center'>
  <?php  $sql4="SELECT * FROM orders";
    if($result=mysqli_query($conn,$sql4)){
        $rowcount=mysqli_num_rows($result);
        echo $rowcount;
    }
    ?>
    </h3></div>
    <div class="col-md-3 ms-5 p-4 bg-"><h2 class='text-center'>Earnings</h2><h3 class='text-center'>

    <?php  $sql4="SELECT * FROM orders WHERE orderstatus='delivered'";
    
        
    ?>
    </h3></div>

</div>
<div class="row text-white">
    <div class="box p-3 pe-5" id="div1" style="width:80%; margin-left:10%;margin-top:20px;background-color: rgba(13, 8, 8, 0.704);">
    <h3 class="text-center">Manage Profile</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="text-align-justify">
           
           <div class="form-group ">
               <label>Name:</label>
               <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" disabled>
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
           <button type="submit" name="update" class="btn btn-primary">Update</button>
           <!-- <a href="index.php">Back</a> -->
       </form>

    </div>
    <div class="box " id="div2" style="width:80%;margin-left:10%;">
 
 <div class="tab1"><?php   $sql="SELECT * FROM orders WHERE orderstatus='pending'";
$result=$conn->query($sql);
if($result->num_rows>0){
        echo "<table>
       <tr>
       <th>S.No.</th>
       <th>Item</th>
       <th>User Id</th>
       <th>Quantity</th>
       <th>Price</th>
       <th>Order Id</th>
       <th>Payment Status</th>
       <th>Order Date</th>
       <th>Order Status</th>
       </tr>
        ";
    while($row=$result->fetch_assoc()){
echo "
<tr>
<td>".$var++  . "</td>
<td>" .$row['item']."</td>
<td>" .$row['username']."</td>
<td>" .$row['quantity']."</td>
<td>" .$row['price']++. "</td>
<td>"  .$row['orderid']. "</td>
<td>"  .$row['status']. "</td>
<td>"  .$row['createdat']."</td>
<td>"  .$row['orderstatus']."</td>
<tr>
";
}echo "</table>";
}

?>

</div>


    </div>
    </div>
    <div class="box ms-3" id="div3" style='width:80%;margin-left:10%;'>
    <?php   $sql="SELECT * FROM contactus";
$result=$conn->query($sql);
if($result->num_rows>0){
        echo "<table>
       <tr>
       <th>S.No.</th>
       <th>Name</th>
       <th>Email</th>
       <th>Subject</th>
       <th>Message</th>
       </tr>
        ";
    while($row=$result->fetch_assoc()){
echo "
<tr>
<td>".$var++  . "</td>
<td>" .$row['sname']."</td>
<td>" .$row['email']."</td>
<td>" .$row['subject']++. "</td>
<td>"  .$row['msg']. "</td>
<tr>
";
}echo "</table>";
}
?>


    </div>
</div>
</div>
</div>


<footer class="mt-5 pt-5">
    <?php
    include "footer.php" ;
    ?>
</footer>
</body>
<script>
    
    var a=document.getElementById("div1");
var b=document.getElementById("div2");
var c=document.getElementById("div3");
    function abc(){
a.style.display="block";
b.style.display="none";
c.style.display="none";

}
function abcd(){

b.style.display="block";
a.style.display="none";
c.style.display="none";

}
function abcde(){

c.style.display="block";
// c.style.textDecoration="underline";
a.style.display="none";
b.style.display="none";

}
</script>
</html>