<?php  
include("includes/db.php");
$user = 2;
$pre_submissions = "SELECT max(`no_of_submission`) FROM `user-answer` WHERE `user_id` = '$user'";
$pre_submissions_run = mysqli_query($con, $pre_submissions);
$run = mysqli_fetch_assoc($pre_submissions_run);
print_r($run['max(`no_of_submission`)']);
// $pre_submissions_res = mysqli_fetch_assoc($pre_submissions_run);
// $no_prv_submission = $pre_submissions_res['no_of_submission'];


?>