<script>
    function loadDataOrderstatus() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const rspcode = this.responseText
                const bodyhtml = `<div class=" d-flex flex-column justify-content-center">
                <div class="mx-auto ${rspcode==1||rspcode==2||rspcode==3?'bg-yellow-500':'bg-500'} fs-4 rounded-circle d-flex justify-content-center align-items-center"
                    style=" width: 50px; height: 50px;">
                    1
                </div>
                <span class=" text-nowrap">รอรับออเดอร์</span>
            </div>
            <hr class=" border-2 w-100 mt-4">
            <div class=" d-flex flex-column justify-content-center">
                <div class="mx-auto ${rspcode==2||rspcode==3?'bg-yellow-500':'bg-500'} fs-4 rounded-circle d-flex justify-content-center align-items-center"
                    style=" width: 50px; height: 50px;">
                    2
                </div>
                <span class=" text-nowrap">กำลังจัดส่ง</span>
            </div>
            <hr class=" border-2 w-100 mt-4">
            <div class=" d-flex flex-column justify-content-center">
                <div class="mx-auto ${rspcode==3?'bg-yellow-500':'bg-500'} fs-4 rounded-circle d-flex justify-content-center align-items-center"
                    style=" width: 50px; height: 50px;">
                    3
                </div>
                <span class=" text-nowrap">จัดส่งสำเร็จ</span>
            </div>`;
            document.getElementById('orderstatus').innerHTML = bodyhtml;
            }
        };
        xhttp.open("GET", "./api/orderstatus.php?orderidstatus=<?= $orderid ?>", true);
        xhttp.send();
    }
    setInterval(loadDataOrderstatus, 1000);
</script>