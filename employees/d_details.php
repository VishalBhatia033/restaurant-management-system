<?php
session_start(); 
include('../connection.php');
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
        <div class="links" >
          <a href="d_profile.php" >HOME</a>
        </div>
        <div class="links" >
          <a href="d_delivered.php">Picked Orders</a>
        </div>
        <div class="links" style=" background-color: #1e2429;
        border-left: 3px solid #2289de;">
          <a href="d_details.php">Profile Details</a>
        </div>
        <div class="links">
          <a href="logout.php">Log Out</a>
        </div>
      </div>

      <div class="main_content">
        <div class="heading">Theater Details</div>
        <div class="movie_container">
          <table>
            <tr>
              <td>Name</td>
              <td><?php echo $_SESSION['employee_name'] ?></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><?php echo $_SESSION['employee_address'] ?></td>
            </tr>
            <tr>
              <td>State</td>
              <td><?php echo $_SESSION['employee_state'] ?></td>
            </tr>
            <tr>
                <td>Pin</td>
                <td><?php echo $_SESSION['employee_pincode'] ?></td>
              </tr>

              <tr>
                <td>Job Title</td>
                <td>Delivery Boy</td>
              </tr>
          </table>
        </div>        
        <footer>
          © 2024 Brother Resturant. All rights reserved
      </footer>
    </main>
  </body>
  <?php
    $conn->close();
  ?>
</html>
