<?php
// session_start();
$cart_count="";

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@100..700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
<style>
      nav{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 2rem;
        font-family: "M PLUS 1 Code", monospace;
        background-color: transparent;
        position: sticky;
        top: 0;
        z-index:2;
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
        width: 70%;
        display: flex;
        justify-content: space-between;
        background: rgb(242, 103, 103);
        background: rgb(247, 117, 117);
        background: linear-gradient(
          90deg,
          rgba(247, 117, 117, 1) 0%,
          rgba(212, 9, 9, 1) 39%,
          rgba(107, 0, 0, 1) 100%
        );
        padding: 0.3rem 1rem;
        border-radius: 10px;
      }
      .links .nav_links {
        text-decoration: none;
        color: white;
        font-size: 0.9rem;
        padding: 0.4rem 0.7rem;
        border-radius: 5px;
        transition: 0.2s all ease;
      }
      .links .nav_links:hover {
        background-color: white;
        color: black;
      }
      body {
        position: relative;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "M PLUS 1 Code", monospace;
      }
</style>
</head>
<body>
  

<nav id="nav">
      <div class="logo">
        <img src="logo.png" alt="" />
      </div>
      <div class="links">
        <a class='nav_links' href="index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a class='nav_links' href="store.php"><i class="fa-solid fa-utensils"></i> Menu</a>
        <a class='nav_links' href="contact.php"><i class="fa-regular fa-message"></i> Contact Us</a>
        <a class='nav_links' href="ourstory.php"><i class="fa-regular fa-address-card"></i> About Us</a>
        <a class='nav_links' href="form.php"><i class="fa-solid fa-user-group"></i> Signup/Login</a>
        <?php
          if(!empty($_SESSION["shopping_cart"])) {
          $cart_count = count(array_keys($_SESSION["shopping_cart"]));}
          
?>
        <a style='position:relative;' class='nav_links' href="cart.php"><i class="fa-solid fa-cart-shopping"></i><?php echo "<span style='position:absolute;top:-3px;left:35%;font-size:0.5rem;background-color:white;padding:0 0.2rem; border-radius:18px;color:red;font-weight:bold'>".$cart_count."</span>";?> Cart</a>
        <?php
 
 

 if(!empty($_SESSION["names"])){
  echo  "<a class='nav_links' href='#'>".$_SESSION["names"]."</a>";
 echo '<span class="dropdown" style="display:flex;justify-content:center;align-items:center;">

 <a style="color:white;" class="btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
   
 </a>

 <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
   <li><a class="dropdown-item" href="userprof.php">Edit Profile</a></li>
   <li><a class="dropdown-item" href="user.php">My Orders and Reservations</a></li>
   <li><a class="dropdown-item" href="logout.php">Logout</a></li>
 </ul>
</span>';}
 ?>
      </div>
    </nav>

</body>
<script>
  let nav = document.getElementById('nav');
window.onscroll = function () { 
    if (document.body.scrollTop >= 200 ) {
        nav.style.backgroundColor='white';
    } 
    else {
        nav.style.backgroundColor='white';
    }
};
</script>
</html>
<?php
?>