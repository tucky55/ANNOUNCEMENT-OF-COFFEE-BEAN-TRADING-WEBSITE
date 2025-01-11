<?php
include 'config/db.php';
if (isset($_SESSION['user_login'])) {
    $mem_id = $_SESSION['user_login'];
    $log = "SELECT * FROM member WHERE mem_id = $mem_id ";
    $res = mysqli_query($conn,$log);
    $row = mysqli_fetch_assoc($res);           
}
if (isset($_SESSION['admin_login'])) {
    $mem_id = $_SESSION['admin_login'];
    $log = "SELECT * FROM member WHERE mem_id = $mem_id ";
    $res = mysqli_query($conn,$log);
    $row = mysqli_fetch_assoc($res);       
}?>
<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
        <a class="navbar-brand fs-3" href="#">𝓒𝓸𝓯𝓯𝓮𝓮𝓑𝓲𝓵𝓵</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse fs-5 " id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li>
                <div class="container">
                        <h4 class="mt-2 text-danger">Welcome  <?php echo $row['mem_username']; ?></h4>
                        </div>    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">เกี่ยวกับเรา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="payment_method.php">วิธีชำระเงิน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">ติดต่อเรา</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="container-fluid">
    <div class="row text-center">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar " style="background-color: #F0F8FF;" >
            <div class="position-sticky">
                <ul class="nav flex-column fs-5"><br><br>
                <label class="form-label fs-3 ">รายการประกาศ</label>
                    <li class="nav-item" id="all">
                        <a class="nav-link active"  aria-current="page" href="show_billboard.php">
                            รายการสินค้า
                        </a>
                    </li>
                    <li class="nav-item" id="buy">
                        <a class="nav-link" href="buy.php">
                            ตลาดรับซื้อ
                        </a>
                    </li>
                    <li class="nav-item" id="sell">
                        <a class="nav-link" href="sell.php">
                            ตลาดส่งขาย
                        </a>
                    </li><br><br>
                <label class="form-label fs-3 ">ข้อมูลส่วนตัว</label>
                    <li class="nav-item">
                        <a class="nav-link" href="edit_data.php">
                            แก้ไขข้อมูลส่วนตัว
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit_pass.php">
                            แก้ไขรหัสผ่าน
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            ออกจากระบบ
                        </a>
                        
                    </li><br><br>
                <label class="form-label fs-3 ">ข้อมูลประกาศ</label>
                    <li class="nav-item">
                        <a class="nav-link" href="record.php">
                            ประวัติประกาศ
                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="Add_product_information.php">
                            ลงประกาศ
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>


<style>
    #sidebar .nav-link {
        color: #000000; /* เปลี่ยนสีตัวหนังสือทั้งหมดใน Sidebar */
    }

    #sidebar .nav-link:hover {
        color: #ffffff; /* เปลี่ยนสีตัวหนังสือของเมนูที่ถูกเลือก */
        background-color: #6495ED; /* เปลี่ยนสีพื้นหลังของเมนูที่ถูกเลือก */ 
    }
    #sidebar .nav-link:active {
        color: #ffffff; /* เปลี่ยนสีตัวหนังสือของเมนูที่ถูกเลือก */
        background-color: #6495ED; /* เปลี่ยนสีพื้นหลังของเมนูที่ถูกเลือก */ 
    }
</style>