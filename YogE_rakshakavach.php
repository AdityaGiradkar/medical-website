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

  <title>YOG-E @Rakshakavach Test</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- custom style sheet for sidebar and navigation bar -->
  <link rel="stylesheet" href="admin/css/sidebar.css">

  <style>
  /* CSS for video modal */
    .modal-dialog {
        max-width: 800px;
        margin: 30px auto;
    }

    .modal-body {
      position:relative;
      padding:0px;
    }

    .close {
      position:absolute;
      right:-30px;
      top:0;
      z-index:999;
      font-size:2rem;
      font-weight: normal;
      color:#fff;
      opacity:1;
    }
    /* CSS for video modal */

    .option{
      cursor: pointer;
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
          <form name="test_rakshakavach" onsubmit="return validateForm()" method="post" action="" >  
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">YOG-E @Rakshakavach Test <?php if($check_availability_of_test_res['test_type'] == 1){ echo 'Basic'; }else if($check_availability_of_test_res['test_type'] == 5) {echo 'Advanced'; } ?></h1>
            <p>A Yog based test invented and developed by dr sadanand rasal. This YOG-E Rakshakavach test diagnoses health status, health risk, health alerts, dosha, kohsa, immune rakshakavach, covid risk, organ risk, system health, psychological assessment, stress, risk of complications, period of recovery.</p>
            <p><b>Instructions before doing test to be followed:</b>  
              <ol>
                <li>Do test empty stomach early moring after sunrise for best results</li>
                <li>Do test in well illunimated room</li>
                <li>Room should be free of dust, open space, ventilated and adequate free  space available</li>
                <li>Wear simple easy light weight and cotton clothing while performing test</li>
                <li>Preferrably stand facing east direction while doing test kriyas</li>
                <li>Note self observations without analysing it, note your feel(anubhuti)</li>
                <li>Note what you feel yourself, rather than being guided by somebody else</li>
                <li>Perform all the kriya's as shown in video, do not skip or do kriya in hurry</li>
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
        
          
            <div class="form-group" id="test1">
                <label><strong>1. Stand with feet , knee's, thigh's touching each other. Straighten the body , expand your chest  and straighten the neck, close eye's, hand's lying straight on side's, focus on balance of your body and observe your balance . Do this for 20 second. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/rrusx8bSnrk" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a> </strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test1[]" value="['Falling toward's right side','right','ap']" id="test11">
                    <label class="form-check-label option" for="test11">Falling toward's right side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test1[]" value="['Falling toward's left side','left','an']" id="test12">
                    <label class="form-check-label option" for="test12">Falling toward's left side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test1[]" value="['Falling in front','pr','sa']" id="test13">
                    <label class="form-check-label option" for="test13">Falling in front</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test1[]" value="['Falling backward','vy','ud']" id="test14">
                    <label class="form-check-label option" for="test14">Falling backward</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test1[]" value="['All of above','right','ap','left','an','pr','sa','vy','ud']" id="test15">
                    <label class="form-check-label option" for="test15">All of above</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test1[]" value="['None of above','re']" id="test16">
                    <label class="form-check-label option" for="test16">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test2">
                <label><strong>2. Stand with shoulder distance between feet, expand your chest fully, Press your shoulders backwards. Extend your hands  behind your back with palms crossed over each other(vishram pose), Extend your neck backward and hold this position for 20 second and look for: <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/l3QIjcIQZfo" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a> </strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test2[]" value="['Pain and stiffness in chest muscle','pr','an']" id="test21">
                    <label class="form-check-label option" for="test21">Pain and stiffness in chest muscle</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test2[]" value="['Pain and stiffness in back muscle','vy','ma']" id="test22">
                    <label class="form-check-label option" for="test22">Pain and stiffness in back muscle</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test2[]" value="['Pain and stiffness in shoulders (right or left or both)','ap','sw']" id="test23">
                    <label class="form-check-label option" for="test23">Pain and stiffness in shoulders (right or left or both)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test2[]" value="['Pain and stiffness in your neck','ud','vi']" id="test24">
                    <label class="form-check-label option" for="test24">Pain and stiffness in your neck</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test2[]" value="['All of above','pr','an','vy','ma','ap','sw','ud','vi']" id="test25">
                    <label class="form-check-label option" for="test25">All of above</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test2[]" value="['None of above']" id="test26">
                    <label class="form-check-label option" for="test26">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test3">
                <label><strong>3. Stand straight with feet  closely touched to each other .Take your arms from sideways over your head . Let both palm touch each other ,bring them down on  your head, and then extend hands with force upward keeping palms close . Repeat it 5-7 times and look for: <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/g9maqFGvWP4" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test3[]" value="['feeling headache','ud']" id="test31">
                    <label class="form-check-label option" for="test31">feeling headache</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test3[]" value="['Pain or stiffness in neck','vy','vi']" id="test32">
                    <label class="form-check-label option" for="test32">Pain or stiffness in neck</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test3[]" value="['Pain or stiffness in back','vy','ap']" id="test33">
                    <label class="form-check-label option" for="test33">Pain or stiffness in back </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test3[]" value="['Pain or stiffness in  legs','vy','sw']" id="test34">
                    <label class="form-check-label option" for="test34">Pain or stiffness in  legs</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test3[]" value="['All of above','ud','vy','vi','vy','ap','vy','sw']" id="test35">
                    <label class="form-check-label option" for="test35">All of above</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test3[]" value="['None of above']" id="test36">
                    <label class="form-check-label option" for="test36">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test4">
                <label><strong>4. Stand with feets  at shoulder distance apart. keep your hands on your waist. Take a deep breath through nose and hold for a while and exhale through nose .Do this 5-7 times. While breathing watch your chest and abdomen movement. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/CHVYdt7t5oY" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test4[]" value="['Chest expanding more']" id="test41">
                    <label class="form-check-label option" for="test41">Chest expanding more</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test4[]" value="['Abdomen expanding more','ap','sw']" id="test42">
                    <label class="form-check-label option" for="test42">Abdomen expanding more</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test4[]" value="['Both are expanding','pr','ap']" id="test43">
                    <label class="form-check-label option" for="test43">Both are expanding</label>
                </div>
            </div>

            <div class="form-group" id="test5">
                <label for="formControlRange"><strong>5. Keep feets close , extend yor neck straight upward and extend it backward  keep eyes closed. Hold in this position with normal breathing for 20 seconds. Are you loosing balance? <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/Y6czSWibXQI" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test5[]" id="test51" value="['yes','ud','sa']">
                    <label class="form-check-label option" for="test51">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test5[]" id="test52" value="['No']">
                    <label class="form-check-label option" for="test52">No</label>
                </div>
            </div>

            <div class="form-group" id="test6">
                <label><strong>6. (Simple forward step with spine twist) take a step  forward with right leg. Raise your hands  sideways, hold them at shoulder level  and take a twist above waist on right  side .Do this 3-4 times .  Then  take  a step forward  with left leg,Raise your hands sideways ,hold them at shoulder leveland take a twist above waist on left  side .do This 3-4 times. Observe and feel for: <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/RD3bgmYx_Iw" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test6[]" value="['Pain or stiffness in shoulder','ap','ma']" id="test61">
                    <label class="form-check-label option" for="test61">Pain or stiffness in shoulder</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test6[]" value="['Pain or stiffness in abdomen','ap','ma']" id="test62">
                    <label class="form-check-label option" for="test62">Pain or stiffness in abdomen</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test6[]" value="['Pain or stiffness in lower back','sa','sw']" id="test63">
                    <label class="form-check-label option" for="test63">Pain or stiffness in lower back</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test6[]" value="['Pain or stiffness in butt','ap','mu']" id="test64">
                    <label class="form-check-label option" for="test64">Pain or stiffness in butt</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test6[]" value="['Pain or stiffness thigh','vy','mu']" id="test65">
                    <label class="form-check-label option" for="test65">Pain or stiffness thigh</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test6[]" value="['None of above']" id="test66">
                    <label class="form-check-label option" for="test66">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test7">
                <label><strong>7. ( chanting for vibration in chest) Stand with feet at shoulder distance apart , take a deep breath hold it, touching the palm on chest and chant in hormoney in medium tone"Haa" and feel the vibration , do it on both sides for upper, middle, lower and sides of your chest, Do this for 5-10 breathes. feel for vibrations in chest . feel on both sides.and answer <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/0JOEbL9H-6A" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="row">
                  <div class="col-md-2">
                    <label class="form-check-label"><b>Upper Chest : </b></label>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input option" type="checkbox" name="test7[]" id="test71" value="1">
                      <label class="form-check-label option" for="test71">Right Side</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input option" type="checkbox" name="test7[]" id="test72" value="2">
                      <label class="form-check-label option" for="test72">Left Side</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label class="form-check-label"><b>Middle Part : </b></label>
                  </div>
                  <div class="col-md-4">  
                    <div class="form-check form-check-inline">
                      <input class="form-check-input option" type="checkbox" name="test7[]" id="test73" value="3">
                      <label class="form-check-label option" for="test73">Right Side</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input option" type="checkbox" name="test7[]" id="test74" value="4">
                      <label class="form-check-label option" for="test74">Left Side</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label class="form-check-label"><b>Lower Part : </b></label><br>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input option" type="checkbox" name="test7[]" id="test75" value="5">
                      <label class="form-check-label option" for="test75">Right Side</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input option" type="checkbox" name="test7[]" id="test76" value="6">
                      <label class="form-check-label option" for="test76">Left Side</label>
                    </div>
                  </div>  
                </div>
            </div>

            <div class="form-group" id="test8">
                <label><strong>8. Stand with feet  at shoulder distance apart. Close the ear with thumbs. Do not use the nail part of thumb, just the soft part of thumb, close eyes, and hold for 20 second and observe. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/RmyvJIAmVCM" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test8[]" value="['feeling ear blocked or pressure in ear','ud','pr']" id="test81">
                    <label class="form-check-label option" for="test81">feeling ear blocked or pressure in ear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test8[]" value="['sounds of breathing in ear','re']" id="test82">
                    <label class="form-check-label option" for="test82">sounds of breathing in ear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test8[]" value="['ringing or cracking or tinnitus','ud','vi']" id="test83">
                    <label class="form-check-label option" for="test83">ringing or cracking or tinnitus</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test8[]" value="['calmness','re']" id="test84">
                    <label class="form-check-label option" for="test84">calmness</label>
                </div>
            </div>

            <div class="form-group" id="test9">
                <label for="formControlRange"><strong>9. Stand with feet at shoulder distance apart close your eyes and gently touch  your eyes with tips of middle and index finger. do not press the eyes. feel for 20 sec and observe does your eyes move? <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/yqYWhPdT9Cc" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test9[]" id="test91" value="['yes','ud','st']">
                    <label class="form-check-label option" for="test91">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test9[]" id="test92" value="['No']">
                    <label class="form-check-label option" for="test92">No</label>
                </div>
            </div>

            <div class="form-group" id="test10">
                <label><strong>10. Stand with feet at shoulder distance apart,  keep  your eyes closed, and hold gently your forehead with all fingers except thumb, breathing deeply for atleast 2 minutes. observe for, what are the thoughts coming in your mind? <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/IHtfsej2AKo" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['many thought','st']" id="test101">
                    <label class="form-check-label option" for="test101">many thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['daily work','st']" id="test102">
                    <label class="form-check-label option" for="test102">daily work</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['games or entertainment or movies','re']" id="test103">
                    <label class="form-check-label option" for="test103">games or entertainment or movies</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['worries or feeling fear','de']" id="test104">
                    <label class="form-check-label option" for="test104">worries or feeling fear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['people you know','de']" id="test105">
                    <label class="form-check-label option" for="test105">people you know</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['news  reports','ax']" id="test106">
                    <label class="form-check-label option" for="test106">news  reports </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['feeling spiritual','re']" id="test107">
                    <label class="form-check-label option" for="test107">feeling spiritual</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test10[]" value="['no thoughts','re']" id="test108">
                    <label class="form-check-label option" for="test108">no thoughts</label>
                </div>
            </div>

            <div class="form-group" id="test11">
                <label><strong>11. Stand at ease with feet at shoulder length apart , touch your face with your palms hold in this postion for 20 second and observe. How do you feel your touch? <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/7aOWaQZWQZ4" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test11[]" value="['soft','re']" id="test111">
                    <label class="form-check-label option" for="test111">soft</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test11[]" value="['hard','st']" id="test112">
                    <label class="form-check-label option" for="test112">hard</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test11[]" value="['warm','ax']" id="test113">
                    <label class="form-check-label option" for="test113">warm</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test11[]" value="['cold','de']" id="test114">
                    <label class="form-check-label option" for="test114">cold</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test11[]" value="['supportive','ax']" id="test115">
                    <label class="form-check-label option" for="test115">supportive</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test11[]" value="['nothing','st']" id="test116">
                    <label class="form-check-label option" for="test116">No feelings after touch</label>
                </div>
            </div>

            <div class="form-group" id="test12">
                <label for="formControlRange"><strong>12. Sit on the chair, resting hands on thighs, close eyes for 20 secons and focus on the saliva in your mouth. Feel your saliva and answer: <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/R1HgUCW7Eek" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test12[]" id="test121" value="['cold saliva','lo']">
                    <label class="form-check-label option" for="test121">cold saliva</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test12[]" id="test122" value="['warm saliva','vi']">
                    <label class="form-check-label option" for="test122">warm saliva</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test12[]" id="test123" value="['normal']">
                    <label class="form-check-label option" for="test123">normal</label>
                </div>
            </div>

            <div class="form-group" id="test13">
                <label for="formControlRange"><strong>13. Is your sense of taste  normal. Can you taste food? <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/skbAp556tV0" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test13[]" id="test131" value="['yes']">
                    <label class="form-check-label option" for="test131">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test13[]" id="test132" value="['no','ts']">
                    <label class="form-check-label option" for="test132">no</label>
                </div>
            </div>

            <div class="form-group" id="test14">
                <label><strong>14. Sit on chair, hold your back straight, close eyes and tick which food you desire <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/kAtquDA72w0" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test14[]" value="['sweet','kf']" id="test141">
                    <label class="form-check-label option" for="test141">sweet</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test14[]" value="['sour','vt']" id="test142">
                    <label class="form-check-label option" for="test142">sour</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test14[]" value="['bitter','pt','ma']" id="test143">
                    <label class="form-check-label option" for="test143">bitter</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test14[]" value="['spicy','pt']" id="test144">
                    <label class="form-check-label option" for="test144">spicy</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test14[]" value="['None of above']" id="test145">
                    <label class="form-check-label option" for="test145">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test15">
                <label><strong>15. Breathe  from right nostril .Inhale and exhale 5-7 times. Repeat the same from left nostril. Are you feeling your nose is blocked? <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/mATFw27ytXc" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test15[]" value="['right nostril blocked','pi','vy']" id="test151">
                    <label class="form-check-label option" for="test151">right nostril blocked</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test15[]" value="['left nostril blocked','id','an']" id="test152">
                    <label class="form-check-label option" for="test152">left nostril blocked</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test15[]" value="['both nostril blocked','pi','vy','id','an']" id="test153">
                    <label class="form-check-label option" for="test153">both nostril blocked</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test15[]" value="['None of above']" id="test154">
                    <label class="form-check-label option" for="test154">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test16">
                <label for="formControlRange"><strong>16. Breath from nose. Hold your hand beneath nose. Inhale and exale 5-7 times. Feel air flowing from nose, is it warm or cold. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/cSSx_wzvsDY" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test16[]" id="test161" value="['warm  breath','pr','st']">
                    <label class="form-check-label option" for="test161">warm  breath </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test16[]" id="test162" value="['cold breath','ap','lo']">
                    <label class="form-check-label option" for="test162">cold breath </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test16[]" id="test163" value="['None of above']">
                    <label class="form-check-label option" for="test163">None of above</label>
                </div>
            </div>
            
            <div class="form-group" id="test17">
                <label for="formControlRange"><strong>17. Is your sense of smelling normal. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/MmqdPzvG870" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test17[]" id="test171" value="['yes']">
                    <label class="form-check-label option" for="test171">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test17[]" id="test172" value="['no','sm']">
                    <label class="form-check-label option" for="test172">no</label>
                </div>
            </div>

            <div class="form-group" id="test18">
                <label><strong>18. Stand erect or Sit on chair holding back straight. Place both palms on your abdomen, place your hands on the sides of navel, take care not to overlap the fingers. both hands should not touch each other, keep breathing gently with closed eyes. focus on your navel. hold for 20 seconds and observe <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/1WQAAb3VpR8" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test18[]" value="['feeling gurgling or movement of bowel','ap','ma']" id="test181">
                    <label class="form-check-label option" for="test181">feeling gurgling or movement of bowel</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test18[]" value="['feeling fullness  or bloated','ap','ma']" id="test182">
                    <label class="form-check-label option" for="test182">feeling fullness  or bloated</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test18[]" value="['feeling tightness or uneasy','ap','sw']" id="test183">
                    <label class="form-check-label option" for="test183">feeling tightness or uneasy</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test18[]" value="['feeling warm','ap','ma']" id="test184">
                    <label class="form-check-label option" for="test184">feeling warm</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test18[]" value="['feeling  cold','sa','sw']" id="test185">
                    <label class="form-check-label option" for="test185">feeling  cold</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test18[]" value="['None of above']" id="test186">
                    <label class="form-check-label option" for="test186">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test19">
                <label for="formControlRange"><strong>19. Stand with feet close to each other, great toe, knee, thighs touching each other. Extend your hands sideways upto shoulder level. Press your thumb with your index finger(gyan mudra) and close eyes. Breath gently for 20 second watch for your balance. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/E6y_lL0JEGU" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test19[]" id="test191" value="['feeling imbalance','ud']">
                    <label class="form-check-label option" for="test191">feeling imbalance</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test19[]" id="test192" value="['feeling balance improved','sa']">
                    <label class="form-check-label option" for="test192">feeling balance improved</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test19[]" id="test193" value="['None of above']">
                    <label class="form-check-label option" for="test193">None of above</label>
                </div>
            </div>

            <div class="form-group" id="test20">
                <label><strong>20. Do spot running  for-  
                    <ul>
                        <li>50 step  if you are above 65 yr old </li>
                        <li>100 steps if you are above 50 -65 yr  </li>
                        <li>150 steps if you are 40-50yr.</li>
                        <li>200 steps if you are less than 40 yr </li>
                    </ul>   
                    (This test not to be done by pregnant or heart patient undergone surgery or severe heart disease) <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/E6pIyvd_G3o" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong>
                </label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['run the steps for as per age']" id="test201">
                    <label class="form-check-label option" for="test201">run the steps for as per age</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['feeling too much tired','pr']" id="test202">
                    <label class="form-check-label option" for="test202">feeling too much tired</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['can feel heart beats are fast','sa']" id="test203">
                    <label class="form-check-label option" for="test203">can feel heart beats are fast</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['feeling chest pain','sa','an']" id="test204">
                    <label class="form-check-label option" for="test204">feeling chest pain</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['feeling too much fast breathing','pr']" id="test205">
                    <label class="form-check-label option" for="test205">feeling too much fast breathing</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['feeling breathless','pr','sa']" id="test206">
                    <label class="form-check-label option" for="test206">feeling breathless</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['sweating more than normal','sa']" id="test207">
                    <label class="form-check-label option" for="test207">sweating more than normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['feeling giddiness','sa','pr']" id="test208">
                    <label class="form-check-label option" for="test208">feeling giddiness </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['None of above']" id="test209">
                    <label class="form-check-label option" for="test209">None of above</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test20[]" value="['I am heart patient/ pregnant lady/ severe orthopaedic illness/ critical patient so cannot do this kriya']" id="test2010">
                    <label class="form-check-label option" for="test2010">I am heart patient/ pregnant lady/ severe orthopaedic illness/ critical patient so cannot do this kriya.</label>
                </div>
            </div>

            <div class="form-group" id="test21">
                <label><strong>21. Stand with legs crossed against each other ( lord krishna with basuri pose). Close eyes, hold your hands like basuri/flute. Hold for 20 sec. What thoughts  came in your mind. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/7NVQVtyCeZQ" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test21[]" value="['past issues','de']" id="test211">
                    <label class="form-check-label option" for="test211">past issues</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test21[]" value="['present issues','st']" id="test212">
                    <label class="form-check-label option" for="test212">present issues</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test21[]" value="['future insecuriteis','ax']" id="test213">
                    <label class="form-check-label option" for="test213">future insecuriteis</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test21[]" value="['feeling loneliness','de']" id="test214">
                    <label class="form-check-label option" for="test214">feeling loneliness</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test21[]" value="['feeling loved','re']" id="test215">
                    <label class="form-check-label option" for="test215">feeling loved</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test21[]" value="['no thoughts','re']" id="test216">
                    <label class="form-check-label option" for="test216">no thoughts</label>
                </div>
            </div>

            <div class="form-group" id="test22">
                <label><strong>22. Do either A or B <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/wVKpPUMzdLU" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a>
                    <ol type="A" style="margin-bottom:0">
                        <li>For those who can sit in vajrasan: Sit in vajrasan holding back straight , relaxfully keeping your hands on the thighs close your eyes. Observe.</li>    
                        <li>For those   who cannot do vajrasan: sit on a stool of comfortable height for you, hold back straight and move your feet slightly behind . </li>
                    </ol></strong>
                </label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in back','vy','sw']" id="test221">
                    <label class="form-check-label option" for="test221">pain in back</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in hip','ap','sw']" id="test222">
                    <label class="form-check-label option" for="test222">pain in hip</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in knee','vy']" id="test223">
                    <label class="form-check-label option" for="test223">pain in knee</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in thigh or leg','vy']" id="test224">
                    <label class="form-check-label option" for="test224">pain in thigh or leg</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in ankle or foot','vy']" id="test225">
                    <label class="form-check-label option" for="test225">pain in ankle or foot</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['feeling heart beats','sa','an']" id="test226">
                    <label class="form-check-label option" for="test226">feeling heart beats</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in groin','sw','mu']" id="test227">
                    <label class="form-check-label option" for="test227">pain in groin</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in tail bone','ap','mu']" id="test228">
                    <label class="form-check-label option" for="test228">pain in tail bone</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['pain in rectum/anus','sw','mu']" id="test229">
                    <label class="form-check-label option" for="test229">pain in rectum/anus</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['good thought','re']" id="test2210">
                    <label class="form-check-label option" for="test2210">good thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['sad  or fearful thought','de','mu']" id="test2211">
                    <label class="form-check-label option" for="test2211">sad  or fearful thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test22[]" value="['no thought','re']" id="test2212">
                    <label class="form-check-label option" for="test2212">no thought</label>
                </div>
            </div>

            <div class="form-group" id="test23">
                <label for="formControlRange"><strong>23. Measure body temperature by glass thermometer or digital thermometer . Do not measure in ac room , or immediately after drinking or eating anything. Keep thermometer under your tongue for 2-3 min. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/ox661ZsdSOg" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test23[]" id="test231" value="['below 98.6']">
                    <label class="form-check-label option" for="test231">below 98.4<sup>0</sup> F</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test23[]" id="test232" value="['above 98.6','fe']">
                    <label class="form-check-label option" for="test232">above 98.4<sup>0</sup> F</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="radio" name="test23[]" id="test233" value="['above 100','fe','fe']">
                    <label class="form-check-label option" for="test233">above 100<sup>0</sup> F</label>
                </div>
            </div>

            <div class="form-group" id="test24">
                <label><strong>24. Take a deep breath and try doing as much suryanamaskar holding the breath. Do this only once. Do not repeat it second time.( this test not to be done by pregnant or heart patient undergone surgery or severe heart disease) <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/UJYiaAUQBu0" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['less than one','pr']" id="test241">
                    <label class="form-check-label option" for="test241">less than one</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['1 suryanamaskar','st']" id="test242">
                    <label class="form-check-label option" for="test242">1 suryanamaskar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['2 suryanamaskar','re']" id="test243">
                    <label class="form-check-label option" for="test243">2 suryanamkar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['3 suryanamaskar','re']" id="test244">
                    <label class="form-check-label option" for="test244">3 suryanamaskar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['4 suryanamaskar','re']" id="test245">
                    <label class="form-check-label option" for="test245">4 suryanamaskar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['feeling too much breathlessness','pr','an']" id="test246">
                    <label class="form-check-label option" for="test246">feeling too much breathlessness</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['can not hold breath for more than 20 sec','sa','an']" id="test247">
                    <label class="form-check-label option" for="test247">can not hold breath for more than 20 sec</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['feeling palpitation','sa','an']" id="test248">
                    <label class="form-check-label option" for="test248">feeling palpitation</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['feeling giddiness','vy']" id="test249">
                    <label class="form-check-label option" for="test249">feeling giddiness</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['feeling body pain','pr']" id="test2410">
                    <label class="form-check-label option" for="test2410">feeling body pain</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option" type="checkbox" name="test24[]" value="['I am heart patient/ pregnant lady/ severe orthopaedic illness/ critical patient so cannot do this kriya']" id="test2411">
                    <label class="form-check-label option" for="test2411">I am heart patient/ pregnant lady/ severe orthopaedic illness/ critical patient so cannot do this kriya</label>
                </div>
            </div>

            <div class="form-group" id="test25">
                <label><strong>25. Observation's of your early morning urine. <a type="button" href="" class="video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/ZwG2U-cPJEU" data-target="#myModal">( Watch Video <i class="fas fa-film"></i> )</a></strong></label>
                <div class="form-check">
                    <input class="form-check-input option test25" type="checkbox" name="test25[]" value="['normal color']" id="test251">
                    <label class="form-check-label option" for="test251">normal color</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option test25" type="checkbox" name="test25[]" value="['yellow','sw']" id="test252">
                    <label class="form-check-label option" for="test252">yellow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option test25" type="checkbox" name="test25[]" value="['dark yellow','mu']" id="test253">
                    <label class="form-check-label option" for="test253">dark yellow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option test25" type="checkbox" name="test25[]" value="['hot urine','mu']" id="test254">
                    <label class="form-check-label option" for="test254">hot urine</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option test25" type="checkbox" name="test25[]" value="['burning pain while urination','mu']" id="test255">
                    <label class="form-check-label option" for="test255">burning pain while urination</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input option test25" type="checkbox" name="test25[]" value="['bad odour/smell of urine','mu']" id="test256">
                    <label class="form-check-label option" for="test256">bad odour/smell of urine</label>
                </div>
            </div>

            <div class="form-group">
              <label for="other_complaint"><strong>Any other complaints ?</strong></label>
              <textarea class="form-control" name="other_complaint" id="other_complaint" rows="3"></textarea>
            </div>

            <input type="submit" id="submit" name="submit_test" class="btn btn-primary" value="Submit Test">
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

  <!-- Modal for video playing -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>        
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <!-- Modal for video playing -->


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

  <script>

    // validation of user input
    // Check whether all questions are attempted or not
    function validateForm() {
      //loop through all questions 
      //each question have id test<sr_number>
      for(var i=1; i<26; i++){
        if(i !== 7){
        var testID = "#test" + i;

        //check for perticular quesion any option is selected or not
        //if not selected return false
        if($(testID + ' input:checked').length === 0){
          alert("Question " + i + " is not attenpted.");
          return false;
        }
      }
      }
      
      return true;
    }


    $(document).ready(function() {

      // Gets the video src from the data-src on each button
      var $videoSrc;  
      $('.video-btn').click(function() {
          $videoSrc = $(this).data( "src" );
      });
      console.log($videoSrc);
        
      // when the modal is opened autoplay it  
      $('#myModal').on('shown.bs.modal', function (e) {
          
      // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
      $("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
      })

      // stop playing the youtube video when I close the modal
      $('#myModal').on('hide.bs.modal', function (e) {
          // a poor man's stop video
          $("#video").attr('src',$videoSrc); 
      });
      
      
      

      // For question 1
      // If all of above selected then disable other box
      $("#test15").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test11");
          disable_option("#test12");
          disable_option("#test13");
          disable_option("#test14");
          disable_option("#test16");
          check_option("#test11");
          check_option("#test12");
          check_option("#test13");
          check_option("#test14");
        }else{
          enable_option("#test11");
          enable_option("#test12");
          enable_option("#test13");
          enable_option("#test14");
          enable_option("#test16");
          uncheck_option("#test11");
          uncheck_option("#test12");
          uncheck_option("#test13");
          uncheck_option("#test14");
        }
      });

      // if none selected disable other box
      $("#test16").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test11");
          disable_option("#test12");
          disable_option("#test13");
          disable_option("#test14");
          disable_option("#test15");
          uncheck_option("#test11");
          uncheck_option("#test12");
          uncheck_option("#test13");
          uncheck_option("#test14");
        }else{
          enable_option("#test11");
          enable_option("#test12");
          enable_option("#test13");
          enable_option("#test14");
          enable_option("#test15");
        }
      });
      // For question 1

      // For question 2
      // If all of above selected then disable other box
      $("#test25").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test21");
          disable_option("#test22");
          disable_option("#test23");
          disable_option("#test24");
          disable_option("#test26");
          check_option("#test21");
          check_option("#test22");
          check_option("#test23");
          check_option("#test24");
        }else{
          enable_option("#test21");
          enable_option("#test22");
          enable_option("#test23");
          enable_option("#test24");
          enable_option("#test26");
          uncheck_option("#test21");
          uncheck_option("#test22");
          uncheck_option("#test23");
          uncheck_option("#test24");
        }
      });

      // if none selected disable other box
      $("#test26").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test21");
          disable_option("#test22");
          disable_option("#test23");
          disable_option("#test24");
          disable_option("#test25");
          uncheck_option("#test21");
          uncheck_option("#test22");
          uncheck_option("#test23");
          uncheck_option("#test24");
        }else{
          enable_option("#test21");
          enable_option("#test22");
          enable_option("#test23");
          enable_option("#test24");
          enable_option("#test25");
        }
      });
      // For question 2

      // For question 3
      // If all of above selected then disable other box
      $("#test35").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test31");
          disable_option("#test32");
          disable_option("#test33");
          disable_option("#test34");
          disable_option("#test36");
          check_option("#test31");
          check_option("#test32");
          check_option("#test33");
          check_option("#test34");
        }else{
          enable_option("#test31");
          enable_option("#test32");
          enable_option("#test33");
          enable_option("#test34");
          enable_option("#test36");
          uncheck_option("#test31");
          uncheck_option("#test32");
          uncheck_option("#test33");
          uncheck_option("#test34");
        }
      });

      // if none selected disable other box
      $("#test36").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test31");
          disable_option("#test32");
          disable_option("#test33");
          disable_option("#test34");
          disable_option("#test35");
          uncheck_option("#test31");
          uncheck_option("#test32");
          uncheck_option("#test33");
          uncheck_option("#test34");
        }else{
          enable_option("#test31");
          enable_option("#test32");
          enable_option("#test33");
          enable_option("#test34");
          enable_option("#test35");
        }
      });
      // For question 3

      // For question 6
      // if none selected disable other box
      $("#test66").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test61");
          disable_option("#test62");
          disable_option("#test63");
          disable_option("#test64");
          disable_option("#test65");
          uncheck_option("#test61");
          uncheck_option("#test62");
          uncheck_option("#test63");
          uncheck_option("#test64");
          uncheck_option("#test65");
        }else{
          enable_option("#test61");
          enable_option("#test62");
          enable_option("#test63");
          enable_option("#test64");
          enable_option("#test65");
        }
      });
      // For question 6

      // For question 10
      // if none selected disable other box
      $("#test108").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test101");
          disable_option("#test102");
          disable_option("#test103");
          disable_option("#test104");
          disable_option("#test105");
          disable_option("#test106");
          disable_option("#test107");
          uncheck_option("#test101");
          uncheck_option("#test102");
          uncheck_option("#test103");
          uncheck_option("#test104");
          uncheck_option("#test105");
          uncheck_option("#test106");
          uncheck_option("#test107");
        }else{
          enable_option("#test101");
          enable_option("#test102");
          enable_option("#test103");
          enable_option("#test104");
          enable_option("#test105");
          enable_option("#test106");
          enable_option("#test107");
        }
      });
      // For question 10

      // For question 14
      // if none selected disable other box
      $("#test145").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test141");
          disable_option("#test142");
          disable_option("#test143");
          disable_option("#test144");
          uncheck_option("#test141");
          uncheck_option("#test142");
          uncheck_option("#test143");
          uncheck_option("#test144");
        }else{
          enable_option("#test141");
          enable_option("#test142");
          enable_option("#test143");
          enable_option("#test144");
        }
      });
      // For question 14

      // For question 15
      // If all of above selected then disable other box
      $("#test153").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test151");
          disable_option("#test152");
          disable_option("#test154");
          check_option("#test151");
          check_option("#test152");
        }else{
          enable_option("#test151");
          enable_option("#test152");
          enable_option("#test154");
          uncheck_option("#test151");
          uncheck_option("#test152");
        }
      });

      // if none selected disable other box
      $("#test154").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test151");
          disable_option("#test152");
          disable_option("#test153");
          uncheck_option("#test151");
          uncheck_option("#test152");
        }else{
          enable_option("#test151");
          enable_option("#test152");
          enable_option("#test153");
        }
      });
      // For question 15

      // For question 18
      // if none selected disable other box
      $("#test186").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test181");
          disable_option("#test182");
          disable_option("#test183");
          disable_option("#test184");
          disable_option("#test185");
          uncheck_option("#test181");
          uncheck_option("#test182");
          uncheck_option("#test183");
          uncheck_option("#test184");
          uncheck_option("#test185");
        }else{
          enable_option("#test181");
          enable_option("#test182");
          enable_option("#test183");
          enable_option("#test184");
          enable_option("#test185");
        }
      });
      // For question 18

      // For question 20
      // if none selected disable other box
      $("#test209").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test201");
          disable_option("#test202");
          disable_option("#test203");
          disable_option("#test204");
          disable_option("#test205");
          disable_option("#test206");
          disable_option("#test207");
          disable_option("#test208");
          disable_option("#test2010");
          uncheck_option("#test201");
          uncheck_option("#test202");
          uncheck_option("#test203");
          uncheck_option("#test204");
          uncheck_option("#test205");
          uncheck_option("#test206");
          uncheck_option("#test207");
          uncheck_option("#test208");
          uncheck_option("#test2010");
        }else{
          enable_option("#test201");
          enable_option("#test202");
          enable_option("#test203");
          enable_option("#test204");
          enable_option("#test205");
          enable_option("#test206");
          enable_option("#test207");
          enable_option("#test208");
          enable_option("#test2010");
        }
      });

      $("#test2010").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test201");
          disable_option("#test202");
          disable_option("#test203");
          disable_option("#test204");
          disable_option("#test205");
          disable_option("#test206");
          disable_option("#test207");
          disable_option("#test208");
          disable_option("#test209");
          uncheck_option("#test201");
          uncheck_option("#test202");
          uncheck_option("#test203");
          uncheck_option("#test204");
          uncheck_option("#test205");
          uncheck_option("#test206");
          uncheck_option("#test207");
          uncheck_option("#test208");
          uncheck_option("#test209");
        }else{
          enable_option("#test201");
          enable_option("#test202");
          enable_option("#test203");
          enable_option("#test204");
          enable_option("#test205");
          enable_option("#test206");
          enable_option("#test207");
          enable_option("#test208");
          enable_option("#test209");
        }
      });
      // For question 20

      // For question 21
      $("#test216").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test211");
          disable_option("#test212");
          disable_option("#test213");
          disable_option("#test214");
          disable_option("#test215");
          uncheck_option("#test211");
          uncheck_option("#test212");
          uncheck_option("#test213");
          uncheck_option("#test214");
          uncheck_option("#test215");
        }else{
          enable_option("#test211");
          enable_option("#test212");
          enable_option("#test213");
          enable_option("#test214");
          enable_option("#test215");
        }
      });
      // For question 21

      // For question 24
      // from first 4 only one option is to be selected
      $("#test241").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test242");
          disable_option("#test243");
          disable_option("#test244");
          disable_option("#test245");
        }else{
          enable_option("#test242");
          enable_option("#test243");
          enable_option("#test244");
          enable_option("#test245");
        }
      });
      $("#test242").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test241");
          disable_option("#test243");
          disable_option("#test244");
          disable_option("#test245");
        }else{
          enable_option("#test241");
          enable_option("#test243");
          enable_option("#test244");
          enable_option("#test245");
        }
      });
      $("#test243").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test242");
          disable_option("#test241");
          disable_option("#test244");
          disable_option("#test245");
        }else{
          enable_option("#test242");
          enable_option("#test241");
          enable_option("#test244");
          enable_option("#test245");
        }
      });
      $("#test244").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test242");
          disable_option("#test243");
          disable_option("#test241");
          disable_option("#test245");
        }else{
          enable_option("#test242");
          enable_option("#test243");
          enable_option("#test241");
          enable_option("#test245");
        }
      });
      $("#test245").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test242");
          disable_option("#test243");
          disable_option("#test244");
          disable_option("#test241");
        }else{
          enable_option("#test242");
          enable_option("#test243");
          enable_option("#test244");
          enable_option("#test241");
        }
      });

      $("#test2411").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test241");
          disable_option("#test242");
          disable_option("#test243");
          disable_option("#test244");
          disable_option("#test245");
          disable_option("#test246");
          disable_option("#test247");
          disable_option("#test248");
          disable_option("#test249");
          disable_option("#test2410");
          uncheck_option("#test241");
          uncheck_option("#test242");
          uncheck_option("#test243");
          uncheck_option("#test244");
          uncheck_option("#test245");
          uncheck_option("#test246");
          uncheck_option("#test247");
          uncheck_option("#test248");
          uncheck_option("#test249");
          uncheck_option("#test2410");
        }else{
          enable_option("#test241");
          enable_option("#test242");
          enable_option("#test243");
          enable_option("#test244");
          enable_option("#test245");
          enable_option("#test246");
          enable_option("#test247");
          enable_option("#test248");
          enable_option("#test249");
          enable_option("#test2410");
        }
      });
      // For question 24

      // For question 25
      // from first 3 only one option is to be selected
      $("#test251").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test252");
          disable_option("#test253");
        }else{
          enable_option("#test252");
          enable_option("#test253");
        }
      });
      $("#test252").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test251");
          disable_option("#test253");
        }else{
          enable_option("#test251");
          enable_option("#test253");
        }
      });
      $("#test253").change(function () {
        if($(this).is(":checked")) {
          disable_option("#test252");
          disable_option("#test251");
        }else{
          enable_option("#test252");
          enable_option("#test251");
        }
      });
     
      // For question 24


      // FUnction to disable perticular checkbox through id sent during function call
      function disable_option(disable_element) {
        $(disable_element).prop("disabled", !this.checked);
      }

      // FUnction to enable perticular checkbox through id sent during function call
      function enable_option(enable_element) {
        $(enable_element).removeAttr("disabled");
      }

      // Function to check box
      function check_option(check_element) {
        // $(check_element).removeAttr("disabled");
        $(check_element).prop('checked', true);
      }

      // Function to uncheck box
      function uncheck_option(uncheck_element) {
        // $(uncheck_element).removeAttr("disabled");
        $(uncheck_element).prop('checked', false);
      }


    // document ready  
    });
  </script>

</body>

</html>

<?php 

    if(isset($_POST['submit_test'])){
      $test1  = mysqli_real_escape_string($con, serialize($_POST['test1']));
      $test2  = mysqli_real_escape_string($con, serialize($_POST['test2']));
      $test3  = mysqli_real_escape_string($con, serialize($_POST['test3']));
      $test4  = mysqli_real_escape_string($con, serialize($_POST['test4']));
      $test5  = mysqli_real_escape_string($con, serialize($_POST['test5']));
      $test6  = mysqli_real_escape_string($con, serialize($_POST['test6']));
      $test7  = mysqli_real_escape_string($con, serialize($_POST['test7']));
      $test8  = mysqli_real_escape_string($con, serialize($_POST['test8']));
      $test9  = mysqli_real_escape_string($con, serialize($_POST['test9']));
      $test10 = mysqli_real_escape_string($con, serialize($_POST['test10']));
      $test11 = mysqli_real_escape_string($con, serialize($_POST['test11']));
      $test12 = mysqli_real_escape_string($con, serialize($_POST['test12']));
      $test13 = mysqli_real_escape_string($con, serialize($_POST['test13']));
      $test14 = mysqli_real_escape_string($con, serialize($_POST['test14']));
      $test15 = mysqli_real_escape_string($con, serialize($_POST['test15']));
      $test16 = mysqli_real_escape_string($con, serialize($_POST['test16']));
      $test17 = mysqli_real_escape_string($con, serialize($_POST['test17']));
      $test18 = mysqli_real_escape_string($con, serialize($_POST['test18']));
      $test19 = mysqli_real_escape_string($con, serialize($_POST['test19']));
      $test20 = mysqli_real_escape_string($con, serialize($_POST['test20']));
      $test21 = mysqli_real_escape_string($con, serialize($_POST['test21']));
      $test22 = mysqli_real_escape_string($con, serialize($_POST['test22']));
      $test23 = mysqli_real_escape_string($con, serialize($_POST['test23']));
      $test24 = mysqli_real_escape_string($con, serialize($_POST['test24']));
      $test25 = mysqli_real_escape_string($con, serialize($_POST['test25']));
      $other_complaint  = mysqli_real_escape_string($con, $_POST['other_complaint']);
//  echo $test7;

//  print_r(unserialize($test7));
// echo gettype($other_complaint);
      $test_id = md5(time().$user_id);
// echo $test_id;
      $get_latest_test_no = "SELECT max(`rakshakavach_test_no`) AS last_test FROM `test_rakshakavach`";
      $get_latest_test_no_run = mysqli_query($con, $get_latest_test_no);
      $get_latest_test_no_res = mysqli_fetch_assoc($get_latest_test_no_run);

      $current_test_no = $get_latest_test_no_res['last_test'] + 1;
// echo $current_test_no;
      // $insert_value = "INSERT INTO `test_rakshakavach`(`test_id`, `rakshakavach_test_no`, `test1`, `test2`, `test3`, `test4`, `test5`, `test6`, `test7`, `test8`, `test9`, `test10`, `test11`, `test12`, `test13`, `test14`, `test15`, `test16`, `test17`, `test18`, `test19`, `test20`, `test21`, `test22`, `test23`, `test24`, `test25`) 
      //                   VALUES ('$test_id', '$current_test_no', '$test1', '$test2', '$test3', '$test4', '$test5', '$test6', '$test7', '$test8', '$test9', '$test10', '$test11', '$test12', '$test13', '$test14', '$test15', '$test16', '$test17', '$test18', '$test19', '$test20', '$test21', '$test22', '$test23', '$test24', '$test25')";

      // $value = "('".$test_id."','".$current_test_no."','".$test1."','".$test2."','".$test3."','".$test4."','".$test5."','".$test6."','".$test7."','".$test8."','".$test9."','".$test10."','".$test11."','".$test12."','".$test13."','".$test14."','".$test15."','".$test16."','".$test17."','".$test18."','".$test19."','".$test20."','".$test21."','".$test22."','".$test23."','".$test24."','".$test25."')";
      // echo $value;
      $insert_value = "INSERT INTO `test_rakshakavach`(`test_id`, `rakshakavach_test_no`, `test1`, `test2`, `test3`, `test4`, `test5`, `test6`, `test7`, `test8`, `test9`, `test10`, `test11`, `test12`, `test13`, `test14`, `test15`, `test16`, `test17`, `test18`, `test19`, `test20`, `test21`, `test22`, `test23`, `test24`, `test25`,`other_complain`) 
                        VALUES ('".$test_id."','".$current_test_no."','".$test1."','".$test2."','".$test3."','".$test4."','".$test5."','".$test6."','".$test7."','".$test8."','".$test9."','".$test10."','".$test11."','".$test12."','".$test13."','".$test14."','".$test15."','".$test16."','".$test17."','".$test18."','".$test19."','".$test20."','".$test21."','".$test22."','".$test23."','".$test24."','".$test25."','".$other_complaint."')";
      
      if($insert_value_run = mysqli_query($con, $insert_value)){
        $update_test_payment = "UPDATE `test_payments` SET `test_id`='$test_id' WHERE `order_id`='$order_id'";
        $update_test_payment_run = mysqli_query($con, $update_test_payment);

        echo "<script>
                //alert('your test is submitted sucessfully. You can see your test receipt and report in All test section.');
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