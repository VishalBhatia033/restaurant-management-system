<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
   img{
width: 100%;
height:100%;
   } 

   body {
            
            /* background-position:fixed; */
            background-color: rgba(0, 0, 0, 0.2);
            margin: 0;
            padding: 0;
            color:white;
        }

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="icon" href="./images/icon.ico"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "nav.php";
    ?>
   <h2 class="text-center fw-bold mt-2 mb-4 text-danger"> Our story</h2>
<div class="row">
    <div class="col-md-6">
<h3 class=" mt-5 text-center text-danger">
   TASTE THE LOVE
   </h3>
       <p class="text-justify p-3"> Inspired by the warmth and vibrancy of Jamaica’s culture and people, Chubby's Jamaican Kitchen is a take on traditional Caribbean cooking balanced with relevant culinary twists. The restaurant was co-founded as a passion project by Gusto 54 Founder and CEO Janet Zuccarini and Angela Lawrence, Gusto 54’s Chief Culture Officer. Chubby's is a celebration of their 20+ year friendship, their love and respect for the island’s food, and all the amazing Jamaican cooks they know. They even chose a Jamaican cook’s nickname for the restaurant, one that represents that good tummy feeling you get after having a delicious home-cooked meal.</p>
    </div>

<div class="col-md-6 mt-2"style="height: 300px;">
    <img src="./images/pp.jpg" alt="" srcset="" class="pe-4">
</div>
<div class="col-5 mt-5 "style="height:600px;">
<img src="./images/ppp.jpg" alt="" srcset="" class="ps-4 pb-5">
    
</div>
<div class="col-6">
<h2 class=" mt-5 text-center text-danger">About Us</h2>
<p class="text-justify p-3 "> Inspired by the warmth and vibrancy of Jamaica’s culture and people, Chubby's Jamaican Kitchen is a take on traditional Caribbean cooking balanced with relevant culinary twists. The restaurant was co-founded as a passion project by Gusto 54 Founder and CEO Janet Zuccarini and Angela Lawrence, Gusto 54’s Chief Culture Officer. Chubby's is a celebration of their 20+ year friendship, their love and respect for the island’s food, and all the amazing Jamaican cooks they know. They even chose a Jamaican cook’s nickname for the restaurant, one that represents that good tummy feeling you get after having a delicious home-cooked meal.</p>

 <p class="text-justify p-3 ">Angela took on the responsibility of translating their shared vision into reality. Thoughtfully curated with a tightly-knit team of creators and collaborators, she leaned on her Jamaican heritage and passion for its cuisine to ensure that every aspect of Chubby’s building design and guest experience is made of memorable moments. 

Today Angela supports the business as Co-Founder and Brand Director. Leading the Chubby's management team are Jamaican-born General Manager Shannon Dempster and Chef de Cuisine Dadrian Coke, formerly of Sandals Resort in Negril, a proud native of Westmoreland, Jamaica. 


    </p>
</p>
</div>
</div>
<?php
    include "footer.php";
    ?>
</body>
</html>