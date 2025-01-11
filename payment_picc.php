<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <style>
        /* ปรับขนาดรูปภาพขยายใหญ่ */
        #enlargedImage {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            overflow: auto;
        }
        #enlargedImage img {
            display: block;
            margin: auto;
            max-width: 90%;
            max-height: 90%;
        }
    </style>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'menu1.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 fs-4 mt-4">
                        หลักฐานการชำระ
                                <hr>
                    </div>                             
<?php
$ids=$_GET['id'];
$sql= "SELECT * FROM payment WHERE payment.payment_id= '$ids'";
$result= mysqli_query($conn,$sql);
while($row= mysqli_fetch_array($result)){ 
?>

        <!-- รูปภาพที่จะขยายใหญ่ -->
<div class="text-center">
    <img id="myImage" src="../img/<?= $row['payment_pic']?>" width="300px" height="350" class="mt-5 p-3 border" onclick="enlargeImage()">
    <br><br>
    <a href="report_payment.php" class="btn btn-outline-success">กลับหน้าหลัก</a>
</div>

<!-- รูปภาพที่ขยายใหญ่ -->
<div id="enlargedImage" onclick="hideImage()">
    <img id="enlargedImg" src="" alt="enlarged image">
</div>

<script>
    function enlargeImage() {
        var imgSrc = document.getElementById('myImage').src;
        var enlargedImg = document.getElementById('enlargedImg');
        enlargedImg.src = imgSrc;
        document.getElementById('enlargedImage').style.display = 'block';
    }

    function hideImage() {
        document.getElementById('enlargedImage').style.display = 'none';
    }
</script>
                        
                                    
<?php 
}

mysqli_close($conn);
?>

                </main>
                <?php include 'footer.php'?>
            </div>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
<style>
  .text-center{
    position: absolute;
    margin-top: 10px;
    margin-left: 250px;
  }
</style>
