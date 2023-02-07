<?php
   

    session_start();

    unset($_SESSION['useremail'], $_SESSION['usertype'], $_SESSION['userId']);
    session_destroy();

    echo "<script>window.location.assign('login.php');</script>";
?>