
<?php 
    include("../includes/db.php");
    $date = $_GET['date'];
    $time = $_GET['time'];
    

    $delete = "DELETE FROM `consultation_time` WHERE `date`='$date' AND `time_range`='$time'";
    if($delete_run = mysqli_query($con, $delete)){
        echo "<script>
        window.location.href='available_slots.php';
        </script>";
    }
 
?>