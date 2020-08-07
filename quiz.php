<?php include("includes/db.php"); ?>
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
                $qry = "SELECT * FROM `questions`";
                $run = mysqli_query($con, $qry);
                $rows=mysqli_num_rows($run);
                if($rows > 0) {
                    $count = 1;
                    while($record=mysqli_fetch_assoc($run)) {
            ?>
                        <div>
                            <h4><?php echo $count." ".$record['question']; ?></h4>
                            <div class="container">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_1_q_".$count; ?>" value="<?php echo "op_".$count; ?>">
                                    <label class="form-check-label" for="<?php echo "ans_1_q_".$count; ?>">
                                        <?php echo $record['op_1']; ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_2_q_".$count; ?>" value="<?php echo "op_".$count; ?>">
                                    <label class="form-check-label" for="<?php echo "ans_2_q_".$count; ?>">
                                        <?php echo $record['op_2']; ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_3_q_".$count; ?>" value="<?php echo "op_".$count; ?>">
                                    <label class="form-check-label" for="<?php echo "ans_3_q_".$count; ?>">
                                        <?php echo $record['op_3']; ?>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?php echo "q_".$count; ?>" id="<?php echo "ans_4_q_".$count; ?>" value="<?php echo "op_".$count; ?>">
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
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </form>
        <?php 
        if(isset($_POST['submit'])){
            
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