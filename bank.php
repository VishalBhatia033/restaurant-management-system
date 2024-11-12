<?php
include "connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bank</title>
</head>
<style>
body {
    height: 100vh;
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

main {
    height: 60%;
    width: 40%;
    /* border: 1px solid red; */
    display: flex;
    flex-direction: column;
}

header {
    font-size: 2.8rem;
    padding: 1rem 0;
    text-align: center;
    border: 1px solid rgb(211, 211, 211);
}

.about_payment {
    border: 1px solid rgb(211, 211, 211);
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
}

.text {
    display: flex;
}

.text span {
    width: 50%;
    font-size: 0.8rem;
}

.otp {
    display: flex;
    align-items: center;
}

.otp_section {
    border: 1px solid rgb(211, 211, 211);
    padding: 1.5rem;
    font-size: 0.8rem;
}

.otp_input {
    width: 70%;
}

#otp {
    width: 80%;
    height: 2.5rem;
    outline: none;
    border: 1px solid rgb(190, 189, 189);
    border-radius: 0.2rem;
    padding-left: 1rem;
    margin-top: 0.5rem;
    justify-content: space-between;

}

#submit_btn {
    background-color: #e4be5f;
    border: 1px solid rgb(175, 175, 175);
    outline: none;
    width: 100%;
    padding: 1rem;
    border-radius: 0.2rem;
}

.resend {
    text-align: end;
    padding-right: 2rem;
}

.resend a {
    font-size: 1rem;
    color: rgb(17, 17, 40);
}
</style>

<body>
    <?php
    $otpErr='';
    $order_id = uniqid(); 
    $username=$_SESSION["username"];
    if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_SESSION["shopping_cart"])){
        $total_price = 0;	
    foreach ($_SESSION["shopping_cart"] as $product){
    
    $item= $product["name"];
    $price= $product["price"];
    $quantity= $product["quantity"];
    $product_id= $product["product_id"];
    $success="payment success";
    $osuccess="pending";
    $sql = "INSERT INTO orders(item,price,username,quantity,orderid,status,orderstatus,product_id) VALUES ( ?,?,?,?,?,?,?,?)";
    
     // Prepare and bind
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("sisisssi", $item,$price,$username,$quantity,$order_id,$success,$osuccess,$product_id);
     // Execute the statement
     if ($stmt->execute()) {
        //  $successMsg = "success";
        header('location:loading.php');
    
         } else {
            $otpErr="गलत ओटीपी कृपया दोबारा दर्ज करें";
         }
        }}
    }
    
    ?>
    <main>
        <header>
            BANK
        </header>
        <div class="about_payment">
            <div class="text">
                <span>Merchant</span>
                <span>: Shop Street</span>
            </div>
            <div class="text">
                <span>Transaction Amount</span>
                <span>: INR 600</span>
            </div>
            <div class="text">
                <span>Debit Card</span>
                <span>: **************1111</span>
            </div>
        </div>
        <div class="otp_section">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'>
                <p style="color: #1D588F; font-weight: bolder;font-size: 1rem; margin:0;">Authenticate Payment</p>
                <p>OTP sent to your mobile number ending with <strong>1343</strong></p>
                <label for="otp">Enter One Time Password (OTP)</label>
                <div class="otp" <div class="otp_input">
                    <input type="password" name="OTP" id="otp" maxlength="4">
                    <p style="color:red;margin:0;"><?php echo $otpErr ?></p>
                </div>
        <div class="payment_btn">
            <button type="submit" id="submit_btn">Make Payment</button>
        </div>
        </div>
        <p class="resend"><a href="<?php echo $_SERVER['PHP_SELF'] ?>">Resend OTP</a></p>
        </form>
        </div>
    </main>
</body>

</html>