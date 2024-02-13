<div class=" bg-blue-400 vh-100 vw-100 d-flex justify-content-center align-items-center pt-5">
    <div class=" card w-100 h-100 rounded-0 border-0 rounded-top-5">
        <div class=" card-body">
        <?php include('./controllers/auth.php') ?>
            <form method="post" enctype="multipart/form-data">
                <p class=" fs-4 fw-medium m-0 text-center">Register For Employee</p>
                <div class=" d-flex justify-content-center">
                    <label for="upload_image" class=" position-relative">
                        <div style=" width: 130px; height: 130px;"
                            class="rounded-circle position-absolute d-flex justify-content-center align-items-center overlay-img-upload">
                            <i class="bi bi-camera-fill fs-1"></i>
                        </div>
                        <img src="./public/img/user.jpg" id="uploaded_image" class=" bg-200 rounded-circle"
                            style=" width: 130px; height: 130px;" />
                        <input type="file" name="img_user" class="image" id="upload_image" style="display:none"
                            onchange="loadFile(event)" required />
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
                    <input type="text" name="name" id=""
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark" required>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">เบอร์โทร</p>
                    <input type="text" name="phone" id=""
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark" required>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">แผนกวิชา</p>
                    <select class="form-select shadow-none" name="department" required>
                        <?php
                        $sql_department = "SELECT * FROM  department ";
                        $sql_department_q = mysqli_query($conn, $sql_department);
                        while ($data = mysqli_fetch_assoc($sql_department_q)) {
                            ?>
                            <option value="<?= $data['dep_id'] ?>">
                                <?= $data['dep_name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">สถานะ</p>
                    <select class="form-select shadow-none" name="statuslevel">
                        <?php
                        $sql_statuslevel = "SELECT * FROM  statuslevel ";
                        $sql_statuslevel_q = mysqli_query($conn, $sql_statuslevel);
                        while ($data = mysqli_fetch_assoc($sql_statuslevel_q)) {
                            ?>
                            <option value="<?= $data['statuslevel_id'] ?>">
                                <?= $data['statuslevel_name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">ตรางเรียน/สอน</p>
                    <input type="file" name="img_table" id="" class=" form-control" required>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">ธนาคาร</p>
                    <input type="text" name="bank_name" id=""
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark" required>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">เลขบัญชี</p>
                    <input type="text" name="bank_number" id=""
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark" required>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">Username</p>
                    <input type="text" name="username" id=""
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark" required>
                </div>
                <div class=" hstack gap-3 my-2">
                    <p class=" fw-medium m-0 text-nowrap">Password</p>
                    <input type="text" name="password" id=""
                        class=" form-control border-top-0 border-end-0 border-start-0 border-2 rounded-0 border-dark" required>
                </div>
                <div class=" d-flex justify-content-between mt-4">
                    <a href="?page=login" class="btn btn-red-500 rounded-pill px-5">Back</a>
                    <button class=" btn btn-green-500 rounded-pill px-5" type="submit"
                        name="register_employee">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>