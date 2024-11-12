
<?php
session_start();
include "connection.php";
$username=$_SESSION["username"];

// Replace these with your actual PhonePe API credentials

$merchantId = 'PGTESTPAYUAT'; // sandbox or test merchantId
$apiKey="099eb0cd-02cf-4e2a-8aca-3e6c6aff0399"; // sandbox or test APIKEY
// $redirectUrl = 'localhost/project/payment-success.php';

// Set transaction detail
$sql="SELECT * FROM formdata WHERE username='$username'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$order_id = uniqid(); 
$name=$username;
$email=$row['email'];
$mobile=$row['phone'];
$amo=$_SESSION['total'];
$amount = $amo; // amount in INR
$description ="" ;


$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => "MT7850590068188104", // test transactionID
    "merchantUserId"=>"MUID123",
    'amount' => $amount*100,
    'redirectUrl'=>'http://localhost/project/payment-success.php',
    'redirectMode'=>"POST",
    'callbackUrl'=>'http://localhost/project/payment-success.php',
    "merchantOrderId"=>$order_id,
   "mobileNumber"=>$mobile,
   "message"=>$description,
   "email"=>$email,
   "shortName"=>$name,
   "paymentInstrument"=> array(    
    "type"=> "PAY_PAGE",
  )
);


 $jsonencode = json_encode($paymentData);
 $payloadMain = base64_encode($jsonencode);
 $salt_index = 1; //key index 1
 $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
 $sha256 = hash("sha256", $payload);
 $final_x_header = $sha256 . '###' . $salt_index;
 $request = json_encode(array('request'=>$payloadMain));
                
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => $request,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
     "X-VERIFY: " . $final_x_header,
     "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $res = json_decode($response);
 
if(isset($res->success) && $res->success=='1'){
$paymentCode=$res->code;
$paymentMsg=$res->message;
$payUrl=$res->data->instrumentResponse->redirectInfo->url;

header('Location:'.$payUrl) ;
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;	
foreach ($_SESSION["shopping_cart"] as $product){

$item= $product["name"];
$price= $product["price"];
$quantity= $product["quantity"];
$success="payment success";
$osuccess="pending";
$sql = "INSERT INTO orders(item,price,username,quantity,orderid,status,orderstatus) VALUES ( ?,?,?,?,?,?,?)";

 // Prepare and bind
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sisisss", $item,$price,$username,$quantity,$order_id,$success,$osuccess);
 // Execute the statement
 if ($stmt->execute()) {
    //  $successMsg = "success";

     } else {
        //  $errorMsg =  "Error: " . $insertSql->error;
     }
    }}



}
}
          
?>
