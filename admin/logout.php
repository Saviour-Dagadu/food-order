<?php
    //Include constants.php for SITEURL
    include('../config/constants.php');
    //1. Destroy the session
    session_destroy(); //unset $_SESSION['user']

    //2. Redirect to login Page
    header('location:'.SITEURL.'admin/login.php');

?>