<?php
     include 'checkuser.php';
     $ids=$_GET['id']; 
        $sql= "SELECT * FROM billboard WHERE bill_id= '$ids'";
        $result= mysqli_query($conn,$sql);
        $row1= mysqli_fetch_array($result);
        
    if (isset($_SESSION['user_login'])) {
        $mem_id = $_SESSION['user_login'];
        $log = "SELECT * FROM member WHERE mem_id = $mem_id";
        $res = mysqli_query($conn,$log);
        $row = mysqli_fetch_assoc($res);
            
    }
    if (isset($_SESSION['admin_login'])) {
        $mem_id = $_SESSION['admin_login'];
        $log = "SELECT * FROM member WHERE mem_id = $mem_id";
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
    <title>Add product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php  include 'menu_user.php'?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            <div class=" h2 mb-6 mt-5 text-danger" role="alert">
                แจ้งประกาศไม่เหมาะสม
            </div>
            <hr><br><br>
                <form name="form1" method="post" action="inappropriate_db.php?id=<?= $row1['bill_id']?>" enctype="multipart/form-data">
                    
                <h4 ><label >ชื่อผู้ร้องเรียน :   <?php echo $row['mem_username'];?></label><h4> <br>


                <h4><lable>หัวข้อที่แจ้ง</lable></h4>
                    <select class="form-select text-center" name="report_form" required><br>
                        <option value="">- เลือก -</option>
                        <option value="สื่อลามก">สื่อลามก</option>
                        <option value="สิ่งผิดกฎหมาย">สิ่งผิดกฎหมาย</option>
                        <option value="เว็ปการพนัน">เว็ปการพนัน</option>  
                    </select><br>
                    
                    <button type="submit" name ="submit" class="btn btn-secondary">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<style>
  .col-sm-4{
    position: relative;
    margin-left: 190px;
     top: -700px;
    width: 500px;
  }
</style>

