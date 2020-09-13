<?php 
    include("includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){

        $yoge_home = "SELECT * FROM `user` u RIGHT JOIN `yoge_home` y 
                    ON u.`user_id`=y.`user_id`
                    WHERE y.`status`='closed' ORDER BY y.`date_time` DESC";
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
                        <a class="collapse-item" href="ongoing_treatments.php">Ongoing Treatments</a>
                        <a class="collapse-item active" href="past_treatments.php">Past Treatments</a>
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


                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Test 1</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">YogE @ HOME Test
                                (<?php echo $yoge_home_rows; ?>)</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Test 3</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <!-- DataTales Example -->
                            <div class="card shadow mt-4 mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="yoge_table" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Name</th>
                                                    <th>Contact No.</th>
                                                    <th>consultation Type</th>
                                                    <th>check</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $count = 1;
                                                while($record = mysqli_fetch_assoc($all_user_run)){
                                                    
                                                ?>
                                                <tr>
                                                    <th><?php echo $count; ?></th>
                                                    <td><?php echo $record['date']; ?></td>
                                                    <td><?php echo $record['time_range']; ?></td>
                                                    <td><?php echo $record['name'];?></td>
                                                    <td><?php echo $record['contact_no']; ?></td>
                                                    <!-- <td><?php //echo date("d/m/Y H:i:s", strtotime($record['time'])); ?></td> -->
                                                    <td><?php echo $record['consult_type']; ?></td>
                                                    <!-- <td><a href="submission_details.php?subid=<?php //echo $record['submission_id']; ?>">done</a></td> -->
                                                    <td><a href="mark_done.php?date=<?php echo $record['date']; ?>&time=<?php echo $record['time_range']; ?>"
                                                            onClick="javascript: return confirm('you want to mark done to user <?php echo $record['name']; ?>?');">done</a>
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
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                                    <th>Start Date</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
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
                                                    <td><?php echo date("d-m-Y", strtotime($yoge_home_res['date_time'])); ?>
                                                    </td>
                                                    <td><?php echo $yoge_home_res['name']; ?></td>
                                                    <td><?php echo $yoge_home_res['status'];?></td>
                                                    <td><a href="yoge_test_details.php?testID=<?php echo $yoge_home_res['test_id']; ?>" >view</a></td>
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
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>

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

</body>

</html>


<?php
    }else{
      //else part if session is not set
      echo "<script>
              window.location.href='error/login_error.html';
            </script>";
    }

?>