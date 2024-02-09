<?php
    if(isset($_SESSION['emp'])) {
        $emp_id = $_SESSION['emp'];
    }
?>
<div class="flex-shrink-1 h-100 overflow-scroll d-flex flex-column">
    <?php include('./components/nav_top.php') ?>
    <?php
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    } else {
        echo "ไม่มีรายการนี้ในระบบ";
        exit;
    }
    ?>

    <div class="flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <div class="fs-2 p-2">
            รหัสคำสั่งซื้อที่ <?= $order_id ?>
        </div>
        <hr class="m-0">
        <div class="card border-0 rounded-0 shadow">
            <div class="card-body">
                <div class="p-3 d-flex justify-content-center ">
                </div>
            </div>
        </div>
        <div class="p-3 shadow">
            <?php
            $sql_order_details = "SELECT
                            `order`.order_id,
                            `order`.cus_id,
                            customer.cus_name,
                            distance_price.disprice_name,
                            distance_price.price AS disprice_price,
                            item.item_name,
                            shop.shop_name
                        FROM
                            `order`
                        INNER JOIN
                            customer ON `order`.cus_id = customer.cus_id
                        INNER JOIN
                            distance_price ON `order`.disprice_id = distance_price.disprice_id
                        INNER JOIN
                            item ON `order`.item_id = item.item_id
                        INNER JOIN
                            shop ON `order`.shop_id = shop.shop_id
                        WHERE
                            `order`.order_id = $order_id";

            $result_order_details = mysqli_query($conn, $sql_order_details);

            if ($result_order_details && $order_details = mysqli_fetch_assoc($result_order_details)) {
            ?>
                <div class="d-flex text-nowrap py-2">
                    ชื่อลูกค้า
                    <div class="border-bottom w-100 ms-3">
                        <?= $order_details['cus_name'] ?>
                    </div>
                </div>
                <!-- Additional order details here -->
                <div class="d-flex text-nowrap py-2">
                    สถานที่จัดส่ง
                    <div class="border-bottom w-100 ms-3">
                        <?= $order_details['disprice_name'] ?>
                    </div>
                </div>
                <div class="d-flex text-nowrap py-2">
                    ค่าส่งที่ได้รับ
                    <div class="border-bottom w-100 ms-3">
                        <?= $order_details['disprice_price'] ?>
                    </div>
                </div>
                <div class="d-flex text-nowrap py-2">
                    ร้านอารหาร
                    <div class="border-bottom w-100 ms-3">
                        <?= $order_details['shop_name'] ?>
                    </div>
                </div>
                <div class="d-flex text-nowrap py-2">
                    รายการอาหารที่สั่ง
                </div>
                <table class="table border-0 border border-100">
                    <thead>
                        <tr>
                            <td class="text-600">ชื่อเมนู</td>
                            <td class="text-600">รายละเอียด</td>
                            <td class="text-600">จำนวน</td>
                            <td class="text-600">ราคา</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_data = "SELECT
                        `order`.order_id,
                        `order`.cus_id,
                        `order`.description,
                        `order`.amount,
                        `order`.total_price,
                        customer.cus_name,
                        distance_price.disprice_name,
                        distance_price.price AS disprice_price,
                        item.item_name,
                        shop.shop_name
                        FROM
                            `order`
                        INNER JOIN
                            customer ON `order`.cus_id = customer.cus_id
                        INNER JOIN
                            distance_price ON `order`.disprice_id = distance_price.disprice_id
                        INNER JOIN
                            item ON `order`.item_id = item.item_id
                        INNER JOIN
                            shop ON `order`.shop_id = shop.shop_id
                        WHERE
                            `order`.order_id = $order_id";

                        $result_sql_data = mysqli_query($conn, $sql_data);

                        while ($data = mysqli_fetch_assoc($result_sql_data)) {
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
                <?php
                $sql_order_type = "SELECT
                    `order`.order_id,
                    `order`.total_price,
                    patment_type.paytype_name,
                    distance_price.price
                    FROM
                        `order`
                    INNER JOIN
                        customer ON `order`.cus_id = customer.cus_id
                    INNER JOIN
                        distance_price ON `order`.disprice_id = distance_price.disprice_id
                    INNER JOIN
                        item ON `order`.item_id = item.item_id
                    INNER JOIN
                        shop ON `order`.shop_id = shop.shop_id
                    INNER JOIN
                        patment_type ON `order`.paytype_id = patment_type.paytype_id
                    WHERE
                        `order`.order_id = $order_id";

                $result_order_type = mysqli_query($conn, $sql_order_type);

                if ($result_order_type && $order_type = mysqli_fetch_assoc($result_order_type)) {
                    $sum_total_price_price = $order_type['total_price'] + $order_type['price'];
                ?>
                    <div class="d-flex justify-content-between">
                        <div>รวมทั้งหมด</div>
                        <div><?= $order_type['total_price'] ?></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>การชำระเงิน</div>
                        <div><?= $order_type['paytype_name'] ?></div>
                    </div>
                <?php } ?>
            <?php
            } else {
                echo "Error fetching order details";
            }
            ?>
        </div>
        <div class="d-flex justify-content-between px-3 mt-4">
            <a href="?page=emp_order" class="btn btn-red-500 px-5">กลับ</a>
            <button class="btn btn-green-500 px-5" data-bs-toggle="modal" data-bs-target="#status" data-orderid="<?= $order_id ?>">รับออเดอร์นี้</button>
            <div class="modal fade" id="status" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-red-500">
                            <h1 class="modal-title fs-6 fw-normal small text-white">รหัสคำสั่งซื้อที่ <?= $order_id ?></h1>
                        </div>
                        <div class="modal-body">
                        <form action="controllers/emp_order_status_update.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order_id ?>">
                        <input type="hidden" name="emp_id" value="<?= $emp_id ?>">
                            <div class="d-flex justify-content-between">
                                <div class="text-nowrap">ราคารายการอาหาร</div>
                                <div class="border-bottom w-100 text-end"><?= $order_type['total_price'] ?></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-nowrap">ค่าส่งที่ได้รับ</div>
                                <div class="border-bottom w-100 text-end"><?= $order_type['price'] ?></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-nowrap">ทั้งหมด</div>
                                <div class="border-bottom w-100 text-end"><?= $sum_total_price_price?></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-nowrap">การชำระเงิน</div>
                                <div class="border-bottom w-100 text-end"><?= $order_type['paytype_name'] ?></div>
                            </div>
                            <button class="btn btn-green-500 px-5 mt-3 w-100" name="emp_update">ยืนยัน</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/nva_emp_buttom.php') ?>
</div>
