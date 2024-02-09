<div class=" bg-blue-400 p-3 text-white">
    รหัสการสั่งซื้อ 00001
</div>
<?php
$orderid = $_GET['orderid'];
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
            <tr>
                <td>แกงเขียวหวานไก่</td>
                <td>หิว</td>
                <td>1</td>
                <td>30</td>
            </tr>
            <tr>
                <td>แกงเขียวหวานไก่</td>
                <td>หิว</td>
                <td>1</td>
                <td>30</td>
            </tr>
        </tbody>
    </table>
</div>
<div class=" vstack mt-3 gap-1">
    <div class=" d-flex align-items-center">
        <div class=" rounded-circle bg-blue-500 mx-3 " style="height:20px;width:20px"></div>ชื่อร้าน
    </div>
    <div class=" d-flex align-items-center">
        <div class=" rounded-circle bg-red-500 mx-3 " style="height:20px;width:20px"></div>สถานที่จัดส่ง
    </div>
</div>
<script>
    function loadDataOrderEMP() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const rspcode = JSON.parse(this.response)
                if (rspcode.status == 'no_emp') {
                    document.getElementById('emp_name').innerHTML = 'กำลังรอคนรส่ง..';
                    document.getElementById('emp_name_s').value = 'กำลังรอคนรส่ง..';
                    document.getElementById('divpaymet').classList.add('d-none')
                } else {
                    document.getElementById('emp_name').innerHTML = rspcode.emp_name;
                    document.getElementById('emp_name_s').value = rspcode.emp_name;
                    document.getElementById('emp_back_s').value = rspcode.Bank;
                    document.getElementById('emp_backnumber_s').value = rspcode.Bank_number;
                    document.getElementById('divpaymet').classList.remove('d-none')
                    startcountdow()
                    stopaajex()
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
        xhttp.onreadystatechange = function () {
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

<form method="post">
    <div class=" d-flex justify-content-end px-3 mt-4">
        <button class=" btn btn-red-500 px-5" name="canelorderid" value="<?= $orderid ?>">ยกเลิก</button>
    </div>
</form>

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
                    <form method="post" enctype="multipart/form-data" >
                        <div class=" vstack gap-3">
                            <input type="text" value="loading.." class=" form-control rounded-3 " disabled id="emp_name_s">
                            <input type="text" value="loading.." class=" form-control rounded-3 " disabled
                                id="emp_back_s">
                            <input type="text" value="loading.." class=" form-control rounded-3 " disabled
                                id="emp_backnumber_s">
                            <label for="upload_image" class=" position-relative">
                                <a class=" btn btn-blue-700 text-white w-100">อัปโหลดหลักฐานการโอน</a>
                                <input type="file" name="img_slip" class="image" id="upload_image"
                                    style="display:none" />
                            </label>
                            <button class=" btn btn-yellow-500 object-fit-contain" name="send_slip" value="<?= $orderid ?>">
                                ส่งสลิป
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>