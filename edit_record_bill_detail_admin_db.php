<?php

session_start();
require_once 'config/db.php';
if (isset($_POST["submit"])) {
        $quantity_id = $_POST['quantity_id'];
        $coffee_price = $_POST['coffee_price'];
        $coffee_unit = $_POST['coffee_unit'];
        $bill_id = $_GET['bill_id'];
    }

        if (isset($_SESSION['admin_login'])) {
            $mem_id = $_SESSION['admin_login'];
            $log = "SELECT * FROM member WHERE mem_id = $mem_id";
            $res = mysqli_query($conn,$log);
            $row = mysqli_fetch_assoc($res);
            $upd = "UPDATE billboard 
                    SET quantity_id = '$quantity_id',
                    coffee_price = '$coffee_price',
                    coffee_unit = '$coffee_unit'
                    WHERE bill_id = $bill_id";
            $res1 = mysqli_query($conn,$upd);
            $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อย";
            header("location:record_admin.php");}
        else {
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            header("location: edit_data.php");
        }
?>
