<?php
if (isset($_POST['empgetorder'])) {
    $emp_id = $_POST['empgetorder'];
    $orderid = $_POST['orderid'];
    $sqlchackorder = "SELECT * FROM `order`
    WHERE emp_id IS null AND order_id = '$orderid' ";
    $sqlchackorder_q = mysqli_query($conn, $sqlchackorder);
    if (mysqli_num_rows($sqlchackorder_q) > 0) {
        $sql_update = "UPDATE order SET emp_id = '$emp_id' WHERE order_id ='$orderid'";
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