<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){

        $yoge_home = "SELECT * FROM `user` u RIGHT JOIN `treatment` t
                    ON u.`user_id`=t.`user_id`
                    WHERE t.`treat_status`='ongoing' 
                    GROUP BY u.`user_id` ORDER BY t.`date` DESC";
        $yoge_home_run = mysqli_query($con, $yoge_home);
        $yoge_home_rows = mysqli_num_rows($yoge_home_run);
        

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

    <title>New Patient List</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                        <a class="collapse-item" href="test_submissions.php">New Test Submissions</a>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicine" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-pills"></i>
                    <span>Sessions</span>
                </a>
                <div id="collapseMedicine" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sessions:</h6>
                        <a class="collapse-item" href="all_sessions.php">All Sessions</a>
                        <a class="collapse-item" href="add_session.php">Add Session</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs"
                    aria-expanded="true" aria-controls="collapseTwo">
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

                    <!-- DataTales Example -->
                    <div class="card shadow mt-4 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email ID</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 1;
                                        while($yoge_home_res = mysqli_fetch_assoc($yoge_home_run)){
                                            
                                        ?>
                                        <tr>
                                            <th><?php echo $count; ?></th>
                                            <td><?php echo date("d-m-Y", strtotime($yoge_home_res['date'])); ?>
                                            </td>
                                            <td><?php echo $yoge_home_res['name']; ?></td>
                                            <td><?php echo $yoge_home_res['contact_no'];?></td>
                                            <td><?php echo $yoge_home_res['email_id']; ?></td>
                                            <!-- <td><a href="submission_details.php?subid=<?php //echo $record['submission_id']; ?>">done</a></td> -->
                                            <td><a
                                                    href="user_details.php?uid=<?php echo $yoge_home_res['user_id']; ?>">view</a>
                                            </td>
                                        </tr>

                                        <?php 
                                        $count++;
                                        //end of while loop
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

</body>

</html>


<?php
    }else{
      //else part if session is not set
      echo "<script>
              window.location.href='../error/login_error.html';
            </script>";
    }

?>