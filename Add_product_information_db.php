<?php 
    include 'config/db.php';

    // อัพโหลดรูปภาพ
    if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
        $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
        $image_upload_path = "./img/".$new_image_name;
        move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
        $new_image_name = "";
    }

    if (isset($_POST["submit"])){
        $coffee_id = $_POST['coffee_id'];
        $quantity_id = $_POST['quantity_id'];
        $bill_posttype = $_POST['bill_posttype'];
        $bill_linkcontect = $_POST['bill_linkcontect'];
        $bill_detail = $_POST['bill_detail'];
        $bill_address = $_POST['bill_address'];
        $bill_telephone = $_POST['bill_telephone'];
        $service_id = $_POST['service_id'];
        $bill_status = '2';
        $coffee_price = $_POST['coffee_price'];
        $coffee_unit = $_POST['coffee_unit'];
        $type_roast = $_POST['type_roast'];
        $harvest_period = $_POST['harvest_period'];
        $production_source = $_POST['production_source'];
        $coffee_shell = $_POST['coffee_shell'];
        
        // เพิ่มไปยังตาราง billboard
        $sql = "INSERT INTO billboard(coffee_id, quantity_id, bill_posttype, bill_linkcontect, bill_detail, bill_address, bill_telephone, service_id,bill_status,pic_name, 
                coffee_price, coffee_unit, type_roast, harvest_period, production_source, coffee_shell)
               VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,? ,?)";
        $stmt1 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt1, "iisssssissiissss", $coffee_id, $quantity_id, $bill_posttype, $bill_linkcontect, $bill_detail, $bill_address, $bill_telephone, $service_id, $bill_status,$new_image_name,
                                                            $coffee_price, $coffee_unit, $type_roast, $harvest_period, $production_source, $coffee_shell);
        $result1 = mysqli_stmt_execute($stmt1);
        $billboard_id = mysqli_insert_id($conn);  // ดึง ID ที่เพิ่งถูกสร้างขึ้น


        if ($result1) {
            include 'checkuser.php';
                if (isset($_SESSION['user_login'])) {
                    $mem_id = $_SESSION['user_login'];
                    $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                    $res = mysqli_query($conn,$log);
                    $row = mysqli_fetch_assoc($res);
                    $upd = "UPDATE billboard SET mem_id='$mem_id' WHERE mem_id=0";
                    $res1 = mysqli_query($conn,$upd);}
                if (isset($_SESSION['admin_login'])) {
                    $mem_id = $_SESSION['admin_login'];
                    $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                    $res = mysqli_query($conn,$log);
                    $row = mysqli_fetch_assoc($res);
                    $upd = "UPDATE billboard SET mem_id='$mem_id' WHERE mem_id=0";
                    $res1 = mysqli_query($conn,$upd);}
            echo 'รอสักครู่';
                echo "<script>alert('บันทึกสำเร็จ');</script>";
                header( "refresh:1;url=notification_of_payment.php?bill_id=$billboard_id" );
        } else {
            echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้:'); </script> ";
        }
        
        mysqli_stmt_close($stmt1);
    }
?>


