<?php 
    include("../../includes/db.php");
    session_start();
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 'doctor'){
            if(isset($_GET['date'])){
                $date = $_GET['date'];

                
                $delete = "DELETE FROM `consultation_time` WHERE `date`='$date' AND `assigned_user`=0";
                if($delete_run = mysqli_query($con, $delete)){
                    echo "<script>
                        alert('All slots are deleted where user is not assigned');
                        window.location.href='../added_slot_dates.php';
                    </script>";
                }
            }else{          //else part if date is not mention
                echo "<script>
                    alert('insufficient data.');
                    window.location.href='../added_slot_dates.php';
                </script>";
            }
        } else{             // else part when user is not doctor
            echo "<script>
                    alert('Unautherized Access.')
                    window.location.href='../../index.php';
                </script>";
        }
    }else{              //else part if user is not login
        echo "<script>
            window.location.href='../../error/login_error.html';
        </script>";
    }
 
?>