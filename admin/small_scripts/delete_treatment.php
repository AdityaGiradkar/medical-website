<?php 
    session_start();
    include("../../includes/db.php");

    if(isset($_SESSION['user_id'])){
        if(isset($_GET['treat_id'])){
            $treat_id = mysqli_real_escape_string($con, $_GET['treat_id']);

            $fetch_treatment = "SELECT * FROM `treatment` WHERE `treat_id`='$treat_id'";
            $fetch_treatment_run = mysqli_query($con, $fetch_treatment);
            $fetch_treatment_num_rows = mysqli_num_rows($fetch_treatment_run);

            $fetch_treatment_res = mysqli_fetch_assoc($fetch_treatment_run);
            $fees_status = $fetch_treatment_res['fees_status'];

            if($fetch_treatment_num_rows > 0 && $fees_status == 'pending'){
                
                $user_id =  $fetch_treatment_res['user_id'];
                $treat_no = $fetch_treatment_res['treat_number'];
                $sub_treat_no = $fetch_treatment_res['sub_treat_number'];
                $bill_no = $fetch_treatment_res['bill_number'];

                $delete_treatment = "DELETE FROM `treatment` WHERE `treat_id`='$treat_id'";
                $delete_session = "DELETE FROM `prescribed_session` WHERE `user_id`='$user_id' AND `treat_number`='$treat_no' AND `sub_treat_number`='$sub_treat_no'";
                $delete_medicine = "DELETE FROM `prescribed_medicine` WHERE `user_id`='$user_id' AND `treat_number`='$treat_no' AND `sub_treat_number`='$sub_treat_no'";
                $delete_bill = "DELETE FROM `bill_number` WHERE `bill_number`='$bill_no'";

               if(mysqli_query($con, $delete_treatment) && mysqli_query($con, $delete_session) && mysqli_query($con, $delete_medicine) && mysqli_query($con, $delete_bill)){
                    echo "<script>
                            alert('Treatment Deleted Sucessfully.');
                            window.close();
                        </script>";
               }

            } else {
                echo "<script>
                    alert('No Record Found.');
                    window.location.href='../users.php';
                </script>";
            }

        } else {
            echo "<script>
                    alert('Invalid Access.');
                    window.location.href='../index.php';
                </script>";
        }
    } else {
        echo "<script>
                window.location.href='../../error/login_error.html';
            </script>";
    }


?>