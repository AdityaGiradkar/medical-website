<?php 
    include("includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
      $user_info = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
      $user_info_run = mysqli_query($con, $user_info);
      $record = mysqli_fetch_assoc($user_info_run);


      //checking if user present for perticular
      //if not then redirect to user page
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

    <title>Patient History</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- custome style -->
    <link rel="stylesheet" href="admin/css/patient_history.css">

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
                    <i class="fas fa-fw fa-tachometer-alt"></i>
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
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Treatment History</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Treatment History:</h6>
                        <a class="collapse-item" href="all_consultations.php">All Consultations</a>
                        <a class="collapse-item active" href="ongoing_treatments.php">Ongoing Treatments</a>
                        <a class="collapse-item" href="">Past Treatments</a>
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
                    <i class="fas fa-fw fa-table"></i>
                    <span>Update Details</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="change_pass.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Change Password</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-table"></i>
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
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

                    </div>
                    <!-- person info ends  -->


                    <!-- User Details all its test history as weel as his consultation hostory -->
                    <div class="border border-primary rounded-lg p-3 mt-4">
                        <!-- test2 tab data -->
                        <?php
                            $anthropometry_tests = "SELECT * FROM `test_anthropometry` WHERE `user_id`='$user_id' AND `status`='start'";
                            $anthropometry_tests_run = mysqli_query($con, $anthropometry_tests);
                        ?>
                           
                        <!-- DataTales Example -->
                        <div class="card shadow mt-4 mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?php echo $_SESSION['name']; ?>'s
                                    Test History</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="testTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date</th>
                                                <th>Test Name</th>
                                                <th>details</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $test_no = 1;
                                                while($anthropometry_tests_res = mysqli_fetch_assoc($anthropometry_tests_run)){
                                            ?>
                                            <tr
                                                style="font-weight:<?php echo $anthropometry_tests_res['status'] != 'closed'?'bold': ''; ?>">
                                                <td><?php echo $test_no; ?></td>
                                                <td><?php  echo date("d-m-Y", strtotime($anthropometry_tests_res['date_time1'])); ?>
                                                </td>
                                                <td>Anthropometry Test</td>
                                                <td><a
                                                        href="anthropometry_test_details.php?testID=<?php echo $anthropometry_tests_res['test_id']; ?>">view</a>
                                                </td>
                                            </tr>
                                            <?php
                                                $test_no++;
                                                }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Details all its test history as well as his consultation hostory -->


                    <!-- all its treatment history  -->
                    <?php 
                        
                            include("includes/treatment_history.php");
    
                    ?>
                    <!-- all its treatment history  -->

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

    <!-- modal for test selection -->
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
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

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