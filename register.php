<?php 
    session_start();
    include 'config/db.php';
    $query = "SELECT * FROM sizebusiness";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php
    require_once 'config/db.php';
?>
<body>
<?php  include 'menu_general.php'?>
    <div class="container">
        <h3 class="mt-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สมัครสมาชิก</h3>
        <div class="col-md-5">
        <hr>
        <form action="chackregis.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-dang" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php 
                            echo $_SESSION['warning'];
                            unset($_SESSION['warning']);
                        ?>
                    </div>
            <?php } ?>
            
            <div class="md-3">
                <label for="mem_username" class="form-label">ชื่อที่ใช้ในระบบ</label>
                <input type="text" class="form-control" name="mem_username" aria-describedby="mem_username">
            </div>
            <div class="md-3">
                <label for="mem_password1" class="form-label">รหัสที่ใช้ในระบบ</label>
                <input type="password" class="form-control" name="mem_password1" aria-describedby="mem_password">
            </div>
            <div class="md-3">
                <label for="mem_password2" class="form-label">ยืนยันรหัส</label>
                <input type="password" class="form-control" name="mem_password2" aria-describedby="mem_password">
            </div>
            <div class="md-3">
                <label for="mem_Email" class="form-label">Email</label>
                <input type="email" class="form-control" name="mem_Email" aria-describedby="mem_Email">
            </div>
            <div class="md-3">
                <label for="mem_name" class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="mem_name" aria-describedby="mem_name">
            </div>
            <div class="md-3">
                <label for="mem_birthday" class="form-label">วัน-เดือน-ปีเกิด</label>
                <input type="date" class="form-control" name="mem_birthday" aria-describedby="mem_birthday">
            </div>
            <div class="md-3">
                <label for="mem_address" class="form-label">ที่อยู่</label>
                <input type="text" class="form-control" name="mem_address" aria-describedby="mem_address">
            </div>
            <div class="md-3">
                <label for="mem_telephone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" name="mem_telephone" aria-describedby="mem_telephone">
            </div>
            <div class="md-3">
                <label for="mem_namebusiness" class="form-label">ชื่อที่ใช้ในธุรกิจ</label>
                <input type="text" class="form-control" name="mem_namebusiness" aria-describedby="mem_namebusiness">
            </div>
            <div class="md-3">
                <label for="mem_other" class="form-label">อื่นๆ</label>
                <input type="text" class="form-control" name="mem_other" aria-describedby="mem_other">
            </div>
            <div class="md-3">
                <label for="sizebusiness_id" class="form-label">ขนาดของธุรกิจ</label>
                <select class="form-select text-center" name="sizebusiness_id" > 
                        <option value="">- เลือก -</option>
                        <?php foreach($result as $row){?>
                        <option  value="<?php echo $row["sizebusiness_id"], $row["sizebusiness_name"];?>">
                            <?php echo $row["sizebusiness_name"];?>
                            </option><?php }?>
                        <?php 
                            mysqli_close($conn);
                        ?>
                </select>       
            </div><br>
        <button type="submit" name= "save" class="btn btn-secondary">บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-secondary">ยกเลิก</button><br><br>
        <a href='login.php'> เข้าสู่ระบบ </a>
        </form>
    </div>
    </div>
</body>
</html>

<style>
  .col-md-5{
    position: relative;
    margin-left: 190px;
     top: -250px;
 
  }
</style>

<style>
  .mt-4{
    position: relative;
    margin-left: 190px;
     top: -250px;

  }
</style>

