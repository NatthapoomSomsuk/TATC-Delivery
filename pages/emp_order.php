<?php
if (isset($_SESSION['emp'])) {
    $emp_id = $_SESSION['emp'];
}
?>
<div class="d-flex flex-column vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class="flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <div class="d-flex justify-content-between px-4 pt-3">
            <p class="text-center fs-2 m-0">คำสั่งซื้อที่สามารถรับได้</p>
        </div>
        <div class="h-100 overflow-scroll">
            <?php
            $empid = $_SESSION['emp'];

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

            if (mysqli_num_rows($sql_list_order_q) > 0) {
                while ($sql_list_order_fatch = mysqli_fetch_assoc($sql_list_order_q)) {
                    ?>
                    <div class="card mx-4 bg-200 border-0 mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="vstack text-center">
                                <p class="fs-5 m-0">รหัสการสั่งซื้อ</p>
                                <span class="fs-4 fw-light">#
                                    <?= $sql_list_order_fatch['order_id'] ?>
                                </span>
                            </div>
                            <div>
                                <button class="btn btn-yellow-500" data-bs-toggle="modal"
                                    data-bs-target="#list<?= $sql_list_order_fatch['order_id'] ?>">ดูสถานะคำสั่งซื้อ</button>
                                <div class="modal fade" id="list<?= $sql_list_order_fatch['order_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-0 bg-red-600 text-white">
                                                <h6 class="modal-title fs-6">รหัสคำสั่งซื้อ  <?= $sql_list_order_fatch['order_id'] ?></h6>
                                            </div>
                                            <div class="modal-body">
                                                <div class=" hstack ">
                                                    <p class=" m-0 text-nowrap" style="width: 150px;">ชื่อลูกค้า</p>
                                                    <div
                                                        class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2">
                                                        <?= $sql_list_order_fatch['cus_name'] ?></div>
                                                </div>
                                                <div class=" hstack ">
                                                    <p class=" m-0 text-nowrap" style="width: 150px;">สถานที่จัดส่ง</p>
                                                    <div
                                                        class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2">
                                                        <?= $sql_list_order_fatch['disprice_name'] ?></div>
                                                </div>
                                                <div class=" hstack ">
                                                    <p class=" m-0 text-nowrap" style="width: 150px;">รายการที่สั่ง</p>
                                                    <div
                                                        class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2">
                                                        <?= $sql_list_order_fatch['listcount'] ?></div>
                                                </div>
                                                <div class=" hstack ">
                                                    <p class=" m-0 text-nowrap" style="width: 150px;">ยอดรวม</p>
                                                    <div
                                                        class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2">
                                                        <?= $sql_list_order_fatch['total_price'] ?></div>
                                                </div>
                                                <div class=" hstack ">
                                                    <p class=" m-0 text-nowrap" style="width: 150px;">ค่าส่ง</p>
                                                    <div
                                                        class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2">
                                                        <?= $sql_list_order_fatch['price'] ?></div>
                                                </div>
                                                <div class=" d-flex justify-content-end mt-3">
                                                    <button class=" btn btn-green-500 rounded-0 me-2">รับ</button>
                                                    <button class=" btn btn-red-500 rounded-0"
                                                        data-bs-dismiss="modal">ไม่สนใจ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="bg-red-100 rounded-3 text-center text-red-500 fs-4 m-2 py-5">ยังไม่มีรายการสั่งตอนนี้</div>
            <?php } ?>

        </div>
    </div>
    <?php include('./components/nva_emp_buttom.php') ?>
</div>