<?php
session_start();
include "connection.php";
$successMsg="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$name = $conn->real_escape_string($_POST['sname']);
$email = $conn->real_escape_string($_POST['email']);
$subject= $conn->real_escape_string($_POST['subject']);
$msg= $conn->real_escape_string($_POST['msg']);

$sql = "INSERT INTO contactus(sname,email,subject,msg) VALUES ( ?,?,?,?)";
 // Prepare and bind
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("ssss", $name,$email,$subject,$msg);

 // Execute the statement
 if ($stmt->execute()) {
    $successMsg = "Successfully Submitted";

     } else {
         $errorMsg =  "Error: " . $insertSql->error;
     }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Brother's/contactus</title>
    <style>
body{ 
    margin: 0;
    padding: 0;
}
/* Google Font CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
body{
  min-height: 100vh;
  width: 100%;
  background: #c8e8e9;
}

.container{
  width: 85%;
  background: #fff;
  border-radius: 6px;
  padding: 20px 60px 30px 40px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  border:1px solid rgba(0, 0, 0, 0.2);
  margin:3rem ;
}
.container .content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.container .content .left-side{
  width: 25%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  position: relative;
}
.content .left-side::before{
  content: '';
  position: absolute;
  height: 70%;
  width: 2px;
  right: -15px;
  top: 50%;
  transform: translateY(-50%);
  background: #afafb6;
}
.content .left-side .details{
  margin: 14px;
  text-align: center;
}
.content .left-side .details i{
  font-size: 30px;
  color: red;
  margin-bottom: 10px;
}
.content .left-side .details .topic{
  font-size: 18px;
  font-weight: 500;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two{
  font-size: 14px;
  color: #afafb6;
}
.container .content .right-side{
  width: 75%;
  margin-left: 75px;
}
.content .right-side .topic-text{
  font-size: 23px;
  font-weight: 600;
  color: #3e2093;
}
.right-side .input-box{
  height: 50px;
  width: 100%;
  margin: 12px 0;
}
.right-side .input-box input,
.right-side .input-box textarea{
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  font-size: 16px;
  background: #F0F1F8;
  border-radius: 6px;
  padding: 0 15px;
  resize: none;
}
.right-side .message-box{
  min-height: 110px;
}
.right-side .input-box textarea{
  padding-top: 6px;
}
.right-side .button{
  /* display: inline-block; */
  margin-top: 12px;
}
.right-side .button button{
  color: #fff;
  font-size: 18px;
  outline: none;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  background: red;
  cursor: pointer;
}


@media (max-width: 950px) {
  .container{
    width: 90%;
    padding: 30px 40px 40px 35px ;
  }
  .container .content .right-side{
   width: 75%;
   margin-left: 55px;
}
}
@media (max-width: 820px) {
  .container{
    margin: 40px 0;
    height: 100%;
  }
  .container .content{
    flex-direction: column-reverse;
  }
 .container .content .left-side{
   width: 100%;
   flex-direction: row;
   margin-top: 40px;
   justify-content: center;
   flex-wrap: wrap;
 }
 .container .content .left-side::before{
   display: none;
 }
 .container .content .right-side{
   width: 100%;
   margin-left: 0;
 }
}

    </style>
</head>
<body>
<?php include "nav.php";?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->

  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Near Career Point University Hamirpur</div>
          <div class="text-two"> Kharwar H.P.</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+0098 9893 5647</div>
          <div class="text-two">+0096 3434 5678</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">codinglab@gmail.com</div>
          <div class="text-two">info.codinglab@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text" style="color:red;">Send us a message</div>
        <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post">
        <div class="input-box">
          <input type="text" name='sname' placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" name='email' placeholder="Enter your email">
        </div>
        <div class="input-box">
          <input type="text" name='subject' placeholder="Enter Subject">
        </div>
        <div class="input-box">
          <textarea name='msg' placeholder='Your Message'></textarea>
        </div>
        <?php echo "<span class='text-success fs-5  bg-light'>" . $successMsg ."</span>"."</br>";?>
        <div class="button">
          <button type='submit'>Send Now</button>
        </div>

      </form>
    </div>
    </div>
  </div>


        <?php
        include "footer.php";
        ?>
</body>
</html>
