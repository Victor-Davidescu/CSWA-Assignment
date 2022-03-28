<!-- Author: Victor Davidescu | SID: 1705734 -->
<?php
   include("pathToPages.php");

   //Close the session
   session_start();
   if(session_destroy()) { header("location:../".LOGIN_PAGE); }
?>