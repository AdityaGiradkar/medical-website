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
    
    $insert_entry = "INSERT INTO `test_payments`(`payment_id`, `order_id`, `signiture_hash`, `user_id`, `test_type`, `charges`) 
                    VALUES ('$payment_id', '$order_id', '$signiture', '$user_id', '$test_type', '$price')";

    
    if($con->query($insert_entry) === TRUE){
        echo "<script>
            alert('Your payment for test is sucessfull now you can give Test.');
        </script>";
        if($test_type == 1){
            echo "<script>window.location.href='../Yodha_test.php'</script>";
        }else if($test_type == 2){
            echo "<script>window.location.href='../YogE_HOME.php?orderId=$order_id'</script>";
        }else if($test_type == 3){
            echo "<script>window.location.href='#'</script>";
        }
    }else{
        echo "Error: " . $insert_entry . "<br>" . $con->error;
    }
        
    $con->close();
    die;
?>