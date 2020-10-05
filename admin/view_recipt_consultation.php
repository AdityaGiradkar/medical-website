<?php 
    session_start();
    include('../includes/db.php');

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        if (isset($_GET['bill_no'])){
            $bill_no = $_GET['bill_no'];

            $fetch_consultation = "SELECT * FROM `consultation_time` WHERE `bill_number`='$bill_no'";
            $fetch_consultation_run = mysqli_query($con, $fetch_consultation);
            $fetch_consultation_res = mysqli_fetch_assoc($fetch_consultation_run);

            $user_id = $fetch_consultation_res['assigned_user'];
            $consult_fees = $fetch_consultation_res['consult_fees'];
            $consult_status = $fetch_consultation_res['status'];
            $consultation_date = $fetch_consultation_res['date'];
            $consultation_time = $fetch_consultation_res['time_range'];
            $consultation_type = $fetch_consultation_res['consult_type'];

            $user_details = "SELECT `name`, TIMESTAMPDIFF(YEAR, `dob`, CURDATE()) AS age, `email_id` FROM `user` WHERE `user_id`='$user_id'";
            $user_details_run = mysqli_query($con, $user_details);
            $user_details_res = mysqli_fetch_assoc($user_details_run);


            $fetch_bill_generation_date = "SELECT * FROM `bill_number` WHERE `bill_number`='$bill_no'";
            $fetch_bill_generation_date_run = mysqli_query($con, $fetch_bill_generation_date);
            $fetch_bill_generation_date_res = mysqli_fetch_assoc($fetch_bill_generation_date_run);

   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- fontawesome link-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

     <!-- Custom css File -->
    <link rel="stylesheet" href="../css/index.css">

    <title>Recipt</title>

</head>
<body>
    <div class="container pt-3 mb-3">
        &larr; <a href="user_details.php?uid=<?php echo $user_id; ?>" >Go back to Consultations page</a>    
    </div>
    <div class="container p-3 border mt-3">
        <div class="printableArea" id="printableArea">
            <h4 class="text-center text-muted mb-3">Bill/Recipt</h4>
            <div class="row">
                <div class="col-5">
                    <img src="../images/brand.png" width="300" class="" >
                    
                    <p>
                        <br>
                        <strong class="text-muted">Sant Tukdoji Nagar. Rahatni. Pune 411017</strong> <br>
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
                    Bill/Recipt No. - <strong class="text-muted"><?php echo $bill_no; ?></strong> <br>
                    Date - <strong class="text-muted"><?php echo date("d/m/Y", strtotime($fetch_bill_generation_date_res['date'])); ?> </strong><br>
                </div>
            </div>
            <hr>
            <div class="mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-muted">Sr. No.</th>
                            <th scope="col" class="text-muted">Consultation Type</th>
                            <th scope="col" class="text-muted">Consultation Date</th>
                            <th scope="col" class="text-muted">Consultation Time</th>
                            <th scope="col" class="text-muted">Charges (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <th scope="row"  class="text-muted"><?php echo "1"; ?></th>
                            <td><?php echo $consultation_type; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($consultation_date)); ?></td>
                            <td><?php echo $consultation_time; ?></td>
                            <td>&#x20B9; <?php echo $consult_fees; ?>.00</td>
                        </tr>
                        
                        
                        <tr>
                            <th scope="row" class="text-muted mt-5" colspan="3" rowspan="3">
                                <small>
                                    <p><b>Terms and conditions:-</b></p>
                                    <ol>
                                        <li>No refund policy. rescheduling of appointment/session can be done within 30 days subject to availablility of appointments.</li>
                                        <li>The seller is not responsible for any damage that happens in transit of medicine/goods</li>
                                        <li>All matters subject to pune jurisdiction.</li>
                                    </ol>
                                </small>
                            </th>
                            <td class="text-center pt-5" rowspan="4">Paid Amount</td>
                            <th class=" text-muted pt-5" rowspan="4">&#x20B9; <?php echo $consult_fees; ?>.00</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php 
                if($consult_status == "checked"){
            
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
            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
            </script>

 
        <div class="bg-dark pt-5 pb-4" style="paddig:2%; margin-bottom:-24px;color:white;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="../images/AtmaVeda(334,273).png" width="200" class="img-fluid" >
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-5 text-center" style="font-family: 'Roboto', sans-serif;">Social Media Handel</h4>
                        <ul class="list-unstyled text-center" style="font-size: 2em">
                            <li class="d-inline"><a target="_blank" href="https://www.facebook.com/drsadanand.ke.yodhas/"><i class="fab fa-facebook-square fa-3x facebook"></i></a></li>
                            <li class="d-inline pl-5"><a target="_blank" href="https://www.instagram.com/drsadanand.atmavedayog"><i class="fab fa-instagram fa-3x instagram"></i></a></li>
                            <li class="d-inline pl-5"><a target="_blank" href="https://twitter.com/ForSadanand?s=09"><i class="fab fa-twitter-square fa-3x tweter"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-3" style="font-family: 'Roboto', sans-serif;">
                        <h4 class="text-cener">Contact Us</h4><br>
                        <p class="text-cener">Dr. Sadanand Rasal</p>
                        <p class="text-ceter">enquiry@atmavedayog.com</p>
                        <p class="text-cnter">WhatsApp : +91 82085 37972</p>
                        
                    </div>
                </div>
            </div>
            <p class="text-center mt-5 mb-0">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. &nbsp; &nbsp;<a target="blank" href="images/Privacy Policy.pdf">Privacy Policies</a></p>
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

