<?php 
    session_start();
    include("includes/db.php");

    if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];

      if(isset($_GET['orderId'])){
        $order_id=$_GET['orderId'];

        $check_availability_of_test = "SELECT `pay_id` FROM `test_payments` WHERE `order_id`='$order_id' AND `test_id` IS NULL";
        $check_availability_of_test_run = mysqli_query($con, $check_availability_of_test);
        $check_availability_of_test_rows = mysqli_num_rows($check_availability_of_test_run);
        //check for payment is done and test is not given
        if($check_availability_of_test_rows > 0){

          $user_details = "SELECT * FROM `user` u, `medical_history` m where u.`user_id` = m.`user_id` AND u.`user_id`='$user_id'";
          $user_details_run = mysqli_query($con, $user_details);
          $user_details_res = mysqli_fetch_assoc($user_details_run);

          // Check for remaining tests
          $check_remaining_tests = "SELECT * FROM `test_payments` WHERE `user_id`='$user_id' AND `test_id` IS NULL GROUP BY `test_type`";
          $check_remaining_tests_run = mysqli_query($con, $check_remaining_tests);
          $check_remaining_tests_rows = mysqli_num_rows($check_remaining_tests_run);
          $tests = array(0,0,0,0,0);
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

  <title>Edit Question</title>

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
          <span>Treatment History</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Treatment History:</h6>
            <a class="collapse-item" href="all_consultations.php">All Consultations</a>
            <a class="collapse-item" href="all_test.php">All Tests</a>
            <a class="collapse-item" href="ongoing_treatments.php">Ongoing Treatments</a>
            <a class="collapse-item" href="past_treatments.php">Past Treatments</a>
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
            <?php if($tests[1] !== 0) { ?><a class="collapse-item" href="all_consultations.php">All Consultations</a><?php } ?>
            <?php if($tests[2] !== 0) { ?><a class="collapse-item active" href="YogE_HOME.php?orderId=<?php echo $tests[2]; ?>">YogE@Home Test</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item" href="ongoing_treatments.php">Ongoing Treatments</a><?php } ?>
          </div>
        </div>
      </li>
      <?php
        }
      ?>

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
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
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
            <h1 class="h3 text-gray-800">YogE @ HOME- Dr. Sadanand Rasal</h1>
            <p>Vital parameters and measurements give an instant insight in to the condition of the patient. Our application helps to manage the simple ,moderate and critical cases at home or under domicillary hospitalization or in hospitals. It is a helping hand of a doctor 24hr round the clock.  it helps in disease staging . disease prognosis, disease diagnosis, treatment response, detecting alarm signs etc.</p>
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

            <small style="font-size:11px;">* ABOVE DETAILS ARE FROM DATABASE, IF ANYTHING CHNAGE IN IT THEN PLEASE UPDATE YOUR DETAILS.</small>
            
            <hr>    
        
            <div class="form-group">
                <label for="hospital_name">IF A HOSPITALIZED CASE THEN NAME OF HOSPITAL AND IPD NO. </label>
                <input type="text" class="form-control" name="hospital_name" id="hospital_name" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="covid_test">COVID TESTING DONE</label>
                <select id="covid_test" name="covid_test" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="YES">YES</option>
                  <option value="NO">NO</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="covid_report">COVID19 TEST REPORT</label>
                <select id="covid_report" name="covid_report" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="COVID NASAL SWAB TEST POSTIVE">COVID NASAL SWAB TEST POSTIVE</option>
                  <option value="COVID NASAL SWAB TEST NEGATIVE">COVID NASAL SWAB TEST NEGATIVE</option>
                  <option value="CARD TEST IgG POSITIVE">CARD TEST IgG POSITIVE</option>
                  <option value="CARD TEST IgM POSITIVE">CARD TEST IgM POSITIVE</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>

            <div class="form-group">
                <label for="prescription_paper">DIAGNOSIS as written on hospital/prescription paper</label>
                <input type="text" class="form-control" name="prescription_paper" id="prescription_paper" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="SPO2">PULSEOX READING OF SPO2</label>
                <input type="text" class="form-control" name="SPO2" id="SPO2" required>
              </div>
              <div class="form-group col-md-3">
                <label for="blod_pressure">BLOOD PRESSURE</label>
                <input type="text" class="form-control" name="blod_pressure" id="blod_pressure" required>
              </div>
              <div class="form-group col-md-3">
                <label for="pulse_rate">PULSE RATE </label>
                <input type="text" class="form-control" name="pulse_rate" id="pulse_rate" required>
              </div>
              <div class="form-group col-md-3">
                <label for="respiration_rate">RESPIRATION RATE(PER MINS)</label>
                <input type="text" class="form-control" name="respiration_rate" id="respiration_rate" required>
              </div>
              <div class="form-group col-md-3">
                <label for="haemoglobin">Haemoglobin </label>
                <input type="text" class="form-control" name="haemoglobin" id="haemoglobin" required>
              </div>
              <div class="form-group col-md-3">
                <label for="wbc_count">WBC COUNT</label>
                <input type="text" class="form-control" name="wbc_count" id="wbc_count" required>
              </div>
              <div class="form-group col-md-3">
                <label for="rbc_count">RBC COUNT</label>
                <input type="text" class="form-control" name="rbc_count" id="rbc_count" required>
              </div>
              <div class="form-group col-md-3">
                <label for="pvc">HCT /HAEMATOCRIT/PCV</label>
                <input type="text" class="form-control"name="pvc" id="pvc" required>
              </div>
              <div class="form-group col-md-3">
                <label for="lymphocyte_count">LYMPHOCYTE COUNT</label>
                <input type="text" class="form-control" name="lymphocyte_count" id="lymphocyte_count" required>
              </div>
              <div class="form-group col-md-3">
                <label for="band_cell">BAND CELLS</label>
                <input type="text" class="form-control" name="band_cell" id="band_cell" required>
              </div>
              <div class="form-group col-md-3">
                <label for="esr">ESR</label>
                <input type="text" class="form-control" name="esr" id="esr" required>
              </div>
              <div class="form-group col-md-3">
                <label for="crp_value">CRP VALUE</label>
                <input type="text" class="form-control" name="crp_value" id="crp_value" required>
              </div>
              <div class="form-group col-md-3">
                <label for="bsl_random">BSL RANDOM</label>
                <input type="text" class="form-control" name="bsl_random" id="bsl_random" required>
              </div>
              <div class="form-group col-md-3">
                <label for="sgpt">SGPT</label>
                <input type="text" class="form-control" name="sgpt" id="sgpt" required>
              </div>
              <div class="form-group col-md-3">
                <label for="sgot">SGOT</label> 
                <input type="text" class="form-control" name="sgot" id="sgot" required>
              </div>
              <div class="form-group col-md-3">
                <label for="uric_acid_level">URIC ACID level </label>
                <input type="text" class="form-control" name="uric_acid_level" id="uric_acid_level" required>
              </div>
              <div class="form-group col-md-3">
                <label for="blood_urea_level">BLOOD UREA LEVEL</label>
                <input type="text" class="form-control" name="blood_urea_level" id="blood_urea_level" required>
              </div>
              <div class="form-group col-md-3">
                <label for="SR_CREATININE">SR CREATININE</label>
                <input type="text" class="form-control" name="SR_CREATININE" id="SR_CREATININE" required>
              </div>
              <div class="form-group col-md-3">
                <label for="urin_output">24 hr urine output in ml</label>
                <input type="text" class="form-control" name="urin_output" id="urin_output" required>
              </div>
              <div class="form-group col-md-3">
                <label for="level_consciousness">LEVEL OF CONSCIOUSNESS</label>
                <select id="level_consciousness" name="level_consciousness" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Can recollect past and present">Can recollect past and present</option>
                  <option value="Memory affected/ cannot recollect">Memory affected/ cannot recollect</option>
                  <option value="Forgetful now">Forgetful now</option>
                  <option value="Feeling blank">Feeling blank</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="swelling_feet">SWELLING ON FEET</label>
                <input type="text" class="form-control" name="swelling_feet" id="swelling_feet" required>
              </div>
              <div class="form-group col-md-3">
                <label for="swelling_eyes">SWELLING UNDER EYES/FACE</label>
                <input type="text" class="form-control" name="swelling_eyes" id="swelling_eyes" required>
              </div>
              <div class="form-group col-md-3">
                <label for="electrolyte_sodium">Electrolyte level - Sodium</label>
                <input type="text" class="form-control" name="electrolyte_sodium" id="electrolyte_sodium" required>
              </div>
              <div class="form-group col-md-3">
                <label for="electrolyte_potassium">Electrolyte level - Potassium</label>
                <input type="text" class="form-control" name="electrolyte_potassium" id="electrolyte_potassium" required>
              </div>
              <div class="form-group col-md-3">
                <label for="electrolyte_chloride">Electrolyte level - Chloride</label>
                <input type="text" class="form-control" name="electrolyte_chloride" id="electrolyte_chloride" required>
              </div>
              <div class="form-group col-md-3">
                <label for="lipid_triglyceride">Lipid profile- Triglycerides</label>
                <input type="text" class="form-control" name="lipid_triglyceride" id="lipid_triglyceride" required>
              </div>
              <div class="form-group col-md-3">
                <label for="lipid_cholesterol">Lipid profile - cholesterol</label>
                <input type="text" class="form-control" name="lipid_cholesterol" id="lipid_cholesterol" required>
              </div>
              <div class="form-group col-md-3">
                <label for="lipid_hdl">Lipid profile- HDL </label>
                <input type="text" class="form-control" name="lipid_hdl" id="lipid_hdl" required>
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

</body>

</html>

<?php 

    if(isset($_POST['submit_test'])){
        $hospital_name      = mysqli_real_escape_string($con, $_POST['hospital_name']);  
        $covid_test         = mysqli_real_escape_string($con, $_POST['covid_test']);
        $covid_report       = mysqli_real_escape_string($con, $_POST['covid_report']);
        $prescription_paper = mysqli_real_escape_string($con, $_POST['prescription_paper']);
        $SPO2               = mysqli_real_escape_string($con, $_POST['SPO2']);
        $blod_pressure      = mysqli_real_escape_string($con, $_POST['blod_pressure']);
        $pulse_rate         = mysqli_real_escape_string($con, $_POST['pulse_rate']);
        $respiration_rate   = mysqli_real_escape_string($con, $_POST['respiration_rate']);
        $haemoglobin        = mysqli_real_escape_string($con, $_POST['haemoglobin']);
        $wbc_count          = mysqli_real_escape_string($con, $_POST['wbc_count']);
        $rbc_count          = mysqli_real_escape_string($con, $_POST['rbc_count']);
        $pvc                = mysqli_real_escape_string($con, $_POST['pvc']);
        $lymphocyte_count   = mysqli_real_escape_string($con, $_POST['lymphocyte_count']);
        $band_cell          = mysqli_real_escape_string($con, $_POST['band_cell']);
        $esr                = mysqli_real_escape_string($con, $_POST['esr']);
        $crp_value          = mysqli_real_escape_string($con, $_POST['crp_value']);
        $bsl_random         = mysqli_real_escape_string($con, $_POST['bsl_random']);
        $sgpt               = mysqli_real_escape_string($con, $_POST['sgpt']);
        $sgot               = mysqli_real_escape_string($con, $_POST['sgot']);
        $uric_acid_level    = mysqli_real_escape_string($con, $_POST['uric_acid_level']);
        $blood_urea_level   = mysqli_real_escape_string($con, $_POST['blood_urea_level']);
        $SR_CREATININE      = mysqli_real_escape_string($con, $_POST['SR_CREATININE']);
        $urin_output        = mysqli_real_escape_string($con, $_POST['urin_output']);
        $level_consciousness= mysqli_real_escape_string($con, $_POST['level_consciousness']);
        $swelling_feet      = mysqli_real_escape_string($con, $_POST['swelling_feet']);
        $swelling_eyes      = mysqli_real_escape_string($con, $_POST['swelling_eyes']);
        $electrolyte_sodium = mysqli_real_escape_string($con, $_POST['electrolyte_sodium']);
        $electrolyte_potassium  = mysqli_real_escape_string($con, $_POST['electrolyte_potassium']);
        $electrolyte_chloride   = mysqli_real_escape_string($con, $_POST['electrolyte_chloride']);
        $lipid_triglyceride     = mysqli_real_escape_string($con, $_POST['lipid_triglyceride']);
        $lipid_cholesterol      = mysqli_real_escape_string($con, $_POST['lipid_cholesterol']);
        $lipid_hdl              = mysqli_real_escape_string($con, $_POST['lipid_hdl']);
        $other_complaint        = mysqli_real_escape_string($con, $_POST['other_complaint']);

        $test_id = md5(time().$user_id);

        $insert_value = "INSERT INTO `yoge_home`(`user_id`, `test_id`, `hospital_name`, `covid_test`, `covid_report`, `prescription_paper`, `SPO2`, `blod_pressure`, `pulse_rate`, `respiration_rate`, `haemoglobin`, `wbc_count`, `rbc_count`, `pvc`, `lymphocyte_count`, `band_cell`, `esr`, `crp_value`, `bsl_random`, `sgpt`, `sgot`, `uric_acid_level`, `blood_urea_level`, `SR_CREATININE`, `urin_output`, `level_consciousness`, `swelling_feet`, `swelling_eyes`, `electrolyte_sodium`, `electrolyte_potassium`, `electrolyte_chloride`, `lipid_triglyceride`, `lipid_cholesterol`, `lipid_hdl`, `other_complaint`) 
                        VALUES ('$user_id','$test_id','$hospital_name','$covid_test','$covid_report','$prescription_paper','$SPO2','$blod_pressure','$pulse_rate','$respiration_rate','$haemoglobin','$wbc_count','$rbc_count','$pvc','$lymphocyte_count','$band_cell','$esr','$crp_value','$bsl_random','$sgpt','$sgot','$uric_acid_level','$blood_urea_level','$SR_CREATININE','$urin_output','$level_consciousness','$swelling_feet','$swelling_eyes','$electrolyte_sodium','$electrolyte_potassium','$electrolyte_chloride','$lipid_triglyceride','$lipid_cholesterol','$lipid_hdl','$other_complaint')";

        if($insert_value_run = mysqli_query($con, $insert_value)){
          $update_test_payment = "UPDATE `test_payments` SET `test_id`='$test_id' WHERE `order_id`='$order_id'";
          if($update_test_payment_run = mysqli_query($con, $update_test_payment))

            echo "<script>
                    alert('your test is submitted sucessfully, Doctor will contact you soon.');
                    window.location.href='all_test.php';
                </script>";
          }

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