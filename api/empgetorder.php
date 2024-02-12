<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../controllers/con_db.php');
if ($requestMethod == 'GET') {
    if(isset($_GET['gettime'])){
        $empid = $_GET['gettime'];
        $sqlchack = "SELECT * 
        FROM q_emp
        INNER JOIN `days` ON `q_emp`.`day_id` = `days`.`day_id`
        INNER JOIN time ON time.time_id = q_emp.time_id
        INNER JOIN status_empq ON status_empq.status_empqid = q_emp.status_empqid 
        WHERE emp_id = '$empid'
        AND day_name = DAYNAME(NOW())
        AND time_name > TIME(NOW())
        AND time_name < DATE_ADD(TIME(NOW()), INTERVAL 1 HOUR)
        AND status_name = 'ว่าง'";
        $sqlchack_q = mysqli_query($conn,$sqlchack);
        if(mysqli_num_rows($sqlchack_q)>0){
            echo json_encode(["status"=>'ว่าง' ]);
        }else{
            echo json_encode(["status"=>'ไม่ว่าง' ]);
        }
    }
}