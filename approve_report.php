<?php 
    include 'db.php';
    $ids=$_GET['id'];

    $sql= "UPDATE report SET report_status = 1 WHERE report_id='$ids'";
    $result= mysqli_query($conn,$sql);
    if ($result){
        echo "<script>alert('ปกติ');</script>";
        echo "<script>window.location='report_inapproriate.php';</script>";
    }else{
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
    }

    mysqli_close($conn);


?>