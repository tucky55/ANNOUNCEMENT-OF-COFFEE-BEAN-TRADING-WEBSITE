<?php
    include 'checkuser.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = "กรุณาเข้าสู่ระบบ!";
         header('location: login.php');
    }
    $query = "SELECT * FROM sizebusiness";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include 'menu_user.php';?>
            <?php if(isset($_SESSION['warning'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php 
                            echo $_SESSION['warning'];
                            unset($_SESSION['warning']);
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
    <div class="container">
        <h3 class="mt-4">แก้ไขข้อมูลส่วนตัว</h3>
        <div class="col-md-5">
        <hr>
        <form action="edit_data_db.php" method="post">
            <div class="md-3">
                <label for="mem_username" class="form-label">ชื่อที่ใช้ในระบบ</label>
                <input type="text" class="form-control" name="mem_username" aria-describedby="mem_username" placeholder="<?php echo $row['mem_username'];?>" required>
            </div>
            <div class="md-3">
                <label for="mem_Email" class="form-label">Email</label>
                <input type="email" class="form-control" name="mem_email" aria-describedby="mem_email" placeholder="<?php echo $row['mem_email'];?>" required>
            </div>
            <div class="md-3">
                <label for="mem_name" class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="mem_name" aria-describedby="mem_name" placeholder="<?php echo $row['mem_name'];?>" required>
            </div>
            <div class="md-3">
                <label for="mem_birthday" class="form-label">วัน-เดือน-ปีเกิด</label>
                <input type="date"  class="form-control" name="mem_birthday" aria-describedby="mem_birthday" placeholder="<?php echo date('d-m-Y', strtotime($row['mem_birthday'] . ' +543 years')); ?>" required>
            </div>
            <div class="md-3">
                <label for="mem_address" class="form-label">ที่อยู่</label>
                <input type="text" class="form-control" name="mem_address" aria-describedby="mem_address" placeholder="<?php echo $row['mem_address'];?>" required>
            </div>
            <div class="md-3">
                <label for="mem_telephone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" name="mem_telephone" aria-describedby="mem_telephone" placeholder="<?php echo $row['mem_telephone'];?>" required>
            </div>
            <div class="md-3">
                <label for="mem_namebusiness" class="form-label">ชื่อที่ใช้ในธุรกิจ</label>
                <input type="text" class="form-control" name="mem_namebusiness" aria-describedby="mem_namebusiness" placeholder="<?php echo $row['mem_namebusiness'];?>" required>
            </div>
        <button type="submit" name= "submit" class="btn btn-secondary">บันทึกข้อมูล</button>
        <button type="reset" class="btn btn-secondary">ยกเลิก</button><br>
        </form>
    </div>
    </div>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<style>
    .col-md-5{
        position: absolute;
        top:175px;
        left: 400px;
    }
    h3 {
        position: absolute;
        top: 125px;
        left: 450px;
    }
    .alert{
        position: absolute;
        top:75px;
        left: 300px;
    }
    .btn{
        position: relative;
        top: 25px;
    }
    #editdata .nav-link{
        color: #ffffff; /* เปลี่ยนสีตัวหนังสือของเมนูที่ถูกเลือก */
        background-color: #b0c4de;
    }
</style>