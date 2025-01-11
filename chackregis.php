<?php

session_start();
require_once 'config/db.php';

if (isset($_POST['save'])) {
    $mem_username = $_POST['mem_username'];
    $mem_password1 = $_POST['mem_password1'];
    $mem_password2 = $_POST['mem_password2'];
    $mem_Email = $_POST['mem_Email'];
    $mem_name = $_POST['mem_name'];
    $mem_birthday = $_POST['mem_birthday'];
    $date_display_format = 'd-m-Y';
    $mem_birthday_display = date($date_display_format, strtotime($mem_birthday . ' -543 year'));
    $mem_address = $_POST['mem_address'];
    $mem_telephone = $_POST['mem_telephone'];
    $mem_namebusiness = $_POST['mem_namebusiness'];
    $sizebusiness_id = $_POST['sizebusiness_id'];
    $mem_other = $_POST['mem_other'];
    $mem_type = 'user';

    if (empty($mem_username)) {
        $_SESSION['error'] = 'กรุณากรอก username';
        header("location: register.php");
    } elseif (empty($mem_password1)) {
        $_SESSION['error'] = 'กรุณากรอก password';
        header("location: register.php");
    } elseif (empty($mem_password2)) {
        $_SESSION['error'] = 'กรุณายืนยัน password';
        header("location: register.php");
    } elseif (empty($mem_Email)) {
        $_SESSION['error'] = 'กรุณากรอก email';
        header("location: register.php");
    } elseif (!filter_var($mem_Email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบไม่ถูกต้อง';
        header("location: register.php");
    } elseif (empty($mem_name)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อ';
        header("location: register.php");
    } elseif (empty($mem_birthday)) {
        $_SESSION['error'] = 'กรุณากรอกว/ด/ปเกิด';
        header("location: register.php");
    } elseif (empty($mem_address)) {
        $_SESSION['error'] = 'กรุณากรอกที่อยู่';
        header("location: register.php");
    } elseif (empty($mem_telephone)) {
        $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
        header("location: register.php");
    } elseif (empty($mem_namebusiness)) {
        $_SESSION['error'] = 'กรุณากรอกชื่อธรุกิจ';
        header("location: register.php");
    } elseif (empty($sizebusiness_id)) {
        $_SESSION['error'] = 'กรุณากรอกขนาดของธุรกิจ';
        header("location: register.php");
    } else {
        try {
            $check_username = $conn->prepare("SELECT mem_username FROM member WHERE mem_username = ?");
            $check_username->bind_param("s", $mem_username);
            $check_username->execute();
            $check_username->store_result();

            if ($check_username->num_rows > 0) {
                $_SESSION['warning'] = 'มีอยู่ในระบบแล้ว';
                header("location: register.php");
            } elseif (!isset($_SESSION['error'])) {
                if ($mem_password1 == $mem_password2){
                $passwordHash = password_hash($mem_password1, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO member(mem_username, mem_password, mem_Email, mem_name, mem_birthday, mem_address, mem_telephone, mem_namebusiness, sizebusiness_id, mem_type) 
                        VALUES(?, ?, ?, ?, STR_TO_DATE(?, '%d-%m-%Y'), ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssss", $mem_username, $passwordHash, $mem_Email, $mem_name, $mem_birthday_display, $mem_address, $mem_telephone, $mem_namebusiness, $sizebusiness_id, $mem_type);
                $stmt->execute();
                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อย";
                header("location: register.php");}
            } else {
                $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                header("location: register.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            $check_username->close();
        }
    }
}

?>