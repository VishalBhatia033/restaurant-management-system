<?php
session_start();
// print_r($_POST);
$arr=($_POST);
$code= $arr["code"];
$trid= $arr["transactionId"];
$prid= $arr["providerReferenceId"];
$amount= $arr["amount"];
// $cont= $arr["mobile"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brother's/pay</title>
</head>
<body>
    <div class="conatiner" id="one">
        <p><?php echo $code ?></p>
        <p>TransactionID:<?php echo $trid ?></p>
        <p>ProviderReferenceId:<?php echo $prid ?></p>
        <p>Amount:<?php echo $amount/100 ?></p>
        
        <a href="index.php" >Back to Home</a>
    </div>
</body>
</html>