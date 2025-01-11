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
    
    $query = "SELECT * FROM billboard";
    $result = mysqli_query($conn, $query);

    $query2 = "SELECT * FROM servicelate";
    $result2 = mysqli_query($conn, $query2);

    $query3 = "SELECT * FROM bank";
    $result3 = mysqli_query($conn, $query3);
    

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
                แจ้งชำระเงิน
            </div>
            <hr>
            <form name="form1" method="post" action="notification_of_payment_admin_db.php?bill_id=<?php echo $_GET['bill_id']; ?>" enctype="multipart/form-data">

                    <label >ชื่อสมาชิก :   <?php echo $row["mem_name"];?></label> <br><br>
                    <label>บัญชีที่โอน</label>
                    <select class="form-select text-center" name="bank_id" required> 
                        <option value="">- เลือก -</option>
                        <?php foreach($result3 as $row){?>
                        <option  value="<?php echo $row["bank_id"];?>">
                            <?php echo $row["bank_name"];?>
                            </option><?php }?>  
                    </select><br> 
                    <lable>ชื่อบัญชีผู้แจ้ง</lable>
                    <input type= "text" name= "payment_name" class= "form-control" placeholder= "ชื่อบัญชี.." ><br>   
                    <lable>จำนวนเงิน</lable>
                    <select class="form-select text-center" name="payment_amount" required>
                    <option value="">- เลือก -</option>
                        <?php foreach($result2 as $row){?>
                        <option  value="<?php echo $row["service_price"];?>">
                            <?php echo $row["service_price"];?>
                            </option><?php }?>
                    </select><br>
                    <lable>วันที่โอน</lable>
                    <input type= "date" name= "payment_slip" class= "form-control" placeholder= "0000-00-00" ><br>
                    <lable>รูปภาพสลิป</lable>
                    <input type= "file" name= "file1"  required><br><br>
                    <button type="submit" name ="submit1" class="btn btn-secondary">แจ้งชำระ</button>
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
    margin-left: 200px;
  }
</style>