<?php 
    session_start();
    include("../../includes/db.php");

    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 'doctor'){
            if(isset($_GET['file_id']) && isset($_GET['user_id'])){

                $file_id = $_GET['file_id'];
                $user_id = $_GET['user_id'];

                $delete_file = "DELETE FROM `extra_files` WHERE `file_id`='$file_id'";
                if($delete_file_run = mysqli_query($con, $delete_file)){
                    echo "<script>
                            window.location.href='../extra_files.php?uid=$user_id';
                        </script>";
                }

            }else{
                echo "<script>
                    alert('Insufficient Data');
                    window.location.href='../extra_files.php?uid=$user_id';
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