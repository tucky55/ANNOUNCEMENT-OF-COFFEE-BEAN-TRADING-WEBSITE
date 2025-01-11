<?php
include 'checkuser.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบ!";
     header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include 'menu_admin.php';?>
<div class="">
        <h3 class="mt-4">แก้ไขรหัสผ่าน</h3>
        <div class="col-md-5">
        <hr>
        <form action="edit_pass_admin_db.php" method="post">
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
            <div class="mb-3">
                <label for="mem_password" class="form-label">รหัสผ่านปัจจุบัน</label>
                <input type="password" class="form-control" name="mem_password" aria-describedby="mem_password">
            </div>
            <div class="mb-3">
                <label for="mem_password_new" class="form-label">รหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="mem_password_new" aria-describedby="mem_password_new"><br>
            <div class="mb-3">
                <label for="mem_password_verify" class="form-label">ยืนยันอีกครั้ง</label>
                <input type="password" class="form-control" name="mem_password_verify" aria-describedby="mem_password_verify">
            <br>
            <button type="submit" name = "saved" class="btn btn-secondary">บันทึก</button><br>
        </form>
    </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<style>
    .col-md-5{
        position: absolute;
        top:155px;
        left: 400px;
    }
    h3 {
        position: absolute;
        top: 105px;
        left: 400px;
    }
</style>