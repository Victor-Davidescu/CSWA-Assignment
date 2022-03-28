<!-- Author: Victor Davidescu | SID: 1705734 -->

<?php
    // Constants
    define("DB_SERVER", "localhost:3306");
    define("DB_USERNAME", "root");
    define("DB_PASS", "");
    define("DB_DATABASE", "cswa");

    // Connect to the database
    // Self note: For constants don't use '$' !
    $database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASS, DB_DATABASE);
?>
