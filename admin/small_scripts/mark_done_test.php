<?php 
    session_start();
    include("../../includes/db.php");
    $pay_id = $_GET['pay_no'];

    $find_record = "SELECT `status` FROM `test_payments` WHERE `pay_id`='$pay_id'";
    $find_record_run = mysqli_query($con, $find_record);
    $find_record_row = mysqli_fetch_assoc($find_record_run);

    if($find_record_row > 0){
        $checked = "UPDATE `test_payments` SET `status`='checked' WHERE `pay_id`='$pay_id'";
        if($checked_run = mysqli_query($con, $checked)){
            echo "<script> 
                    alert('User test is over.');
                    window.location.href='../test_submissions.php';
                </script>";
        }
    } else {
        echo "<script> 
                    alert('Invalid data.');
                    window.location.href='../index.php';
                </script>";
    }

?>