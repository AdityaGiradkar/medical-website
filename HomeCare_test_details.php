<?php 
    include("includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      $pay_id = $_GET['pay_id'];
      $payment_details = "SELECT * FROM `test_payments` WHERE `pay_id`='$pay_id' AND `test_id` IS NOT NULL";
      $payment_details_run = mysqli_query($con, $payment_details);
      $payment_details_rows = mysqli_num_rows($payment_details_run);

      
      //checking if user present for perticular
      //if not then redirect to user page
      if($payment_details_rows > 0){

        $record = mysqli_fetch_assoc($payment_details_run);
        $user_id = $record['user_id'];
        $test_id = $record['test_id'];

        $user_info = "SELECT *, TIMESTAMPDIFF(YEAR, `dob`, CURDATE()) AS age FROM `user` WHERE `user_id`='$user_id'";
        $user_info_run = mysqli_query($con, $user_info);
        $user_detail = mysqli_fetch_assoc($user_info_run);

        $medical_history = "SELECT * FROM `medical_history` WHERE `user_id`='$user_id'";
        $medical_history_run = mysqli_query($con, $medical_history);
        $medical_history_res = mysqli_fetch_assoc($medical_history_run);

        // Check for remaining tests
        $check_remaining_tests = "SELECT * FROM `test_payments` WHERE `user_id`='$user_id' AND `test_id` IS NULL GROUP BY `test_type`";
        $check_remaining_tests_run = mysqli_query($con, $check_remaining_tests);
        $check_remaining_tests_rows = mysqli_num_rows($check_remaining_tests_run);
        $tests = array(0,0,0,0,0,0);
        while($check_remaining_tests_res = mysqli_fetch_assoc($check_remaining_tests_run)){
          $index = $check_remaining_tests_res['test_type'];
          $tests[$index] = $check_remaining_tests_res['order_id'];
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Website icon -->
  <link rel="icon" href="images/AtmaVeda Logo.png" type="image/icon type">

  <title>Patient History</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- custome style -->
  <link rel="stylesheet" href="admin/css/patient_history.css">

  <!-- custom style sheet for sidebar and navigation bar -->
  <link rel="stylesheet" href="admin/css/sidebar.css">

  <style>
    @media print {
      div.footer {
        position: fixed;
        bottom: 0;
      }
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fas fa-fw fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Home site</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="user_page.php">
          <i class="fas fa-user-circle"></i>
          <span>Profile Page</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Hospital
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Treatments & Reports</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Treatment History:</h6>
            <a class="collapse-item" href="all_consultations.php">All Consultations</a>
            <a class="collapse-item active" href="all_test.php">All Tests & Report</a>
            <a class="collapse-item" href="ongoing_treatments.php">Treatments & Report</a>
            <a class="collapse-item" href="past_treatments.php">Past Treatments & Report</a>
          </div>
        </div>
      </li>

      <!-- Tests  --> 
      <?php
        if($check_remaining_tests_rows > 0){
      ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#incompleteTest" aria-expanded="true"
          aria-controls="incompleteTest">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Incomplete Tests</span>
        </a>
        <div id="incompleteTest" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Incomplete Tests:</h6>
            <?php if($tests[1] !== 0) { ?><a class="collapse-item" href="YogE_rakshakavach.php?orderId=<?php echo $tests[1]; ?>">YOG-E@Rakshakavach <br>Basic</a><?php } ?>
            <?php if($tests[2] !== 0) { ?><a class="collapse-item" href="YogE_HomeCare.php?orderId=<?php echo $tests[2]; ?>">YOG-E@HomeCare</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item" href="YogE_CritiCare.php?orderId=<?php echo $tests[3]; ?>">YOG-E@CritiCare</a><?php } ?>
            <?php if($tests[4] !== 0) { ?><a class="collapse-item" href="YogE_Antropometry.php?orderId=<?php echo $tests[4]; ?>">YOG-E@Anthropometry</a><?php } ?>
            <?php if($tests[5] !== 0) { ?><a class="collapse-item" href="YogE_rakshakavach.php?orderId=<?php echo $tests[5]; ?>">YOG-E@Rakshakavach <br>Advanced</a><?php } ?>
          </div>
        </div>
      </li>
      <?php
        }
      ?>

      <li class="nav-item">
        <a class="nav-link" href="extra_files.php">
          <i class="fas fa-file"></i>
          <span>Additional Files</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Personal
      </div>

      <li class="nav-item">
        <a class="nav-link" href="update_details.php">
          <i class="fas fa-user"></i>
          <span>Update Details</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="change_pass.php">
          <i class="fas fa-lock"></i>
          <span>Change Password</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" onclick="sidebar()" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="user_page.php">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                  </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid main-top main-left">

          <!-- Person info -->
          <div class="border border-primary rounded-lg p-3"
            style="background-color:#fff; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.35)">

            
            <h1 class="h4 mb-3 text-gray-800">Medical History</h1>
            <div class="row">
              <div class="col-md-4 mb-3">
                What is problem you have ? :<b> <?php echo $medical_history_res['problems']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                what type of treatment you tried before? :<b> <?php echo $medical_history_res['teratment_tried']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                date of first illness detected :
                <b><?php echo date("d-m-Y", strtotime($medical_history_res['date_first_illness'])); ?></b>
              </div>
              <div class="col-md-4 mb-3">
                Diagnosis made by doctors.:<b> <?php echo $medical_history_res['prev_doctor']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                Would you like a programme which has no side effects? :
                <b><?php echo $medical_history_res['side_effect']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                What time is best daily for your health session? :
                <b><?php echo $medical_history_res['health_session']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                Are you looking for permanent relief or temporary control? :
                <b><?php echo $medical_history_res['relief']; ?></b>
              </div>
            </div>
          </div>
          <!-- person info ends  -->


          <!-- CREATE TABLE OF test details  -->
          <?php 
            $test_details = "SELECT * FROM `test_homecare` WHERE `test_id`='$test_id'";
            $test_details_run = mysqli_query($con, $test_details);
            $test_details_res = mysqli_fetch_assoc($test_details_run);
            $check_error = false;
            
          ?>

          <input type="button" class="btn btn-sm mt-3 btn-primary d-flex ml-auto" onclick="printDiv('printableArea')" value="print Report" />

          <div class="border border-primary  rounded-lg mt-4 p-3" style="background-color:white">
            <!-- printable Area -->
            <div id="printableArea">
              <div class="header">
                <img src="images/brand.png"  width="250">
                <hr style="height:1px; background-color:#50A6C2">
              </div>

              <div class="user_details  mr-3 ml-4">
                <div class="row">
                    <div class="col-6">
                        <p>ID : <strong>HCDT<?php echo $test_details_res['homecare_test_no']; ?></strong></p>
                        <p>Age : <strong><?php echo $user_detail['age']; ?> Yrs.</strong></p>
                        <p>Test Date : <strong><?php echo date("Y-m-d h:ia", strtotime($record['created_at'])); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Name : <strong><?php echo $user_detail['name']; ?></strong></p>
                        <p>Sex : <strong><?php echo $user_detail['gender']; ?></strong></p>
                        <p>Report Date : <strong><?php echo date("Y-m-d h:ia", strtotime($record['created_at'])); ?></strong></p>
                    </div>
                </div>
                <p >Test Name : <strong>YOG-E @HomeCare Daily Test</strong></p>
                
              </div>
              <hr style="height:3px; background-color:#50A6C2">
              <br>
            
              <table class="table table-bordered table-striped table-responsive-md" id="treatBlock">
                <thead>
                  <tr>
                    <th scope="col">sr. no.</th>
                    <th scope="col">Vital Data</th>
                    <th scope="col">User Answer</th>
                    <th scope="col">Alert</th>
                  </tr>
                </thead>
                <tbody>
                  <tr style="color:<?php if($test_details_res['SPO2']/100 < 95 || $test_details_res['SPO2']/100 > 100){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">1</th>
                    <td>Pulse-ox Reading Of SPO2 (%)</td>
                    <td><?php echo $test_details_res['SPO2']/100; ?> %</td>
                    <td><?php if($test_details_res['SPO2']/100 >= 91 && $test_details_res['SPO2']/100 <= 94){ echo 'Alert'; }else if($test_details_res['SPO2']/100 >= 85 && $test_details_res['SPO2']/100 <= 90){ echo "High Risk"; }else if($test_details_res['SPO2']/100 >= 80 && $test_details_res['SPO2']/100 <= 84){ echo "Intensive Care"; }else if($test_details_res['SPO2']/100 < 85){ echo "Very Critical"; }else{ echo "Normal"; } ?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['s_blod_pressure']/100 < 100 || $test_details_res['s_blod_pressure']/100 > 140){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">2</th>
                    <td>Systolic Blood Pressure (mm/Hg)</td>
                    <td><?php echo $test_details_res['s_blod_pressure']/100; ?> mm/Hg</td>
                    <td><?php if($test_details_res['s_blod_pressure']/100 < 80 || $test_details_res['s_blod_pressure']/100 > 160){ echo 'High Risk'; }else if($test_details_res['s_blod_pressure']/100 < 100 || $test_details_res['s_blod_pressure']/100 > 140){ echo "Alert"; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['d_blod_pressure']/100 < 70 || $test_details_res['d_blod_pressure']/100 > 90){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">3</th>
                    <td>Diastolic Blood Pressure (mm/Hg)</td>
                    <td><?php echo $test_details_res['d_blod_pressure']/100; ?> mm/Hg</td>
                    <td><?php if($test_details_res['s_blod_pressure']/100 < 50 || $test_details_res['s_blod_pressure']/100 > 100){ echo 'High Risk'; }else if($test_details_res['s_blod_pressure']/100 < 60 || $test_details_res['s_blod_pressure']/100 > 90){ echo "Alert"; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['pulse_rate']/100 < 70 || $test_details_res['pulse_rate']/100 > 80){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">4</th>
                    <td>Pulse Rate (beat/min)</td>
                    <td><?php echo $test_details_res['pulse_rate']/100; ?> beat/min</td>
                    <td><?php if($test_details_res['pulse_rate']/100 < 70){ echo 'Low Pulse Rate'; }else if($test_details_res['pulse_rate']/100 > 80){ echo 'High Pulse Rate'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['respiration_rate']/100 < 8 || $test_details_res['respiration_rate']/100 > 16){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">5</th>
                    <td>Respiration Rate(per min)</td>
                    <td><?php echo $test_details_res['respiration_rate']/100; ?> per min</td>
                    <td><?php if($test_details_res['respiration_rate']/100 < 8 || $test_details_res['respiration_rate']/100 > 16){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['oral_temp']/100 < 97 || $test_details_res['oral_temp']/100 > 98.4){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">6</th>
                    <td>Oral body Temperature (<sup>0</sup>F)</td>
                    <td><?php echo $test_details_res['oral_temp']/100; ?> <sup>0</sup>F</td>
                    <td><?php if($test_details_res['oral_temp']/100 > 102){ echo 'Very High'; }else if($test_details_res['oral_temp']/100 > 100){ echo 'High'; }else if($test_details_res['oral_temp']/100 > 98.4){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['drink_water']/100 < 2){echo 'red'; $check_error = true; } ?>">
                  <th scope="row">7</th>
                    <td>How much water did he drink in last 24 hours (in Litre)</td>
                    <td><?php echo $test_details_res['drink_water']/100; ?> Litre</td>
                    <td><?php if($test_details_res['drink_water']/100 < 2){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['headache'] == 'Yes'){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">8</th>
                    <td>Do you have headache today</td>
                    <td><?php echo $test_details_res['headache']; ?></td>
                    <td><?php if($test_details_res['headache'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['bodyache'] == 'Yes'){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">9</th>
                    <td>Do you have bodyache today</td>
                    <td><?php echo $test_details_res['bodyache']; ?></td>
                    <td><?php if($test_details_res['bodyache'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['cough'] == 'Yes'){echo 'red'; $check_error = true;} ?>">
                    <th scope="row">10</th>
                    <td>Do you have cough today</td>
                    <td><?php echo $test_details_res['cough']; ?></td>
                    <td><?php if($test_details_res['cough'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['cold'] == 'Yes'){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">11</th>
                    <td>Do you have cold today</td>
                    <td><?php echo $test_details_res['cold']; ?></td>
                    <td><?php if($test_details_res['cold'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['fever'] == 'Yes'){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">12</th>
                    <td>Did you have fever  yesterday</td>
                    <td><?php echo $test_details_res['fever']; ?></td>
                    <td><?php if($test_details_res['fever'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['weakness'] == 'Yes'){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">13</th>
                    <td>Are you feeling weakness today</td>
                    <td><?php echo $test_details_res['weakness']; ?></td>
                    <td><?php if($test_details_res['weakness'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['loose_motion'] == 'Yes'){echo 'red'; $check_error = true; } ?>">
                    <th scope="row">14</th>
                    <td>Are you having loose motions </td>
                    <td><?php echo $test_details_res['loose_motion']; ?></td>
                    <td><?php if($test_details_res['loose_motion'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                </tbody>
              </table>

              <p >Any other complaints? : <b><?php echo $test_details_res['other_complaint']; ?></b></p>
              <p class="text-danger">
              Comment : 
              <b>
              <?php 
                  if(($test_details_res['pulse_rate']/100 >= 70 && $test_details_res['pulse_rate']/100 <= 80) && ($test_details_res['SPO2']/100 < 95 || $test_details_res['oral_temp']/100 > 98.4 || $test_details_res['respiration_rate']/100 > 16)){
                      echo "Possibility of Apparatus error needs to be ruled out OR advice to consult your family physician or you can consult our doctor online. <br> (On Home page <b>Click on Book Appointment -> Select General Consultation -> Book an Appointment.</b>).";
                  }else if($check_error === true){
                    echo "Advice to consult your family physician or you can consult our doctor online. <br> (On Home page <b>Click on Book Appointment -> Select General Consultation -> Book an Appointment.</b>).";
                  }else{
                    echo "All your vital data appears normal with suggest good vital statics. Please take care.";
                  }
              
              ?>
              </b></p>

              <hr>
              <div style="margin-left:65%;">
                <img src="images/sign.png" width="200" class="d-block mx-auto">
                <h5 class="text-center text-muted mt-3"><b>Dr. Sadanand Rasal</b></h5>
              </div>
              <br>

              <div class="footer" style="background-color:#50A6C2; color:white">
                <div class="row pl-4 pr-4 pt-3 pb-3">
                    <div class="col-4"><i class="fas fa-envelope"></i> &nbsp;drsadanand@atmavedayog.com</div>
                    <div class="col-4"><i class="fas fa-phone-alt"></i> &nbsp;8208537972</div>
                    <div class="col-4"><i class="fas fa-globe"></i> &nbsp;www.atmavedayog.com</div>
                    <div class="col-12 mt-3"><i class="fas fa-map-marker-alt"></i> &nbsp;Sant Tukdoji Nagar, Rahatani, Pune - 411017</div>
                </div>
              </div>
              <!-- printable Area -->
            </div>
          </div>
          <!-- CREATE TABLE OF test details  -->

          

          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>&copy; 2020 by AtmaVeda Yog Pvt. Ltd. &nbsp; &nbsp;<a target="blank" href="images/Privacy Policy.pdf">Privacy Policies</a></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin/js/sb-admin-2.min.js"></script>
</body>

<script>
    var width = $(document).width();
    //alert(width);
    if(width <= 576){
      var toggle_option = document.getElementById("accordionSidebar");
      toggle_option.classList.add("toggled");
    }
    function sidebar(){
      var toggle_option = document.getElementById("sidebarToggleTop");
      if (toggle_option.classList.contains('sidebar-open') == true) {
        toggle_option.classList.remove("sidebar-open");
      } else {
          // button.classList.add("marginLeft");
          toggle_option.classList.add("sidebar-open");
      }
    }
  </script>

</html>

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
        //else part if
          echo "<script>
              alert('No record found');
              window.location.href='user_page.php';
          </script>";
      }

    }else{
      //else part if session is not set
      echo "<script>
              window.location.href='error/login_error.html';
            </script>";
    }
?>