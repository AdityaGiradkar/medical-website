<?php 
    include("includes/db.php");
    $date = $_GET['date'];

    $slots = "SELECT * FROM `consultation_time` WHERE `date`='$date' AND `assigned_user`=0";
    $slot_run = mysqli_query($con, $slots);

    $data = array();
    
    while($record = mysqli_fetch_assoc($slot_run)){
        $data[] = $record;
    }

    echo json_encode($data);



?>