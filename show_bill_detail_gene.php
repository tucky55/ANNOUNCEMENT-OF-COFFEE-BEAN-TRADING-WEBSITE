<?php 
include 'config/db.php';
date_default_timezone_set("Asia/Bangkok");
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
<?php  include 'menu_general.php'?>
<div class="container">
  <div class="row">
  <?php 
    $ids=$_GET['id']; 
        $sql= "SELECT * FROM billboard
                    INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
                    INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
                    INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
                    and billboard.bill_id= '$ids'
                    INNER JOIN member ON billboard.mem_id = member.mem_id";
        $result= mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result)
    ?>
    <div class="col-md-4"><br><br>
      <img src= "img/<?=$row['pic_name'] ?>" width="400px" class= "mt-5 p-3 border" />
    </div>
    <div class="col-md-6"><br><br>
    <h5 class= "text-success"><?php echo $row['coffee_name']?><h5>
        ประเภท : <?php echo $row['bill_posttype']?><br><br> 
        ปริมาณ(kg.) : <?php echo $row['quantity_name']?> <br><br>
        ชื่อผู้ประกาศ : <?php echo $row['mem_name']?> <br><br>
        วันที่ลงประกาศ : <?php echo date('d-m-Y', strtotime($row['bill_datetime']. ' +543 years'))?> <br><br>
        วันสิ้นสุดประกาศ : <?php echo date('d-m-Y', strtotime($row['bill_datetime'] . ' + ' . $row['service_id'] . ' days' . ' +543 years')) ?> <br><br>
        ช่องทางการติดต่อ : <?php echo $row['bill_linkcontect']?> <br><br>
        เบอร์โทรศัพท์ : <?php echo $row['bill_telephone']?> <br><br>
        ที่อยู่ : <?php echo $row['bill_address']?> <br><br>
        รายละเอียด : <?php echo $row['bill_detail']?> <br><br>
        <?php  
            $exp = strtotime($row['bill_datetime'] . ' + ' . $row['service_id'] . ' days');
            $now = time();
            $diff = $exp - $now;
            $days = floor($diff / (60 * 60 * 24));
            $hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
            $mins = floor(($diff % (60 * 60)) / 60);
        ?>
        เหลือเวลา : <?php
        if ($days > 0 || $hours > 0 || $mins > 0) {
            echo $days . " &nbsp วัน &nbsp&nbsp " . $hours . " &nbsp ชั่วโมง &nbsp&nbsp " . $mins . "&nbsp นาที ";
        } else {
          $update_status_query = "UPDATE billboard SET bill_status = 0 WHERE bill_id = '$ids'";
          mysqli_query($conn, $update_status_query);
        }
        ?>
  </div>
</div>
<?php 
 mysqli_close($conn);
?>
</body>
</html>

<style>
  .col-md-4{
    position: absolute;
    margin-top: -300px;
    margin-left: 100px;
  }
  .col-md-6{
    position: absolute;
    margin-left: 600px;
    margin-top: -200px;
  }
</style>