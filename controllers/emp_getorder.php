<?php
if (isset($_POST['empgetorder'])) {
    $emp_id = $_POST['empgetorder'];
    $orderid = $_POST['orderid'];
    $sqlchackorder = "SELECT * FROM `order`
    WHERE emp_id IS null AND order_id = '$orderid' ";
    $sqlchackorder_q = mysqli_query($conn, $sqlchackorder);
    if (mysqli_num_rows($sqlchackorder_q) > 0) {
        $currentDate = date("d/m/Y");
        $sql_update = "UPDATE order SET emp_id = '$emp_id',order_date= '$currentDate' WHERE order_id ='$orderid'";
        $sql_update_q = mysqli_query($conn, $sql_update);
        header("Location:?page=emp_list");
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'แย่จัง',
                timer: 1500,
                text: 'มีคนรับ order นี้ไปแล้ว',
            })
        </script>
        <?php

    }


}

if (isset($_POST['order_dary'])) {
    $orderid = $_POST['order_dary'];
    $sql_update_order = "UPDATE orderstatus_detail SET orderstatus_id = '2' WHERE order_id ='$orderid'";
    $sql_update_order_q = mysqli_query($conn, $sql_update_order);
    if ($sql_update_order_q) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Go..',
                timer: 1500,
                text: 'กำลังเริ่มจัดส่ง',
            }).then(() => {
                    window.location.href = "?page=emp_order_status_emp&order_id=<?=$orderid?>";
                })
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'systen error',
                timer: 1500,
                text: 'เกิดข้อผิดพลาด',
            })
        </script>
        <?php
    }
}
if(isset($_POST['order_success'])){
    $orderid = $_POST['order_success'];
    $sql_update_order = "UPDATE orderstatus_detail SET orderstatus_id = '3' WHERE order_id ='$orderid'";
    $sql_update_order_q = mysqli_query($conn, $sql_update_order);
    if ($sql_update_order_q) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Go..',
                timer: 1500,
                text: 'จัดส่งสำเร็จ',
            }).then(() => {
                    window.location.href = "?page=emp_dasbord";
                })
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'systen error',
                timer: 1500,
                text: 'เกิดข้อผิดพลาด',
            })
        </script>
        <?php
    }
}
