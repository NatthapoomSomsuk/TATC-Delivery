<?php include('./controllers/employee_auth.php') ?>
<div class=" d-flex flex-column  vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class=" flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <p class=" fs-1 mt-3 fw-medium text-center">Dashboard</p>
        <div class=" px-3 vstack gap-3 ">
            <div class=" p-3 d-flex bg-yellow-500 w-100 align-items-center justify-content-between">
                <img src="./public/img/icon/empds1.png" alt="">
                <div class=" d-flex flex-column lh-1">
                    <p class="m-0 fs-2 text-end">รายได้วันนี้</p>
                    <?php
                    $empid = $_SESSION['emp'];
                    $sql_income_day = "SELECT SUM(price) AS price
                    FROM `order`
                    INNER JOIN distance_price ON `order`.disprice_id = distance_price.disprice_id
                    WHERE STR_TO_DATE(order_date, '%d/%m/%Y') = CURDATE() AND emp_id = '$empid'
                    LIMIT 0, 1;";
                    $sql_income_day_q = mysqli_query($conn, $sql_income_day);
                    $price = mysqli_fetch_assoc($sql_income_day_q)
                        ?>
                    <p class="m-0 fs-2 text-end">
                        <?= $price['price'] ? $price['price'] : 0 ?> บาท
                    </p>
                </div>
            </div>
            <div class=" p-3 d-flex bg-green-500 w-100 align-items-center justify-content-between">
                <img src="./public/img/icon/empds2.png" alt="">
                <div class=" d-flex flex-column lh-1">
                    <p class="m-0 fs-2 text-end">จำนวนงานที่ได้รับวันนี้</p>
                    <?php
                    $empid = $_SESSION['emp'];
                    $sql_order_day = "SELECT COUNT(`order`.order_id) AS ordersum
                    FROM `order`
                    INNER JOIN orderstatus_detail ON `order`.order_id = orderstatus_detail.order_id
                    WHERE orderstatus_detail.orderstatus_id = '3' AND `order`.`emp_id` = '$empid'
                    GROUP BY `order`.order_id
                    LIMIT 0, 1;
                    ";
                    $sql_order_day_q = mysqli_query($conn, $sql_order_day);
                    $order = mysqli_fetch_assoc($sql_order_day_q)
                        ?>
                    <p class="m-0 fs-2 text-end">
                        <?= isset($order['ordersum']) ? $order['ordersum'] : '0' ?> ครั้ง
                    </p>
                </div>
            </div>
            <div class=" p-3 d-flex bg-red-500 w-100 align-items-center justify-content-between">
                <img src="./public/img/icon/empds3.png" alt="">
                <div class=" d-flex flex-column lh-1">
                    <p class="m-0 fs-2">เลือกแบบระบุเอง</p>
                    <button class=" btn btn-yellow-500 btn-sm px-5" data-bs-toggle="modal" data-bs-target="#select">
                        เลือก
                    </button>
                    <div class="modal fade" id="select" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 bg-blue-600 text-white">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">กรุณาเลือก</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a class=" btn btn-yellow-500 rounded-3 text-black text-decoration-none w-100 mb-1"
                                        href="?page=emp_incom_setting">รายได้ </a>
                                    <a class=" btn btn-green-500 rounded-3 text-black text-decoration-none w-100"
                                        href="?page=emp_work_setting">จำนวนงาน </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/nva_emp_buttom.php') ?>
</div>