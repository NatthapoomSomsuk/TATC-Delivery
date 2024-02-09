<?php
if (isset($_POST['additem'])) {
    $quantity = $_POST['quantity'];
    $detail = $_POST['detail'];
    $itemid = $_POST['additem'];
    $shopid = $_POST['shopid'];
    $itemprice = $_POST['itemprice'];
    $userid = $_SESSION['user'];
    $sql_grop_order = "SELECT * 
    FROM `order` 
    INNER JOIN orderstatus_detail ON `order`.order_id = orderstatus_detail.order_id 
    WHERE cus_id='$userid' AND orderstatus_id='0' AND shop_id = '$shopid'
    GROUP BY `order`.order_id;";
    $sql_grop_order_q = mysqli_query($conn, $sql_grop_order);
    if (mysqli_num_rows($sql_grop_order_q) == 0) {
        $sql_select_orcer = "SELECT * FROM orderstatus_detail ORDER BY order_id DESC LIMIT 1;";
        $sql_select_order_q = mysqli_query($conn, $sql_select_orcer);
        $sql_select_order_fatch = mysqli_fetch_assoc($sql_select_order_q);
        $order_numid = intval($sql_select_order_fatch['order_id']) + 1;
        $sql_insert_order = "INSERT INTO `orderstatus_detail` VALUE ($order_numid,0,null)";
        $sql_insert_order_q = mysqli_query($conn, $sql_insert_order);
        $_SESSION['nowshop'] = $shopid;
        $_SESSION['ordernumber'] = $order_numid;
        $sumitem = intval($itemprice) * intval($quantity);
        $sql_insert_orderdetail = "INSERT INTO `order` 
        VALUE ('$order_numid','$userid',null,'$shopid','$itemid','$quantity','$detail',null,null,'$sumitem',null,null,null,null,null,null)";
        if (mysqli_query($conn, $sql_insert_orderdetail)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    timer: 1500,
                    text: 'เพิ่มอาหารแล้ว',
                })
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    timer: 1500,
                    text: '<?= mysqli_error($conn) ?>',
                })
            </script>
            <?php
        }
    } else {
        $order_numid = $_SESSION['ordernumber'];
        $sql_select_iteminorder = "SELECT * FROM `order` WHERE order_id='$order_numid' AND item_id = '$itemid'";
        $sql_select_iteminorder_q = mysqli_query($conn, $sql_select_iteminorder);
        $sql_select_iteminorder_q_facth = mysqli_fetch_assoc($sql_select_iteminorder_q);
        if (mysqli_num_rows($sql_select_iteminorder_q) > 0) {
            $sumitem = $itemprice * $quantity;
            $quantity_item = intval($sql_select_iteminorder_q_facth['amount']) + $quantity;
            $itemprice = $sumitem + intval($sql_select_iteminorder_q_facth['total_price']);
            $sql_itemupdate = "UPDATE `order` SET total_price = '$itemprice' , amount = '$quantity_item',description='$detail' WHERE item_id = '$itemid' AND order_id='$order_numid'";
            if (mysqli_query($conn, $sql_itemupdate)) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        timer: 1500,
                        text: 'เพิ่มอาหารแล้ว',
                    })
                </script>
                <?php
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
        } else {
            $sumitem = intval($itemprice) * intval($quantity);
            $sql_insert_orderdetail = "INSERT INTO `order` 
            VALUE ('$order_numid','$userid',null,'$shopid','$itemid','$quantity','$detail',null,null,'$sumitem',null,null,null,null,null)";
            if (mysqli_query($conn, $sql_insert_orderdetail)) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        timer: 1500,
                        text: 'เพิ่มอาหารแล้ว',
                    })
                </script>
                <?php
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
    }
}
if(isset($_POST['deleteitem'])){
    $order=$_POST['orderid'];
    $itemid=$_POST['deleteitem'];
    $userid=$_SESSION['user'];
    $sql_datale_item ="DELETE FROM `order` WHERE order_id='$order' AND cus_id= '$userid' AND item_id='$itemid';";
    if (mysqli_query($conn, $sql_datale_item)) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                timer: 1500,
                text: 'ลบอาหารแล้ว',
            })
        </script>
        <?php
         header("Location:?page=basket");
        $sql_select_order_count_chack = "SELECT  * FROM `order` WHERE order_id='$order' AND cus_id= '$userid';";
        $sql_select_order_count_chack_q = mysqli_query($conn,$sql_select_order_count_chack);
        if(mysqli_num_rows($sql_select_order_count_chack_q)<1){
            unset($_SESSION['nowshop']);
            unset($_SESSION['ordernumber']);
            $sql_order_delete = "DELETE FROM orderstatus_detail WHERE order_id='$order'";
            $sql_order_delete_q = mysqli_query($conn,$sql_order_delete);
        }
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

if(isset($_POST['order_distance'])){
    $distance_price = $_POST['distance_price'];
    $order_distance = $_POST['order_distance'];
    $sql_distance_update = "UPDATE `order` SET disprice_id='$distance_price' WHERE order_id='$order_distance'";
    if (mysqli_query($conn, $sql_distance_update)) {
        header("Location:?page=address_order");
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

if(isset($_POST['canelorderid'])){
    $canelorderid = $_POST['canelorderid'];
    $comment = $_POST['comment'];
    $sql_cal_order = "UPDATE orderstatus_detail SET orderstatus_id = '9', detail= '$comment' WHERE order_id ='$canelorderid'";
    if (mysqli_query($conn, $sql_cal_order)) {
        unset($_SESSION['ordernumber']);
        unset($_SESSION['nowshop']);
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                timer: 1500,
                text: 'ระบบทำการยกเลิก แล้ว',
            })
        </script>
        <?php
        header("Location:?page=list");
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
if(isset($_POST['confirm_order'])){
    $orderid = $_POST['confirm_order'];
    $sqlorderupdate = "UPDATE orderstatus_detail SET orderstatus_id = '1' WHERE order_id ='$orderid'";
    $sqlorderupdate_q = mysqli_query($conn, $sqlorderupdate);
    if($sqlorderupdate_q){
        header("Location:?page=order_status&orderid=".$orderid);
    }else{
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