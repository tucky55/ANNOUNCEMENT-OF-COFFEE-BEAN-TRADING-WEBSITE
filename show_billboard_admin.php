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
    <title>billboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
  <?php  include 'menu_admin.php';?>
  <div class="col-md-6 well">
        <div class="col-md-8">
            <form method="POST" action="">
                <div class="form-inline">
                    <label>หมวดหมู่:</label>
                    <select class="form-control text-center" name="category" id="category">
                        <option  selected>---เลือก---</option>
                        <option value="อาราบิก้า (Arabica)">อาราบิก้า (Arabica)</option>
                        <option value="โรบัสตา (Robusta)">โรบัสตา (Robusta)</option>
                        <option value="ลิบีรา (Liberica)">ลิบีรา (Liberica)</option>
                        <option value="เอ็กเซลซิโอร์ (Excelsa)">เอ็กเซลซิโอร์ (Excelsa)</option>
                    </select>
                    <button class="btn btn-primary" name="filter">ค้นหา</button>
                    <button class="btn btn-success" name="reset">ยกเลิก</button>
                </div>
            </form>
            <br /><br />
        </div>
  </div>
  <?php 
    if(isset($_POST['filter'])){?>
<div class="container">
  <div class="row">
    <?php
        $category=$_POST['category'];
        $sql= "SELECT * FROM billboard
               INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
               INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
               INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
               INNER JOIN member ON billboard.mem_id = member.mem_id 
               and billboard.bill_status = 1
               WHERE coffee_name = '$category'
               ";
        $result= mysqli_query($conn,$sql);
        while($row= mysqli_fetch_array($result)){  
    ?>
    <div class="col-sm-4 ">
        <div class="text-center">
        <img src= "img/<?= $row['pic_name']?>" width="200px"  height= "250" class= "mt-5 p-3 border"><br> <br>
        ID : <?= $row['bill_id']?> <br>  
        <h5 class= "text-success"><?php echo $row['coffee_name']?><h5>
        ประเภท : <?php echo $row['bill_posttype']?><br> 
        ปริมาณ(kg.) : <?php echo $row['quantity_name']?> <br>
        ชื่อผู้ประกาศ : <?php echo $row['mem_name']?> <br>
        <br>
        <a class="btn btn-outline-secondary" href="show_bill_detail_admin.php?id=<?= $row['bill_id']?>" role="button">รายละเอียด</a>
      </div>
    </div>
<?php } ?>
  </div>
</div>
        <?php
    }else if(isset($_POST['reset'])){?>
<div class="container">
  <div class="row">
    <?php

        $sql= 'SELECT * FROM billboard
               INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
               INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
               INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
               INNER JOIN member ON billboard.mem_id = member.mem_id
               WHERE billboard.bill_status = 1'; // เพิ่มเงื่อนไขนี้';
        $result= mysqli_query($conn,$sql);
        while($row= mysqli_fetch_array($result)){  
    ?>
    <div class="col-sm-4 ">
        <div class="text-center">
        <img src= "img/<?= $row['pic_name']?>" width="200px"  height= "250" class= "mt-5 p-3 border"><br> <br>
        ID : <?= $row['bill_id']?> <br>  
        <h5 class= "text-success"><?php echo $row['coffee_name']?><h5>
        ประเภท : <?php echo $row['bill_posttype']?><br> 
        ปริมาณ(kg.) : <?php echo $row['quantity_name']?> <br>
        ชื่อผู้ประกาศ : <?php echo $row['mem_name']?> <br>
        <br>
        <a class="btn btn-outline-secondary" href="show_bill_detail_admin.php?id=<?= $row['bill_id']?>" role="button">รายละเอียด</a>
      </div>
    </div>
<?php } ?>
  </div>
</div>
        <?php
    }else{ ?>
<div class="container">
  <div class="row">
    <?php

        $sql= 'SELECT * FROM billboard
               INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
               INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
               INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
               INNER JOIN member ON billboard.mem_id = member.mem_id
               WHERE billboard.bill_status = 1'; // เพิ่มเงื่อนไขนี้';
        $result= mysqli_query($conn,$sql);
        while($row= mysqli_fetch_array($result)){  
    ?>
    <div class="col-sm-4 ">
        <div class="text-center">
        <img src= "img/<?= $row['pic_name']?>" width="200px"  height= "250" class= "mt-5 p-3 border"><br> <br>
        ID : <?= $row['bill_id']?> <br>  
        <h5 class= "text-success"><?php echo $row['coffee_name']?><h5>
        ประเภท : <?php echo $row['bill_posttype']?><br> 
        ปริมาณ(kg.) : <?php echo $row['quantity_name']?> <br>
        ชื่อผู้ประกาศ : <?php echo $row['mem_name']?> <br>
        <br>
        <a class="btn btn-outline-secondary" href="show_bill_detail_admin.php?id=<?= $row['bill_id']?>" role="button">รายละเอียด</a>
      </div>
    </div>
  <?php } ?>
  </div>
</div>
<?php }?>
</body>
</html>
<style>
  .col-sm-4{
    position: relative;
    margin-left: 130px;
    top: -550px;
    width: 250px;
  }
  .col-md-8{
    position:absolute;
    top:95px;
    margin-left:450px;
    width:180px;
    
  }
  .btn-primary{
    position:absolute;
    top:25px;
    margin-left:200px;
  }
  .btn-success{
    position:absolute;
    top:25px;
    margin-left:270px;
  }
  #⁠all.nav-link{
    color: #ffffff;
    background-color: #b0c4de;
  }
</style>

