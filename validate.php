<?php
session_start();

include "connection.php"; // Include your database connection file

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    // SQL query to get the logged-in user's profile
    //$sql = "SELECT * FROM st_profile WHERE username = ?";
    $sql = "SELECT * FROM formdata
    WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
    
?>


<!DOCTYPE html>
<html>
    <head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
    <?php
        if($role==1){
//  echo "<strong>Name</strong> " 
 $_SESSION['names']= $row["name"] ;
 $_SESSION['new']=$row["id"];
header('location:index.php');

    } 
    else{
 $_SESSION['new']=$row["id"];
 $_SESSION['names']= $row["name"] ;

        header("location:admin.php");
    }
    echo "<div><a class='btn btn-primary' href='logout.php'>Logout</a></div>
    
    </div>";

}
else {
    echo "<div class='container mt-5'><p>User profile not found.</p></div>";
    }
    } else {
    echo "<div class='container mt-5'><p>Please log in to view this page.</p></div>";
    }


$conn->close();
?>
</body>
</html>
