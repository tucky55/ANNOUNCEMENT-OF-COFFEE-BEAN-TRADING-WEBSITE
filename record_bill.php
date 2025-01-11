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
        <table class="table table-Secondary table-striped text-center">
            <h3 class="h2 mb-6 mt-5">&nbsp; &nbsp; &nbsp; &nbsp; ประวัติการลงประกาศ</h3>
            <hr><br>
            <br>
            <tr>
                <th>ชนิด</th>
                <th>ปริมาณ(kg.)</th>
                <th>รายละเอียด</th>
                <th>จำนวนวันและค่าใช้บริการ</th>
                <th>ช่องทางการติดต่อ</th>
                <th>ที่อยู่</th>
                <th>เบอร์โทรศัพท์</th>
                <th>ประเภทการประกาศ</th>
                <th>วันที่ลงประกาศ</th>
                <th>รูปภาพ</th>
                <th>สถานะ</th>   
                <th>เปลี่ยนแปลง</th>  
            </tr>
            <?php
            $ids=$_GET['id'];
            $sql = "SELECT * FROM billboard
                    INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
                    INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
                    INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
                    INNER JOIN member ON billboard.mem_id = member.mem_id
                    and member.mem_id= '$ids'
                    ORDER BY bill_id DESC";
            $hand = mysqli_query($conn, $sql);

            if (!$hand) {
                die('คำสั่ง SQL ผิดพลาด: ' . mysqli_error($conn));
            }
            
            while ($row = mysqli_fetch_array($hand)) {
                echo "<tr>";
                echo "<th>" . $row['coffee_name'] . "</th>";
                echo "<th>" . $row['quantity_name'] . "</th>";
                echo "<th>" . $row['bill_detail'] . "</th>";
                echo "<th>" . $row['service_price'] . "</th>";
                echo "<th>" . $row['bill_linkcontect'] . "</th>";
                echo "<th>" . $row['bill_address'] . "</th>";
                echo "<th>" . $row['bill_telephone'] . "</th>";
                echo "<th>" . $row['bill_posttype'] . "</th>";
                echo "<th>" . date('d-m-Y', strtotime($row['bill_datetime']. ' +543 years')) . "</th>";
                echo "<th><img src='img/" . $row['pic_name'] . "' width='175px' height='125px'></th>";
                echo "<th>";
                if ($row['bill_status'] == 2) {
                    echo "<b style='color:blue'>รออนุมัติ</b>";
                } elseif ($row['bill_status'] == 1) {
                    echo "<b style='color:green'>อนุมัติ</b>";
                } elseif ($row['bill_status'] == 0) {
                    echo "<b style='color:red'>ถูกลบ</b>";
                }
                echo "</th>";
                echo "<th>";
                if ($row['bill_status'] == 2) {
                    $bill_id = $row['bill_id'];
                    $check_payment_query = "SELECT * FROM payment WHERE bill_id = $bill_id";
                    $check_payment_result = mysqli_query($conn, $check_payment_query);
                    
                    if (mysqli_num_rows($check_payment_result) == 0) {
                        // ถ้าไม่มีการบันทึกข้อมูลในตาราง payment
                        echo "<a href='edit_record_bill.php?id=" . $row['bill_id'] . "' class='btn btn-outline-danger'>แก้ไข</a>";
                        echo "<a href='notification_of_payment.php?bill_id=" . $row['bill_id'] . "' class='btn btn-outline-primary'>ชำระเงิน</a>";
                    } else {
                        // ถ้ามีการบันทึกข้อมูลในตาราง payment
                        echo "<a href='edit_record_bill.php?id=" . $row['bill_id'] . "' class='btn btn-outline-danger'>แก้ไข</a>";
                    }
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
    margin-top: -750px;
    margin-left: 400px;
}
</style>
