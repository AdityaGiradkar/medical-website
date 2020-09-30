<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      $all_user = "SELECT * FROM `user`";
      $all_user_run = mysqli_query($con, $all_user);

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

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
            <a class="collapse-item" href="all_treatments.php">All Treatments</a>
          </div>
        </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#timing" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-clock"></i>
          <span>Timing</span>
        </a>
        <div id="timing" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Time Slots:</h6>
            <a class="collapse-item active" href="consultation_time.php">Add Time Slots</a>
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
                  <h6 class="collapse-header">Sssions:</h6>
                  <a class="collapse-item" href="all_medicines.php">All Sessions</a>
                  <a class="collapse-item" href="add_medicine.php">Add Session</a>
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

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Time Slots</h1>
          <p>Set time as per availability.</p>

          <form method="post" class="mt-5" action="">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1"><b>Select Date</b></label>
                  <input type="date" class="form-control" name="date" min="<?php echo date("Y-m-d"); ?>" required>
                </div>
              </div>
              <div class="col-md-1">
                
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="exampleInputEmail1"><b>Add all Slots</b></label>
                  <button type="submit" name="all_slots" class="btn btn-warning form-control float-right" title="Add all time slots from (5.30AM-11.30PM)">Add All Slots</button>
                </div>
                
              </div>
            </div>
            <table class="table table-bordered mt-4 table-striped">
              <thead>
                <tr>
                  <th scope="col">Timming</th>
                  <th scope="col">Remove</th>
                </tr>
              </thead>
              <tbody id="time">
                <!-- Medicine rows are added Dynamically through javascript -->
              </tbody>

            </table>
            <button type="button" onClick="addTimeSlot()" class="btn btn-primary">Add Slots</button>
            <button type="submit" name="submit" class="btn btn-success float-right">Submit Time Slots</button>
          </form>



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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- external javascript link -->
  <script src="js/consultation_time.js"></script>

</body>

</html>

<?php

  if(isset($_POST['submit'])){
    if(isset($_POST['date'])){
      $date = mysqli_real_escape_string($con, $_POST['date']);
      $timeSlot = $_POST['timeSlot'];
      
      
      $value = "";
      foreach($timeSlot as $key=>$slot) {
        $slot = mysqli_real_escape_string($con, $slot);
        $value = $value."('".$date."', '".$slot."'),";
      }
      $value = substr($value, 0, -1);
      //echo $value;

      $insert_slots = "INSERT INTO `consultation_time`(`date`, `time_range`) VALUES ".$value.";";
      if(mysqli_query($con, $insert_slots)){
        echo "<script> 
            alert('Timming has been sucessfully added.');
            window.location.href('available_slots.php');
            </script>";
      }
    }else{
      echo "<script>
        alert('please select date first');
      </script>";
    }
  }

  // all thime slots add
  if(isset($_POST['all_slots'])){
    $date = mysqli_real_escape_string($con, $_POST['date']);

    $value = "('".$date."', '05.30 - 06.00')," . 
             "('".$date."', '06.00 - 06.30')," .
             "('".$date."', '06.30 - 07.00')," .
             "('".$date."', '07.00 - 07.30')," .
             "('".$date."', '07.30 - 08.00')," .
             "('".$date."', '08.00 - 08.30')," .
             "('".$date."', '08.30 - 09.00')," .
             "('".$date."', '09.00 - 09.30')," .
             "('".$date."', '09.30 - 10.00')," .
             "('".$date."', '10.00 - 10.30')," .
             "('".$date."', '10.30 - 11.00')," .
             "('".$date."', '11.00 - 11.30')," .
             "('".$date."', '11.30 - 12.00')," .
             "('".$date."', '12.00 - 12.30')," .
             "('".$date."', '12.30 - 13.00')," .
             "('".$date."', '13.00 - 13.30')," .
             "('".$date."', '13.30 - 14.00')," .
             "('".$date."', '14.00 - 14.30')," .
             "('".$date."', '14.30 - 15.00')," .
             "('".$date."', '15.00 - 15.30')," .
             "('".$date."', '15.30 - 16.00')," .
             "('".$date."', '16.00 - 16.30')," .
             "('".$date."', '16.30 - 17.00')," .
             "('".$date."', '17.00 - 17.30')," .
             "('".$date."', '17.30 - 18.00')," .
             "('".$date."', '18.00 - 18.30')," .
             "('".$date."', '18.30 - 19.00')," .
             "('".$date."', '19.00 - 19.30')," .
             "('".$date."', '19.30 - 20.00')," .
             "('".$date."', '20.00 - 20.30')," .
             "('".$date."', '20.30 - 21.00')," .
             "('".$date."', '21.00 - 21.30')," .
             "('".$date."', '21.30 - 22.00')," .
             "('".$date."', '22.00 - 22.30')," .
             "('".$date."', '22.30 - 23.00')," .
             "('".$date."', '23.00 - 23.30')" ;


    $insert_slots = "INSERT INTO `consultation_time`(`date`, `time_range`) VALUES ".$value.";";
      if(mysqli_query($con, $insert_slots)){
        echo "<script> 
            alert('All slots for $date has been sucessfully added.');
            window.location.href('available_slots.php');
            </script>";
      }
  }






    }else{
      echo "<script>
              window.location.href='../error/login_error.html';
            </script>";
    }

?>