<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'menu1.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 fs-4 mt-4">
                        รายละเอียดการแจ้งไม่เหมาะสม
                                <hr>
                    </div>                             
<?php
$ids=$_GET['id'];
$sql= "SELECT * FROM report
            INNER JOIN billboard ON report.bill_id = billboard.bill_id
            INNER JOIN member ON report.mem_id = member.mem_id
            INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
            and report.report_id= '$ids'";
$result= mysqli_query($conn,$sql);
while($row= mysqli_fetch_array($result)){ 
?>

        <div class="text-center">
        <img src= "../img/<?= $row['pic_name']?>" width="300px"  height= "350" class= "mt-5 p-3 border"><br> <br>
        หัวข้อที่ถูกร้องเรียน : <?= $row['report_form']?> <br><hr>
        วันที่ลงประกาศ : <?= date('d-m-Y', strtotime($row['bill_datetime'] . ' +543 years')) ?><br><hr>
        ชื่อผู้ประกาศ : <?= $row['mem_name']?> <br><hr>
        ประเภท : <?= $row['bill_posttype']?><br><hr>
        ชนิดเมล็ด : <?= $row['coffee_name']?><br><hr>
        รายละเอียด : <?= $row['bill_detail']?><br><hr>
        ที่อยู่ : <?= $row['bill_address']?><br><hr>
        เบอร์โทร : <?= $row['bill_telephone']?><hr>
         <a href="approve_report.php?id=<?= $row['report_id']?>" class="btn btn-outline-success">ปกติ</a>
         <a href="delete_inapproriate.php?id=<?= $row['bill_id']?>" class="btn btn-outline-danger">ผิดปกติ</a>
                                              
    <hr>   
        <a href="report_inapproriate.php" class="btn btn-outline-success">กลับหน้าหลัก</a>
      </div>                        
                                    
<?php 
}

mysqli_close($conn);
?>

                </main>
            </div>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
<style>
  .text-center{
    position: relative;
    margin-top: 10px;
    margin-left: 250px;
  }
</style>