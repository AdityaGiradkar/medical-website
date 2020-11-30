<?php 
    session_start();
    include("../../includes/db.php");

    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 'doctor'){
            if(isset($_GET['user_id'])){

                $user_id = $_GET['user_id'];
                $update_validation = "UPDATE `user` SET `valid`='1' WHERE `user_id`='$user_id'";
                if($update_validation_run = mysqli_query($con, $update_validation)){
                    echo "<script>
                            window.location.href='../users.php';
                        </script>";
                }

            }else{
                echo "<script>
                    alert('Insufficient Data');
                    window.location.href='../users.php';
                </script>";
            }
        }else{
            echo "<script>
                    alert('Invalid Access');
                    window.location.href='../../index.php';
                </script>";
        }
    }else{
        echo "<script>
                window.location.href='../../error/login_error.html';
            </script>";
    }

?>