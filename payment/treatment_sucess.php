<?php
    session_start();
    $user_id = $_SESSION['user_id'];

    require_once "../includes/db.php";
    //echo '<pre>'; print_r($_POST);

    if($_POST['razorpay_payment_id']){

        $payment_id = $_POST['razorpay_payment_id'];
        $order_id = $_POST['razorpay_order_id'];
        $signiture = $_POST['razorpay_signature'];

        $treat_id = $_GET['treat_id'];
        $treatment_no = $_GET['treat_no'];
        $sub_treat_no = $_GET['sub_treat_no'];
        $charges = (int)$_GET['charge']/100;

        date_default_timezone_set('Asia/Kolkata');
        $date_time_store = date('Y-m-d H:i:s');
        
        $insert_entry = "INSERT INTO `treatment_payment`(`payment_id`, `order_id`, `signiture_hash`, `user_id`, `treat_no`, `sub_treat_no`, `charges`, `created_at`) 
                        VALUES ('$payment_id','$order_id','$signiture','$user_id','$treatment_no','$sub_treat_no','$charges', '$date_time_store')";


        // // fetch bill number
        // $last_bill_no = "SELECT max(`bill_number`) AS lastest FROM `bill_number`";
        // $last_bill_no_run = mysqli_query($con, $last_bill_no);
        // $last_bill_no_res = mysqli_fetch_assoc($last_bill_no_run);
        // $lastest_bill = $last_bill_no_res['lastest'];

        // $this_bill_no = $lastest_bill + 1;
        // $insert_bill_no = "INSERT INTO `bill_number`(`bill_number`) VALUES ('$this_bill_no')";
        // $insert_bill_no_run = mysqli_query($con, $insert_bill_no);

        $update_payment_status = "UPDATE `treatment` SET `fees_status`='paid',`fees`='$charges' WHERE `treat_id`= '$treat_id' AND `user_id`='$user_id'";

        if($con->query($insert_entry) === TRUE && $con->query($update_payment_status) === TRUE){
            echo "<script>
                alert('Your payment for Treatment is sucessfull now you can download recipt fron ongoing treatment.');
                window.location.href='../ongoing_treatments.php';
            </script>";
            
        }else{
            echo "Error: " . $insert_entry . "<br>" . $con->error;
        }
            
        $con->close();
        die;
    }else{
        echo "<script>
                window.location.href='../ongoing_treatments.php';
            </script>";
    }
?>