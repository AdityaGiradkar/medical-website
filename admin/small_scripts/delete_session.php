
<?php 
    include("../../includes/db.php");
    $id = $_GET['id'];
    

    $delete = "DELETE FROM `sessions` WHERE `session_id`='$id'";
    if($delete_run = mysqli_query($con, $delete)){
        echo "<script>
        window.location.href='../all_sessions.php';
        </script>";
    }
 
?>