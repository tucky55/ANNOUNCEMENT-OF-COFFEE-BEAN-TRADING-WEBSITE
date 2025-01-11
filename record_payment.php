<?php 
include 'checkuser.php';
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
    }
     
    include 'config/db.php';
    if (!isset($_SESSION['user_login']) && !isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php  include 'menu_user.php'?>
    <div class="mmm">   
    <div class="container">
    <table class="table table-Secondary table-striped  text-center  ">
    <h3 class="h2 mb-6 mt-5">&nbsp;     &nbsp;    &nbsp;   &nbsp;     ประวัติการชำระเงิน</h3>
    <hr><br>
    <br>
    <br>
            <tr>
                <th>รหัสประกาศ</th>
                <th>ธนาคาร</th>
                <th>จำนวนเงิน</th>
                <th>วันที่ชำระเงิน</th>
                <th>รูปภาพ</th>
                <th>สถานะ</th>
            </tr>
            <?php
            $ids = $_GET['id'];
            $sql = "SELECT * FROM payment
                    INNER JOIN billboard ON payment.bill_id = billboard.bill_id 
                    INNER JOIN bank ON payment.bank_id = bank.bank_id
                    WHERE billboard.mem_id = '$ids'
                    ORDER BY payment_id DESC";
            $hand = mysqli_query($conn, $sql);
            

            // ตรวจสอบข้อผิดพลาดในการดำเนินการคำสั่ง SQL
            if (!$hand) {
                die('คำสั่ง SQL ผิดพลาด: ' . mysqli_error($conn));
            }
            
            while ($row = mysqli_fetch_array($hand)) {
                echo "<tr>";
                echo "<th>" . $row['bill_id'] . "</th>";
                echo "<th>" . $row['bank_name'] . "</th>";
                echo "<th>" . $row['payment_amount'] . "</th>";
                echo "<th>" . date('d-m-Y', strtotime($row['payment_slip'] .  ' +543 years')) . "</th>";
                echo "<th><img src='img/" . $row['payment_pic'] . "' width='175px' height='125px'></th>";
                echo "<th>";
                if ($row['payment_status'] == 2) {
                    echo "<b style='color:blue'>รออนุมัติ</b>";
                } elseif ($row['payment_status'] == 1) {
                    echo "<b style='color:green'>อนุมัติ</b>";
                } elseif ($row['payment_status'] == 0) {
                    echo "<b style='color:red'>ไม่อนุมัติ</b>";
                }
                echo "</th>";
                echo "</tr>";
            }
            

            mysqli_close($conn);
            ?>
        </table>
    </div>
    </div>
</body>
</html>
<style>
  .mmm{
    position: absolute;
    margin-top: -700px;
    margin-left: 400px;
  }
  
</style>
