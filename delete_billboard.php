<?php 
    include 'db.php';
    $ids=$_GET['id'];

    // เริ่มการทำงานภายใต้ transaction
    mysqli_begin_transaction($conn);

    // อัปเดตสถานะในตาราง billboard
    $sql_billboard = "UPDATE billboard SET bill_status = 0 WHERE bill_id='$ids'";
    $result_billboard = mysqli_query($conn, $sql_billboard);

    // อัปเดตสถานะในตาราง payment
    $sql_payment = "UPDATE payment SET payment_status = 0 WHERE bill_id='$ids'";
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