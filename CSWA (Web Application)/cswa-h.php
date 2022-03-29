<!-- Author: Victor Davidescu | SID: 1705734 -->
<!-- The style of the page was done using Bootstrap toolkit
	Link to Bootstrap: https://getbootstrap.com/ -->
<!DOCTYPE html>
<html lang="en">

    <?php 
        include('scripts/session.php');
        include("scripts/pathToPages.php");
    ?>
    

    <head>
        <title>CSWA - Welcome page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/cover.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">


            <!-- Header / Navigation bar -->
            <header class="p-3 text-white" style="background-color:#071d49;">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                            <img style="width:80px; height:80px;" src="img/aru_logo.png" alt="ARU Logo">
                        </a>
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            <li><a href="<?php echo HOME_PAGE;?>" class="nav-link px-2 text-white">Home</a></li>
                            <?php if($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) : ?>
                                <li><a href="<?php echo STAFF_PAGE;?>" class="nav-link px-2 text-white">Staff</a></li>
                            <?php endif; ?>
                            <?php if($_SESSION['role_id'] == 1) : ?>
                                <li><a href="<?php echo ADMIN_PAGE;?>" class="nav-link px-2 text-white">Admin Panel</a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="text-end">
                            <a style="margin:15px"><?php echo $login_session;?></a>
                            <button type="button" class="btn btn-warning" onclick="location.href='scripts/logoutProcess.php'; return false;">Logout</button>
                        </div>
                    </div>
                </div>
            </header>


            <!-- Page content -->
            <div class="container" style="height: 100%;">
                <main class="px-3">
                    <h1 class="h1">Home page</h1>
                    <h3>This home page is intended to be accessed by everyone.</h3>
                </main>
            </div>


            <!-- Footer displaying author -->
            <footer class="bg-light text-center text-lg-start">
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                    Case Study Web Application (CSWA) - Author: SID1705734
                </div>
            </footer>


        </div>
        <script src="js/bootstrap.js"></script>
    </body>
</html>