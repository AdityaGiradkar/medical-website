
<?php 
    include("../../includes/db.php");
    session_start();
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 'doctor'){
            if(isset($_GET['date']) && isset($_GET['time'])){
                $date = $_GET['date'];
                $time = $_GET['time'];
                

                $delete = "DELETE FROM `consultation_time` WHERE `date`='$date' AND `time_range`='$time'";
                if($delete_run = mysqli_query($con, $delete)){
                    echo "<script>
                    window.location.href='../available_slots.php?date=$date';
                    </script>";
                }

            }else{          //else part if date or time is not mention
                echo "<script>
                    alert('insufficient data.');
                    window.location.href='../available_slots.php?date=$date';
                </script>";
            }
        } else{             // else part when user is not doctor
            echo "<script>
                    alert('Unautherized Access.')
                    window.location.href='../../index.php';
                </script>";
        }

    }else{             //else part if user is not login
        echo "<script>
            window.location.href='../../error/login_error.html';
        </script>";
    }
 
?>