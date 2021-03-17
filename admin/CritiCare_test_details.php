<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      if($_SESSION['role'] == 'doctor'){
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
              
          //finding total number of new patient
          $new_patient_count = "SELECT count(*) as total FROM `consultation_time` WHERE `status`='assigned'";
          $new_patient_count_run = mysqli_query($con, $new_patient_count);
          $data=mysqli_fetch_assoc($new_patient_count_run);
          //finding total number of new patient

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
  <link rel="icon" href="../images/AtmaVeda Logo.png" type="image/icon type">

  <title>CritiCare Test Details</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- custome style -->
  <link rel="stylesheet" href="css/patient_history.css">

  <!-- custom style sheet for sidebar and navigation bar -->
  <link rel="stylesheet" href="css/sidebar.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
          <div class="sidebar-brand-icon">
              <i class="fas fa-fw fa-home"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Home site</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="index.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Consultation
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true"
              aria-controls="collapseTwo">
              <i class="fas fa-user-injured"></i>
              <span>Patients <?php if($data['total'] > 0){ ?><sup><i class="fas fa-circle"
                          style="font-size: .75em !important;"></i></sup><?php } ?></span>
          </a>
          <div id="collapsePatient" class="collapse show" aria-labelledby="headingTwo"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Patients : </h6>
                  <a class="collapse-item" href="new_patient.php">New consultation
                      (<?php echo $data['total']; ?>)</a>
                  <a class="collapse-item active" href="test_submissions.php">New Test Submissions</a>
                  <a class="collapse-item" href="all_treatments.php">All Treatments</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#timing" aria-expanded="true"
              aria-controls="collapseTwo">
              <i class="fas fa-fw fa-clock"></i>
              <span>Timing</span>
          </a>
          <div id="timing" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Time Slots:</h6>
                  <a class="collapse-item" href="consultation_time.php">Add Time Slots</a>
                  <a class="collapse-item" href="added_slot_dates.php">Available Slots</a>
              </div>
          </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Hospital
      </div>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicine"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-pills"></i>
              <span>Medicines</span>
          </a>
          <div id="collapseMedicine" class="collapse" aria-labelledby="headingTwo"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Medicine Section:</h6>
                  <a class="collapse-item" href="all_medicines.php">All Medicines</a>
                  <a class="collapse-item" href="add_medicine.php">Add Medicine</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSessions" aria-expanded="true"
              aria-controls="collapseTwo">
              <i class="fas fa-fw fa-pills"></i>
              <span>Sessions</span>
          </a>
          <div id="collapseSessions" class="collapse" aria-labelledby="headingTwo"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Sssions:</h6>
                  <a class="collapse-item" href="all_sessions.php">All Sessions</a>
                  <a class="collapse-item" href="add_session.php">Add Session</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-pills"></i>
              <span>Blogs & Videos</span>
          </a>
          <div id="collapseBlogs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Blogs & Videos:</h6>
                  <a class="collapse-item" href="blogs_table.php">All Blogs & Videos</a>
                  <a class="collapse-item" href="add_blogs.php">Add Blogs & Videos</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReview" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-pills"></i>
          <span>User Reviews</span>
        </a>
        <div id="collapseReview" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reviews:</h6>
            <a class="collapse-item" href="all_reviews.php">All Reviews</a>
            <a class="collapse-item" href="add_review.php">Add Review</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="all_images.php">
          <i class="fas fa-images"></i>
          <span>Website Images</span></a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="users.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Users</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']; ?></span>
                        <img class="img-profile rounded-circle"
                            src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" target="_blank" href="https://dashboard.razorpay.com/#/access/signin">
                            <!-- <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> -->
                            <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>
                            RazorPay 
                        </a>
                        <a class="dropdown-item" target="_blank" href="invoices.php">
                            <i class="fas fa-receipt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Invoice 
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
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
              <h1 class="h4 mb-2 text-gray-800">Personal Details</h1>
                <div class="row">
                  <div class="col-md-4">
                      Name :<b> <?php echo $user_detail['name']; ?></b>
                  </div>
                  <div class="col-md-4">
                      Father's Name :<b> <?php echo $user_detail['father_name']; ?></b>
                  </div>
                  <div class="col-md-4">
                      Contact :<b> <?php echo $user_detail['contact_no']; ?></b>
                  </div>
                  <div class="col-md-4">
                      Email :  <b> <?php echo $user_detail['email_id']; ?></b>
                  </div>
                  <div class="col-md-4">
                      Gender :<b> <?php echo $user_detail['gender']; ?></b>
                  </div>
                  <div class="col-md-4">
                      DOB :<b> <?php echo date("d-m-Y", strtotime($user_detail['dob'])); ?></b>
                  </div>
                  <div class="col-md-4">
                      Married :<b> <?php echo $user_detail['married']; ?></b>
                  </div>
                  <div class="col-md-4">
                      Working :<b> <?php echo $user_detail['working']; ?></b>
                  </div>
                  <div class="col-md-4">
                      Address :<b> <?php echo $user_detail['address']; ?></b>
                  </div>
              </div>


            <h1 class="h4 mb-3 mt-4 text-gray-800">Medical History</h1>
            <div class="row">
              <div class="col-md-4 mb-3">
                What is problem you have ? :<b> <?php echo $medical_history_res['problems']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                what type of treatment you tried before? :<b> <?php echo $medical_history_res['teratment_tried']; ?></b>
              </div>
              <div class="col-md-4 mb-3">
                date of first illness detected :
                <b><?php echo $medical_history_res['date_first_illness']; ?></b>
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
            $test_details = "SELECT * FROM `test_creticare` WHERE `test_id`='$test_id'";
            $test_details_run = mysqli_query($con, $test_details);
            $test_details_res = mysqli_fetch_assoc($test_details_run);
          ?>

          <input type="button" class="btn btn-sm mt-3 btn-primary d-flex ml-auto" onclick="printDiv('printableArea')" value="print Report" />

          <div class="border border-primary  rounded-lg mt-4 p-3" style="background-color:white">
            <!-- printable Area -->
            <div id="printableArea">
              <div class="header">
                <img src="../images/brand.png"  width="250">
                <hr style="height:1px; background-color:#50A6C2">
              </div>

              <div class="user_details  mr-3 ml-4">
                <div class="row">
                    <div class="col-6">
                        <p>ID : <strong>CCDT<?php echo $test_details_res['criticare_test_no']; ?></strong></p>
                        <p>Age : <strong><?php echo $user_detail['age']; ?> Yrs.</strong></p>
                        <p>Test Date : <strong><?php echo date("Y-m-d h:ia", strtotime($record['created_at'])); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Name : <strong><?php echo $user_detail['name']; ?></strong></p>
                        <p>Sex : <strong><?php echo $user_detail['gender']; ?></strong></p>
                        <p>Report Date : <strong><?php echo date("Y-m-d h:ia", strtotime($record['created_at'])); ?></strong></p>
                    </div>
                </div>
                <p >Test Name : <strong>YOG-E @CritiCare Daily Test Report</strong></p>
                
              </div>
              <hr style="height:3px; background-color:#50A6C2">
              <br>
            
              <div class="body">
                <div class="general_info ml-3">
                  <p>If a Hospitalized Case Then Name Of Hospital And IPD Nunmber : <strong><?php echo $test_details_res['hospital_name']; ?></strong></p>
                  <div class="row">
                    <div class="col-md-6">
                      <p>COVID-19 Testing Done : <strong><?php echo $test_details_res['covid_test']; ?></strong></p>
                    </div>
                    <div class="col-md-6">
                      <p>COVID-19 Test Rrport : <strong><?php echo $test_details_res['covid_report']; ?></strong></p>
                    </div>
                  </div>
                  <p>Diagnosis as written on hospital/prescription paper : <strong><?php echo $test_details_res['prescription_paper']; ?></strong></p>
                </div>
                <br>

                <table class="table table-bordered table-striped table-responsive-md" id="treatBlock">
                  <thead>
                    <tr>
                      <th scope="col">Sr. No.</th>
                      <th scope="col">Vital Data & Diagnostic Test Values</th>
                      <th scope="col">Normal Range</th>
                      <th scope="col">Value Entered</th>
                      <th scope="col">Interpretations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="color:<?php if($test_details_res['SPO2']/100 < 95 || $test_details_res['SPO2']/100 > 100){echo 'red'; } ?>">
                      <th scope="row">1</th>
                      <td>Pulse-ox Reading Of SPO2 (%)</td>
                      <td>95% to 100%</td>
                      <td><?php echo $test_details_res['SPO2']/100; ?> %</td>
                      <td><?php if($test_details_res['SPO2']/100 < 95 || $test_details_res['SPO2']/100 > 100){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['s_blod_pressure']/100 < 100 || $test_details_res['s_blod_pressure']/100 > 140){echo 'red'; } ?>">
                      <th scope="row">2</th>
                      <td>Systolic Blood Pressure (mm/Hg)</td>
                      <td>100 to 140 (mm/Hg)</td>
                      <td><?php echo $test_details_res['s_blod_pressure']/100; ?> mm/Hg</td>
                      <td><?php if($test_details_res['s_blod_pressure']/100 < 100 || $test_details_res['s_blod_pressure']/100 > 140){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['d_blod_pressure']/100 < 70 || $test_details_res['d_blod_pressure']/100 > 90){echo 'red'; } ?>">
                      <th scope="row">3</th>
                      <td>Diastolic Blood Pressure (mm/Hg)</td>
                      <td>70 to 90 (mm/Hg)</td>
                      <td><?php echo $test_details_res['d_blod_pressure']/100; ?> mm/Hg</td>
                      <td><?php if($test_details_res['d_blod_pressure']/100 < 70 || $test_details_res['d_blod_pressure']/100 > 90){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['pulse_rate']/100 < 70 || $test_details_res['pulse_rate']/100 > 80){echo 'red'; } ?>">
                      <th scope="row">4</th>
                      <td>Pulse Rate (beat/min)</td>
                      <td>70 to 80 (beat/min)</td>
                      <td><?php echo $test_details_res['pulse_rate']/100; ?> beat/min</td>
                      <td><?php if($test_details_res['pulse_rate']/100 < 70 || $test_details_res['pulse_rate']/100 > 80){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['respiration_rate']/100 < 8 || $test_details_res['respiration_rate']/100 > 16){echo 'red'; } ?>">
                      <th scope="row">5</th>
                      <td>Respiration Rate(per min)</td>
                      <td>8 to 16 (per min)</td>
                      <td><?php echo $test_details_res['respiration_rate']/100; ?> per min</td>
                      <td><?php if($test_details_res['respiration_rate']/100 < 8 || $test_details_res['respiration_rate']/100 > 16){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['oral_temp']/100 < 97 || $test_details_res['oral_temp']/100 > 98.4){echo 'red'; } ?>">
                      <th scope="row">6</th>
                      <td>Oral body Temperature (<sup>0</sup>F)</td>
                      <td>97 to 98.4 (<sup>0</sup>F) </td>
                      <td><?php echo $test_details_res['oral_temp']/100; ?> <sup>0</sup>F</td>
                      <td><?php if($test_details_res['oral_temp']/100 < 97 || $test_details_res['oral_temp']/100 > 98.4){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['haemoglobin']/100 < 13 || $test_details_res['haemoglobin']/100 > 17){echo 'red'; } ?>">
                      <th scope="row">7</th>
                      <td>Haemoglobin (gm%)</td>
                      <td>13 to 17 (gm%)</td>
                      <td><?php echo $test_details_res['haemoglobin']/100; ?> per c.mm</td>
                      <td><?php if($test_details_res['haemoglobin']/100 < 13 || $test_details_res['haemoglobin']/100 > 17){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['wbc_count']/100 < 4000 || $test_details_res['wbc_count']/100 > 10000){echo 'red'; } ?>">
                      <th scope="row">8</th>
                      <td>WBC Count (per c.mm)</td>
                      <td>4000 to 10000 (per c.mm)</td>
                      <td><?php echo $test_details_res['wbc_count']/100; ?></td>
                      <td><?php if($test_details_res['wbc_count']/100 < 4000 || $test_details_res['wbc_count']/100 > 10000){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['polymorphs']/100 < 40 || $test_details_res['polymorphs']/100 > 80){ echo 'red'; }?>">
                      <th scope="row">9</th>
                      <td>Polymorphs (%)</td>
                      <td>40 to 80 (%)</td>
                      <td><?php echo $test_details_res['polymorphs']/100; ?> %</td>
                      <td><?php if($test_details_res['polymorphs']/100 < 40 || $test_details_res['polymorphs']/100 > 80){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['lymphocytes']/100 < 40 || $test_details_res['lymphocytes']/100 > 80){echo 'red'; } ?>">
                      <th scope="row">10</th>
                      <td>Lymphocytes (%)</td>
                      <td>40 to 80 (%)</td>
                      <td><?php echo $test_details_res['lymphocytes']/100; ?> %</td>
                      <td><?php if($test_details_res['lymphocytes']/100 < 40 || $test_details_res['lymphocytes']/100 > 80){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['monocytes']/100 < 2 || $test_details_res['monocytes']/100 > 10){echo 'red'; } ?>">
                      <th scope="row">11</th>
                      <td>Monocytes (%)</td>
                      <td>02 to 10 (%)</td>
                      <td><?php echo $test_details_res['monocytes']/100; ?> %</td>
                      <td><?php if($test_details_res['monocytes']/100 < 2 || $test_details_res['monocytes']/100 > 10){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['eosinophils']/100 < 1 || $test_details_res['eosinophils']/100 > 6){echo 'red'; } ?>">
                      <th scope="row">12</th>
                      <td>Eosinophils (%)</td>
                      <td>01 to 06 (%)</td>
                      <td><?php echo $test_details_res['eosinophils']/100; ?> %</td>
                      <td><?php if($test_details_res['eosinophils']/100 < 1 || $test_details_res['eosinophils']/100 > 6){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['basophils']/100 < 0 || $test_details_res['basophils']/100 > 2){echo 'red'; } ?>">
                      <th scope="row">13</th>
                      <td>Basophils (%)</td>
                      <td>00 to 02 (%)</td>
                      <td><?php echo $test_details_res['basophils']/100; ?> %</td>
                      <td><?php if($test_details_res['basophils']/100 < 0 || $test_details_res['basophils']/100 > 2){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['platelet_count']/100 < 150000 || $test_details_res['platelet_count']/100 > 410000){echo 'red'; } ?>">
                      <th scope="row">14</th>
                      <td>Platelet Count (PER C. MM)</td>
                      <td>150000 to 410000 (PER C. MM)</td>
                      <td><?php echo $test_details_res['platelet_count']/100; ?> PER C. MM</td>
                      <td><?php if($test_details_res['platelet_count']/100 < 150000 || $test_details_res['platelet_count']/100 > 410000){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['mvp']/100 < 7.4 || $test_details_res['mvp']/100 > 11.4){echo 'red'; } ?>">
                      <th scope="row">15</th>
                      <td>MPV (PER C. MM)</td>
                      <td>7.4 to 11.4 (PER C. MM)</td>
                      <td><?php echo $test_details_res['mvp']/100; ?> PER C. MM</td>
                      <td><?php if($test_details_res['mvp']/100 < 7.4 || $test_details_res['mvp']/100 > 11.4){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['rbc_count']/100 < 4.5 || $test_details_res['rbc_count']/100 > 5.5){echo 'red'; } ?>">
                      <th scope="row">16</th>
                      <td>RBC Count (MILL/C.MM)</td>
                      <td>4.5 to 5.5 (MILL/C.MM)</td>
                      <td><?php echo $test_details_res['rbc_count']/100; ?> MILL/C.MM</td>
                      <td><?php if($test_details_res['rbc_count']/100 < 4.5 || $test_details_res['rbc_count']/100 > 5.5){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['pvc']/100 < 40 || $test_details_res['pvc']/100 > 50){echo 'red'; } ?>">
                      <th scope="row">17</th>
                      <td>PCV / HCT (%)</td>
                      <td>40 to 50 (%)</td>
                      <td><?php echo $test_details_res['pvc']/100; ?> %</td>
                      <td><?php if($test_details_res['pvc']/100 < 40 || $test_details_res['pvc']/100 > 50){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['mvc']/100 < 83 || $test_details_res['mvc']/100 > 101){echo 'red'; } ?>">
                      <th scope="row">18</th>
                      <td>MCV (fL)</td>
                      <td>83 to 101 (fL)</td>
                      <td><?php echo $test_details_res['mvc']/100; ?> fL</td>
                      <td><?php if($test_details_res['mvc']/100 < 83 || $test_details_res['mvc']/100 > 101){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['mch']/100 < 27 || $test_details_res['mch']/100 > 32){echo 'red'; } ?>">
                      <th scope="row">19</th>
                      <td>MCH (pg)</td>
                      <td>27 to 32 (pg)</td>
                      <td><?php echo $test_details_res['mch']/100; ?> pg</td>
                      <td><?php if($test_details_res['mch']/100 < 27 || $test_details_res['mch']/100 > 32){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['mchc']/100 < 31.5 || $test_details_res['mchc']/100 > 34.5){echo 'red'; } ?>">
                      <th scope="row">20</th>
                      <td>MCHC (%)</td>
                      <td>31.5 to 34.5 (%)</td>
                      <td><?php echo $test_details_res['mchc']/100; ?> %</td>
                      <td><?php if($test_details_res['mchc']/100 < 31.5 || $test_details_res['mchc']/100 > 34.5){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['rdw']/100 < 11.6 || $test_details_res['rdw']/100 > 14){echo 'red'; } ?>">
                      <th scope="row">21</th>
                      <td>RDW (%)</td>
                      <td>11.6 to 14 (%)</td>
                      <td><?php echo $test_details_res['rdw']/100; ?> %</td>
                      <td><?php if($test_details_res['rdw']/100 < 11.6 || $test_details_res['rdw']/100 > 14){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['rdw_sd']/100 < 39 || $test_details_res['rdw_sd']/100 > 46){echo 'red'; } ?>">
                      <th scope="row">22</th>
                      <td>RDW-SD (fL)</td>
                      <td>39 to 46 (fL)</td>
                      <td><?php echo $test_details_res['rdw_sd']/100; ?> fL</td>
                      <td><?php if($test_details_res['rdw_sd']/100 < 39 || $test_details_res['rdw_sd']/100 > 46){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['nrbc']/100 < 0 || $test_details_res['nrbc']/100 > 0.6){echo 'red'; } ?>">
                      <th scope="row">23</th>
                      <td>NRBC (%)</td>
                      <td>0 to 0.6 (%)</td>
                      <td><?php echo $test_details_res['nrbc']/100; ?> %</td>
                      <td><?php if($test_details_res['nrbc']/100 < 0 || $test_details_res['nrbc']/100 > 0.6){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['cholesterol']/100 >200){echo 'red'; } ?>">
                      <th scope="row">24</th>
                      <td>Cholesterol (mg/dL)</td>
                      <td>Less Than 200 (mg/dL)</td>
                      <td><?php echo $test_details_res['cholesterol']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['cholesterol']/100 >200){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['triglyceride']/100 > 150){echo 'red'; } ?>">
                      <th scope="row">25</th>
                      <td>Triglycerides (mg/dL)</td>
                      <td>Less Than 150 (mg/dL)</td>
                      <td><?php echo $test_details_res['triglyceride']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['triglyceride']/100 > 150){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['hdl_cholesterol']/100 > 40){echo 'red'; } ?>">
                      <th scope="row">26</th>
                      <td>HDL Cholesterol (mg/dL)</td>
                      <td>Less Than 40 (mg/dL)</td>
                      <td><?php echo $test_details_res['hdl_cholesterol']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['hdl_cholesterol']/100 > 40){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['non_hdl_cholesterol']/100 >130){echo 'red'; } ?>">
                      <th scope="row">27</th>
                      <td>NON-HDL Cholesterol (mg/dL)</td>
                      <td>Less Than 130 (mg/dL)</td>
                      <td><?php echo $test_details_res['non_hdl_cholesterol']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['non_hdl_cholesterol']/100 >130){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['ldl_cholesterol']/100 > 100){echo 'red'; } ?>">
                      <th scope="row">28</th>
                      <td>LDL Cholesterol (mg/dL)</td>
                      <td>Less Than 100 (mg/dL)</td>
                      <td><?php echo $test_details_res['ldl_cholesterol']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['ldl_cholesterol']/100 > 100){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['vldl_cholesterol']/100 > 30){echo 'red'; } ?>">
                      <th scope="row">29</th>
                      <td>VLDL Cholesterol (mg/dL)</td>
                      <td>Less Than 30 (mg/dL)</td>
                      <td><?php echo $test_details_res['vldl_cholesterol']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['vldl_cholesterol']/100 > 30){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['blood_sugar_fasting']/100 < 74 || $test_details_res['blood_sugar_fasting']/100 > 99){echo 'red'; } ?>">
                      <th scope="row">30</th>
                      <td>Blood Sugar Fasting (mg/dL)</td>
                      <td>74 to 99 (mg/dL)</td>
                      <td><?php echo $test_details_res['blood_sugar_fasting']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['blood_sugar_fasting']/100 < 74 || $test_details_res['blood_sugar_fasting']/100 > 99){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['blood_sugar_pp']/100 < 74 || $test_details_res['blood_sugar_pp']/100 > 140){echo 'red'; } ?>">
                      <th scope="row">31</th>
                      <td>Blood Sugar PP (mg/dL)</td>
                      <td>74 to 140 (mg/dL)</td>
                      <td><?php echo $test_details_res['blood_sugar_pp']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['blood_sugar_pp']/100 < 74 || $test_details_res['blood_sugar_pp']/100 > 140){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['bilirubin_total']/100 < 0.2 || $test_details_res['bilirubin_total']/100 > 1.1){echo 'red'; } ?>">
                      <th scope="row">32</th>
                      <td>Bilirubin Total (mg/dL)</td>
                      <td>0.2 to 1.10 (mg/dL)</td>
                      <td><?php echo $test_details_res['bilirubin_total']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['bilirubin_total']/100 < 0.2 || $test_details_res['bilirubin_total']/100 > 1.1){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['bilirubin_direct']/100 > 0.3){echo 'red'; } ?>">
                      <th scope="row">33</th>
                      <td>Bilirubin Direct (mg/dL)</td>
                      <td>Less Than 0.30 (mg/dL)</td>
                      <td><?php echo $test_details_res['bilirubin_direct']/100; ?> mg/dL</td>
                      <td><?php if($test_details_res['bilirubin_direct']/100 > 0.3){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['bilirubin_indirect']/100 >1.1){echo 'red'; } ?>">
                      <th scope="row">34</th>
                      <td>Bilirubin Indirect (mg/dL)</td>
                      <td>Less Than 1.10 (mg/dL)</td>
                      <td><?php echo $test_details_res['bilirubin_indirect']/100; ?></td>
                      <td><?php if($test_details_res['bilirubin_indirect']/100 >1.1){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['sgot']/100 >50){echo 'red'; } ?>">
                      <th scope="row">35</th>
                      <td>SGOT (U/L)</td>
                      <td>Less Than 50 (U/L)</td>
                      <td><?php echo $test_details_res['sgot']/100; ?> U/L</td>
                      <td><?php if($test_details_res['sgot']/100 >50){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['sgpt']/100 > 50){echo 'red'; } ?>">
                      <th scope="row">36</th>
                      <td>SGPT (U/L)</td>
                      <td>Less Than 50 (U/L)</td>
                      <td><?php echo $test_details_res['sgpt']/100; ?> U/L</td>
                      <td><?php if($test_details_res['sgpt']/100 > 50){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['ggt']/100 > 55){echo 'red'; } ?>">
                      <th scope="row">37</th>
                      <td>GGT (U/L)</td>
                      <td>Less Than 55 (U/L)</td>
                      <td><?php echo $test_details_res['ggt']/100; ?> U/L</td>
                      <td><?php if($test_details_res['ggt']/100 > 55){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['alp']/100 < 30 || $test_details_res['alp']/100 > 120){echo 'red'; } ?>">
                      <th scope="row">38</th>
                      <td>ALP (U/L)</td>
                      <td>30 to 120 (U/L)</td>
                      <td><?php echo $test_details_res['alp']/100; ?> U/L</td>
                      <td><?php if($test_details_res['alp']/100 < 30 || $test_details_res['alp']/100 > 120){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['total_protein']/100 < 6.4 || $test_details_res['total_protein']/100 > 8.1){echo 'red'; } ?>">
                      <th scope="row">39</th>
                      <td>Total Protein (g/dL)</td>
                      <td>6.40 to 8.10 (g/dL)</td>
                      <td><?php echo $test_details_res['total_protein']/100; ?> g/dL</td>
                      <td><?php if($test_details_res['total_protein']/100 < 6.4 || $test_details_res['total_protein']/100 > 8.1){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['albumin']/100 < 3.2 || $test_details_res['albumin']/100 > 4.6){echo 'red'; } ?>">
                      <th scope="row">40</th>
                      <td>Albumin (g/dL)</td>
                      <td>3.20 to 4.60 (g/dL)</td>
                      <td><?php echo $test_details_res['albumin']/100; ?> g/dL</td>
                      <td><?php if($test_details_res['albumin']/100 < 3.2 || $test_details_res['albumin']/100 > 4.6){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['urea']/100 < 17 || $test_details_res['urea']/100 > 43){echo 'red'; } ?>">
                      <th scope="row">41</th>
                      <td>Urea (mg/dl)</td>
                      <td>17 to 43 (mg/dl)</td>
                      <td><?php echo $test_details_res['urea']/100; ?> mg/dl</td>
                      <td><?php if($test_details_res['urea']/100 < 17 || $test_details_res['urea']/100 > 43){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['creatinine']/100 < 0.67 || $test_details_res['creatinine']/100 > 1.17){echo 'red'; } ?>">
                      <th scope="row">42</th>
                      <td>Creatinine (mg/dl)</td>
                      <td>0.67 to 1.17 (mg/dl)</td>
                      <td><?php echo $test_details_res['creatinine']/100; ?> mg/dl</td>
                      <td><?php if($test_details_res['creatinine']/100 < 0.67 || $test_details_res['creatinine']/100 > 1.17){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['calcium_total']/100 < 8.8 || $test_details_res['calcium_total']/100 > 10.2){echo 'red'; } ?>">
                      <th scope="row">43</th>
                      <td>Calcium Total (mg/dl)</td>
                      <td>8.8 to 10.20 (mg/dl)</td>
                      <td><?php echo $test_details_res['calcium_total']/100; ?> mg/dl</td>
                      <td><?php if($test_details_res['calcium_total']/100 < 8.8 || $test_details_res['calcium_total']/100 > 10.2){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['phosphorus']/100 < 2.50 || $test_details_res['phosphorus']/100 > 4.50){echo 'red'; } ?>">
                      <th scope="row">44</th>
                      <td>Uric Acid (mg/dl)</td>
                      <td>3.5 to 7.2 (mg/dl)</td>
                      <td><?php echo $test_details_res['uric_acid']/100; ?> mg/dl</td>
                      <td><?php if($test_details_res['phosphorus']/100 < 2.50 || $test_details_res['phosphorus']/100 > 4.50){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['phosphorus']/100 < 2.50 || $test_details_res['phosphorus']/100 > 4.50){echo 'red'; } ?>">
                      <th scope="row">45</th>
                      <td>Phosphorus (mg/dl)</td>
                      <td>2.50 to 4.50 (mg/dl)</td>
                      <td><?php echo $test_details_res['phosphorus']/100; ?> mg/dl</td>
                      <td><?php if($test_details_res['phosphorus']/100 < 2.50 || $test_details_res['phosphorus']/100 > 4.50){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['sodium']/100 < 136 || $test_details_res['sodium']/100 > 145){echo 'red'; } ?>">
                      <th scope="row">46</th>
                      <td>Sodium (mEq/L)</td>
                      <td>136 to 145 (mEq/L)</td>
                      <td><?php echo $test_details_res['sodium']/100; ?> mEq/L</td>
                      <td><?php if($test_details_res['sodium']/100 < 136 || $test_details_res['sodium']/100 > 145){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['potassium']/100 < 3.5 || $test_details_res['potassium']/100 > 5.10){echo 'red'; } ?>">
                      <th scope="row">47</th>
                      <td>Potassium (mEq/L)</td>
                      <td>3.5 to 5.10 (mEq/L)</td>
                      <td><?php echo $test_details_res['potassium']/100; ?> mEq/L</td>
                      <td><?php if($test_details_res['potassium']/100 < 3.5 || $test_details_res['potassium']/100 > 5.10){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['chloride']/100 < 98 || $test_details_res['chloride']/100 > 107){echo 'red'; } ?>">
                      <th scope="row">48</th>
                      <td>Chloride (mEq/L)</td>
                      <td>98 to 107 (mEq/L)</td>
                      <td><?php echo $test_details_res['chloride']/100; ?> mEq/L</td>
                      <td><?php if($test_details_res['chloride']/100 < 98 || $test_details_res['chloride']/100 > 107){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['glycosylated_haemoglobin']/100 > 5.6 ){echo 'red'; } ?>">
                      <th scope="row">49</th>
                      <td>HbA1c(Glycosylated Haemoglobin) (%)</td>
                      <td>Less Than 5.6 (%)</td>
                      <td><?php echo $test_details_res['glycosylated_haemoglobin']/100; ?> %</td>
                      <td><?php if($test_details_res['glycosylated_haemoglobin']/100 > 5.6 ){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['t3']/100 < 0.4 || $test_details_res['t3']/100 > 1.81){echo 'red'; } ?>">
                      <th scope="row">50</th>
                      <td>T3 (ng/mL)</td>
                      <td>0.4 to 1.81 (ng/mL)</td>
                      <td><?php echo $test_details_res['t3']/100; ?> ng/mL</td>
                      <td><?php if($test_details_res['t3']/100 < 0.4 || $test_details_res['t3']/100 > 1.81){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['t4']/100 < 5.74 || $test_details_res['t4']/100 > 13.03){echo 'red'; } ?>">
                      <th scope="row">51</th>
                      <td>T4 (&microg/dL)</td>
                      <td>5.74 to 13.03 (&microg/dL)</td>
                      <td><?php echo $test_details_res['t4']/100; ?> &microg/dL</td>
                      <td><?php if($test_details_res['t4']/100 < 5.74 || $test_details_res['t4']/100 > 13.03){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['tsh']/100 < 0.34 || $test_details_res['tsh']/100 > 5.60){echo 'red'; } ?>">
                      <th scope="row">52</th>
                      <td>TSH (&microg/dL)</td>
                      <td>0.34 to 5.60 (&microg/dL)</td>
                      <td><?php echo $test_details_res['tsh']/100; ?> &microg/dL</td>
                      <td><?php if($test_details_res['tsh']/100 < 0.34 || $test_details_res['tsh']/100 > 5.60){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['crp']/100 > 5){echo 'red'; } ?>">
                      <th scope="row">53</th>
                      <td>CRP (C Reactive Protein) (mg/L)</td>
                      <td>Less Than 5 (mg/L)</td>
                      <td><?php echo $test_details_res['crp']/100; ?> mg/L</td>
                      <td><?php if($test_details_res['crp']/100 > 5){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['urine_output']/100 < 1000){echo 'red'; } ?>">
                      <th scope="row">54</th>
                      <td>24 hr Urine Output (ml)</td>
                      <td>More Than 1000 (ml)</td>
                      <td><?php echo $test_details_res['urine_output']/100; ?> ml</td>
                      <td><?php if($test_details_res['urine_output']/100 < 1000){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['level_consciousness'] == 'Altered'){echo 'red'; } ?>">
                      <th scope="row">55</th>
                      <td>LEVEL OF CONSCIOUSNESS</td>
                      <td><?php echo $test_details_res['level_consciousness']; ?></td>
                      <td>Normal</td>
                      <td><?php if($test_details_res['level_consciousness'] == 'Altered'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['swelling_feet'] == 'Yes'){echo 'red'; } ?>">
                      <th scope="row">56</th>
                      <td>Swelling on Feet</td>
                      <td>No</td>
                      <td><?php echo $test_details_res['swelling_feet']; ?></td>
                      <td><?php if($test_details_res['swelling_feet'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    <tr style="color:<?php if($test_details_res['swelling_eyes'] == 'Yes'){echo 'red'; } ?>">
                      <th scope="row">57</th>
                      <td>Swelling Under Eyes/Face</td>
                      <td>No</td>
                      <td><?php echo $test_details_res['swelling_eyes']; ?></td>
                      <td><?php if($test_details_res['swelling_eyes'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                    </tr>
                    
                  </tbody>
                </table>


                <p>Any Other complaints : <strong><?php echo $test_details_res['other_complaint']; ?></strong></p>
                    

                <?php 
                  if($record['status'] == 'pending'){
                ?>
                <form method="post" action="">
                  <div class="form-group">
                    <label for="comment">Add Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                  </div>
                  <button type="submit" name="comment-btn" class="btn btn-primary">Submit</button>
                </form>
                <?php 
                  }else{
                    ?>
                      <p>Doctor's Note : <strong><?php echo $test_details_res['comment']; ?></strong>
                    
                    <?php 
                  }
                ?>
              </div>

              <hr>
              <div style="margin-left:65%;">
                <img src="../images/sign.png" width="200" class="d-block mx-auto">
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

          <?php 
            if(isset($_POST['comment-btn'])){
              $comment = mysqli_real_escape_string($con, $_POST['comment']);

              $update_status = "UPDATE `test_payments` SET `status`='checked' WHERE `pay_id`='$pay_id'";
              $update_status_run = mysqli_query($con, $update_status);

              $add_comment = "UPDATE `test_creticare` SET `comment`='$comment' WHERE `test_id`='$test_id'";
              $add_comment_run = mysqli_query($con, $add_comment);

              if(mysqli_query($con, $update_status) && mysqli_query($con, $add_comment)){
                echo "<script>
                        alert('Test checked.');
                        window.location.href='test_submissions.php';
                      </script>";
              }

            }
          
          ?>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>&copy; 2020 by AtmaVeda Yog Pvt. Ltd. &nbsp; &nbsp;<a target="blank" href="../images/Privacy Policy.pdf">Privacy Policies</a></span>
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
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

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
</body>

<script>
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
  </script>

</html>

<?php 
      }else{
        //else part if
          echo "<script>
              alert('No record found');
              window.location.href='test_submissions.php';
          </script>";
      }

    }else{   //check if user is docor or not
      echo "<script>
            alert('Invalid Access');
            window.location.href='../index.php';
          </script>";
    }
    
    }else{
      //else part if session is not set
      echo "<script>
              window.location.href='../error/login_error.html';
            </script>";
    }
?>