<div class=" bg-blue-400 vh-100 vw-100 d-flex justify-content-center align-items-center pt-5">
    <div class=" card w-100 h-100 rounded-0 border-0 rounded-top-5">
        <?php
        $userid = $_SESSION['user'];
        $mysql_profile = "SELECT *
        FROM `customer`
        INNER JOIN `statuslevel` ON `customer`.statuslevel_id = `statuslevel`.statuslevel_id
        INNER JOIN `prefix` ON `customer`.prefix_id = `prefix`.prefix_id
        INNER JOIN `department` ON `customer`.dep_id = `department`.dep_id
        WHERE `customer`.cus_id = '$userid';
        ;
        ";
        $mysql_profile_q = mysqli_query($conn, $mysql_profile);
        $mysql_profile_q_fatch = mysqli_fetch_assoc($mysql_profile_q);
        ?>
        <div class=" card-body">
            <form method="post">
                <p class=" fs-4 fw-medium m-0 text-center">Customer Personal Information </p>
                <div class=" d-flex justify-content-center">
                    <img src="./public/img/user/<?= $mysql_profile_q_fatch['image'] ?>" id="uploaded_image" class=" bg-200 rounded-circle"
                        style=" width: 130px; height: 130px;" />
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">คำนำหน้า</p>
                    <select class="form-select shadow-none" name="perfix"
                        value="<?= $mysql_profile_q_fatch['prefix_id'] ?>" disabled>
                        <option value='<?= $mysql_profile_q_fatch['prefix_id'] ?>'>
                            <?= $mysql_profile_q_fatch['prefix_name'] ?>
                        </option>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">ชื่อ-นามสกุล</p>
                    <input type="text" name="name" id="" value="<?= $mysql_profile_q_fatch['cus_name'] ?>"
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                        disabled>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">เบอร์โทร</p>
                    <input type="text" name="name" id="" value="<?= $mysql_profile_q_fatch['tell'] ?>"
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                        disabled>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">แผนกวิชา</p>
                    <select class="form-select shadow-none" name="dep" value="<?= $mysql_profile_q_fatch['dep_id'] ?>"
                        disabled>
                        <option value='<?= $mysql_profile_q_fatch['dep_id'] ?>'>
                            <?= $mysql_profile_q_fatch['dep_name'] ?>
                        </option>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">สถานะ</p>
                    <select class="form-select shadow-none" name="perfix"
                        value="<?= $mysql_profile_q_fatch['statuslevel_id'] ?>" disabled>
                        <option value='<?= $mysql_profile_q_fatch['statuslevel_id'] ?>'>
                            <?= $mysql_profile_q_fatch['statuslevel_name'] ?>
                        </option>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">Username</p>
                    <input type="text" name="name" id="" value='<?= $mysql_profile_q_fatch['username'] ?>'
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                        disabled>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">Password</p>
                    <input type="password" name="name" id=""  value='<?= $mysql_profile_q_fatch['password'] ?>'
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark"
                        disabled>
                </div>
                <div class=" d-flex justify-content-end mt-4">
                    <a href="?page=login" class="btn btn-red-500 rounded-pill px-5 text-nowrap">ออกจากระบบ</a>
                    <a href="?page=profile_edit"
                        class="btn btn-yellow-500 rounded-pill px-5 text-nowrap">แก้ไขข้อมูลส่วนตัว</a>

                </div>
            </form>
        </div>
        <?php include('./components/nav_buttom.php') ?>
    </div>

</div>