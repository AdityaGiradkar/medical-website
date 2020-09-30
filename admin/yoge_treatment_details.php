<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      $test_id = $_GET['testID'];
      $test_details = "SELECT * FROM `yoge_home` WHERE `test_id`='$test_id'";
      $test_details_run = mysqli_query($con, $test_details);
      $record = mysqli_fetch_assoc($test_details_run);
      $user_id = $record['user_id'];
      
      //checking if user present for perticular
      //if not then redirect to user page
      if($record){

        $user_info = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
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
        <div id="collapsePatient" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Patients : </h6>
            <a class="collapse-item" href="new_patient.php">New consultation (<?php echo $data['total']; ?>)</a>
            <a class="collapse-item " href="test_submissions.php">New Test Submissions</a>
            <a class="collapse-item active" href="all_treatments.php">All Treatments</a>
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
        <div id="collapseMedicine" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
                  <h6 class="collapse-header">Sessions:</h6>
                  <a class="collapse-item" href="all_sessions.php">All Sessions</a>
                  <a class="collapse-item" href="add_session.php">Add Session</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-pills"></i>
          <span>Blogs</span>
        </a>
        <div id="collapseBlogs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Blogs Section:</h6>
            <a class="collapse-item" href="blogs_table.php">All Blogs</a>
            <a class="collapse-item" href="add_blogs.php">Add Blogs</a>
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
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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

            <h1 class="h4 mt-4 mb-2 text-gray-800">Medical History</h1>
            <div class="row">
              <div class="col-md-4 mb-3">
                <b>What is problem you have ? :</b> <?php echo $medical_history_res['problems']; ?>
              </div>
              <div class="col-md-4 mb-3">
                <b>what type of treatment you tried before? :</b> <?php echo $medical_history_res['teratment_tried']; ?>
              </div>
              <div class="col-md-4 mb-3">
                <b>date of first illness detected :</b>
                <?php echo date("d-m-Y", strtotime($medical_history_res['date_first_illness'])); ?>
              </div>
              <div class="col-md-4 mb-3">
                <b>Diagnosis made by doctors.:</b> <?php echo $medical_history_res['prev_doctor']; ?>
              </div>
              <div class="col-md-4 mb-3">
                <b>Would you like a programme which has no side effects? :</b>
                <?php echo $medical_history_res['side_effect']; ?>
              </div>
              <div class="col-md-4 mb-3">
                <b>What time is best daily for your health session? :</b>
                <?php echo $medical_history_res['health_session']; ?>
              </div>
              <div class="col-md-4 mb-3">
                <b>Are you looking for permanent relief or temporary control? :</b>
                <?php echo $medical_history_res['relief']; ?>
              </div>
            </div>
          </div>
          <!-- person info ends  -->


          <!-- CREATE TABLE OF test details  -->
          <div class="border border-primary  rounded-lg mt-4 p-3">
            <h1 class="h4 mb-2 text-gray-800">Submitted Test</h1>
            <button type="button" onClick="showTest()" id="show-btn" class="btn btn-success">Show Test result</button>
            <table class="table table-bordered table-striped  d-none table-responsive-md" id="treatBlock">
              <thead>
                <tr>
                  <th scope="col">sr. no.</th>
                  <th scope="col">Question</th>
                  <th scope="col">Answer</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>IF A HOSPITALIZED CASE THEN NAME OF HOSPITAL AND IPD NO.</td>
                  <td><?php echo $record['hospital_name']; ?></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>COVID TESTING DONE</td>
                  <td><?php echo $record['covid_test']; ?></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>COVID19 TEST REPORT</td>
                  <td><?php echo $record['covid_report']; ?></td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>DIAGNOSIS as written on hospital /prescription paper</td>
                  <td><?php echo $record['prescription_paper']; ?></td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>PULSEOX READING OF SPO2</td>
                  <td><?php echo $record['SPO2']; ?></td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td>BLOOD PRESSURE</td>
                  <td><?php echo $record['blod_pressure']; ?></td>
                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td>PULSE RATE</td>
                  <td><?php echo $record['pulse_rate']; ?></td>
                </tr>
                <tr>
                  <th scope="row">8</th>
                  <td>RESPIRATION RATE(RESPIRATION PER MINS)</td>
                  <td><?php echo $record['respiration_rate']; ?></td>
                </tr>
                <tr>
                  <th scope="row">9</th>
                  <td>Haemoglobin</td>
                  <td><?php echo $record['haemoglobin']; ?></td>
                </tr>
                <tr>
                  <th scope="row">10</th>
                  <td>WBC COUNT</td>
                  <td><?php echo $record['wbc_count']; ?></td>
                </tr>
                <tr>
                  <th scope="row">11</th>
                  <td>RBC COUNT</td>
                  <td><?php echo $record['rbc_count']; ?></td>
                </tr>
                <tr>
                  <th scope="row">12</th>
                  <td>HCT /HAEMATOCRIT/PCV</td>
                  <td><?php echo $record['pvc']; ?></td>
                </tr>
                <tr>
                  <th scope="row">13</th>
                  <td>LYMPHOCYTE COUNT</td>
                  <td><?php echo $record['lymphocyte_count']; ?></td>
                </tr>
                <tr>
                  <th scope="row">14</th>
                  <td>BAND CELLS</td>
                  <td><?php echo $record['band_cell']; ?></td>
                </tr>
                <tr>
                  <th scope="row">15</th>
                  <td>ESR</td>
                  <td><?php echo $record['esr']; ?></td>
                </tr>
                <tr>
                  <th scope="row">16</th>
                  <td>CRP VALUE</td>
                  <td><?php echo $record['crp_value']; ?></td>
                </tr>
                <tr>
                  <th scope="row">17</th>
                  <td>BSL RANDOM</td>
                  <td><?php echo $record['bsl_random']; ?></td>
                </tr>
                <tr>
                  <th scope="row">18</th>
                  <td>SGPT</td>
                  <td><?php echo $record['sgpt']; ?></td>
                </tr>
                <tr>
                  <th scope="row">19</th>
                  <td>SGOT</td>
                  <td><?php echo $record['sgot']; ?></td>
                </tr>
                <tr>
                  <th scope="row">20</th>
                  <td>URIC ACID level</td>
                  <td><?php echo $record['uric_acid_level']; ?></td>
                </tr>
                <tr>
                  <th scope="row">21</th>
                  <td>BLOOD UREA LEVEL </td>
                  <td><?php echo $record['blood_urea_level']; ?></td>
                </tr>
                <tr>
                  <th scope="row">22</th>
                  <td>SR CREATININE</td>
                  <td><?php echo$record['SR_CREATININE']; ?></td>
                </tr>
                <tr>
                  <th scope="row">23</th>
                  <td>24 hr urine output in ml</td>
                  <td><?php echo $record['urin_output']; ?></td>
                </tr>
                <tr>
                  <th scope="row">24</th>
                  <td>LEVEL OF CONSCIOUSNESS</td>
                  <td><?php echo $record['level_consciousness']; ?></td>
                </tr>
                <tr>
                  <th scope="row">25</th>
                  <td>SWELLING ON FEET</td>
                  <td><?php echo $record['swelling_feet']; ?></td>
                </tr>
                <tr>
                  <th scope="row">26</th>
                  <td>SWELLING UNDER EYES/FACE</td>
                  <td><?php echo $record['swelling_eyes']; ?></td>
                </tr>
                <tr>
                  <th scope="row">27</th>
                  <td>Electrolyte level - Sodium</td>
                  <td><?php echo $record['electrolyte_sodium']; ?></td>
                </tr>
                <tr>
                  <th scope="row">28</th>
                  <td>Electrolyte level - Potassium</td>
                  <td><?php echo $record['electrolyte_potassium']; ?></td>
                </tr>
                <tr>
                  <th scope="row">29</th>
                  <td>Electrolyte level - Chloride</td>
                  <td><?php echo $record['electrolyte_chloride']; ?></td>
                </tr>
                <tr>
                  <th scope="row">30</th>
                  <td>Lipid profile- Triglycerides</td>
                  <td><?php echo $record['lipid_triglyceride']; ?></td>
                </tr>
                <tr>
                  <th scope="row">31</th>
                  <td>Lipid profile - cholesterol</td>
                  <td><?php echo $record['lipid_cholesterol']; ?></td>
                </tr>
                <tr>
                  <th scope="row">32</th>
                  <td>Lipid profile- HDL</td>
                  <td><?php echo $record['lipid_hdl']; ?></td>
                </tr>
                <tr>
                  <th scope="row">33</th>
                  <td>Any other complaints ?</td>
                  <td><?php echo $record['other_complaint']; ?></td>
                </tr>
              </tbody>
            </table>
            <!-- <button class="btn btn-primary" onClick="startTreatment()">Start Treatment</button> -->
            <button class="btn btn-primary d-none" id="close-btn" onClick="closeTestRes()">Close Section</button>
          </div>
          <!-- CREATE TABLE OF test details  -->

          

          <!-- Previous treatments -->
          <?php 
            $previous_treatment = "SELECT * FROM `treatment` WHERE `test_id`='$test_id' ORDER BY `date`";
            $previous_treatment_run = mysqli_query($con, $previous_treatment);
          ?>
          <div class="border border-primary rounded-lg p-3 mt-4 treat-panel">
            <h5 class="modal-title text-center" id="exampleModalLongTitle">Previous YogE @ HOME Test Treatment</h5>
            <?php
              $sr_no = 1;
              while($previous_treatment_res = mysqli_fetch_assoc($previous_treatment_run)){
                $treatment_no = $previous_treatment_res['treat_number'];

                $prescribed_medi_details = array();
                $prescribed_session_details = array();
                $total_price = 0;

                $all_prescribed_medi = "SELECT `medicine_id`, `quantity` FROM `prescribed_medicine` WHERE `test_id`='$test_id' AND `treat_number`='$treatment_no'";
                if($all_prescribed_medi_run = mysqli_query($con, $all_prescribed_medi)){
                  $all_prescribed_medi_row = mysqli_num_rows($all_prescribed_medi_run);
                  if($all_prescribed_medi_row > 0){
                    $prescribed_medi_idQuantity_array = array();
                    $medi_count =0;
                    while ($prescribed_medi_idQuantity = mysqli_fetch_assoc($all_prescribed_medi_run)){
                      $prescribed_medi_idQuantity_array[$medi_count] = $prescribed_medi_idQuantity;
                      $medi_count++;
                    }
                    $medi_count =0;
                    
                    foreach($prescribed_medi_idQuantity_array as $medi_Id_quantity){
                      $tempid = $medi_Id_quantity['medicine_id'];
                      $medicine_detail = "SELECT * FROM `medicines` WHERE `medicine_id`='$tempid'";
                      $medicine_detail_run = mysqli_query($con, $medicine_detail);
                      $medicine_detail_res = mysqli_fetch_assoc($medicine_detail_run);
                      $temp = array(
                        "name" => $medicine_detail_res['Name'],
                        "type" => $medicine_detail_res['type'],
                        "price" => $medicine_detail_res['price'],
                        "quantity" => $medi_Id_quantity['quantity'],
                        "total_price" => $medi_Id_quantity['quantity'] * $medicine_detail_res['price']
                      );
                      $total_price = $total_price + (int)$temp['total_price'];
                      $prescribed_medi_details[$medi_count] = $temp;
                      $medi_count++;
                    }
                    //print_r($prescribed_medi_details);
                    //print_r($total_price);
                  }
                }


                $all_prescribed_session = "SELECT * FROM `prescribed_session` WHERE `test_id`='$test_id' AND `treat_number`='$treatment_no'";
                if($all_prescribed_session_run = mysqli_query($con, $all_prescribed_session)){
                  $all_prescribed_session_row = mysqli_num_rows($all_prescribed_session_run);
                  if($all_prescribed_session_row > 0){
                    $prescribed_session_idQuantity_array = array();
                    $session_count =0;
                    while ($prescribed_session_idQuantity = mysqli_fetch_assoc($all_prescribed_session_run)){
                      $prescribed_session_idQuantity_array[$session_count] = $prescribed_session_idQuantity;
                      $session_count++;
                    }
                    $session_count =0;
                    
                    foreach($prescribed_session_idQuantity_array as $session_Id_quantity){
                      $tempid = $session_Id_quantity['session_id'];
                      $session_detail = "SELECT * FROM `sessions` WHERE `session_id`='$tempid'";
                      $session_detail_run = mysqli_query($con, $session_detail);
                      $session_detail_res = mysqli_fetch_assoc($session_detail_run);
                      $temp = array(
                        "name" => $session_detail_res['session_name'],
                        "price" => $session_detail_res['price'],
                        "quantity" => $session_Id_quantity['session_per_month'],
                        "total_price" => $session_Id_quantity['session_per_month'] * $session_detail_res['price']
                      );
                      $total_price = $total_price + (int)$temp['total_price'];
                      $prescribed_session_details[$session_count] = $temp;
                      $session_count++;
                    }
                    //print_r($prescribed_session_details);
                    //print_r($total_price);
                  }
                }
                              
            ?>
            <div class="card border-left-primary shadow h-100 py-2 mb-3">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                      <?php echo date("d/m/Y", strtotime($previous_treatment_res['date'])); ?>
                    </div>
                    <div class="text-xs font-weight-bold text-primary mt-2 mb-1">
                      Total : Rs. <?php echo $total_price; ?> (<?php echo $previous_treatment_res['fees_status']=='pending'?"<span style='color:red'>Pending</span>":"<span style='color:green'>Paid</span>"; ?>)
                    </div>
                  </div>
                  <div class="col-auto">
                    <a class="up-down-arrow" onClick="showDetails('d_<?php echo $sr_no; ?>')"><i
                        class="fas arrow fa-angle-right fa-2x" id="d_<?php echo $sr_no; ?>_arrow"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body pt-2" style="display:none" id="d_<?php echo $sr_no; ?>">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Report : </strong> <a target="_blank" href="<?php echo $previous_treatment_res['report']; ?>">view</a>
                  </div>
                  <div class="col-md-6">
                    <strong>Diet Plan : </strong><a target="_blank" href="<?php echo $previous_treatment_res['diet']; ?>">view</a>
                  </div>
                </div>
                <br>

                <label for=""><strong>Prescribed Medicines:</strong></label><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">sr. no.</th>
                      <th scope="col">Medicine Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Type</th>
                      <th scope="col">Total Price (Rs.)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $medi_count = 1;
                      foreach($prescribed_medi_details as $single_medi_detail){
                    ?>
                    <tr>
                      <th scope="col"><?php echo $medi_count; ?></th>
                      <td><?php echo $single_medi_detail['name']; ?></td>
                      <td><?php echo $single_medi_detail['quantity']; ?></td>
                      <td><?php echo $single_medi_detail['type']; ?></td>
                      <td><?php echo $single_medi_detail['total_price']; ?></td>
                    </tr>
                    <?php 
                        $medi_count++;
                      }
                    ?>
                    
                  </tbody>
                </table>
                <br>

                <label for=""><strong>Prescribed Sessions:</strong></label><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">sr. no.</th>
                      <th scope="col">Session Name</th>
                      <th scope="col">Times per month</th>
                      <th scope="col">Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $session_count = 1;
                      foreach($prescribed_session_details as $single_session_detail){
                    ?>
                    <tr>
                      <th scope="col"><?php echo $session_count; ?></th>
                      <td><?php echo $single_session_detail['name']; ?></td>
                      <td><?php echo $single_session_detail['quantity']; ?></td>
                      <td><?php echo $single_session_detail['total_price']; ?></td>
                    </tr>
                    <?php 
                      $session_count++;
                    }
                    
                    ?>
                  </tbody>
                </table>
                <br>

                <p><strong>Extra Note : </strong> <?php echo $previous_treatment_res['extra_note']; ?></p>
                <div class="Actions">
                  
                </div>

              </div>
            </div>
            <?php
              //end of while loop
                $sr_no++;
              }
            ?>
            <button class="btn btn-primary" onClick="updateTreatment()">Update Treatment</button>
            
            <!-- end treatment -->
            <form method="post" class="d-inline" style="display: table-cell;text-align: right;">
              <div>
                <button type="submit" name="end-treat" class="btn btn-danger" onClick="javascript: return confirm('Are you sure you want to end this treatment');">End Treatment</button>
              </div>
            </form>

            <?php 
              if(isset($_POST['end-treat'])){
                $update_status_close = "UPDATE `yoge_home` SET `status`='closed' WHERE `test_id`='$test_id' AND `user_id`='$user_id'";
                if($update_status_close_run = mysqli_query($con, $update_status_close)){
                  echo "<script>
                    alert('Treatment has been closed');
                    window.location.href='all_treatments.php';
                  </script>";
                }
              }
            ?>
            <!-- end treatment -->
          </div>
          <!-- Previous treatments -->


          <!-- treatment section -->
          <?php 
              $all_medicines = "SELECT * FROM `medicines`";
              $all_medicines_run = mysqli_query($con, $all_medicines);
              $count = 0;
              $medicines = array();
              while($medi = mysqli_fetch_assoc($all_medicines_run)){
                $medicines[$count] = $medi;
                  $count++; 
              }

              $all_instruments = "SELECT * FROM `sessions`";
              $all_instruments_run = mysqli_query($con, $all_instruments);
              $count_instru = 0;
              $instruments = array();
              while($instru = mysqli_fetch_assoc($all_instruments_run)){
                  $instruments[$count_instru] = $instru;
                  $count_instru++; 
              }
          ?>
          <!-- Passing medicine array in the js file  -->
          <script type="text/javascript">
            var medicineArray = <?php echo json_encode($medicines); ?> ;
            var instrumentArray = <?php echo json_encode($instruments); ?> ;
          </script>
          <!-- Passing medicine array in the js file  -->

          <div class="border border-primary rounded-lg d-none p-3 mt-4" id="treat-panel">
            <h5 class="modal-title text-center" id="exampleModalLongTitle">Update Treatment</h5>
            <form method="post" onsubmit="return confirm('Are you sure you want to submit this treatment?');"
              enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleFormControlFile1">Report of test</label>
                <input type="file" name="report" class="form-control-file" id="exampleFormControlFile1" required>
              </div>
              <div class="form-group">
                <label for="">Medicines</label><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Medicine Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Remove</th>
                    </tr>
                  </thead>
                  <tbody id="medicine">
                    <!-- Medicine rows are added Dynamically through javascript -->
                  </tbody>
                </table>
                <button type="button" onClick="addMedicine()" class="btn btn-primary">Add Medicines</button>
              </div>

              <div class="form-group">
                <label for="">Sessions</label><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Session Name</th>
                      <th scope="col">quantity (per month)</th>
                      <th scope="col">Remove</th>
                    </tr>
                  </thead>
                  <tbody id="instrument">
                    <!-- instruments rows are added Dynamically through javascript -->
                  </tbody>
                </table>

                <button type="button" onClick="addInstrument()" class="btn btn-primary">Add Instrument</button>
              </div>

              <div class="form-group">
                <label for="diet">Diet Plan</label>
                <input type="file" name="diet" class="form-control-file" id="diet" required>
              </div>

              <div class="form-group">
                <label for="note">Extra Note</label>
                <textarea class="form-control" placeholder="If nothing type 'NA'" id="note" name="note" rows="3"
                  required></textarea>
              </div>

              <button type="submit" name="start_test" class="btn btn-primary">Update</button>
            </form>
          </div>

          <?php 
            if(isset($_POST['start_test'])){
              $diet = $_FILES['diet'];
              $report = $_FILES['report'];
              $extra_note = $_POST['note'];

              $lastest_count = "SELECT max(`treat_number`) AS max_count FROM `treatment` WHERE `test_id`='$test_id'";
              $lastest_count_run = mysqli_query($con, $lastest_count);
              $lastest_count_res = mysqli_fetch_assoc($lastest_count_run);
              $new_treatment_no = $lastest_count_res['max_count'] + 1;

              //firse check if doctor has added medicines or not 
              //if not then do not run query for insertion of data into database
              $query_medicine_insert = "";
              if(isset($_POST['medicine_name'])){
                $prescribed_medi = $_POST['medicine_name'];
                $prescribed_medi_quantity = $_POST['quantityMed'];

                foreach($prescribed_medi as $key => $val){
                  if($val != 0){  //check if something is selected or not
                    $Idprice = explode(',', $val);
                    //$total_medi_cost = $total_medi_cost + (float)$Idprice[1] * (float)$prescribed_medi_quantity[$key];
                    $query_medicine_insert = $query_medicine_insert."('" . $test_id ."',". $new_treatment_no ."," . (int)$Idprice[0] . "," . (int)$prescribed_medi_quantity[$key] . "),";
                  }
                }
                if($query_medicine_insert != ""){ // if doctor just added rows but didn't select any medicine then also do not run query
                  $query_medicine_insert = substr($query_medicine_insert, 0, -1);

                  $insert_medicines = "INSERT INTO `prescribed_medicine`(`test_id`, `treat_number`, `medicine_id`, `quantity`) 
                                      VALUES ".$query_medicine_insert;
                  $insert_medicines_run = mysqli_query($con, $insert_medicines);
                }
              }

              $query_instru_insert = "";
              if(isset($_POST['instrument_name'])){
                $prescribed_session = $_POST['instrument_name'];
                $prescribed_session_quantity = $_POST['quantityInstru'];

                foreach($prescribed_session as $key => $val){
                  if($val != 0){  //check if something is selected or not
                    $Idprice = explode(',', $val);
                    //$total_session_cost = $total_session_cost + (float)$Idprice[1] * (float)$prescribed_session_quantity[$key];
                    $query_instru_insert = $query_instru_insert."('" . $test_id ."',". $new_treatment_no ."," . (int)$Idprice[0] . "," . (int)$prescribed_session_quantity[$key] . "),";
                  }
                }
                if($query_instru_insert != ""){
                  $query_instru_insert = substr($query_instru_insert, 0, -1);

                  $insert_instru = "INSERT INTO `prescribed_session`(`test_id`, `treat_number`, `session_id`, `session_per_month`) 
                                    VALUES ". $query_instru_insert;
                  $insert_instru_run = mysqli_query($con, $insert_instru);
                  
                }
              }
              
              //print_r("INSERT INTO `prescribed_medicine`(`test_id`, `treat_number`, `medicine_id`, `quantity`) 
               //           VALUES ".$query_medicine_insert);


              //$total_price = $total_medi_cost + $total_session_cost;

              
              if($diet != "" && $report != ""){
                $diet_original = $_FILES['diet']['name'];
                $diet_tmp_name = $_FILES['diet']['tmp_name'];
                $diet_error = $_FILES['diet']['error'];
                $diet_type = $_FILES['diet']['type'];
    
                $report_original = $_FILES['report']['name'];
                $report_tmp_name = $_FILES['report']['tmp_name'];
                $report_error = $_FILES['report']['error'];
                $report_type = $_FILES['report']['type'];
    
                $diet_ext_seprate = explode('.', $diet_original);
                $report_ext_seprate = explode('.', $report_original);
            
                $diet_ext = strtolower(end($diet_ext_seprate));
                $report_ext = strtolower(end($report_ext_seprate));
    
                if($diet_error === 0 && $report_error === 0){
                  $diet_new_name = uniqid('', true).".".$diet_ext;
                  $report_new_name = uniqid('', true).".".$report_ext;
  
                  $diet_destination = "files/yoge_test/diet/".$diet_new_name;
                  move_uploaded_file($diet_tmp_name, $diet_destination);
  
                  $report_destination = "files/yoge_test/report/".$report_new_name;
                  move_uploaded_file($report_tmp_name, $report_destination);
  
                  $insert_test = "INSERT INTO `treatment`(`test_id`, `treat_number`, `diet`, `report`, `extra_note`) 
                                  VALUES ('$test_id','$new_treatment_no','$diet_destination','$report_destination','$extra_note')";          

                  if(mysqli_query($con, $insert_test)) {
                    $update_test_status = "UPDATE `yoge_home` SET `status`='started' WHERE `test_id`='$test_id'";
                    if($update_test_status_run = mysqli_query($con, $update_test_status)){
                      echo "<script>
                                  alert('test updated sucessfully');
                                  window.location.href='yoge_treatment_details.php?testID=$test_id';
                              </script>";
                    }
                  }
                }else{
                    echo "<script>alert('Error in uploading file Please try again after some time.');</script>";
                }
              }
            }
          
          ?>
          <!-- treatment section -->




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

  <!-- adding medicine column dynamicly -->
  <script src="js/add_medicine_dynamicly.js"></script>

  <!-- adding Instruments column dynamicly -->
  <script src="js/add_instruments_dynamicly.js"></script>
</body>

</html>

<script>
  function updateTreatment() {
    var treat = document.querySelector("#treat-panel");
    treat.classList.remove("d-none");
  }



  function showTest() {
    var testBlock = document.getElementById("treatBlock");
    treatBlock.classList.remove("d-none");
    document.getElementById("close-btn").classList.remove("d-none");
    document.getElementById("show-btn").classList.add("d-none");

  }

  function closeTestRes() {
    var closeTreat = document.querySelector("#treatBlock");
    closeTreat.classList.add("d-none");
    document.getElementById("show-btn").classList.remove("d-none");
    document.getElementById("close-btn").classList.add("d-none");
  }

//up doun arraw with field display
  function showDetails(a) {
    var x = document.querySelector("#" + a);
    var arrow = document.querySelector("#" + a + "_arrow");
    if (x.style.display === "none") {
        x.style.display = "block";
        arrow.classList.remove("fa-angle-right");
        arrow.classList.add("fa-angle-down");
    } else {
        x.style.display = "none";
        arrow.classList.remove("fa-angle-down");
        arrow.classList.add("fa-angle-right");
    }

  }

  function close_treatment() {
    if (confirm("do you want to close this treatment?")) {
        return true;
    }
    return false;
  }
//up doun arraw with field display
</script>


<?php 
      }else{
        //else part if
          echo "<script>
              alert('No record found');
              window.location.href='all_patients.php';
          </script>";
      }

    }else{
      //else part if session is not set
      echo "<script>
              window.location.href='../error/login_error.html';
            </script>";
    }
?>