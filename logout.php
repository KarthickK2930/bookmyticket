<?php
    include('config.php');
    session_start();
    unset($_SESSION['uid']);
    header("Location:index1.html");
?>