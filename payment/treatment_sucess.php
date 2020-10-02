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
        
        $insert_entry = "INSERT INTO `treatment_payment`(`payment_id`, `order_id`, `signiture_hash`, `user_id`, `treat_no`, `sub_treat_no`, `charges`) 
                        VALUES ('$payment_id','$order_id','$signiture','$user_id','$treatment_no','$sub_treat_no','$charges')";


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