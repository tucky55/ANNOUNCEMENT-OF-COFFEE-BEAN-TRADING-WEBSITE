<?php

session_start();
require_once 'config/db.php';
if (isset($_POST["submit"])) {
    $mem_username = $_POST['mem_username'];
    $mem_email = $_POST['mem_email'];
    $mem_name = $_POST['mem_name'];
    $mem_birthday = $_POST['mem_birthday'];
    $mem_birthday_display = date('d-m-Y', strtotime($mem_birthday . ' -543 year'));
    $mem_address = $_POST['mem_address'];
    $mem_telephone = $_POST['mem_telephone'];
    $mem_namebusiness = $_POST['mem_namebusiness'];}

    $check_email = $conn->prepare("SELECT mem_email FROM member WHERE mem_email = ?");
    $check_email->bind_param("s", $mem_email);
    $check_email->execute();
    $check_email->store_result();
        if ($check_email->num_rows > 0) {
        $_SESSION['warning'] = 'มีอยู่ในระบบแล้ว';
        header("location: edit_data.php");}


        if (isset($_SESSION['user_login'])) {
            $mem_id = $_SESSION['user_login'];
            $log = "SELECT * FROM member WHERE mem_id = $mem_id";
            $res = mysqli_query($conn,$log);
            $row = mysqli_fetch_assoc($res);
            $upd = "UPDATE member 
                    SET mem_username = '$mem_username', 
                        mem_email = '$mem_email',
                        mem_name = '$mem_name',
                        mem_birthday = STR_TO_DATE('$mem_birthday_display', '%d-%m-%Y'),
                        mem_address = '$mem_address',
                        mem_telephone = '$mem_telephone',
                        mem_namebusiness = '$mem_namebusiness'
                        WHERE mem_id = $mem_id ";
            $res1 = mysqli_query($conn,$upd);
            $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อย";
            header("location: logout.php");}
        else {
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            header("location: edit_data.php");
        }
?>
