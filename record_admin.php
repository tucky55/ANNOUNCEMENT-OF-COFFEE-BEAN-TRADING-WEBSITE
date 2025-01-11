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
<?php  include 'menu_admin.php'?>
    <div class="container">
    <div class="mmm ">
        <table class="table-striped  text-center  ">
            <tr>
                <td>
                    <div class="d-grid gap-2">
                    <a class="btn btn btn-success fs-4" href="record_bill_admin.php?id=<?= $row['mem_id']?>" role="button">ประวัติการลงประกาศ</a><hr>
                    <a class="btn btn btn-info fs-4" href="record_payment_admin.php?id=<?= $row['mem_id']?>" role="button">ประวัติการชำระเงิน</a><hr>
                    <a class="btn btn btn-danger fs-4" href="record_report_admin.php?id=<?= $row['mem_id']?>" role="button">ประวัติการแจ้งไม่เหมาะสม</a><hr>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    </div>
</body>
</html>
<style>
  .mmm{
    position: absolute;
    margin-top: -600px;
    margin-left: 200px;
    
  }
  
</style>

