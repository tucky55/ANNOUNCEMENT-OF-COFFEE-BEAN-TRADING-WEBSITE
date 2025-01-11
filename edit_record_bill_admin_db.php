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
    $bill_id = $_GET['bill_id']; // เพิ่มการรับค่า bill_id จาก URL
    $coffee_price = $_POST['coffee_price'];
    $coffee_unit = $_POST['coffee_unit'];
    $type_roast = $_POST['type_roast'];
    $harvest_period = $_POST['harvest_period'];
    $production_source = $_POST['production_source'];
    $coffee_shell = $_POST['coffee_shell'];

    if (isset($_SESSION['admin_login'])) {
        $upd = "UPDATE billboard 
                SET coffee_id = '$coffee_id', 
                quantity_id = '$quantity_id',
                bill_posttype = '$bill_posttype',
                bill_linkcontect = '$bill_linkcontect',
                bill_detail = '$bill_detail',
                bill_address = '$bill_address',
                bill_telephone = '$bill_telephone',
                service_id = '$service_id',
                coffee_price = '$coffee_price',
                coffee_unit = '$coffee_unit',
                type_roast = '$type_roast',
                harvest_period = '$harvest_period',
                production_source = '$production_source',
                coffee_shell = '$coffee_shell'
                WHERE bill_id = $bill_id"; // ใช้เงื่อนไข WHERE เพื่อระบุ bill_id เท่ากับค่าที่รับมา
        $res1 = mysqli_query($conn,$upd);
        $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อย";
        header("location:record_admin.php");
    } else {
        $_SESSION['error'] = "มีบางอย่างผิดพลาด";
        header("location: edit_data.php");
    }
}

?>
