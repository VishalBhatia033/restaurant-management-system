<?php
session_start();
    //  $name= $_SESSION['names'];

?>
<?php
include "connection.php";
$disable='';
if(isset($_SESSION['username'])){
$us=$_SESSION['username'];
$result11 = mysqli_query($conn,"SELECT * FROM `comments` WHERE username= '$us'");
$row11 = mysqli_fetch_assoc($result11);
if(isset($row11['username'])){
  $disable="disabled";
}
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {
  if(isset($_GET["cake"]) && ($_GET["cake"]=="cancle")){
    $_SESSION['birthday']='';
  }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST["submit_cake"])){
      $cake_flavors=$_POST['Flavors'];
      $cake_shape=$_POST['cake_shape'];
      $person_name=$_POST['pname'];
      $reservation_id=$_SESSION['res_id'];
      $sql = "INSERT INTO cake_orders(cake_shape,reservation_id,person_name,	cake_flavors) VALUES (?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("siss", $cake_shape,$reservation_id,$person_name,$cake_flavors);
      if ($stmt->execute()) {
        $successMsg = "Successfully Submitted";
        $_SESSION['birthday']='';

          }else{
            $errorMsg =  "Error: " . $insertSql->error;
          }
    }
    
  }



$successMsg="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST["comment"])){
    if(isset($_SESSION['username'])){
      $username=$_SESSION['username'];
      $result1 = mysqli_query($conn,"SELECT * FROM `formdata` WHERE username= '$username'");
      $row = mysqli_fetch_assoc($result1);
      $user_name = $row['name'];
      $user_email = $conn->real_escape_string($_POST['user_email']);
      $comment= $conn->real_escape_string($_POST['message']);
      $sql = "INSERT INTO comments(name,email,comment,username) VALUES (?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $user_name,$user_email,$comment,$username);
      if ($stmt->execute()) {
        $successMsg = "Successfully Submitted";
          }else{
            $errorMsg =  "Error: " . $insertSql->error;
          }
      }
    }
    
  }
$booking_msg='';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST["book"])){
    if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    $date = $conn->real_escape_string($_POST['booking_date']);
    $result2 = mysqli_query($conn,"SELECT * FROM `table_reservations` WHERE username='$username'");
    
    $row = mysqli_fetch_assoc($result2);
    if($result2->num_rows>0){
      $type=0;
      $result3 = mysqli_query($conn,"SELECT * FROM `table_reservations` WHERE username='$username' AND date='$date' AND booking_type='$type'");
      $row2 = mysqli_fetch_assoc($result3);
       if(isset($row2['date'])){
        $booking_msg="<p>you can't have more than one reservations for this date</p>";
       }else{
        $persons = $conn->real_escape_string($_POST['people']);
        $meal_type= $conn->real_escape_string($_POST['meal_type']);
        $booking_type= 0;
        $sql = "INSERT INTO table_reservations(date,persons,meal_type,username,booking_type) VALUES ( ?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $date,$persons,$meal_type,$username,$booking_type);
        if ($stmt->execute()) {
          $booking_msg="<p>booked</p>";
            }else{
              $errorMsg =  "Error: " . $insertSql->error;
            }
        }
      }else{
        $persons = $conn->real_escape_string($_POST['people']);
        $meal_type= $conn->real_escape_string($_POST['meal_type']);
        $booking_type= 0;
        $sql = "INSERT INTO table_reservations(date,persons,meal_type,username,booking_type) VALUES ( ?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissi", $date,$persons,$meal_type,$username,$booking_type);
        if ($stmt->execute()) {
          $booking_msg="<p>booked</p>";
            }else{
              $errorMsg =  "Error: " . $insertSql->error;
            }
      }
    }

    
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST["special_booking"])){
    if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    $sdate = $conn->real_escape_string($_POST['sbooking_date']);
    $result2 = mysqli_query($conn,"SELECT * FROM `table_reservations` WHERE username='$username'");
    $row = mysqli_fetch_assoc($result2);
    if(isset($row['username'])){
      $type=1;
      $result3 = mysqli_query($conn,"SELECT * FROM `table_reservations` WHERE username='$username' AND date='$sdate' AND booking_type='$type'");
      $row2 = mysqli_fetch_assoc($result3);

      if(isset($row2['date'])){
        $booking_msg="<p>you can't have more than one reservations for this date</p>";
      }else{
        $persons = 0;
        $meal_type= $conn->real_escape_string($_POST['booking_type']);
        if($_POST['booking_type']=="Birthday"){
          $_SESSION['birthday']='yes';
        }
        $decorations= $conn->real_escape_string($_POST['decorations']);
        $sbooking_time= $conn->real_escape_string($_POST['sbooking_time']);
        $booking_type=1;
        $sql = "INSERT INTO table_reservations(date,persons,meal_type,username,booking_type,decorations,sbooking_time) VALUES ( ?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sississ", $sdate,$persons,$meal_type,$username,$booking_type,$decorations,$sbooking_time);
        if ($stmt->execute()) {
          $result4 = mysqli_query($conn,"SELECT * FROM `table_reservations` WHERE id=(SELECT MAX(id) FROM `table_reservations`)");
          $row4 = mysqli_fetch_assoc($result4);
          $_SESSION['res_id']=$row4['id'];
          $booking_msg="<p>booked</p>";
            }else{
              $errorMsg =  "Error: " . $insertSql->error;
            }
        }
      }else{
        $decorations= $conn->real_escape_string($_POST['decorations']);
        $sbooking_time= $conn->real_escape_string($_POST['sbooking_time']);
        $booking_type=1;
        $sql = "INSERT INTO table_reservations(date,persons,meal_type,username,booking_type,decorations,sbooking_time) VALUES ( ?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sississ", $sdate,$persons,$meal_type,$username,$booking_type,$decorations,$sbooking_time);
        if ($stmt->execute()) {
          $result4 = mysqli_query($conn,"SELECT * FROM `table_reservations` WHERE id=(SELECT MAX(id) FROM `table_reservations`)");
          $row4 = mysqli_fetch_assoc($result4);
          $_SESSION['res_id']=$row4['id'];
          $booking_msg="<p>booked</p>";
            }else{
              $errorMsg =  "Error: " . $insertSql->error;
            }
      }
    }

    
  }
}

 
?>
<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
<head>
    <style>
    body {
        position: relative;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
        font-family: "M PLUS 1 Code", monospace;
        background-color: white;
        position: sticky;
        top: 0;
    }

    .logo {
        height: 5rem;
        width: 8%;
    }

    .logo img {
        height: 100%;
        width: 100%;
    }

    .links {
        width: 60%;
        display: flex;
        justify-content: space-between;
        background: rgb(242, 103, 103);
        background: rgb(247, 117, 117);
        background: linear-gradient(90deg,
                rgba(247, 117, 117, 1) 0%,
                rgba(212, 9, 9, 1) 39%,
                rgba(107, 0, 0, 1) 100%);
        padding: 0.5rem 1rem;
        border-radius: 10px;
    }

    body {
        position: relative;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "M PLUS 1 Code", monospace;
    }

    #banner_video {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 0;
        margin: 0;
        z-index: -4;
        width: calc(99vw - 4px);
    }

    /* banner */
    .banner {
        padding: 2rem;
        height: 85vh;
        width: calc(100vw - 5rem);
        font-family: "M PLUS 1 Code", monospace;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .banner h1 {
        padding: 0;
        margin: 0;
        font-size: 6rem;
    }

    .first {
        text-decoration: underline;
        color: red;
        font-weight: 900;
    }

    .second {
        color: white;
        font-weight: 900;

    }

    .design1 {
        display: flex;
        align-items: center;
        margin-top: 2rem;
    }

    .location {
        margin-top: 2rem;
        color: white;
        margin-bottom: 2rem;
    }

    /* main  */
    main {
        background-color: white;
        height: 100%;
        font-family: "M PLUS 1 Code", monospace;
    }

    .our_services {
        display: flex;
        padding: 2rem;
        justify-content: space-around;
    }

    .our_services p {
        text-align: center;
        padding: 0;
        margin: 0;
        margin: 1rem 0;
    }

    .card1 {
        border: 1px solid rgb(234, 234, 234);
        box-shadow: 3px 3px rgb(203, 202, 202);
        border-radius: 2px;
        padding: 1rem 2rem;
    }

    .con1 {
        display: flex;
        justify-content: center;
        font-size: 1.2rem;
    }

    .we_provied {
        text-align: center;
        padding: 0;
        margin: 0;
        margin: 1rem 0;
    }

    .card2 {
        /* border: 1px solid rgb(234, 234, 234);
        box-shadow: 3px 3px rgb(203, 202, 202);
        border-radius: 2px;
        padding: 1rem 2rem;
        transition: 0.2s all ease; */
        background: linear-gradient(rgb(156, 4, 4) 0 0) var(--p, 0) / var(--p, 0) no-repeat;
        transition: 0.4s, background-position 0s;

    }

    .card2:hover {
        --p: 100%;
        color: #fff;
    }


    /* footer  */
    footer {
        display: flex;
        background-color: white;
        padding: 2rem 2rem;
        align-items: center;
        justify-content: space-around;
    }

    .footer_links {
        width: 50%;
        display: flex;
        justify-content: space-between;
        background: rgb(242, 103, 103);
        background: rgb(247, 117, 117);
        background: linear-gradient(90deg,
                rgba(247, 117, 117, 1) 0%,
                rgba(212, 9, 9, 1) 39%,
                rgba(107, 0, 0, 1) 100%);
        padding: 0.5rem 1rem;
        border-radius: 10px;
    }

    .footer_links a {
        text-decoration: none;
        color: white;
        font-size: 0.9rem;
        padding: 0.4rem 0.7rem;
        border-radius: 5px;
        transition: 0.2s all ease;
    }

    .footer_links a:hover {
        background-color: white;
        color: black;
    }

    .socialmedia a {
        color: black;
        text-decoration: none;
        font-size: 1rem;
    }

    .reserve_box {
        margin: 2rem 5.2rem;
        padding: 2rem 2rem;
        box-shadow: 0 11px 12px 0 rgba(0, 0, 0, 0.07);
        border: 1px solid rgba(0, 0, 0, 0.07);
    }

    label {
        font-size: 0.9rem;
        font-weight: 500;
    }

    #book_table {
        display: flex;
        justify-content: space-between;
        background-color: #f2f2f2;
        padding: 1rem 2rem;
    }

    .inpt {
        width: 16%;
    }

    .dsg:hover {
        transform: scale(1.1);
        transition: 0.7s all ease;
    }

    /* cup animation  */

    #container {
        position: absolute;
        width: 40%;
        top: 20%;
        left: 37%;
        /* transform: translate(-50%, -50%);  */

    }

    .steam {
        position: absolute;
        height: 150px;
        width: 150px;
        border-radius: 50%;
        background-color: #a1a1a1;
        margin-top: -75px;
        margin-left: 75px;
        z-index: 0;
        opacity: 0;
    }

    #steam1 {
        -webkit-animation: steam1 4s ease-out infinite;
        animation: steam1 4s ease-out infinite;
    }

    #steam3 {
        -webkit-animation: steam1 4s ease-out 1s infinite;
        animation: steam1 4s ease-out 1s infinite;
    }

    @-webkit-keyframes steam1 {
        0% {
            transform: translateY(0) translateX(0) scale(0.25);
            opacity: 0.2;
        }

        100% {
            transform: translateY(-200px) translateX(-20px) scale(1);
            opacity: 0;
        }
    }

    @keyframes steam1 {
        0% {
            transform: translateY(0) translateX(0) scale(0.25);
            opacity: 0.2;
        }

        100% {
            transform: translateY(-200px) translateX(-20px) scale(1);
            opacity: 0;
        }
    }

    #steam2 {
        -webkit-animation: steam2 4s ease-out 0.5s infinite;
        animation: steam2 4s ease-out 0.5s infinite;
    }

    #steam4 {
        -webkit-animation: steam2 4s ease-out 1.5s infinite;
        animation: steam2 4s ease-out 1.5s infinite;
    }

    @-webkit-keyframes steam2 {
        0% {
            transform: translateY(0) translateX(0) scale(0.25);
            opacity: 0.2;
        }

        100% {
            transform: translateY(-200px) translateX(20px) scale(1);
            opacity: 0;
        }
    }

    @keyframes steam2 {
        0% {
            transform: translateY(0) translateX(0) scale(0.25);
            opacity: 0.2;
        }

        100% {
            transform: translateY(-200px) translateX(20px) scale(1);
            opacity: 0;
        }
    }

    #cup {
        z-index: 1;
    }

    #cup-body {
        position: absolute;
        height: 200px;
        width: 300px;
        border-radius: 0 0 150px 150px;
        background-color: #03a5fc;
        margin: auto;
        display: inline-block;
        overflow: hidden;
        z-index: 1;
    }

    #cup-shade {
        position: relative;
        height: 300px;
        width: 200px;
        background-color: #0384fc;
        display: inline-block;
        margin-left: 42%;
        margin-top: -3px;
        transform: rotate(50deg);
        z-index: 1;
    }

    #cup-handle {
        position: relative;
        height: 75px;
        width: 80px;
        border-radius: 0 150px 150px 0;
        border: 15px solid #0384fc;
        margin-bottom: 95px;
        margin-left: 250px;
        display: inline-block;
        z-index: 0;
    }

    #saucer {
        position: absolute;
        height: 30px;
        width: 300px;
        border-radius: 0 0 100px 100px;
        background-color: #03a5fc;
        margin-top: -0px;
        margin-left: 5px;
        z-index: 1;
    }

    #shadow {
        height: 10px;
        width: 300px;
        border-radius: 50%;
        margin-top: 28px;
        margin-left: 6px;
        background-color: #bab8b8;
    }

    </style>
    <link rel="icon" href="./images/icon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
  if(isset($_SESSION['birthday']) && ($_SESSION['birthday']=='yes')){
    include "cake_booking.php";
  }
  ?>

    <video id='banner_video' src="background_video.webm" muted autoplay loop></video>
    <?php
        include "nav.php";
        ?>

    <div class="banner">
        <h2 style="color: white; padding: 0; margin: 0; margin-top: 3rem;font-size:1.2rem;">
            Welcome to
        </h2>
        <h1>
            <span class="first">brother's</span><span class="second"> restaurant</span>
        </h1>
        <p style="color: white; font-size: 1rem; width: 70%;margin-top:0.7rem">
            Food, in the end, in our own tradition, is something holy. It's not
            about nutrients and calories. It's about sharing. It's about honesty.
            It's about identity.
        </p>
        <div class="design1" style='align-items:center;'>
            <span style="color: yellow; font-size: 1.6rem">Hungry !</span>
            <hr style="border: 1px solid rgb(197, 197, 197); width: 30%; margin: 0 0.5rem" />
            <span style="color: rgb(197, 197, 197)">Deliciuos food and best Services we provide</span>
            <img src="scotter2.gif" height='150' width='150' alt="">
        </div>
        <div class="location" style='margin-top:3rem;'>
            <i class="fa-regular fa-clock"></i> 9:00 - 22:00
            <i class="fa-solid fa-location-dot"></i> Near Career Point University
            Hamirpur
        </div>
    </div>

    <main style='padding-top:2rem;'>
        <div class="con1">
            <p style="
            background: linear-gradient(
              90deg,
              rgba(247, 117, 117, 1) 0%,
              rgba(212, 9, 9, 1) 39%,
              rgba(107, 0, 0, 1) 100%
            );
            padding: 0.5rem 1rem;
            border-radius: 9px;
            color: white;
          ">
                Follow us on Facebook and Instagram to see daily special in your feed
                <a href="#" style="text-decoration: none; color: white"><i class="fa-solid fa-arrow-right"></i></a>
            </p>
        </div>

        <div style="display:flex;gap:2rem;margin:4rem 0;background-size: 300px;
             background-image: url('images/footerbg.png');
             background-repeat:  repeat;
             background-color: #cccccc;padding:4rem 4rem;">

        </div>
        <div style='height:100%;width:100%; display:flex; justify-content:space-around;margin-top:3rem;'>
            <div style='width:45%;display:flex;flex-direction:column;align-items:center;border:2px solid grey;
            padding:3rem 0;text-align:center;'>
                <h3>VISIT US</h3>
                <hr style='width:80%;border:2px solid grey;'>
                <p style='width:30%;text-decoration:underline;'>Near Career Point University Hamirpur (415) 673-7200</p>
                <div>
                    <p style='font-weight:600;margin-bottom:0;'>Monday - Sunday
                    </p>
                    <p style="font-size:0.9rem;color:grey;">10:00 am - 11:00 pm</p>
                </div>
                <div>
                    <p style='font-weight:600;margin-bottom:0;'>Happy Hour
                    </p>
                    <p style="font-size:0.9rem;color:grey;">11:00 am - 5:00 pm Monday-Friday</p>
                </div>
            </div>
            <div style='width:45%;  background-size: 300px;
             background-image: url("images/bg2.jpg");
             background-repeat:  no-repeat;
             background-size:  cover;
             background-color: #cccccc;'>

            </div>
        </div>

        <div style="display:flex;gap:2rem;margin:4rem 0;background-size: 300px;
             background-image: url('images/footerbg.png');
             background-repeat:  repeat;
             background-color: #cccccc;padding:4rem 4rem;">

        </div>


        <!-- second banner  -->

        <div style="height:90vh;width:calc(99vw - 4px);overflow:hidden;position:relative;
        font-family: 'Audiowide',cursive;">
            <video src="delivery_man.mp4" muted autoplay loop style="width:calc(99vw - 4px);
          object-fit: contain;"></video>

            <div style="width:70%;position:absolute;top:12%;left:4rem;font-size:2rem;text-shadow: 0em 0.01em #ff5, 0em 0.02em #ff5, 0em 0.02em 0.03em #ff5,
			-0.01em 0.01em #333, -0.02em 0.02em #333, -0.03em 0.03em #333,
			-0.04em 0.04em #333, -0.01em -0.01em 0.03em #000, -0.02em -0.02em 0.03em #000,
			-0.03em -0.03em 0.03em #000;
	">
                <p><i class="fa-solid fa-check"></i> Online Table Reservations</p>
                <p><i class="fa-solid fa-check"></i> Special Reservations for </p>
                <p><i class="fa-solid fa-check"></i> Birthdays, Candle Light Dinner, Meetings</p>
                <p><i class="fa-solid fa-check"></i> Customize Your Birthday Cake</p>
                <p><i class="fa-solid fa-check"></i> Online Shoping</p>
                <p><i class="fa-solid fa-check"></i> Home Delivery</p>
            </div>
        </div>



        <div class="reserve_box" style="display:flex;flex-direction:column;align-items:center;">
            <p style=" margin-bottom: 1.7rem;color:red;font-size:1.1rem;text-align:center;
        background: linear-gradient(
              90deg, 
              rgba(247, 117, 117, 1) 0%,
              rgba(212, 9, 9, 1) 39%,
              rgba(107, 0, 0, 1) 100%
            );
            color:white;
            border-radius:8px;
            padding:0.2rem;width:30%;">Reserve a Table</p>
            <form style='width:100%' method="POST" id="book_table" action="<?php 
        if(!isset($_SESSION['username'])){
          echo "form.php";
        }else{
          echo "index.php";
        }
        ?>">
                <!-- date -->
                <div class="inpt" style='width:28%'>
                    <label for="date">Date: </label>
                    <input name="booking_date" type="date" value="<?php echo date('Y-m-d'); ?>" style="
                outline: none;
                border: 1px solid #f2f2f2;
                height: 2rem;
                width: 70%;
                background-color: #f2f2f2;
                border-bottom: 2px solid #b1b1b1;
              " />
                </div>
                <!-- people  -->
                <div class="inpt" style='width:30%'>
                    <label for="people">Number Of People: </label>
                    <select name="people" id="people" style="
                background-color: #f2f2f2;
                border: 1px solid #f2f2f2;
                border-bottom: 2px solid #b1b1b1;
                height: 2rem;
                width: 40%;
              ">
                        <option value="1">1</option>
                        <option selected value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <!-- type  -->
                <div class="inpt" style="width: 35%">
                    <label for="meal_type">Type of booking: </label>
                    <select name="meal_type" id="meal_type" style="
                background-color: #f2f2f2;
                border: 1px solid #f2f2f2;
                border-bottom: 2px solid #b1b1b1;
                height: 2rem;
                width: 55%;
              ">
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                    </select>
                </div>
                <!-- submit -->
                <div class="inpt" style="display: flex; justify-content: end; width: 10%">
                    <input type="submit" value="<?php 
        if(!isset($_SESSION['username'])){
          echo "LOG IN";
        }else{
          echo "BOOK";
        }
        ?>" name="book" id="submit" style="
                width: 100%;
                outline: none;
                border: 1px solid #f2f2f2;
                background: linear-gradient(
                  90deg,
                  rgba(247, 117, 117, 1) 0%,
                  rgba(212, 9, 9, 1) 39%,
                  rgba(107, 0, 0, 1) 100%
                );
                color: white;
                border-radius: 10px;
                cursor: pointer;
              " />
                </div>
            </form>
            <span><?php echo $booking_msg; ?></span>
            <p style=" margin: 1.7rem 0;color:red;font-size:1.1rem;text-align:center;
        background: linear-gradient(
              90deg,
              rgba(247, 117, 117, 1) 0%,
              rgba(212, 9, 9, 1) 39%,
              rgba(107, 0, 0, 1) 100%
            );
            color:white;
            border-radius:8px;
            padding:0.2rem;width:30%;margin-top:3rem;">Special Reservations</p>
            <form style='width:100%' method="POST" id="book_table" action="<?php 
        if(!isset($_SESSION['username'])){
          echo "form.php";
        }else{
          echo "index.php";
        }
        ?>">

                <!-- date -->
                <div class="inpt">
                    <label for="date">Date: </label>
                    <input name="sbooking_date" type="date" value="<?php echo date('Y-m-d'); ?>" style="
                outline: none;
                border: 1px solid #f2f2f2;
                height: 2rem;
                width: 70%;
                background-color: #f2f2f2;
                border-bottom: 2px solid #b1b1b1;
              " />
                </div>
                <!-- type  -->
                <div class="inpt" style="width: 30%">
                    <label for="booking_type">Type of Booking: </label>
                    <select name="booking_type" id="booking_type" style="
                background-color: #f2f2f2;
                border: 1px solid #f2f2f2;
                border-bottom: 2px solid #b1b1b1;
                height: 2rem;
                width: 45%;
              ">
                        <option value="Birthday">Birthday</option>
                        <option value="Candle Light Dinner">Candle Light Dinner</option>
                        <option value="Meeting">Meeting</option>
                    </select>
                </div>
                <!-- time  -->
                <div class="inpt">
                    <label for="time">Time: </label>
                    <input name="sbooking_time" id='time' type="time" value="<?php echo date('h:i'); ?>" style="
                outline: none;
                border: 1px solid #f2f2f2;
                height: 2rem;
                width: 60%;
                background-color: #f2f2f2;
                border-bottom: 2px solid #b1b1b1;
              " />
                </div>
                <!-- decorations -->
                <div class="inpt" style='width:22%'>
                    <label for="sbooking_date">Decorations: </label>
                    <input id="sbooking_date" type="radio" value="1" name="decorations" />
                    <label for="date">Yes</label>
                    <input type="radio" value="0" name="decorations" />
                    <label for="date">No</label>
                </div>
                <!-- submit -->
                <div class="inpt" style="display: flex; justify-content: end; width: 10%">
                    <input type="submit" value="<?php 
        if(!isset($_SESSION['username'])){
          echo "LOG IN";
        }else{
          echo "BOOK";
        }
        ?>" name="special_booking" id="submit" style="
                width: 100%;
                outline: none;
                border: 1px solid #f2f2f2;
                background: linear-gradient(
                  90deg,
                  rgba(247, 117, 117, 1) 0%,
                  rgba(212, 9, 9, 1) 39%,
                  rgba(107, 0, 0, 1) 100%
                );
                color: white;
                border-radius: 10px;
                cursor: pointer;
              " />
                </div>
            </form>



        </div>
        <div class="our_services" style='margin-bottom:2rem;'>
            <div class="card1">
                <img height='200' width='200' src="scotter1.webp" alt="">
                <h3 style="
              font-size: 1.2rem;
              text-align: center;
              
            ">
                    FREE DELIVERY ON SPECIAL OFFERES
                </h3>
            </div>

            <div class="card1">
                <img height='200' width='200' src="scotter2.gif" alt="">

                <h3 style="
              font-size: 1.2rem;
              text-align: center;
            ">
                    FAST DELIVERY
                </h3>
            </div>

            <div class="card1">
                <img height='200' width='200' src="food.gif" alt="">
                <h3 style="
              font-size: 1.2rem;
              text-align: center;
            ">
                    REAL LOCAL FOOD
                </h3>

            </div>

        </div>

        <div class="our_services" style='margin-bottom:2rem;'>
            <div class="card1">
                <img height='180' width='180' src="images/g1.gif" alt="">

            </div>

            <div class="card1">
                <img height='180' width='130' src="images/o_shoping.gif" alt="">


            </div>

            <div class="card1">
                <img height='180' width='180' src="images/g3.webp" alt="">


            </div>
            <div class="card1">
                <img height='180' width='180' src="images/book.webp" alt="">


            </div>
        </div>
        <div style="height: 40vh;display: flex;gap:0.2rem;">
            <div style="width: 20%;height: 100%;overflow:hidden;">
                <img class="dsg" style="width: 100%;height: 100%; object-fit: cover;" src="images/b1.jpeg" alt="">
            </div>
            <div style="width: 20%;height: 100%;overflow:hidden;">
                <img class="dsg" style="width: 100%;height: 100%; object-fit: cover;" src="images/b2.jfif" alt="">
            </div>
            <div style="width: 20%;height: 100%; display: flex;flex-direction: column;gap: 0.2rem;">
                <div style="width: 100%;height: 50%;overflow:hidden;">
                    <img class="dsg" style="width: 100%;height: 100%; object-fit: cover;" src="images/b3.jfif" alt="">
                </div>
                <div style="width: 100%;height: 50%;overflow:hidden;">
                    <img class="dsg" style="width: 100%;height: 100%; object-fit: cover;" src="images/b6.webp" alt="">
                </div>
            </div>
            <div style="width: 20%;height: 100%;overflow:hidden;">
                <img class="dsg" style="width: 100%;height: 100%; object-fit: cover;" src="images/b5.jpg" alt="">
            </div>
            <div style="width: 20%;height: 100%;overflow:hidden;">
                <img class="dsg" style="width: 100%;height: 100%; object-fit: cover;" src="images/b4.webp" alt="">
            </div>
        </div>
        <h2 style="text-align: center;font-size:1.3rem;margin-top:3rem;">We provide</h2>
        <div class="we_provied">
            <div class="card2">
                <p style="font-size: 2rem;padding:1rem;">FRESH FOOD</p>
            </div>
            <div class="card2">
                <p style="font-size: 2rem;padding:1rem;">BEST OFFERS</p>
            </div>
            <div class="card2">
                <p style="font-size: 2rem;padding:1rem;">FAST DELIVERY</p>
            </div>
        </div>
    </main>
    <div style='position:relative;height:50vh;'>
        <div id="container" class='container'>
            <div class="steam" id="steam1"> </div>
            <div class="steam" id="steam2"> </div>
            <div class="steam" id="steam3"> </div>
            <div class="steam" id="steam4"> </div>

            <div id="cup">
                <div id="cup-body">
                    <div id="cup-shade"></div>
                </div>
                <div id="cup-handle"></div>
            </div>

            <div id="saucer"></div>

            <div id="shadow"></div>
        </div>
    </div>




    <style>
    ::placeholder {
        color: rgb(169, 169, 169);
        font-size: 0.9rem;
    }
    </style>
    <div style="
        display: flex;
        justify-content: space-between;
        margin: 4rem 4rem;
        height: 57vh;
      ">
        <div class="comment" style="
          display: flex;
          flex-direction: column;
          width: 55%;
          box-shadow: 0 11px 12px 0 rgba(0, 0, 0, 0.07);
        ">
            <p style="
            background: rgb(138, 1, 1);
            margin: 0;
            padding: 1rem;
            color: white;
            font-size: 1.3rem;
          ">
                Add Your Comment
            </p>
            <form action="<?php 
        $url="index.php";
        if(!isset($_SESSION['username'])){
          echo "form.php";
        }else{
          echo "index.php";
        }
        ?>" method="POST" style="padding: 2rem">
                <div style="
              display: flex;
              justify-content: space-between;
              margin-bottom: 1.5rem;
            ">
                    <input <?php echo $disable; ?> type="text" placeholder="Enter Your Name" name="user_name" id=""
                        style="
                width: 46%;
                outline: none;
                border: 2px solid rgb(207, 207, 207);
                border-radius: 3px;
                height: 1.7rem;
              " />
                    <input <?php echo $disable; ?> type="email" placeholder="Enter Your Email (Will not be Published)"
                        name="user_email" id="" style="
                width: 46%;
                outline: none;
                border: 2px solid rgb(207, 207, 207);
                border-radius: 3px;
                height: 1.7rem;
              " />
                </div>
                <div style="display: flex; justify-content: center">
                    <textarea <?php echo $disable; ?> name="message" id="comment" cols="30" rows="4"
                        placeholder="Comment (Opinion)" style="
                width: 100%;
                margin-bottom: 2rem;
                outline: none;
                border: 2px solid rgb(207, 207, 207);
                border-radius: 3px;
              "></textarea>
                </div>
                <div style="display: flex; justify-content: end">
                    <input type="submit" name="comment" value="<?php 
        if(!isset($_SESSION['username'])){
          echo "LOG IN FIRST";
        }else{
          echo "POST";
        }
        ?>" <?php echo $disable; ?> id="" style="
                padding: 0.4rem 2rem;
                color: white;
                background-color: rgb(178, 3, 3);
                outline: none;
                border-radius: 5px;
                border: none;
                cursor: pointer;
              " />
                </div>
            </form>
        </div>
        <div style="width: 40%; overflow: hidden">
            <img src="opinion.avif" alt="" style="object-fit: cover; width: 100%; height: 100%" />
        </div>
    </div>
    <div style="
        display: flex;
        flex-direction: column;
        box-shadow: 0 11px 12px 0 rgba(0, 0, 0, 0.07);
        border: 1px solid #f1f1f1;
        margin: 4rem;
        padding: 1rem 2rem;
        border-radius: 4px;
      ">
        <p style="font-size: 1.2rem; font-weight: 500; margin-bottom: 2rem">
            Visitor's and Customer's Opinions and Feedback on Brother's
            Restaurant<span style="color: #b1b1b1">/<?php
        $result1 = mysqli_query($conn,"SELECT * FROM `comments`");
        echo mysqli_num_rows($result1);
        ?></span>
        </p>
        <?php
        $result1 = mysqli_query($conn,"SELECT * FROM `comments`");
        while($row = mysqli_fetch_assoc($result1)){
          echo'<div style="display: flex; gap: 1rem; margin-bottom: 1.5rem">
          <div>
            <img
              style="height: 2.5rem; width: 2.5rem; border-radius: 50%"
              src="profile.avif"
              alt=""
            />
          </div>
          <div>
            <p style="margin-top: 0.7rem">
              <span style="font-weight: 500">'.$row['name'].'</span>
              <span style="color: #b1b1b1; font-size: 0.8rem">'.$row['date'].'</span>
            </p>
            <p style="font-size: 0.9rem; color: #5f5e5e">
            '.$row['comment'].'
            </p>
          </div>
        </div>';
        }

      ?>

    </div>
    <iframe style='width:90%;margin:0 4rem;tex-align:center;'
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3397.4375717005405!2d76.62062237439605!3d31.62186764212269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39052814a7efc61f%3A0x9634d75c5c41fe3b!2sCareer%20Point%20University%2C%20Hamirpur!5e0!3m2!1sen!2sin!4v1715413794323!5m2!1sen!2sin"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

    <?php
    include "footer.php"; ?>

</body>

</html>