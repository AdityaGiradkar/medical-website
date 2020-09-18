
<?php 
    include("../../includes/db.php");
    $id = $_GET['id'];
    

    $delete = "DELETE FROM `questions` WHERE `question_id`='$id'";
    if($delete_run = mysqli_query($con, $delete)){
        echo "<script>
        window.location.href='../all_questions.php';
        </script>";
    }
 
?>

