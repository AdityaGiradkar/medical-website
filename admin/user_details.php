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

      // previous treatment number
      $previous_treat_number = "SELECT max(`treat_number`) as pre_treat_number FROM `treatment` WHERE `user_id`='$user_id'";
      $previous_treat_number_run = mysqli_query($con, $previous_treat_number);
      $previous_treat_number_res = mysqli_fetch_assoc($previous_treat_number_run);
      $current_treat_no = $previous_treat_number_res['pre_treat_number'] + 1;

      //checking if user present for perticular
      //if not then redirect to user page
      if($record){
        $name = $record['name'];
        //fetching all consultations by the user till today date
        $all_consultations = "SELECT * FROM `consultation_time` WHERE `assigned_user`='$user_id' ORDER BY `date` DESC, `time_range` DESC";
        $all_consultations_run = mysqli_query($con, $all_consultations);

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
                        <a class="collapse-item" href="new_patient.php">New consultation
                            (<?php echo $data['total']; ?>)</a>
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSessions"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-pills"></i>
                    <span>Sessions</span>
                </a>
                <div id="collapseSessions" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sssions:</h6>
                        <a class="collapse-item" href="all_sessions.php">All Sessions</a>
                        <a class="collapse-item" href="add_session.php">Add Session</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-pills"></i>
                    <span>Blogs & Videos</span>
                </a>
                <div id="collapseBlogs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Blogs & Videos:</h6>
                        <a class="collapse-item" href="blogs_table.php">All Blogs & Videos</a>
                        <a class="collapse-item" href="add_blogs.php">Add Blogs & Videos</a>
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
                                <a class="dropdown-item" target="_blank" href="https://dashboard.razorpay.com/#/access/signin">
                                    <!-- <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> -->
                                    <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>
                                    RazorPay 
                                </a>
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

                        <h1 class="h4 mt-4 mb-2 text-gray-800">Medical History</h1>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <b>What is problem you have ? :</b> <?php echo $medical_history_res['problems']; ?>
                            </div>
                            <div class="col-md-4 mb-3">
                                <b>what type of treatment you tried before? :</b>
                                <?php echo $medical_history_res['teratment_tried']; ?>
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

                    <button type="button" class="btn btn-success mt-3" data-toggle="modal"
                        data-target="#start_treatatment">Start NEW Treatment</button>
                        
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                        data-target="#start_test">Start NEW Yog-E
                        Anthropometry</button>

                    

                    <!-- User Details all its test history as weel as his consultation hostory -->
                    <div class="border border-primary rounded-lg p-3 mt-4">
                        <!-- List of tabs  -->
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="test1-tab" data-toggle="tab" href="#test1" role="tab"
                                    aria-controls="test1" aria-selected="true">Consultations</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="test2-tab" data-toggle="tab" href="#test2" role="tab"
                                    aria-controls="test2" aria-selected="false">Test Details</a>
                            </li>
                        </ul>
                        <!-- List of tabs  -->

                        <!-- Tab DATA -->
                        <div class="tab-content" id="myTabContent">
                            <!-- test1 tab data -->
                            <div class="tab-pane fade show active" id="test1" role="tabpanel"
                                aria-labelledby="test1-tab">

                                <!-- DataTales Example -->
                                <div class="card shadow mt-4 mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $record['name']; ?>'s
                                            Consultation History</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Consultation Type</th>
                                                        <th>Status</th>
                                                        <th>Recipt</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $count = 1;
                                                        while($record = mysqli_fetch_assoc($all_consultations_run)) {
                                                            $bill_number = $record['bill_number'];
                                                    ?>
                                                    <tr
                                                        style="font-weight:<?php echo $record['status'] == 'assigned'?'bold': ''; ?>">
                                                        <th><?php echo $count; ?></th>
                                                        <td><?php echo date("d-m-Y", strtotime($record['date'])); ?>
                                                        </td>
                                                        <td><?php echo $record['time_range']; ?></td>
                                                        <td><?php echo $record['consult_type']; ?></td>
                                                        <td><?php echo $record['status'] == 'assigned'?"Pending":"Checked"; ?>
                                                        </td>
                                                        <td><a href="view_recipt_consultation.php?bill_no=<?php echo $bill_number; ?>">View</a></td>
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
                            <!-- test1 tab data -->

                            <!-- test2 tab data -->
                            <?php
                            // different test submissions by user
                            $all_taken_test = "SELECT * FROM `test_type` tt RIGHT JOIN `test_payments` tp 
                                                ON tt.`test_id`=tp.`test_type`
                                                WHERE tp.`user_id`='$user_id'
                                                ORDER BY tp.`pay_id` DESC";
                            $all_taken_test_run = mysqli_query($con, $all_taken_test);
                            ?>
                            <div class="tab-pane fade p-3" id="test2" role="tabpanel" aria-labelledby="test2-tab">
                           
                                <div class="card shadow mt-4 mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $name; ?>'s
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
                                                        <th>Charges (&#x20B9;)</th>
                                                        <th>Status</th>
                                                        <th>Receipt</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $test_no = 1;
                                                        while($all_taken_test_res = mysqli_fetch_assoc($all_taken_test_run)){
                                                    ?>
                                                    <tr style="font-weight:<?php echo $all_taken_test_res['status'] == 'pending'?'bold': ''; ?>">
                                                        <td><?php echo $test_no; ?></td>
                                                        <td><?php echo date("d-m-Y", strtotime($all_taken_test_res['created_at'])); ?></td>
                                                        <td><?php echo $all_taken_test_res['test_name']; ?></td>
                                                        <td>&#x20B9; <?php echo $all_taken_test_res['charges']; ?></td>
                                                        <td><?php echo $all_taken_test_res['status']; ?></td>
                                                        <td><a
                                                                href="view_receipt_test.php?bill_no=<?php echo $all_taken_test_res['bill_no']; ?>">view</a>
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
                            <!-- test2 tab data -->

                        </div>
                        <!-- Tab DATA -->

                    </div>
                    <!-- User Details all its test history as well as his consultation hostory -->


                    <!-- all its treatment history  -->
                    <?php 
                        if($previous_treat_number_res['pre_treat_number'] > 0){
                            include("includes/treatment_history.php");
                        } 
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

    <!-- modal for new treatment -->
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

    <div class="modal fade" id="start_treatatment" tabindex="-1"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Start New Treatment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <h5 class="modal-title" id="exampleModalLongTitle"><b>Start New Treatment</b></h5> -->
                <div class="modal-body pl-4">

                    <form method="post" onsubmit="return confirm('Are you sure you want to submit this treatment?');"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Treatment Name:</label>
                            <input type="text" name="short_name" class="form-control" id="exampleFormControlFile1"
                                required>
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Medicines : </label><br>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Medicine Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="medicine_0">
                                    <!-- Medicine rows are added Dynamically through javascript -->
                                </tbody>
                            </table>
                            <button type="button" onClick="addMedicine(0)" class="btn btn-primary btn-sm">Add Medicines</button>
                        </div>

                        <div class="form-group mt-4">
                            <label for="">Sessions : </label><br>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Session Name</th>
                                        <th scope="col">quantity (per month)</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="instrument_0">
                                    <!-- instruments rows are added Dynamically through javascript -->
                                </tbody>
                            </table>

                            <button type="button" onClick="addInstrument(0)" class="btn btn-primary btn-sm">Add
                                Instrument</button>
                        </div>

                        
                        
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="diet">Diet Plan</label>
                                    <input type="file" name="diet" class="form-control-file" id="diet">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="e-prescription">E-prescription</label>
                                    <input type="file" name="e-prescription" class="form-control-file" id="e-prescription">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Extra File</label>
                                    <input type="file" name="report" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label for="note">Extra Note</label>
                            <textarea class="form-control" placeholder="If nothing type 'NA'" id="note" name="note"
                                rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <label for="diet">Discount (In %) : </label>
                                    <input type="number" name="dicount" class="form-control" id="dicount" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <label for="diet">Courier Charges (In Rs.) : </label>
                                    <input type="number" name="courier" class="form-control" id="courier" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="start_treat" class="btn btn-success">start Treatment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for new treatment -->

    <!-- modal for anthropometry test -->
    <div class="modal fade  bd-example-modal-lg" id="start_test" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            <input type="file" name="report" class="form-control-file" id="exampleFormControlFile1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="diet">Diet Plan</label>
                            <input type="file" name="diet" class="form-control-file" id="diet" required>
                        </div>
                        <button type="submit" name="start_test" class="btn btn-primary">start Test</button>
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

    <!-- adding medicine column dynamicly -->
    <script src="js/add_medicine_dynamicly.js"></script>

    <!-- adding Instruments column dynamicly -->
    <script src="js/add_instruments_dynamicly.js"></script>

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
    if(isset($_POST['start_test'])){
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

                $test_id = md5(time().$user_id);

                $insert_test = "INSERT INTO `test_anthropometry`(`test_id`, `user_id`, `test_result`, `times`, `status`, `diet_plan`) 
                                VALUES ('$test_id','$user_id','$report_destination',1,'start','$diet_destination')";
                if($insert_test_run = mysqli_query($con, $insert_test)) {
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
    if(isset($_POST['start_treat'])){
        $diet = $_FILES['diet'];
        $report = $_FILES['report'];
        $e_prescription = $_FILES['e-prescription'];
        $extra_note = $_POST['note'];
        $short_name = $_POST['short_name'];
        $discount = (int)$_POST['dicount'];
        $courier = (int)$_POST['courier'];

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
                $query_medicine_insert = $query_medicine_insert."('" . $user_id ."','". $current_treat_no ."',1," . (int)$Idprice[0] . "," . (int)$prescribed_medi_quantity[$key] . "),";
                }
            }
            if($query_medicine_insert != ""){ // if doctor just added rows but didn't select any medicine then also do not run query
                $query_medicine_insert = substr($query_medicine_insert, 0, -1);

                $insert_medicines = "INSERT INTO `prescribed_medicine`(`user_id`, `treat_number`, `sub_treat_number`, `medicine_id`, `quantity`) 
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
                $query_instru_insert = $query_instru_insert."('" . $user_id ."','". $current_treat_no ."',1," . (int)$Idprice[0] . "," . (int)$prescribed_session_quantity[$key] . "),";
                }
            }
            if($query_instru_insert != ""){
                $query_instru_insert = substr($query_instru_insert, 0, -1);

                $insert_instru = "INSERT INTO `prescribed_session`(`user_id`, `treat_number`, `sub_treat_number`, `session_id`, `session_per_month`)
                                VALUES ". $query_instru_insert;
                $insert_instru_run = mysqli_query($con, $insert_instru);
                
            }
        }
        
        //print_r("INSERT INTO `prescribed_medicine`(`test_id`, `treat_number`, `medicine_id`, `quantity`) 
        //           VALUES ".$query_medicine_insert);


        //$total_price = $total_medi_cost + $total_session_cost;

        $diet_destination   = "";
        $report_destination ="";
        $prescription_destination ="";
        // if($diet != "" || $report != "" || $e_prescription != ""){
        if($diet != ""){
            $diet_original = $_FILES['diet']['name'];
            $diet_tmp_name = $_FILES['diet']['tmp_name'];
            $diet_error = $_FILES['diet']['error'];
            $diet_type = $_FILES['diet']['type'];

            $diet_ext_seprate = explode('.', $diet_original);
            $diet_ext = strtolower(end($diet_ext_seprate));

            if($diet_error === 0){
                $diet_new_name = uniqid('', true).".".$diet_ext;
                $diet_destination = "files/diet/".$diet_new_name;
                move_uploaded_file($diet_tmp_name, $diet_destination);
            }
        }

        if($report != ""){
            $report_original = $_FILES['report']['name'];
            $report_tmp_name = $_FILES['report']['tmp_name'];
            $report_error = $_FILES['report']['error'];
            $report_type = $_FILES['report']['type'];

            $report_ext_seprate = explode('.', $report_original);
            $report_ext = strtolower(end($report_ext_seprate));

            if($report_error === 0){
                $report_new_name = uniqid('', true).".".$report_ext;
                $report_destination = "files/report/".$report_new_name;
                move_uploaded_file($report_tmp_name, $report_destination);  
            }
        }

        if($e_prescription != ""){
            $prescription_original = $_FILES['e-prescription']['name'];
            $prescription_tmp_name = $_FILES['e-prescription']['tmp_name'];
            $prescription_error = $_FILES['e-prescription']['error'];
            $prescription_type = $_FILES['e-prescription']['type'];

            $prescription_ext_seprate = explode('.', $prescription_original);
            $prescription_ext = strtolower(end($prescription_ext_seprate));

            if($prescription_error === 0){
                $prescription_new_name = uniqid('', true).".".$prescription_ext;
                $prescription_destination = "files/prescription/".$prescription_new_name;
                move_uploaded_file($prescription_tmp_name, $prescription_destination);
            }
        }
            

            

            // $diet_ext_seprate = explode('.', $diet_original);
            // $report_ext_seprate = explode('.', $report_original);
            // $prescription_ext_seprate = explode('.', $prescription_original);

            // $diet_ext = strtolower(end($diet_ext_seprate));
            // $report_ext = strtolower(end($report_ext_seprate));
            // $prescription_ext = strtolower(end($prescription_ext_seprate));

            // if($diet_error === 0 && $report_error === 0 && $prescription_error === 0){
            //     $diet_new_name = uniqid('', true).".".$diet_ext;
            //     $report_new_name = uniqid('', true).".".$report_ext;
            //     $prescription_new_name = uniqid('', true).".".$prescription_ext;

            //     $diet_destination = "files/diet/".$diet_new_name;
            //     move_uploaded_file($diet_tmp_name, $diet_destination);

            //     $report_destination = "files/report/".$report_new_name;
            //     move_uploaded_file($report_tmp_name, $report_destination);

            //     $prescription_destination = "files/prescription/".$prescription_new_name;
            //     move_uploaded_file($prescription_tmp_name, $prescription_destination);


        // fetch bill number
        $last_bill_no = "SELECT max(`bill_number`) AS lastest FROM `bill_number`";
        $last_bill_no_run = mysqli_query($con, $last_bill_no);
        $last_bill_no_res = mysqli_fetch_assoc($last_bill_no_run);
        $lastest_bill = $last_bill_no_res['lastest'];

        $this_bill_no = $lastest_bill + 1;
        $insert_bill_no = "INSERT INTO `bill_number`(`bill_number`) VALUES ('$this_bill_no')";
        mysqli_query($con, $insert_bill_no);

        $insert_test ="INSERT INTO `treatment`(`user_id`, `treatment_for`, `treat_number`, `sub_treat_number`, `diet`, `report`, `extra_note`, `e_prescription`, `discount`, `courier_charge`, `bill_number`) 
                        VALUES ('$user_id','$short_name','$current_treat_no',1,'$diet_destination','$report_destination','$extra_note', '$prescription_destination', '$discount', '$courier', '$this_bill_no')";         



        if(mysqli_query($con, $insert_test)) {
            echo "<script>
                        alert('Treatment started sucessfully');
                        window.location.href='user_details.php?uid=$user_id';
                    </script>";
        }
            //else{
            //     echo "<script>alert('Error in uploading file Please try again after some time.');</script>";
            // }
     
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