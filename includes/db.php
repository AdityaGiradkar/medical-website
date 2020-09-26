<?php 
    $db['user']     = "sadanand";
    $db['password'] = "Sadanand@123";
    $db['host']     = "localhost";
    $db['name']     = "medical_data";
    $con = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

?>