<?php 
    include("../../includes/db.php");
    $image_id = $_GET['id'];
    

    $delete = "DELETE FROM `images` WHERE `image_id`='$image_id'";
    if($delete_run = mysqli_query($con, $delete)){
        echo "<script>
        window.location.href='../all_images.php';
        </script>";
    }
 
?>