<?php 
    include("../../includes/db.php");
    $id = mysqli_real_escape_string($con, $_GET['id']);
    

    $delete = "DELETE FROM `review` WHERE `review_id`='$id'";
    if($delete_run = mysqli_query($con, $delete)){
        echo "<script>
        window.location.href='../all_reviews.php';
        </script>";
    }
 
?>