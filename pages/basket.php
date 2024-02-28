<div class=" d-flex flex-column  vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class=" flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <div class=" d-flex justify-content-between px-4 pt-3">
            <p class=" text-center fs-2 m-0">รายการของฉัน</p>
        </div>
        <div class=" h-100 overflow-scroll ">
            <?php include('./controllers/basket.php') ?>
            <?php
            $orderid = empty($_SESSION['ordernumber']) ? null : $_SESSION['ordernumber'];
            $userid = $_SESSION['user'];
            $sql_order_list = "SELECT * 
            FROM `order` 
            INNER JOIN orderstatus_detail ON `order`.order_id = orderstatus_detail.order_id 
            WHERE orderstatus_id = '0' AND cus_id = '$userid' AND `order`.order_id = '$orderid' 
            LIMIT 0, 25;";
            $sql_order_list_q = mysqli_query($conn, $sql_order_list);
            if (mysqli_num_rows($sql_order_list_q) > 0) {
                while ($data = mysqli_fetch_assoc($sql_order_list_q)) { ?>
                    <?php
                    $numberitemid = $data['item_id'];
                    $produnselect = "SELECT * FROM item WHERE item_id = '$numberitemid'";
                    $produnselect_q = mysqli_query($conn, $produnselect);
                    $produnselect_q_fatch = mysqli_fetch_assoc($produnselect_q)
                        ?>

                    <form method="post">
                        <div class=" card mx-4 bg-200 border-0 hstack overflow-hidden mb-2">
                            <img src="./public/img/food/f1.png" alt="" style="width: 150px;">
                            <div class=" d-flex flex-column px-2 w-100">
                                <div class="">
                                    <p class=" fs-5 m-0 ">
                                        <?= $produnselect_q_fatch['item_name'] ?>
                                    </p>
                                    <p class=" fs-6 m-0">รวมราคา
                                        <?= $data['total_price'] ?> บาท
                                    </p>
                                </div>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <span class=" small">จำนวน
                                        <?= $data['amount'] ?> รายการ
                                    </span>
                                    <input type="hidden" name="orderid" value="<?= $orderid ?>">
                                    <button class=" btn btn-red-500 rounded-3  px-3 btn-sm" name="deleteitem"
                                        value="<?= $data['item_id'] ?>">ลบ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }
            } else { ?>
                <div class=" bg-red-100 rounded-3 text-center text-red-500 fs-4 m-2  py-5">ยังไม่ได้ทำการสั่งอาหาร
                    <div class=" text-center mt-3">
                        <a class=" btn btn-yellow-500 fs-4 text-100 rounded-4 px-5" href="?page=store">ไปยังร้านค้า</a>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>
        <?php
        $sql_count_sum = "SELECT SUM(total_price) AS total
        FROM `order`
        INNER JOIN orderstatus_detail ON orderstatus_detail.order_id = `order`.order_id
        WHERE `order`.order_id = '$orderid' AND orderstatus_detail.orderstatus_id = '0'
        ";
        $sql_count_sum_q = mysqli_query($conn, $sql_count_sum);
        $sql_count_sun_fatch = mysqli_fetch_assoc($sql_count_sum_q)
            ?>
        <div class=" bg-200 rounded-top-5 border-1 border-dark shadow p-4">
            <div class=" d-flex justify-content-between">
                <div class=" fs-4 fw-light vstack lh-1"> ราคารวม<span class=" small"
                        style=" font-size: 12px;">ยังไม่รวมค่าจัดส่ง</span> </div>
                <div class=" fs-4">฿
                    <?= empty($sql_count_sun_fatch['total']) ? '0' : $sql_count_sun_fatch['total'] ?>
                </div>
            </div>
            <button class=" btn btn-green-500 rounded-3 mt-2 w-100 " data-bs-toggle="modal" data-bs-target="#distan"
                <?= mysqli_num_rows($sql_order_list_q) > 0 ? null : 'disabled' ?>>
                ถัดไป
            </button>
            <div class="modal fade" id="distan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="post">
                                <p class=" fs-5 m-0 ">แผนกที่ต้องการจัดส่ง</p>
                                <select class="form-select shadow-none" name="distance_price">
                                    <?php
                                    $sql_statuslevel = "SELECT * FROM  distance_price ";
                                    $sql_statuslevel_q = mysqli_query($conn, $sql_statuslevel);
                                    while ($data = mysqli_fetch_assoc($sql_statuslevel_q)) {
                                        ?>
                                        <option value="<?= $data['disprice_id'] ?>">
                                            <?= $data['disprice_name'] ?> ค่าจัดส่ง
                                            <?= $data['price'] ?> บาท
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button class=" btn btn-green-500 rounded-3 mt-2 w-100 " name="order_distance" value="<?= $orderid ?>">
                                    ยืนยันที่อยู่จัดส่ง
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/nav_buttom.php') ?>
</div>