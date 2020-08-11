<?php 
    include("includes/db.php"); 
    session_start();
    if(isset($_SESSION['user_id'])){
        $user = $_SESSION['user_id'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div>
            <h1>Quick Test</h1>
        </div>
        <form method="POST" action="quiz.php">
            <?php 
            //fetch all the questions from database
                $qry = "SELECT * FROM `questions`";
                $run = mysqli_query($con, $qry);
                $rows=mysqli_num_rows($run);
                if($rows > 0) {
                    $count = 1;
                    //printing one one questions from the database
                    while($record=mysqli_fetch_assoc($run)) {
                        $question_id[$count] = $record['question_id'];
            ?>
                        <div>
                            <h4><?php echo $count." ".$record['question']; ?></h4>
                            <div class="container">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_1_q_".$count; ?>" value="op_1">
                                    <label class="form-check-label" for="<?php echo "ans_1_q_".$count; ?>">
                                        <?php echo $record['op_1']; ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_2_q_".$count; ?>" value="op_2">
                                    <label class="form-check-label" for="<?php echo "ans_2_q_".$count; ?>">
                                        <?php echo $record['op_2']; ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_3_q_".$count; ?>" value="op_3">
                                    <label class="form-check-label" for="<?php echo "ans_3_q_".$count; ?>">
                                        <?php echo $record['op_3']; ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_4_q_".$count; ?>" value="op_4">
                                    <label class="form-check-label" for="<?php echo "ans_4_q_".$count; ?>">
                                        <?php echo $record['op_4']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
            <?php 
                        $count = $count + 1;
                    }
                }
            ?>
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        </form>
        <?php 
        if(isset($_POST['submit'])){
            //next 3 lines is to find number of previous submissions by perticular user
            $pre_submissions = "SELECT max(`no_of_submission`) FROM `user-answer` WHERE `user_id` = '$user'";
            $pre_submissions_run = mysqli_query($con, $pre_submissions);
            $pre_submissions_res = mysqli_fetch_assoc($pre_submissions_run);
            $no_prv_submission = $pre_submissions_res['max(`no_of_submission`)'];
            
            //next 3 lines is for inserting new submission with increment in number of submission
            $no_prv_submission = $no_prv_submission + 1;
            $submission = "INSERT INTO `user-answer`(`user_id`, `no_of_submission`) VALUES ('$user', '$no_prv_submission')";
            $submission_run = mysqli_query($con, $submission);

            //next three lines is for find the lastest submission id so that while inserting ans submission id is their
            $submission_id = "SELECT `submission_id` FROM `user-answer` WHERE `no_of_submission` = '$no_prv_submission' AND `user_id` = '$user'";
            $submission_id_run = mysqli_query($con, $submission_id);
            $submission_id_res = mysqli_fetch_assoc($submission_id_run);
            $lastest_submission_id = $submission_id_res['submission_id'];

            $value = "";
            $i = 1;

            for($i = 1; $i < $count-1; $i++) {
                //$answer['q_'.$i] = $_POST['q_'.$i];
                $value = $value."(".$lastest_submission_id.", ".$question_id[$i].", '".$_POST['q_'.$i]."'), ";
            }
            $value = $value."(".$lastest_submission_id.", ".$question_id[$i].", '".$_POST['q_'.$i]."')";
            //print_r($value);
            $insert_ans = "INSERT INTO `answers`(`submission_id`, `question_id`, `answer`) VALUES ".$value;
            //print_r($insert_ans);
            $insert_ans_run = mysqli_query($con, $insert_ans);

            
        }
        
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</body>

</html>

<?php 
    } else {
        header('location: index.php');
    }
?>