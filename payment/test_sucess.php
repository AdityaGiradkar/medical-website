<?php
    session_start();
    $user_id = $_SESSION['user_id'];

    require_once "../includes/db.php";
    //echo '<pre>'; print_r($_POST);

    $payment_id = $_POST['razorpay_payment_id'];
    $order_id = $_POST['razorpay_order_id'];
    $signiture = $_POST['razorpay_signature'];


    $test_type = $_GET['type'];

    $payment_amount = "SELECT * FROM `test_type` WHERE `test_id`='$test_type'";
    $payment_amount_run = mysqli_query($con, $payment_amount);
    $payment_amount_res = mysqli_fetch_assoc($payment_amount_run);
        
    $price = $payment_amount_res['price'];
    $test_name = $payment_amount_res['test_name'];

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

  
    $insert_entry = "INSERT INTO `test_payments`(`payment_id`, `order_id`, `signiture_hash`, `user_id`, `test_type`, `bill_no`, `charges`, `created_at`) 
                    VALUES ('$payment_id', '$order_id', '$signiture', '$user_id', '$test_type', '$this_bill_no', '$price', '$date_time_store')";

    
    if($con->query($insert_entry) === TRUE){
        echo "<script>
            //alert('Your payment for test is sucessfull now you can see Test Receipt in All test Section in user panel.');
            //window.location.href='../all_test.php';
        </script>";

        if($test_type == 3){
            echo "<script>window.location.href='../YogE_CritiCare.php?orderId=$order_id'</script>";
        }else if($test_type == 2){
            echo "<script>window.location.href='../YogE_HomeCare.php?orderId=$order_id'</script>";
        }else if($test_type == 1 || $test_type == 5){
            echo "<script>window.location.href='../YogE_rakshakavach.php?orderId=$order_id'</script>";
        }else if($test_type == 4){
            echo "<script>window.location.href='../YogE_Antropometry.php?orderId=$order_id'</script>";
        }else{
            echo "<script>window.location.href='../all_test.php'</script>";
        }

    }else{
        echo "Error: " . $insert_entry . "<br>" . $con->error;
    }
        
    $con->close();
    die;
?>