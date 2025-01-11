<?php 
    session_start();
    include 'config/db.php';
    if (!isset($_SESSION['user_login']) && !isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:login.php');
    }
    $query = "SELECT * FROM coffee";
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
                <form name="form1" method="post" action="Add_product_information_admin_db.php" enctype="multipart/form-data">
                    <lable>ชนิดเมล็ดกาแฟ</label>
                    <select class="form-select text-center" name="coffee_id" required> 
                        <option value="">- เลือก -</option>
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
                    </div>
                    <lable>ประเภทการคั่ว</lable>
                    <select class="form-select text-center" name="type_roast" required>
                        <option value="">- เลือก -</option>
                        <option value="ไม่คั่ว">ไม่คั่ว</option>
                        <option value="คั่วอ่อน">คั่วอ่อน</option>
                        <option value="คั่วกลาง">คั่วกลาง</option>  
                        <option value="คั่วเข้ม">คั่วเข้ม</option>  
                    </select><br>
                    <lable>วันเวลาที่เก็บเกี่ยว</lable>
                    <input type= "date" name= "harvest_period" class= "form-control" ><br>
                    <lable>แหล่งเพาะปลูก</lable>
                    <input type= "text" name= "production_source" class= "form-control" placeholder= "สถานที่..." ><br>    
                    <lable>เปลือกเมล็ดกาแฟ</lable>
                    <select class="form-select text-center" name="coffee_shell" required>
                        <option value="">- เลือก -</option>
                        <option value="แกะแล้ว">แกะแล้ว</option>
                        <option value="ยังไม่แกะ">ยังไม่แกะ</option>  
                    </select><br>        
                    <lable>ประเภทการประกาศ</lable>
                    <select class="form-select text-center" name="bill_posttype" required>
                        <option value="">- เลือก -</option>
                        <option value="ซื้อ">ซื้อ</option>
                        <option value="ขาย">ขาย</option>  
                    </select><br>
                    <lable>ช่องทางติดต่อ</lable>
                    <input type= "text" name= "bill_linkcontect" class= "form-control" placeholder= "ช่องทางติดต่อ.." ><br>
                    <lable>รายละเอียด</lable>
                    <input type= "text" name= "bill_detail" class= "form-control" placeholder= "รายละเอียด.." ><br>
                    <lable>ที่อยู่</lable>
                    <input type= "text" name= "bill_address" class= "form-control" placeholder= "ที่อยู่.." required><br>
                    <lable>เบอร์โทรศัพท์</lable>
                    <input type= "number" name= "bill_telephone" class= "form-control" placeholder= "เบอร์โทรศัพท์.." required><br>  
                    <label>อัตราค่าบริการ</label>
                    <select class="form-select text-center" name="service_id" required>
                    <option value="">- เลือก -</option>
                        <?php foreach($result2 as $row){?>
                        <option  value="<?php echo $row["service_id"];?>">
                            <?php echo $row["service_price"];?>
                            </option><?php }?>
                    </select><br>
                    <lable>รูปภาพ</lable>
                    <input type= "file" name= "file1"  required><br><br>
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
    margin-top: -650px;
    margin-left: 100px;
    
  }
</style>