<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include('includes/db.php');
        $user_id = $_SESSION['user_id'];
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $vkey = md5(time().$name);

        $update = "UPDATE `user` SET `vkey`='$vkey' WHERE `user_id`='$user_id'";
        if($update_run = mysqli_query($con, $update)){

            //send mail
            // ini_set('display_errors', 1);
            // error_reporting( E_ALL );
            $to = $email;
            // $from = 'adityagiradkar11@gmail.com';
            $subject ="Request to Password change.";
            $message = "To change password of account $name, please follow to below link <br> <a href='http://localhost/medical-website/change_pass_verify.php?vkey=$vkey'>click here</a>";
            $headers = "From:adityagiradkar11@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $sucess = mail($to, $subject, $message, $headers);
                
            if($sucess){
                header('location:verification_sent.html');
            }else{
                echo "<script>alert('something went wrong'); </script>";
            }
        }
    }else{
        echo "<script>window.location.href='error/login_error.html'; </script>";
    }


?>