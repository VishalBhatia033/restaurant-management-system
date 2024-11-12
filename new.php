<!--  -->
<?php
session_start();
include "connection.php";
 $username=$_SESSION["username"];
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;	
foreach ($_SESSION["shopping_cart"] as $product){

$item= $product["name"];
$price= $product["price"];
$quantity=$product["quantity"];
$sql = "INSERT INTO orders (item,price,username,quantity) VALUES ( ?,?,?,?)";

 // Prepare and bind
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sis", $item,$price,$username);

 // Execute the statement
 if ($stmt->execute()) {
     $successMsg = "Student Added successfully";

     } else {
         $errorMsg =  "Error: " . $insertSql->error;
     }
    }}

?>