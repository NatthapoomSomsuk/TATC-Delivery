<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sqluser = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
    $sqlemp = "SELECT * FROM employee WHERE username='$username' AND password='$password'";
    $sql_user = mysqli_query($conn, $sqluser);
    $sql_emp = mysqli_query($conn, $sqlemp);
    $user_data = mysqli_fetch_assoc($sql_user);
    $emp_data = mysqli_fetch_assoc($sql_emp);
    if ($user_data) {
        $_SESSION['user'] = $user_data['cus_id'];
        header("Location:?page=home&id=" . $user_data['cus_id']);
    } elseif ($emp_data) {
        $_SESSION['emp'] = $emp_data['emp_id'];
        header("Location:?page=emp_dasbord&id=" . $emp_data['emp_id']);
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                timer: 1500,
                text: 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
            })
        </script>
        <?php
    }
}
if (isset($_POST['register_customer'])) {
    $perfix = $_POST['perfix'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $statuslevel = $_POST['statuslevel'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql_chack_user = "SELECT username FROM customer WHERE username='$username'";
    if (mysqli_num_rows(mysqli_query($conn, $sql_chack_user)) > 0) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                timer: 1500,
                text: 'มีผู้ใช้งานนี้ในระบบแล้ว',
            })
        </script>
        <?php
    } else {
        if ($_FILES['img_user']['name']) {
            $userimg = uniqid('userimg_') . '.' . pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION);
            $fileisupload = move_uploaded_file($_FILES['img_user']['tmp_name'], "./public/img/user/" . $userimg);
            $filename = $userimg;
            $sql_user_insert = "INSERT INTO customer VALUE 
                (null,'$name','$perfix','$statuslevel','$phone','$department','$username','$password','$userimg')";
            if (mysqli_query($conn, $sql_user_insert)) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'ลงทะเบียนสำเร็จ',
                        timer: 1500,
                        text: 'ระบบกำลังนำไปยัง หน้า Login',
                    })
                </script>
                <?php
                header("Location:?page=login");
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        timer: 1500,
                        text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                    })
                </script>
                <?php
            }
        } else {
            $sql_user_insert = "INSERT INTO customer VALUE 
                (null,'$name','$perfix','$statuslevel','$phone','$department','$username','$password','user.jpg')";
            if (mysqli_query($conn, $sql_user_insert)) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'ลงทะเบียนสำเร็จ',
                        timer: 1500,
                        text: 'ระบบกำลังนำไปยัง หน้า Login',
                    })
                </script>
                <?php
                header("Location:?page=login");
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        timer: 1500,
                        text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                    })
                </script>
                <?php
            }
        }


    }

}
if (isset($_POST['register_employee'])) {
    $perfix = $_POST['prefix'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $statuslevel = $_POST['statuslevel'];
    $bank_name = $_POST['bank_name'];
    $bank_number = $_POST['bank_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($_FILES['img_table'])) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                timer: 1500,
                text: 'โปรดทำการอัพโหลดตรางเรียน / ตรางสอน',
            })
        </script>
        <?php
    }
    $sql_chack_user = "SELECT username FROM employee WHERE username='$username'";
    if (mysqli_num_rows(mysqli_query($conn, $sql_chack_user)) > 0) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                timer: 1500,
                text: 'มีผู้ใช้งานนี้ในระบบแล้ว',
            })
        </script>
        <?php
    } else {
        if (isset($_FILES['img_user']['name'])) {
            $userimg = uniqid('userimg_') . '.' . pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION);
            $fileisupload = move_uploaded_file($_FILES['img_user']['tmp_name'], "./public/img/user/" . $userimg);
            $userimg_table = uniqid('usertable_') . '.' . pathinfo($_FILES['img_table']['name'], PATHINFO_EXTENSION);
            $fileisupload_table = move_uploaded_file($_FILES['img_table']['tmp_name'], "./public/img/table/" . $userimg_table);
            $sql_emp_insert = "INSERT INTO employee VALUE 
            (null,'$name','$perfix','$statuslevel','$phone','$department','$username','$password','$userimg_table', '$bank_name','$bank_number','$userimg');";
            if (mysqli_query($conn, $sql_emp_insert)) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'ลงทะเบียนสำเร็จ..',
                        timer: 1500,
                        text: 'ระบบกำลังนำไปยัง หน้า Login',
                    }).then(() => {
                        window.location.href = "?page=login";
                    })
                </script>

                <?php
                header("Location:?page=login");
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        timer: 1500,
                        text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                    })
                </script>
                <?php
            }
        } else {
            $sql_emp_insert = "INSERT INTO employee VALUE 
            (null,'$name','$perfix','$statuslevel','$phone','$department','$username','$password','$userimg_table', '$bank_name','$bank_number','user.jpg');";
            if (mysqli_query($conn, $sql_emp_insert)) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขสำเร็จ',
                        timer: 1500,
                        text: 'ระบบกำลังนำไปยัง หน้า Login',
                    }).then(() => {
                        window.location.href = "?page=login";
                    })
                </script>
                <?php
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อผิดพลาด',
                        timer: 1500,
                        text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                    })
                </script>
                <?php
            }
        }
    }
}

if (isset($_POST['edit_customer'])) {
    $userid = $_POST['edit_customer'];
    $perfix = $_POST['prefix'];
    $cusname = $_POST['name'];
    $tell = $_POST['tell'];
    $department = $_POST['department'];
    $statuslevel = $_POST['statuslevel'];
    $password = $_POST['password'];
    if (empty($cusname) || empty($tell) || empty($department) || empty($password)) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                timer: 1500,
                text: 'โปรดทำการกรอกข้อมูลให้ครบ',
            })
        </script>
        <?php
    }
    if ($_FILES['img_user']['name']) {
        $userimg = uniqid('userimg_') . '.' . pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION);
        $fileisupload = move_uploaded_file($_FILES['img_user']['tmp_name'], "./public/img/user/" . $userimg);
        $sql_customer = "UPDATE customer
        SET cus_name = '$cusname', prefix_id= '$perfix' ,statuslevel_id='$statuslevel',tell='$tell',dep_id='$department',password='$password',image='$userimg'
        WHERE cus_id = '$userid' ";
        if (mysqli_query($conn, $sql_customer)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขสำเร็จ',
                    timer: 1500,
                    text: 'แก้ไขข้อมูลสำเร็จ',
                }).then(() => {
                        window.location.href = "?page=profile_edit";
                    })
            </script>
            <?php

        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด',
                    timer: 1500,
                    text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                })
            </script>
            <?php
        }
    } else {
        $sqlquser = "SELECT * FROM customer WHERE cus_id = '$userid'";
        $sqlquser = mysqli_query($conn, $sqlquser);
        $sqlf_f = mysqli_fetch_assoc($sqlquser);
        $usetemp = $sqlf_f['image'];
        $sql_customer = "UPDATE customer
        SET cus_name = '$cusname', prefix_id= '$perfix' ,statuslevel_id='$statuslevel',tell='$tell',dep_id='$department',password='$password',image='$usetemp'
        WHERE cus_id = '$userid' ";
        if (mysqli_query($conn, $sql_customer)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'ลงทะเบียนสำเร็จ',
                    timer: 1500,
                    text: 'แก้ไขข้อมูลสำเร็จ',
                }).then(() => {
                        window.location.href = "?page=profile_edit";
                    })
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด',
                    timer: 1500,
                    text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                })
            </script>
            <?php
        }
    }
}


if (isset($_POST['edit_emp'])) {
    $userid = $_POST['edit_emp'];
    $perfix = $_POST['prefix'];
    $empname = $_POST['name'];
    $tell = $_POST['tell'];
    $department = $_POST['department'];
    $statuslevel = $_POST['statuslevel'];
    $statuslevel = $_POST['statuslevel'];
    $bank = $_POST['bank'];
    $banknumber = $_POST['banknumber'];
    $password = $_POST['password'];
    if (empty($empname) || empty($tell) || empty($department) || empty($password)) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                timer: 1500,
                text: 'โปรดทำการกรอกข้อมูลให้ครบ',
            })
        </script>
        <?php
    }
    if ($_FILES['img_user']['name']) {
        $userimg = uniqid('userimg_') . '.' . pathinfo($_FILES['img_user']['name'], PATHINFO_EXTENSION);
        $fileisupload = move_uploaded_file($_FILES['img_user']['tmp_name'], "./public/img/user/" . $userimg);
       $sql_employee = "UPDATE employee
        SET emp_name = '$empname', prefix_id= '$perfix' ,statuslevel_id='$statuslevel',tell='$tell',dep_id='$department',password='$password',image='$userimg',Bank='$bank',Bank_number='$banknumber'
        WHERE emp_id = '$userid' ";
        if (mysqli_query($conn, $sql_employee)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขสำเร็จ',
                    timer: 1500,
                    text: 'แก้ไขข้อมูลสำเร็จ',
                })
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด',
                    timer: 1500,
                    text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                })
            </script>
            <?php
        }
    } else {
        $sqlquser = "SELECT * FROM employee WHERE emp_id = '$userid'";
        $sqlquser = mysqli_query($conn, $sqlquser);
        $sqlf_f = mysqli_fetch_assoc($sqlquser);
        $usetemp = $sqlf_f['image'];
        $sql_employee = "UPDATE employee
        SET emp_name = '$empname', prefix_id= '$perfix' ,statuslevel_id='$statuslevel',tell='$tell',dep_id='$department',password='$password',image='$usetemp',Bank='$bank',Bank_number='$banknumber'
        WHERE emp_id = '$userid' ";
        if (mysqli_query($conn, $sql_employee)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขสำเร็จ',
                    timer: 1500,
                    text: 'แก้ไขข้อมูลสำเร็จ',
                })
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อผิดพลาด',
                    timer: 1500,
                    text: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล',
                })
            </script>
            <?php
        }
    }
}