<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    a[disabled="disabled"] {
        pointer-events: none;
    }

    .table_container {
        display: flex;
        justify-content: center;
        background-color: white;
        margin-bottom: 2rem;


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

    hr {
        border-top: 2px solid rgb(211, 211, 211);
        border-radius: 40%;
    }

    .cake_details {
        position: absolute;
        display: flex;
        flex-direction: column;
        padding: 0.5rem;
        border-radius: 5px;
        background-color: #ecf0f5;
        color: black;
        width: 400%;
        z-index: 4;
        top: -200%;
        right: -420%;
        border: 1px solid black;
    }
    header {
        display: flex;
        justify-content: space-between;
        height: 9vh;
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
      <div class="side" style="width:5%;background-color: rgb(60, 141, 188);min-height:100vh;">

      </div>
    <div class="container-fluid" style="width:95%">
        <div style='display:flex;justify-content:center; padding:1.5rem 0;padding-top:3rem;'>
            <form method="POST" action="reservation.php" class='' style='width:93%;display:flex;gap:2rem;
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

        <?php    
        if(isset($_POST['filter'])){
          $from = date("Y-m-d", strtotime($_POST['from']));
          $to = date("Y-m-d", strtotime($_POST['to']));
          $sql="SELECT * FROM table_reservations WHERE date BETWEEN '$from' AND  '$to' ORDER by id DESC";
        }else{
          $sql="SELECT * FROM table_reservations";
        }
    $result=$conn->query($sql);


    
    if(isset($_GET['delete_id'])){
        $delete_id=$conn->real_escape_string($_GET['delete_id']);
        $delete_sql="DELETE FROM table_reservations WHERE id=?";
        $delete_stmt=$conn->prepare($delete_sql);
        $delete_stmt->bind_param("i",$delete_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        echo"data deleted";
        header("Location:reservation.php");
        exit;
    }
    if(isset($_GET['approve'])){
      $id=$_GET['approve'];
      $sql = "UPDATE table_reservations SET status=1 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error updating record: " . $conn->error;
}
  }
  if(isset($_GET['cancle'])){
    $id=$_GET['cancle'];
    $sql = "UPDATE table_reservations SET status=0 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
echo "";
} else {
echo "Error updating record: " . $conn->error;
}
}
    if($result->num_rows>0){
        echo"<hr> <div class='table_container' > <table class=''>
        <tr >
        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Meal Type</th>
        <th>Persons</th>
        <th>Date</th>
        <th>Reservation made on</th>
        <th>Status</th>
        <th>Approve</th>
        <th>Cancle Approved</th>
        <th>Delete</th>

        </tr>";
        $i=1;
        $ind=0;
        while($row=$result->fetch_assoc()){
          $username=$row['username'];
          $sql2="SELECT * FROM formdata WHERE username='$username'";
          $result2=$conn->query($sql2);
          $row2=$result2->fetch_assoc();
          $status='';
          $color="";
          $exp_color1="btn-success";
          $exp_color2="btn-warning";
          $clr="";
          if($row['status']==0){
            $status="Pending";
            $clr="#e89510";
            $color="text-warning";
          }else if($row['status']==1){
            $status="Approved";
            $color="text-success";
            $clr="green";
          }
          $new_date = date('Y-m-d');
          $expired="";
          if($row["date"]<$new_date){
            $expired="disabled";
            $status="Expired";
            $color="text-danger";
            $clr="red";
            $exp_color="";
            $exp_color1="btn-secondary";
            $exp_color2="btn-secondary";
          }
          $persons=$row["persons"];
          if($row['booking_type']==1){
            $persons="FULL";
          }
          $birthday_details="";
          $fun='';
          $cake_logo='';
          if($row["meal_type"]=="Birthday"){
            $id=$row['id'];
            $sql3="SELECT * FROM cake_orders WHERE reservation_id='$id'";
            $result3=$conn->query($sql3);
            if($result3->num_rows>0){
              $row3=$result3->fetch_assoc();
              $row3['cake_shape'];
              $row3['person_name'];
              $row3['cake_flavors'];
              $cake_logo='&nbsp;<i class="fa-solid fa-cake-candles" style="cursor:pointer;"></i>&nbsp;';
              $birthday_details="<span class='cake_details' style='display:none;'>
              <span style='position:absolute;border:8px solid transparent; border-right:8px solid black;
              left:-6%;top:45%;'></span>
              <p style='margin-bottom:7px;'><strong>Cake Shape: </strong> <span>".$row3['cake_shape']."</span></p>
              <p style='margin-bottom:7px;'><strong>Cake Flavour: </strong> <span>".$row3['cake_flavors']."</span></p>
              <p style='margin-bottom:7px;'><strong>Name on Cake: </strong> <span>".$row3['person_name']."</span></p>
              </span>";
              $ind++;
              $fun="onclick='disp(".($ind-1).")'";
            }
          }
          $date_of_row = date("d-m-Y", strtotime($row['date']));
        echo"<tr>
        <td>" .$i++."</td>
        <td>" .htmlspecialchars($row2["name"])."</td>
        <td>" .htmlspecialchars($row2["phone"])."</td>
        <td > <span ".$fun." style='position:relative;z-index:1;' class='screen_cell'> " .$row["meal_type"].$cake_logo.$birthday_details."</span></td>
        <td > <span class='time_cell'>" .$persons."</span></td>
        <td>" .$date_of_row."</td>
        <td>" .htmlspecialchars($row["res_made_date"])."</td>
        <td ><span style='background-color: ".$clr.";
        color: white;
        border-radius: 0.6rem;
        padding: 0.1rem 0.3rem;'>" .$status."</span></td>
        <td>
        <a disabled='".$expired."' href='reservation.php?approve=" . $row["id"]."'class='btn ".$exp_color1." btn-sm' >Approve</a>
        </td>
        <td>
        <a disabled='".$expired."' href='reservation.php?cancle=" . $row["id"]."'class='btn ".$exp_color2." btn-sm' >Cancle</a>
        </td>

        <td>
        <a href='reservation.php?delete_id=" . $row["id"]."'class='btn btn-danger btn-sm' >Delete Reservation</a>
        </td>
        </tr>";
        }
        echo"</table> </div> <hr>";
        }else{
        echo "0 results";
        }
        $conn->close();

        ?>
    </div>
    </main>
    <div class="side" style="width:100%;background-color: rgb(60, 141, 188);min-height:7vh;">

</div>
    <script>
    let prev_ind = -1;

    function disp(index) {
    console.log(index)
        let data = document.getElementsByClassName("cake_details");
        if (prev_ind == index) {
            data[index].style.display = "none";
        } else {
            for (let i = 0; i < data.length; i++) {
                if (i == index) {
                    data[i].style.display = "block";
                } else {
                    data[i].style.display = "none";
                }
            }
        }

        if (prev_ind == index) {
            prev_ind = -1;
        } else {
            prev_ind = index;
        }
    }
    </script>
</body>

</html>