<?php 
    session_start();
    require_once "../includes/db.php";
        require_once "razorpay-php/Razorpay.php";

        use Razorpay\Api\Api;

    if(isset($_SESSION['user_id'])){

        

        $keyId = "rzp_test_bj6y2rUzCCQsX4";
        $secretKey = "x9PYMbnUlJggKM6cmj7dBOyH";
        $api = new Api($keyId, $secretKey);


        $consult_type = $_GET['type'];
        $date = $_GET['date'];
        $time = $_GET['time'];

        $get_consult_price = "SELECT * FROM `consult_type` WHERE `id`='$consult_type'";
        $get_consult_price_run = mysqli_query($con, $get_consult_price);
        $get_consult_price_res = mysqli_fetch_assoc($get_consult_price_run);

        $CUSTOMER_NAME = $_SESSION['name'];
        $CUSTOMER_EMAIL = $_SESSION['email'];
        $CUSTOMER_MOBILE = $_SESSION['mobile'];
        $PAY_AMT = $get_consult_price_res['price'];
        $PAY_AMT = (int)$PAY_AMT * 100;
        
        
        $order = $api->order->create(array(
            'receipt' => rand(1000, 9999) . 'ORD',
            'amount' => $PAY_AMT,
            'payment_capture' => 1,
            'currency' => 'INR'
            )
          );


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom External StyleSheet -->
    <link rel="stylesheet" href="../css/login.css">

    <title>Consultation Payment</title>
</head>

<body>

    <div class="overlay">
        <div class="card centered" style="width: 25rem;">
            <div class="card-body">
                <img src="../images/AtmaVeda Logo.png" class="mx-auto d-block" alt="AtmaVeda Logo" />
                <p class="card-title mx-auto brand-name">AtmaVeda Yog</p>
                <!-- <form method="post" action="">
                    <div class="form-group mt-5 mb-4">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control input-box" placeholder="Username or Email" name="email"
                            id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control input-box" placeholder="Password" name="pass"
                            id="exampleInputPassword1">
                    </div>
                    <a href="#"><small class="form-text text-muted text-right"><em>Forget Password ?</em></small></a>
                    <button type="submit" class="login-btn mt-5" name="submit">LOGIN</button>
                </form> -->
                <form action="sucess.php?type=<?php echo $consult_type; ?>&date=<?php echo $date; ?>&time=<?php echo $time; ?>" method="POST">
                    <div class="form-group mt-5 mb-4">
                        <label for="exampleInputEmail1">Consultation Type</label>
                        <input type="text" class="form-control input-box" value="<?php echo $get_consult_price_res['name']; ?>" disabled>
                    </div>

                    <div class="form-group mt-5 mb-4">
                        <label for="exampleInputEmail1">Consultation Amount (Rs.)</label>
                        <input type="text" class="form-control input-box" value="<?php echo $get_consult_price_res['price']; ?>" disabled>
                    </div>

                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key=<?php echo $keyId ?> 
                        data-amount="<?php echo $order->amount; ?>" 
                        data-currency="INR"
                        data-order_id="<?php echo $order->id; ?>"
                        data-buttontext="Pay with Razorpay"
                        data-name="AtmaVeda Yog"
                        data-description="We live long..."
                        data-image="../images/AtmaVeda Logo.png"
                        data-prefill.name="<?php echo $CUSTOMER_NAME; ?>"
                        data-prefill.email="<?php echo $CUSTOMER_EMAIL; ?>"
                        data-prefill.contact="<?php echo $CUSTOMER_MOBILE; ?>"
                        data-theme.color="#F37254"
                    ></script>
                    <input type="hidden" class="login-btn mt-5" custom="Hidden Element" name="hidden">
                </form>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="../bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
} else {
    echo "<script>
        alert('Please login first.');
        window.location.href='../login.php';
    </script>";
}



?>
