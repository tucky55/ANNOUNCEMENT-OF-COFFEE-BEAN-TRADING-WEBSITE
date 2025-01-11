<?php
include 'config/db.php';
include 'checkuser.php';
            if (isset($_SESSION['user_login'])) {
                $mem_id = $_SESSION['user_login'];
                $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                $res = mysqli_query($conn,$log);
                $row = mysqli_fetch_assoc($res);
                

if (isset($_SESSION['user_login']) || isset($_SESSION['admin_login'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bill_id = $_POST['bill_id'];
        $com_id = $_POST['com_id'];
        $ids= mysqli_insert_id($conn);

        $sql = "INSERT INTO comment (bill_id, com_detail) VALUES ('$bill_id', '$com_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $upd = "UPDATE comment SET mem_id='$mem_id' WHERE mem_id=0";
                $res1 = mysqli_query($conn,$upd);}
            echo "บันทึกความคิดเห็นเรียบร้อย";
            header( "refresh:1;url=show_billboard.php" );
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
        }
    }
} else {
    echo "กรุณาเข้าสู่ระบบก่อนที่จะแสดงความคิดเห็น";
}

mysqli_close($conn);
?>