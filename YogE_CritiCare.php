<?php 
    session_start();
    include("includes/db.php");

    if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];

      if(isset($_GET['orderId'])){
        $order_id=$_GET['orderId'];

        $check_availability_of_test = "SELECT `pay_id`, `test_type` FROM `test_payments` WHERE `order_id`='$order_id' AND `test_id` IS NULL";
        $check_availability_of_test_run = mysqli_query($con, $check_availability_of_test);
        $check_availability_of_test_rows = mysqli_num_rows($check_availability_of_test_run);
        $check_availability_of_test_res = mysqli_fetch_assoc($check_availability_of_test_run);
        //check for payment is done and test is not given
        if($check_availability_of_test_rows > 0){

          $user_details = "SELECT * FROM `user` u, `medical_history` m where u.`user_id` = m.`user_id` AND u.`user_id`='$user_id'";
          $user_details_run = mysqli_query($con, $user_details);
          $user_details_res = mysqli_fetch_assoc($user_details_run);

          // Check for remaining tests
          $check_remaining_tests = "SELECT * FROM `test_payments` WHERE `user_id`='$user_id' AND `test_id` IS NULL GROUP BY `test_type`";
          $check_remaining_tests_run = mysqli_query($con, $check_remaining_tests);
          $check_remaining_tests_rows = mysqli_num_rows($check_remaining_tests_run);
          $tests = array(0,0,0,0,0,0);
          while($check_remaining_tests_res = mysqli_fetch_assoc($check_remaining_tests_run)){
            $index = $check_remaining_tests_res['test_type'];
            $tests[$index] = $check_remaining_tests_res['order_id'];
          }

          if($user_details_res['problems'] == ""){
              echo "<script>
                      alert('Please first Fill the details.');
                      window.location.href='update_details.php';
                  </script>";
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

  <title>YOG-E CritiCare Daily Test</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- custom style sheet for sidebar and navigation bar -->
  <link rel="stylesheet" href="admin/css/sidebar.css">

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
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Treatments & Reports</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Treatment History:</h6>
            <a class="collapse-item" href="all_consultations.php">All Consultations</a>
            <a class="collapse-item" href="all_test.php">All Tests & Report</a>
            <a class="collapse-item" href="ongoing_treatments.php">Treatments & Report</a>
            <a class="collapse-item" href="past_treatments.php">Past Treatments & Report</a>
          </div>
        </div>
      </li>

      <!-- Tests  --> 
      <?php
        if($check_remaining_tests_rows > 0){
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#incompleteTest" aria-expanded="true"
          aria-controls="incompleteTest">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Incomplete Tests</span>
        </a>
        <div id="incompleteTest" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Incomplete Tests:</h6>
            <?php if($tests[1] !== 0) { ?><a class="collapse-item <?php if($check_availability_of_test_res['test_type'] == 1){ echo 'active'; } ?>" href="YogE_rakshakavach.php?orderId=<?php echo $tests[1]; ?>">YOG-E@Rakshakavach <br>Basic</a><?php } ?>
            <?php if($tests[2] !== 0) { ?><a class="collapse-item" href="YogE_HomeCare.php?orderId=<?php echo $tests[2]; ?>">YOG-E@HomeCare</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item active" href="YogE_CritiCare.php?orderId=<?php echo $tests[3]; ?>">YOG-E@CritiCare</a><?php } ?>
            <?php if($tests[4] !== 0) { ?><a class="collapse-item" href="YogE_Antropometry.php?orderId=<?php echo $tests[4]; ?>">YOG-E@Anthropometry</a><?php } ?>
            <?php if($tests[5] !== 0) { ?><a class="collapse-item <?php if($check_availability_of_test_res['test_type'] == 5){ echo 'active'; } ?>" href="YogE_rakshakavach.php?orderId=<?php echo $tests[5]; ?>">YOG-E@Rakshakavach <br>Advanced</a><?php } ?>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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
        <div class="container-fluid main-left">
          <form method="post">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">YOG-E@CritiCareDailyTest</h1>
            <p>YOG-E CritiCare Daily test is best suited for those critical patients who donot get facility of hospitalization or who cannot avail hospital bed. It also helps in management of terminally iill critical patinets at home. This test helps to decrease load on hospital infrastructure and also helps patients to save huge amount of money.</p>
            <ol>
              <li>Enter the data from the hospital records of the patient under whose name the test is being done.</li>
              <li>Enter the data form the diagnostic reports  of current date or latest reports</li>
              <li>If any problem for entering data kindly contat us on whats app no. 8208537972.</li>
              <li>We will assist you if you send the pictures of the reports, our team member will enter the date on your behalf, so you need not be worried.</li>
              <li>If any help needed contact us on helpdesk@atmavedayog.com</li>
            </ol>
            <hr>
            <h1 class="h5 text-gray-800">Personal Details</h1>
            <div class="form-row mt-4">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="<?php echo $user_details_res['email_id']; ?>" id="email"
                  aria-describedby="emailHelp" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Your WhatsApp Number</label>
                <input type="text" class="form-control" name="contact" value="<?php echo $user_details_res['contact_no']; ?>" id="number" disabled>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Your Name</label>
                <input type="text" class="form-control"name="name"  value="<?php echo $user_details_res['name']; ?>" id="name" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Your husband's / father's name</label>
                <input type="text" class="form-control" name="father_name" value="<?php echo $user_details_res['father_name']; ?>" id="f_name" disabled>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputState">Gender</label>
                <select id="inputState" name="gender" class="form-control" disabled>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Male" <?php if($user_details_res['gender']=="Male") echo 'selected="selected"'; ?>>Male</option>
                  <option value="Female" <?php if($user_details_res['gender']=="Female") echo 'selected="selected"'; ?>>Female</option>
                  <option value="Other" <?php if($user_details_res['gender']=="Other") echo 'selected="selected"'; ?>>Other</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputCity">Are you working?</label>
                <select id="inputState" name="working" class="form-control" disabled>
                  <option selected disabled hidden>Choose...</option>
                  <option value="YES" <?php if($user_details_res['working']=="YES") echo 'selected="selected"'; ?>>Yes</option>
                  <option value="NO" <?php if($user_details_res['working']=="NO") echo 'selected="selected"'; ?>>No</option>
                  <option value="Work From Home" <?php if($user_details_res['working']=="Work From Home") echo 'selected="selected"'; ?>>Work From Home</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputState">Date of Birth</label>
                <input class="form-control" type="date" name="dob" value="<?php if($user_details_res['dob'] != ''){ echo strftime('%Y-%m-%d', strtotime($user_details_res['dob']));} ?>" disabled/>
              </div>
              <div class="form-group col-md-3">
                <label for="inputZip">Maritial Status</label>
                <select id="maritial_status" name="married" class="form-control" disabled>
                  <option selected disabled hidden>Choose...</option>
                  <option value="YES" <?php if($user_details_res['married']=="YES") echo 'selected="selected"'; ?>>married</option>
                  <option value="NO" <?php if($user_details_res['married']=="NO") echo 'selected="selected"'; ?>>unmarried</option>
                  <option value="Other" <?php if($user_details_res['married']=="Other") echo 'selected="selected"'; ?>>other</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="address">Residential postal address</label>
              <textarea class="form-control" name="address" id="address" rows="3" disabled><?php echo $user_details_res['address']; ?></textarea>
            </div>

            <small style="font-size:11px;">* ABOVE DETAILS ARE FROM DATABASE, IF ANYTHING CHANGE IN IT THEN PLEASE UPDATE YOUR DETAILS.</small>
            
            <hr>    
        
            <div class="form-group">
                <label for="hospital_name">If a Hospitalized Case Then Name Of Hospital And IPD No. </label>
                <input type="text" class="form-control" name="hospital_name" id="hospital_name" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="covid_test">COVID-19 Testing Done</label>
                <select id="covid_test" name="covid_test" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="YES">Yes</option>
                  <option value="NO">No</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="covid_report">COVID-19 Test Rrport</label>
                <select id="covid_report" name="covid_report" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Positive">Positive</option>
                  <option value="Negative">Negative</option>
                </select>
              </div>
            </div>

            <div class="form-group">
                <label for="prescription_paper">Diagnosis as written on hospital/prescription paper</label>
                <textarea class="form-control" name="prescription_paper" id="prescription_paper" rows="3" required></textarea>
                <!-- <input type="text" class="form-control" name="prescription_paper" id="prescription_paper" required> -->
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="SPO2">Pulse-ox Reading Of SPO2 (%)</label>
                <input type="text" class="form-control" name="SPO2" id="SPO2" required>
              </div>
              <div class="form-group col-md-4">
                <label for="s_blod_pressure">Systolic Blood Pressure (mm/Hg)</label>
                <input type="text" class="form-control" name="s_blod_pressure" id="s_blod_pressure" required>
              </div>
              <div class="form-group col-md-4">
                <label for="d_blod_pressure">Diastolic Blood Pressure (mm/Hg)</label>
                <input type="text" class="form-control" name="d_blod_pressure" id="d_blod_pressure" required>
              </div>
              <div class="form-group col-md-4">
                <label for="pulse_rate">Pulse Rate (beat/min)</label>
                <input type="text" class="form-control" name="pulse_rate" id="pulse_rate" required>
              </div>
              <div class="form-group col-md-4">
                <label for="respiration_rate">Respiration Rate(per min)</label>
                <input type="text" class="form-control" name="respiration_rate" id="respiration_rate" required>
              </div>
              <div class="form-group col-md-4">
                <label for="oral_temp">Oral body Temperature (<sup>0</sup>F)</label>
                <input type="text" class="form-control" name="oral_temp" id="oral_temp" required>
                <p style="margin-top:-3px; margin-bottom:-4px"><small>(Axillary temp if patient intubated)*</small></p>
              </div>
              <div class="form-group col-md-4">
                <label for="haemoglobin">Haemoglobin (gm%)</label>
                <input type="text" class="form-control" name="haemoglobin" id="haemoglobin" required>
              </div>
              <div class="form-group col-md-4">
                <label for="wbc_count">WBC Count (per c.mm)</label>
                <input type="text" class="form-control" name="wbc_count" id="wbc_count" required>
              </div>
              <div class="form-group col-md-4">
                <label for="polymorphs">Polymorphs (%)</label>
                <input type="text" class="form-control" name="polymorphs" id="polymorphs" required>
              </div>
              <div class="form-group col-md-4">
                <label for="lymphocytes">Lymphocytes (%)</label>
                <input type="text" class="form-control" name="lymphocytes" id="lymphocytes" required>
              </div>
              <div class="form-group col-md-4">
                <label for="monocytes">Monocytes (%)</label>
                <input type="text" class="form-control" name="monocytes" id="monocytes" required>
              </div>
              <div class="form-group col-md-4">
                <label for="eosinophils">Eosinophils (%)</label>
                <input type="text" class="form-control" name="eosinophils" id="eosinophils" required>
              </div>
              <div class="form-group col-md-4">
                <label for="basophils">Basophils (%)</label>
                <input type="text" class="form-control" name="basophils" id="basophils" required>
              </div>
              <div class="form-group col-md-4">
                <label for="platelet_count">Platelet Count (PER C. MM)</label>
                <input type="text" class="form-control" name="platelet_count" id="platelet_count" required>
              </div>
              <div class="form-group col-md-4">
                <label for="mvp">MPV (PER C. MM)</label>
                <input type="text" class="form-control" name="mvp" id="mvp" required>
              </div>
            </div>
            
            <hr>
            
            <div class="row">
              <div class="form-group col-md-4">
                <label for="rbc_count">RBC Count (MILL/C.MM)</label>
                <input type="text" class="form-control" name="rbc_count" id="rbc_count" required>
              </div>
              <div class="form-group col-md-4">
                <label for="pvc">PCV / HCT (%)</label>
                <input type="text" class="form-control" name="pvc" id="pvc" required>
              </div>
              <div class="form-group col-md-4">
                <label for="mvc">MCV (fL)</label>
                <input type="text" class="form-control" name="mvc" id="mvc" required>
              </div>
              <div class="form-group col-md-4">
                <label for="mch">MCH (pg)</label>
                <input type="text" class="form-control" name="mch" id="mch" required>
              </div>
              <div class="form-group col-md-4">
                <label for="mchc">MCHC (%)</label>
                <input type="text" class="form-control" name="mchc" id="mchc" required>
              </div>
              <div class="form-group col-md-4">
                <label for="rdw">RDW (%)</label>
                <input type="text" class="form-control" name="rdw" id="rdw" required>
              </div>
              <div class="form-group col-md-4">
                <label for="rdw_sd">RDW-SD (fL)</label>
                <input type="text" class="form-control" name="rdw_sd" id="rdw_sd" required>
              </div>
              <div class="form-group col-md-4">
                <label for="nrbc">NRBC (%)</label>
                <input type="text" class="form-control" name="nrbc" id="nrbc" required>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="form-group col-md-4">
                <label for="cholesterol">Cholesterol (mg/dL)</label>
                <input type="text" class="form-control" name="cholesterol" id="cholesterol" required>
              </div>
              <div class="form-group col-md-4">
                <label for="triglyceride">Triglycerides (mg/dL)</label>
                <input type="text" class="form-control" name="triglyceride" id="triglyceride" required>
              </div>
              <div class="form-group col-md-4">
                <label for="hdl_cholesterol">HDL Cholesterol (mg/dL)</label>
                <input type="text" class="form-control" name="hdl_cholesterol" id="hdl_cholesterol" required>
              </div>
              <div class="form-group col-md-4">
                <label for="non_hdl_cholesterol">NON-HDL Cholesterol (mg/dL)</label>
                <input type="text" class="form-control" name="non_hdl_cholesterol" id="non_hdl_cholesterol" required>
              </div>
              <div class="form-group col-md-4">
                <label for="ldl_cholesterol">LDL Cholesterol (mg/dL)</label>
                <input type="text" class="form-control" name="ldl_cholesterol" id="ldl_cholesterol" required>
              </div>
              <div class="form-group col-md-4">
                <label for="vldl_cholesterol">VLDL Cholesterol (mg/dL)</label>
                <input type="text" class="form-control" name="vldl_cholesterol" id="vldl_cholesterol" required>
              </div>
              <div class="form-group col-md-4">
                <label for="blood_sugar_fasting">Blood Sugar Fasting (mg/dL)</label>
                <input type="text" class="form-control" name="blood_sugar_fasting" id="blood_sugar_fasting" required>
              </div>
              <div class="form-group col-md-4">
                <label for="blood_sugar_pp">Blood Sugar PP (mg/dL)</label>
                <input type="text" class="form-control" name="blood_sugar_pp" id="blood_sugar_pp" required>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="form-group col-md-4">
                <label for="bilirubin_total">Bilirubin Total (mg/dL)</label>
                <input type="text" class="form-control" name="bilirubin_total" id="bilirubin_total" required>
              </div>
              <div class="form-group col-md-4">
                <label for="bilirubin_direct">Bilirubin Direct (mg/dL)</label>
                <input type="text" class="form-control" name="bilirubin_direct" id="bilirubin_direct" required>
              </div>
              <div class="form-group col-md-4">
                <label for="bilirubin_indirect">Bilirubin Indirect (mg/dL)</label>
                <input type="text" class="form-control" name="bilirubin_indirect" id="bilirubin_indirect" required>
              </div>
              <div class="form-group col-md-4">
                <label for="sgot">SGOT (U/L)</label> 
                <input type="text" class="form-control" name="sgot" id="sgot" required>
              </div>
              <div class="form-group col-md-4">
                <label for="sgpt">SGPT (U/L)</label>
                <input type="text" class="form-control" name="sgpt" id="sgpt" required>
              </div>
              <div class="form-group col-md-4">
                <label for="ggt">GGT (U/L)</label>
                <input type="text" class="form-control" name="ggt" id="ggt" required>
              </div>
              <div class="form-group col-md-4">
                <label for="alp">ALP (U/L)</label>
                <input type="text" class="form-control" name="alp" id="alp" required>
              </div>
              <div class="form-group col-md-4">
                <label for="total_protein">Total Protein (g/dL)</label>
                <input type="text" class="form-control" name="total_protein" id="total_protein" required>
              </div>
              <div class="form-group col-md-4">
                <label for="albumin">Albumin (g/dL)</label>
                <input type="text" class="form-control" name="albumin" id="albumin" required>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="form-group col-md-4">
                <label for="urea">Urea (mg/dl)</label>
                <input type="text" class="form-control" name="urea" id="urea" required>
              </div>
              <div class="form-group col-md-4">
                <label for="creatinine">Creatinine (mg/dl)</label>
                <input type="text" class="form-control" name="creatinine" id="creatinine" required>
              </div>
              <div class="form-group col-md-4">
                <label for="calcium_total">Calcium Total (mg/dl)</label>
                <input type="text" class="form-control" name="calcium_total" id="calcium_total" required>
              </div>
              <div class="form-group col-md-4">
                <label for="uric_acid">Uric Acid (mg/dl)</label>
                <input type="text" class="form-control" name="uric_acid" id="uric_acid" required>
              </div>
              <div class="form-group col-md-4">
                <label for="phosphorus">Phosphorus (mg/dl)</label>
                <input type="text" class="form-control" name="phosphorus" id="phosphorus" required>
              </div>
              <div class="form-group col-md-4">
                <label for="sodium">Sodium (mEq/L)</label>
                <input type="text" class="form-control" name="sodium" id="sodium" required>
              </div>
              <div class="form-group col-md-4">
                <label for="potassium">Potassium (mEq/L)</label>
                <input type="text" class="form-control" name="potassium" id="potassium" required>
              </div>
              <div class="form-group col-md-4">
                <label for="chloride">Chloride (mEq/L)</label>
                <input type="text" class="form-control" name="chloride" id="chloride" required>
              </div>
              <div class="form-group col-md-4">
                <label for="glycosylated_haemoglobin">HbA1c(Glycosylated Haemoglobin) (%)</label>
                <input type="text" class="form-control" name="glycosylated_haemoglobin" id="glycosylated_haemoglobin" required>
              </div>
              <div class="form-group col-md-4">
                <label for="t3">T3 (ng/mL)</label>
                <input type="text" class="form-control" name="t3" id="t3" required>
              </div>
              <div class="form-group col-md-4">
                <label for="t4">T4 (&microg/dL)</label>
                <input type="text" class="form-control" name="t4" id="t4" required>
              </div>
              <div class="form-group col-md-4">
                <label for="tsh">TSH (&microg/dL)</label>
                <input type="text" class="form-control" name="tsh" id="tsh" required>
              </div>
              <div class="form-group col-md-4">
                <label for="crp">CRP (C Reactive Protein) (mg/L)</label>
                <input type="text" class="form-control" name="crp" id="crp" required>
              </div>
              <div class="form-group col-md-4">
                <label for="urine_output">24 hr Urine Output (ml)</label>
                <input type="text" class="form-control" name="urine_output" id="urine_output" required>
              </div>
              <div class="form-group col-md-4">
                <label for="level_consciousness">LEVEL OF CONSCIOUSNESS</label>
                <select id="level_consciousness" name="level_consciousness" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Normal">Normal</option>
                  <option value="Altered">Altered</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="swelling_feet">Swelling on Feet</label>
                <select id="swelling_feet" name="swelling_feet" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="swelling_eyes">Swelling Under Eyes/Face</label>
                <select id="swelling_eyes" name="swelling_eyes" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>
              
            <div class="form-group">
              <label for="other_complaint">Any other complaints ?</label>
              <textarea class="form-control" name="other_complaint" id="other_complaint" rows="3"></textarea>
            </div>

            <button type="submit" name="submit_test" class="btn btn-primary">Submit Test</button>
          </form>
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

<?php 

    if(isset($_POST['submit_test'])){
      $hospital_name        = mysqli_real_escape_string($con, $_POST['hospital_name']);
      $covid_test           = mysqli_real_escape_string($con, $_POST['covid_test']);
      $covid_report         = mysqli_real_escape_string($con, $_POST['covid_report']);
      $prescription_paper   = mysqli_real_escape_string($con, $_POST['prescription_paper']);
      $SPO2                 = mysqli_real_escape_string($con, $_POST['SPO2'])*100;
      $s_blod_pressure      = mysqli_real_escape_string($con, $_POST['s_blod_pressure'])*100;
      $d_blod_pressure      = mysqli_real_escape_string($con, $_POST['d_blod_pressure'])*100;
      $pulse_rate           = mysqli_real_escape_string($con, $_POST['pulse_rate'])*100;
      $respiration_rate     = mysqli_real_escape_string($con, $_POST['respiration_rate'])*100;
      $oral_temp            = mysqli_real_escape_string($con, $_POST['oral_temp'])*100;
      $haemoglobin          = mysqli_real_escape_string($con, $_POST['haemoglobin'])*100;
      $wbc_count            = mysqli_real_escape_string($con, $_POST['wbc_count'])*100;
      $polymorphs           = mysqli_real_escape_string($con, $_POST['polymorphs'])*100;
      $lymphocytes          = mysqli_real_escape_string($con, $_POST['lymphocytes'])*100;
      $monocytes            = mysqli_real_escape_string($con, $_POST['monocytes'])*100;
      $eosinophils          = mysqli_real_escape_string($con, $_POST['eosinophils'])*100;
      $basophils            = mysqli_real_escape_string($con, $_POST['basophils'])*100;
      $platelet_count       = mysqli_real_escape_string($con, $_POST['platelet_count'])*100;
      $mvp                  = mysqli_real_escape_string($con, $_POST['mvp'])*100;
      $rbc_count            = mysqli_real_escape_string($con, $_POST['rbc_count'])*100;
      $pvc                  = mysqli_real_escape_string($con, $_POST['pvc'])*100;
      $mvc                  = mysqli_real_escape_string($con, $_POST['mvc'])*100;       
      $mch                  = mysqli_real_escape_string($con, $_POST['mch'])*100;
      $mchc                 = mysqli_real_escape_string($con, $_POST['mchc'])*100;
      $rdw                  = mysqli_real_escape_string($con, $_POST['rdw'])*100;
      $rdw_sd               = mysqli_real_escape_string($con, $_POST['rdw_sd'])*100;
      $nrbc                 = mysqli_real_escape_string($con, $_POST['nrbc'])*100;
      $cholesterol          = mysqli_real_escape_string($con, $_POST['cholesterol'])*100;
      $triglyceride         = mysqli_real_escape_string($con, $_POST['triglyceride'])*100;
      $hdl_cholesterol      = mysqli_real_escape_string($con, $_POST['hdl_cholesterol'])*100;
      $non_hdl_cholesterol  = mysqli_real_escape_string($con, $_POST['non_hdl_cholesterol'])*100;
      $ldl_cholesterol      = mysqli_real_escape_string($con, $_POST['ldl_cholesterol'])*100;
      $vldl_cholesterol     = mysqli_real_escape_string($con, $_POST['vldl_cholesterol'])*100;
      $blood_sugar_fasting  = mysqli_real_escape_string($con, $_POST['blood_sugar_fasting'])*100;
      $blood_sugar_pp       = mysqli_real_escape_string($con, $_POST['blood_sugar_pp'])*100;
      $bilirubin_total      = mysqli_real_escape_string($con, $_POST['bilirubin_total'])*100;
      $bilirubin_direct     = mysqli_real_escape_string($con, $_POST['bilirubin_direct'])*100;
      $bilirubin_indirect   = mysqli_real_escape_string($con, $_POST['bilirubin_indirect'])*100;
      $sgot                 = mysqli_real_escape_string($con, $_POST['sgot'])*100;
      $sgpt                 = mysqli_real_escape_string($con, $_POST['sgpt'])*100;
      $ggt                  = mysqli_real_escape_string($con, $_POST['ggt'])*100;
      $alp                  = mysqli_real_escape_string($con, $_POST['alp'])*100;
      $total_protein        = mysqli_real_escape_string($con, $_POST['total_protein'])*100;
      $albumin              = mysqli_real_escape_string($con, $_POST['albumin'])*100;
      $urea                 = mysqli_real_escape_string($con, $_POST['urea'])*100;
      $creatinine           = mysqli_real_escape_string($con, $_POST['creatinine'])*100;
      $calcium_total        = mysqli_real_escape_string($con, $_POST['calcium_total'])*100;
      $uric_acid            = mysqli_real_escape_string($con, $_POST['uric_acid'])*100;
      $phosphorus           = mysqli_real_escape_string($con, $_POST['phosphorus'])*100;
      $sodium               = mysqli_real_escape_string($con, $_POST['sodium'])*100;
      $potassium            = mysqli_real_escape_string($con, $_POST['potassium'])*100;
      $chloride             = mysqli_real_escape_string($con, $_POST['chloride'])*100;
      $glycosylated_haemoglobin = mysqli_real_escape_string($con, $_POST['glycosylated_haemoglobin'])*100;
      $t3                   = mysqli_real_escape_string($con, $_POST['t3'])*100;
      $t4                   = mysqli_real_escape_string($con, $_POST['t4'])*100;
      $tsh                  = mysqli_real_escape_string($con, $_POST['tsh'])*100;
      $crp                  = mysqli_real_escape_string($con, $_POST['crp'])*100;
      $urine_output         = mysqli_real_escape_string($con, $_POST['urine_output'])*100;
      $level_consciousness  = mysqli_real_escape_string($con, $_POST['level_consciousness']);
      $swelling_feet        = mysqli_real_escape_string($con, $_POST['swelling_feet']);
      $swelling_eyes        = mysqli_real_escape_string($con, $_POST['swelling_eyes']);
      $other_complaint      = mysqli_real_escape_string($con, $_POST['other_complaint']);


        $test_id = md5(time().$user_id);

        $get_latest_test_no = "SELECT max(`criticare_test_no`) AS last_test FROM `test_creticare`";
        $get_latest_test_no_run = mysqli_query($con, $get_latest_test_no);
        $get_latest_test_no_res = mysqli_fetch_assoc($get_latest_test_no_run);

        $current_test_no = $get_latest_test_no_res['last_test'] + 1;

        $insert_value = "INSERT INTO `test_creticare`(`test_id`, `criticare_test_no`, `hospital_name`, `covid_test`, `covid_report`, `prescription_paper`, `SPO2`, `s_blod_pressure`, `d_blod_pressure`, `pulse_rate`, `respiration_rate`, `oral_temp`, `haemoglobin`, `wbc_count`, `polymorphs`, `lymphocytes`, `monocytes`, `eosinophils`, `basophils`, `platelet_count`, `mvp`, `rbc_count`, `pvc`, `mvc`, `mch`, `mchc`, `rdw`, `rdw_sd`, `nrbc`, `cholesterol`, `triglyceride`, `hdl_cholesterol`, `non_hdl_cholesterol`, `ldl_cholesterol`, `vldl_cholesterol`, `blood_sugar_fasting`, `blood_sugar_pp`, `bilirubin_total`, `bilirubin_direct`, `bilirubin_indirect`, `sgot`, `sgpt`, `ggt`, `alp`, `total_protein`, `albumin`, `urea`, `creatinine`, `calcium_total`, `uric_acid`, `phosphorus`, `sodium`, `potassium`, `chloride`, `glycosylated_haemoglobin`, `t3`, `t4`, `tsh`, `crp`, `urine_output`, `level_consciousness`, `swelling_feet`, `swelling_eyes`, `other_complaint`) 
                          VALUES ('$test_id', '$current_test_no', '$hospital_name', '$covid_test', '$covid_report', '$prescription_paper', '$SPO2', '$s_blod_pressure', '$d_blod_pressure', '$pulse_rate', '$respiration_rate', '$oral_temp', '$haemoglobin', '$wbc_count', '$polymorphs', '$lymphocytes', '$monocytes', '$eosinophils', '$basophils', '$platelet_count', '$mvp', '$rbc_count', '$pvc', '$mvc', '$mch', '$mchc', '$rdw', '$rdw_sd', '$nrbc', '$cholesterol', '$triglyceride', '$hdl_cholesterol', '$non_hdl_cholesterol', '$ldl_cholesterol', '$vldl_cholesterol', '$blood_sugar_fasting', '$blood_sugar_pp', '$bilirubin_total', '$bilirubin_direct', '$bilirubin_indirect', '$sgot', '$sgpt', '$ggt', '$alp', '$total_protein', '$albumin', '$urea', '$creatinine', '$calcium_total', '$uric_acid', '$phosphorus', '$sodium', '$potassium', '$chloride', '$glycosylated_haemoglobin', '$t3', '$t4', '$tsh', '$crp', '$urine_output', '$level_consciousness', '$swelling_feet', '$swelling_eyes', '$other_complaint')";

        if($insert_value_run = mysqli_query($con, $insert_value))//{
          $update_test_payment = "UPDATE `test_payments` SET `test_id`='$test_id' WHERE `order_id`='$order_id'";
          if($update_test_payment_run = mysqli_query($con, $update_test_payment))

            echo "<script>
                    //alert('your test is submitted sucessfully, Doctor will contact you soon. You can see your test receipt in All test section.');
                    window.location.href='all_test.php';
                </script>";
          // }

    }

?>

<?php 
}else{        //check for payment is done and test is not given
  echo "<script>
        alert('No record Found');
        window.location.href='user_page.php';
      </script>";
}
  }else{      //else part for invalid access
    echo "<script>
            alert('Invalid Token');
            window.location.href='user_page.php';
      </script>";
  }
    }else{    //else part for session not
      echo "<script>
            window.location.href='error/login_error.html';
      </script>";
    }

?>