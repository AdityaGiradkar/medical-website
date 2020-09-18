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
        <a class="navbar-brand ml-5" style="font-size:1.8rem" href="#">
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
        <div class="row">
            <div class="col-4">
                <img src="images/doctor.png" width="300" class="img-fluid d-block mx-auto" />
            </div>
            <div class="col-8 align-self-center pl-5">

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
            AtmaVeda Yog Pvt limited has innovative activities, one of its kind around the globe which.</p>
        <ul>
            <li>Invents diagnostic tools based on yoga.</li>
            <li>Runs clinics for chronic and critical management</li>
            <li>plans and supports hospitals to treat illnesses ,conducts research in yoga and medicine, trains doctors
                and students in AtmaVeda Yog.</li>

        </ul>
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

            $payment_amount = "SELECT * FROM `consult_type` WHERE `id`='$consult_type'";
            if($payment_amount_run = mysqli_query($con, $payment_amount)){
                $payment_amount_res = mysqli_fetch_assoc($payment_amount_run);
                $price = $payment_amount_res['price'];
                $consult_name = $payment_amount_res['name'];
                $datetime= date('Y-m-d H:i:s');

                $update_assigned_user = "UPDATE `consultation_time` SET `assigned_user`='$user_id',`consult_type`='$consult_name',`date_submission`='$datetime',`status`='assigned' WHERE `date`='$date' AND `time_range`='$time'";
                if($update_assigned_user_run = mysqli_query($con, $update_assigned_user)){
                    echo "<script>
                            alert('Your appointment is booked you can see it in your profile.');
                            window.location.href='index.php';
                    </script>";
                }
            }
        } else {
            echo "<script>
                alert('Please login first.');
                window.location.href='login.php';
            </script>";
        }
    }
?>