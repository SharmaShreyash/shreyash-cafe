<?php

    // include constant.php for SITEURL
    include('../config/constants.php');

    //destroy the sessiom
    session_destroy(); // unset $_SESSION ['user']

    // redirect to loginpage
    header('location:' .SITEURL.'admin/login.php');
?>