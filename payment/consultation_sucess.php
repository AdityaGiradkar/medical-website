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

    date_default_timezone_set('Asia/Kolkata');
    $date_time_store = date('Y-m-d H:i:s');

    // fetch bill number
    $last_bill_no = "SELECT max(`bill_number`) AS lastest FROM `bill_number`";
    $last_bill_no_run = mysqli_query($con, $last_bill_no);
    $last_bill_no_res = mysqli_fetch_assoc($last_bill_no_run);
    $lastest_bill = $last_bill_no_res['lastest'];

    $this_bill_no = $lastest_bill + 1;
    $insert_bill_no = "INSERT INTO `bill_number`(`bill_number`, `date`) VALUES ('$this_bill_no', '$date_time_store')";
    $insert_bill_no_run = mysqli_query($con, $insert_bill_no);


    $update_assigned_user = "UPDATE `consultation_time` SET `assigned_user`='$user_id',`consult_type`='$consult_name',`date_submission`='$date_time_store',`consult_fees`='$price',`status`='assigned',`bill_number`='$this_bill_no' WHERE `date`='$date' AND `time_range`='$time'";
    if($con->query($update_assigned_user) === TRUE){
        $insert_entry = "INSERT INTO `consultation_payments`(`user_id`, `payment_id`, `order_id`, `signiture_hash`, `consult_type`, `charges`, `created_at`) 
                        VALUES ('$user_id','$payment_id','$order_id','$signiture','$consult_type','$price', '$date_time_store')";
        
        if($con->query($insert_entry) === TRUE){
            echo "<script>
                alert('Your appointment is booked you can see it in your treatment section in profile.');
                window.location.href='../index.php';
            </script>";
        }else{
            echo "Error: " . $insert_entry . "<br>" . $con->error;
        }
        
    }

    $con->close();
    die;
?>