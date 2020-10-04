<?php 
    session_start();

    require_once "includes/db.php";
    require_once "payment/razorpay-php/Razorpay.php";

    use Razorpay\Api\Api;

    if(isset($_SESSION['user_id'])){

        $keyId = "rzp_live_rk3LTdATqKRgUf";
        $secretKey = "WFJugS35K9vdoFTANLdgo1gI";
        $api = new Api($keyId, $secretKey);


        if (isset($_GET['user_id']) && isset($_GET['treat_no']) && isset($_GET['sub_treat_no']) && isset($_GET['treat_id'])){
            $user_id = $_GET['user_id'];
            $treatment_number = $_GET['treat_no'];
            $sub_treatment_no = $_GET['sub_treat_no'];
            $treatment_id = $_GET['treat_id'];

            $user_details = "SELECT `name`, TIMESTAMPDIFF(YEAR, `dob`, CURDATE()) AS age, `email_id` FROM `user` WHERE `user_id`='$user_id'";
            $user_details_run = mysqli_query($con, $user_details);
            $user_details_res = mysqli_fetch_assoc($user_details_run);

            $treatment_details = "SELECT  `date`, `discount`, `fees_status` FROM `treatment` WHERE `treat_id`='$treatment_id'";
            $treatment_details_run = mysqli_query($con, $treatment_details);
            $treatment_details_res = mysqli_fetch_assoc($treatment_details_run);

            $prescribed_medi_details = array();
            $prescribed_session_details = array();
            $total_price = 0;

            //first take all medicines from prescribed_medicine table which matches treatment_no, user_id, subtreat_number
            $all_prescribed_medi = "SELECT `medicine_id`, `quantity` FROM `prescribed_medicine` WHERE `user_id`='$user_id' AND `treat_number`='$treatment_number' AND `sub_treat_number`='$sub_treatment_no'";
            if($all_prescribed_medi_run = mysqli_query($con, $all_prescribed_medi)){
                $all_prescribed_medi_row = mysqli_num_rows($all_prescribed_medi_run);
                if($all_prescribed_medi_row > 0){
                    $prescribed_medi_idQuantity_array = array();
                    $medi_count =0; 
                    while ($prescribed_medi_idQuantity = mysqli_fetch_assoc($all_prescribed_medi_run)){
                        $prescribed_medi_idQuantity_array[$medi_count] = $prescribed_medi_idQuantity;
                        $medi_count++;
                    }

                    //after that take price and dose for prescribed medicine from actual medicine table 
                    $medi_count =0;
                    foreach($prescribed_medi_idQuantity_array as $medi_Id_quantity){
                        $tempid = $medi_Id_quantity['medicine_id'];
                        $medicine_detail = "SELECT * FROM `medicines` WHERE `medicine_id`='$tempid'";
                        $medicine_detail_run = mysqli_query($con, $medicine_detail);
                        $medicine_detail_res = mysqli_fetch_assoc($medicine_detail_run);
                        $temp = array(
                            "name" => $medicine_detail_res['Name'],
                            "type" => $medicine_detail_res['type'],
                            "price" => $medicine_detail_res['price'],
                            "medi_quantity" => $medicine_detail_res['quantity'], //quantity from medicine table
                            "quantity" => $medi_Id_quantity['quantity'],    //quantity multiple of medicine table
                            "price" => $medicine_detail_res['price'],
                            "total_price" => $medi_Id_quantity['quantity'] * $medicine_detail_res['price']
                
                        );

                        $total_price = $total_price + (int)$temp['total_price'];
                        $prescribed_medi_details[$medi_count] = $temp;
                        $medi_count++;
                    }
                    // print_r($prescribed_medi_details);
                    // print_r($total_price);
                }
            }


            //first take all sessions from prescribed_session table which matches treatment_no, user_id, subtreat_number
            $all_prescribed_session = "SELECT * FROM `prescribed_session` WHERE `user_id`='$user_id' AND `treat_number`='$treatment_number' AND `sub_treat_number`='$sub_treatment_no'";
            if($all_prescribed_session_run = mysqli_query($con, $all_prescribed_session)){
                $all_prescribed_session_row = mysqli_num_rows($all_prescribed_session_run);
                if($all_prescribed_session_row > 0){
                    $prescribed_session_idQuantity_array = array();
                    $session_count =0;
                    while ($prescribed_session_idQuantity = mysqli_fetch_assoc($all_prescribed_session_run)){
                        $prescribed_session_idQuantity_array[$session_count] = $prescribed_session_idQuantity;
                        $session_count++;
                    }

                    //after that take price and quantity for prescribed sessions from actual session table 
                    $session_count =0;
                    foreach($prescribed_session_idQuantity_array as $session_Id_quantity){
                        $tempid = $session_Id_quantity['session_id'];
                        $session_detail = "SELECT * FROM `sessions` WHERE `session_id`='$tempid'";
                        $session_detail_run = mysqli_query($con, $session_detail);
                        $session_detail_res = mysqli_fetch_assoc($session_detail_run);
                        $temp = array(
                            "name" => $session_detail_res['session_name'],
                            "price" => $session_detail_res['price'],
                            "quantity" => $session_detail_res['quantity'],
                            "quantity_prescribed" => $session_Id_quantity['session_per_month'],
                            "price" => $session_detail_res['price'],
                            "total_price" => $session_Id_quantity['session_per_month'] * $session_detail_res['price']
                        );
                        $total_price = $total_price + (int)$temp['total_price'];
                        $prescribed_session_details[$session_count] = $temp;
                        $session_count++;
                    }
                    // print_r($prescribed_session_details);
                    // print_r($total_price);
                }
            }

            $total_payble_amount = $total_price - ($total_price * (int)$treatment_details_res['discount'])/100;
            $total_payble_amount = $total_payble_amount + 200;


            // for razorpay details
            $CUSTOMER_NAME = $_SESSION['name'];
            $CUSTOMER_EMAIL = $_SESSION['email'];
            $CUSTOMER_MOBILE = $_SESSION['mobile'];
            // razorpay send amount
            $PAY_AMT = $total_payble_amount;
            $PAY_AMT = (int)$PAY_AMT * 100;


            $order = $api->order->create(array(
                'receipt' => rand(1000, 9999) . 'ORD',
                'amount' => $PAY_AMT,
                'payment_capture' => 1,
                'currency' => 'INR'
                )
              );
            // for razorpay details
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <title>Recipt</title>

    <style>
        .razorpay-payment-button{
            border-radius: 12px;
            background-image: -moz-linear-gradient(-179deg, rgb(2, 233, 236) 0%, rgb(2, 56, 179) 100%);
            background-image: -webkit-linear-gradient(-179deg, rgb(2, 233, 236) 0%, rgb(2, 56, 179) 100%);
            background-image: -ms-linear-gradient(-179deg, rgb(2, 233, 236) 0%, rgb(2, 56, 179) 100%);
            
            height: 45px;
            border: 0;
            color:white;
            margin-top:1.5rem;
            display: inline-block;
        }
        .razorpay-payment-button:hover{
            background-image: -webkit-linear-gradient(179deg, rgb(2, 56, 179) 0%, rgb(2, 233, 236) 100%);
        }
    </style>
</head>
<body>
    <div class="container pt-3 mb-3">
        &larr; <a href="ongoing_treatments.php" >Go back to treatment page</a>    
    </div>
    <div class="container p-3 border mt-3">
        <div class="printableArea" id="printableArea">
            <h4 class="text-center text-muted mb-3">Bill cum Recipt</h4>
            <div class="row">
                <div class="col-5">
                    <img src="images/brand.png" width="300" class="" >
                    
                    <p>
                        <br>
                        <strong class="text-muted">Sant Tukdoji Nagar . Rahatni .Pune 411017</strong> <br>
                        Phone no.: <strong class="text-muted">7028831784 </strong><br>
                        Email : <strong class="text-muted">drsadanand@atmavedayog.com</strong>
                    </p>
                </div>
                <div class="col-4 mt-5 pt-4">
                    Bill To - <strong class="text-muted"><?php echo $user_details_res['name']; ?> </strong><br>
                    Email - <strong class="text-muted"><?php echo $user_details_res['email_id']; ?> </strong><br>
                    Age - <strong class="text-muted"><?php echo $user_details_res['age']; ?> </strong>
                </div>
                <div class="col-3   ">
                    Bill/Recipt No. - <strong class="text-muted"><?php echo $treatment_id; ?></strong> <br>
                    Date - <strong class="text-muted"><?php echo $treatment_details_res['date']; ?> </strong><br>
                </div>
            </div>
            <hr>
            <div class="mt-3">
                <lable class="h6" for="">Medicines : </lable>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-muted">Sr. No.</th>
                            <th scope="col" class="text-muted">Details</th>
                            <th scope="col" class="text-muted">Particular</th>
                            <th scope="col" class="text-muted">Quantity</th>
                            <th scope="col" class="text-muted">Cost/Unit (Rs.)</th>
                            <th scope="col" class="text-muted">Total (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 1;
                            foreach($prescribed_medi_details as $medi){
                        ?>
                        <tr>
                            <th scope="row"  class="text-muted"><?php echo $count; ?></th>
                            <td><?php echo $medi['name']; ?></td>
                            <td><?php echo $medi['medi_quantity']; ?></td>
                            <td><?php echo $medi['quantity']; ?></td>
                            <td><?php echo $medi['price']; ?>.00</td>
                            <td><?php echo $medi['quantity']. " * " .$medi['price']. ".00 = " .$medi['total_price'].".00"; ?></td>
                        </tr>
                        <?php
                        $count++;
                            } 
                        ?>
                        <?php 
                            foreach($prescribed_session_details as $session){
                        ?>
                        <tr>
                            <th scope="row" class="text-muted"><?php echo $count; ?></th>
                            <td><?php echo $session['name']; ?></td>
                            <td><?php echo $session['quantity']; ?></td>
                            <td><?php echo $session['quantity_prescribed']; ?></td>
                            <td><?php echo $session['price']; ?>.00</td>
                            <td><?php echo $session['quantity_prescribed']. " * " .$session['price']. ".00 = " .$session['total_price'].".00"; ?></td>
                        </tr>
                        <?php
                        $count++;
                            } 
                        ?>
                        <tr>
                            <th scope="row" class="text-center text-muted" colspan="5">Total</th>
                            <td>&#x20B9; <?php echo $total_price.".00"; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center text-muted mt-5" colspan="3" rowspan="4">Grand Total</th>
                            <td colspan="2" class="text-center">Discount</td>
                            <th class=" text-muted">- <?php echo $treatment_details_res['discount']; ?>%</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Courear Charges </td>
                            <th class=" text-muted">&#x20B9; <?php echo "200" ?>.00</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Received</td>
                            <th class=" text-muted">- &#x20B9; <?php echo "0" ?>.00</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Payble Amount</td>
                            <th class=" text-muted">&#x20B9; <?php echo $total_payble_amount; ?>.00</th>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <?php 
                if($treatment_details_res['fees_status'] !== 'pending'){
            
            ?>
            <hr class="mt-5 pt-5">
            <div class="mt-3 pb-5">
                <div class="row">
                    <div class="col-7">
                        <h4>Thank You for Visiting. Get well soon.</h4>
                    </div>
                    <div class="col-5">
                        <p class="text-center">For, Atmavedayog Pvt. Ltd.</p>
                        <img src="images/brand.png" width="300" class="d-block mx-auto" >
                        <p class="text-center">Authorized Signatory</p>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>

        
    </div>
    <?php 
        if($treatment_details_res['fees_status'] !== 'pending'){
    ?>
            <input type="button" class="btn mt-3 mb-5 btn-primary d-block mx-auto" onclick="printDiv('printableArea')" value="print Recipt" />
            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
            </script>
    <?php 
        }else{
            
    ?>
            <form action="payment/treatment_sucess.php?treat_id=<?php echo $treatment_id; ?>&treat_no=<?php echo $treatment_number; ?>&sub_treat_no=<?php echo $sub_treatment_no; ?>&charge=<?php echo $order->amount; ?>" method="POST" style="text-align:center" class="mb-3">
                <script
                    src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key=<?php echo $keyId ?> 
                    data-amount="<?php echo $order->amount; ?>" 
                    data-currency="INR"
                    data-order_id="<?php echo $order->id; ?>"
                    data-buttontext="Pay with Razorpay"
                    data-name="AtmaVeda Yog"
                    data-description="We live long..."
                    data-image="images/AtmaVeda Logo.png"
                    data-prefill.name="<?php echo $CUSTOMER_NAME; ?>"
                    data-prefill.email="<?php echo $CUSTOMER_EMAIL; ?>"
                    data-prefill.contact="<?php echo $CUSTOMER_MOBILE; ?>"
                    data-theme.color="#F37254"
                ></script>
                <input type="hidden" custom="Hidden Element" name="hidden">
                </form>
    <?php
       }
    ?>
    <div class="bg-dark" style="padding:2%; margin-bottom:-24px;color:white;">
            <p class="text-center mb-0">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. &nbsp; &nbsp;<a target="blank" href="images/Privacy Policy.pdf">Privacy Policies</a></p>
        </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
        }else{              //else part of isset($_GET[''] && ....)
            echo "<script>
                    alert('Insufficient data.');
                    window.location.href='index.php';
                </script>";
        }
    }else{                 //else part of session not set
        echo "<script>
                window.location.href='error/login_error.html';
            </script>";
    }


?>

