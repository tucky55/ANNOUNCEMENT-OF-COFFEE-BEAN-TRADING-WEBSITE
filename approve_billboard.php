<?php 
    include 'db.php';
    $ids=$_GET['id'];
    date_default_timezone_set("Asia/Bangkok");
    $current_datetime = date('d-m-Y H:i');
  
    // เริ่มการทำงานภายใต้ transaction
    mysqli_begin_transaction($conn);

    // อัปเดตสถานะในตาราง billboard
    $sql_billboard = "UPDATE billboard SET bill_status = 1 WHERE bill_id='$ids'   ";
    $result_billboard = mysqli_query($conn, $sql_billboard);
    $sql_datetime_update = "UPDATE billboard SET bill_datetime = '$current_datetime' WHERE bill_id='$ids'";
    $result_datetime_update = mysqli_query($conn, $sql_datetime_update);

    // อัปเดตสถานะในตาราง payment
    $sql_payment = "UPDATE payment SET payment_status = 1 WHERE bill_id='$ids'";
    $result_payment = mysqli_query($conn, $sql_payment);

    // ตรวจสอบว่าทั้งสองการอัปเดตเสร็จสมบูรณ์หรือไม่
    if ($result_billboard && $result_payment) {
        // ทำการ commit transaction หากทั้งสองสำเร็จ
        mysqli_commit($conn);
        echo "<script>alert('อนุมัติแล้ว');</script>";
        echo "<script>window.location='report_billboard.php';</script>";
    } else {
        // ทำการ rollback transaction หากเกิดข้อผิดพลาด
        mysqli_rollback($conn);
        echo "<script>alert('ไม่สามารถอัปเดตข้อมูลได้');</script>";
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);
?>