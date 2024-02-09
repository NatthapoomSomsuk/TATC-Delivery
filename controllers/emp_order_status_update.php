<?php include("./con_db.php") ?>
<?php
if (isset($_POST['emp_update'])) {
  $emp_id = $_POST['emp_id'];
  $order_id = $_POST['order_id'];

  $sql_update = "UPDATE `order` SET emp_id='$emp_id' WHERE order_id=$order_id;";

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
