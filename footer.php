<!DOCTYPE html>
<html lang="en">
<head>

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      footer {
        display: flex;
       
        padding: 2rem 2rem;
        align-items: center;
        justify-content: space-around;
        flex-wrap:wrap;
      }
      .footer_links {
        width: 50%;
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
        padding: 0.5rem 1rem;
        border-radius: 10px;
      }
      .footer_links a {
        text-decoration: none;
        color: white;
        font-size: 0.9rem;
        padding: 0.2rem 0.7rem;
        border-radius: 5px;
        transition: 0.2s all ease;
      }
      .footer_links a:hover {
        background-color: white;
        color: black;
      }
      .socialmedia a{
        color: black;
        text-decoration: none;
        font-size: 1rem;
      }
    </style>
</head>
<body>
<footer>
      <h3 style="width: 10%">
        <span style="color: red; font-size:1.2rem;font-weight:700">brother's</span
        ><span style="color: rgb(182, 182, 182);font-size:1.2rem;font-weight:700;"> restaurant</span>
      </h3>
      <div class="footer_links">
        <a href="index.php">Home</a>
        <a href="store.php">Menu</a>
        <a href="contact.php">Contact Us</a>
        <a href="ourstory.php">About Us</a>
        <a href="form.php">Signup/Login</a>
        <a href="cart.php">Cart</a>
      </div>
      <div class="contact" style=" font-size: 0.8rem;">
        <p style='margin-bottom:0.4rem'>
          <i class="fa-solid fa-location-dot"></i> Near Career Point University
          Hamirpur
        </p>
        <p style='margin-bottom:0.5rem'> <i class="fa-solid fa-phone"></i> +91 5656562525</p>
        <div class="socialmedia">
          <a href='https://www.linkedin.com/in/vishal-bhatia-v033' style="color: blue;" ><i class="fab fa-linkedin"></i></a>
          <a href='https://www.instagram.com/rupesh_bhatia973?igsh=eHI4YTljNm5obWdr' style="color: rgb(242, 0, 255);"><i class="fab fa-instagram"></i></a>
          <a href="mailto:bhatiav033@gmail.com" style="color: rgb(190, 0, 0);" ><i class="fa-solid fa-envelope"></i></i></a>
        </div>
      </div>
  
    </footer>
</body>
</html>
