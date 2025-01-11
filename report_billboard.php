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
                    <div class="container-fluid px-4 ">
                    
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                ประวัติลงประกาศ
                                <hr>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>รหัสประกาศ</th>
                                            <th>ประเภทโพส</th>
                                            <th>ประเภทเมล็ดกาแฟ</th>
                                            <th>ปริมาณ(kg.)</th>
                                            <th>ชื่อสมาชิก</th>
                                            <th>อัตราค่าบริการ</th>
                                            <th>วันที่ลงประกาศ</th>
                                            <th>สถานะ</th>
                                            <th>แจ้งชำระเงิน</th>
                                        </tr>
                                    </thead>
                                
<?php

$sql= 'SELECT * FROM billboard
            INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
            INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
            INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
            INNER JOIN member ON billboard.mem_id = member.mem_id
            INNER JOIN payment ON billboard.bill_id = payment.bill_id
            ORDER BY bill_status DESC ';
$result= mysqli_query($conn,$sql);
while($row= mysqli_fetch_array($result)){ 
$bill_status = $row['bill_status']; 
?>

                                    
                                        <tr>
                                            <td><?= $row['bill_id']?></td>
                                            <td><?= $row['bill_posttype']?></td>
                                            <td><?= $row['coffee_name'] ?></td>
                                            <td><?= $row['quantity_name']?></td>
                                            <td><?= $row['mem_username']?></td>
                                            <td><?= $row['service_price']?></td>
                                            <td><?= date('d-m-Y', strtotime($row['bill_datetime'] . ' +543 years')) ?></td>
                                            <td>
                                                <?php 
                                            if($bill_status == 2 ){
                                                echo "<b style='color:blue'>รออนุมัติ</b>";
                                            } elseif($bill_status == 1 ){
                                                echo "<b style='color:green'>อนุมัติแล้ว</b>";
                                            } elseif($bill_status == 0 ){
                                                echo "<b style='color:red'>ถูกลบ</b>";
                                            }    ?>

                                        </td>
                                        <td><a href="payment_detail.php?id=<?= $row['bill_id']?>" class="btn btn-outline-primary">รายละเอียด</a></td></td>         
                                    </tr>
<?php 
}

mysqli_close($conn);
?>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
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