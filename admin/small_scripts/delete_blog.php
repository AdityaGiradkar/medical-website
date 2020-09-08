
<?php 
    include("../includes/db.php");
    $id = $_GET['id'];
    

    $delete = "DELETE FROM `blogs` WHERE `blog_id`='$id'";
    if($delete_run = mysqli_query($con, $delete)){
        echo "<script>
        window.location.href='blogs_table.php';
        </script>";
    }
 
?>