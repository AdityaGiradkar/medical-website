<?php 
    $db['user']     = "root";
    $db['password'] = "";
    $db['host']     = "localhost";
    $db['name']     = "medical-quiz";
    $con = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']);

    if($con){
        echo "connection sucess";
    }

?>