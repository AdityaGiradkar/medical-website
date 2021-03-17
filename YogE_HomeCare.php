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

  <title>YOG-E @HomeCareDailyTest</title>

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
            <?php if($tests[2] !== 0) { ?><a class="collapse-item active" href="YogE_HomeCare.php?orderId=<?php echo $tests[2]; ?>">YOG-E@HomeCare</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item" href="YogE_CritiCare.php?orderId=<?php echo $tests[3]; ?>">YOG-E@CritiCare</a><?php } ?>
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
            <h1 class="h3 text-gray-800">YOG-E @HomeCareDailyTest </h1>
            <p>In present covid situation, the risk of getting infected is realy more. So medical healthcare at home is need of hour. This Home care tool help you to monitor your recovery by sharing your data daily. It provides alert, recovery and health data.</p>
            <p>
              <b>Following instruments in working condition required for doing this test:</b>
              <ol>
                <li>PulseOximeter</li>
                <li>Digital Blood pressure measuring machine</li>
                <li>Digital or Glass thermometer</li>
              </ol>  
            </p>
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
        

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="SPO2"><strong>Pulse-ox Reading Of SPO2 (%)</strong></label>
                <input type="text" class="form-control" name="SPO2" id="SPO2" required>
              </div>
              <div class="form-group col-md-4">
                <label for="s_blod_pressure"><strong>Systolic Blood Pressure (mm/Hg)</strong></label>
                <input type="text" class="form-control" name="s_blod_pressure" id="s_blod_pressure" required>
              </div>
              <div class="form-group col-md-4">
                <label for="d_blod_pressure"><strong>Diastolic Blood Pressure (mm/Hg)</strong></label>
                <input type="text" class="form-control" name="d_blod_pressure" id="d_blod_pressure" required>
              </div>
              <div class="form-group col-md-4">
                <label for="pulse_rate"><strong>Pulse Rate (beat/min)</strong></label>
                <input type="text" class="form-control" name="pulse_rate" id="pulse_rate" required>
              </div>
              <div class="form-group col-md-4">
                <label for="respiration_rate"><strong>Respiration Rate(per min)</strong></label>
                <input type="text" class="form-control" name="respiration_rate" id="respiration_rate" required>
              </div>
              <div class="form-group col-md-4">
                <label for="oral_temp"><strong>Oral body Temperature (<sup>0</sup>F)</strong></label>
                <input type="text" class="form-control" name="oral_temp" id="oral_temp" required>
                <p style="margin-top:-3px; margin-bottom:-4px"><small>(Axillary temp if patient intubated)*</small></p>
              </div>
              <div class="form-group col-md-4">
                <label for="drink_water"><strong>How much water did you drink in last 24 hours.</strong></label>
                <select id="drink_water" name="drink_water" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="0.5">0.5 Litre</option>
                  <option value="1">1 Litre</option>
                  <option value="1.5">1.5 Litre</option>
                  <option value="2">2 Litre</option>
                  <option value="2.5">2.5 Litre</option>
                  <option value="3">3 Litre</option>
                  <option value="3.5">3.5 Litre</option>
                  <option value="4">4 Litre</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="headache"><strong>Do you have headache today.</strong></label>
                <select id="headache" name="headache" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="bodyache"><strong>Do you have bodyache today</strong></label>
                <select id="bodyache" name="bodyache" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="cough"><strong>Do you have cough today</strong></label>
                <select id="cough" name="cough" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="cold"><strong>Do you have cold today.</strong></label>
                <select id="cold" name="cold" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="fever"><strong>Did you have fever yesterday.</strong></label>
                <select id="fever" name="fever" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="weakness"><strong>Are you feeling weakness today.</strong></label>
                <select id="weakness" name="weakness" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="loose_motion"><strong>Are you having loose motions.</strong></label>
                <select id="loose_motion" name="loose_motion" class="form-control" required>
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
      $SPO2                 = mysqli_real_escape_string($con, $_POST['SPO2'])*100;
      $s_blod_pressure      = mysqli_real_escape_string($con, $_POST['s_blod_pressure'])*100;
      $d_blod_pressure      = mysqli_real_escape_string($con, $_POST['d_blod_pressure'])*100;
      $pulse_rate           = mysqli_real_escape_string($con, $_POST['pulse_rate'])*100;
      $respiration_rate     = mysqli_real_escape_string($con, $_POST['respiration_rate'])*100;
      $oral_temp            = mysqli_real_escape_string($con, $_POST['oral_temp'])*100;
      $drink_water          = mysqli_real_escape_string($con, $_POST['drink_water'])*100;
      $headache             = mysqli_real_escape_string($con, $_POST['headache']);
      $bodyache             = mysqli_real_escape_string($con, $_POST['bodyache']);
      $cough                = mysqli_real_escape_string($con, $_POST['cough']);
      $cold                 = mysqli_real_escape_string($con, $_POST['cold']);
      $fever                = mysqli_real_escape_string($con, $_POST['fever']);
      $weakness             = mysqli_real_escape_string($con, $_POST['weakness']);
      $loose_motion         = mysqli_real_escape_string($con, $_POST['loose_motion']);
      $other_complaint      = mysqli_real_escape_string($con, $_POST['other_complaint']);

        $test_id = md5(time().$user_id);

        $get_latest_test_no = "SELECT max(`homecare_test_no`) AS last_test FROM `test_homecare`";
        $get_latest_test_no_run = mysqli_query($con, $get_latest_test_no);
        $get_latest_test_no_res = mysqli_fetch_assoc($get_latest_test_no_run);

        $current_test_no = $get_latest_test_no_res['last_test'] + 1;

        $insert_value = "INSERT INTO `test_homecare`(`test_id`, `homecare_test_no`, `SPO2`, `s_blod_pressure`, `d_blod_pressure`, `pulse_rate`, `respiration_rate`, `oral_temp`, `drink_water`, `headache`, `bodyache`, `cough`, `cold`, `fever`, `weakness`, `loose_motion`, `other_complaint`) 
                        VALUES ('$test_id', '$current_test_no', '$SPO2', '$s_blod_pressure', '$d_blod_pressure', '$pulse_rate', '$respiration_rate', '$oral_temp', '$drink_water', '$headache', '$bodyache', '$cough', '$cold', '$fever', '$weakness', '$loose_motion', '$other_complaint')";

        if($insert_value_run = mysqli_query($con, $insert_value))//{
          $update_test_payment = "UPDATE `test_payments` SET `test_id`='$test_id', `status`='checked' WHERE `order_id`='$order_id'";
          if($update_test_payment_run = mysqli_query($con, $update_test_payment))

            echo "<script>
                    //alert('your test is submitted sucessfully. You can see your test receipt and report in All test section.');
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