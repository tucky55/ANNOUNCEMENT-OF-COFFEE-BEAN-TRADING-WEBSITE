<?php 
    session_start();
    include 'config/db.php';
    if (!isset($_SESSION['user_login']) && !isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:login.php');
    }

    $ids = $_GET['bill_id'];
    $query = "SELECT * FROM billboard
                        INNER JOIN coffee ON billboard.coffee_id=coffee.coffee_id
                        WHERE bill_id = '$ids'";
    $result = mysqli_query($conn, $query);

    $query1 = "SELECT * FROM quantity";
    $result1 = mysqli_query($conn, $query1);

    $query2 = "SELECT * FROM servicelate";
    $result2 = mysqli_query($conn, $query2);
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
<?php  include 'menu_admin.php'?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            <div class=" h2 mb-6 mt-5" role="alert">
                ลงข้อมูลประกาศ
            </div>
            <hr>
                <form name="form1" method="post" action="edit_record_bill_detail_admin_db.php?bill_id=<?php echo $_GET['bill_id']; ?>" enctype="multipart/form-data">
                <?php foreach($result as $row1){?>
                    <lable>ชนิดเมล็ดกาแฟ :</label> <?php echo $row1["coffee_name"];}?> <br><br>
                    <label>ปริมาณ(kg.)</label>
                    <select class="form-select text-center" name="quantity_id" required>
                        <option value="">- เลือก -</option>
                        <?php foreach($result1 as $row){?>
                        <option  value="<?php echo  $row["quantity_id"];?>">
                            <?php echo $row["quantity_name"];?>
                            </option><?php }?>
                    </select><br>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ราคา/หน่วย</label>
                            <div class="col-sm-5 "> 
                                <input type="number" name="coffee_price" class="form-control" placeholder="ราคา"> <span>บาท</span>
                            </div>
                            <div class="col-sm-5">
                                <input type="number" name="coffee_unit" class="form-control" placeholder="หน่วย"> <span>(kg.)</span>
                            </div>
                    </div><br>
                    <lable>ประเภทการคั่ว : </lable><?php echo $row1["type_roast"];?> <br>
                    </select><br>
                    <lable>วันเวลาที่เก็บเกี่ยว :</lable> <?php echo date('d-m-Y', strtotime($row1['harvest_period']. ' +543 years'))?> <br><br>
                    <lable>แหล่งเพาะปลูก :</lable> <?php echo $row1["production_source"];?> <br><br>
                    <lable>เปลือกเมล็ดกาแฟ :</lable>  <?php echo $row1["coffee_shell"];?> <br>     <br>
                    <lable>ประเภทการประกาศ :</lable> <?php echo $row1["bill_posttype"];?> <br> <br>
                    <lable>ช่องทางติดต่อ :</lable> </lable> <?php echo $row1["bill_linkcontect"];?> <br> <br>
                    <lable>รายละเอียด : </lable> </lable> <?php echo $row1["bill_detail"];?> <br> <br>
                    <lable>ที่อยู่ :</lable> </lable> </lable> <?php echo $row1["bill_address"];?> <br> <br>
                    <lable>เบอร์โทรศัพท์ :</lable> </lable> <?php echo $row1["bill_telephone"];?> <br> <br>
                    <button type="submit" name ="submit" class="btn btn-secondary">บันทึกข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<style>
  .col-sm-4{
    position: absolute;
    margin-top: -650px;
    margin-left: 300px;
    
  }
</style>