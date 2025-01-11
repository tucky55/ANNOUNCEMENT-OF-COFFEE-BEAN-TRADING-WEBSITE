<?php 
    session_start();
    include 'config/db.php';
    if (!isset($_SESSION['user_login']) && !isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:login.php');
    }
    if (isset($_SESSION['user_login'])) {
        $mem_id = $_SESSION['user_login'];
        $log = "SELECT * FROM member WHERE mem_id = $mem_id";
        $res = mysqli_query($conn,$log);
        $row1 = mysqli_fetch_assoc($res);}

    $query = "SELECT * FROM coffee";
    $result = mysqli_query($conn, $query);

    $query1 = "SELECT * FROM quantity";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "SELECT * FROM servicelate";
    $result2 = mysqli_query($conn, $query2);
    $ids= $_GET['id'];
    $sql= "SELECT * FROM billboard
               INNER JOIN coffee ON billboard.coffee_id = coffee.coffee_id
               INNER JOIN quantity ON billboard.quantity_id = quantity.quantity_id
               INNER JOIN servicelate ON billboard.service_id = servicelate.service_id
               INNER JOIN member ON billboard.mem_id = member.mem_id 
               WHERE bill_id = '$ids'
";
        $result4= mysqli_query($conn,$sql);
        $row2= mysqli_fetch_assoc($result4)
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
            <div class=" h2 mb-6 mt-5" role="alert">
                ลงข้อมูลประกาศ
            </div>
            <hr>
                <form name="form1" method="post" action="edit_record_bill_db.php" enctype="multipart/form-data">
                    <lable>ชนิดเมล็ดกาแฟ</label>
                    <select class="form-select text-center" name="coffee_id" required> 
                        <option value="<?php echo $row2['coffee_name'];?>"><?php echo $row2['coffee_name'];?></option>
                        <?php foreach($result as $row){?>
                        <option  value="<?php echo $row["coffee_id"], $row["coffee_name"];?>">
                            <?php echo $row["coffee_name"];?>
                            </option><?php }?>
                        <?php 
                            mysqli_close($conn);
                        ?>
                    </select><br>
                    <label>ปริมาณ(kg.)</label>
                    <select class="form-select text-center" name="quantity_id" required>
                        <option value="<?php echo $row2['quantity_name'];?>"><?php echo $row2['quantity_name'];?></option>
                        <?php foreach($result1 as $row){?>
                        <option  value="<?php echo  $row["quantity_id"];?>">
                            <?php echo $row["quantity_name"];?>
                            </option><?php }?>
                    </select><br>
                    <lable>ประเภทการประกาศ</lable>
                    <select class="form-select text-center" name="bill_posttype" required>
                        <option value="<?php echo $row2['bill_posttype'];?>"><?php echo $row2['bill_posttype'];?></option>
                        <option value="ซื้อ">ซื้อ</option>
                        <option value="ขาย">ขาย</option>  
                    </select><br>
                    <lable>ช่องทางติดต่อ</lable>
                    <input type= "text" name= "bill_linkcontect" class= "form-control" placeholder= "<?php echo $row2['bill_linkcontect'];?>" ><br>
                    <lable>รายละเอียด</lable>
                    <input type= "text" name= "bill_detail" class= "form-control" placeholder= "<?php echo $row2['bill_detail'];?>" ><br>
                    <lable>ที่อยู่</lable>
                    <input type= "text" name= "bill_address" class= "form-control" placeholder= "<?php echo $row2['bill_address'];?>" required><br>
                    <lable>เบอร์โทรศัพท์</lable>
                    <input type= "number" name= "bill_telephone" class= "form-control" placeholder= "<?php echo $row2['bill_telephone'];?>" required><br>  
                    <label>อัตราค่าบริการ</label>
                    <select class="form-select text-center" name="service_id" required>
                    <option value="<?php echo $row2['service_price'];?>"><?php echo $row2['service_price'];?></option>
                        <?php foreach($result2 as $row){?>
                        <option  value="<?php echo $row["service_id"];?>">
                            <?php echo $row["service_price"];?>
                            </option><?php }?>
                    </select><br>
                    <button type="submit" name ="submit" class="btn btn-secondary">บันทึกข้อมูล</button>
                    <button type="reset" class="btn btn-secondary mx-2">รีเซ็ต</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<style>
  .col-sm-4{
    position: absolute;
    margin-top: -750px;
    margin-left: 100px;
  }
</style>