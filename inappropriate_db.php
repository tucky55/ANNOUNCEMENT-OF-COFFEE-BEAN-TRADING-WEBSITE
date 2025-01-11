<?php 
    include 'config/db.php';
   

    if (isset($_POST["submit"])) {
        $report_form = $_POST['report_form'];
        $ids=$_GET['id'];
        $report_status = '2';
        

        // เพิ่มไปยังตาราง billboard
        $sql = "INSERT INTO report(report_form,report_status) VALUES(?,?)";
        $stmt1 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt1, "ss", $report_form,$report_status);
        $result1 = mysqli_stmt_execute($stmt1);
        $billboard_id = mysqli_insert_id($conn);  // ดึง ID ที่เพิ่งถูกสร้างขึ้น

        if ($result1) {
            include 'checkuser.php';
            if (isset($_SESSION['user_login'])) {
                $mem_id = $_SESSION['user_login'];
                $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                $res = mysqli_query($conn,$log);
                $row = mysqli_fetch_assoc($res);
                $upd = "UPDATE report SET mem_id='$mem_id' WHERE mem_id=0";
                $res1 = mysqli_query($conn,$upd);
                
                $sql= "UPDATE report SET bill_id ='$ids' WHERE bill_id=0";
                $result= mysqli_query($conn,$sql);
            }
            if (isset($_SESSION['admin_login'])) {
                $mem_id = $_SESSION['admin_login'];
                $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                $res = mysqli_query($conn,$log);
                $row = mysqli_fetch_assoc($res);
                $upd = "UPDATE report SET mem_id='$mem_id' WHERE mem_id=0";
                $res1 = mysqli_query($conn,$upd);
                
                $sql= "UPDATE report SET bill_id ='$ids' WHERE bill_id=0";
                $result= mysqli_query($conn,$sql);
            }
            echo 'รอสักครู่';
            echo "<script>alert('แจ้งสำเร็จ');</script>";
            header("refresh:1;url=show_billboard.php");
        }

        mysqli_stmt_close($stmt1);
    }
?>
