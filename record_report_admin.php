<?php 
include 'checkuser.php';
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
<?php  include 'menu_admin.php'?>
    <div class="mmm">   
    <div class="container">
    <table class="table table-Secondary table-striped  text-center  ">
    <h3 class="h2 mb-6 mt-5">&nbsp;     &nbsp;    &nbsp;   &nbsp;     ประวัติการชำระเงิน</h3>
    <hr><br>
            <tr>
                <th>รหัสการแจ้ง</th>
                <th>รหัสประกาศที่แจ้ง</th>
                <th>หัวข้อที่ร้องเรียน</th>
                <th>วันและเวลาที่แจ้ง</th>
                <th>สถานะ</th>
            </tr>
            <?php
            $ids=$_GET['id'];
            $sql = "SELECT * FROM report
                    INNER JOIN billboard ON report.bill_id = billboard.bill_id
                    INNER JOIN member ON report.mem_id = member.mem_id
                    and member.mem_id= '$ids'
                    ORDER BY report_id DESC";
            $hand = mysqli_query($conn, $sql);

            // ตรวจสอบข้อผิดพลาดในการดำเนินการคำสั่ง SQL
            if (!$hand) {
                die('คำสั่ง SQL ผิดพลาด: ' . mysqli_error($conn));
            }
            
            while ($row = mysqli_fetch_array($hand)) {
                echo "<tr>";
                echo "<th>" . $row['report_id'] . "</th>";
                echo "<th>" . $row['bill_id'] . "</th>";
                echo "<th>" . $row['report_form'] . "</th>";
                echo "<th>" . date('d-m-Y', strtotime($row['report_time'] .  ' +543 years')) . "</th>";
                echo "<th>";
                if ($row['report_status'] == 2) {
                    echo "<b style='color:blue'>รออนุมัติ</b>";
                } elseif ($row['report_status'] == 1) {
                    echo "<b style='color:green'>อนุมัติ</b>";
                } elseif ($row['report_status'] == 0) {
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
    margin-top: -650px;
    margin-left: 400px;
  }
  .table{
    width: 1100px;
  }
  
</style>
