<div class="d-flex flex-column vh-100">
    <?php include('./components/nav_top.php') ?>
    <?php
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    } else {
        echo "ไม่มีรายการนี้ในระบบ";
    }
    $sql_order_status = "SELECT
                    `order`.order_id,
                    orderstatus_detail.orderstatus_id
                    FROM
                        `order`
                    INNER JOIN
                        orderstatus_detail ON `order`.`order_id` = orderstatus_detail.order_id
                    WHERE
                        `order`.order_id = $order_id";

    $result_order_status = mysqli_query($conn, $sql_order_status);
    if ($result_order_status && $order_type = mysqli_fetch_assoc($result_order_status)) {
        $orderstatus_id = $order_type['orderstatus_id']

            ?>
        <div class="flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
            <div class=" fs-2 p-2">
                รหัสคำสั่งซื้อที่
                <?= $order_id ?>
            </div>
            <hr class=" m-0">
            <script>
                function loadDataOrderstatus() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            const rspcode = this.responseText
                            const bodyhtml = `<div class=" d-flex flex-column justify-content-center">
                            <div class="mx-auto ${rspcode == 1 || rspcode == 2 || rspcode == 3 ? 'bg-yellow-500' : 'bg-500'} fs-4 rounded-circle d-flex justify-content-center align-items-center"
                                style=" width: 50px; height: 50px;">
                                1
                            </div>
                            <span class=" text-nowrap">รอรับออเดอร์</span>
                        </div>
                        <hr class=" border-2 w-100 mt-4">
                        <div class=" d-flex flex-column justify-content-center">
                            <div class="mx-auto ${rspcode == 2 || rspcode == 3 ? 'bg-yellow-500' : 'bg-500'} fs-4 rounded-circle d-flex justify-content-center align-items-center"
                                style=" width: 50px; height: 50px;">
                                2
                            </div>
                            <span class=" text-nowrap">กำลังจัดส่ง</span>
                        </div>
                        <hr class=" border-2 w-100 mt-4">
                        <div class=" d-flex flex-column justify-content-center">
                            <div class="mx-auto ${rspcode == 3 ? 'bg-yellow-500' : 'bg-500'} fs-4 rounded-circle d-flex justify-content-center align-items-center"
                                style=" width: 50px; height: 50px;">
                                3
                            </div>
                            <span class=" text-nowrap">จัดส่งสำเร็จ</span>
                        </div>`;
                            document.getElementById('orderstatus').innerHTML = bodyhtml;
                        }
                    };
                    xhttp.open("GET", "./api/orderstatus.php?orderidstatus=<?= $order_id ?>", true);
                    xhttp.send();
                }
                setInterval(loadDataOrderstatus, 1000);
            </script>
            <div class=" p-3 d-flex justify-content-center " id='orderstatus'>
                loading..
            </div>
        <?php } ?>
        <div class="flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
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
                                    <td>
                                        <?= $data['item_name'] ?>
                                    </td>
                                    <td>
                                        <?= $data['description'] ?>
                                    </td>
                                    <td>
                                        <?= $data['amount'] ?>
                                    </td>
                                    <td>
                                        <?= $data['total_price'] ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $sql_order_type = "SELECT
                    `order`.order_id,
                    `order`.total_price,
                    patment_type.paytype_name,
                    distance_price.price,
                    orderstatus_detail.orderstatus_id
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
                    INNER JOIN
                        orderstatus_detail ON `order`.`order_id` = orderstatus_detail.order_id
                    WHERE
                        `order`.order_id = $order_id";

                    $result_order_type = mysqli_query($conn, $sql_order_type);

                    if ($result_order_type && $order_type = mysqli_fetch_assoc($result_order_type)) {
                        $sum_total_price_price = $order_type['total_price'] + $order_type['price'];
                        $orderstatus_id = $order_type['orderstatus_id']
                            ?>
                        <div class="d-flex justify-content-between">
                            <div>รวมทั้งหมด</div>
                            <div>
                                <?= $order_type['total_price'] ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>การชำระเงิน</div>
                            <div>
                                <?= $order_type['paytype_name'] ?>
                            </div>
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
                <?php include('./controllers/emp_getorder.php') ?>
                <?php if ($orderstatus_id == 1): ?>
                    <form method="post">
                        <button class="btn btn-green-500 px-5" value="<?= $order_id ?>" name="order_dary">เริ่มจัดส่ง</button>
                    </form>
                <?php elseif ($orderstatus_id == 2): ?>
                    <form method="post">
                        <button class="btn btn-green-500 px-5" value="<?= $order_id ?>" name="order_success">ยืนยันการจัดส่ง</button>
                    </form>
                <?php endif; ?>

            </div>

        </div>
        <?php include('./components/nva_emp_buttom.php') ?>
    </div>