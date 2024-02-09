<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../controllers/con_db.php');
if ($requestMethod == 'GET') {
    if (isset($_GET['orderidstatus'])) {
        $orderid = $_GET['orderidstatus'];
        $sql_orderstat_c = "SELECT * FROM orderstatus_detail WHERE order_id='$orderid'";
        $sql_orderstat_c_q = mysqli_query($conn, $sql_orderstat_c);
        $fatch = mysqli_fetch_assoc($sql_orderstat_c_q);
        $data = $fatch['orderstatus_id'];
        echo $data;
    }
    if(isset($_GET['orderempstatus'])){
        $orderid = $_GET['orderempstatus'];
        $sql_orderstat_c = "SELECT `employee`.emp_name,`employee`.Bank,`employee`.Bank_number,`order`.paytype_id,`order`.paystatus_id  FROM `order`
        INNER JOIN employee ON `order`.emp_id = `employee`.emp_id WHERE order_id='$orderid'";
        $sql_orderstat_c_q = mysqli_query($conn, $sql_orderstat_c);
        if(mysqli_num_rows($sql_orderstat_c_q)>0){
            $data = mysqli_fetch_assoc($sql_orderstat_c_q);
            echo json_encode([
                "status"=>'have_emp',
                "emp_name"=>$data['emp_name'],
                "Bank"=>$data['Bank'],
                "Bank_number"=>$data['Bank_number'],
                "paytype_id"=>$data['paytype_id'],
                "paystatus_id"=>$data['paystatus_id'],
            ]);
        }else{
            echo json_encode(["status"=>'no_emp']);
        }
    }
    if(isset($_GET['orderempouttime'])){
        $orderid = $_GET['orderempouttime'];
        echo json_encode(["status"=>'200']);
        $sql_orderstat_up = "UPDATE orderstatus_detail SET orderstatus_id = '9', detail= 'ไม่ชำระเงินในเวลาที่กำหนด' WHERE order_id ='$orderid'";
        $sql_orderstat_up_q = mysqli_query($conn, $sql_orderstat_up);
        if($sql_orderstat_up_q){
            echo json_encode(["status"=>'200']);
        }else{
            echo json_encode(["status"=>'402']);
        }
    }


}