<div class="d-flex flex-column vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class="flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <div class="d-flex justify-content-between px-4 pt-3">
            <p class="text-center fs-2 m-0">รายการของฉัน</p>
            <a href="?page=emp_list_history" class="btn btn-500 rounded-pill">ประวัติ</a>
        </div>
        <div class="d-block px-4 mb-2">
            <p class="text-start fs-6 m-0">รายการล่าสุด</p>
        </div>
        <div class="h-100 overflow-scroll">
            <?php
            $empid = $_SESSION['emp'];
            $sql_list_order = "SELECT `order`.order_id, `order`.cus_id, orderstatus_id
            FROM `orderstatus_detail`
            INNER JOIN `order` ON orderstatus_detail.order_id = `order`.order_id
            WHERE orderstatus_id BETWEEN 0 AND 2 AND emp_id = '$empid'
            GROUP BY `order`.order_id
            LIMIT 0, 25;";
            $sql_list_order_q = mysqli_query($conn, $sql_list_order);

            if (mysqli_num_rows($sql_list_order_q) > 0) {
                while ($sql_list_order_fatch = mysqli_fetch_assoc($sql_list_order_q)) {
            ?>
                    <div class="card mx-4 bg-200 border-0 mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="vstack text-center">
                                <p class="fs-5 m-0">รหัสการสั่งซื้อ</p>
                                <span class="fs-4 fw-light">#<?= $sql_list_order_fatch['order_id'] ?></span>
                            </div>
                            <div>
                                <button class="btn btn-yellow-500" data-bs-toggle="modal" data-bs-target="#list<?= $sql_list_order_fatch['order_id'] ?>">ดูสถานะคำสั่งซื้อ</button>
                                    <div class="modal fade" id="list<?= $sql_list_order_fatch['order_id'] ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered rounded-0">
                                            <div class="modal-content rounded-0">
                                                <div class="modal-header bg-700 rounded-0 p-0 p-2">
                                                    <p class="modal-title m-0 fs-5 text-white">รหัสการสั่งซื้อ #<?= $sql_list_order_fatch['order_id'] ?></p>
                                                </div>
                                                <div class="">
                                                    <div class="shadow-sm p-3 d-flex justify-content-center">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <div class="mx-auto <?= $sql_list_order_fatch['orderstatus_id'] == 1 || $sql_list_order_fatch['orderstatus_id'] == 2 || $sql_list_order_fatch['orderstatus_id'] == 3 ? 'bg-yellow-500' : 'bg-500' ?> fs-4 rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">1</div>
                                                            <span class="text-nowrap">ชำระเงิน</span>
                                                        </div>
                                                        <hr class="border-2 w-100 mt-4">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <div class="mx-auto <?= $sql_list_order_fatch['orderstatus_id'] == 2 || $sql_list_order_fatch['orderstatus_id'] == 3 ? 'bg-yellow-500' : 'bg-500' ?> fs-4 rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">2</div>
                                                            <span class="text-nowrap">กำลังจัดส่ง</span>
                                                        </div>
                                                        <hr class="border-2 w-100 mt-4">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <div class="mx-auto <?= $sql_list_order_fatch['orderstatus_id'] == 3 ? 'bg-yellow-500' : 'bg-500' ?> fs-4 rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">3</div>
                                                            <span class="text-nowrap">จัดส่งสำเร็จ</span>
                                                        </div>
                                                    </div>
                                                    <div class="p-3">
                                                        <?php
                                                        $orderid = $sql_list_order_fatch['order_id'];
                                                        $sql_order = "SELECT * FROM `order`
                                                            INNER JOIN `item` ON `order`.item_id = item.item_id
                                                            INNER JOIN  `orderstatus_detail` ON `order`.order_id = `orderstatus_detail`.order_id
                                                            WHERE `order`.order_id='$orderid'";
                                                        $sql_order_q = mysqli_query($conn, $sql_order);
                                                        ?>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <td>ชื่อเมนู</td>
                                                                    <td>รายละเอียด</td>
                                                                    <td>จำนวน</td>
                                                                    <td>ราคา</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($data = mysqli_fetch_assoc($sql_order_q)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $data['item_name'] ?></td>
                                                                        <td><?= $data['description'] ?></td>
                                                                        <td><?= $data['amount'] ?></td>
                                                                        <td><?= $data['total_price'] ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>

                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-500 rounded-0" data-bs-dismiss="modal">Back</button>
                                                            <a href="?page=emp_order_status_emp&order_id=<?= $sql_list_order_fatch['order_id']; ?>" class="btn btn-green-500 rounded-0">ไปยังหน้าคำสั่ง</a>
                                                            <button class="btn btn-red-500 rounded-0" data-bs-toggle="modal" data-bs-target="#calorder">ยกเลิก</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="calorder" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">รายละเอียดการยกเลิก</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    กรุณาใส่เหตุผลการยกเลิก (อย่ายกเลิกกรณีไม่จำเป็น)
                                                    <?php include('./controllers/basket.php') ?>
                                                    <form method="post">
                                                        <input type="text" class="form-control shadow-none" name="comment">
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <button class="btn btn-500 rounded-0" data-bs-dismiss="modal">Back</button>
                                                            <button class="btn btn-red-500 rounded-0" name="canelorderid" value="<?= $orderid ?>">ยืนยันการยกเลิก</button>
                                                        </div>
                                                    </form>
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