<?php

    //Start Session

    session_start();


    // create constant to store non repeating values 
    define('SITEURL','http://localhost/shreyash-cafe/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'shreyash-cafe');



        // Database connection
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        //Selecting Database
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());


?>