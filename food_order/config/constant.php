<?php

    //start session
    session_start();


    //Create constants to store non-repeating values
    define('SITEURL','http://localhost:8888/food_order/');  
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'food-order');


    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());  //Selecting Database


?>