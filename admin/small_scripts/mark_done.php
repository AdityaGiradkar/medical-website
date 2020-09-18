<?php 
    session_start();
    include("../../includes/db.php");
    $date = $_GET['date'];
    $time = $_GET['time'];

    $checked = "UPDATE `consultation_time` SET `status`='checked' WHERE `date`='$date' AND `time_range`='$time'";
    if($checked_run = mysqli_query($con, $checked)){
        echo "<script> 
                alert('User consultation is over.');
                window.location.href='../new_patient.php';
            </script>";
    }

?>