<?php 
    session_start();
    include('../includes/db.php');

    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 'doctor'){
        
            if (isset($_GET['bill_no'])){
                $bill_no = $_GET['bill_no'];

                $fetch_test_details = "SELECT * FROM `test_payments` WHERE `bill_no`='$bill_no'";
                $fetch_test_details_run = mysqli_query($con, $fetch_test_details);
                $fetch_test_details_rows = mysqli_num_rows($fetch_test_details_run);

                if($fetch_test_details_rows > 0){

                    $fetch_test_details_res = mysqli_fetch_assoc($fetch_test_details_run);

                    $user_id = $fetch_test_details_res['user_id'];
                    $test_fees = $fetch_test_details_res['charges'];
                    //$consult_status = $fetch_consultation_res['status'];
                    //$test_date = $fetch_test_details_res['created_at'];
                    //$consultation_time = $fetch_consultation_res['time_range'];
                    $test_type = $fetch_test_details_res['test_type'];

                    $fetch_test_name = "SELECT * FROM `test_type` WHERE `test_id`='$test_type'";
                    $fetch_test_name_run = mysqli_query($con, $fetch_test_name);
                    $fetch_test_name_res = mysqli_fetch_assoc($fetch_test_name_run);

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
    <div class="container pt-3">
        <!-- &larr; <a onClick="javascript: window.close()" href="test_submissions.php" >Close Receipt</a>    -->
        <input type="button" class="btn btn-sm mt-3 btn-primary d-flex ml-auto" onclick="printDiv('printableArea')" value="print Recipt" />   
    </div>
    <div class="container p-3 border mt-3 mb-3">
        <div class="printableArea" id="printableArea">
            <h4 class="text-center text-muted mb-3">Bill/Receipt</h4>
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
                <div class="col-4 mt-5 pt-4">
                    Bill To - <strong class="text-muted"><?php echo $user_details_res['name']; ?> </strong><br>
                    Email - <strong class="text-muted"><?php echo $user_details_res['email_id']; ?> </strong><br>
                    Age - <strong class="text-muted"><?php echo $user_details_res['age']; ?> Yrs.</strong>
                </div>
                <div class="col-3   ">
                    Bill/Receipt No. - <strong class="text-muted"><?php echo $bill_no; ?></strong> <br>
                    Date - <strong class="text-muted"><?php echo date("d/m/Y", strtotime($fetch_bill_generation_date_res['date'])); ?> </strong><br>
                </div>
            </div>
            <hr>
            <div class="mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-muted">Sr. No.</th>
                            <th scope="col" class="text-muted">Test Type</th>
                            <th scope="col" class="text-muted">Test Date</th>
                            <th scope="col" class="text-muted">Particular</th>
                            <th scope="col" class="text-muted">Charges (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <th scope="row"  class="text-muted"><?php echo "1"; ?></th>
                            <td><?php echo $fetch_test_name_res['test_name']; ?></td>
                            <td><?php echo date("d/m/Y", strtotime($fetch_bill_generation_date_res['date'])); ?></td>
                            <td><?php echo $fetch_test_name_res['particular']; ?></td>
                            <td>&#x20B9;<?php echo $test_fees; ?>.00</td>
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
                            <th class=" text-muted pt-5" rowspan="4">&#x20B9;<?php echo $test_fees; ?>.00</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php 
                //if($fetch_test_details_res['status'] == "checked"){
            ?>
            <hr class="mt-5 pt-5">
            <div class="mt-3 pb-5">
                <div class="row">
                    <div class="col-7">
                        <h4>Thank You for Visiting. Get well soon.</h4>
                    </div>
                    <div class="col-5">
                        <!-- <p class="text-center">For, Atmavedayog Pvt. Ltd.</p> -->
                        <img src="../images/sign.png" width="200" class="d-block mx-auto" >
                        <h5 class="text-center text-muted"><b>Dr. Sadanand Rasal</b></h5>
                    </div>
                </div>
            </div>
            <?php 
                //}
            ?>
        </div>

        
    </div>

            
            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
            </script>

 
        <div class="bg-dark pt-4 pb-3" style="paddig:2%; margin-bottom:-24px;color:white;">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-md-4 mt-3 ">
                        <p class="text-center" style=" font-size:12px;color:#bfbfbf">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. All rights reserved &nbsp;<a target="blank" href="../images/Privacy Policy.pdf">Privacy Policies</a></p>
                    </div>
                    <div class="col-md-4">
                        <img src="../images/AtmaVeda(334,273).png" width="80" class="img-fluid  d-block mx-auto" >
                    </div>
                    <div class="col-md-4" style="font-family: 'Roboto', sans-serif;">
                        <p class="text-ceter d-inline-block" style=" font-size:13px; color:#bfbfbf">enquiry@atmavedayog.com &nbsp; &nbsp;|&nbsp; &nbsp; 
                            <ul class="list-unstyled text-center d-inline-block" style="font-size: 2em">
                                <li class="d-inline"><a target="_blank" href="https://www.facebook.com/drsadanand.ke.yodhas/"><i class="fab fa-facebook-square fa-2x facebook"></i></a></li>
                                <li class="d-inline pl-3"><a target="_blank" href="https://www.instagram.com/drsadanand.atmavedayog"><i class="fab fa-instagram fa-2x instagram"></i></a></li>
                                <li class="d-inline pl-3"><a target="_blank" href="https://twitter.com/ForSadanand?s=09"><i class="fab fa-twitter-square fa-2x tweter"></i></a></li>
                            </ul>
                        </p>
                    </div>
                </div>
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
                }else{          //else part if dosen't find row
                    echo "<script>
                        alert('No record Found.');
                        window.location.href='index.php';
                    </script>";
                }
            }else{              //else part of isset($_GET[''] && ....)
                echo "<script>
                        alert('Insufficient data.');
                        window.location.href='index.php';
                    </script>";
            }
        }else{   //check if user is docor or not
            echo "<script>
                alert('Invalid Access');
                window.location.href='../index.php';
                </script>";
        }
    }else{                 //else part of session not set
        echo "<script>
                window.location.href='error/login_error.html';
            </script>";
    }


?>

