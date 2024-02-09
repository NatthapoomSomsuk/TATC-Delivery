<?php include("./con_db.php") ?>
<?php
if (isset($_POST['emp_update'])) {
  $order_id = $_POST['order_id'];

  $sql_update = "UPDATE `orderstatus_detail` SET orderstatus_id = orderstatus_id + 1 WHERE order_id = $order_id";

  if (mysqli_query($conn, $sql_update)) {
    ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success...',
        timer: 1500,
        text: 'แก้ไขข้อมูลสำเร็จ',
      })
    </script>
    <?php
    header("Location:?page=emp_list");
  } else {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        timer: 1500,
        text: 'เกิดข้อผิดพลาด',
      })
    </script>
    <?php
    header("Location:?page=emp_order_status");
  }
}
