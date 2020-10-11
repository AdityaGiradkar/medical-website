<?php 
    include('includes/db.php');
    session_start();
    if(!isset($_SESSION['user_id'])) {
        if(isset($_POST['submit'])){
            $uname = mysqli_real_escape_string($con, $_POST['u_name']);

            $get_email = "SELECT `email_id` FROM `user` WHERE `user_name`='$uname'";
            $get_email_run = mysqli_query($con, $get_email);
            $get_email_res = mysqli_fetch_assoc($get_email_run);
            $email = $get_email_res['email_id'];
            $name = $_SESSION['name'];

            $vkey = md5(time().$name);

            $update = "UPDATE `user` SET `vkey`='$vkey' WHERE `user_name`='$uname'";
            if($update_run = mysqli_query($con, $update)){

                //send mail
                ini_set('display_errors', 1);
                error_reporting( E_ALL );
                $to = $email;
                $from = 'drsadanand@atmavedayog.com';
                $subject ="Request to Password change.";
                $message = "To change password of account $name, please click to below link <br> <a href='http://atmavedayog.com/change_pass_verify.php?vkey=$vkey'>click here</a>";
                $headers = "From:drsadanand@atmavedayog.com \r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
                $sucess = mail($to, $subject, $message, $headers);
                    
                if($sucess){
                    header('location:verification_sent.html');
                }else{
                    echo "<script>alert('something went wrong'); </script>";
                }
            }
            
        }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AtmaVeda Yog pvt.ltd is a new startup company dedicated and formed on the principles of yoga. It's founder is Dr Sadanand Shivram Rasal . It's partners are Mrs Shital Narendra dhole.">
    <meta name="author" content="Dr Sadanand">
    <meta name="keywords" content="Hospital, atmaveda, AtmaVeda, AtmaVedaYog, atmavedayog, dr sadanand, login">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom External StyleSheet -->
    <link rel="stylesheet" href="css/login.css">

    <title>Forget Password</title>
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
                        <input type="text" class="form-control input-box" placeholder="Enter User Name" name="u_name"
                            id="exampleInputEmail1">
                    </div>
                    
                    <button type="submit" class="login-btn mt-5" name="submit">Send Recovery Link</button>
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
        header('location:index.php');
    }
?>