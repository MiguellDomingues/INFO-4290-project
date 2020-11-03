<?php

    // $host = "localhost";
    // $user = "root";
    // $pass = "";
    // $db = "db_grossary";
    
    $host = "localhost";
    $user = "user";
    $pass = "Database@123456";
    $db = "grocery";
    
    $conn = mysqli_connect($host, $user, $pass, $db) or die(json_encode(["status" => false, "data" => "database connect error"]));
