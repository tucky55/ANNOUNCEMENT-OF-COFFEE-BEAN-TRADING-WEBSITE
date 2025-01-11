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
    <title>detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<?php  include 'menu_user.php'?>
<div class="container">
  <div class="md-3">
                <label  class="form-label fs-2">เกี่ยวกับเรา</label>
                <hr>
                <label  class="form-label fs-5">เว็ปไซต์นี้เป็นเว็ปไซต์ประกาศซื้อ - ขายเมล็ดกาแฟมีขึ้นเพื่อเป็นการขยายตลาดการค้าขายเมล็ดกาแฟวัตถุประสงค์หลักคือการประกาศการค้าขายเพียงเฉพาะเมล็ดกาแฟเท่านั้น  เช่น  สายพันธ์</label>
                <label  class="form-label fs-5">-อาราบิก้า (Arabica Coffee)</label><br>   
                <label  class="form-label fs-5">-โรบัสต้า (Robusta Coffee)</label><br> 
                <label  class="form-label fs-5">-ลิบีรา (Liberica Coffee)</label><br> 
                <label  class="form-label fs-5">-เอ็กเซลซิโอร์ (Excelsa Coffee)  เป็นต้น</label>
            </div>
  
</div>
<?php 
 mysqli_close($conn);
?>
</body>
</html>

<style>
  .md-3{
    position: absolute;
    margin-top: -650px;
    margin-left: 100px;
    width: 700px;
  }
</style>