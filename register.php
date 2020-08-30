<?php 
    include("includes/db.php"); 
    if(isset($_POST['submit'])){
        //sanitize data
        $name   = mysqli_real_escape_string($con, $_POST['name']);
        $email  = mysqli_real_escape_string($con,$_POST['email']);
        $phone  = mysqli_real_escape_string($con,$_POST['phone']);
        $pass   = mysqli_real_escape_string($con,$_POST['pass']);

        $vkey = md5(time().$name);
        
        $insert = "INSERT INTO `user`(`name`, `contact_no`, `email_id`, `password`, `vkey`) 
                    VALUES ('$name', '$phone', '$email', '$pass', '$vkey')";
        $insert_run = mysqli_query($con, $insert);

        if($insert_run){
            //send mail
            // ini_set('display_errors', 1);
            // error_reporting( E_ALL );
            $to = $email;
            // $from = 'adityagiradkar11@gmail.com';
            $subject ="Registration Verification";
            $message = "To verify your account please click on below link <br> <a href='http://localhost/medical-website/verify.php?vkey=$vkey'>click here</a>";
            $headers = "From:adityagiradkar11@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            $sucess = mail($to, $subject, $message, $headers);
                
            header('location:verification_sent.html');
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
                    <div class="form-group mt-5">
                        <!-- <label for="exampleInputEmail1">Username</label> -->
                        <input type="text" class="form-control input-box" placeholder="Full Name" name="name"
                            id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputEmail1">Username</label> -->
                        <input type="email" class="form-control input-box" placeholder="Email ID" name="email"
                            id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputPassword1">Password</label> -->
                        <input type="text" class="form-control input-box" placeholder="Phone Number" name="phone"
                            id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputPassword1">Password</label> -->
                        <input type="password" class="form-control input-box" placeholder="Password" name="pass"
                            id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="login-btn mt-5 " name="submit">REGISTER</button>
                </form>
                <small class="form-text text-center mt-3"><em>Already Registered ?</em> <a
                        href="login.html">Login</a></small>
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