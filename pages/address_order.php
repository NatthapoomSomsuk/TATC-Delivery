<div class=" bg-blue-400 vh-100 vw-100 d-flex justify-content-center align-items-center pt-5">
    <div class=" card w-100 h-100 rounded-0 border-0 rounded-top-5">
        <div class=" card-body">
            <?php
            $userid = $_SESSION['user'];
            $orderid = $_SESSION['ordernumber'];
            $sql_userinfo = "SELECT * FROM `customer`
            INNER JOIN department ON customer.dep_id = department.dep_id
            INNER JOIN statuslevel ON customer.statuslevel_id = statuslevel.statuslevel_id
            WHERE cus_id = '$userid'";
            $sql_userinfo_q = mysqli_query($conn, $sql_userinfo);
            $sql_userinfo_fatch = mysqli_fetch_assoc($sql_userinfo_q);

            $sql_shopname = "SELECT shop_name FROM `order`
            INNER JOIN shop ON shop.shop_id = `order`.shop_id
            WHERE `order`.order_id = $orderid
            GROUP BY shop_name";
            $sql_shopname_q = mysqli_query($conn, $sql_shopname);
            $shopname =mysqli_fetch_assoc($sql_shopname_q);
            ?>

            <p class=" fs-4 fw-medium m-0 text-center"><?= $shopname['shop_name'] ?></p>
            <p class=" fs-4 fw-medium m-0 text-center">สั่งซื้อสินค้า</p>
            <div class=" hstack gap-3 my-2">
                <p class=" fw-medium m-0 text-nowrap">ชื่อ-นามสกุล</p>
                <input type="text" name="name" id="" value="<?= $sql_userinfo_fatch['cus_name'] ?>"
                    class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                    disabled>
            </div>
            <div class=" hstack gap-3 my-2">
                <p class=" fw-medium m-0 text-nowrap">เบอร์โทร</p>
                <input type="text" name="name" id="" value="<?= $sql_userinfo_fatch['tell'] ?>"
                    class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                    disabled>
            </div>
            <div class=" hstack gap-3 my-2">
                <p class=" fw-medium m-0 text-nowrap">แผนกวิชา</p>
                <input type="text" name="name" id="" value="<?= $sql_userinfo_fatch['dep_name'] ?>"
                    class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                    disabled>
            </div>
            <div class=" hstack gap-3 my-2">
                <p class=" fw-medium m-0 text-nowrap">สถานะ</p>
                <input type="text" name="name" id="" value="<?= $sql_userinfo_fatch['statuslevel_name'] ?>"
                    class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                    disabled>
            </div>
            <p class="mt-3">ตำแหน่งที่อยู่</p>
            <div id="googlemap">
            </div>
            <script>
                const getdiv = document.getElementById("googlemap");
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.watchPosition(showPosition);
                        document.getElementById("gpsstatus").value = true;
                    } else {
                        getdiv.innerHTML = "โปรดทำการ เปิดตำแหน่งที่ตั้ง";
                        document.getElementById("gpsstatus").value = false;
                    }
                }
                function showPosition(position) {
                    document.getElementById("latitude").value = position.coords.latitude;
                    document.getElementById("longitude").value = position.coords.longitude;
                    getdiv.innerHTML = '<iframe width="100%" height="200" src="https://maps.google.com/maps?q=' + position.coords.latitude + ',' + position.coords.longitude + '&output=embed"></iframe>'
                }
            </script>
            <p class="mt-3">เลือกวิธีการชำระเงิน</p>
            <?php include('./controllers/paymet.php') ?>
            <form method="post">
                <div class=" d-flex flex-column gap-2">
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="gpsstatus" id="gpsstatus">
                    <button class=" w-100 btn bg-transparent border-1 border border-dark fs-4 text-start py-3"
                        name="cash" value="<?= $orderid ?>">เงินสด</button>
                    <button class=" w-100 btn bg-transparent border-1 border border-dark fs-4 text-start py-3"
                        name="transfer_money" value="<?= $orderid ?>">โอนจ่าย</button>
                </div>
            </form>
        </div>
    </div>

</div>