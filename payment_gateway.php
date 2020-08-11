<?php
    include("includes/db.php"); 
    session_start();
    if(isset($_SESSION['user_id'])){
        $user = $_SESSION['user_id'];

        //search for any payment whose related quiz is not solved
        $incomplete_quiz = "SELECT * FROM `payments` WHERE `user_id`='$user' AND `related_submission`=0";
        $incomplete_quiz_run = mysqli_query($con, $incomplete_quiz);
        $incomplete_quiz_rows = mysqli_num_rows($incomplete_quiz_run);
        if($incomplete_quiz_rows == 0) {
            //if no payment has already done then patient has to do payment 
            if(isset($_POST['submit'])){
                $payment_id = rand(10000, 100000);
                $insert_payment = "INSERT INTO `payments`(`payment_id`,`user_id`, `amount`, `related_submission`) VALUES ('$payment_id','$user','1000',0)";
                $insert_payment_run = mysqli_query($con, $insert_payment);
                $_SESSION['payment_id'] = $payment_id;
                header('location:quiz.php');
            }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <title>payment Gateway</title>
</head>

<body>
    <h1>
        Payment Gateway here, to procced forword 
        <form method="post">
            <button class="btn btn-primary" name="submit" value="pay">Pay</button>
        </form>        
    </h1>
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
        }else {
            $incomplete_quiz_result = mysqli_fetch_assoc($incomplete_quiz_run);
            $_SESSION['payment_id'] = $incomplete_quiz_result['payment_id'];
            header('location:quiz.php');
        }
        
    }else{
        header('location:index.php');
    }
?>