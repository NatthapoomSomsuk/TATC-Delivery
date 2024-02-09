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
                const rspcode = this.responseText
                const bodyhtml = ``;
            document.getElementById('orderstatus').innerHTML = bodyhtml;
            }
        };
        xhttp.open("GET", "./api/orderstatus.php?orderidstatus=<?= $orderid ?>", true);
        xhttp.send();
    }
    setInterval(loadDataOrderEMP, 1000);
</script>
<div class=" d-flex justify-content-between px-3 mt-3">
    <p class="m-0 fs-4">ชื่อผู้ส่ง</p>
    <p class="m-0 fs-4" id=""> นายรักดี ขยันเรียน</p>
</div>
<div class=" d-flex justify-content-end px-3 mt-4">
    <button class=" btn btn-red-500 px-5">ยกเลิก</button>
</div>
<div class=" d-flex justify-content-between align-items-center mt-3 px-3">
    <p class="m-0 fs-6">กรุณาชำระเงินภายใน 3 นาที</p>
    <button class=" btn btn-yellow-500 btn-lg px-5" data-bs-toggle="modal" data-bs-target="#payment">
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
                    <div class=" vstack gap-3">
                        <input type="text" value="นายรักดี ขยันเรียน" class=" form-control rounded-3 " disabled>
                        <input type="text" value="ธนาคารกรุงไทย" class=" form-control rounded-3 " disabled>
                        <input type="text" value="xxx-xxx-xxxx" class=" form-control rounded-3 " disabled>
                        <label for="upload_image" class=" position-relative">
                            <button class=" btn btn-blue-700 text-white w-100">อัปโหลดหลักฐานการโอน</button>
                            <input type="file" name="img_user" class="image" id="upload_image" style="display:none" />
                        </label>
                        <button class=" btn btn-yellow-500 object-fit-contain" data-bs-toggle="modal"
                            data-bs-target="#payment">
                            ส่งสลิป
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>