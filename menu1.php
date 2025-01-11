<?php
 session_start();
 include 'db.php';
if (isset($_SESSION['admin_login'])) {
    $mem_id = $_SESSION['admin_login'];
    $log = "SELECT * FROM member WHERE mem_id = $mem_id";
    $res = mysqli_query($conn,$log);
    $row = mysqli_fetch_assoc($res);
}?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Administration</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../show_billboard_admin.php">ใช้งานในส่วนของสมาชิก</a></li>
                        <li><a class="dropdown-item" href="../logout1.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-success " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
    <a class="nav-link" href="report_billboard.php">
        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
        ประกาศที่รออนุมัติ
    </a>
</div>
<div class="nav">
    <a class="nav-link" href="report_inapproriate.php">
        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
        ประกาศที่ไม่เหมาะสม
    </a>
</div>
                    </div>
                    <div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    <?php echo !empty($row['mem_username']) ? $row['mem_username'] : ''; ?>
</div>
                </nav>
            </div>