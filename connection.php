<?php
$username="root";
$password="";
$host="localhost";
$dbname="food";
$conn=new mysqli($host,$username,$password,$dbname);
if($conn->connect_error){
    echo "not connected";

}
else{
    // echo " connected";
}
?>