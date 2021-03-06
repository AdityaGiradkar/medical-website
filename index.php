<?php
session_start();
include('includes/db.php');
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AtmaVeda Yog pvt.ltd is a new startup company dedicated and formed on the principles of yoga. It's founder is Dr Sadanand Shivram Rasal . It's partners are Mrs Shital Narendra dhole.">
    <meta name="author" content="Dr Sadanand">
    <meta name="keywords" content="Hospital, atmaveda, AtmaVeda, AtmaVedaYog, atmavedayog, dr sadanand">

    <!-- Website icon -->
    <link rel="icon" href="images/AtmaVeda Logo.png" type="image/icon type">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom css File -->
    <link rel="stylesheet" href="css/index.css">

    <!-- for take test card -->
    <!-- <link rel="stylesheet" href="css/login.css"> -->

    <!-- SLider css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Font: Nunito Sans Semi Bold -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&display=swap" rel="stylesheet">

    <title>Home Page</title>
</head>

<body>

    <div class="main m-0">

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
                            <a href="#about" class="li-header nav-link mr-3">About Us</a>
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
                            <a href="#blogs" class=" nav-link li-header mr-3">Blogs</a>
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

        <div class="search">
            <div class="desktop_banner">
                <img class="d-block w-100" src="images/banner_image.png" alt="First slide" class="" loading="lazy">
            </div>
            <div class="mobile_banner">
                <img class="d-block w-100" src="images/mo_banner_image.png" alt="First slide" class="" loading="lazy">
            </div>
            <div class="container search-box">
                <h2 class="mb-4" style="font-family:Mongolian Baiti; color: rgb(0, 48, 123);">I am looking for,</h2>
                <input type="text" name="search" id="search" class="border-info input-box-search" placeholder="Treatments, Yoga..." autocomplete="off" required>
                <i class="fas fa-search" style="margin-left:-5%; color:rgb(0, 48, 123);"></i>
                <div class="search-list" >
                    <div class="list-group" id="show-list">
                    <!-- Here autocomplete list will be display -->
                    </div>
                </div>
            </div>
        </div>
        

        <div class="four-buttons pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="zoom-image">
                            <a href="all_available_tratments.php" class="four-button-color">
                                <img src="images/four-button/doctor.png" class="d-block mx-auto four-button-img"> 
                                <h5 class="text-center mt-3 four-button-txt font-mongolian">Treatments</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 four-button">
                        <div class="zoom-image">
                            <a data-target="#Appointment" data-toggle="modal" class="four-button-color">
                                <img src="images/four-button/medical-app.png" class="d-block mx-auto four-button-img"> 
                                <h5 class="text-center mt-4 four-button-txt font-mongolian">Consultations</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 four-button">
                        <div class="zoom-image">
                            <a href="#" data-target="#select_test" data-toggle="modal" class="four-button-color">
                                <img src="images/four-button/medical-report.png" class="d-block mx-auto four-button-img"> 
                                <h5 class="text-center mt-3 four-button-txt font-mongolian">Tests</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 four-button">
                        <div class="zoom-image">
                            <a href="login.php" class="four-button-color">
                                <img src="images/four-button/password.png" class="d-block mx-auto four-button-img"> 
                                <h5 class="text-center mt-3 four-button-txt font-mongolian">Login</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="medical-treatment paddingTobBottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-img">
                        <img src="images/medical_treatment/medical_treatment.png" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="news-slider" class="owl-carousel">
                                    <div class="post-slide">
                                        <div class="card h-100 mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/diabetes.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease1" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Diabetes</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post-slide">
                                        <div class="card mx-auto h-100" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/heart.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease2" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Cardiac Care</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/stree.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease3" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Hormone Correction</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/joint.webp" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease4" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Joint Pain</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/spine.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease5" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Spine Problems</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/stree.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease6" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Female Wellness</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/liver.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease7" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Liver Recovery</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/stmoch.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease8" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Stomach & Digestive Disorders</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/colon.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease9" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Colon & IBS</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/breath.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease10" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Breath Normal</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/blood.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease11" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Blood Disorder</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/cancer.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease12" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Cancer Therapeutic & Support</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/covid.png" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease13" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Covid-19 Management</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/chronic.png" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease14" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="h6 post-title font-roboto-500 text-center">Chronic Disease Management</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="diet paddingTobBottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="diet-slider" class="owl-carousel">
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/weight_loss.webp" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet1" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Weight Loss</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/anti-aging.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet2" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Anti Aging</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/stress.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet3" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Stress Management</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/weight-gain.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet4" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Weight Gain</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/taning.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet5" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Anti Tanning</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/relaxing.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet6" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Relaxation</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/muscle-gain.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet7" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Muscle Gain</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/fair.png" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet8" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Fair And Glow</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/super-fitness.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet9" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Super Fitness</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/figure.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet10" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Figure Management</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/persnality.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet11" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Personality Development</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/diet-management.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet12" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Diet Management</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/diet/curve.webp" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet13" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Shape Up Curves</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-img order-first order-md-last">
                        <img src="images/diet/diet.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="yoga paddingTobBottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-img">
                        <img src="images/yoga/yoga.png" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="yoga-slider" class="owl-carousel">
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/b1.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga1" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Basic Yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/fitness.jpeg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga2" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Fitness Yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/relaxation.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga3" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Relaxation Yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/b4.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga4" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Combo Yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/a1.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga5" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Atmanubuti Yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/sparsh.jpeg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga6" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Sparsha Yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/ashtang.jpeg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga7" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Ashtang Yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/hath.jpeg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga8" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Hath Yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/yoga/a3.jpg" class="card-img-top image" alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga9" data-toggle="modal" class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Power Yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4" id="consult">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-none d-md-block">
                        <img src="images/dr_2.png" width="250" class="img-fluid" alt="Dr Sadanand photo" />
                    </div>
                    <div class="col-md-8 pb-3">
                        <em>Consult</em>
                        <h3 class="font-mongolian">Dr. Sadanand</h3>
                        <p class="font-roboto mt-4">
                            Ask your questions, doubts, queries. Know more of your medicine, your treatment options available,
                            what you need to do in your illness. Know which is right pathy or mode of treatment for your disease. 
                        </p>
                        <p>
                            Have a non biased advice. Discuss your symptom, disease, tratment and medicines. 
                        </p>

                        <div class="mt-4">
                            <a data-target="#Appointment" data-toggle="modal" class="Explore-box">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-5" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 d-none d-md-block">
                        <img src="images/AtmaVeda(334,273).png" width="240" style="vertical-align: middle;" class="img-fluid" />
                    </div>
                    <div class="col-md-9">
                        <p class="about-heading">AtmaVeda Yog</p>
                        <p class="font-roboto">
                            AtmaVeda Yog Pvt Ltd. is an innovative one of its kind company around the globe which invents disgnostic tools based on yoga,
                            runs clinic, manages hospitals, conducts research in yoga and medicine, trains doctor and students in AtmaVeda
                            Yog. It is also involves in making proprietary medical preparation.
                        </p>
                        <p class="font-roboto"> 
                            It works for, Social sector, Corporate sector And is also open to work for governments around the world in 
                            field of medicine, community screening, yoga therapies and education.
                        </p>
                        <a href="about.php" class="d-inline-block mt-2 Explore-box ">Explore</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pilars paddingTobBottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-6 mb-3">
                        <img src="images/pilar1.png" width="85px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Chirayu</h5>
                        <p class="text-center mt-3 font-roboto">Life is meaningful when we have happiness, inner peace, strength &
                            worth
                            living long.</p>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <img src="images/pilar2.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Diet Pratyahara</h5>
                        <p class="text-center mt-3 font-roboto">Diet Pratyahara improves Guna-dharma, Sanskar &amp; Yog-anurup falaprapti. It cures disease and give
                            health.</p>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <img src="images/pilar3.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Exercise Chiratarunya</h5>
                        <p class="text-center mt-3 font-roboto">Exercise healing disease, giving Arogya-sampada &amp; staying young without aging is Exercise
                            Chiratarunya.</p>
                    </div>
                    <div class="col-md-3 col-xs-6 mb-3">
                        <img src="images/pilar4.png" width="52px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Yog-E Nidaan</h5>
                        <p class="text-center mt-3 font-roboto">Yog-E diagnoses the unknown Root Cause, your Dosha&#39;s. Detects early before the disease
                            process begins ,helps to prevent and cure disease.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="pb-3 pt-3" id="test">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 pt-3 " style="color: white;">
                        <h3>Diagnose at your home with <b>Yog-E Nidaan</b></h3>
                        <p class="font-roboto mt-4">
                            AB YOG KARE NIDAAN. Stay at home and diagnose your health issues and fitness through
                            our most innovative AtmaVedaYog based YOG-E tests. Diagnose health issue, doshas,
                            immunity, chakra, and many other useful parameters required for health assessment, disease
                            diagnosis, therapeutic utility and predictive analysis.
                        </p>
                        <p class="font-roboto">
                            Our YOG-E tests also make HomeCare@KaroNa successful. Makes remote management of
                            simple and critical patients at home or hospital possible by giving medical diagnostic and
                            clinical support. Helps to Manage distant rural clinics with efficiency and makes Domiciliary
                            care a best alternative.
                        </p>
                        <div class="mt-4 pb-3">
                            <a href="#" data-target="#select_test" data-toggle="modal" class="take-test">Take The Test</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="images/lady.png" alt="" class="img-fluid d-none d-md-block" />

                    </div>
                </div>
            </div>
        </div> -->

        <?php 
            $fetch_images = "SELECT * FROM `images` ORDER BY `image_id` DESC LIMIT 8"  ;
            $fetch_images_run = mysqli_query($con, $fetch_images);
        ?>
        <div class="gallery pt-5 pb-5">
            <div class="container-fluid">
                <h2 class="text-center">Gallery<h2>
                <div class="row pt-5">
                    <?php while($fetch_images_res = mysqli_fetch_assoc($fetch_images_run)){ ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-0">
                            <img class="img-fluid" src="admin/img/images/<?php echo $fetch_images_res['location']; ?>" alt="<?php echo $fetch_images_res['original_name']; ?>" >
                        </div>
                    <?php }?>
                </div>
                <h6 class="text-center mt-5"><a href="#" class="view_more">View More</a></h6>
            </div>
        </div>


        <?php 
            $all_review = "SELECT * FROM `review` ORDER BY `review_id` DESC";
            $all_review_run = mysqli_query($con, $all_review);
        ?>
        <div class="review mt-5 mb-4">
            <div class="container">
                <h2 class="text-center">What Our Patient Says</h2>
                <div class="row mt-4 pt-3">
                    <div class="col-md-12">
                        <div id="review-slider" class="owl-carousel">
                            <?php while($all_review_res = mysqli_fetch_assoc($all_review_run)){ ?>
                            <div class="post-slide">
                                <div class="review">
                                    <div class="card review_card shadow rounded" style="width: 18rem;">
                                        <div class="card-body">
                                            <img src="admin/img/reviewer_image/<?php echo $all_review_res['photo']; ?>" class="reviewer_image rounded-circle d-block mx-auto" width="100">
                                            <p class="card-text font-roboto" ><?php echo $all_review_res['review']; ?></p>
                                            <div class="row">
                                                <div class="col-4"></div>
                                                <div class="col-8 m-0">
                                                    <small>
                                                        <b style="color:rgb(0, 45, 105);"><?php echo $all_review_res['person_name']; ?></b><br>
                                                        <i><?php echo $all_review_res['designation']; ?></i>
                                                        
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // $all_blogs = "SELECT * FROM `blogs` ORDER BY `blog_id` DESC";
        // $all_blogs_run = mysqli_query($con, $all_blogs);

        ?>
        <!-- <div class="blogs paddingTobBottom" id="blogs" style="background-color: rgb(249, 250, 255);">
            <div class="container">
                <h2 class="text-center">Blogs & Videos</h2>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div id="blog-slider" class="owl-carousel">
                            <?php
                            //while ($all_blogs_res = mysqli_fetch_assoc($all_blogs_run)) {
                            ?>
                                <div class="post-slide">
                                    <div class="card mx-auto" style="width: 15rem; border-radius: 12px;">
                                        <div class="contain">
                                            <img src="admin/img/blog_images/<?php //echo $all_blogs_res['cover_img']; ?>" height="300" class="card-img-top image" alt="..." loading="lazy">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="post-title text-center">
                                                <a href="<?php //echo $all_blogs_res['blog_link']; ?>" target="_blank" style="color:darkblue">
                                                    <?php //echo $all_blogs_res['blog_name']; ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            //}
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="bg-dark pt-4 pb-3" style="padding:2%; margin-bottom:-24px;color:white;">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-md-4 mt-3 ">
                        <p class="text-center" style=" font-size:12px;color:#bfbfbf">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. All rights reserved &nbsp;<a target="blank" href="images/Privacy Policy.pdf">Privacy Policies</a></p>
                    </div>
                    <div class="col-md-4">
                        <img src="images/AtmaVeda(334,273).png" width="80" class="img-fluid  d-block mx-auto">
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
    </div>


    <!-- Modal for appointment -->
    <?php
    $minAvailableDate = "SELECT MAX(`date`) AS maxDate FROM `consultation_time` WHERE `assigned_user`=0";
    $minAvailableDate_run = mysqli_query($con, $minAvailableDate);
    $maxDate = mysqli_fetch_assoc($minAvailableDate_run);
    // echo "Maximum date = ".$maxDate['maxDate'];
    ?>
    <div class="modal fade" id="Appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title brand-name" id="exampleModalLongTitle">BOOK AN APPOINTMENT</h5>
                </div>
                <?php
                $consultations = "SELECT * FROM `consult_type` WHERE `id`<4";
                $consultations_run = mysqli_query($con, $consultations);
                ?>
                <div class="modal-body">
                    <!-- <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p> -->
                    <form method="post" action="">
                        <?php
                        $count = 1;
                        while ($consultations_res = mysqli_fetch_assoc($consultations_run)) {
                            // if($consultations_res['id'] <= 3){
                        ?>
                            <div class="form-check pt-2 pb-3">
                                <input class="form-check-input" type="radio" name="consult_type" id="consult_type<?php echo $count; ?>" value="<?php echo $consultations_res['id']; ?>" required>
                                <label class="form-check-label" for="consult_type<?php echo $count; ?>">
                                    <?php echo $consultations_res['name']; ?>
                                </label>
                                <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true" title="<?php echo $consultations_res['name']; ?>" data-content="<?php echo $consultations_res['consult_info']; ?>"><i class="fas fa-info-circle"></i></a>
                            </div>
                        <?php
                            $count++;
                            // }
                        }
                        ?>
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date" onchange="availableSlots(this.value, 1)" id="datepicker" min="<?php echo date("Y-m-d"); ?>" max="<?php echo $maxDate['maxDate']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots1" name="time_slots" required>
                                <!-- data will be fetched in real time by using AJAX -->
                            </select>
                        </div>

                        <button type="submit" class="login-btn mt-5" style="color:white;font-size: 18px;" name="appoint">Book an
                            Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for appointment -->


    <!-- Modal for Covid appointment -->
    <div class="modal fade" id="Covid_Appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title brand-name" id="exampleModalLongTitle">BOOK AN APPOINTMENT</h5>
                </div>
                <?php
                $consultations = "SELECT * FROM `consult_type` WHERE `id`>3 AND `id`<7";
                $consultations_run = mysqli_query($con, $consultations);
                ?>
                <div class="modal-body">
                    <!-- <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p> -->
                    <form method="post" action="">
                        <?php
                        $count = 4;
                        while ($consultations_res = mysqli_fetch_assoc($consultations_run)) {
                            // if($consultations_res['id'] > 3 & $consultations_res['id'] < 7){
                        ?>
                            <div class="form-check pt-2 pb-3">
                                <input class="form-check-input" type="radio" name="consult_type" id="consult_type<?php echo $count; ?>" value="<?php echo $consultations_res['id']; ?>" required>
                                <label class="form-check-label" for="consult_type<?php echo $count; ?>">
                                    <?php echo $consultations_res['name']; ?>
                                </label>
                                <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true" title="<?php echo $consultations_res['name']; ?>" data-content="<?php echo $consultations_res['consult_info']; ?>"><i class="fas fa-info-circle"></i></a>
                            </div>
                        <?php
                            $count++;
                            // }
                        }
                        ?>
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date" onchange="availableSlots(this.value, 2)" id="datepicker" min="<?php echo date("Y-m-d"); ?>" max="<?php echo $maxDate['maxDate']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots2" name="time_slots" required>
                                <!-- data will be fetched in real time by using AJAX -->
                            </select>
                        </div>

                        <button type="submit" class="login-btn mt-5" style="color:white;font-size: 18px;" name="appoint">Book an
                            Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Covid appointment -->


    <!-- Modal for Yoga appointment -->
    <div class="modal fade" id="yoga_Appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title brand-name" id="exampleModalLongTitle">BOOK AN APPOINTMENT</h5>
                </div>
                <?php
                $consultations = "SELECT * FROM `consult_type` WHERE `id`=7";
                $consultations_run = mysqli_query($con, $consultations);
                ?>
                <div class="modal-body">
                    <!-- <p class="card-title mx-auto brand-name">BOOK AN APPOINTMENT</p> -->
                    <form method="post" action="">
                        <?php
                        $count = 7;
                        while ($consultations_res = mysqli_fetch_assoc($consultations_run)) {
                            // if($consultations_res['id'] == 7 ){
                        ?>
                            <div class="form-check pt-2 pb-3">
                                <input class="form-check-input" type="radio" name="consult_type" id="consult_type<?php echo $count; ?>" value="<?php echo $consultations_res['id']; ?>" required>
                                <label class="form-check-label" for="consult_type<?php echo $count; ?>">
                                    <?php echo $consultations_res['name']; ?>
                                </label>
                                <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true" title="<?php echo $consultations_res['name']; ?>" data-content="<?php echo $consultations_res['consult_info']; ?>"><i class="fas fa-info-circle"></i></a>
                            </div>
                        <?php
                            $count++;
                            // }
                        }
                        ?>
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date" onchange="availableSlots(this.value, 3)" id="datepicker" min="<?php echo date("Y-m-d"); ?>" max="<?php echo $maxDate['maxDate']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots3" name="time_slots" required>
                                <!-- data will be fetched in real time by using AJAX -->
                            </select>
                        </div>

                        <button type="submit" class="login-btn mt-5" style="color:white;font-size: 18px;" name="appoint">Book an
                            Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Yoga appointment -->


    <!-- Modal for waring about treatment pending amount -->
    <div class="modal fade" id="warning_pending_amount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title brand-name" id="exampleModalLongTitle">Reminder about pending Treatment Charges</h5>
                </div>

                <div class="modal-body">
                    <p class="text-center">Your treatment has been added in treatment section, Kindly check it and pay to proceed.</p>
                    <a href="ongoing_treatments.php" class="btn btn-primary float-right">Treatment Section</a>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal for waring about treatment pending amount -->


    <!-- modal for test selection -->
    <?php
    $get_test = "SELECT * FROM `test_type`";
    $get_test_run = mysqli_query($con, $get_test);

    ?>
    <div class="modal fade" id="select_test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        while ($get_test_res = mysqli_fetch_assoc($get_test_run)) {

                        ?>
                            <div class="form-check pt-3">
                                <input class="form-check-input" type="radio" name="test_type" id="test_type<?php echo $get_test_res['test_id']; ?>" value="<?php echo $get_test_res['test_id']; ?>" required>
                                <label class="form-check-label test_name" for="test_type<?php echo $get_test_res['test_id']; ?>"><?php echo $get_test_res['test_name']; ?></label>
                                <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" title="<?php echo $get_test_res['test_name']; ?>" data-content="<?php echo $get_test_res['test_info']; ?>"><i class="fas fa-info-circle"></i></a>
                            </div>
                        <?php

                        }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="login-btn mt-4" form="myform" style="color:white;font-size: 18px;" name="start_test">START TEST</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for test selection -->


    <!-- Include all modal html -->
    <?php include("includes/modal.php"); ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js">
    </script>
</body>

</html>

<?php
if (isset($_SESSION['user_id'])) {
    //check for user have filled the details or not
    $check_detailes_fieled = "SELECT  `problems` FROM `medical_history` WHERE `user_id`='$user_id'";
    $check_detailes_fieled_run = mysqli_query($con, $check_detailes_fieled);
    $check_detailes_fieled_res = mysqli_fetch_assoc($check_detailes_fieled_run);

    //check for painding amount
    $check_pending_amount = "SELECT * FROM `treatment` WHERE `user_id`='$user_id' AND `fees_status`='pending' AND `treat_status`='ongoing'";
    $check_pending_amount_run = mysqli_query($con, $check_pending_amount);
    $check_pending_amount_res = mysqli_num_rows($check_pending_amount_run);



    if ($check_detailes_fieled_res['problems'] == "") {
        echo "<script>
                //alert('Details are not filled. Please first Fill the details.');
                window.location.href='update_details.php';
            </script>";
    } else if ($check_pending_amount_res > 0) {
        echo "<script>              
                $('#warning_pending_amount').modal('show'); 
            </script>";
    }
}

//php for booking appointment
if (isset($_POST['appoint'])) {
    if (isset($_SESSION['user_id'])) {
        $consult_type = $_POST['consult_type'];
        $date = $_POST['consult_date'];
        $time = $_POST['time_slots'];

        //check for user have filled the details or not
        if ($check_detailes_fieled_res['problems'] == "") {
            $_SESSION['consult_type'] = $consult_type;
            $_SESSION['consult_date'] = $date;
            $_SESSION['time_slots'] = $time;

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
if (isset($_POST['start_test'])) {
    if (isset($_SESSION['user_id'])) {
        $test_type = $_POST['test_type'];

        //check for user have filled the details or not
        if ($check_detailes_fieled_res['problems'] == "") {
            $_SESSION['test_type'] = $test_type;
            echo "<script>
                        alert('Please first Fill the details.');
                        window.location.href='update_details.php';
                    </script>";
        }

        echo "<script>
                    window.location.href='payment/test_payment.php?type=$test_type';
                </script>";
    } else {
        echo "<script>
                alert('Please login first.');
                window.location.href='login.php';
            </script>";
    }
}


?>


 <script>
    // for slider
    $(document).ready(function() {
        $("#news-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });
        $("#diet-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });
        $("#yoga-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });
        $("#review-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });
        $("#blog-slider").owlCarousel({
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });


        // for popover
        $('[data-toggle="popover"]').popover();

        // for switching modal

        $('body').on('click', '.info-modal-btn', function() {
            $('.info-modal').modal('hide');
            $('#Appointment').modal('show');
        });

        $('body').on('click', '.info-modal-btn_covid', function() {
            $('.info-modal').modal('hide');
            $('#Covid_Appointment').modal('show');
        });

        $('body').on('click', '.info-modal-btn_yoga', function() {
            $('.info-modal').modal('hide');
            $('#yoga_Appointment').modal('show');
        });


        let mob_banner = document.getElementById("mobile").style;
        let desk_banner = document.getElementById("desktop").style;
        let width = $(document).width();

        if (width <= 576) {
            mob_banner.display = "block";
            desk_banner.display = "none";
        } else {

        }



    });

    // dynamic Search bar
    $(document).ready(function() {
        
        document.querySelector('#search').onkeyup = function() {
            let searchText = this.value;
            // console.log(searchText);
            if(searchText != ""){
                var xmlhttpSearch = new XMLHttpRequest();
                xmlhttpSearch.onreadystatechange = function() {
                
                    if (this.readyState == 4 && this.status == 200) {
                        let data = JSON.parse(this.responseText);
                        let searchlist = '';
                        if(data.length !== 0){
                            data.forEach((item, index) => {
                                searchlist = searchlist + `<a href="#" data-target='#${ item['link'] }' data-toggle='modal' class='list-group-item list-group-item-action border-1 pointer'>${ item['name'] }</a>`;
                            });
                        } else {
                            searchlist = `<a href="#" class='list-group-item list-group-item-action border-1'>No result Found.</a>`;
                        }
                        
                        
                        document.querySelector('#show-list').innerHTML = searchlist;
                       
                        
                    }
                }
                xmlhttpSearch.open("GET", "search.php?query=" + searchText, true);
                xmlhttpSearch.send();

            }else{
                document.querySelector('#show-list').innerHTML = '';
            }
        }

        //Click on any element in document
        document.onclick = () => {
            document.querySelector('#show-list').innerHTML = '';
        }
    });


   
//    time slots
    function availableSlots(date, id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var slots_array = JSON.parse(this.responseText);
                // var htmlSlotsOption = "<option selected='selected' disabled='disabled' hidden>Select Time</option>";
                var htmlSlotsOption = "";
                slots_array.forEach(add);

                function add(item, index) {
                    htmlSlotsOption = htmlSlotsOption + "<option value='" + item.time_range + "'>" + item
                        .time_range + "</option>";
                }
                document.getElementById("time_slots" + id).innerHTML = htmlSlotsOption;

                // console.log(slots_array);
            }
        };
        xmlhttp.open("GET", "includes/getSlots.php?date=" + date, true);
        xmlhttp.send();
    }
 
</script>