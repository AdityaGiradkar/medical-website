<?php 
    session_start();
    include("includes/db.php");
    $user_id = $_SESSION['user_id'];

    $user_details = "SELECT * FROM `user` u, `medical_history` m where u.`user_id` = m.`user_id` AND u.`user_id`='$user_id'";
    $user_details_run = mysqli_query($con, $user_details);
    $user_details_res = mysqli_fetch_assoc($user_details_run);

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
            <a class="collapse-item" href="ongoing_treatments.php">Ongoing Treatments</a>
            <a class="collapse-item" href="past_treatments.php">Past Treatments</a>
          </div>
        </div>
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
            <h1 class="h3 text-gray-800">YODHAS RAKSHAKAVACH TEST - Dr. Sadanand Rasal</h1>
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
                <label><strong>1. Stand with feet , knee's, thigh's touching each other. Straighten the body , expand your chest  and straighten the neck, close eye's, hand's lying straight on side's,focus on balance of your body and observe your balance . Do this for 20 second. </strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test1[]" value="Fitness" id="test11">
                    <label class="form-check-label" for="test11">Falling toward's right side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test1[]" value="Weight /obesity" id="test12">
                    <label class="form-check-label" for="test12">Falling toward's left side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test1[]" value="Health issue" id="test13">
                    <label class="form-check-label" for="test13">Falling in front</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test1[]" value="Health issue" id="test14">
                    <label class="form-check-label" for="test13">Falling backward</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test1[]" value="Health issue" id="test14">
                    <label class="form-check-label" for="test14">All of above</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test1[]" value="Health issue" id="test15">
                    <label class="form-check-label" for="test15">None</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>2. Stand with shoulder distance between feet, expand your chest fully, Press your shoulders backwards.  Extend your hands  behind your back with palms crossed over each other(vishram pose) , Extend your neck  backward and hold  this position for 20 second and look for: </strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test2[]" value="Fitness" id="test21">
                    <label class="form-check-label" for="test21">Pain and stiffness in chest muscle</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test2[]" value="Weight /obesity" id="test22">
                    <label class="form-check-label" for="test22">Pain and stiffness in back muscle</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test2[]" value="Health issue" id="test23">
                    <label class="form-check-label" for="test23">Pain and stiffness in shoulders (right or left or both)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test2[]" value="Health issue" id="test24">
                    <label class="form-check-label" for="test24">Pain and stiffness in your neck</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test2[]" value="Health issue" id="test25">
                    <label class="form-check-label" for="test25">None</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>3. Stand straight with feet  closely touched to each other .Take your arms from sideways over your head . Let both palm touch each other ,bring them down on  your head, and then extend hands with force upward keeping palms close . Repeat it 5-7 times and look for:</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test3[]" value="Fitness" id="test31">
                    <label class="form-check-label" for="test31">feeling headache</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test3[]" value="Weight /obesity" id="test32">
                    <label class="form-check-label" for="test32">Pain or stiffness in neck</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test3[]" value="Health issue" id="test33">
                    <label class="form-check-label" for="test33">Pain or stiffness in back </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test3[]" value="Health issue" id="test34">
                    <label class="form-check-label" for="test34">Pain or stiffness in  legs</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test3[]" value="Health issue" id="test35">
                    <label class="form-check-label" for="test35">None</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>4. Stand with feets  at shoulder distance apart. keep your hands on your waist. Take a deep breath through nose and hold for a while and exhale through nose .Do this 5-7 times. While breathing watch your chest and abdomen movement.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test4[]" value="Fitness" id="test41">
                    <label class="form-check-label" for="test41">Chest expanding more</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test4[]" value="Weight /obesity" id="test42">
                    <label class="form-check-label" for="test42">Abdomen expanding more</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test4[]" value="Health issue" id="test43">
                    <label class="form-check-label" for="test43">Both are expanding</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>5. Keep feets close , extend yor neck straight upward and extend it backward  keep eyes closed. Hold in this position with normal breathing for 20 seconds. Are you loosing balance ?</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test5" id="test51" value="option1">
                    <label class="form-check-label" for="test51">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test5" id="test52" value="option2">
                    <label class="form-check-label" for="test52">None</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>6. (Simple forward step with spine twist) take a step  forward with right leg. Raise your hands  sideways, hold them at shoulder level  and take a twist above waist on right  side .Do this 3-4 times .  Then  take  a step forward  with left leg,Raise your hands sideways ,hold them at shoulder leveland take a twist above waist on left  side .do This 3-4 times  . Observe and feel for:</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test6[]" value="Fitness" id="test61">
                    <label class="form-check-label" for="test61">Pain or stiffness in shoulder</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test6[]" value="Weight /obesity" id="test62">
                    <label class="form-check-label" for="test62">Pain or stiffness in abdomen</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test6[]" value="Health issue" id="test63">
                    <label class="form-check-label" for="test63">Pain or stiffness in lower back</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test6[]" value="Health issue" id="test64">
                    <label class="form-check-label" for="test64">Pain or stiffness in butt</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test6[]" value="Health issue" id="test65">
                    <label class="form-check-label" for="test65">Pain or stiffness thigh</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test6[]" value="Health issue" id="test66">
                    <label class="form-check-label" for="test66">None</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>7. ( chanting for vibration in chest) Stand with feet at shoulder distance apart , take a deep breath hold it, touching the palm on chest and chant in hormoney in medium tone"Haa" and feel the vibration , do it on both sides for upper, middle, lower and sides of your chest, Do this for 5-10 breathes. feel for vibrations in chest . feel on both sides.and answer</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test7[]" value="Fitness" id="test71">
                    <label class="form-check-label" for="test71">(upper part) right side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test7[]" value="Weight /obesity" id="test72">
                    <label class="form-check-label" for="test72">(upper part) left side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test7[]" value="Health issue" id="test73">
                    <label class="form-check-label" for="test73">(middle part) right side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test7[]" value="Health issue" id="test74">
                    <label class="form-check-label" for="test74">(middle part) left side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test7[]" value="Health issue" id="test75">
                    <label class="form-check-label" for="test75">(lower part) right side</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test7[]" value="Health issue" id="test76">
                    <label class="form-check-label" for="test76">(lower part) left side</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>8. Stand with feet  at shoulder distance apart. Close the ear with thumbs . Do not use the nail part of thumb, just the soft part of thumb, close eyes, and hold for 20 second and observe.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test8[]" value="Fitness" id="test81">
                    <label class="form-check-label" for="test81">feeling ear blocked or pressure in ear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test8[]" value="Weight /obesity" id="test82">
                    <label class="form-check-label" for="test82">sounds of breathing in ear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test8[]" value="Health issue" id="test83">
                    <label class="form-check-label" for="test83">ringing or cracking or tinnitus</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test8[]" value="Health issue" id="test84">
                    <label class="form-check-label" for="test84">calmness</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>9. stand with feet at shoulder distance apart close your eyes and gently touch  your eyes with tips of middle and index finger . do not press the eyes. feel for 20 sec and observe does your eyes move?</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test9" id="test91" value="option1">
                    <label class="form-check-label" for="test91">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test9" id="test92" value="option2">
                    <label class="form-check-label" for="test92">No</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>10. Stand with feet at shoulder distance apart,  keep  your eyes closed , and hold gently your forehead with all fingers except thumb, breathing deeply for atleast 2 minutes. observe for , what are the thoughts coming in your mind ?</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Fitness" id="test101">
                    <label class="form-check-label" for="test101">many thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Weight /obesity" id="test102">
                    <label class="form-check-label" for="test102">daily work</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Health issue" id="test103">
                    <label class="form-check-label" for="test103">games or entertainment or movies</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Health issue" id="test104">
                    <label class="form-check-label" for="test104">worries or feeling fear</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Health issue" id="test105">
                    <label class="form-check-label" for="test105">people you know</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Health issue" id="test106">
                    <label class="form-check-label" for="test106">news  reports </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Health issue" id="test107">
                    <label class="form-check-label" for="test107">feeling spiritual</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test10[]" value="Health issue" id="test108">
                    <label class="form-check-label" for="test108">no thoughts</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>11. Stand at ease with feet at shoulder length apart , touch your face with your palms hold in this postion for 20 second and observe . How do you feel your touch?</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test11[]" value="Fitness" id="test111">
                    <label class="form-check-label" for="test111">soft</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test11[]" value="Weight /obesity" id="test112">
                    <label class="form-check-label" for="test112">hard</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test11[]" value="Health issue" id="test113">
                    <label class="form-check-label" for="test113">supportive</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test11[]" value="Health issue" id="test114">
                    <label class="form-check-label" for="test114">warm</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test11[]" value="Health issue" id="test115">
                    <label class="form-check-label" for="test115">cold</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test11[]" value="Health issue" id="test116">
                    <label class="form-check-label" for="test116">nothing</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>12. Sit on the chair , resting hands on thighs, close eyes for 20 secons and focus on the saliva in your mouth. Feel your saliva and answer:</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test12" id="test121" value="test4">
                    <label class="form-check-label" for="test121">cold saliva</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test12" id="test122" value="test4">
                    <label class="form-check-label" for="test122">warm saliva</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test12" id="test123" value="option2">
                    <label class="form-check-label" for="test123">normal</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>13. Is your sense of taste  normal. Can you taste food ?</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test13" id="test131" value="option1">
                    <label class="form-check-label" for="test131">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test13" id="test132" value="option2">
                    <label class="form-check-label" for="test132">no</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>14. sit on chair, hold your back straight, close eyes and tick which food you desire</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test14[]" value="Fitness" id="test141">
                    <label class="form-check-label" for="test141">sweet</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test14[]" value="Weight /obesity" id="test142">
                    <label class="form-check-label" for="test142">sour</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test14[]" value="Health issue" id="test143">
                    <label class="form-check-label" for="test143">bitter</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test14[]" value="Health issue" id="test144">
                    <label class="form-check-label" for="test144">spicy</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test14[]" value="Health issue" id="test145">
                    <label class="form-check-label" for="test145">none</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>15. Breathe  from right nostril .Inhale and exhale 5-7 times. Repeat the same from left nostril. Are you feeling your nose is blocked?</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test15[]" value="Fitness" id="test151">
                    <label class="form-check-label" for="test151">right nostril blocked</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test15[]" value="Weight /obesity" id="test152">
                    <label class="form-check-label" for="test152">left nostril blocked</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test15[]" value="Health issue" id="test153">
                    <label class="form-check-label" for="test153">both nostril blocked</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test15[]" value="Health issue" id="test154">
                    <label class="form-check-label" for="test154">none</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>16. Breath from nose. Hold your hand beneath nose. Inhale and exale 5-7 times. Feel air flowing from nose , is it warm or cold.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test16" id="test161" value="option1">
                    <label class="form-check-label" for="test161">warm  breath </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test16" id="test162" value="option2">
                    <label class="form-check-label" for="test162">cold breath </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test16" id="test163" value="option2">
                    <label class="form-check-label" for="test163">None</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="formControlRange"><strong>17. Is your sense of smelling normal.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test17" id="test171" value="option1">
                    <label class="form-check-label" for="test171">yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test17" id="test172" value="option2">
                    <label class="form-check-label" for="test172">no</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>18. Stand erect or Sit on chair holding back straight. Place both palms on your abdomen,place your  hands on the sides of navel ,take care not to overlap the fingers. both  hands should not touch each other, keep breathing gently with closed eyes .focus on your navel. hold for 20 seconds and observe</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test18[]" value="Fitness" id="test181">
                    <label class="form-check-label" for="test181">feeling gurgling or movement of bowel</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test18[]" value="Weight /obesity" id="test182">
                    <label class="form-check-label" for="test182">feeling fullness  or bloated</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test18[]" value="Health issue" id="test183">
                    <label class="form-check-label" for="test183">feeling tightness or uneasy</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test18[]" value="Health issue" id="test184">
                    <label class="form-check-label" for="test184">feeling warm</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test18[]" value="Health issue" id="test185">
                    <label class="form-check-label" for="test185">feeling  cold</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test18[]" value="Health issue" id="test186">
                    <label class="form-check-label" for="test186">none</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>19. Stand with feet close to each other , great toe , knee , thighs touching each other. Extend your hands sideways upto shoulder level. Press your thumb with your index finger(gyan mudra) and close eyes . Breath gently for 20 second  watch for your balance.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test19" id="test191" value="option1">
                    <label class="form-check-label" for="test191">feeling imbalance</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test19" id="test4192" value="option2">
                    <label class="form-check-label" for="test192">feeling balance improved</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test19" id="test193" value="option2">
                    <label class="form-check-label" for="test193">none</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>20. Do spot running  for-  
                    <ul>
                        <li>50 step  if you are above 65 yr old </li>
                        <li>100 steps if you are above 50 -65 yr  </li>
                        <li>150 steps if you are 40-50yr.</li>
                        <li>200 steps if you are less than 40 yr </li>
                    </ul>   
                    (This test not to be done by pregnant or heart patient undergone surgery or severe heart disease) </strong>
                </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Fitness" id="test201">
                    <label class="form-check-label" for="test201">did you run the steps for as per your age</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Weight /obesity" id="test202">
                    <label class="form-check-label" for="test202">feeling too much tired</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test203">
                    <label class="form-check-label" for="test203">can feel heart beats are fast</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test204">
                    <label class="form-check-label" for="test204">feeling chest pain</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test205">
                    <label class="form-check-label" for="test205">feeling too much fast breathing</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test206">
                    <label class="form-check-label" for="test206">feeling breathless</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test207">
                    <label class="form-check-label" for="test207">sweating more than normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test208">
                    <label class="form-check-label" for="test208">feeling giddiness </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test20[]" value="Health issue" id="test209">
                    <label class="form-check-label" for="test209">none</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>21. stand with legs crossed against each other ( lord krishna with basuri pose). Close eyes, hold your hands like basuri/flute. Hold for 20 sec. What thoughts  came in your mind.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test21[]" value="Fitness" id="test211">
                    <label class="form-check-label" for="test211">past issues</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test21[]" value="Weight /obesity" id="test212">
                    <label class="form-check-label" for="test212">present issues</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test21[]" value="Health issue" id="test213">
                    <label class="form-check-label" for="test213">future insecuriteis</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test21[]" value="Health issue" id="test214">
                    <label class="form-check-label" for="test214">feeling loneliness</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test21[]" value="Health issue" id="test215">
                    <label class="form-check-label" for="test215">feeling loved</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test21[]" value="Health issue" id="test216">
                    <label class="form-check-label" for="test216">no thoughts</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>22. Do either A or B
                    <ol type="A" style="margin-bottom:0">
                        <li>For those who can sit in vajrasan: Sit in vajrasan holding back straight , relaxfully keeping your hands on the thighs close your eyes. Observe.</li>    
                        <li>For those   who cannot do vajrasan: sit on a stool of comfortable height for you, hold back straight and move your feet slightly behind . </li>
                    </ol></strong>
                </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Fitness" id="test221">
                    <label class="form-check-label" for="test221">pain in back</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Weight /obesity" id="test222">
                    <label class="form-check-label" for="test222">pain in hip</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test223">
                    <label class="form-check-label" for="test223">pain in knee</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test224">
                    <label class="form-check-label" for="test224">pain in thigh or leg</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test225">
                    <label class="form-check-label" for="test225">pain in ankle or foot</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test226">
                    <label class="form-check-label" for="test226">good thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test227">
                    <label class="form-check-label" for="test227">sad  or fearful thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test228">
                    <label class="form-check-label" for="test228">no thought</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test229">
                    <label class="form-check-label" for="test229">feeling heart beats</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test2210">
                    <label class="form-check-label" for="test2210">pain in groin</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test2211">
                    <label class="form-check-label" for="test2211">pain in tail bone</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test22[]" value="Health issue" id="test2212">
                    <label class="form-check-label" for="test2212">pain in rectum/anus</label>
                </div>
            </div>

            <div class="form-group">
                <label for="formControlRange"><strong>23. measure body temperature by glass thermometer or digital thermometer . Do not measure in ac room , or immediately after drinking or eating anything. Keep thermometer under your tongue for 2-3 min.</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test23" id="test231" value="option1">
                    <label class="form-check-label" for="test231">below 98.6</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test23" id="test232" value="option2">
                    <label class="form-check-label" for="test232">above 98.6</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="test23" id="test233" value="option2">
                    <label class="form-check-label" for="test233">above 100</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>24. take a deep breath and try doing as much suryanamaskar holding the breath. Do this only once. Do not repeat it second time.( this test not to be done by pregnant or heart patient undergone surgery or severe heart disease)</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Fitness" id="test241">
                    <label class="form-check-label" for="test241">less than one</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Weight /obesity" id="test242">
                    <label class="form-check-label" for="test242">1 suryanamaskar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test243">
                    <label class="form-check-label" for="test243">2 suryanamkar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test244">
                    <label class="form-check-label" for="test244">3 suryanamaskar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test245">
                    <label class="form-check-label" for="test245">4 suryanamaskar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test246">
                    <label class="form-check-label" for="test246">are you feeling too much breathlessness</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test247">
                    <label class="form-check-label" for="test247">can you hold your breath for more than 20 sec</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test248">
                    <label class="form-check-label" for="test248">feeling palpitation</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test249">
                    <label class="form-check-label" for="test249">feeling giddiness</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test24[]" value="Health issue" id="test2410">
                    <label class="form-check-label" for="test2410">feeling body pain</label>
                </div>
            </div>

            <div class="form-group">
                <label><strong>25. Observation's of your early morning urine .</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test25[]" value="Fitness" id="test251">
                    <label class="form-check-label" for="test251">normal color</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test25[]" value="Weight /obesity" id="test252">
                    <label class="form-check-label" for="test252">yellow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test25[]" value="Health issue" id="test253">
                    <label class="form-check-label" for="test253">dark yellow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test25[]" value="Health issue" id="test254">
                    <label class="form-check-label" for="test254">hot urine</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test25[]" value="Health issue" id="test255">
                    <label class="form-check-label" for="test255">burning pain while urination</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="test25[]" value="Health issue" id="test256">
                    <label class="form-check-label" for="test256">bad odour/smell of urine</label>
                </div>
            </div>

            <div class="form-group">
              <label for="other_complaint"><strong>Any other complaints ?</strong></label>
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
            <span>© 2020 by AtmaVeda Yog Pvt. Ltd.</span>
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


        $test_id = md5(time().$user_id);

        $insert_value = 
        
        if($insert_value_run = mysqli_query($con, $insert_value)){
            echo "<script>
                    alert('your test is submitted sucessfully, DOctor will contact you soon.');
                    window.location.href='ongoing_treatments.php';
                </script>";
        }



    }

?>