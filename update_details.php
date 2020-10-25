<?php 
  session_start();
  include("includes/db.php");
  $user_id = $_SESSION['user_id'];

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
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>User Details</title>

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
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#incompleteTest" aria-expanded="true"
          aria-controls="incompleteTest">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Incomplete Tests</span>
        </a>
        <div id="incompleteTest" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Incomplete Tests:</h6>
            <!-- <?php if($tests[1] !== 0) { ?><a class="collapse-item" href="">YOG-E@Rakshakavach/a><?php } ?> -->
            <?php if($tests[2] !== 0) { ?><a class="collapse-item" href="YogE_HomeCare.php?orderId=<?php echo $tests[2]; ?>">YOG-E@HomeCare</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item" href="YogE_CritiCare.php?orderId=<?php echo $tests[3]; ?>">YOG-E@CritiCare</a><?php } ?>
            <!-- <?php if($tests[4] !== 0) { ?><a class="collapse-item" href=".php">YOG-E@Anthropometry</a><?php } ?> -->
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

      <li class="nav-item active">
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
            <h2 class="h4 mb-3 text-gray-800">Personal Details</h2>
            <div class="form-group">
              <label for="exampleInputEmail1">User Name</label>
              <input type="text" class="form-control" value="<?php echo $user_details_res['user_name']; ?>" name="u_name" id="u_name"
                aria-describedby="emailHelp">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" value="<?php echo $user_details_res['email_id']; ?>" id="email"
                  aria-describedby="emailHelp" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Your WhatsApp Number</label>
                <input type="text" class="form-control" name="contact" value="<?php echo $user_details_res['contact_no']; ?>" id="number" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Your Full Name</label>
                <input type="text" class="form-control"name="name"  value="<?php echo $user_details_res['name']; ?>" id="name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Your husband's / father's Full name</label>
                <input type="text" class="form-control" name="father_name" value="<?php echo $user_details_res['father_name']; ?>" id="f_name" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputState">Gender</label>
                <select id="inputState" name="gender" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="Male" <?php if($user_details_res['gender']=="Male") echo 'selected="selected"'; ?>>Male</option>
                  <option value="Female" <?php if($user_details_res['gender']=="Female") echo 'selected="selected"'; ?>>Female</option>
                  <option value="Other" <?php if($user_details_res['gender']=="Other") echo 'selected="selected"'; ?>>Other</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputCity">Are you working?</label>
                <select id="inputState" name="working" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="YES" <?php if($user_details_res['working']=="YES") echo 'selected="selected"'; ?>>Yes</option>
                  <option value="NO" <?php if($user_details_res['working']=="NO") echo 'selected="selected"'; ?>>No</option>
                  <option value="Work From Home" <?php if($user_details_res['working']=="Work From Home") echo 'selected="selected"'; ?>>Work From Home</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputState">Date of Birth</label>
                <input class="form-control" type="date" name="dob" value="<?php if($user_details_res['dob'] != ''){ echo strftime('%Y-%m-%d', strtotime($user_details_res['dob']));} ?>" required />
              </div>
              <div class="form-group col-md-3">
                <label for="inputZip">Maritial Status</label>
                <select id="maritial_status" name="married" class="form-control" required>
                  <option selected disabled hidden>Choose...</option>
                  <option value="YES" <?php if($user_details_res['married']=="YES") echo 'selected="selected"'; ?>>married</option>
                  <option value="NO" <?php if($user_details_res['married']=="NO") echo 'selected="selected"'; ?>>unmarried</option>
                  <option value="Other" <?php if($user_details_res['married']=="Other") echo 'selected="selected"'; ?>>other</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="address">Residential postal address</label>
              <textarea class="form-control" name="address" id="address" rows="3" required><?php echo $user_details_res['address']; ?></textarea>
            </div>

            <hr>
            <!-- Page Heading -->
            <h2 class="h4 mb-3 mt-4 text-gray-800">Medical Details</h2>

            <div class="form-group">
              <label><strong>What are problems you have? </strong></label>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Fitness" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Fitness</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Weight /obesity" id="defaultCheck2">
                    <label class="form-check-label" for="defaultCheck2">Weight /obesity</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Health issue" id="defaultCheck3">
                    <label class="form-check-label" for="defaultCheck3">Health issue</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Stress" id="defaultCheck4">
                    <label class="form-check-label" for="defaultCheck4">Stress</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="PCOD" id="defaultCheck5">
                    <label class="form-check-label" for="defaultCheck5">PCOD</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Gynaec problem" id="defaultCheck6">
                    <label class="form-check-label" for="defaultCheck6">Gynaec problem</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Infertility" id="defaultCheck7">
                    <label class="form-check-label" for="defaultCheck7">Infertility</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Heart disease" id="defaultCheck8">
                    <label class="form-check-label" for="defaultCheck8">Heart disease</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Diabetes" id="defaultCheck9">
                    <label class="form-check-label" for="defaultCheck9">Diabetes</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="ARTHRITIS" id="defaultCheck10">
                    <label class="form-check-label" for="defaultCheck10">ARTHRITIS</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Spine problem" id="defaultCheck11">
                    <label class="form-check-label" for="defaultCheck11">Spine problem</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Liver disease" id="defaultCheck12">
                    <label class="form-check-label" for="defaultCheck12">Liver disease</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Infection" id="defaultCheck13">
                    <label class="form-check-label" for="defaultCheck13">Infection</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Cancer" id="defaultCheck14">
                    <label class="form-check-label" for="defaultCheck14">Cancer</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Respiratory disorder" id="defaultCheck15">
                    <label class="form-check-label" for="defaultCheck15">Respiratory disorder</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Stomach" id="defaultCheck16">
                    <label class="form-check-label" for="defaultCheck16">Stomach</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Colon and Rectum" id="defaultCheck17">
                    <label class="form-check-label" for="defaultCheck17">Colon and Rectum</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Blood disorder" id="defaultCheck18">
                    <label class="form-check-label" for="defaultCheck18">Blood disorder</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Brain related disease" id="defaultCheck19">
                    <label class="form-check-label" for="defaultCheck19">Brain related disease</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Skin disease" id="defaultCheck20">
                    <label class="form-check-label" for="defaultCheck20">Skin disease</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Kidney disease" id="defaultCheck21">
                    <label class="form-check-label" for="defaultCheck21">Kidney disease</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Circulation disorder" id="defaultCheck22">
                    <label class="form-check-label" for="defaultCheck22">Circulation disorder</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check"> 
                    <input class="form-check-input" type="checkbox" name="problems[]" value="Chronic disease" id="defaultCheck23">
                    <label class="form-check-label" for="defaultCheck23">Chronic disease</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check"> 
                    <input class="form-check-input" type="checkbox" name="problems[]" value="None" id="defaultCheck24">
                    <label class="form-check-label" for="defaultCheck24">None</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label><strong>what type of treatment you tried before?</strong> </label>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Allopathy" id="Check1">
                    <label class="form-check-label" for="Check1">Allopathy</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Ayurveda" id="Check2">
                    <label class="form-check-label" for="Check2">Ayurveda</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Homeopathy" id="Check3">
                    <label class="form-check-label" for="Check3">Homeopathy</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Herbal" id="Check4">
                    <label class="form-check-label" for="Check4">Herbal</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Home remedies" id="Check5">
                    <label class="form-check-label" for="Check5">Home remedies</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Naturopathy" id="Check6">
                    <label class="form-check-label" for="Check6">Naturopathy</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Yoga" id="Check7">
                    <label class="form-check-label" for="Check7">Yoga</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="treatment_tried[]" value="Other" id="Check8">
                    <label class="form-check-label" for="Check8">Other</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label><strong>Would you like a programme which has no side effects?</strong> </label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="side_effect" id="side_effect1" value="YES" <?php if($user_details_res['side_effect']=="YES") echo 'selected="selected"'; ?> required>
                <label class="form-check-label" for="side_effect1">Yes</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="side_effect" id="side_effect2" value="NO" <?php if($user_details_res['side_effect']=="NO") echo 'selected="selected"'; ?>>
                <label class="form-check-label" for="side_effect2">No</label>
              </div>
            </div>

            <div class="form-group">
              <label><strong>What time is best daily for your health session?</strong> </label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="health_session" id="health_session1" value="morning" required>
                <label class="form-check-label" for="health_session1">morning</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="health_session" id="health_session2" value="afternoon">
                <label class="form-check-label" for="health_session2">afternoon</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="health_session" id="health_session3" value="evening">
                <label class="form-check-label" for="health_session3">evening</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="health_session" id="health_session4" value="after dinner">
                <label class="form-check-label" for="health_session4">after dinner</label>
              </div>
            </div>

            <div class="form-group">
              <label for="releif"><strong>Are you looking for permanent relief or temporary control? </strong></label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="releif" id="releif1" value="Permanent relief" required>
                <label class="form-check-label" for="releif1">Permanent relief</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="releif" id="releif2" value="Temporary control">
                <label class="form-check-label" for="releif2">Temporary control</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="releif" id="releif3" value="Other">
                <label class="form-check-label" for="releif3">Other</label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputState"><strong>date of first illness detected </strong></label>
                <input class="form-control" type="date" name="date_illness" value="<?php if($user_details_res['date_first_illness'] != ''){ echo strftime('%Y-%m-%d', strtotime($user_details_res['date_first_illness']));} ?>" required />
              </div>
              <div class="form-group col-md-6">
                <label for="inputState"><strong>Diagnosis made by doctors.</strong></label>
                <input class="form-control" type="text" name="pre_doctor" placeholder="if not then mention 'NO'" required />
              </div>
              
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Details</button>
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
  if(isset($_POST['update'])){
    $u_name           = mysqli_real_escape_string($con, $_POST['u_name']); 
    $name             = mysqli_real_escape_string($con, $_POST['name']);
    $father_name      = mysqli_real_escape_string($con, $_POST['father_name']);
    $gender           = mysqli_real_escape_string($con, $_POST['gender']);
    $contact          = mysqli_real_escape_string($con, $_POST['contact']);
    $dob              = mysqli_real_escape_string($con, $_POST['dob']);
    $married          = mysqli_real_escape_string($con, $_POST['married']);
    $working          = mysqli_real_escape_string($con, $_POST['working']);
    $address          = mysqli_real_escape_string($con, $_POST['address']);
    $problems         = $_POST['problems'];
    $treatment_tried  = $_POST['treatment_tried'];
    $side_effect      = mysqli_real_escape_string($con, $_POST['side_effect']);
    $health_session   = mysqli_real_escape_string($con, $_POST['health_session']);
    $releif           = mysqli_real_escape_string($con, $_POST['releif']);
    $date_illness     = mysqli_real_escape_string($con, $_POST['date_illness']);
    $pre_doctor       = mysqli_real_escape_string($con, $_POST['pre_doctor']); 

    //convert array to comma seprated string for desease
    $problem_string = "";
    foreach ($problems as $desease) {
      $problem_string .= $desease.", ";
    }
    $problem_string = mysqli_real_escape_string($con, $problem_string);

    //convert array to comma seprated string for treatment tried
    $treatment_tried_string = "";
    foreach ($treatment_tried as $treat) {
      $treatment_tried_string .= $treat.", ";
    }
    $treatment_tried_string = mysqli_real_escape_string($con, $treatment_tried_string);

    //flag1 is 1 if user profile update sucessfully similarly in flag2 when medical history update sucess
    $flag1 = 0;
    $update_user = "UPDATE `user` 
                    SET `user_name`='$u_name',`name`='$name',`father_name`='$father_name',`gender`='$gender',`contact_no`='$contact',`dob`='$dob',`married`='$married',`working`='$working',`address`='$address' 
                    WHERE `user_id`='$user_id'";
    $update_user_run = mysqli_query($con, $update_user);
    if(mysqli_affected_rows($con)){
      $flag1 = 1;
    }

    $flag2 = 0;
    $update_medical_history = "UPDATE `medical_history` 
                                SET `problems`='$problem_string',`teratment_tried`='$treatment_tried_string',`side_effect`='$side_effect',`health_session`='$health_session',`relief`='$releif',`date_first_illness`='$date_illness',`prev_doctor`='$pre_doctor'
                                WHERE `user_id`='$user_id'";
    $update_medical_history_run = mysqli_query($con, $update_medical_history);
    if(mysqli_affected_rows($con)){
      $flag2 = 1;
    }

    if($flag1 == 1 && $flag2 == 1){
      echo "<script>
          alert('user Info updated sucessfully');
      </script>";

      if(isset($_SESSION['consult_type']) && isset($_SESSION['consult_date']) && isset($_SESSION['time_slots'])){
        $consult_type = $_SESSION['consult_type'];
        $date = $_SESSION['consult_date'];
        $time = $_SESSION['time_slots'];

        unset($_SESSION['consult_type'], $_SESSION['consult_date'], $_SESSION['time_slots']);

        echo "<script>
                    window.location.href='payment/consultation_payment.php?type=$consult_type&date=$date&time=$time';
            </script>";

      }elseif (isset($_SESSION['test_type'])){
        $test_type = $_SESSION['test_type'];

        unset($_SESSION['test_type']);

        echo "<script>
                    window.location.href='payment/test_payment.php?type=$test_type';
            </script>";

      }else{
        echo "<script>
                window.location.href='update_details.php';
            </script>";
      }
    }


  }


?>