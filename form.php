<?php
session_start();

include "connection.php";
$isvalid=false;
$errorMsg="";
$successMsg="";
$formSubmitted = false;
$nameErr="";
$emailErr="";
$passwordErr="";
$phoneErr="";
$usernameErr="";


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST["submitlog"]) ){

    $formSubmitted = true; 

    $loginData = $conn->real_escape_string($_POST['logindata']);
    $userPassword = $conn->real_escape_string($_POST['password']);

    // Fetch the user's hashed password from the database
    $sql = "SELECT username, password, prole FROM formdata WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $loginData, $loginData);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        $username = $row['username'];
        $role = $row['prole'];
        if (password_verify($userPassword, $hashedPassword)) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $role;
            header("Location:validate.php");
        } else {
            $errorMsg = "Your username or password is incorrect.";
            
        }
    } else {
        $errorMsg =  "User not found Sign Up First";
        // header("Location:register.php");
    }
    // Close statement and connection
// $stmt->close();
// $conn->close();
}




?>
<?php
if (isset($_POST["submitprofile"]) ){
    $formSubmitted = true;
    $name = $conn->real_escape_string($_POST['name']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']); // Consider hashing the password
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $pin = $conn->real_escape_string($_POST['pin']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $role = 1;

if(empty($_POST['name'])){
        $nameErr="Name is required";
        $isvalid=false;
    }else{
        $name=($_POST['name']);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$name )){
            $nameErr="not valid name";
            $isvalid=false;
        }
    }
    // username
    if(empty($_POST['username'])){
        $usernameErr="username name is required";
        $isvalid=false;
    }else{
        $username=($_POST['username']);
        if(!preg_match('/^[a-z\d_]{2,20}$/i',$username)){
            $usernameErr="invalid username";
            $isvalid=false;
        }
    }
    // password
    if(empty($_POST['password'])){
        $passwordErr="password name is required";
        $isvalid=false;
    }else{
        $password=($_POST['password']);
        if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,15}$/",$password)){
            $passwordErr="your password must contain numbers,alphabets and symbols";
            $isvalid=false;
        }
    }
    // phone
    if(empty($_POST['phone'])){
        $phoneErr="phone number is required";
        $isvalid=false;
    }else{
        $phone=($_POST['phone']);
        if(!preg_match("/^[0-9]*$/",$phone)){
            $phoneErr="your phone number must contain 10 number and only numbers";
            $isvalid=false;
        }
    }
    // email 
    if(empty($_POST['email'])){
        $emailErr="email is required";
        $isvalid=false;
    }else{
        $email=($_POST['email']);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $emailErr="invalid email format";
            $isvalid=false;
        }
    }


if($isvalid){
    $sql1="SELECT * FROM formdata WHERE  username = '$username'";
    $result1 = $conn->query($sql1);
    $check1 = mysqli_fetch_array($result1);

    $sql2="SELECT * FROM formdata WHERE  email = '$email'";
    $result2 = $conn->query($sql2);
    $check2 = mysqli_fetch_array($result2);

    if(isset($check1)){
        $usernameErr="username exists";
    }else if(isset($check2)){
       $emailErr="email exists";
    }}
 // SQL query to insert data into your table
 $hashedpass=password_hash($password,PASSWORD_DEFAULT);
 $sql = "INSERT INTO formdata (name,username, email, password, address,city,state,pin,phone,prole) VALUES ( ?,?,?,?,?,?,?,?,?,?)";

 // Prepare and bind
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sssssssiss", $name,$username, $email, $hashedpass,$address,$city,$state,$pin, $phone,$role);

 // Execute the statement
 if ($stmt->execute()) {
     $successMsg = "Student Added successfully";

     } else {
         $errorMsg =  "Error: " . $insertSql->error;
     }}

// $stmt->close();


    
   


// $conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
<style>
    

    </style>
    <link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style='

background: linear-gradient(-60deg, #fa7c30 30%, rgba(0, 0, 0, 0) 30%)'>
        <?php
        include "nav.php";
        ?>
 <?php 
        // Display messages only if the form has been submitted
        if ($formSubmitted) {
            if (!empty($successMsg)) {
                echo "<p style='color: green;'>$successMsg</p>";
            } elseif (!empty($errorMsg)) {
                echo "<p style='color: red;'>$errorMsg</p>";
            }
        }
        ?>
    <div style="text-align: center; width:600px; margin:120px auto; " class=" pt-4">
    <button onclick="toggleForm()" class="border-0" id="log" style="background-color: red;color:white;border-radius:5px;padding:0.2rem 0.7rem;">Login</button>
<button onclick="toggleForm()" class="border-0" style='border-radius:5px;padding:0.2rem 0.7rem;' id="log1">Signup</button>
 
<form  method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"  enctype="multipart/form-data"    class=" p-4 " id="loginForm" style="width: 600px;">
    <input type="text" class="form-control" placeholder="Username/Email" name="logindata"><br>

<input type="password" class="form-control "placeholder="Password" name="password"><br>
    <button class="border-0 rounded btn-danger" type="submit" name="submitlog" value="submitlog" style="width: 100%;padding: 4px;">Login</button>
</form>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class=" p-4" style="width: 600px; 
  display: none;" id="signupForm">
    <input type="text" class="form-control" name="name" placeholder="Full Name"><br>
    <?php echo $emailErr;?>
    <input type="text" class="form-control" name="username" placeholder="Create Username"><br>
    <input type="email" class="form-control" name="email" placeholder="Email"><br>
    <input type="password" class="form-control" name="password" placeholder="Create Password"><br>
    <input type="text" class="form-control" name="address"
    placeholder="Address"><br>
    <input type="text" class="form-control" name="city"
    placeholder="City"><br>
    <input type="text" class="form-control" name="state" placeholder="State"><br>
    <input type="number" class="form-control" name="pin" placeholder="Pin"><br>
    <input type="number" class="form-control" name="phone"
    placeholder="Mobile No.">
    <br>
    
    <br>
    <br>
    <button type="submit" class='btn-danger' name="submitprofile" value="submitprofile"style="width: 100%;padding: 4px;">Signup</button>
   
                </form>

              
</div>
<p>
    <?php
    echo"<p class='text-white'>". $usernameErr ."</p>";
    ?>
</p>
    <?php
    include "footer.php" ;
    ?>
<script>
    function toggleForm(){
        var loginForm=document.getElementById("loginForm");
        var log=document.getElementById("log");
        var log1=document.getElementById("log1");
        var signupForm=document.getElementById("signupForm");
        if(loginForm.style.display==="none"){
            loginForm.style.display="block";
            log.style.backgroundColor="red";
            log.style.color="white";
            signupForm.style.display="none";
            log1.style.backgroundColor="white";
            log1.style.color="black";

        }
        else{
            log.style.backgroundColor="white";
            log.style.color="black";
            log1.style.backgroundColor="red";
            log1.style.color="white";

            loginForm.style.display="none";
            signupForm.style.display="block";
        }
    }
</script>
</body>
</html>