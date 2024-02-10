<div class=" bg-blue-400 vh-100 vw-100 d-flex justify-content-center align-items-center pt-5">
    <div class=" card w-100 h-100 rounded-0 border-0 rounded-top-5">
        <?php
        $orderid = $_GET['orderid'];
        $sql_order_total = "SELECT SUM(price)+SUM(total_price) AS sumall,total_price, price, paytype_name FROM `order`
        INNER JOIN distance_price ON `order`.disprice_id = distance_price.disprice_id
         INNER JOIN patment_type ON `order`.paytype_id = patment_type.paytype_id
        WHERE order_id = '$orderid'";
        $sql_order_total_q = mysqli_query($conn, $sql_order_total);
        $data = mysqli_fetch_assoc($sql_order_total_q)
            ?>
        <div class=" card-body">
            <p class="mt-3 m-0">วิธีการชำระเงิน</p>
            <p class="m-0 fs-5 fw-bolder"><?= $data['paytype_name'] ?></p>
            <hr>
            <div class=" d-flex justify-content-between">
                <p class="m-0 fs-5 fw-bolder">ราคารวม</p>
                <p class="m-0 fs-5 ">
                    <?= $data['total_price'] ?> บาท
                </p>
            </div>
            <div class=" d-flex justify-content-between">
                <p class="m-0 fs-5 fw-bolder">ค่าจัดส่ง</p>
                <p class="m-0 fs-5 ">
                    <?= $data['price'] ?> บาท
                </p>
            </div>
            <hr>
        </div>
        <div class=" d-flex align-items-end fixed-bottom p-3 flex-column">
            <div class=" d-flex justify-content-between w-100 mb-3">
                <p class="m-0 display-4 fw-bolder">ยอดชำระ</p>
                <p class="m-0 display-4 fw-bolder">
                    <?= $data['sumall'] ?> <span class=" fs-5 fw-medium ">บาท</span>
                </p>
            </div>
            <div class=" d-flex justify-content-between w-100">
                <a href="?page=address_order" class=" btn btn-outline-dark btn-lg rounded-4 px-5">ย้อนกลับ</a>
                <?php include('./controllers/basket.php')?>
                <form method="post">
                    <button class="btn btn-green-500 btn-lg rounded-4 px-4" value="<?= $orderid ?>" name="confirm_order">ยืนยันคำสั่งซื้อ</button>
                </form>
            </div>
        </div>
    </div>
</div>