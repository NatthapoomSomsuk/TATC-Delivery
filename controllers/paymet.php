<?php
if (isset($_POST['transfer_money'])) {
    $orderid = $_POST['transfer_money'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $gpsstatus = $_POST['gpsstatus'];
    if ($gpsstatus == false) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                timer: 1500,
                text: 'โปรดทำการเปิด GPS เพื่อดำเนินการต่อ',
            })
        </script>
        <?php
    }
    $sql_update_gps = "UPDATE `order` SET latitude='$latitude',londtitude='$longitude',paytype_id='2',paystatus_id='2' WHERE order_id='$orderid'";
    if (mysqli_query($conn, $sql_update_gps)) {
        header("Location:?page=paymet&orderid=".$orderid);
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                timer: 1500,
                text: 'เกิดข้อผิดพลาดภายในระบบ',
            })
        </script>
        <?php
    }
}