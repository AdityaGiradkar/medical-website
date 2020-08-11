<?php 
    include("includes/db.php");
    session_start();
    if(isset($_SESSION['user_id'])){
        $user = $_SESSION['user_id'];
        $status = $_GET['status'];
        $past_submissions = "SELECT * FROM `user-answer` WHERE `user_id` = '$user' AND `status` = '$status'";
        $past_submissions_run = mysqli_query($con, $past_submissions);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <title>login</title>
</head>

<body>
    <ul class="list-group">
        <?php
            while($past_submissions_result = mysqli_fetch_assoc($past_submissions_run)) {
        ?>
            <li class="list-group-item"><a href="treat_details.php?submission_id=<?php echo $past_submissions_result['submission_id'] ?>"><?php echo $past_submissions_result['time'] ?></a></li>
        <?php
            }
        ?>
    </ul>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
    }else{
        header('location:index.php');
    }
?>