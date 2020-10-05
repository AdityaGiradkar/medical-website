<?php 
    session_start();
    include("../includes/db.php");

    if (isset($_GET['user_id']) && isset($_GET['treat_no']) && isset($_GET['sub_treat_no']) && isset($_GET['treat_id'])){
        $user_id = $_GET['user_id'];
        $treatment_number = $_GET['treat_no'];
        $sub_treatment_no = $_GET['sub_treat_no'];
        $treatment_id = $_GET['treat_id'];

        $user_details = "SELECT `name`, TIMESTAMPDIFF(YEAR, `dob`, CURDATE()) AS age, `email_id` FROM `user` WHERE `user_id`='$user_id'";
        $user_details_run = mysqli_query($con, $user_details);
        $user_details_res = mysqli_fetch_assoc($user_details_run);

        $treatment_details = "SELECT  `treatment_for`, `date`, `discount`, `fees_status`, `bill_number` FROM `treatment` WHERE `treat_id`='$treatment_id'";
        $treatment_details_run = mysqli_query($con, $treatment_details);
        $treatment_details_res = mysqli_fetch_assoc($treatment_details_run);

        $bill_number = $treatment_details_res['bill_number'];
        $fetch_bill_generation_date = "SELECT * FROM `bill_number` WHERE `bill_number`='$bill_number'";
        $fetch_bill_generation_date_run = mysqli_query($con, $fetch_bill_generation_date);
        $fetch_bill_generation_date_res = mysqli_fetch_assoc($fetch_bill_generation_date_run);

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
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <title>Recipt</title>
</head>
<body>
    
    <div class="container p-3 border mt-3">
        <div class="printableArea" id="printableArea">
            <h4 class="text-center mb-3">Bill/Receipt</h4>
            <div class="row">
                <div class="col-5">
                    <img src="../images/brand.png" width="300" class="" >
                    
                    <p>
                        <br>
                        <strong class="text-muted">Sant Tukdoji Nagar . Rahatni .Pune 411017</strong> <br>
                        Phone no.: <strong class="text-muted">7028831784 </strong><br>
                        Email : <strong class="text-muted">drsadanand@atmavedayog.com</strong>
                    </p>
                </div>
                <div class="col-4 mt-5 pt-3">
                    Bill To - <strong class="text-muted"><?php echo $user_details_res['name']; ?> </strong><br>
                    Email - <strong class="text-muted"><?php echo $user_details_res['email_id']; ?> </strong><br>
                    Age - <strong class="text-muted"><?php echo $user_details_res['age']; ?> </strong> <br> 
                    Diagnosis - <strong class="text-muted"><?php echo $treatment_details_res['treatment_for']; ?></strong>
                </div>
                <div class="col-3">
                    Bill/Recipt No. - <strong class="text-muted"><?php if($bill_number != 0){ echo $treatment_details_res['bill_number']; } ?></strong> <br>
                    Date - <strong class="text-muted"><?php if($bill_number != 0){ echo date("d/m/Y", strtotime($fetch_bill_generation_date_res['date'])); } ?> </strong><br>
                </div>
            </div>
            <hr>
            <div class="mt-3">
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
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $medi['name']; ?></td>
                            <td><?php echo $medi['medi_quantity']; ?></td>
                            <td><?php echo $medi['quantity']; ?></td>
                            <td>&#x20B9; <?php echo $medi['price']; ?>.00</td>
                            <td>&#x20B9; <?php echo $medi['total_price'].".00"; ?></td>
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
                            <td>&#x20B9; <?php echo $session['price']; ?>.00</td>
                            <td>&#x20B9; <?php echo $session['total_price'].".00"; ?></td>
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
                            <th scope="row" class="text-muted mt-5" colspan="3" rowspan="4">
                                <small>
                                    <p><b>Terms and conditions:-</b></p>
                                    <ol>
                                        <li>No refund policy. rescheduling of appointment/session can be done within 30 days subject to availablility of appointments.</li>
                                        <li>The seller is not responsible for any damage that happens in transit of medicine/goods</li>
                                        <li>All matters subject to pune jurisdiction.</li>
                                    </ol>
                                </small>
                            </th>
                            <td colspan="2" class="text-center">Discount</td>
                            <th class=" text-muted">- <?php echo $treatment_details_res['discount']; ?>%</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Courier Charges </td>
                            <th class=" text-muted">&#x20B9; <?php echo "200" ?>.00</th>
                        </tr>
                        <!-- <tr>
                            <td colspan="2" class="text-center">Received</td>
                            <th class=" text-muted">- &#x20B9; <?php echo "0" ?>.00</th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Payble Amount</td>
                            <th class=" text-muted">&#x20B9; <?php echo $total_payble_amount; ?>.00</th>
                        </tr> -->
                        <?php 
                            if($treatment_details_res['fees_status'] == 'pending'){
                        ?>
                                <tr>
                                    <td colspan="2" class="text-center">Payment Received</td>
                                    <th class=" text-muted">- &#x20B9; <?php echo "0" ?>.00</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">Payable Amount</td>
                                    <th class=" text-muted">&#x20B9; <?php echo $total_payble_amount; ?>.00</th>
                                </tr>
                        <?php 
                            }else{
                                ?>
                                
                                <tr>
                                    <td colspan="2" class="text-center">Payable Amount</td>
                                    <th class=" text-muted">&#x20B9; <?php echo "0" ?>.00</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">Payment Received</td>
                                    <th class=" text-muted"> &#x20B9; <?php echo $total_payble_amount; ?>.00</th>
                                </tr>
                                
                                
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
                if($treatment_details_res['fees_status'] !=='pending'){ 
            ?>
            <hr class="mt-5 pt-5">
            <div class="mt-3 pb-5">
                <div class="row">
                    <div class="col-7">
                        <h4>Thank You for Visiting. Get well soon.</h4>
                    </div>
                    <div class="col-5">
                        <p class="text-center">For, Atmavedayog Pvt. Ltd.</p>
                        <img src="../images/sign.jpeg" width="200" class="d-block mx-auto" >
                        <p class="text-center">Authorized Signatory</p>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>

        
    </div>
    <input type="button" class="btn mt-3 mb-5 btn-primary d-block mx-auto" onclick="printDiv('printableArea')" value="print Recipt" />

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
    <script type="text/javascript" src="../bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    }else{
        echo "<script>
                alert('Insufficient data.');
                window.location.href='index.php';
            </script>";
    }


?>

<script>

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>