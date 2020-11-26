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

  <title>YogE@Rakshakavach Test</title>

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
            $test_details = "SELECT * FROM `test_rakshakavach` WHERE `test_id`='$test_id'";
            $test_details_run = mysqli_query($con, $test_details);
            $test_details_res = mysqli_fetch_assoc($test_details_run);

            $user_ans = array();
            $answer_value_count = array();
            $ans = "";
            $seventh_1 = "";
            $seventh_2 = "";
            $seventh_3 = "";
            // print_r($answer_value_count);

            // loop through each question
            for($i=1; $i<26; $i++){
                $col_name = "test".$i;
                $test[$i] = unserialize($test_details_res[$col_name]);

                //for question 7 special case 
                if($i == 7){
                    $pr = 0;
                    $ap = 0;
                    $test7 = [['right side','pr','1'], ['left side', 'pr', '1'], ['right side','pr','2'], ['left side', 'pr', '2'], ['right side','ap','3'], ['left side', 'ap', '3']];
                    if($test[7] != ""){
                      foreach($test[7] as $seventh){
                          $seventh--;
                          
                          if($test7[$seventh][2] == '1'){
                              $seventh_1 = $seventh_1.", ".$test7[$seventh][0];
                              $pr++;
                          }else if($test7[$seventh][2] == '2'){
                              $seventh_2 = $seventh_2.", ".$test7[$seventh][0];
                              $pr++;
                          }else if($test7[$seventh][2] == 3){
                              $seventh_3 = $seventh_3.", ".$test7[$seventh][0];
                              $ap++;
                          }
                          $test7[$seventh] = [];
                      }

                      $seventh_1 = substr($seventh_1, 2);
                      $seventh_2 = substr($seventh_2, 2);
                      $seventh_3 = substr($seventh_3, 2);
                    }

                    //taking value for question 7 which is not selected
                    if(array_key_exists('pr', $answer_value_count)){
                      $answer_value_count['pr'] = $answer_value_count['pr'] + (4 - $pr);
                    }else{
                        $answer_value_count['pr'] = 4 - $pr;
                    }
    
                    if(array_key_exists('ap', $answer_value_count)){
                        $answer_value_count['ap'] = $answer_value_count['ap'] + (2 - $ap);
                    }else{
                        $answer_value_count['ap'] = 2 - $ap;
                    }
                    // $answer_value_count['pr'] = $answer_value_count['pr'] + (4 - $pr);
                    // $answer_value_count['ap'] = $answer_value_count['ap'] + (2 - $ap);
                    //print_r($test7);
                    // print_r($answer_value_count);
                }

                
                

                if($i !== 7){
                    $count = 0;
                    
                    //loop through each selected option of perticular question
                    foreach($test[$i] as $single_option){
                        //first remove all white spaces from string(str_replace), remove brackets 1st and last(substr)
                        // then split remaning string between each comma and add to an array 
                        $test[$i][$count] = explode(',', substr($single_option, 1, -1));

                        //loop through each value of perticular option of perticular question
                        $singleValue = 0;
                        foreach($test[$i][$count] as $single_val){
                            $test[$i][$count][$singleValue] = substr($single_val, 1, -1);
                            

                            if($singleValue != 0){
                                $val = $test[$i][$count][$singleValue];
                                if(array_key_exists($val, $answer_value_count)){
                                    $answer_value_count[$val]++; 
                                }else{
                                    $answer_value_count[$val] = 1;
                                }
                            }
                            $singleValue++;
                        }

                        $ans = $ans.", ".$test[$i][$count][0];
                        $count++;
                    }

                    $user_ans[$i] = substr($ans, 2);
                    $ans = "";
                }
                //$test[$i][]
                
            }
            // print("<pre>".print_r($test)."</pre>");
            // print("<pre>".print_r($test,true)."</pre>");
            // print("<pre>".print_r($answer_value_count,true)."</pre>");
            // $myArray = explode(',', substr($test[1][0], 1, -1));
            // print_r($myArray);
          ?>
          <a href="rakshakavach_report.php?pay_id=<?php echo $pay_id; ?>"  class="btn btn-sm mt-3 btn-success" value="View Report" >View Report</a>
          <input type="button" class="btn btn-sm mt-3 btn-primary d-flex ml-auto" onclick="printDiv('printableArea')" value="Print Test Details" />
          

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
                        <p>ID : <strong>RAKT<?php echo $test_details_res['rakshakavach_test_no']; ?></strong></p>
                        <p>Age : <strong><?php echo $user_detail['age']; ?> Yrs.</strong></p>
                        <p>Tested On : <strong><?php echo date("Y-m-d h:ia", strtotime($record['created_at'])); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Name : <strong><?php echo $user_detail['name']; ?></strong></p>
                        <p>Sex : <strong><?php echo $user_detail['gender']; ?></strong></p>
                        <p>Reported On : <strong><?php echo date("Y-m-d h:ia", strtotime($record['created_at'])); ?></strong></p>
                    </div>
                </div>
                <p >Test Name : <strong>YOG-E @Rakshakavach Test <?php if($record['test_type'] == 1) { echo 'Basic'; }else if($record['test_type'] == 5){ echo 'Advanced'; }?></strong></p>

              </div>
              <hr style="height:3px; background-color:#50A6C2">
              <br>
            
              <table class="table table-bordered table-striped table-responsive-md" id="treatBlock">
                <thead>
                  <tr>
                    <th scope="col">sr. no.</th>
                    <th scope="col">Question</th>
                    <th scope="col">User Answer</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Stand with feet , knee's, thigh's touching each other. Straighten the body, expand your chest  and straighten the neck, close eye's, hand's lying straight on side's, focus on balance of your body and observe your balance . Do this for 20 second.</td>
                    <td><?php echo $user_ans[1]; ?></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Stand with shoulder distance between feet, expand your chest fully, Press your shoulders backwards.  Extend your hands  behind your back with palms crossed over each other(vishram pose) , Extend your neck  backward and hold  this position for 20 second and look for:</td>
                    <td><?php echo $user_ans[2]; ?></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Stand straight with feet  closely touched to each other .Take your arms from sideways over your head . Let both palm touch each other ,bring them down on  your head, and then extend hands with force upward keeping palms close . Repeat it 5-7 times and look for:</td>
                    <td><?php echo $user_ans[3]; ?></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Stand with feets  at shoulder distance apart. keep your hands on your waist. Take a deep breath through nose and hold for a while and exhale through nose .Do this 5-7 times. While breathing watch your chest and abdomen movement.</td>
                    <td><?php echo $user_ans[4]; ?></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Keep feets close , extend yor neck straight upward and extend it backward  keep eyes closed. Hold in this position with normal breathing for 20 seconds. Are you loosing balance ?</td>
                    <td><?php echo $user_ans[5]; ?></td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>(Simple forward step with spine twist) take a step  forward with right leg. Raise your hands  sideways, hold them at shoulder level  and take a twist above waist on right  side .Do this 3-4 times .  Then  take  a step forward  with left leg,Raise your hands sideways ,hold them at shoulder leveland take a twist above waist on left  side .do This 3-4 times. Observe and feel for.</td>
                    <td><?php echo $user_ans[6]; ?></td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>( chanting for vibration in chest) Stand with feet at shoulder distance apart , take a deep breath hold it, touching the palm on chest and chant in hormoney in medium tone"Haa" and feel the vibration , do it on both sides for upper, middle, lower and sides of your chest, Do this for 5-10 breathes. feel for vibrations in chest . feel on both sides.and answer</td>
                    <td>
                        upper chest : <?php echo $seventh_1; ?><br>
                        middle chest : <?php echo $seventh_2; ?><br>
                        lower chest : <?php echo $seventh_3; ?>
                        
                    </td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Stand with feet  at shoulder distance apart. Close the ear with thumbs . Do not use the nail part of thumb, just the soft part of thumb, close eyes, and hold for 20 second and observe.</td>
                    <td><?php echo $user_ans[8]; ?></td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>stand with feet at shoulder distance apart close your eyes and gently touch  your eyes with tips of middle and index finger . do not press the eyes. feel for 20 sec and observe does your eyes move?</td>
                    <td><?php echo $user_ans[9]; ?></td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Stand with feet at shoulder distance apart,  keep  your eyes closed , and hold gently your forehead with all fingers except thumb, breathing deeply for atleast 2 minutes. observe for , what are the thoughts coming in your mind ?</td>
                    <td><?php echo $user_ans[10]; ?></td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>Stand at ease with feet at shoulder length apart , touch your face with your palms hold in this postion for 20 second and observe . How do you feel your touch?</td>
                    <td><?php echo $user_ans[11]; ?></td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Sit on the chair , resting hands on thighs, close eyes for 20 secons and focus on the saliva in your mouth. Feel your saliva and answer:</td>
                    <td><?php echo $user_ans[12]; ?></td>
                  </tr>
                  <tr>
                    <td>13</td>
                    <td>Is your sense of taste  normal. Can you taste food ?</td>
                    <td><?php echo $user_ans[13]; ?></td>
                  </tr>
                  <tr>
                    <td>14</td>
                    <td>sit on chair, hold your back straight, close eyes and tick which food you desire.</td>
                    <td><?php echo $user_ans[14]; ?></td>
                  </tr>
                  <tr>
                    <td>15</td>
                    <td>Breathe  from right nostril .Inhale and exhale 5-7 times. Repeat the same from left nostril. Are you feeling your nose is blocked?</td>
                    <td><?php echo $user_ans[15]; ?></td>
                  </tr>
                  <tr>
                    <td>16</td>
                    <td>Breath from nose. Hold your hand beneath nose. Inhale and exale 5-7 times. Feel air flowing from nose , is it warm or cold.</td>
                    <td><?php echo $user_ans[16]; ?></td>
                  </tr>
                  <tr>
                    <td>17</td>
                    <td>Is your sense of smelling normal.</td>
                    <td><?php echo $user_ans[17]; ?></td>
                  </tr>
                  <tr>
                    <td>18</td>
                    <td>Stand erect or Sit on chair holding back straight. Place both palms on your abdomen,place your  hands on the sides of navel ,take care not to overlap the fingers. both  hands should not touch each other, keep breathing gently with closed eyes .focus on your navel. hold for 20 seconds and observe</td>
                    <td><?php echo $user_ans[18]; ?></td>
                  </tr>
                  <tr>
                    <td>19</td>
                    <td>Stand with feet close to each other, great toe, knee, thighs touching each other. Extend your hands sideways upto shoulder level. Press your thumb with your index finger(gyan mudra) and close eyes. Breath gently for 20 second  watch for your balance.</td>
                    <td><?php echo $user_ans[19]; ?></td>
                  </tr>
                  <tr>
                    <td>20</td>
                    <td>
                        Do spot running  for-  
                        <ul>
                            <li>50 step  if you are above 65 yr old </li>
                            <li>100 steps if you are above 50 -65 yr  </li>
                            <li>150 steps if you are 40-50yr.</li>
                            <li>200 steps if you are less than 40 yr </li>
                        </ul>   
                        (This test not to be done by pregnant or heart patient undergone surgery or severe heart disease)
                    </td>
                    <td><?php echo $user_ans[20]; ?></td>
                  </tr>
                  <tr>
                    <td>21</td>
                    <td>stand with legs crossed against each other ( lord krishna with basuri pose). Close eyes, hold your hands like basuri/flute. Hold for 20 sec. What thoughts  came in your mind.</td>
                    <td><?php echo $user_ans[21]; ?></td>
                  </tr>
                  <tr>
                    <td>22</td>
                    <td>
                        Do either A or B 
                        <ol type="A" style="margin-bottom:0">
                            <li>For those who can sit in vajrasan: Sit in vajrasan holding back straight , relaxfully keeping your hands on the thighs close your eyes. Observe.</li>    
                            <li>For those   who cannot do vajrasan: sit on a stool of comfortable height for you, hold back straight and move your feet slightly behind . </li>
                        </ol>
                    </td>
                    <td><?php echo $user_ans[22]; ?></td>
                  </tr>
                  <tr>
                    <td>23</td>
                    <td>measure body temperature by glass thermometer or digital thermometer . Do not measure in ac room , or immediately after drinking or eating anything. Keep thermometer under your tongue for 2-3 min.</td>
                    <td><?php echo $user_ans[23]; ?></td>
                  </tr>
                  <tr>
                    <td>24</td>
                    <td>take a deep breath and try doing as much suryanamaskar holding the breath. Do this only once. Do not repeat it second time.( this test not to be done by pregnant or heart patient undergone surgery or severe heart disease)</td>
                    <td><?php echo $user_ans[24]; ?></td>
                  </tr>
                  <tr>
                    <td>25</td>
                    <td>Observation's of your early morning urine.</td>
                    <td><?php echo $user_ans[25]; ?></td>
                  </tr>
                </tbody>
              </table>

              <p >Any other complaints? : <b><?php echo $test_details_res['other_complain']; ?></b></p>

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