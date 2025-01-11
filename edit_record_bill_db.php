<?php

session_start();
require_once 'config/db.php';
if (isset($_POST["submit"])) {
        $coffee_id = $_POST['coffee_id'];
        $quantity_id = $_POST['quantity_id'];
        $bill_posttype = $_POST['bill_posttype'];
        $bill_linkcontect = $_POST['bill_linkcontect'];
        $bill_detail = $_POST['bill_detail'];
        $bill_address = $_POST['bill_address'];
        $bill_telephone = $_POST['bill_telephone'];
        $service_id = $_POST['service_id'];
        $bill_status = '2';
    }

        if (isset($_SESSION['user_login'])) {
            $mem_id = $_SESSION['user_login'];
            $log = "SELECT * FROM member WHERE mem_id = $mem_id";
            $res = mysqli_query($conn,$log);
            $row = mysqli_fetch_assoc($res);
            $upd = "UPDATE billboard 
                    SET coffee_id = '$coffee_id', 
                    quantity_id = '$quantity_id',
                    bill_posttype = '$bill_posttype',
                    bill_linkcontect = '$bill_linkcontect',
                    bill_detail = '$bill_detail',
                    bill_address = '$bill_address',
                    bill_telephone = '$bill_telephone',
                    service_id = '$service_id'
                        WHERE mem_id = $mem_id ";
            $res1 = mysqli_query($conn,$upd);
            $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อย";
            header("location:record.php");}
        else {
            $_SESSION['error'] = "มีบางอย่างผิดพลาด";
            header("location: edit_data.php");
        }
?>
