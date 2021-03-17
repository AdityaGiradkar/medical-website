<?php 
session_start();
include('includes/db.php');
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}



?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Website icon -->
    <link rel="icon" href="images/AtmaVeda Logo.png" type="image/icon type">

    <link rel="stylesheet" href="css/index.css">

    <title>About US</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background-color:white!important;padding:1.3rem">
        <div class="container">
            <a class="navbar-brand ml-2" style="font-size:1.8rem" href="index.php">
                <img src="images/brand.png" width="220"  class="d-inline-block align-top" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="about.php" class="li-header nav-link mr-3">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="all_available_tratments.php" class="li-header nav-link mr-3">All Treatments</a>
                    </li>
                    <li class="nav-item">
                        <a data-target="#Appointment" data-toggle="modal" href="" class="li-header nav-link mr-3">Book Consultations</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-target="#select_test" data-toggle="modal" class="li-header nav-link mr-3">Take Test</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php#blogs" class=" nav-link li-header mr-3">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-target="#banner_covid" data-toggle="modal" class="li-header nav-link mr-3">Covid-19</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="li-header nav-link mr-3" disabled>Shop</a>
                    </li> -->
                    <?php if(!isset($_SESSION['user_id'])){ ?>
                    <li class="login-button">
                        <a href="login.php" class="li-header nav-link"><b>Login</b></a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                        <a href="<?php if($_SESSION['role'] == 'doctor'){?> admin/index.php <?php }else{ ?> user_page.php <?php } ?>" class="li-header nav-link ">User</a>
                    </li>
                    <?php } ?>
                </ul>
                
            </div>
        </div>
    </nav>


    <div class="container pt-5">
        <h4 class=" h2 text-center pt-4 pb-5"><b>ABOUT US</b></h2>
        <div class="row pb-4">
            <div class="col-md-4">
                <img src="images/AtmaVeda(334,273).png" width="300" class="img-fluid d-block mx-auto" />
            </div>
            <div class="col-md-8 align-self-center pl-5">

                <p>AtmaVeda Yog Pvt. Ltd. is a new start-up company dedicated and formed to serve &amp;
                    Promote affordable Healthcare, Innovation and Research based on the principles of
                    yoga. Its founder is Dr. Sadanand Shivram Rasal &amp; Mrs Shital Narendra dhole.</p>
                <p>Head office: 34/3, Santo Tukadoji Nagar, Rahatni, Pune.</p>
                <p>The company is dedicated for innovation called UEP, which means-</p>
                <ul>
                    <li>Utilization of knowledge from AtmaVeda and Yog</li>
                    <li>Expansion and</li>
                    <li>Promotion of AtmaVeda Yog through the form of yoga developed by Dr. Sadanand.</li>
                </ul>
                
            </div>
        </div>
        <p>
            Mission:
            <ol>
                <li>Make Yoga as a diagnostic and therapeutic tool to heal. Heal the incurable
                    diseases of mankind which do not have any definite answers in other systems
                    of medicines.
                </li>
                <li>Invents Diagnostic tools based on Yoga. #makeinindia</li>
                <li>Affordable Healthcare – through online clinics in Rural and far-reaching areas
                    of India to make Vision of Shree Narendra Modi’s #HealthcareForAll a true
                    reality.
                </li>
                <li>Promote Nature based Indian traditional art of therapy and develop
                    HealthCare and Criticare module of treatments which are completely safe.
                    Supporting the various initiatives of #Ayushministry
                </li>
                <li>Bring health care at home and make Criticare at home a reality. Making
                    healthcare affordable and also reducing the stress on Government and private
                    overworked healthcare infrastructure.
                </li>
                <li>Physical Health &amp; Fitness through Atmaveda yog. #MyLife,MyYoga #FitIndia</li>
                <li>Mental Health awareness, support and therapy. #Mentalhealthawareness</li>
                <li>Build sustainable Healthcare industry, education and research.#Atmanirbharbharat</li>
                <li>Education based on yogic life-sciences.</li>
                <li>Create job opportunities by skill based training #skillindia</li>
            </ol>
        </p>
        <p>
            Field of company work:-
            <ol>
                <li>Healthcare</li>
                <li>Diagnostic</li>
                <li>Infotech (health related)</li>
                <li>Medicine (homeopathic/herbal/ayurvedic/natural)</li>
                <li>Research</li>
                <li>Education</li>
                <li>Skill development</li>
                <li>Corporate workshop</li>
            </ol>
        </p>
        <p>
            Inspiration:
            <ol>
                <li>Shri. Narendra Modiji. PM India</li>
                <li>Late Shri Abdul Kalam ji, Former President of India</li>
                <li>Shri. Sharadchandra Pawar saheb. our beloved leader. Former CM Maha., President NCP</li>
            </ol>
        </p>
        <hr>

        <h3 class="text-center pt-5 pb-3 mb-3">ABOUT ME</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="images/about-page.png" width="300" class="img-fluid d-block mx-auto" />
                <h4 class="text-center mt-4">Dr. Sadanand Shivram Rasal</h4>
                <h6 class="text-center">BHMS (MCH), PGDMLT.</h6>
            </div>
            <div class="col-md-8 mt-3">
                <p>
                    Dr Sadanand Rasal is a BHMS graduate from Pune University. After years of General Practice and 
                    Running a Speciality Diagnostic Centre in Pimpri, Pune he became disciple of Yoga, Spirutuality 
                    and Holistic Medicine. Through a dedicated research work for nearly 10 years under his Gurus he 
                    developed extensive knowledge of cellular healing and reversal of cellular ageing.
                </p>
                <p>The Research work included -</p>
                <ol>
                    <li>Biochemical disease markers.</li>
                    <li>Immune markers.</li>
                    <li>Anthropometric analysis.</li>
                    <li>Chakra physiology.</li>
                    <li>Psycho somatic axis.</li>
                    <li>Somato-psychic axis.</li>
                    <li>Hormones as health indicators and disease markers.</li>
                    <li>Alternative approach in modern diagnostic tools and methods.</li>
                </ol>
                <p>
                    Using all of this knowledge and experience now along with his partners Dr Sadanand Rasal has 
                    founded Atma Veda Yog pvt limited. A company which strives to prevent transform and treat 
                    diseases with no answers.   
                </p>
                

            </div>
        </div>
        <hr>

        
        <h3 class="text-center pt-4 pb-3 mb-3">CHIRAYU - HAPPY LIFE</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="images/pie_chart.jpeg" width="300" class="img-fluid" >
            </div>
            <div class="col-md-4 pt-5">
                
                <h5 class="text-center">Happiness is a result of,<br> Liveliness & Love<br> Illness free life<br> fitness<br>Enlightened mind</h5>
            </div>
            
        </div>

        <h3 class="text-center pt-4 pb-3 mb-3">Healing Philosophy</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="images/flow.jpeg" width="400" class="img-fluid" >
            </div>
            <div class="col-1"></div>
            <div class="col-md-5 pt-5">
                <h5 class="text-center">Heal from within</h5>
                <p class="text-center">Diagnose cause of disease with help of inovative yog based diagnostic tools and then treat in the most natural way in accordance with the laes of nature with diet, exercise and medicine.</p>
            </div>
            
        </div>

        <hr>
        
        
        
            <h3 class=" pt-4 pb-3 mb-3">Pillars of company</h3>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mt-3 mb-3 pt-3 pb-2 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Health care division</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mt-3 mb-3 pt-3 pb-2 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Diagnostic division</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 ">
                    <div class="card mt-3 mb-3 pt-3 pb-2 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Research division</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mt-3 mb-3 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Education and institution</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mt-3 mb-3 pt-3 pb-2 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Infotech division</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mt-3 mb-3 pt-3 pb-2 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Corporate division</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card mt-3 mb-3 pillar-company" style="width: 15rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Community &amp; National service</h5>
                        </div>
                    </div>
                </div>
            </div>
        
        <h4 class=" h3 text-center mt-5 pb-4">Partner’s &amp; Associate’s</h4>
        <div style=" backgrund-color: rgb(249, 250, 255)">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-md-4">
                        <img src="images/madam.jpeg" class="d-block mx-auto" width="200" >
                    </div>
                    <div class="col-md-8 mt-5 pt-3">
                        <h4 class="tet-center">Mrs Shital Narendra Dhole</h4>
                        <h6 class="txt-center">Yog instructor and advanced yog expert.</h6>
                        <h6 class="ext-center">Beautician.</h6>
                        <p class="ext-center">Mrs. Shital Dhole a Young dynamic entrepreneur, She is also a Director of
                                                Atmavedayog pvt ltd. She is in-charge of the wellness programme and heads the
                                                Management and customer support.</p>
                                                CHATURVED HERBALS<br>

                                                JEEVIS HEALTH CARE

                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="bg-dark pt-4 pb-3" style="paddig:2%; margin-bottom:-24px;color:white;">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-md-4 mt-3 ">
                        <p class="text-center" style=" font-size:12px;color:#bfbfbf">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. All rights reserved &nbsp;<a target="blank" href="images/Privacy Policy.pdf">Privacy Policies</a></p>
                    </div>
                    <div class="col-md-4">
                        <img src="images/AtmaVeda(334,273).png" width="80" class="img-fluid  d-block mx-auto" >
                    </div>
                    <div class="col-md-4" style="font-family: 'Roboto', sans-serif;">
                        <p class="text-ceter d-inline-block" style=" font-size:13px; color:#bfbfbf">enquiry@atmavedayog.com &nbsp; &nbsp;|&nbsp; &nbsp; 
                            <ul class="list-unstyled text-center d-inline-block" style="font-size: 2em">
                                <li class="d-inline"><a target="_blank" href="https://www.facebook.com/drsadanand.ke.yodhas/"><i class="fab fa-facebook-square fa-2x facebook"></i></a></li>
                                <li class="d-inline pl-3"><a target="_blank" href="https://www.instagram.com/drsadanand.atmavedayog"><i class="fab fa-instagram fa-2x instagram"></i></a></li>
                                <li class="d-inline pl-3"><a target="_blank" href="https://twitter.com/ForSadanand?s=09"><i class="fab fa-twitter-square fa-2x tweter"></i></a></li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>



    <!-- Modal for appointment -->
    <?php 
        $minAvailableDate = "SELECT MAX(`date`) AS maxDate FROM `consultation_time` WHERE `assigned_user`=0";
        $minAvailableDate_run = mysqli_query($con, $minAvailableDate);
        $maxDate = mysqli_fetch_assoc($minAvailableDate_run);
        // echo "Maximum date = ".$maxDate['maxDate'];
    ?>
    <div class="modal fade" id="Appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title brand-name" id="exampleModalLongTitle">BOOK AN APPOINTMENT</h5>
                </div>
                <?php 
                    $consultations = "SELECT * FROM `consult_type`";
                    $consultations_run = mysqli_query($con, $consultations);                    
                ?>
                <div class="modal-body">
                    <!-- <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p> -->
                    <form method="post" action="">
                    <?php
                    $count = 1;
                        while($consultations_res = mysqli_fetch_assoc($consultations_run)){
                            if($consultations_res['id'] <= 3){
                    ?>
                        <div class="form-check pt-2 pb-3">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type<?php echo $count; ?>"
                                value="<?php echo $consultations_res['id']; ?>" required>
                            <label class="form-check-label" for="consult_type<?php echo $count; ?>">
                                <?php echo $consultations_res['name']; ?>
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true"
                                title="<?php echo $consultations_res['name']; ?>" data-content="<?php echo $consultations_res['consult_info']; ?>"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                    <?php 
                        $count++;
                            }
                        }
                    ?>
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date"
                                onchange="availableSlots(this.value, 1)" id="datepicker" min="<?php echo date("Y-m-d"); ?>"
                                max="<?php echo $maxDate['maxDate']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots1" name="time_slots" required>
                                <!-- data will be fetched in real time by using AJAX -->
                            </select>
                        </div>

                        <button type="submit" class="login-btn mt-5" style="color:white;font-size: 18px;"
                            name="appoint">Book an
                            Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for appointment -->

    <!-- Modal for Covid appointment -->
    <div class="modal fade" id="Covid_Appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title brand-name" id="exampleModalLongTitle">BOOK AN APPOINTMENT</h5>
                </div>
                <?php 
                    $consultations = "SELECT * FROM `consult_type`";
                    $consultations_run = mysqli_query($con, $consultations);                    
                ?>
                <div class="modal-body">
                    <!-- <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p> -->
                    <form method="post" action="">
                    <?php
                        $count = 4;
                        while($consultations_res = mysqli_fetch_assoc($consultations_run)){
                            if($consultations_res['id'] > 3 && $consultations_res['id'] < 7){
                    ?>
                        <div class="form-check pt-2 pb-3">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type<?php echo $count; ?>"
                                value="<?php echo $consultations_res['id']; ?>" required>
                            <label class="form-check-label" for="consult_type<?php echo $count; ?>">
                                <?php echo $consultations_res['name']; ?>
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true"
                                title="<?php echo $consultations_res['name']; ?>" data-content="<?php echo $consultations_res['consult_info']; ?>"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                    <?php 
                        $count++;
                            }
                        }
                    ?>
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date"
                                onchange="availableSlots(this.value, 2)" id="datepicker" min="<?php echo date("Y-m-d"); ?>"
                                max="<?php echo $maxDate['maxDate']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots2" name="time_slots" required>
                                <!-- data will be fetched in real time by using AJAX -->
                            </select>
                        </div>

                        <button type="submit" class="login-btn mt-5" style="color:white;font-size: 18px;"
                            name="appoint">Book an
                            Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


        <!-- modal for test selection -->
    <?php 
        $get_test = "SELECT * FROM `test_type`";
        $get_test_run = mysqli_query($con, $get_test);

    ?>
    <div class="modal fade" id="select_test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="container pb-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="card-title mx-auto brand-name">SELECT TEST<br>
                    <small style="font-size:15px;">( Test's Invented & Developed by Dr Sadanand Rasal)</small>
                    </p>
                </div>
                
                <div class="modal-body">
                    <form method="post" id="myform" action="">
                        <?php 
                            while($get_test_res = mysqli_fetch_assoc($get_test_run)){

                        ?>
                        <div class="form-check pt-3">
                            <input class="form-check-input" type="radio" name="test_type" id="test_type<?php echo $get_test_res['test_id']; ?>" value="<?php echo $get_test_res['test_id']; ?>" required>
                            <label class="form-check-label" for="test_type<?php echo $get_test_res['test_id']; ?>"><?php echo $get_test_res['test_name']; ?></label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="<?php echo $get_test_res['test_name']; ?>" data-content="<?php echo $get_test_res['test_info']; ?>"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <?php 
                        
                            }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="login-btn mt-4" form="myform" style="color:white;font-size: 18px;"
                        name="start_test">START TEST</button>
                </div> 
            </div>
        </div>
    </div>
    <!-- modal for test selection -->

    <div class="modal fade bd-example-modal-lg info-modal" id="banner_covid" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLongTitle">COVID-19</h5>

                </div>
                <div class="modal-body">
                    <!-- content here -->
                    <p>Corona virus has rocked the whole world. With No vaccine and the high cost of treatment and dangerous effects of COVID19 ,it is a worrying situation. Atmaveda Yog Pvt Ltd offers a complete solution for managing COVID19 situation.</p>
                    <ol>
                        <li><b>YOG-E @Rakshakavach test: </b>Does your Assessment of Immunity rakshakavach and dosha analysis with COVID risk possibility. Early diagnosis, earliest risk assessment, real-time health analysis.</li>
                        <li><b>HomeCare@KaroNa: </b>Treatment of COVID19 cases at home through now made possible with the help of our AI based tools. Daily surveillance, monitoring and screening of patients/persons is possible through our web-based app. Through our YOG- E Clinic support, medical care can be availed at your home.</li>
                        <li><b>CritiCare@GharPe KaroNa: </b>Treatment of COVID19 critical care patients at home and day care centres in emergencies is possible through Our Yog-E clinic. Now avail at home- support, advice and guided management, as good as hospitalization.</li>
                        <li><b>Yog-E @PostCovid Health: </b>Treatment programmes for Post-COVID19 management is also offered through. We diagnose, treat and prevent Post-COVID complication and health issues.</li>
                    </ol>
                </div>
                <button type="submit" class="login-btn mt-4 info-modal-btn_covid" style="color:white;font-size: 18px;">BOOK AN
                    APPOINTMNET</button>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php 

if(isset($_SESSION['user_id'])){
    //check for user have filled the details or not
    $check_detailes_fieled = "SELECT  `problems` FROM `medical_history` WHERE `user_id`='$user_id'";
    $check_detailes_fieled_run = mysqli_query($con, $check_detailes_fieled);
    $check_detailes_fieled_res = mysqli_fetch_assoc($check_detailes_fieled_run);
}

    //php for booking appointment
    if(isset($_POST['appoint'])){
        if(isset($_SESSION['user_id'])){
            $consult_type = $_POST['consult_type'];
            $date = $_POST['consult_date'];
            $time = $_POST['time_slots'];

            //check for user have filled the details or not
            if($check_detailes_fieled_res['problems'] == ""){
                echo "<script>
                        alert('Please first Fill the details.');
                        window.location.href='update_details.php';
                    </script>";
            }

            echo "<script>
                    window.location.href='payment/consultation_payment.php?type=$consult_type&date=$date&time=$time';
            </script>";
        } else {
            echo "<script>
                alert('Please login first.');
                window.location.href='login.php';
            </script>";
        }
    }

    // Php for taking test
    if(isset($_POST['start_test'])){
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


<script>

    // for popover
    $('[data-toggle="popover"]').popover();

    $('body').on('click', '.info-modal-btn_covid', function() {
        $('.info-modal').modal('hide');
        $('#Covid_Appointment').modal('show');
    });

    function availableSlots(date, id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var slots_array = JSON.parse(this.responseText);
               // var htmlSlotsOption = "<option selected='selected' disabled='disabled' hidden>Select Time</option>";
                var htmlSlotsOption ="";
                slots_array.forEach(add);

                function add(item, index) {
                    htmlSlotsOption = htmlSlotsOption + "<option value='" + item.time_range + "'>" + item
                        .time_range + "</option>";
                }
                document.getElementById("time_slots"+id).innerHTML = htmlSlotsOption;

                // console.log(slots_array);
            }
        };
        xmlhttp.open("GET", "includes/getSlots.php?date=" + date, true);
        xmlhttp.send();
    }

</script>