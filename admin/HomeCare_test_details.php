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

  <title>Patient History</title>

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
              <div class="row mb-4">
                  <div class="col-md-4">
                      <b>Name :</b> <?php echo $user_detail['name']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>Father's Name :</b> <?php echo $user_detail['father_name']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>Contact :</b> <?php echo $user_detail['contact_no']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>Email :</b> <?php echo $user_detail['email_id']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>Gender :</b> <?php echo $user_detail['gender']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>DOB :</b> <?php echo date("d-m-Y", strtotime($user_detail['dob'])); ?>
                  </div>
                  <div class="col-md-4">
                      <b>Married :</b> <?php echo $user_detail['married']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>Working :</b> <?php echo $user_detail['working']; ?>
                  </div>
                  <div class="col-md-4">
                      <b>Address :</b> <?php echo $user_detail['address']; ?>
                  </div>
              </div>
            
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
                    <th scope="col">Question</th>
                    <th scope="col">Normal Range</th>
                    <th scope="col">User Answer</th>
                    <th scope="col">Alert</th>
                  </tr>
                </thead>
                <tbody>
                  <tr style="color:<?php if($test_details_res['SPO2']/100 < 95 || $test_details_res['SPO2']/100 > 100){echo 'red'; } ?>">
                    <th scope="row">1</th>
                    <td>Pulse-ox Reading Of SPO2 (%)</td>
                    <td>95% to 100%</td>
                    <td><?php echo $test_details_res['SPO2']/100; ?> %</td>
                    <td><?php if($test_details_res['SPO2']/100 >= 91 && $test_details_res['SPO2']/100 <= 94){ echo 'Alert'; }else if($test_details_res['SPO2']/100 >= 85 && $test_details_res['SPO2']/100 <= 90){ echo "High Risk"; }else if($test_details_res['SPO2']/100 >= 80 && $test_details_res['SPO2']/100 <= 84){ echo "Intensive Care"; }else if($test_details_res['SPO2']/100 < 85){ echo "Very Critical"; }else{ echo "Normal"; } ?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['s_blod_pressure']/100 < 100 || $test_details_res['s_blod_pressure']/100 > 140){echo 'red'; } ?>">
                    <th scope="row">2</th>
                    <td>Systolic Blood Pressure (mm/Hg)</td>
                    <td>100 to 140 (mm/Hg)</td>
                    <td><?php echo $test_details_res['s_blod_pressure']/100; ?> mm/Hg</td>
                    <td><?php if($test_details_res['s_blod_pressure']/100 < 80 || $test_details_res['s_blod_pressure']/100 > 160){ echo 'High Risk'; }else if($test_details_res['s_blod_pressure']/100 < 100 || $test_details_res['s_blod_pressure']/100 > 140){ echo "Alert"; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['d_blod_pressure']/100 < 70 || $test_details_res['d_blod_pressure']/100 > 90){echo 'red'; } ?>">
                    <th scope="row">3</th>
                    <td>Diastolic Blood Pressure (mm/Hg)</td>
                    <td>70 to 90 (mm/Hg)</td>
                    <td><?php echo $test_details_res['d_blod_pressure']/100; ?> mm/Hg</td>
                    <td><?php if($test_details_res['s_blod_pressure']/100 < 50 || $test_details_res['s_blod_pressure']/100 > 100){ echo 'High Risk'; }else if($test_details_res['s_blod_pressure']/100 < 60 || $test_details_res['s_blod_pressure']/100 > 90){ echo "Alert"; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['pulse_rate']/100 < 70 || $test_details_res['pulse_rate']/100 > 80){echo 'red'; } ?>">
                    <th scope="row">4</th>
                    <td>Pulse Rate (beat/min)</td>
                    <td>70 to 80 (beat/min)</td>
                    <td><?php echo $test_details_res['pulse_rate']/100; ?> beat/min</td>
                    <td><?php if($test_details_res['pulse_rate']/100 < 70){ echo 'Low Pulse Rate'; }else if($test_details_res['pulse_rate']/100 > 80){ echo 'High Pulse Rate'; }else{ echo "Normal"; }?></td>
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
                    <td><?php if($test_details_res['oral_temp']/100 > 102){ echo 'Very High'; }else if($test_details_res['oral_temp']/100 > 100){ echo 'High'; }else if($test_details_res['oral_temp']/100 > 98.4){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['drink_water']/100 < 2){echo 'red'; } ?>">
                  <th scope="row">7</th>
                    <td>How much water did he drink in last 24 hours (in Liter)</td>
                    <td>More than 2 (Litre) </td>
                    <td><?php echo $test_details_res['drink_water']/100; ?> Litre</td>
                    <td><?php if($test_details_res['drink_water']/100 < 2){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['headache'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">8</th>
                    <td>Do you have headache today</td>
                    <td> - </td>
                    <td><?php echo $test_details_res['headache']; ?></td>
                    <td><?php if($test_details_res['headache'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['bodyache'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">9</th>
                    <td>Do you have bodyache today</td>
                    <td> - </td>
                    <td><?php echo $test_details_res['bodyache']; ?></td>
                    <td><?php if($test_details_res['bodyache'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['cough'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">10</th>
                    <td>Do you have cough today</td>
                    <td> - </td>
                    <td><?php echo $test_details_res['cough']; ?></td>
                    <td><?php if($test_details_res['cough'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['cold'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">11</th>
                    <td>Do you have cold today</td>
                    <td> - </td>
                    <td><?php echo $test_details_res['cold']; ?></td>
                    <td><?php if($test_details_res['cold'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['fever'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">12</th>
                    <td>Did you have fever  yesterday</td>
                    <td> - </td>
                    <td><?php echo $test_details_res['fever']; ?></td>
                    <td><?php if($test_details_res['fever'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['weakness'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">13</th>
                    <td>Are you feeling weakness today</td>
                    <td> - </td>
                    <td><?php echo $test_details_res['weakness']; ?></td>
                    <td><?php if($test_details_res['weakness'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                  <tr style="color:<?php if($test_details_res['loose_motion'] == 'Yes'){echo 'red'; } ?>">
                    <th scope="row">14</th>
                    <td>Are you having loose motions </td>
                    <td> - </td>
                    <td><?php echo $test_details_res['loose_motion']; ?></td>
                    <td><?php if($test_details_res['loose_motion'] == 'Yes'){ echo 'Alert'; }else{ echo "Normal"; }?></td>
                  </tr>
                </tbody>
              </table>

              <p >Any other complaints? : <b><?php echo $test_details_res['other_complaint']; ?></b></p>
              <p class="h5 text-danger">
              Comment : 
              <b>
              <?php 
                  if(($test_details_res['pulse_rate']/100 >= 70 && $test_details_res['pulse_rate']/100 <= 80) && ($test_details_res['SPO2']/100 < 95 || $test_details_res['oral_temp']/100 > 98.4 || $test_details_res['respiration_rate']/100 > 16)){
                    echo "Possibility of Apparatus error needs to be ruled out OR Contact your doctor.";
                  }else{
                    echo " No Comment ";
                  }
              
              ?>
              </b></p>

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
            </div>
            <!-- printable Area -->
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