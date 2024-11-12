<?php
session_start();
include "connection.php";
$var=1;
$username=$_SESSION["username"];
if($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql = "DELETE FROM table_reservations WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
          include "cancle.html";
        }else {
          echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['cancle_order'])){
        $id=$_POST['p_id'];
        $c_s=1;
        $sql = "UPDATE orders SET cancle_status='$c_s' WHERE orderid='$id'";
        if (mysqli_query($conn, $sql)) {
          include "order_cancled.html";
        }else {
          echo "Error deleting record: " . mysqli_error($conn);
        }
    }
}
// $result= mysqli_query($conn,"SELECT * FROM `orders`WHERE username='$username'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    .card {
        margin: auto;
        width: 31%;
        max-width: 600px;
        font-size: 0.8rem;
        padding: 4vh 0;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-top: 3px solid rgb(252, 103, 49);
        border-bottom: 3px solid rgb(252, 103, 49);
        border-left: none;
        border-right: none;
        transition: 0.8s;

    }

    @media(max-width:768px) {
        .card {
            width: 90%;
        }
    }

    .title {
        color: rgb(252, 103, 49);
        font-weight: 600;
        margin-bottom: 2vh;
        padding: 0 8%;
        font-size: initial;
        display: flex;
        justify-content: space-between;
    }

    #details {
        font-weight: 400;
    }

    .info {
        padding: 5% 8%;
    }

    .info .col-5 {
        padding: 0;
    }

    #heading {
        color: grey;
        line-height: 6vh;
    }

    .pricing {
        background-color: #ddd3;
        padding: 2vh 8%;
        font-weight: 400;
        line-height: 2.5;
    }

    .pricing .col-3 {
        padding: 0;
    }

    .total {
        padding: 2vh 8%;
        color: rgb(252, 103, 49);
        font-weight: bold;
    }

    .total .col-3 {
        padding: 0;
    }

    .footer {
        padding: 0 8%;
        font-size: x-small;
        color: black;
    }

    .footer img {
        height: 5vh;
    }

    .footer a {
        color: rgb(252, 103, 49);
    }

    .footer .col-10,
    .col-2 {
        display: flex;
        padding: 3vh 0 0;
        align-items: center;
    }

    .footer .row {
        margin: 0;
    }

    #progressbar {
        margin-bottom: 3vh;
        overflow: hidden;
        color: rgb(252, 103, 49);
        padding-left: 0px;
        padding: 0 1.7rem;
        margin-top: 3vh
    }

    #progressbar li {
        list-style-type: none;
        font-size: x-small;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
        color: rgb(160, 159, 159);
    }

    #progressbar #step1:before {
        content: "";
        color: rgb(252, 103, 49);
        width: 5px;
        height: 5px;
        margin-left: 0px !important;
        /* padding-left: 11px !important */
    }

    #progressbar #step2:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-left: 32%;
    }

    #progressbar #step3:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 32%;
        /* padding-right: 11px !important */
    }

    #progressbar #step4:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 0px !important;
        /* padding-right: 11px !important */
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #ddd;
        border-radius: 50%;
        margin: auto;
        z-index: -1;
        margin-bottom: 1vh;
    }

    #progressbar li:after {
        content: '';
        height: 2px;
        background: #ddd;
        position: absolute;
        left: 0%;
        right: 0%;
        margin-bottom: 2vh;
        top: 1px;
        z-index: 1;
    }

    .progress-track {
        padding: 0 8%;
    }

    #progressbar li:nth-child(2):after {
        margin-right: auto;
    }

    #progressbar li:nth-child(1):after {
        margin: auto;
    }

    #progressbar li:nth-child(3):after {
        float: left;
        width: 68%;
    }

    #progressbar li:nth-child(4):after {
        margin-left: auto;
        width: 132%;
    }

    #progressbar li.active {
        color: black;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: rgb(252, 103, 49);
    }

    .data {
        display: none;
    }




    .bt {
        padding: 0.6rem 1rem;
        color: white;
        background-color: #e3e3e3;
        border-radius: 7px;
        cursor: pointer;

    }

    .container {
        display: none;
    }

    .filter {
        display: flex;
        padding: 0 4.5rem;
        gap: 1rem;
        align-items: center;
    }

    .filter span {
        text-decoration: none;
        color: black;
        border: 1px solid rgb(190, 190, 190);
        padding: 0.4rem 1rem;
        border-radius: 18px;
        font-size: 0.8rem;
        box-shadow: 1px 1px 6px rgb(190, 190, 190);
    }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"
        integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body style=" background: #fafafa url(https://jackrugile.com/images/misc/noise-diagonal.png);
  color: #444;
  ">
    <?php
    include "nav.php";
    ?>
    <br>
    <br>
    <div style="display:flex;gap:2rem;margin:0rem 0;background-size: 300px;
             background-image: url('images/footerbg.png');
             background-repeat:  repeat;
             background-color: #cccccc;padding:4rem 4rem;">

    </div>
    <div class="filter" style='margin-top:2rem;align-items:center;'>
        <span class="bt" style='background-color:rgb(252, 103, 49);color:white;' onclick="disp_con(0)">Orders</span>
        <span class="bt" onclick="disp_con(1)">Table and Special Reservations</span>
        <span class="bt" onclick="disp_con(2)">Birthday Reservations</span>
    </div>
    <div class="container" style="display:block;">

        <h2 class='text-center mt-5'>
            My Orders
        </h2>
        <?php
    $varr=0;

$sql="SELECT * FROM orders WHERE username= '$username'";
$sql.= " GROUP BY orderid";
$result=$conn->query($sql);
if($result->num_rows>0){
        echo '<div
        style="
          display: flex;
          gap: 1rem;
          flex-wrap:wrap;
          margin: 2rem 0;
          justify-content:space-between;
          transition:0.8s;
          
        "
      >';
      $i=0;
    while($row=$result->fetch_assoc()){
        $orderid=$row['orderid'];
        $sql2="SELECT * FROM orders WHERE orderid='$orderid'";
        $result2=$conn->query($sql2);
        $varr++;
        $d=strtotime($row['createdat']);
        $order_date=date("d-m-Y h:ia", $d);
        echo'<div class="card" id="'.($varr-1).'">
        <div class="title"><span>Purchase Reciept <i class="fa-solid fa-receipt"></i></span> <span><i style="cursor:pointer;" onclick="disp('.($varr-1).',this)" class="fa-solid fa-chevron-down open"></i></span></div>
        <div class="info">
            <div class="row">
                <div class="col-7">
                    <span id="heading">Date</span><br>
                    <span id="details">'.$order_date.'</span>
                </div>
                <div class="col-5 pull-right">
                    <span id="heading">Order id</span><br>
                    <span id="details">'.$row['orderid'].'</span>
                </div>
            </div>      
        </div>  <div class="data">';
        $total=0;
        while($row2=$result2->fetch_assoc()){
            if($row2['orderstatus']=="pending"){
                $class="text-danger";
            }else if($row2['orderstatus']=="delivered"){
                $class="text-success";
            }else{
                $class="text-warning";
            }
            $p='';
            if($i==1){
                $p=$var;
            }else{
                $p="";
            }
            $total+=($row2['price']*$row2['quantity']);
            
            $i++;
            $d_logo='';
            $orderstatus="";
            $cancle_order='';
            $payment=$row2['status'];
            if($row2['orderstatus']=="delivered"){
                $d_logo='<i class="fa-solid fa-circle-check text-success"></i> ';
            }
            if($row2['cancle_status']==0){
               
                if($row2['orderstatus']=="picked"){
                    $orderstatus="<span><i style='color:green;' class='fa-solid fa-truck'></i> <span style='font-size:0.7rem;color:green;'>Out for Delivery</span></span>";
                }else{
                    $orderstatus=$row2['orderstatus'];
                }
                if($row2['orderstatus']!="delivered" && $row2['cancle_status']==0){
                    $cancle_order='<form method="post" action="user.php" style="display:flex;width:100%;
                    justify-content:end;padding: 2vh 8%;">
                    <input type="text" value="'.$row2['orderid'].'" name="p_id" hidden />
                    <button name="cancle_order" class="btn btn-sm btn-danger" >Cancel Order</button>
                    </form>';
                }
            }else{
                $orderstatus="<span style='color:white;background-color:red;padding:0.2rem 0.4rem;
                border-radius:4px;'>CANCELED</span>";
                if($row2['refund']==0){
                    $payment="Refund in Process";
                }
            }
            
            echo '    
            <div class="pricing" style="text-transform: capitalize;border-top:1px solid #E7E9EB;border-bottom:1px solid #E7E9EB;">
                <div class="row">
                    <div class="col-9">
                        <span id="name">'.$row2['item'].'</span>  
                    </div>
                    <div class="col-3">
                        <span id="price">&#8377;'.$row2['price'].'</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <span id="name">Quantity: </span>
                    </div>
                    <div class="col-3">
                        <span id="price">'.$row2['quantity'].'</span>
                    </div>
                </div>
                <div class="row">
                <div class="col-9">
                    <span id="name">Delivery: </span>
                </div>
                <div class="col-3">
                    <span id="price" style="color:green">Free</span>
                </div>
            </div>
                
                <div class="row">
                    <div class="col-9">
                       <span id="name" class="text-success">'.$payment.'</span>
                    </div>
                    <div class="col-3">
                       <span id="price">'.$d_logo.$orderstatus.'</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                       <span id="name" class="text-success"></span>
                    </div>
                    <div class="col-3">
                       <span id="price"><button style="outline:none;
                       border:none;border-radius:4px;color:white;
                       background-color:#0375B9;margin:6px;" onclick="printDiv('.($varr-1).')">print</button></span>
                    </div>
                </div>
            </div>
';


        }
        $pending='';
        $confirmed='';
        $dispached='';
        $delivered='';
        $progress_bar='';
        if( $row['cancle_status']==0){
            if($row['orderstatus']=="pending"){
                $pending='active';
            }
            if($row['orderstatus']=="confirmed"){
                $pending='active';
                $confirmed='active';
            }
            if($row['orderstatus']=="dispatched"|| $row['orderstatus']=="picked"){
                $pending='active';
                $confirmed='active';
                $dispached='active';
            }
            if($row['orderstatus']=="delivered"){
                $pending='active';
                $confirmed='active';
                $dispached='active';
                $delivered='active';
            }
            $progress_bar='<ul id="progressbar">
            <li class="step0 '.$pending.' " id="step1">Ordered</li>
            <li class="step0 '.$confirmed.' text-center" id="step2">Confirmed</li>
            <li class="step0 '.$dispached.' text-right" id="step3">Dispached</li>
            <li class="step0 '.$delivered.' text-right" id="step4">Delivered</li>
            </ul>';
        }else{
            $progress_bar='<ul id="progressbar">
            <li class="step0 active"  id="step1">Ordered</li>
            <li class="step0 active text-center" id="step2"></li>
            <li class="step0 active text-right" id="step3"></li>
            <li class="step0 active text-right" id="step4">Canceled</li>
            </ul>';
        }
        

        echo '
        <div class="total">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3"><big>&#8377;'.$total.'</big></div>
            </div>
        </div>
        '.$cancle_order.'
        <div class="tracking">
            <div class="title">Tracking Order</div>
        </div>
        '.$progress_bar.'
        

        <div class="footer">
            <div class="row">
                <div class="col-2"><img class="img-fluid" src="logo.png"></div>
                <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
            </div>
            
           
        </div>
        </div>
    </div>';
    }
}else{
    echo"No Orders";
}

?>
    </div>
    </div>

    <div class="container">


        <h2 style='text-align:center;' class='mt-5'>
            Table Reservations
        </h2>
        <div style="
          display: flex;
          gap: 1rem;
          flex-wrap:wrap;
          margin: 2rem 0;
          justify-content:space-between;
          transition:0.8s;
          
        ">


            <?php
$sql="SELECT * FROM table_reservations WHERE username= '$username'";
$result=$conn->query($sql);
if($result->num_rows>0){

    
       
    while($row=$result->fetch_assoc()){
        if($row['meal_type']!="Birthday"){
            $varr++;

        $status="";
        $color="";
        $disable='';
        $new_date = date('Y-m-d');
        $cancle_btn='<a  class="btn btn-warning btn-sm " href="user.php?id='.$row['id']. '">Cancel Reservation</a>';
        if($row['status']==0){
            $status="Pending";
            $color="text-warning";
            
          }else if($row['status']==1){
            $status="Approved";
            $color="text-success";
            $cancle_btn='<a  class="btn btn-warning btn-sm btn-* disabled" href="user.php?id='.$row['id']. '">Cancel Reservation</a>';
          }
          if($row["date"]<$new_date){
            $cancle_btn='';
            if($status=="Pending"){
                $status="Not Approved";
                $color="text-danger";
            }
          }
          $persons='';
          if($row['booking_type']==1){
            $persons="FULL";
          }else{
            $persons=$row['persons'];
          }
          

          echo'<div class="card">
          <div class="title"><span>Table Reservation <i class="fa-solid fa-plate-wheat"></i></span> <span><i onclick="disp('.($varr-1).')" style="cursor:pointer;" class="fa-solid fa-chevron-down"></i></span></div>
          <div class="info">
              <div class="row">
                  <div class="col-7">
                      <span id="heading">Date</span><br>
                      <span id="details">'.$row['date'].'</span>
                  </div>
                  <div class="col-5 pull-right">
                      <span id="heading">Chairs Reserved</span><br>
                      <span id="details">'.$persons.'</span>
                  </div>
              </div>      
          </div>  <div class="data">
          
          <div class="pricing" style="text-transform: capitalize;border-top:1px solid #E7E9EB;border-bottom:1px solid #E7E9EB;">
                <div class="row">
                    <div class="col-9">
                        <span id="name">Meal Type</span>  
                    </div>
                    <div class="col-3">
                        <span id="price">'.$row['meal_type'].'</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <span id="name">Status: </span>
                    </div>
                    <div class="col-3">
                        <span id="price" class='.$color.'>'.$status.'</span>
                    </div>
                </div>
             
                
                
            </div>
            

            <div class="total">
            <div class="row justify-content-end">
                <div class="col-9 text-end"><big>'.$cancle_btn.'</big></div>
            </div>
        </div>
        
        
        

        <div class="footer">
            <div class="row">
                <div class="col-2"><img class="img-fluid" src="logo.png"></div>
                <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
            </div>
            
           
        </div>
        </div>
    </div>

            ';



        }    
    };
}else{
    echo"No Reservations";
}
?>


        </div>
    </div>
    <!--     End of Container -->



    <!--   -->
    <div class="container">


        <h2 style='text-align:center;' class='mt-5'>
            Birthday Reservations
        </h2>
        <div style="
          display: flex;
          gap: 1rem;
          flex-wrap:wrap;
          margin: 2rem 0;
          justify-content:space-between;
          transition:0.8s;
          
        ">

            <?php
$sql="SELECT * FROM table_reservations WHERE username= '$username'";
$result=$conn->query($sql);
if($result->num_rows>0){

       
    while($row=$result->fetch_assoc()){
    if($row['meal_type']=="Birthday"){
        $id=$row['id'];
        $sql1="SELECT * FROM cake_orders WHERE reservation_id= '$id'";
        $result1=$conn->query($sql1);
        $cake_name="Not Ordered";
        if($result1->num_rows>0){
           $row1=$result1->fetch_assoc();
           $cake_name=$row1['cake_flavors']." Flavor Cake";
           $person_name=$row1['person_name'];
        }else{
            $cake_name="Not Orderd";
        }
        $status="";
        $color="";
        $disable='';
        $cancle_btn='<a  class="btn btn-warning btn-sm " href="user.php?id='.$row['id']. '">Cancel Reservation</a>';
        if($row['status']==0){
            $status="Pending";
            $color="text-warning";
            $new_date = date('Y-m-d');
          }else if($row['status']==1){
            $status="Approved";
            $color="text-success";
            $cancle_btn='<a  class="btn btn-warning btn-sm btn-* disabled" href="user.php?id='.$row['id']. '">Cancel Reservation</a>';
          }
          if($row["date"]<$new_date){
            $cancle_btn='';
            if($status=="Pending"){
                $status="Not Approved";
                $color="text-danger";
            }
          }
          $persons='';
          if($row['booking_type']==1){
            $persons="FULL";
          }else{
            $persons=$row['persons'];
          }
          $varr++;
         


echo'<div class="card">
          <div class="title"><span>Birthday Reservation <i class="fa-solid fa-champagne-glasses"></i></span> <span><i onclick="disp('.($varr-1).')" style="cursor:pointer;" class="fa-solid fa-chevron-down"></i></span></div>
          <div class="info">
              <div class="row">
                  <div class="col-7">
                      <span id="heading">Date</span><br>
                      <span id="details">'.$row['date'].'</span>
                  </div>
                  <div class="col-5 pull-right">
                      <span id="heading">Booking Time</span><br>
                      <span id="details">'.$row['sbooking_time'].'</span>
                  </div>
              </div>      
          </div>  <div class="data">
          
          <div class="pricing" style="text-transform: capitalize;border-top:1px solid #E7E9EB;border-bottom:1px solid #E7E9EB;">
                <div class="row">
                    <div class="col-9">
                        <span id="name">Reservation Type:</span>  
                    </div>
                    <div class="col-3">
                        <span id="price">'.$row['meal_type'].'</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <span id="name"><i class="fa-solid fa-cake-candles"></i> Cake: </span>
                    </div>
                    <div class="col-3">
                        <span id="price">'.$cake_name.'</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <span id="name">Name on Cake: </span>
                    </div>
                    <div class="col-3">
                        <span id="price" >'.$person_name.'</span>
                    </div>
                </div>
                <div class="row">
                <div class="col-9">
                    <span id="name">Status: </span>
                </div>
                <div class="col-3">
                    <span id="price" class='.$color.'>'.$status.'</span>
                </div>
            </div>
                
            </div>
            

            <div class="total">
            <div class="row justify-content-end">
                <div class="col-9 text-end"><big>'.$cancle_btn.'</big></div>
            </div>
        </div>
        
        
        

        <div class="footer">
            <div class="row">
                <div class="col-2"><img class="img-fluid" src="logo.png"></div>
                <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
            </div>
            
           
        </div>
        </div>
    </div>';



    }
    };
}else{
    echo"No Reservations";
}
?>
        </div>

    </div>
    <div style="display:flex;gap:2rem;margin:2rem 0;margin-top:4rem;background-size: 300px;
             background-image: url('images/footerbg.png');
             background-repeat:  repeat;
             background-color: #cccccc;padding:5rem 4rem;">

    </div>

    <?php
    include "footer.php";
    ?>
</body>
<script>
let prev_ind = -1;

function disp(index, ele) {
    let data = document.getElementsByClassName("data");
    if (prev_ind == index) {
        data[index].style.display = "none";

    } else {
        for (let i = 0; i < data.length; i++) {
            if (i == index) {
                data[i].style.display = "block";

            } else {
                data[i].style.display = "none";
                let open=document.getElementsByClassName('open');
               
            }
        }
    }

    if (prev_ind == index) {
        prev_ind = -1;
    } else {
        prev_ind = index;
    }
}
function printDiv(id) { 
            var divContents = document.getElementById(id).innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write('<html>'); 
            a.document.write('<body > '); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
function disp_con(index) {
    let container = document.getElementsByClassName("container");
    let bt = document.getElementsByClassName("bt");
    for (let i = 0; i < container.length; i++) {
        if (i == index) {
            container[i].style.display = "block";
            bt[i].style.backgroundColor = "rgb(252, 103, 49)";
            bt[i].style.color = "white";
        } else {
            container[i].style.display = "none";
            bt[i].style.backgroundColor = "#e3e3e3";
            bt[i].style.color = "black";
        }
    }
}





//  Developed By Yasser Mas
// yasser.mas2@gmail.com
</script>

</html>