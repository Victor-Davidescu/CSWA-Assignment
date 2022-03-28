<!-- Author: Victor Davidescu | SID: 1705734 -->
<?php
    include('database.php');
    include("scripts/pathToPages.php");
    session_start();

    $userEmail = $_SESSION['email'];
    $sqlQuery = mysqli_query($database,"SELECT email FROM accounts WHERE email = '$userEmail'");
    $row = mysqli_fetch_array($sqlQuery, MYSQLI_ASSOC);
    $login_session = $row['email'];

    if(!isset($_SESSION['email'])) {
        header("location:".LOGIN_PAGE);
        die();
    }
?>