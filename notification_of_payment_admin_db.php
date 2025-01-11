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

        if (isset($_POST["submit1"])){
            $bank_id = $_POST['bank_id'];
            $payment_name = $_POST['payment_name'];
            $payment_amount = $_POST['payment_amount'];
            $payment_slip = $_POST['payment_slip'];
            $payment_slip_display = date('d-m-Y', strtotime($payment_slip . ' -543 year'));
            $payment_status ='2';
            $billboard_id = $_GET['bill_id'];

            $sql = "INSERT INTO payment(bank_id, payment_name, payment_amount, payment_slip,payment_status,payment_pic)
                   VALUES(?, ?, ?, STR_TO_DATE(?, '%d-%m-%Y'), ?, ?)";
            $stmt1 = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt1, "isssss",$bank_id, $payment_name, $payment_amount, $payment_slip_display, $payment_status, $new_image_name);
            $result1 = mysqli_stmt_execute($stmt1);

            if ($result1) {
                include 'checkuser.php';
                if (isset($_SESSION['user_login'])) {
                    $mem_id = $_SESSION['user_login'];
                    $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                    $res = mysqli_query($conn,$log);
                    $row = mysqli_fetch_assoc($res);

                    $sql = "UPDATE payment SET bill_id = ? WHERE bill_id = 0";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $billboard_id);
                    $result = mysqli_stmt_execute($stmt);
                }
                if (isset($_SESSION['admin_login'])) {
                    $mem_id = $_SESSION['admin_login'];
                    $log = "SELECT * FROM member WHERE mem_id = $mem_id";
                    $res = mysqli_query($conn,$log);
                    $row = mysqli_fetch_assoc($res);

                    $sql = "UPDATE payment SET bill_id = ? WHERE bill_id = 0";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $billboard_id);
                    $result = mysqli_stmt_execute($stmt);
                }

                echo 'รอสักครู่';
                echo "<script>alert('แจ้งสำเร็จ ');</script>";
                header( "refresh:1;url=show_billboard_admin.php" );
            } else {
                echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้:'); </script> ";
            }

            mysqli_stmt_close($stmt1);
        }
?>
