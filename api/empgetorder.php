<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../controllers/con_db.php');
if ($requestMethod == 'GET') {
    if(isset($_GET['gettime'])){
        $empid = $_GET['gettime'];
        $sqlchack = "SELECT *
        FROM q_emp
        INNER JOIN days ON q_emp.`day_id` = days.`day_id`
        INNER JOIN time ON time.time_id = q_emp.time_id
        INNER JOIN status_empq ON status_empq.status_empqid = q_emp.status_empqid 
        WHERE emp_id = '$empid'
        AND day_name = DAYNAME(NOW())
        AND time_name < DATE_ADD(time_name, INTERVAL 1 HOUR)
        AND  TIME(NOW()) BETWEEN DATE_ADD(time_name, INTERVAL 0 HOUR) AND DATE_ADD(time_name, INTERVAL 1 HOUR)
        AND status_name = 'ว่าง'";
        $sqlchack_q = mysqli_query($conn,$sqlchack);
        if(mysqli_num_rows($sqlchack_q)>0){
            echo json_encode(["status"=>'1' ]);
        }else{
            echo json_encode(["status"=>'0' ]);
        }
    }
    if(isset($_GET['getlistorder'])){
        $sql_list_order = "SELECT 
            cus_name,
            orderstatus_id,
            `order`.order_id,
            total_price,
            COUNT(`order`.order_id) AS listcount,
            distance_price.disprice_id,
            distance_price.price,
            distance_price.disprice_name
        FROM 
            `orderstatus_detail`
        INNER JOIN 
            `order` ON orderstatus_detail.order_id = `order`.order_id
        INNER JOIN 
            `customer` ON `order`.cus_id = `customer`.cus_id
        INNER JOIN 
            distance_price ON distance_price.disprice_id = `order`.disprice_id
        WHERE 
            emp_id IS NULL 
            AND orderstatus_id = '1'
        GROUP BY 
            cus_name, orderstatus_id, `order`.order_id, total_price
        LIMIT 0, 25;
            ";
            $sql_list_order_q = mysqli_query($conn, $sql_list_order);
            $output = '';
            while ($row = mysqli_fetch_assoc($sql_list_order_q)){
                $output .= '<div class="card mx-4 bg-200 border-0 mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="vstack text-center">
                        <p class="fs-5 m-0">รหัสการสั่งซื้อ</p>
                        <span class="fs-4 fw-light">#' . $row['order_id'] . '</span>
                    </div>
                    <div>
                        <button class="btn btn-yellow-500" data-bs-toggle="modal"
                            data-bs-target="#list" onclick="myFunction([' . $row['order_id'] . ',`' . $row['cus_name'] . '`,' . $row['total_price'] . ',' . $row['listcount'] . ',' . $row['price'] . ',`' . $row['disprice_name'] . '`])">ดูสถานะคำสั่งซื้อ</button>
                    </div>
                </div>
            </div>
           
            ';
            }
            $data = array(
                'orderlist'   => $output
               );
            echo json_encode($data);
           
            
    }
}