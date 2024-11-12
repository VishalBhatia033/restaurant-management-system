<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container-fluid">
    <div class="filter" style='margin-top:2rem;align-items:center;'>
                <a href='manageuser.php' class="bt" style='background-color:rgb(60, 141, 188);color:white;'>Manage Users</a>
                <a href='manage_employees.php' class="bt">Manage Employees</a>
            </div>
    <h2 class='mt-4' style='margin:0;font-size:2rem;font-weight:600;text-align:center;margin:2rem 0;'>Manage Users</h2>

    <?php    $sql="SELECT * FROM formdata WHERE prole='1'";
    $result=$conn->query($sql);

    if(isset($_GET['delete_id'])){
        $delete_id=$conn->real_escape_string($_GET['delete_id']);
        $delete_sql="DELETE FROM formdata WHERE id=?";
        $delete_stmt=$conn->prepare($delete_sql);
        $delete_stmt->bind_param("i",$delete_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        echo"data deleted";
        header("Location:manageuser.php");
        exit;
    }
    if($result->num_rows>0){
        echo"<div class='table_container' ><table>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Pin</th>
        <th>Delete</th> 
        </tr>";
        while($row=$result->fetch_assoc()){
        echo"<tr>
        <td><span class='screen_cell'>" .$row["id"]."</span></td>
        <td>" .htmlspecialchars($row["name"])."</td>
        <td>" .htmlspecialchars($row["username"])."</td>
        <td><span class='time_cell'>" .htmlspecialchars($row["email"])."</span></td>
        <td><span class='screen_cell'>" .$row["phone"]."</span></td>
        <td>" .htmlspecialchars($row["address"])."</td>
        <td>" .htmlspecialchars($row["city"])."</td>
        <td>" .htmlspecialchars($row["state"])."</td>
        <td><span class='time_cell'>" .$row["pin"]."</span></td>

        <td>
        <a href='manageuser.php?delete_id=" . $row["id"]."'class='btn btn-danger btn-sm' >Delete</a>
        </td>
        </tr>";
        }
        echo"</table></div>";
        }else{
        echo "0 results";
        }
        $conn->close();

        ?>
        </div>
    </main>
    <div class="side" style="width:100%;background-color: rgb(60, 141, 188);min-height:9vh;
    color:white;font-size:0.9rem;padding-left:4%;padding-top:0.6rem;">
    Copyright © 2024 Brother's Resturant. All rights reserved
    </div>
</body>
</html>