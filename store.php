<?php
session_start();
include('connection.php');
if (!isset($_GET['food']) ){
  $result1 = mysqli_query($conn,"SELECT * FROM `menu`");
}else{
  $food_type=$_GET['food'];
  if($food_type=="all"){
    $result1 = mysqli_query($conn,"SELECT * FROM `menu`");
  }else{
    $result1 = mysqli_query($conn,"SELECT * FROM `menu` where `type`='$food_type'");
  }
}
$status="";
$msg1=false;
// $don2="";
if (isset($_POST['code']) ){
$code = $_POST['code'];
$result = mysqli_query($conn,"SELECT * FROM `menu` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['iname'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];
$id = $row['id'];


$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image,
  'product_id'=>$id
	)
);


if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
$msg1="<p class='text-success'>Product is added to your cart!</p>";
}else{
	$cartKeys = $_SESSION["shopping_cart"];
	if(array_key_exists($code,$cartKeys)) {
		include "alreadyadded.html";
	} else {
	$_SESSION["shopping_cart"][$code] =$cartArray[$code];
	include "added.html";
	}
}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./store.css">
<link rel="icon" href="./images/icon.ico" type="image/x-icon">

    <style>
body {
        margin: 0;
        padding: 0;
        font-family: "Roboto", sans-serif;
        background-color: #fbfbfb;
      }

      .heading {
        margin: 0 2rem;
        margin-top: 1rem;
        padding-bottom: 0.7rem;
        border-bottom: 2px solid rgb(255, 65, 65);
      }

      .filter {
        display: flex;
        padding: 0 2rem;
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

      .menu_items {
        display: flex;
        gap: 1rem;
        padding: 1rem 2rem;
        flex-wrap: wrap;
      }

      .card {
        z-index:1;
        width: 24%;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        box-shadow: 1px 1px 5px rgb(185, 185, 185);
        border-radius: 1rem;
        overflow: hidden;
        margin-top: 0.5rem;
      }

      .card_img {
        width: 100%;
        height: 35vh;
      }

      .card_img img {
        height: 100%;
        width: 100%;
        object-fit: cover;
      }

      .card_name {
        padding: 0;
        margin: 0;
        font-size: 1.1rem;
        font-weight: 500;
      }

      .card_description {
        color: rgb(111, 111, 111);
        text-transform: capitalize;
      }

      .card_details {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        padding: 0 1rem;
      }
      .type {
        display: flex;
        gap: 0.4rem;
        align-items: center;
      }
      .add_btn {
        text-decoration: none;
        color: white;
        padding: 0.7rem 2rem;
        border-radius: 28px;
        background-color: #e4002b;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        margin-top: 1.2rem;
        margin-bottom: 1rem;
      }
    </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Menu/Brother's</title>
</head>
<body>
    <?php
    include "nav.php";
    ?>

    <h3 class="heading" style='margin-top:2rem;'>LET'S ORDER FOR DELIVERY, PICK UP, OR DINE-IN</h3>
    <div class="filter" style='margin-top:2rem;align-items:center;'>
      <p style="font-weight: 500;margin:0;">Filter</p>
      <a href="store.php?food=all">All</a>
      <a  href="store.php?food=veg">Pure Veg</a>
      <a  href="store.php?food=nonveg">Non Veg</a>
    </div>
 
    <div class="menu_items" id="div2">



    <?php

while($row = mysqli_fetch_assoc($result1)){
        $logo='';
        $type='';
        if($row['type']=='veg'){
          $logo='<svg
          width="16"
          height="17"
          viewBox="0 0 16 17"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect
            x="0.5"
            y="1"
            width="15"
            height="15"
            rx="3.5"
            stroke="#008300"
          />
          <circle cx="8" cy="8.5" r="4" fill="#008300" />
        </svg>';
        $type='Veg';
        }else{
          $logo='<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="0.5" y="1" width="15" height="15" rx="3.5" stroke="#BC0730"/>
          <path d="M4.80902 12L8 5.61803L11.191 12H4.80902Z" fill="#BC0730" stroke="#BC0730"/>
          </svg>
          ';
          $type='Non Veg';
        }
        echo '<div class="card">
        <form method="post" >
        <input type="hidden" name="code" value="'.$row['code'].'" />
        <div class="card_img">
          <img src="files/'.$row['image'].'" alt="no img" />
        </div>
        <div class="card_details">
          <p class="card_name" style="margin-top:1rem;">'.$row['iname'].'</p>
          <div class="type">
           '.$logo.'
            
            <p style="font-size: 0.7rem; padding: 0; margin: 0; color: grey">
             '.$type.'
            </p>
          </div>
          <div class="card_price" style="font-weight: 500">₹'.$row['price'].'</div>
          <div class="card_description" style="font-size: 0.8rem">
            '.$row['description'].'
          </div>

          <button class="add_btn" type="submit" style="cursor:pointer" 
            >Add to Cart <i class="fa-brands fa-bitbucket"></i
          ></button>
        </div>
        </form>
      </div>';
        }
// mysqli_close($conn);
?>

  </div>
 
<?php
if($msg1){
 echo "<div class='alertbox' id='alertsd'>".
"<p id='green'>".$msg1."</p>"
."</div>";
}

?>
 <?php
    include "footer.php";
    ?>
</body>



<script>
    var a=document.getElementById("div1");
var b=document.getElementById("div2");
var c=document.getElementById("div3");
    function abc(){
a.style.display="block";
b.style.display="none";
c.style.display="none";

}
function abcd(){

b.style.display="block";
a.style.display="none";
c.style.display="none";

}
function abcde(){

c.style.display="block";
// c.style.textDecoration="underline";
a.style.display="none";
b.style.display="none";

}

function myhide(){
  let hide=document.getElementById("alertsd").style.display="none";

}
const timeout=setTimeout(myhide,2000);


  </script>

</html>
