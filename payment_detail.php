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
                        แจ้งชำระเงิน
                                <hr>
                    </div>                             
<?php
$ids=$_GET['id'];
$sql= "SELECT * FROM payment
            INNER JOIN billboard ON payment.bill_id = billboard.bill_id
            INNER JOIN bank ON payment.bank_id = bank.bank_id
            and payment.bill_id= '$ids'";
$result= mysqli_query($conn,$sql);
while($row= mysqli_fetch_array($result)){ 
$payment_status = $row['payment_status']; 
?>

        <div class="text-center">
        <img src= "../img/<?= $row['payment_pic']?>" width="300px"  height= "350" class= "mt-5 p-3 border"><br> <br>
        รหัสประกาศ : <?= $row['bill_id']?> <br><hr>
        ธนาคารของระบบ : <?= $row['bank_name']?> <br><hr>
        จำนวนเงิน : <?= $row['payment_amount']?><br><hr>
        วันที่ชำระเงิน : <?= date('d-m-Y', strtotime($row['payment_slip'] . ' +543 years')) ?><br><hr>
        สถานะ : <?php 
                                            if($payment_status == 2 ){
                                                echo "<b style='color:blue'>รออนุมัติ</b>";
                                            } elseif($payment_status == 1 ){
                                                echo "<b style='color:green'>อนุมัติ</b>";
                                            } elseif($payment_status == 0 ){
                                                echo "<b style='color:red'>ไม่อนุมัติ</b>";
                                            }    ?><br><hr>
        <a href="approve_billboard.php?id=<?= $row['bill_id']?>" class="btn btn-outline-success">อนุมัติ</a>
        <a href="delete_billboard.php?id=<?= $row['bill_id']?>" class="btn btn-outline-danger">ลบ</a><hr>
        <a href="report_billboard.php" class="btn btn-outline-success">กลับหน้าหลัก</a><br>
      </div>                        
                                    
<?php 
}

mysqli_close($conn);
?>

                </main>
                <?php include 'footer.php'?>
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