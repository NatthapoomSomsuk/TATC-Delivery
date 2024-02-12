<?php
if (isset($_SESSION['emp'])) {
    $emp_id = $_SESSION['emp'];
}
?>
<div class="d-flex flex-column vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class="flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <div class="d-flex justify-content-between px-4 pt-3">
            <p class="text-center fs-2 m-0">คำสั่งซื้อที่สามารถรับได้</p>
        </div>
        <script>
            loademptime()
            function loademptime() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        const rspcode = JSON.parse(this.response)
                        if (rspcode.status == '1') {
                            document.getElementById('newconconten').classList.remove('d-none');
                            document.getElementById('timegetorder_alt').classList.add('d-none');
                        } else {
                            document.getElementById('newconconten').classList.add('d-none');
                            document.getElementById('timegetorder_alt').classList.remove('d-none');
                        }
                    }
                };
                xhttp.open("GET", "./api/empgetorder.php?gettime=<?= $emp_id ?>", true);
                xhttp.send();
            }
            setInterval(loademptime, 5000);
        </script>
        <div class="bg-red-100 rounded-3 text-center text-red-500 fs-4 m-2 py-5  " id="timegetorder_alt">
            ตอนนี้ยังคุณยังไม่สามารถรับคำสั่งซื้อได้เนืองจากยังไม่ใช่เวลางานของคุณ
        </div>
        <script>
            $(document).ready(function () {
                function load_unseen_notification() {
                    $.ajax({
                        type: "GET",
                        url: "./api/empgetorder.php",
                        data: { getlistorder: 'test' },
                        dataType: 'JSON',
                        success: function (response) {
                            $('#newconconten').html(response.orderlist);
                        }
                    });
                }
                load_unseen_notification();

                setInterval(function () {
                    load_unseen_notification();
                }, 5000);
            })
            function myFunction(data) {
                document.getElementById('modal_orderid').innerHTML = `รหัสคำสั่งซื้อ ${data[0]}`
                document.getElementById('modal_cusname').innerHTML = ` ${data[1]}`
                document.getElementById('modal_disprice_name').innerHTML = ` ${data[5]}`
                document.getElementById('modal_listcount').innerHTML = ` ${data[3]}`
                document.getElementById('modal_total_price').innerHTML = ` ${data[2]}`
                document.getElementById('modal_price').innerHTML = ` ${data[4]}`
                document.getElementById('order_modal').value = ` ${data[0]}`
            }
        </script>
        <div id="newconconten" class="d-none"></div>
        <div class="modal fade" id="list" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 bg-red-600 text-white">
                        <h6 class="modal-title fs-6" id="modal_orderid"></h6>
                    </div>
                    <div class="modal-body">
                        <div class=" hstack ">
                            <p class=" m-0 text-nowrap" style="width: 150px;">ชื่อลูกค้า</p>
                            <div class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2"
                                id="modal_cusname"></div>
                        </div>
                        <div class=" hstack ">
                            <p class=" m-0 text-nowrap" style="width: 150px;">สถานที่จัดส่ง</p>
                            <div class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2"
                                id="modal_disprice_name"></div>
                        </div>
                        <div class=" hstack ">
                            <p class=" m-0 text-nowrap" style="width: 150px;">รายการที่สั่ง</p>
                            <div class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2"
                                id="modal_listcount"></div>
                        </div>
                        <div class=" hstack ">
                            <p class=" m-0 text-nowrap" style="width: 150px;">ยอดรวม</p>
                            <div class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2"
                                id="modal_total_price"></div>
                        </div>
                        <div class=" hstack ">
                            <p class=" m-0 text-nowrap" style="width: 150px;">ค่าส่ง</p>
                            <div class=" mx-3 border-bottom border-top-0 border-start-0 border-end-0 border-500 border-1 w-100 px-2"
                                id="modal_price"></div>
                        </div>
                        <div class=" d-flex justify-content-end mt-3">
                        
                            <button class=" btn btn-red-500 rounded-0" data-bs-dismiss="modal">ไม่สนใจ</button>
                            <?php include('./controllers/emp_getorder.php') ?>
                            <form method="post" class="ms-2">
                                <input type="hidden" name="orderid" value="" id="order_modal">
                                <button class=" btn btn-green-500 rounded-0 me-2 px-5" value="<?= $emp_id ?>" name="empgetorder">รับ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/nva_emp_buttom.php') ?>
</div>