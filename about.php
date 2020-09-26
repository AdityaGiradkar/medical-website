<?php 
session_start();
include('includes/db.php');



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

    <nav class="navbar navbar-expand-lg sticky-top shadow" style="background-color:white!important;padding:1.3rem">
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
    </nav>

    <div class="container pt-4">
        <h4 class=" h3 text-center pb-4">ABOUT US</h4>
        <div class="row">
            <div class="col-md-4">
                <img src="images/AtmaVeda(334,273).png" width="300" class="img-fluid d-block mx-auto" />
            </div>
            <div class="col-md-8 align-self-center pl-5">

                <p>AtmaVeda Yog pvt.ltd is a new startup company dedicated and formed on the principles of yoga.
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

        <h3 class="text-center pt-3 pb-5 mb-3">ABOUT ME</h3>
        <div class="row">
            <div class="col-md-4">
                <img src="images/doctor.png" width="300" class="img-fluid d-block mx-auto" />
            </div>
            <div class="col-md-8 pt-5 mt-5">
                <h4 class="text-center">Dr. Sadanand Shivram Rasal</h4>
                <h6 class="text-center">BHMS (MCH), PGDMLT.</h6>
            </div>
            <div class="mt-5">
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

                <hr>
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


    </div>

    <div class="bg-dark" style="padding:1%; color:white;">
            <h6 class="text-center">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. <a target="blank" href="images/Privacy Polic1.pdf">policies</a></h6>
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
                <div class="modal-body">
                    <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p>
                    <form method="post" action="">
                        <div class="form-check pt-3 pb-3">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type1"
                                value="1" required>
                            <label class="form-check-label" for="consult_type1">
                                General Consultation
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="General Consultation"
                                data-content="consult online and seek advice treatment for general issues. 25 years experience of general practise as family physician and general practitioner."><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
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
                        </div>
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
    //php for booking appointment
    if(isset($_POST['appoint'])){
        if(isset($_SESSION['user_id'])){
            $consult_type = $_POST['consult_type'];
            $date = $_POST['consult_date'];
            $time = $_POST['time_slots'];

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
?>