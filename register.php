<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        include("includes/db.php"); 
        if(isset($_POST['submit'])){
            //sanitize data
            $initials = mysqli_real_escape_string($con, $_POST['initials']);
            $name   = mysqli_real_escape_string($con, $_POST['name']);
            $u_name = mysqli_real_escape_string($con, $_POST['u_name']);
            $email  = mysqli_real_escape_string($con,$_POST['email']);
            // $phone  = mysqli_real_escape_string($con,$_POST['phone']);
            $pass   = mysqli_real_escape_string($con,$_POST['pass']);

            //combining initials with name
            $name = $initials. " " .$name;

            $check_user = "SELECT * FROM `user` WHERE `user_name`='$u_name'";
            $check_user_run = mysqli_query($con, $check_user);
            $check_user_res = mysqli_num_rows($check_user_run);

            if($check_user_res == 0){
                $vkey = md5(time().$name);
                
                $insert = "INSERT INTO `user`(`name`, `user_name`, `email_id`, `password`, `vkey`) 
                            VALUES ('$name', '$u_name', '$email', '$pass', '$vkey')";
                $insert_run = mysqli_query($con, $insert);

                if($insert_run){
                    $get_user_id = "SELECT `user_id` FROM `user` WHERE `user_name`='$u_name'";
                    $get_user_id_run = mysqli_query($con, $get_user_id);
                    $get_user_id_res = mysqli_fetch_assoc($get_user_id_run);
                    $user_id = $get_user_id_res['user_id'];
                    $medical_history = "INSERT INTO `medical_history`(`user_id`) VALUES ('$user_id')";
                    mysqli_query($con, $medical_history);

                    //send mail
                    ini_set('display_errors', 1);
                    error_reporting( E_ALL );
                    $to = $email;
                    $from = 'drsadanand@atmavedayog.com';
                    $subject ="Registration Verification";
                    $message = "To verify your account please click on below link <br> <a href='http://atmavedayog.com/verify.php?vkey=$vkey'>click here</a>";
                    $headers = "From:drsadanand@atmavedayog.com \r\n";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                    $sucess = mail($to, $subject, $message, $headers);
                        
                    header('location:verification_sent.html');
                }
            }else{
                echo "<script>
                    alert('user already exist with user name $u_name');
                    //window.location.href='register.php'; 
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
    <link rel="stylesheet" href="css/register.css">

    <title>register</title>
</head>

<body>

    <div class="overlay">
        <div class="card centered" style="width: 25rem;">
            <div class="card-body">
                <img src="images/AtmaVeda Logo.png" class="mx-auto d-block" width="100" alt="AtmaVeda Logo" />
                <p class="card-title mx-auto brand-name">AtmaVeda Yog</p>
                <form method="post" action="">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="btn btn-outline-secondary" name="initials" required>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Mast.">Mast.</option>
                            </select>
                            <!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">select</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Mr.</a>
                                <a class="dropdown-item" href="#">Mrs.</a>
                                <a class="dropdown-item" href="#">Miss.</a>
                                <a class="dropdown-item" href="#">Mast.</a>
                            </div> -->
                        </div>
                        <input type="text" class="form-control input-box" placeholder="Enter Full Name"  value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" name="name" required>
                    </div>
                    <!-- <div class="form-group mt-5">
                     
                        <input type="text" class="form-control input-box" placeholder="Full Name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" name="name"
                            id="exampleInputEmail1" required>
                    </div> -->
                    <div class="form-group">
                        <!-- <label for="exampleInputEmail1">Username</label> -->
                        <input type="text" class="form-control input-box" placeholder="User Name" name="u_name"
                            id="exampleInputEmail1" required>
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputEmail1">Username</label> -->
                        <input type="email" class="form-control input-box" placeholder="Email ID" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" name="email"
                            id="exampleInputEmail1" required>
                    </div>
                    <!-- <div class="form-group">
                    
                        <input type="text" class="form-control input-box" placeholder="Phone Number" name="phone"
                            id="exampleInputPassword1">
                    </div> -->
                    <div class="form-group">
                        <!-- <label for="exampleInputPassword1">Password</label> -->
                        <input type="password" class="form-control input-box" placeholder="Create Password" name="pass"
                            id="exampleInputPassword1" minlength="8" required>
                    </div>
                    <button type="submit" class="login-btn mt-4 " style="color:white; " name="submit">REGISTER</button>
                </form>
                <small class="form-text text-center mt-3"><em>Already Registered ?</em> <a
                        href="login.php">Login</a></small>
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
                    window.location.href='index.php';
                </script>";
    }
?>