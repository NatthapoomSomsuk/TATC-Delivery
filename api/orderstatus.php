<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../controllers/con_db.php');
if($requestMethod == 'GET'){
    $orderid = $_GET['orderidstatus'];
    $sql_orderstat_c=  "SELECT * FROM orderstatus_detail WHERE order_id='$orderid'";
    $sql_orderstat_c_q = mysqli_query($conn,$sql_orderstat_c);
    $fatch = mysqli_fetch_assoc($sql_orderstat_c_q);
    $data=$fatch['orderstatus_id'];
    echo $data;	

}