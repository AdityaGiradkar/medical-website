<?php
    session_start();
    $user_id = $_SESSION['user_id'];

    require_once "../includes/db.php";
    //echo '<pre>'; print_r($_POST);

    $payment_id = $_POST['razorpay_payment_id'];
    $order_id = $_POST['razorpay_order_id'];
    $signiture = $_POST['razorpay_signature'];


    $consult_type = $_GET['type'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    $payment_amount = "SELECT * FROM `consult_type` WHERE `id`='$consult_type'";
    $payment_amount_run = mysqli_query($con, $payment_amount);
    $payment_amount_res = mysqli_fetch_assoc($payment_amount_run);
        
    $price = $payment_amount_res['price'];
    $consult_name = $payment_amount_res['name'];
    $datetime = date('Y-m-d H:i:s');

    $update_assigned_user = "UPDATE `consultation_time` SET `assigned_user`='$user_id',`consult_type`='$consult_name',`date_submission`='$datetime',`consult_fees`='$price',`status`='assigned' WHERE `date`='$date' AND `time_range`='$time'";
    if($con->query($update_assigned_user) === TRUE){
        $insert_entry = "INSERT INTO `consultation_payments`(`user_id`, `payment_id`, `order_id`, `signiture_hash`, `consult_type`, `charges`) 
                        VALUES ('$user_id','$payment_id','$order_id','$signiture','$consult_type','$price')";
        
        if($con->query($insert_entry) === TRUE){
            echo "<script>
                alert('Your appointment is booked you can see it in your profile.');
                window.location.href='../index.php';
            </script>";
        }else{
            echo "Error: " . $insert_entry . "<br>" . $con->error;
        }
        
    }

    $con->close();
    die;
?>