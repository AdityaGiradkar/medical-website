<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
      
      if($_SESSION['role'] == 'doctor'){

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

  <!-- Website icon -->
  <link rel="icon" href="../images/AtmaVeda Logo.png" type="image/icon type">

  <title>Add Blog</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

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
        Consultation
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user-injured"></i>
          <span>Patients <?php if($data['total'] > 0){ ?><sup><i class="fas fa-circle" style="font-size: .75em !important;"></i></sup><?php } ?></span>
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
                  <h6 class="collapse-header">Sessions:</h6>
                  <a class="collapse-item" href="all_sessions.php">All Sessions</a>
                  <a class="collapse-item" href="add_session.php">Add Session</a>
              </div>
          </div>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseBlogs" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-pills"></i>
          <span>Blogs & Videos</span>
        </a>
        <div id="collapseBlogs" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Blogs & Videos:</h6>
            <a class="collapse-item" href="blogs_table.php">All Blogs & Videos</a>
            <a class="collapse-item active" href="add_blogs.php">Add Blog & Video</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReview" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-pills"></i>
          <span>User Reviews</span>
        </a>
        <div id="collapseReview" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reviews:</h6>
            <a class="collapse-item" href="all_reviews.php">All Reviews</a>
            <a class="collapse-item" href="add_review.php">Add Review</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="all_images.php">
          <i class="fas fa-images"></i>
          <span>Website Images</span></a>
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
          <button id="sidebarToggleTop" onclick="sidebar()" class="btn btn-link d-md-none rounded-circle mr-3">
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
                <a class="dropdown-item" target="_blank" href="https://dashboard.razorpay.com/#/access/signin">
                  <!-- <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> -->
                  <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>
                  RazorPay 
                </a>
                <a class="dropdown-item" target="_blank" href="invoices.php">
                    <i class="fas fa-receipt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Invoice 
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

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Blogs / Videos</h1>


          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="blog_name">Blog / Video Name</label>
              <input type="text" class="form-control" id="blog_name" name="blog_name" aria-describedby="emailHelp"
                required>
            </div>
            <div class="row pt-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="blog_link">Blog / video Link</label>
                  <textarea class="form-control" id="blog_link" name="blog_link" rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="discription">Small Discription</label>
                  <textarea class="form-control" id="discription" name="discription" rows="3"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <label for="cover_image">Select Best Cover Image</label>
              <input type="file" class="form-control-file" id="cover_image" name="cover_image">
            </div>
            <button type="submit" name="add_blog" class="btn btn-primary mt-3">Add Blog</button>
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

      function compressImage($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') 
          $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif') 
          $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png') 
          $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
      }

      if(isset($_POST['add_blog'])){
          $blog_name = mysqli_real_escape_string($con, $_POST['blog_name']);
          $blog_link = mysqli_real_escape_string($con, $_POST['blog_link']);
          $discription = mysqli_real_escape_string($con, $_POST['discription']);
          $file = $_FILES['cover_image'];
          
          $file_original = $_FILES['cover_image']['name'];
          $file_tmp_name = $_FILES['cover_image']['tmp_name'];
          $file_size = $_FILES['cover_image']['size'];
          $file_error = $_FILES['cover_image']['error'];
          $file_type = $_FILES['cover_image']['type'];

          $file_ext_seprate = explode('.', $file_original);
        
          $file_ext = strtolower(end($file_ext_seprate));

          //echo $file_ext;
          //echo "<script>alert('$file_error');</script>";
          $valid_ext = array('jpg', 'jpeg', 'png');

          if(in_array($file_ext, $valid_ext)){
              if($file_error === 0){
                  $file_new_name = uniqid('', true).".".$file_ext;
                  $file_destination = "img/blog_images/".$file_new_name;

                  $compressed_image = compressImage($file_tmp_name, $file_destination, 50);

                  // move_uploaded_file($file_tmp_name, $file_destination);

                  $update = "INSERT INTO `blogs`(`blog_name`, `blog_link`, `cover_img`, `small_description`) VALUES ('$blog_name', '$blog_link', '$file_new_name', '$discription')";
                  if($update_run = mysqli_query($con, $update)) {
                      echo "<script>
                                  alert('update Sucessfull');
                                  window.location.href='blogs_table.php';
                              </script>";
                  }
              }else{
                  echo "<script>alert('Error in uploading file Please try again after some time.');</script>";
              }
          }else{
              echo "<script>alert('please upload file in either of specified format only.');</script>";
          }
          
      }

    }else{   //check if user is docor or not
      echo "<script>
            alert('Invalid Access');
            window.location.href='../index.php';
          </script>";
    }
    
  }else{
    //else part if session is not set
    echo "<script>
            window.location.href='../error/login_error.html';
          </script>";
  }


?>