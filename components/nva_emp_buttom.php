<div class="px-2 py-3 fw-medium fs-4 w-100" style="box-shadow: 0px -1px 5px 6px rgba(0,0,0,0.19) inset;">
    <div class="d-flex justify-content-around">
        <a href="?page=emp_dasbord" class="text-decoration-none text-dark">
            <div class="vstack justify-content-center">
                <img src="./public/img/icon/home.svg" alt="" style="width: 30px; height: 30px;" class="mx-auto">
                <span class="small fw-light text-center" style="font-size: 15px;">หน้าหลัก</span>
            </div>
        </a>
        <a href="?page=emp_order" class="text-decoration-none text-dark">
            <div class="vstack justify-content-center">
                <img src="./public/img/icon/store.svg" alt="" style="width: 30px; height: 30px;" class="mx-auto">
                <span class="small fw-light text-center" style="font-size: 15px;">คำสั่งซื้อ</span>
            </div>
        </a>
        <a href="?page=emp_list" class="text-decoration-none text-dark">
            <div class="vstack justify-content-center">
                <img src="./public/img/icon/list.svg" alt="" style="width: 30px; height: 30px;" class="mx-auto">
                <span class="small fw-light text-center" style="font-size: 15px;">รายการ</span>
            </div>
        </a>
        <a href="?page=emp_profile&id=<?php echo isset($_SESSION['emp']) ? $_SESSION['emp'] : ''; ?>" class="text-decoration-none text-dark">
            <div class="vstack justify-content-center">
                <img src="./public/img/icon/profile.svg" alt="" style="width: 30px; height: 30px;" class="mx-auto">
                <span class="small fw-light text-center" style="font-size: 15px;">โปรไฟล์</span>
            </div>
        </a>
    </div>
</div>
