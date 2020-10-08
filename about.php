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
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/index.css">

    <title>About US</title>
</head>

<body>

    <!-- <nav class="navbar navbar-expand-lg sticky-top shadow" style="background-color:white!important;padding:1.3rem">
        <a class="navbar-brand ml-5" style="font-size:1.8rem" href="index.php">
            <img src="images/brand.png" width="250" class="d-inline-block align-top" alt="" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a href="index.php#about" class="li-header nav-link mr-4">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a href="index.php#consult" class="li-header nav-link mr-4">COUNSELLING</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="li-header nav-link mr-4">SHOP</a>
                </li>
                <li class="nav-item">
                    <a href="index.php#blogs" class=" nav-link li-header mr-4">BLOG</a>
                </li>
                <li class="nav-item">
                    <a data-target="#Appointment" data-toggle="modal" href="" class="li-header nav-link mr-4">BOOK AN
                        APOINTMENT</a>
                </li>
                <?php if(!isset($_SESSION['user_id'])){ ?>
                <li class="nav-item">
                    <a href="login.php" class="li-header nav-link mr-4">LOGIN</a>
                </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a href="<?php if($_SESSION['role'] == 'doctor'){?> admin/index.php <?php }else{ ?> user_page.php <?php } ?>"
                        class="li-header nav-link mr-4">USER</a>
                </li>
                <?php } ?>
            </ul>

        </div>
    </nav> -->


    <nav class="navbar navbar-expand-lg sticky-top shadow" style="background-color:white!important;padding:1.3rem">
        <div class="container">
            <a class="navbar-brand ml-2" style="font-size:1.8rem" href="index.php">
                <img src="images/brand.png" width="250"  class="d-inline-block align-top" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="index.php#about" class="li-header nav-link mr-3">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php#consult" class="li-header nav-link mr-3">Consultations</a>
                    </li>
                    <li class="nav-item">
                        <a data-target="#Appointment" data-toggle="modal" href="" class="li-header nav-link mr-3">Book Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" data-target="#select_test" data-toggle="modal" class="li-header nav-link mr-3">Take Test</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php#blogs" class=" nav-link li-header mr-3">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-target="#banner_covid" data-toggle="modal" class="li-header nav-link mr-3">Covid-19</a>
                    </li>
                    <?php if(!isset($_SESSION['user_id'])){ ?>
                    <li class="nav-item">
                        <a href="login.php" class="li-header nav-link">Login</a>
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

                <p><b>AtmaVeda Yog pvt. ltd</b> is a new startup company dedicated and formed on the principles of yoga.
                    It's
                    founder is
                    Dr Sadanand Shivram Rasal . It's partners are Mrs Shital Narendra dhole.</p>
                <p>Head office is in Pune at one of the prime location closer to Hinjewadi.</p>
                <p>The company is dedicated for innovation called UEP, which means-</p>
                <ul>
                    <li>Utilization of knowledge from Atma ,Veda and Yog</li>
                    <li>Expansion and</li>
                    <li>Promotion of atmavedayog through the form of yoga developed by Dr. Sadanand.</li>
                </ul>
                <p>Mission is use yoga as a diagnostic and therapeutic tool to heal . Heal the incurable diseases of
                    mankind which do not have and definite answers in other systems of medicines</p>


                <p>
                    AtmaVeda Yog Pvt limited has innovative activities, one of its kind around the globe which.
                </p>
                <ul>
                    <li>Invents diagnostic tools based on yoga.</li>
                    <li>Runs clinics for chronic and critical management</li>
                    <li>plans and supports hospitals to treat illnesses ,conducts research in yoga and medicine, trains doctors
                        and students in AtmaVeda Yog.</li>
                    <li>Physical Health & Fitness</li>
                    <li>Mental Health & Raising Capabilities</li>
                    <li>Conquering Chronic Medical Illness</li>
                    <li>Yoga as Definite Scientific Solution to individual, social,community and corporates.</li>

                </ul>
            </div>
        </div>
        <hr>

        <h3 class="text-center pt-5 pb-3 mb-3">ABOUT ME</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="images/doctor.png" width="300" class="img-fluid d-block mx-auto" />
                <h4 class="text-center mt-4">Dr. Sadanand Shivram Rasal</h4>
                <h6 class="text-center">BHMS (MCH), PGDMLT.</h6>
            </div>
            <div class="col-md-8 mt-3">
            <ul>
                    <li><b>In 1996-</b> Graduated from Pune university with degree in BHMS.</li>
                    <li><b>In 1996-</b> General Practice Pimpri.</li> 
                    <li><b>In 1998-</b> Nursing home registered with the government agency as “Shree Ganesh Polyclinic”</li>
                    <li><b>In 2000-</b> Maternity and surgical hospital with intensive care services.</li>
                    <li><b>In 2000-</b> PGDMLT from MTBTC Centre.</li>
                    <li><b>In 2002-</b> Specialty diagnostic centre “Shree Ganesh Diagnostic Centre”. Under one roof, this diagnostic centre provided following services:</li> 
                    <ul type="circle">
                        <li>Super-specialty lab: equipped with automated biochemistry analyzers. ELISA machines, ABG analyzers, microbiology work etc.</li>
                        <li>Ultra sonography, 2D-echo, X-ray, Fluoroscopy</li>
                    </ul>
                    <li><b>In 2005/6</b> met my master Shri Janglidas Maharaj in Shirdi accidently. I was fascinated and impressed by him. To know him I started following him. This was the time I was attracted to spirituality. I became his disciple, and took Sannyasa. Learned ATMAYOG from him by his method of ATMA sadhana.</li>
                    <li><b>In 2007</b> met my second master Parampujya Shri Hasmukhmuni Maharaj, Ankai. Learnt the art bridge between spirituality and material world.</li>
                    <li><b>In 2008</b> met my third master Devrishi Maharishi shri Agastey rishi through Shri Lal Baba Ankai. It is here that the knowledge of veda, Atma, yog, body, functional and life was bestowed on me by maharishimuni’s  blessing. living in the caves the research of food, body ad healing was done.</li>
                    <li>Till day today I am following my master. Following there each and every step, advice and lifestyle.</li>

                    <b>Only those associated and those that are my patient know my capabilities.</b>
                </ul>
            </div>
            <div class="mt-5">
                

 
                <p><b>In year 2009,</b> I began my research, self funded though about,</p>
                <ol>
                    <li>Reversal of cellular aging</li>
                    <li>Reversal of organ injury</li>
                    <li>Non medicinal approach to those chronic diseases that are limitations to present day medicines.</li>
                </ol>

                <p>It was during this period that my brother Mr. Satish Shivram Rasal (Director of Jeevis Health Solutions PVT. LTD.) developed a tool for Health and organ analysis know as JEEVIS NON-INVASIVE SCAN.  This was a tool that redefined my knowledge of medicine and also the scope of my research.</p>
                <p>I extensively worked in this period of research with,</p>
                <ol>
                    <li>Biochemical disease markers.</li>
                    <li>Immune markers.</li>
                    <li>Anthropometric analysis.</li>
                    <li>Chakra physiology.</li>
                    <li>Psycho somatic axis.</li>
                    <li>Somato-psychic axis.</li>
                    <li>Hormones as health indicators and disease markers.</li>
                    <li>Limitations of modern diagnostic tools and methods.</li>
                </ol>
                <p>
                    After completing my research, though the retrospective research is still a ongoing process, I started my work in Rural area of ratnagiri in year 2013/14. As it was the order of my master to do the work as SEVA.
                </p>
                <p>I still continue my work in the rural clinic there.</p>

                <br>
                <p><b>My scope of work :-</b></p>
                <ol>
                    <li>Autoimmune joint and spine disorders</li>
                    <li>Crippling OA of knee joint ( those cases were knee replacement is the only option )</li>
                    <li>Uncontrolled Insuin dependent diabetes mellitus</li>
                    <li>Diabetes mellitus with complication</li>
                    <li>Congestive cardiac failures</li>
                    <li>Valvular diseases of heart</li>
                    <li>Non accidental surgical diseases of  joints</li>
                    <li>Idiopathic diseases</li>
                    <li>Hormonal Chronic obstructive pulmonary diseasesabnormalities in men and women</li>
                    <li>Failure to thrive</li>
                    <li>Chronic obstructive pulmonary diseases</li>
                    <li>Genetic diseases</li>
                    <li>Abdominal chornic ailments</li>
                    <li>Chronic fatigue syndrome</li>
                    <li>Dysmorphic features in MPS</li>
                    <li>Thromboembolism.</li>
                    <li>Chronic kidney disease</li>
                    <li>Chronic affections of colons and alimentary tract.</li>
                    <li>And many other conditions.</li>
                    <li>Infertility /PCOD / Menopausal syndrome.</li>
                </ol>
                <br>
                <p><b>Note: </b>Other than above conditions every conditions were the medicine field stops , my scope begins.</p>
                <br><br>
                <h4>So in short, “Where all stop, I begin”</h4>
            <br>
            </div>
        </div>
        <hr>
        <h4 class=" h3 text-center mt-5 pb-4">Partners</h4>
        <div style=" backgrund-color: rgb(249, 250, 255)">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-md-4">
                        <img src="images/madam.jpeg" class="d-block mx-auto" width="200" >
                    </div>
                    <div class="col-md-8 mt-5 pt-5">
                        <h4 class="tet-center">Mrs Shital Narendra Dhole</h4>
                        <h6 class="txt-center">Yog instructor and advanced yog expert.</h6>
                        <h6 class="ext-center">Beautician.</h6>
                        <p class="ext-center">Mrs. Shital Dhole a Young dynamic entrepreneur, she is also a Director  of Atmavedayog pvt ltd.</p>
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
                </div>
                <?php 
                    $consultations = "SELECT * FROM `consult_type`";
                    $consultations_run = mysqli_query($con, $consultations);

                ?>
                <div class="modal-body">
                    <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p>
                    <form method="post" action="">
                        <?php
                        $count = 1;
                            while($consultations_res = mysqli_fetch_assoc($consultations_run)){
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
                        ?>
                        <!-- <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type2"
                                value="2">
                            <label class="form-check-label" for="consult_type2">
                                Holistic Pre-program Counselling
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="Holistic Pre-program Counselling"
                                data-content="want to know about our treatment? , want to know your decision to choose is right?. want to discuss your health programme with us? want to show your reports? want to seek holistic perspective?  take our counselling pre programme session."><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type3"
                                value="3">
                            <label class="form-check-label" for="consult_type3">
                                Advanced Holistic Consultation
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="Advanced Holistic Consultation"
                                data-content="Specialized personal consultation includes advice and prescription of, 1. medical consultation and prescription, 2. yogic consultation and advice, 3. holsitic diet prescription and reciepe, 4. atma veda yog session"><i
                                    class="fas fa-info-circle"></i></a>
                        </div> -->
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date"
                                onchange="availableSlots(this.value)" id="datepicker" min="<?php echo date("Y-m-d"); ?>"
                                max="<?php echo $maxDate['maxDate']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots" name="time_slots" required>
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

        <!-- modal for test selection -->
        <div class="modal fade" id="select_test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="card-title mx-auto brand-name">SELECT TEST</p>
                    <form method="post" action="">
                        <div class="form-check pt-3 pb-3">
                            <input class="form-check-input" type="radio" name="test_type" id="test_type1" value="1" disabled>
                            <label class="form-check-label" for="test_type1">YogE TEST</label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="General Consultation" data-content="Some nice text hereknjfsdb"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="test_type" id="test_type2" value="2" required>
                            <label class="form-check-label" for="test_type2">YogE@HOME</label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="YogE @ HOME"
                                data-content="Vital parameters and measurements give an instant insight in to the condition of the patient. Our application helps to manage the simple ,moderate and critical cases at home or under domicillary hospitalization or in hospitals. It is a helping hand of a doctor 24hr round the clock.  it helps in disease staging . disease prognosis, disease diagnosis, treatment response, detecting alarm signs etc."><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="test_type" id="test_type3" value="3" disabled>
                            <label class="form-check-label" for="test_type3">YogE@SUPERFIT</label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="Advanced Holistic Consultation" data-content="Some nice text hereknjfsdb"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <button type="submit" class="login-btn mt-5" style="color:white;font-size: 18px;"
                            name="start_test">START TEST</button>
                    </form>
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
                <button type="submit" class="login-btn mt-4 info-modal-btn" style="color:white;font-size: 18px;">BOOK AN
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