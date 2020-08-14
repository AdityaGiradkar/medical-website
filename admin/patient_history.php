<?php 
    include("../includes/db.php");
    $user_id = $_GET['uid'];
    $user_info = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
    $user_info_run = mysqli_query($con, $user_info);
    $record = mysqli_fetch_assoc($user_info_run);
    if($record){

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Blank</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- custome style -->
  <link rel="stylesheet" href="css/patient_history.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

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
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
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
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
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
        <div class="container-fluid">
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
                </div>
            </div>
            <!-- person info ends  -->

            <div class="border border-primary rounded-lg p-3 mt-4"> 
                <h5>Treatment history</h5>

                <div class="container-fluid pl-0 pr-0">
                <?php
                        $all_treat = "SELECT * FROM `user-answer` WHERE `user_id`='$user_id'";
                        $all_treat_run = mysqli_query($con, $all_treat);
                        $count=1;
                        while($all_treat_res = mysqli_fetch_assoc($all_treat_run)){
                            $sub_id = $all_treat_res['submission_id'];
                ?>
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo date("d/m/Y", strtotime($all_treat_res['time'])); ?></div>
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
                                    <a class="up-down-arrow" onClick="showDetails('d_<?php echo $count; ?>')"><i class="fas arrow fa-angle-right fa-2x" id="d_<?php echo $count; ?>_arrow"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-1" style="display:none" id="d_<?php echo $count; ?>">
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
                            <b>Treatment</b>
                            <div class="">
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
                                        <button type="submit" name="close_<?php echo $count; ?>" class="btn btn-success">Close treatment</button>
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
          <a class="btn btn-primary" href="login.html">Logout</a>
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
    echo "<script>
        alert('No record found');
        window.location.href='all_patients.php';
    </script>";
}
?>