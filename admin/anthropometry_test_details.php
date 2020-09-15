<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      $test_id = $_GET['testID'];
      $test_details = "SELECT * FROM `test_anthropometry` WHERE `test_id`='$test_id'";
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
      <li class="nav-item">
        <a class="nav-link collasped" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-user-injured"></i>
          <span>Patients <?php if($data['total'] > 0){ ?><sup><i class="fas fa-circle"
                style="font-size: .75em !important;"></i></sup><?php } ?></span>
        </a>
        <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Patients : </h6>
            <a class="collapse-item" href="new_patient.php">New consultation (<?php echo $data['total']; ?>)</a>
            <a class="collapse-item" href="test_submissions.php">New Test Submissions</a>
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
            <a class="collapse-item" href="available_slots.php">Available Slots</a>
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

      <li class="nav-item active">
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
          <!-- Page Heading -->

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

          <!-- OF test details  -->
          <div class="border border-primary rounded-lg mt-4 p-3">
          <?php 
                $anthropometry_tests = "SELECT * FROM `test_anthropometry` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
                if($anthropometry_tests_run = mysqli_query($con, $anthropometry_tests)){
                    $count = 1;
                    $anthropometry_tests_res = mysqli_fetch_assoc($anthropometry_tests_run)
            ?>
            
                <div class="card border-left-primary shadow h-100 py-2 mb-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <?php echo date("d/m/Y", strtotime($anthropometry_tests_res['date_time1'])); ?> --> <?php if($anthropometry_tests_res['times'] == 2) {echo date("d/m/Y", strtotime($anthropometry_tests_res['date_time2']));} ?>
                                </div>
                                <div class="text-xs font-weight-bold text-primary mt-2 mb-1">
                                    <?php echo "Status: ".$anthropometry_tests_res['status']; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a class="up-down-arrow"
                                    onClick="showDetails('d_<?php echo $count; ?>')"><i
                                        class="fas arrow fa-angle-right fa-2x"
                                        id="d_<?php echo $count; ?>_arrow"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2" style="display:none" id="d_<?php echo $count; ?>">
                        <b>Details : </b><br>
                            <p>report : <a target="_blank" href="<?php echo $anthropometry_tests_res['test_result']; ?>">View</a><p>
                            <p>Diet Plan: <a target="_blank" href="<?php echo $anthropometry_tests_res['diet_plan']; ?>">view</a></p>
                    </div>
                </div>
                <?php } ?>  
                
                <?php if($anthropometry_tests_res['times'] == 1){ ?>
                <button type="button" onClick="startTreatment()" class="btn btn-primary"
                                    data-toggle="modal" data-target="#start_test">Re-test</button>
                <?php } ?>
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
            <span>Copyright &copy; Your Website 2020</span>
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


  <div class="modal fade  bd-example-modal-lg" id="start_test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="modal-title" id="exampleModalLongTitle">STRESS MANAGEMENT PROGRAMME</h5>

                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Report of test</label>
                            <input type="file" name="report" class="form-control-file" id="exampleFormControlFile1" required>
                        </div>
                        <div class="form-group">
                            <label for="diet">Diet Plan</label>
                            <input type="file" name="diet" class="form-control-file" id="diet" required>
                        </div>
                        <button type="submit" name="update_test" class="btn btn-primary">Update Test</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

</body>

</html>

<script>
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
</script>

<?php 
    if(isset($_POST['update_test'])){
        $diet = $_FILES['diet'];
        $report = $_FILES['report'];

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

                $diet_destination = "files/anthropometry/diet/".$diet_new_name;
                move_uploaded_file($diet_tmp_name, $diet_destination);

                $report_destination = "files/anthropometry/report/".$report_new_name;
                move_uploaded_file($report_tmp_name, $report_destination);

                $update_test = "UPDATE `test_anthropometry` SET `test_result`='$report_destination',`times`=2,`status`='closed',`diet_plan`='$diet_destination' WHERE `test_id`='$test_id'";
                //$insert_test = "INSERT INTO `test_anthropometry`(`test_id`, `user_id`, `test_result`, `times`, `status`, `diet_plan`) 
                               // VALUES ('$test_id','$user_id','$report_destination',2,'start','$diet_destination')";
                if($update_test_run = mysqli_query($con, $update_test)) {
                    echo "<script>
                                alert('test started sucessfully');
                                window.location.href='user_details.php?uid=$user_id';
                            </script>";
                }
            }else{
                echo "<script>alert('Error in uploading file Please try again after some time.');</script>";
            }

        }
    }

?>

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