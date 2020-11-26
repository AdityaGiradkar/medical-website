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

  <title>YOG-E@Antropometry Test</title>

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
            <?php if($tests[1] !== 0) { ?><a class="collapse-item <?php if($check_availability_of_test_res['test_type'] == 1){ echo 'active'; } ?>" href="YogE_rakshakavach.php?orderId=<?php echo $tests[1]; ?>">YOG-E@Rakshakavach <br>Basic</a><?php } ?>
            <?php if($tests[2] !== 0) { ?><a class="collapse-item" href="YogE_HomeCare.php?orderId=<?php echo $tests[2]; ?>">YOG-E@HomeCare</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item" href="YogE_CritiCare.php?orderId=<?php echo $tests[3]; ?>">YOG-E@CritiCare</a><?php } ?>
            <?php if($tests[4] !== 0) { ?><a class="collapse-item active" href="YogE_Antropometry.php?orderId=<?php echo $tests[4]; ?>">YOG-E@Anthropometry</a><?php } ?>
            <?php if($tests[5] !== 0) { ?><a class="collapse-item <?php if($check_availability_of_test_res['test_type'] == 5){ echo 'active'; } ?>" href="YogE_rakshakavach.php?orderId=<?php echo $tests[5]; ?>">YOG-E@Rakshakavach <br>Advanced</a><?php } ?>
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
            <h1 class="h3 text-gray-800">YOG-E@Antropometry Test</h1>
            <p>YOG-E@ Anthropometry test helps is anthropometric analysis, body parameter analysis, weight loss therapies, figure management programmes . It also helps in asssessing your hormone axis, chakra dosha, etc. A great tool in body managent programmes</p>
            <p><b>Following instruments required for doing this test:</b>
              <ol>
                <li>Tailoring measureing tape having measurement in centimeters.</li>
                <li>Skin fold meter or Verniers caliper or  Harpenend caliper.</li>
              </ol> 
              Always use thin clothes while taking measurements.
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
              <div class="form-group col-md-6">
                <label for="para1"><strong>Weight in Kg.</strong></label>
                <input type="text" class="form-control" name="para1" id="para1" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para2"><strong>Height in cm.</strong></label>
                <input type="text" class="form-control" name="para2" id="para2" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para3"><strong>Chest in cm.</strong></label>
                <input type="text" class="form-control" name="para3" id="para3" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para4"><strong>Neck circumference in cm.</strong></label>
                <input type="text" class="form-control" name="para4" id="para4" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para5"><strong>Abdominal girth above navel/umbilicus in cm</strong></label>
                <input type="text" class="form-control" name="para5" id="para5" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para6"><strong>Abdominal girth at level of umbilicus /navel in cm</strong></label>
                <input type="text" class="form-control" name="para6" id="para6" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para7"><strong>Abdominal girth below level of navel/umbilicus in cm</strong></label>
                <input type="text" class="form-control" name="para7" id="para7" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para8"><strong>Waist in cm</strong></label>
                <input type="text" class="form-control" name="para8" id="para8" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para9"><strong>Hip measurement where buttock is the largest in cm</strong></label>
                <input type="text" class="form-control" name="para9" id="para9" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para10"><strong>Thigh measurement where it is the largest in cm</strong></label>
                <input type="text" class="form-control" name="para10" id="para10" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para11"><strong>Calf measurement where it is the largest in cm</strong></label>
                <input type="text" class="form-control" name="para11" id="para11" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para12"><strong>Arm measurement where it is the largest in cm</strong></label>
                <input type="text" class="form-control" name="para12" id="para12" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para13"><strong>Forearm measurement where it is the largest in cm</strong></label>
                <input type="text" class="form-control" name="para13" id="para13" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para14"><strong>Wrist circumference in cm</strong></label>
                <input type="text" class="form-control" name="para14" id="para14" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para15"><strong>Abdominal skin fold by skin fold meter [anterior upper]</strong></label>
                <input type="text" class="form-control" name="para15" id="para15" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para16"><strong>Abdominal skin fold by skin fold meter [anterior middle]</strong></label>
                <input type="text" class="form-control" name="para16" id="para16" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para17"><strong>Abdominal skin fold by skin fold meter [anterior lower]</strong></label>
                <input type="text" class="form-control" name="para17" id="para17" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para18"><strong>Abdominal skin fold by skin fold meter [lateral upper]</strong></label>
                <input type="text" class="form-control" name="para18" id="para18" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para19"><strong>Abdominal skin fold by skin fold meter [lateral middle]</strong></label>
                <input type="text" class="form-control" name="para19" id="para19" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para20"><strong>Abdominal skin fold by skin fold meter [lateral lower]</strong></label>
                <input type="text" class="form-control" name="para20" id="para20" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para21"><strong>Abdominal skin fold by skin fold meter [suprailiac]</strong></label>
                <input type="text" class="form-control" name="para21" id="para21" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para22"><strong>Skin fold of arms and forearm [biceps]</strong></label>
                <input type="text" class="form-control" name="para22" id="para22" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para23"><strong>Skin fold of arms and forearm [triceps]</strong></label>
                <input type="text" class="form-control" name="para23" id="para23" required>
              </div>
            
              <div class="form-group col-md-6">
                <label for="para24"><strong>Skin fold of arms and forearm [forearm]</strong></label>
                <input type="text" class="form-control" name="para24" id="para24" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para25"><strong>Skin fold upper back [subscapular middle]</strong></label>
                <input type="text" class="form-control" name="para25" id="para25" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para26"><strong>Skin fold upper back [subscapular lower]</strong></label>
                <input type="text" class="form-control" name="para26" id="para26" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para27"><strong>Skin fold upper back [nape of neck]</strong></label>
                <input type="text" class="form-control" name="para27" id="para27" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para28"><strong>Skin fold thighs [lateral thigh]</strong></label>
                <input type="text" class="form-control" name="para28" id="para28" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para29"><strong>Skin fold thighs [anterior thigh]</strong></label>
                <input type="text" class="form-control" name="para29" id="para29" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para30"><strong>Skin fold neck [neck skin fold]</strong></label>
                <input type="text" class="form-control" name="para30" id="para30" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para31"><strong>Skin fold neck [double chin]</strong></label>
                <input type="text" class="form-control" name="para31" id="para31" required>
              </div>
            
              <div class="form-group col-md-6">
                <label for="para32"><strong>Skin fold neck [double neck]</strong></label>
                <input type="text" class="form-control" name="para32" id="para32" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para33"><strong>Skin fold face [cheek bone]</strong></label>
                <input type="text" class="form-control" name="para33" id="para33" required>
              </div>
              <div class="form-group col-md-6">
                <label for="para34"><strong>Skin fold face [cheek]</strong></label>
                <input type="text" class="form-control" name="para34" id="para34" required>
              </div>

            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label for="para35"><strong>Dark circle around eyes</strong></label>
                <select id="para35" name="para35" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para36"><strong>Stanning on forehead</strong></label>
                <select id="para36" name="para36" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para37"><strong>Tanning on temples</strong></label>
                <select id="para37" name="para37" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para38"><strong>Tanning on cheeks/zygoma</strong></label>
                <select id="para38" name="para38" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para39"><strong>Tanning around mouth</strong></label>
                <select id="para39" name="para39" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para40"><strong>Meleasma</strong></label>
                <select id="para40" name="para40" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para41"><strong>Discoloration on nose</strong></label>
                <select id="para41" name="para41" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para42"><strong>Tanning on nape of neck</strong></label>
                <select id="para42" name="para42" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para43"><strong>Thickness of skin on nape of neck</strong></label>
                <select id="para43" name="para43" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para44"><strong>Tanning in armpit</strong></label>
                <select id="para44" name="para44" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para45"><strong>Thickening of skin in armpit</strong></label>
                <select id="para45" name="para45" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para46"><strong>Dark skin behind elbow</strong></label>
                <select id="para46" name="para46" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para47"><strong>Dark skin behind hand</strong></label>
                <select id="para47" name="para47" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para48"><strong>Dark knuckles</strong></label>
                <select id="para48" name="para48" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para49"><strong>Dark knees</strong></label>
                <select id="para49" name="para49" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para50"><strong>Dark ankles</strong></label>
                <select id="para50" name="para50" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para51"><strong>Dark malleolus</strong></label>
                <select id="para51" name="para51" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para52"><strong>Vitiligo patch on face</strong></label>
                <select id="para52" name="para52" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para53"><strong>Vitiligo patch on chest</strong></label>
                <select id="para53" name="para53" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para54"><strong>Vitiligo patch on back</strong></label>
                <select id="para54" name="para54" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para55"><strong>Vitiligo patch on arm</strong></label>
                <select id="para55" name="para55" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para56"><strong>Vitiligo patch on forearm</strong></label>
                <select id="para56" name="para56" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para57"><strong>Vitiligo patch on hands</strong></label>
                <select id="para57" name="para57" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para58"><strong>Vitiligo patch on legs</strong></label>
                <select id="para58" name="para58" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para59"><strong>Vitiligo patch on thigh</strong></label>
                <select id="para59" name="para59" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para60"><strong>Vitiligo patch on buttock</strong></label>
                <select id="para60" name="para60" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para61"><strong>Vitiligo patch in groin</strong></label>
                <select id="para61" name="para61" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para62"><strong>Vitiligo patch in private parts</strong></label>
                <select id="para62" name="para62" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="para63"><strong>Vitiligo patch on abdomen</strong></label>
                <select id="para63" name="para63" class="form-control" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              
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
        $para1 = mysqli_real_escape_string($con, $_POST['para1'])*100;
        $para2 = mysqli_real_escape_string($con, $_POST['para2'])*100;
        $para3 = mysqli_real_escape_string($con, $_POST['para3'])*100;
        $para4 = mysqli_real_escape_string($con, $_POST['para4'])*100;
        $para5 = mysqli_real_escape_string($con, $_POST['para5'])*100;
        $para6 = mysqli_real_escape_string($con, $_POST['para6'])*100;
        $para7 = mysqli_real_escape_string($con, $_POST['para7'])*100;
        $para8 = mysqli_real_escape_string($con, $_POST['para8'])*100;
        $para9 = mysqli_real_escape_string($con, $_POST['para9'])*100;
        $para10 = mysqli_real_escape_string($con, $_POST['para10'])*100;
        $para11 = mysqli_real_escape_string($con, $_POST['para11'])*100;
        $para12 = mysqli_real_escape_string($con, $_POST['para12'])*100;
        $para13 = mysqli_real_escape_string($con, $_POST['para13'])*100;
        $para14 = mysqli_real_escape_string($con, $_POST['para14'])*100;
        $para15 = mysqli_real_escape_string($con, $_POST['para15'])*100;
        $para16 = mysqli_real_escape_string($con, $_POST['para16'])*100;
        $para17 = mysqli_real_escape_string($con, $_POST['para17'])*100;
        $para18 = mysqli_real_escape_string($con, $_POST['para18'])*100;
        $para19 = mysqli_real_escape_string($con, $_POST['para19'])*100;
        $para20 = mysqli_real_escape_string($con, $_POST['para20'])*100;
        $para21 = mysqli_real_escape_string($con, $_POST['para21'])*100;
        $para22 = mysqli_real_escape_string($con, $_POST['para22'])*100;
        $para23 = mysqli_real_escape_string($con, $_POST['para23'])*100;
        $para24 = mysqli_real_escape_string($con, $_POST['para24'])*100;
        $para25 = mysqli_real_escape_string($con, $_POST['para25'])*100;
        $para26 = mysqli_real_escape_string($con, $_POST['para26'])*100;
        $para27 = mysqli_real_escape_string($con, $_POST['para27'])*100;
        $para28 = mysqli_real_escape_string($con, $_POST['para28'])*100;
        $para29 = mysqli_real_escape_string($con, $_POST['para29'])*100;
        $para30 = mysqli_real_escape_string($con, $_POST['para30'])*100;
        $para31 = mysqli_real_escape_string($con, $_POST['para31'])*100;
        $para32 = mysqli_real_escape_string($con, $_POST['para32'])*100;
        $para33 = mysqli_real_escape_string($con, $_POST['para33'])*100;
        $para34 = mysqli_real_escape_string($con, $_POST['para34'])*100;
        $para35 = mysqli_real_escape_string($con, $_POST['para35']);
        $para36 = mysqli_real_escape_string($con, $_POST['para36']);
        $para37 = mysqli_real_escape_string($con, $_POST['para37']);
        $para38 = mysqli_real_escape_string($con, $_POST['para38']);
        $para39 = mysqli_real_escape_string($con, $_POST['para39']);
        $para40 = mysqli_real_escape_string($con, $_POST['para40']);
        $para41 = mysqli_real_escape_string($con, $_POST['para41']);
        $para42 = mysqli_real_escape_string($con, $_POST['para42']);
        $para43 = mysqli_real_escape_string($con, $_POST['para43']);
        $para44 = mysqli_real_escape_string($con, $_POST['para44']);
        $para45 = mysqli_real_escape_string($con, $_POST['para45']);
        $para46 = mysqli_real_escape_string($con, $_POST['para46']);
        $para47 = mysqli_real_escape_string($con, $_POST['para47']);
        $para48 = mysqli_real_escape_string($con, $_POST['para48']);
        $para49 = mysqli_real_escape_string($con, $_POST['para49']);
        $para50 = mysqli_real_escape_string($con, $_POST['para50']);
        $para51 = mysqli_real_escape_string($con, $_POST['para51']);
        $para52 = mysqli_real_escape_string($con, $_POST['para52']);
        $para53 = mysqli_real_escape_string($con, $_POST['para53']);
        $para54 = mysqli_real_escape_string($con, $_POST['para54']);
        $para55 = mysqli_real_escape_string($con, $_POST['para55']);
        $para56 = mysqli_real_escape_string($con, $_POST['para56']);
        $para57 = mysqli_real_escape_string($con, $_POST['para57']);
        $para58 = mysqli_real_escape_string($con, $_POST['para58']);
        $para59 = mysqli_real_escape_string($con, $_POST['para59']);
        $para60 = mysqli_real_escape_string($con, $_POST['para60']);
        $para61 = mysqli_real_escape_string($con, $_POST['para61']);
        $para62 = mysqli_real_escape_string($con, $_POST['para62']);
        $para63 = mysqli_real_escape_string($con, $_POST['para63']);


        $test_id = md5(time().$user_id);

        $get_latest_test_no = "SELECT max(`antropometry_test_no`) AS last_test FROM `test_antropometry`";
        $get_latest_test_no_run = mysqli_query($con, $get_latest_test_no);
        $get_latest_test_no_res = mysqli_fetch_assoc($get_latest_test_no_run);

        $current_test_no = $get_latest_test_no_res['last_test'] + 1;

        $insert_value = "INSERT INTO `test_antropometry`(`test_id`, `antropometry_test_no`, `para1`, `para2`, `para3`, `para4`, `para5`, `para6`, `para7`, `para8`, `para9`, `para10`, `para11`, `para12`, `para13`, `para14`, `para15`, `para16`, `para17`, `para18`, `para19`, `para20`, `para21`, `para22`, `para23`, `para24`, `para25`, `para26`, `para27`, `para28`, `para29`, `para30`, `para31`, `para32`, `para33`, `para34`, `para35`, `para36`, `para37`, `para38`, `para39`, `para40`, `para41`, `para42`, `para43`, `para44`, `para45`, `para46`, `para47`, `para48`, `para49`, `para50`, `para51`, `para52`, `para53`, `para54`, `para55`, `para56`, `para57`, `para58`, `para59`, `para60`, `para61`, `para62`, `para63`) 
                        VALUES ('$test_id', '$current_test_no', '$para1', '$para2', '$para3', '$para4', '$para5', '$para6', '$para7', '$para8', '$para9', '$para10', '$para11', '$para12', '$para13', '$para14', '$para15', '$para16', '$para17', '$para18', '$para19', '$para20', '$para21', '$para22', '$para23', '$para24', '$para25', '$para26', '$para27', '$para28', '$para29', '$para30', '$para31', '$para32', '$para33', '$para34', '$para35', '$para36', '$para37', '$para38', '$para39', '$para40', '$para41', '$para42', '$para43', '$para44', '$para45', '$para46', '$para47', '$para48', '$para49', '$para50', '$para51', '$para52', '$para53', '$para54', '$para55', '$para56', '$para57', '$para58', '$para59', '$para60', '$para61', '$para62', '$para63')";

        if($insert_value_run = mysqli_query($con, $insert_value)){
          $update_test_payment = "UPDATE `test_payments` SET `test_id`='$test_id', `status`='checked' WHERE `order_id`='$order_id'";
          if($update_test_payment_run = mysqli_query($con, $update_test_payment))

            echo "<script>
                    //alert('your test is submitted sucessfully, Doctor will contact you soon. You can see your test receipt in All test section.');
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