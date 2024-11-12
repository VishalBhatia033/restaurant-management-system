<?php

session_start();
$status="";
if (isset($_GET['delete'])){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_GET['delete']== $key){
		unset($_SESSION["shopping_cart"][$key]);
		include "removed.html";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<html>
<head>

<style>
 
 body {
        background-color: #eaeded;
        margin: 0;
        padding: 0;
        font-family: "Roboto", sans-serif;
      }
      main {
        display: flex;
        justify-content: space-between;
      }
      .cart_container {
        display: flex;
        flex-direction: column;
        background-color: white;
        width: 70%;
        margin: 2rem;
        margin-right: 0;
        padding: 1.5rem;
        box-shadow: 1px 1px 20px rgb(184, 183, 183);
      }
      .cart {
        display: flex;
        width: 100%;
        gap: 1rem;
        border-top: 1px solid rgb(207, 207, 207);
        border-bottom: 1px solid rgb(207, 207, 207);
        padding-top: 2rem;
        padding-bottom: 2rem;
      }
      hr {
        border: 5px solid rgb(207, 207, 207);
      }
      .item_details {
        width: 80%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .name_price {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .qty {
        display: flex;
        align-items: center;
        gap: 1rem;
      }
      .qty a {
        text-decoration: none;
        font-size: 0.8rem;
        color: rgb(24, 108, 119);
      }
      .name {
        font-size: 1.2rem;
        font-weight: 400;
      }
      .price {
        font-weight: 700;
        font-size: 1.2rem;
      }
      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .item_img {
        width: 15%;
        overflow: hidden;
        border-radius: 10px;
      }
      .item_img img {
        object-fit: cover;
        height: 100%;
        width: 100%;
      }
      select {
        height: 1.7rem;
        width: 4.5rem;
        border-radius: 8px;
        outline: none;
        border: 1px solid rgb(175, 174, 174);
        background-color: rgb(235, 235, 235);
        padding: 0 0.3rem;
        
        font-weight: 500;
      }

      .stock {
        font-size: 0.8rem;
        color: rgb(6, 106, 6);
      }
      .gift {
        font-size: 0.8rem;
        color: rgb(94, 94, 94);
      }
      .total {
        display: flex;
        justify-content: end;

      }
      .proceed{
        display: flex;
        flex-direction: column;
        background-color: white;
        margin: 2rem;
        padding:  0.5rem 1.5rem;
        margin-left: 0;
        box-shadow: 1px 1px 20px rgb(184, 183, 183);
        height: 40%;
        padding-bottom: 1.2rem;
      }
      .proceed_btnn{
        text-decoration: none;
        color: white;
        background-color: #e4002b;
        padding: 0.4rem 2rem;
        border-radius: 11px;
        text-align: center;
        font-size: 0.8rem;
        width:100%;
        outline:none;
        border:1px solid red;

      }
      .proceed_btnn:hover{
        color:white;
      }
    </style>

<title>Cart/Brother's</title>
</head>
<body>
	<?php
	include "nav.php";
	?>

<main>
<?php
if(isset($_SESSION["shopping_cart"])){
 
    $total_price = 0;
?>	
<div class="cart_container">
<header style='margin-bottom:1rem;'>
          <h1 style="font-weight: 400">Shopping Cart</h1>
          <p style="font-weight: 500; color: grey">price</p>
        </header>
<?php		

foreach ($_SESSION["shopping_cart"] as $product){
?>
<div class="cart">
          <hr />

          <div class="item_img">
            <img src="files/<?php echo $product["image"];?>" alt="" />
          </div>
          <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
          <input type='hidden' name='action' value="remove" />

          <div class="item_details">
            <div class="name_price">
              <div class="name"><?php echo $product["name"]; $_SESSION["pname"]=$product["name"];?></div>
              <div class="price"><?php echo "Rs.".$product["price"]*$product["quantity"]; ?></div>
            </div>
            <div class="stock">In Stock</div>
            <div class="gift">Gift options not available.</div>
<form method='post' action='<?php echo $_SERVER['PHP_SELF'];?>'>

            <div class="qty">
<?php
          $total_price += ($product["price"]*$product["quantity"]);
          
        ?>
            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
            <input type='hidden' name='action' value="change" />
              <select style='font-size:0.7rem' name='quantity' class='quantity' onchange="this.form.submit()">
                <option 
                <?php if(isset($_POST['quantity'])){
                if($_POST['quantity']==1&&$product["code"]==$_POST['code']){
                  echo"selected";
                  $_SESSION[$product["code"]]=1;
                }else{
                  if(isset($_SESSION[$product["code"]])&&$_SESSION[$product["code"]]==1){
                    echo"selected";
                  }else{
                    echo "";
                  }
                }
              }
              ?>
                value="1">Qty: 1</option>
                <option 
                <?php if(isset($_POST['quantity'])){
                if($_POST['quantity']==2&&$product["code"]==$_POST['code']){
                  echo"selected";
                  $_SESSION[$product["code"]]=2;
                }else{
                  if(isset($_SESSION[$product["code"]])&&$_SESSION[$product["code"]]==2){
                    echo"selected";
                  }else{
                    echo "";
                  }
                }
              }
              ?>
                value="2">Qty: 2</option>
                <option
                <?php if(isset($_POST['quantity'])){
                if($_POST['quantity']==3&&$product["code"]==$_POST['code']){
                  echo"selected";
                  $_SESSION[$product["code"]]=3;
                }else{
                  if(isset($_SESSION[$product["code"]])&&$_SESSION[$product["code"]]==3){
                    echo"selected";
                  }else{
                    echo "";
                  }
                }
              }
              ?>
                value="3">Qty: 3</option>
                <option 
                <?php if(isset($_POST['quantity'])){
                if($_POST['quantity']==4&&$product["code"]==$_POST['code']){
                  echo"selected";
                  $_SESSION[$product["code"]]=4;
                }
                else{
                  if(isset($_SESSION[$product["code"]])&&$_SESSION[$product["code"]]==4){
                    echo"selected";
                  }else{
                    echo "";
                  }
                }
              }
              ?>
                value="4">Qty: 4</option>
                <option 
                <?php if(isset($_POST['quantity'])){
                if($_POST['quantity']==5&&$product["code"]==$_POST['code']){
                  echo"selected";
                  $_SESSION[$product["code"]]=5;
                }else{
                  if(isset($_SESSION[$product["code"]])&&$_SESSION[$product["code"]]==5){
                    echo"selected";
                  }else{
                    echo "";
                  }
                }
              }
              ?>
                value="5">Qty: 5</option>
              </select>

              <a href='cart.php?delete=<?php echo $product["code"]; ?>'>Delete</a>
              <a href="store.php">More Items</a>
              <span><?php echo "Rs.".$product["price"]; ?></span>
            </div>
          </div>
</form>

        </div>
        




<?php
}
?>

        <div class="total" style='margin-top:1rem;'>
          <p style="font-size: 1.1rem">
            <span>Subtotal (<?php echo count($_SESSION["shopping_cart"]) ?> items): </span>
            <span style="font-weight: 600">₹<?php echo $total_price; ?></span>
          </p>
        </div>
        </div>
        <div class="proceed">
        <div class="total" >
          <p style="font-size: 1.1rem">
            <span>Subtotal (<?php echo count($_SESSION["shopping_cart"]) ?> items): </span>
            <span style="font-weight: 600">₹<?php echo $total_price; ?></span>
          </p>
        </div>
        <?php
        if(empty($_SESSION['username'])){
          echo "<a class='proceed_btnn' href='form.php'>To proceed Sign/up First</a>";
        }else{
          echo '<form action="payment.php" method="post"><button type="upload" name="upload" class="proceed_btnn"  href="#">Proceed to Buy</button></form>';
        }
        ?>
      </div>

  <?php
  
}else{
	echo "<div style='width:100%;height:63vh;' class='text-dark text-center'><img height='350' width='350' src='images/cart.png'/> <p class='m-0 fw-bold'> Empty cart!</p></div>";
	}
  
?>
        </main>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
</div>
    <?php
    include "footer.php" ;
    ?>
</body>
</html>