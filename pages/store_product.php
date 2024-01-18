<div class=" d-flex flex-column  vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class=" flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <p class=" text-center fs-2 my-3">ร้านโบราณตามสั่ง</p>
        <div class=" h-100 overflow-scroll ">
            <div class=" card mx-4 bg-200 border-0 hstack overflow-hidden mb-2">
                <img src="./public/img/food/f1.png" alt="" style="width: 150px;">
                <div class=" d-flex justify-content-center align-items-center w-100 vstack">
                    <p class=" fs-5 m-0 text-center">ขนมจีนแกงเขียวหวาน</p>
                    <p class=" fs-6 m-0 text-center">ราคา 35 บาท</p>
                    <button class=" btn btn-yellow-500 rounded-3  px-5" data-bs-toggle="modal"
                        data-bs-target="#manu">เพิ่ม</button>
                    <div class="modal fade" id="manu" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                                <div class="modal-header bg-700 rounded-0">
                                    <h1 class="modal-title fs-5 text-white fw-normal" id="exampleModalLabel">รายละเอียด
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <p class=" fs-5 text-center m-0 ">ขนมจีนแกงเขียวหวาน</p>
                                    <div class=" d-flex justify-content-center">
                                        <img src="./public/img/food/f1.png" alt="" style="width: 150px;"
                                            class=" mx-auto">

                                    </div>
                                    <div class=" hstack gap-2 mt-3">
                                        <button onclick="decrement()" class=" btn btn-danger rounded-0">-</button>
                                        <input type="number" id="quantity" value="1" class=" form-control text-center"
                                            disabled>

                                        <button onclick="increment()" class=" btn btn-danger rounded-0">+</button>
                                        <script>
                                            function increment() {
                                                var quantityInput = document.getElementById('quantity');
                                                var currentValue = parseInt(quantityInput.value);
                                                quantityInput.value = currentValue + 1;
                                            }

                                            function decrement() {
                                                var quantityInput = document.getElementById('quantity');
                                                var currentValue = parseInt(quantityInput.value);

                                                // ตรวจสอบว่าจำนวนไม่น้อยกว่า 1 ก่อนที่จะลด
                                                if (currentValue > 1) {
                                                    quantityInput.value = currentValue - 1;
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="input-group mb-3 mt-3">
                                        <span class="input-group-text">รายละเอียดเพิ่มเติม</span>
                                        <input type="text" class="form-control shadow-none">

                                    </div>
                                    <div class=" d-flex justify-content-between mt-4">
                                        <button href="" class="btn btn-red-500 rounded-pill px-5" data-bs-dismiss="modal">ยกเลิก</button>
                                        <button class=" btn btn-yellow-500 rounded-pill px-5" >เพิ่มลงรถเข็น</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/nav_buttom.php') ?>
</div>