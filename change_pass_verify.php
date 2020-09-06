<?php 
    if(isset($_GET['vkey'])){
        include("includes/db.php");
        $vkey = mysqli_real_escape_string($con, $_GET['vkey']);
        $fetch_user = "SELECT * FROM `user` WHERE `vkey`='$vkey' LIMIT 1";
        $fetch_user_run = mysqli_query($con, $fetch_user);
        $fetch_user_row = mysqli_num_rows($fetch_user_run);
        if($fetch_user_row>0){
            $fetch_user_res = mysqli_fetch_assoc($fetch_user_run);
            $user_id = $fetch_user_res['user_id'];
            
            if(isset($_POST['reset'])){
                $pass = mysqli_real_escape_string($con, $_POST['pass']);
                $v_pass = mysqli_real_escape_string($con, $_POST['v_pass']);
                
                if($pass === $v_pass){
                    $update_pass = "UPDATE `user` SET `password`='$pass',`vkey`='0' WHERE `user_id`='$user_id'";
                    if($update_pass_run = mysqli_query($con, $update_pass)){
                        echo "<script> 
                            alert('Password Updated sucessfully.');
                            window.location.href='index.php';
                        </script>";
                    }
                }else{
                    echo "<script> 
                        alert('Password dosen\'t match.');
                    </script>";
                }
            }

          
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom External StyleSheet -->
    <link rel="stylesheet" href="css/login.css">

    <title>Password Reset</title>
</head>

<body>

    <div class="overlay">
        <div class="card centered" style="width: 25rem;">
            <div class="card-body">
                <img src="images/AtmaVeda Logo.png" class="mx-auto d-block" alt="AtmaVeda Logo" />
                <p class="card-title mx-auto brand-name">AtmaVeda Yog</p>
                <form method="post" action="">
                    <div class="form-group mt-5 mb-4">
                        <!-- <label for="exampleInputEmail1">Username</label> -->
                        <input type="password" class="form-control input-box" placeholder="Enter New Password" name="pass"
                            id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputPassword1">Password</label> -->
                        <input type="password" class="form-control input-box" placeholder="Re-Enter New Password" name="v_pass"
                            id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="login-btn mt-5" name="reset" style="color:white">RESET PASSWORD</button>
                </form>
            </div>
        </div>
    </div>


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
            echo "<script> 
                alert('This account is Invalid or link already used.');
                window.location.href='index.php';
            </script>";
        }
    }else{
        echo "<script> 
                alert('Invalid Refrence link.');
                window.location.href='index.php';
        </script>";
    }

?>
