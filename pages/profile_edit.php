<div class=" bg-blue-400 vh-100 vw-100 d-flex justify-content-center align-items-center pt-5">
    <div class=" card w-100 h-100 rounded-0 border-0 rounded-top-5">
        <div class=" card-body">
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
            <?php include('./controllers/auth.php') ?>
            <form method="post" enctype="multipart/form-data">
                <p class=" fs-4 fw-medium m-0 text-center">Customer Personal Information </p>
                <div class=" d-flex justify-content-center">
                    <label for="upload_image" class=" position-relative">
                        <div style=" width: 130px; height: 130px;"
                            class="rounded-circle position-absolute d-flex justify-content-center align-items-center overlay-img-upload">
                            <i class="bi bi-camera-fill fs-1"></i>
                        </div>
                        <img src="./public/img/user/<?= $mysql_profile_q_fatch['image'] ?>" id="uploaded_image"
                            class=" bg-200 rounded-circle" style=" width: 130px; height: 130px;" />
                        <input type="file" name="img_user" class="image" id="upload_image" style="display:none" onchange="loadFile(event)" />
                    </label>
                    <script>
                        var loadFile = function (event) {
                            var output = document.getElementById('uploaded_image');
                            output.src = URL.createObjectURL(event.target.files[0]);
                            output.onload = function () {
                                URL.revokeObjectURL(output.src)
                            }
                        };
                    </script>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">คำนำหน้า</p>
                    <select class="form-select shadow-none" name="prefix" >
                    <option select value='<?= $mysql_profile_q_fatch['prefix_id'] ?>'> <?= $mysql_profile_q_fatch['prefix_name'] ?> </option>
                        <?php
                        $sql_perfix = "SELECT * FROM  prefix ";
                        $sql_perfix_q = mysqli_query($conn, $sql_perfix);
                        while ($data = mysqli_fetch_assoc($sql_perfix_q)) {
                            ?>
                            <option value="<?= $data['prefix_id'] ?>">
                                <?= $data['prefix_name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">ชื่อ-นามสกุล</p>
                    <input type="text" name="name" id="" value='<?= $mysql_profile_q_fatch['cus_name'] ?>'
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark">
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">เบอร์โทร</p>
                    <input type="text" name="tell" id="" value='<?= $mysql_profile_q_fatch['tell'] ?>'
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark">
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">แผนกวิชา</p>
                    <select class="form-select shadow-none" name="department" value='<?= $mysql_profile_q_fatch['dep_id'] ?>'>
                    <option select value='<?= $mysql_profile_q_fatch['dep_id'] ?>'> <?= $mysql_profile_q_fatch['dep_name'] ?> </option>
                        <?php
                        $sql_department = "SELECT * FROM  department ";
                        $sql_department_q = mysqli_query($conn, $sql_department);
                        while ($data = mysqli_fetch_assoc($sql_department_q)) {
                            ?>
                            <option value="<?=$data['dep_id']?>"><?=$data['dep_name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">สถานะ</p>
                    <select class="form-select shadow-none" name="statuslevel" value='<?= $mysql_profile_q_fatch['statuslevel_id'] ?>'>
                    <option select value='<?= $mysql_profile_q_fatch['statuslevel_id'] ?>'> <?= $mysql_profile_q_fatch['statuslevel_name'] ?> </option>
                        <?php
                        $sql_statuslevel = "SELECT * FROM  statuslevel ";
                        $sql_statuslevel_q = mysqli_query($conn, $sql_statuslevel);
                        while ($data = mysqli_fetch_assoc($sql_statuslevel_q)) {
                            ?>
                            <option value="<?=$data['statuslevel_id']?>"><?=$data['statuslevel_name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">Username</p>
                    <input type="text" name="user" id="" value='<?= $mysql_profile_q_fatch['username'] ?>' disabled
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark ">
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">Password</p>
                    <input type="text" name="password" id="" value='<?= $mysql_profile_q_fatch['password'] ?>'
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark">
                </div>
                <div class=" d-flex justify-content-between mt-4">
                    <a href="?page=profile" class="btn btn-red-500 rounded-pill px-5">ยกเลิก</a>
                    <button class=" btn btn-green-500 rounded-pill px-5" name="edit_customer" type="submit" value="<?= $mysql_profile_q_fatch['cus_id'] ?>">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>