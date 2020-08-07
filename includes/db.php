<?php 
    $db['user']     = "root";
    $db['password'] = "";
    $db['host']     = "localhost";
    $db['name']     = "medical-quiz";
    $con = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

?>