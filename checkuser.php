<?php

session_start();
require_once 'config/db.php';

if (isset($_POST['login'])) {
    $mem_username = $_POST['mem_username'];
    $mem_password = $_POST['mem_password'];

    if (empty($mem_username)) {
        $_SESSION['error'] = 'กรุณากรอก username';
        header("location: login.php");
    } elseif (empty($mem_password)) {
        $_SESSION['error'] = 'กรุณากรอก password';
        header("location: login.php");
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM member WHERE mem_username  = ?");
            $check_data->bind_param("s", $mem_username);
            $check_data->execute();

            $result = $check_data->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if ($mem_username == $row['mem_username']) {
                    if (password_verify($mem_password, $row['mem_password'])) {
                        if ($row['mem_type'] == 'admin') {
                            $_SESSION['admin_login'] = $row['mem_id'];
                            header('location:show_billboard_admin.php');
                        } elseif ($row['mem_type'] == 'user') {
                            $_SESSION['user_login'] = $row['mem_id'];
                            header('location: show_billboard.php');
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสผ่านผิด';
                        header('location: login.php');
                    }
                } else {
                    $_SESSION['error'] = 'username ผิด';
                    header('location: login.php');
                }

            } else {
                $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                header("location: login.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            $check_data->close();
        }
    }
}

?>