<?php 
    include("includes/db.php");
    session_start();
    
    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        $yoge_test = "SELECT * FROM `yoge_home` WHERE `user_id`='$user_id' ORDER BY `date_time` DESC";
        $yoge_test_run = mysqli_query($con, $yoge_test);

        // Check for remaining tests
        $check_remaining_tests = "SELECT * FROM `test_payments` WHERE `user_id`='$user_id' AND `test_type`<5 AND `test_id` IS NULL GROUP BY `test_type`";
        $check_remaining_tests_run = mysqli_query($con, $check_remaining_tests);
        $check_remaining_tests_rows = mysqli_num_rows($check_remaining_tests_run);
        $tests = array(0,0,0,0,0,0);
        while($check_remaining_tests_res = mysqli_fetch_assoc($check_remaining_tests_run)){
            $index = $check_remaining_tests_res['test_type'];
            $tests[$index] = $check_remaining_tests_res['order_id'];
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

    <title>All Tests</title>

    <!-- Custom fonts for this template -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Treatments & Reports</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Treatment History:</h6>
            <a class="collapse-item" href="all_consultations.php">All Consultations</a>
            <a class="collapse-item active" href="all_test.php">All Tests & Report</a>
            <a class="collapse-item" href="ongoing_treatments.php">Treatments & Report</a>
            <a class="collapse-item" href="past_treatments.php">Past Treatments & Report</a>
          </div>
        </div>
      </li>

      <!-- Tests  --> 
      <?php
        if($check_remaining_tests_rows > 0){
      ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#incompleteTest" aria-expanded="true"
          aria-controls="incompleteTest">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Incomplete Tests</span>
        </a>
        <div id="incompleteTest" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Incomplete Tests:</h6>
            <?php if($tests[1] !== 0) { ?><a class="collapse-item" href="YogE_rakshakavach.php?orderId=<?php echo $tests[1]; ?>">YOG-E@Rakshakavach <br>Basic</a><?php } ?>
            <?php if($tests[2] !== 0) { ?><a class="collapse-item" href="YogE_HomeCare.php?orderId=<?php echo $tests[2]; ?>">YOG-E@HomeCare</a><?php } ?>
            <?php if($tests[3] !== 0) { ?><a class="collapse-item" href="YogE_CritiCare.php?orderId=<?php echo $tests[3]; ?>">YOG-E@CritiCare</a><?php } ?>
            <?php if($tests[4] !== 0) { ?><a class="collapse-item" href="YogE_Antropometry.php?orderId=<?php echo $tests[4]; ?>">YOG-E@Anthropometry</a><?php } ?>
            <?php if($tests[5] !== 0) { ?><a class="collapse-item" href="YogE_rakshakavach.php?orderId=<?php echo $tests[5]; ?>">YOG-E@Rakshakavach <br>Advanced</a><?php } ?>
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
                <div class="container-fluid main-top main-left">

                    <div class="border border-primary rounded-lg p-3 mt-4 mb-3">
                        <h5 class="mb-4">Take New Test</h5>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <select name="test_type" class="form-control" id="exampleFormControlSelect1">
                                            <!-- <option disabled selected hidden value="0">Select new Test</option> -->
                                            <?php 
                                                $fetch_all_test = "SELECT * FROM `test_type`";
                                                $fetch_all_test_run = mysqli_query($con, $fetch_all_test);
                                                while($fetch_all_test_res = mysqli_fetch_assoc($fetch_all_test_run)){
                                            ?>
                                            <option value="<?php echo $fetch_all_test_res['test_id']; ?>"><?php echo $fetch_all_test_res['test_name']; ?></option>
                                            <?php 
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" name="select_test" class="btn btn-primary">Start Test</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <a class="btn mt-3 mb-3 btn-success d-inline-block" width="200" href="compare_antropometry.php">Compaire Antropometry results</a>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Taken Tests</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Date</th>
                                            <th>Test Type</th>
                                            <th>Charges</th>
                                            <th>Status</th>
                                            <th>Receipt</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $all_tests = "SELECT * FROM `test_payments` WHERE `user_id`='$user_id' ORDER BY `pay_id` DESC";
                                            $all_tests_run = mysqli_query($con, $all_tests);
                                            $count = 1;
                                            while($record = mysqli_fetch_assoc($all_tests_run)) {
                                                $test_type = $record['test_type'];
                                                $pay_id = $record['pay_id'];
                                                $test_details = "SELECT * FROM `test_type` WHERE `test_id`='$test_type'";
                                                $test_details_run = mysqli_query($con, $test_details);
                                                $test_details_res = mysqli_fetch_assoc($test_details_run); 
                                        ?>
                                        <tr style="font-weight:<?php echo $record['status'] == 'pending'?'bold': ''; ?>">
                                            <th><?php echo $count; ?></th>
                                            <td><?php echo date("d-m-Y h:ia", strtotime($record['created_at'])); ?></td>
                                            <td><?php echo $test_details_res['test_name']; ?></td>
                                            <td><?php echo $record['charges']; ?></td>
                                            <td><?php echo $record['status']; ?></td>
                                            <td><a href="view_receipt_test.php?bill_no=<?php echo $record['bill_no']; ?>">view</a></td>
                                            <td><a <?php 
                                                        if($record['test_id'] != "" && $record['test_type'] == 2){ 
                                                    ?> 
                                                            href="HomeCare_test_details.php?pay_id=<?php echo $pay_id; ?>" 
                                                    <?php 
                                                        }else if($record['test_id'] != "" && $record['test_type'] == 3) { 
                                                    ?> 
                                                            href="CritiCare_test_details.php?pay_id=<?php echo $pay_id; ?> "
                                                    <?php 
                                                        }else if($record['test_id'] != "" && $record['test_type'] == 4) { 
                                                    ?> 
                                                            href="antropometry_test_details.php?pay_id=<?php echo $pay_id; ?> "
                                                    <?php 
                                                        }else if($record['test_id'] != "" && ($record['test_type'] == 1 || $record['test_type'] == 5)) { 
                                                    ?> 
                                                            href="rakshakavach_test_details.php?pay_id=<?php echo $pay_id; ?> " 
                                                    <?php 
                                                        } 
                                                    ?>
                                                >view</a>
                                            </td>
                                        </tr>
                                        <?php 
                                                $count++;
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
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

    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/datatables-demo.js"></script>

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

//check for user have filled the details or not
$check_detailes_fieled = "SELECT  `problems` FROM `medical_history` WHERE `user_id`='$user_id'";
$check_detailes_fieled_run = mysqli_query($con, $check_detailes_fieled);
$check_detailes_fieled_res = mysqli_fetch_assoc($check_detailes_fieled_run);


    if(isset($_POST['select_test'])){
        if(isset($_SESSION['user_id'])){
            $test_type = $_POST['test_type'];


            //check for user have filled the details or not
            if($check_detailes_fieled_res['problems'] == ""){
                echo "<script>
                        alert('Please first Fill the details.');
                        window.location.href='update_details.php';
                    </script>";
            }
            
            echo "<script>
                    window.location.href='payment/test_payment.php?type=$test_type';
            </script>";
        }else{
            echo "<script>
                alert('Please login first.');
                window.location.href='login.php';
            </script>";
        }
    }
?>

<?php
    }else{
      echo "<script>
              window.location.href='../error/login_error.html';
            </script>";
    }

?>