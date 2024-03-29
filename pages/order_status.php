<?php
$orderid = $_GET['orderid'];
?>
<div class=" bg-blue-400 p-3 text-white">
    รหัสการสั่งซื้อ
    <?= $orderid ?>
</div>
<?php

include('./script/order_status.php')
    ?>


<div class=" card border-0 rounded-0 shadow">
    <div class=" card-body">
        <div class=" p-3 d-flex justify-content-center " id='orderstatus'>
            loading..
        </div>
    </div>
</div>
<div class="p-3 shadow">
    <?php
    $sql_order = "SELECT * FROM `order`
    INNER JOIN `item`
    ON `order`.item_id = item.item_id WHERE `order`.order_id = $orderid";
    $sql_order_q = mysqli_query($conn, $sql_order);

    ?>
    <table class=" table">
        <thead>
            <tr>
                <td>ชื่อเมนู</td>
                <td>รายละเอียด</td>
                <td>จำนวน</td>
                <td>ราคา</td>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($sql_order_q)) {
                ?>
            <tr>
                <td>
                    <?= $data['item_name'] ?>
                </td>
                <td>
                    <?= $data['description'] ?>
                </td>
                <td>
                    <?= $data['amount'] ?>
                </td>
                <td>
                    <?= $data['total_price'] ?>
                </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>

<div class=" vstack mt-3 gap-1">
    <div class=" d-flex align-items-center">
        <?php
        $sql_name_shop = "SELECT *
            FROM `order`
            INNER JOIN `shop` ON `shop`.shop_id = `order`.`shop_id`
            INNER JOIN `distance_price` ON `distance_price`.disprice_id = `order`.`disprice_id`
            WHERE `order`.order_id = '$orderid'
            GROUP BY `order`.order_id;
            ";
        $sql_name_shop_q = mysqli_query($conn, $sql_name_shop);
        $sql_name_shop_q_f = mysqli_fetch_assoc($sql_name_shop_q)
            ?>
        <div class=" rounded-circle bg-blue-500 mx-3 " style="height:20px;width:20px"></div>ชื่อร้าน
        <?= $sql_name_shop_q_f['shop_name'] ?>
    </div>
    <div class=" d-flex align-items-center">
        <div class=" rounded-circle bg-red-500 mx-3 " style="height:20px;width:20px"></div>สถานที่จัดส่ง
        <?= $sql_name_shop_q_f['disprice_name'] ?>
    </div>
</div>
<script>
function loadDataOrderEMP() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const rspcode = JSON.parse(this.response)
            if (rspcode.status == 'no_emp') {
                document.getElementById('emp_name').innerHTML = 'กำลังรอคนรส่ง..';
                document.getElementById('emp_name_s').value = 'กำลังรอคนรส่ง..';
                document.getElementById('divpaymet').classList.add('d-none')
            } else {


                if (rspcode.paytype_id == '2') {
                    document.getElementById('emp_name').innerHTML = rspcode.emp_name;
                    document.getElementById('emp_name_s').value = rspcode.emp_name;
                    document.getElementById('emp_back_s').value = rspcode.Bank;
                    document.getElementById('emp_backnumber_s').value = rspcode.Bank_number;
                    document.getElementById('divpaymet').classList.remove('d-none')
                    startcountdow()
                    stopaajex()
                } else {
                    document.getElementById('emp_name').innerHTML = rspcode.emp_name;
                }

            }
        }
    };
    xhttp.open("GET", "./api/orderstatus.php?orderempstatus=<?= $orderid ?>", true);
    xhttp.send();
}
const IntervalEMP = setInterval(loadDataOrderEMP, 1000);

function stopaajex() {
    clearInterval(IntervalEMP);
}

function startcountdow() {
    var displayTime = 3 * 60;
    var countdownElement = document.getElementById('countdown');
    var button = document.getElementById('paybtn');

    function updateCountdown() {
        var minutes = Math.floor(displayTime / 60);
        var seconds = displayTime % 60;

        countdownElement.textContent = minutes + ' นาที ' + seconds + ' วินาที';
    }

    function hideButton() {
        button.style.display = 'none';
    }

    function updateTimer() {
        if (displayTime > 0) {
            updateCountdown();
            displayTime--;
        } else {
            hideButton();
            timeout();

            clearInterval(timerInterval);
        }
    }

    // อัปเดตเวลาทุกๆ 1 วินาที
    var timerInterval = setInterval(updateTimer, 1000);
}

function timeout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            Swal.fire({
                icon: 'error',
                title: 'คำสั่งซื้อ',
                timer: 5000,
                showConfirmButton: false,
                text: 'คุญไม่ได้ทำการจ่ายเงินตามเวลาที่กำหนดระบบจึงทำการยกเลิก order โดยอัตโมัติ',
            }).then(() => {
                sessionStorage.removeItem("ordernumber");
                sessionStorage.removeItem("nowshop");
                window.location.href = "?page=home";
            })

        }
    };
    xhttp.open("GET", "./api/orderstatus.php?orderempouttime=<?= $orderid ?>", true);
    xhttp.send();
}
</script>
<div class=" d-flex justify-content-between px-3 mt-3">
    <p class="m-0 fs-4">ชื่อผู้ส่ง</p>
    <p class="m-0 fs-4" id="emp_name"> loading..</p>
</div>
<?php include('./controllers/basket.php') ?>
<!-- <button type="button" class="btn btn-blue-500" >กลับหน้าหลัก</button> -->

<button class=" btn btn-red-500 rounded-0" data-bs-toggle="modal" data-bs-target="#calorder"> ยกเลิก</button>
<div class="modal fade" id="calorder" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">รายละเอียดการยกเลิก
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                กรุณาใส่เหตุผลการยกเลิก (อย่ายกเลิกกรณีไม่จำเป็น)

                <form method="post">
                    <input type="text" class=" form-control shadow-none" name="comment">
                    <div class=" d-flex justify-content-between mt-2">
                        <button class=" btn btn-500 rounded-0" data-bs-dismiss="modal">
                            Back</button>
                        <button class=" btn btn-red-500 rounded-0" name="canelorderid" value="<?= $orderid ?>">
                            ยืนยันการยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class=" d-flex justify-content-between align-items-center mt-3 px-3 d-none" id="divpaymet">
    <p class="m-0 fs-6">ชำระเงินภายใน <span id="countdown"></span></p>
    <button class=" btn btn-yellow-500 btn-lg px-5" data-bs-toggle="modal" data-bs-target="#payment" id="paybtn">
        ชำระเงิน
    </button>
    <div class="modal fade" id="payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ธนาคารและเลขบัญชีผู้ส่ง</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./controllers/paymet.php') ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class=" vstack gap-3">
                            <input type="text" value="loading.." class=" form-control rounded-3 " disabled
                                id="emp_name_s">
                            <input type="text" value="loading.." class=" form-control rounded-3 " disabled
                                id="emp_back_s">
                            <input type="text" value="loading.." class=" form-control rounded-3 " disabled
                                id="emp_backnumber_s">
                            <label for="upload_image" class=" position-relative">
                                <a class=" btn btn-blue-700 text-white w-100">อัปโหลดหลักฐานการโอน</a>
                                <input type="file" name="img_slip" class="image" id="upload_image"
                                    style="display:none" />
                            </label>
                            <button class=" btn btn-yellow-500 object-fit-contain" name="send_slip"
                                value="<?= $orderid ?>">
                                ส่งสลิป
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
  footer {
    position: fixed;
    /* ทำให้อยู่ติดด้านล่างของหน้าจอ */
    bottom: 0;
    /* วางที่ด้านล่าง */
    width: 100%;
    /* ทำให้มีความกว้างเท่ากับหน้าจอ */
    z-index: 999;
    /* ให้อยู่ด้านหน้าสุด */
    background-color: #fff;
    /* สีพื้นหลัง (สามารถเปลี่ยนไปตามต้องการ) */
  }

  /* body {
  margin-bottom: 10px;
} */
</style>



<footer>
  <?php include('./components/nav_buttom.php') ?>
</footer>
