<?php session_start();
    if (isset($_SESSION['user_login'])) {
        header("Location: show_billboard.php"); // redirects them to homepage
        exit; // for good measure
    }else if (isset($_SESSION['admin_login'])){ 
        header("Location: admin/index.php"); // redirects them to homepage
        exit; // for good measure
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php  include 'menu_general.php'?>
    <div class="container">
        <div class="col-md-5">
        <h3 class="mt-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เข้าสู่ระบบ</h3>
        <hr>
        <form action="checkuser.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-dang" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </div>
            <?php } ?>
            <div class="mb-3">
                <label for="mem_username" class="form-label">username</label>
                <input type="text" class="form-control" name="mem_username" aria-describedby="mem_username">
            </div>
            <div class="mb-3">
                <label for="mem_password" class="form-label">password</label>
                <input type="password" class="form-control" name="mem_password" aria-describedby="mem_password">
            <br>
        <button type="submit" name = "login" class="btn btn-secondary">login</button><br><br>
        <a href='register.php'> สมัครสมาชิก </a>
        </form>
    </div>
    </div>
    
</body>
</html>

<style>
  .col-md-5{
    position: relative;
    margin-left: 190px;
    margin-top: -250px;
  }
</style>
