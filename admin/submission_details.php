<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){

      $submission_id = $_GET['subid'];
      $detail = "SELECT * 
                  FROM `user` RIGHT JOIN `user-answer` 
                  ON `user`.`user_id`=`user-answer`.`user_id` 
                  WHERE `user-answer`.`submission_id`='$submission_id'";
      $detail_run = mysqli_query($con, $detail);
      $record = mysqli_fetch_assoc($detail_run);

      //check wheather patient is already checked
      if($record['status'] != 'new'){
        echo "<script> 
                alert('already checked');
                window.location.href='new_patient.php';
              </script>";
      }


      //fetching question answer of given submission id;
      $que_ans = "SELECT * FROM `answers` WHERE `submission_id`='$submission_id'";
      $que_ans_run = mysqli_query($con, $que_ans);

      //finding total number of new patient
      $new_patient_count = "SELECT count(*) as total FROM `user-answer` WHERE `status`='new'";
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

  <title>Submission Details</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
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
        Treatment
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePatient"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user-injured"></i>
          <span>Patients <?php if($data['total'] > 0){ ?><sup><i class="fas fa-circle" style="font-size: .75em !important;"></i></sup><?php } ?></span>
        </a>
        <div id="collapsePatient" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Patients : </h6>
            <a class="collapse-item active" href="new_patient.php">New Patient (<?php echo $data['total']; ?>)</a>
            <a class="collapse-item" href="all_patients.php">All Patient</a>
          </div>
        </div>
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
          <span>Quiz</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quiz Section:</h6>
            <a class="collapse-item" href="all_questions.php">All Questions</a>
            <a class="collapse-item" href="add_question.php">Add Question</a>
          </div>
        </div>
      </li>

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['f_name']." ".$_SESSION['l_name']; ?></span>
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
            <div class="border border-primary rounded-lg p-3" style="background-color:#fff; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.35)">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Name :</b> <?php echo $record['first_name']." ".$record['last_name']; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Contact :</b> <?php echo $record['contact_no']; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Email :</b> <?php echo $record['email_id']; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Gender :</b> <?php echo $record['gender']; ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <b>Submission Time :</b> <?php date("d/m/Y H:i:s", strtotime($record['time'])); ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- person info ends  -->

            <!-- user submitted question answers -->
            <div class="border border-primary rounded-lg p-3 mt-4">
              <div class="row">
              <?php 
                $count = 1;
                while($que_ans_res = mysqli_fetch_assoc($que_ans_run)){
              ?>
                <div class="col-md-6">
                  <p><b><?php echo $count.". ".$que_ans_res['question_id']; ?></b></p>
                  <p><?php echo "Ans :- ".$que_ans_res['answer']; ?></p>
                </div>
                <?php 
                    $count++;
                    }
                ?>
              </div>
                
                
                
            </div>

            <!-- Action button close, start, and suspend -->
            <div class="border border-primary rounded-lg p-3 mt-4">
                <div class="m-auto">
                    <div class="d-inline-block">
                      <form method="post" onsubmit="return close_treatment()">
                          <button type="submit" name="close" class="btn btn-success">Close treatment</button>
                      </form>
                    </div>
                    <div class="d-inline-block">
                        <button type="button" onClick="startTreatment()" name="start" class="btn btn-primary">Start treatment</button>
                    </div>
                </div>
            </div>
            <!-- End of Action button close, start, and suspend -->

            <!-- Treatment pannel. Initially hidden show when start treatment -->
            <div class="border border-primary rounded-lg p-3 mt-4 d-none treat-panel">
                    <?php 
                      $all_medicines = "SELECT * FROM `medicines`";
                      $all_medicines_run = mysqli_query($con, $all_medicines);
                      $count = 0;
                      while($medi = mysqli_fetch_assoc($all_medicines_run)){
                        $medicines[$count] = $medi['Name'];
                        $count++; 
                      }
                    ?>
                    <!-- Passing medicine array in the js file  -->
                    <script>
                      var medicineArray = <?php echo json_encode($medicines); ?> 
                    </script>
                    <!-- Passing medicine array in the js file  -->

                <p>Treatment start</p>
                <form method="post" onsubmit="return confirm_submission();">
                  <div class="form-group">
                    <label for="">Medicines</label><br>
                    
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Medicine Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Dose</th>
                          <th scope="col">Remove</th>
                        </tr>
                      </thead>
                      <tbody  id="medicine">
                        <!-- Medicine rows are added Dynamically through javascript -->
                      </tbody>
                    </table>
                    
                    <button type="button" onClick="addMedicine()" class="btn btn-primary">Add Medicines</button>
                  </div>
                  <div class="form-group">
                    <label for="note">Extra Note</label>
                    <textarea class="form-control" placeholder="If nothing type 'NA'" id="note" name="note" rows="3" required></textarea>
                  </div>
                  <input type="submit" name="treat" class="btn btn-primary"></input>
                </form>
            </div>
            <!-- end of tratment Pannel -->

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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

  <!-- Custom Scripts for basic functionalities for this page only -->
  <script src="js/submission_details.js"></script>
</body>

</html>


<?php 
  if(isset($_POST['treat'])){
    $medicine_name = $_POST['medicine_name'];
    $quantity = $_POST['quentity'];
    $dose = $_POST['dose'];
    $note = $_POST['note'];

    $value = "";
  foreach($medicine_name as $key=>$medicine) {
    $q = $quantity[$key];
    $d = $dose[$key];
    $value = $value."(".$submission_id.", '".$medicine."', '".$q."', '".$d."'),";
  }
  $value = substr($value, 0, -1);
  $entry = "INSERT INTO `prescribed-medicine`(`submission_id`, `medicine_name`, `quantity`, `dose`) VALUES ".$value.";";
  
  $update_status = "UPDATE `user-answer` SET `status`='open',`doctor-note`='$note' WHERE `submission_id`='$submission_id'";
  $entry_run = mysqli_query($con, $entry) ;
  $update_status_run = mysqli_query($con, $update_status);
  
    if($entry_run || $update_status_run){
      echo "<script> 
              alert('Treatment is started. You can see this in All patient list');
              window.location.href='new_patient.php';
      </script>";
    }
  
  }

  if(isset($_POST['close'])){
    $update_status = "UPDATE `user-answer` SET `status`='closed' WHERE `submission_id`='$submission_id'";
    if($update_status_run = mysqli_query($con, $update_status)){
      echo "<script> 
              alert('Treatment is closed. You can see this in All patient list');
              window.location.href='new_patient.php';
          </script>";
    }
  }


}else{
  //else part if session is not set
  echo "<script>
          window.location.href='../error/login_error.html';
        </script>";
}


?>
