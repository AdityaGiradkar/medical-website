<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] == 'doctor'){
      
            $user_id = $_GET['uid'];

            $user_info = "SELECT *, TIMESTAMPDIFF(YEAR, `dob`, CURDATE()) AS age FROM `user` WHERE `user_id`='$user_id'";
            $user_info_run = mysqli_query($con, $user_info);
            $user_detail = mysqli_fetch_assoc($user_info_run);

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
                  <a class="collapse-item active" href="test_submissions.php">New Test Submissions</a>
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
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSessions" aria-expanded="true"
              aria-controls="collapseTwo">
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
            <?php 
                $submitted_antropometry = "SELECT * FROM `test_payments` WHERE `user_id`='$user_id' AND `test_type`='4' AND `test_id` IS NOT NULL";
                $submitted_antropometry_run = mysqli_query($con, $submitted_antropometry);
                $submitted_antropometry_run2 = mysqli_query($con, $submitted_antropometry);
                
                //print_r($submitted_antropometry_run2);
            ?>
                
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="test1"><strong>Antropometry Test 1</strong></label>
                            <select id="test1" name="test1" class="form-control" required>
                                <option selected disabled hidden value="">Choose...</option>
                                <?php
                                    while($submitted_antropometry_res = mysqli_fetch_assoc($submitted_antropometry_run)) {
                                ?>
                                <option value="<?php echo $submitted_antropometry_res['test_id']; ?>,<?php echo date("d-m-Y h:ia", strtotime($submitted_antropometry_res['created_at'])); ?>"><?php echo date("d-m-Y h:ia", strtotime($submitted_antropometry_res['created_at'])); ?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="test2"><strong>Antropometry Test 2</strong></label>
                            <select id="test2" name="test2" class="form-control" required>
                                <option selected disabled hidden value="">Choose...</option>
                                <?php
                                    while($submitted_antropometry_res = mysqli_fetch_assoc($submitted_antropometry_run2)) {
                                ?>
                                <option value="<?php echo $submitted_antropometry_res['test_id']; ?>,<?php echo date("d-m-Y h:ia", strtotime($submitted_antropometry_res['created_at'])); ?>"><?php echo date("d-m-Y h:ia", strtotime($submitted_antropometry_res['created_at'])); ?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button onClick="compare()" name="submit_test" class="btn btn-primary d-flex mt-4">Compare Test</button>
                        </div>
                    </div>
                
            
          </div>
          <!-- person info ends  -->


          <!-- CREATE TABLE OF test details  -->

          <!-- <input type="button" id="print" class="btn btn-sm mt-3 btn-primary d-flex ml-auto"  value="print Report" /> -->
<!-- //onclick="$('#printableArea').print();" -->
          <div class="border border-primary  rounded-lg mt-4 p-3" id="complete_report" style="background-color:white; display:none;">
            <!-- printable Area -->
            <div id="printableArea">
              <div class="header">
                <img src="../images/brand.png"  width="250">
                <hr style="height:1px; background-color:#50A6C2">
              </div>

              <div class="user_details  mr-3 ml-4">
                <div class="row">
                    <div class="col-6">
                        <p>Name : <strong><?php echo $user_detail['name']; ?></strong></p>
                        <p>Today's Date : <strong><?php echo date("d-m-Y h:ia"); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Current Age : <strong><?php echo $user_detail['age']; ?> Yrs.</strong></p>
                        <p>Sex : <strong><?php echo $user_detail['gender']; ?></strong></p>
                    </div>
                </div>
                <p >Test Name : <strong>Comparision of YOG-E @HomeCare Daily Test</strong></p>
                
              </div>
              <hr style="height:3px; background-color:#50A6C2">
              <br>
            
              <canvas id="myChart"></canvas>
              

              <h5><b>Notations :-</b></h5>
              <div class="row">
                <div class="col-6">
                    <p>
                        <b>para1</b>  - Weight in Kg<br>
                        <b>para2</b>  - Height in cm.<br>
                        <b>para3</b>  - Chest in cm.<br>
                        <b>para4</b>  - Neck circumference in cm.<br>
                        <b>para5</b>  - Abdominal girth above navel/umbilicus in cm<br>
                        <b>para6</b>  - Abdominal girth at level of umbilicus /navel in cm<br>
                        <b>para7</b>  - Abdominal girth below level of navel/umbilicus in cm<br>
                        <b>para8</b>  - Waist in cm<br>
                        <b>para9</b>  - Hip measurement where buttock is the largest in cm<br>
                        <b>para10</b> - Thigh measurement where it is the largest in cm<br>
                        <b>para11</b> - Calf measurement where it is the largest in cm<br>
                        <b>para12</b> - Arm measurement where it is the largest in cm<br>
                        <b>para13</b> - Forearm measurement where it is the largest in cm<br>
                        <b>para14</b> - Wrist circumference in cm<br>
                        <b>para15</b> - Abdominal skin fold by skin fold meter [anterior upper]<br>
                        <b>para16</b> - Abdominal skin fold by skin fold meter [anterior middle]<br>
                        <b>para17</b> - Abdominal skin fold by skin fold meter [anterior lower]
                    </p>
                </div>
                <div class="col-6">
                    <p>
                        <b>para18</b> - Abdominal skin fold by skin fold meter [lateral upper]<br>
                        <b>para19</b> - Abdominal skin fold by skin fold meter [lateral middle]<br>
                        <b>para20</b> - Abdominal skin fold by skin fold meter [lateral lower]<br>
                        <b>para21</b> - Abdominal skin fold by skin fold meter [suprailiac]<br>
                        <b>para22</b> - Skin fold of arms and forearm [biceps]<br>
                        <b>para23</b> - Skin fold of arms and forearm [triceps]<br>
                        <b>para24</b> - Skin fold of arms and forearm [forearm]<br>
                        <b>para25</b> - Skin fold upper back [subscapular middle]<br>
                        <b>para26</b> - Skin fold upper back [subscapular lower]<br>
                        <b>para27</b> - Skin fold upper back [nape of neck]<br>
                        <b>para28</b> - Skin fold thighs [lateral thigh]<br>
                        <b>para29</b> - Skin fold thighs [anterior thigh]<br>
                        <b>para30</b> - Skin fold neck [neck skin fold]<br>
                        <b>para31</b> - Skin fold neck [double chin]<br>
                        <b>para32</b> - Skin fold neck [double neck]<br>
                        <b>para33</b> - Skin fold face [cheek bone]<br>
                        <b>para34</b> - Skin fold face [cheek]
                    </p>
                </div>
              </div>
            
              

              <hr>
              <div style="margin-left:65%;">
                <img src="../images/sign.png" width="200" class="d-block mx-auto">
                <h5 class="text-center text-muted mt-3"><b>Dr. Sadanand Rasal</b></h5>
              </div>
              <br>

              <div class="footer" style="background-color:#50A6C2; color:white">
                <div class="row pl-4 pr-4 pt-3 pb-3">
                    <div class="col-4"><i class="fas fa-envelope"></i> &nbsp;drsadanand@atmavedayog.com</div>
                    <div class="col-4"><i class="fas fa-phone-alt"></i> &nbsp;8208537972</div>
                    <div class="col-4"><i class="fas fa-globe"></i> &nbsp;www.atmavedayog.com</div>
                    <div class="col-12 mt-3"><i class="fas fa-map-marker-alt"></i> &nbsp;Sant Tukdoji Nagar, Rahatani, Pune - 411017</div>
                </div>
              </div>
              <!-- printable Area -->
            </div>
          </div>
          <!-- CREATE TABLE OF test details  -->

          

          
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Chart cdn -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</body>

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

</html>

<script>
    
    // $('#print').on('click', function() {
    //     var canvas = document.querySelector("#myChart");
    //     var canvas_img = canvas.toDataURL("image/png",1.0); //JPEG will not match background color
    //     var pdf = new jsPDF('landscape','in', 'letter'); //orientation, units, page size
    //     pdf.addImage(canvas_img, 'png', .5, 1.75, 10, 5); //image, type, padding left, padding top, width, height
    //     pdf.autoPrint(); //print window automatically opened with pdf
    //     var blob = pdf.output("bloburl");
    //     window.open(blob);
    // });
    // $.fn.extend({
    //     print: function() {
    //         var frameName = 'printIframe';
    //         var doc = window.frames[frameName];
    //         if (!doc) {
    //             $('<iframe>').hide().attr('name', frameName).appendTo(document.body);
    //             doc = window.frames[frameName];
    //         }
    //         doc.document.body.innerHTML = this.html();
    //         doc.window.print();
    //         return this;
    //     }
    // });
    //   function printDiv(divName) {
    //       var printContents = document.getElementById(divName).innerHTML;
    //       var originalContents = document.body.innerHTML;
    //       document.body.innerHTML = printContents;
    //       window.print();
    //       document.body.innerHTML = originalContents;
    //   }
  </script>

<script>
                function compare(){
                    let test1_id = document.getElementById("test1").value.split(",");
                    let test2_id = document.getElementById("test2").value.split(",");
                    //console.log(test1_id);

                    if(test1_id == "" || test2_id == ""){
                        alert("please select which test to compare.");
                    }else if(test1_id[0] == test2_id[0]){
                        alert("please select different tests to compare.");
                    }else{
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                var test_data = JSON.parse(this.responseText);
                                console.log(test_data);
                                labels_array = Array();
                                data_array1 = Array();
                                data_array2 = Array();
                                for(i=1; i<=34; i++){
                                    labels_array[i-1] = "para" + i;
                                    data_array1[i-1] = test_data[0][labels_array[i-1]]/100;
                                    data_array2[i-1] = test_data[1][labels_array[i-1]]/100;
                                }
                                //console.log(labels_array);
                                // console.log(data_array1);
                                // console.log(data_array2);

                                var ctx = document.getElementById('myChart').getContext('2d');
                                var chart = new Chart(ctx, {
                                    // The type of chart we want to create
                                    type: 'line',

                                    // The data for our dataset
                                    data: {
                                        labels: labels_array,
                                        datasets: [{
                                            label: test1_id[1],
                                            //backgroundColor: 'rgb(255, 99, 132)',
                                            borderColor: 'rgb(255, 99, 132)',
                                            data: data_array1
                                        },
                                        {
                                            label: test2_id[1],
                                            //backgroundColor: 'rgb(255, 99, 132)',
                                            borderColor: 'rgb(155, 199, 32)',
                                            data: data_array2
                                        }]
                                    },

                                    // Configuration options go here
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: true,
                                            text: 'Antropometry Test Comparison Representation'
                                        },
                                        tooltips: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                        hover: {
                                            mode: 'nearest',
                                            intersect: true
                                        },
                                        scales: {
                                            xAxes: [{
                                                display: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Parameters'
                                                }
                                            }],
                                            yAxes: [{
                                                display: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Value'
                                                },
                                                ticks: {
                                                    min: 0,
                                                    max: 300,

                                                    // forces step size to be 5 units
                                                    stepSize: 10
                                                }
                                            }]
                                        }
                                    }
                                });
                                // console.log(chart);
                                // chart.render();
 
                                // document.getElementById("print").addEventListener("click",function(){
                                //     chart.exportChart({format: "png"});
                                // });  	
                                
                                
                            }
                        };
                        xmlhttp.open("GET", "../includes/getTestData.php?test1=" + test1_id[0] + "&test2=" + test2_id[0], true);
                        xmlhttp.send();
                        document.getElementById("complete_report").style.display = "block";
                    }
                    
                }
            </script>


<?php 
    }else{//else if user is not doctor
        echo "<script>
                  window.location.href='../index.php';
                </script>";
      }

      
    }else{
      //else part if session is not set
      echo "<script>
              window.location.href='error/login_error.html';
            </script>";
    }
?>



    

    

    
