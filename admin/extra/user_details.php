<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      $user_id = $_GET['uid'];
      $user_info = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
      $user_info_run = mysqli_query($con, $user_info);
      $record = mysqli_fetch_assoc($user_info_run);

      $medical_history = "SELECT * FROM `medical_history` WHERE `user_id`='$user_id'";
      $medical_history_run = mysqli_query($con, $medical_history);
      $medical_history_res = mysqli_fetch_assoc($medical_history_run);
      //checking if user present for perticular
      //if not then redirect to user page
      if($record){
        
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user-injured"></i>
          <span>Patients <?php if($data['total'] > 0){ ?><sup><i class="fas fa-circle"
                style="font-size: .75em !important;"></i></sup><?php } ?></span>
        </a>
        <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Patients : </h6>
            <a class="collapse-item" href="new_patient.php">New consultation (<?php echo $data['total']; ?>)</a>
            <a class="collapse-item" href="test_submissions.php">New Test Submissions</a>
            <a class="collapse-item" href="all_patients.php">All Patient</a>
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

      <!-- Sidebar Toggler (Sidebar) -->
      <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" onClick="sidebarTog()" id="sidebarToggle"></button>
      </div> -->

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
                <b>Name :</b> <?php echo $record['name']; ?>
              </div>
              <div class="col-md-4">
                <b>Father's Name :</b> <?php echo $record['father_name']; ?>
              </div>
              <div class="col-md-4">
                <b>Contact :</b> <?php echo $record['contact_no']; ?>
              </div>
              <div class="col-md-4">
                <b>Email :</b> <?php echo $record['email_id']; ?>
              </div>
              <div class="col-md-4">
                <b>Gender :</b> <?php echo $record['gender']; ?>
              </div>
              <div class="col-md-4">
                <b>DOB :</b> <?php echo date("d-m-Y", strtotime($record['dob'])); ?>
              </div>
              <div class="col-md-4">
                <b>Married :</b> <?php echo $record['married']; ?>
              </div>
              <div class="col-md-4">
                <b>Working :</b> <?php echo $record['working']; ?>
              </div>
              <div class="col-md-4">
                <b>Address :</b> <?php echo $record['address']; ?>
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

          <div class="border border-primary rounded-lg p-3 mt-4">
            <h5>Treatment history</h5>

            <div class="container-fluid pl-0 pr-0">
              <?php
                $all_treat = "SELECT * FROM `consultation_time` WHERE `assigned_user`='$user_id' ORDER BY `date` DESC, `time_range` DESC";
                $all_treat_run = mysqli_query($con, $all_treat);
                $count=1;
                while($all_treat_res = mysqli_fetch_assoc($all_treat_run)){
                    $sub_id = $all_treat_res['submission_id'];
                ?>
              <div class="card border-left-primary shadow h-100 py-2 mb-3">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php echo date("d/m/Y", strtotime($all_treat_res['time'])); ?></div>
                      <div class="text-xs font-weight-bold text-primary mt-2 mb-1">
                        <?php 
                            $prescribed_med = "SELECT * FROM `prescribed-medicine` WHERE `submission_id`='$sub_id'";
                            $prescribed_med_run = mysqli_query($con, $prescribed_med);
                            while($prescribed_med_res = mysqli_fetch_assoc($prescribed_med_run)){
                                echo $prescribed_med_res['medicine_name'];
                        ?>
                        - <?php echo $prescribed_med_res['quantity']; ?>
                        &nbsp;|&nbsp;
                        <?php }?>
                        <?php echo "Status: ".$all_treat_res['status']; ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <a class="up-down-arrow" onClick="showDetails('d_<?php echo $count; ?>')"><i
                          class="fas arrow fa-angle-right fa-2x" id="d_<?php echo $count; ?>_arrow"></i></a>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-2" style="display:none" id="d_<?php echo $count; ?>">
                  <b>Details : </b>
                  <div class="row">
                    <?php 
                        $all_queans = "SELECT * FROM `answers` WHERE `submission_id`='$sub_id'";
                        $all_queans_run = mysqli_query($con, $all_queans);
                        $que_no = 1;
                        while($all_queans_res = mysqli_fetch_assoc($all_queans_run)){
                    ?>
                    <div class="col-md-6">
                      <p><b><?php echo $que_no.". ".$all_queans_res['question_id']; ?></b></p>
                      <p><?php echo "Ans:- ".$all_queans_res['answer']; ?></p>
                    </div>
                    <?php 
                        $que_no++;
                        }
                    ?>
                  </div>

                  <div class="pt-4">
                    <b>Treatment : </b>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Sr. No.</th>
                          <th scope="col">Medicine name</th>
                          <th scope="col">quantity</th>
                          <th scope="col">Dose</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $medicine_no = 1;
                            $prescribed_med_run = mysqli_query($con, $prescribed_med);
                            while($prescribed_med_res = mysqli_fetch_assoc($prescribed_med_run)){
                        ?>
                        <tr>
                          <th scope="row"><?php echo $medicine_no; ?></th>
                          <td><?php echo $prescribed_med_res['medicine_name']; ?></td>
                          <td><?php echo $prescribed_med_res['quantity']; ?></td>
                          <td><?php echo $prescribed_med_res['dose']; ?></td>
                        </tr>
                        <?php
                            $medicine_no++;
                            }
                        ?>
                        <tr>
                          <td scope="row" colspan="4"><?php echo "<b>Note : </b>".$all_treat_res['doctor-note']; ?></td>
                        </tr>

                      </tbody>
                    </table>

                  </div>
                  <div class="Actions">
                    <?php 
                      if($all_treat_res['status'] !== "closed"){
                    ?>
                    <div class="d-inline-block">
                      <form method="post" onsubmit="return close_treatment()">
                        <button type="submit" name="close_<?php echo $count; ?>" class="btn btn-success">Close
                          treatment</button>
                      </form>
                      <?php 
                          if(isset($_POST['close_'.$count])){
                              $update_status = "UPDATE `user-answer` SET `status`='closed' WHERE `submission_id`='$sub_id'";
                              if($update_status_run = mysqli_query($con, $update_status)){
                                  echo "<script> 
                                          alert('Treatment is closed. You can see this in All patient list');
                                          window.location.href='all_patients.php';
                                      </script>";
                              }
                          }
                      ?>
                    </div>
                    <?php } ?>
                  </div>

                </div>
              </div>


              <?php
                  $count++; 
                  }
              ?>
            </div>
          </div>

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

  <!-- custom js file for opening details -->
  <script src="js/patient_history.js"></script>
</body>

</html>



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