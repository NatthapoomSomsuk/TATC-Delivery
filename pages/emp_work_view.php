<div class=" d-flex flex-column  vh-100">
    <?php include('./components/nav_top.php') ?>
    <div class=" flex-shrink-1 h-100 overflow-hidden d-flex flex-column">
        <?php
         $datestart =  date("d/m/Y", strtotime($_POST['datestart']));
         $dateend =  date("d/m/Y", strtotime($_POST['dateend']));
         $empid = $_SESSION['emp'];
         $sql_work_dayist ="SELECT 
         *
     FROM 
         `order` 
     INNER JOIN 
         orderstatus_detail ON `orderstatus_detail`.order_id = `order`.order_id 
     INNER JOIN 
         distance_price ON `distance_price`.disprice_id = `order`.disprice_id
     
     WHERE 
         emp_id = '$empid' 
         AND STR_TO_DATE(`order`.order_date, '%d/%m/%Y') BETWEEN STR_TO_DATE('$datestart', '%d/%m/%Y') AND STR_TO_DATE('$dateend', '%d/%m/%Y')
         AND orderstatus_detail.orderstatus_id = 3
     GROUP BY `order`.order_id;";
         $sql_work_dayist_q = mysqli_query($conn,$sql_work_dayist);
         $sql_work_dayist_num = mysqli_num_rows($sql_work_dayist_q)
        ?>
        <div class=" p-3 my-auto">
            <div class=" bg-blue-200 p-3">
                <p class=" fs-5 ">ยอดงานตั้งแต่วัน <?= $datestart ?> ถึงวันที่ <?= $dateend ?></p>
                <p class=" fs-5 fw-bold">รวมทั้งหมด</p>
                <p class=" display-1 text-end text-white fw-bold"><?= $sql_work_dayist_num?$sql_work_dayist_num:'0' ?> งาน</p>
                <div class=" d-flex justify-content-end mt-3 ">
                    <a  href="?page=emp_work_setting" class=" btn btn-red-500 btn-lg px-5">กลับ</a>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/nva_emp_buttom.php') ?>
</div>