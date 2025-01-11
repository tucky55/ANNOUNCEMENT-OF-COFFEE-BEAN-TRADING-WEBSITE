<?php
session_start();
include 'config/db.php';
if (isset($_SESSION['admin_login'])) {
    $mem_id = $_SESSION['admin_login'];
    $log1 = "SELECT * FROM member WHERE mem_id = $mem_id";
    $res1 = mysqli_query($conn,$log1);
    $row1 = mysqli_fetch_assoc($res1);
}
if (isset($_POST['saved'])) {
    $mem_password = $_POST['mem_password'];
    $mem_password_verify = $_POST['mem_password_verify'];
    $mem_password_new = $_POST['mem_password_new'];}

    if (password_verify($mem_password, $row1['mem_password'])) {
        if($mem_password_new == $mem_password_verify)
        $passwordHash = password_hash($mem_password_new, PASSWORD_DEFAULT);
        $pass = "UPDATE member SET mem_password = '$passwordHash' WHERE mem_id = '$mem_id'";
        $res = mysqli_query($conn,$pass);
        $_SESSION['success'] = "แก้ไขรหัสผ่านเรียบร้อย";
        header("location: logout1.php");
    }

?>