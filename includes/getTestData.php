<?php 
    include("db.php");
    $test1 = $_GET['test1'];
    $test2 = $_GET['test2'];

    $test_details = "SELECT * FROM `test_antropometry` WHERE `test_id`='$test1' OR `test_id`='$test2'";
    $test_details_run = mysqli_query($con, $test_details);

    $data = array();
    
    while($record = mysqli_fetch_assoc($test_details_run)){
        $data[] = $record;
    }

    echo json_encode($data);



?>