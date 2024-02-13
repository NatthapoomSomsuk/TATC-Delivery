<div class=" d-flex flex-column  vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class=" flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <div class=" d-flex justify-content-between px-4 pt-3">
            <p class=" text-center fs-2 m-0">ประวัติรายการ</p>
        </div>
        <div class=" h-100 overflow-scroll ">
            <?php
            $user_id = $_SESSION['user'];
            $sql_list_hisotry = "SELECT `order`.cus_id, `order`.order_id, `orderstatus_detail`.orderstatus_id, order_status.orderstatus_id, order_status.orderstatus_name
            FROM `order`
            INNER JOIN orderstatus_detail ON `order`.order_id = `orderstatus_detail`.order_id
            INNER JOIN order_status ON `orderstatus_detail`.orderstatus_id = order_status.orderstatus_id
            WHERE `order`.cus_id = '$user_id'
            GROUP BY `order`.cus_id, `order`.order_id, `orderstatus_detail`.orderstatus_id, order_status.orderstatus_id;";

            $sql_fetch_list = mysqli_query($conn, $sql_list_hisotry);
            while ($data = mysqli_fetch_assoc($sql_fetch_list)) { ?>
                <div class=" card mx-4 bg-200 border-0 mb-2">
                    <div class=" card-body d-flex justify-content-between align-items-center">
                        <div class=" hstack text-center">
                            <p class=" fs-5 m-0">รหัสการสั่งซื้อ</p>
                            <span class=" fs-4 fw-light ms-2"><?= $data['order_id'] ?></span>
                        </div>
                        <div>
                            <div class="  <?= $data['orderstatus_id'] == 9 ? 'bg-red-500':'bg-yellow-500' ?> p-2">
                                <?= $data['orderstatus_name'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>



        </div>
    </div>
    <?php include('./components/nav_buttom.php') ?>
</div>