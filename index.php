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
    <meta name="description" content="AtmaVeda Yog pvt.ltd is a new startup company dedicated and formed on the principles of yoga. It's founder is Dr Sadanand Shivram Rasal . It's partners are Mrs Shital Narendra dhole.">
    <meta name="author" content="Dr Sadanand">
    <meta name="keywords" content="Hospital, atmaveda, AtmaVeda, AtmaVedaYog, atmavedayog, dr sadanand">

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
    
    <title>Home Page</title>
</head>

<body>

    <div class="main">

    
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
                            <a href="#about" class="li-header nav-link mr-3">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#consult" class="li-header nav-link mr-3">Consultations</a>
                        </li>
                        <li class="nav-item">
                            <a data-target="#Appointment" data-toggle="modal" href="" class="li-header nav-link mr-3">Book Appointment</a>
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


        <!-- <div class="container-fluid p-0 sticky-top">
            <img src="images/hedder.png" class="img-fluid" />
            <div class="container p-absolute" style="margin-top: -110px;">
                <ul class="d-inline">
                    <li class="d-inline">
                        <a href="#about" class="li-header">ABOUT US</a>
                    </li>
                    <li class="d-inline red-dot">
                        <a href="#consult" class="li-header">COUNSELLING</a>
                    </li>
                    <li class="d-inline red-dot">
                        <a href="#" class="li-header">SHOP</a>
                    </li>
                </ul>
                <img src="images/AtmaVeda(334,273).png" class="img-fluid" style="margin-left: 7%;" width="80px" />
                <ul class="d-inline ml-3">
                    <li class="d-inline">
                        <a href="" class="li-header">BLOG</a>
                    </li>
                    <li class="d-inline red-dot">
                        <a href="" class="li-header">BOOK AN APOINTMENT</a>
                    </li>
                    <?php if(!isset($_SESSION['user_id'])){ ?>
                    <li class="d-inline red-dot">
                        <a href="login.php" class="li-header">LOGIN</a>
                    </li>
                    <?php }else{ ?>
                    <li class="d-inline red-dot">
                        <a href="<?php if($_SESSION['role'] == 'doctor'){?> admin/index.php <?php }else{ ?> user_page.php <?php } ?>" class="li-header">User</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div> -->
        <div class="intro pt-3">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/banner/Banner2.png" alt="First slide">
                        <div class="carousel-caption button1 d-none d-md-inline-block">
                            <a href="about.php" class="d-inline-block mt-2 Explore-box ">Explore</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/banner/Banner1.png" alt="Second slide">
                        <div class="carousel-caption d-none button2 d-md-inline-block">
                            <a href="#" data-target="#banner_diet" data-toggle="modal" class="d-inline-block mt-2 Explore-box ">Explore</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/banner/Banner3.png" alt="Third slide">
                        <div class="carousel-caption d-none button3 d-md-inline-block">
                            <a href="#" data-target="#select_test" data-toggle="modal" class="d-inline-block mt-2">Explore</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/banner/Banner4.png" alt="Third slide">
                        <div class="carousel-caption d-none button4 d-md-inline-block">
                            <a href="#" data-target="#medicine_imagica" data-toggle="modal" class="d-inline-block mt-2">Explore</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/banner/Banner5.png" alt="Third slide">
                        <div class="carousel-caption d-none button5 d-md-inline-block">
                            <a href="#" data-target="#banner_covid" data-toggle="modal" class="d-inline-block mt-2 Explore-box ">Explore</a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- <div class="container">
                <div class="row">
                    <div class="col-7 d-flex align-items-center justify-content-center">
                        <p class="about-heading">Atmavedayog a new defination for holistic medicine.<br><br>

                        <span class="about-heading" style="font-family:monteserrat; font-size:30px">We cure we heal when no one can.</span></p>
                    </div>
                    <div class="col-5">
                        <img src="images/doctor.png" width="350" class="img-fluid d-block mx-auto" />
                    </div>
                </div>
            </div> -->
        </div>

        <div class="mt-5 pt-5" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="images/AtmaVeda(334,273).png" width="240" style="vertical-align: middle;"
                            class="img-fluid" />
                    </div>
                    <div class="col-md-9 pl-5">
                        <p class="about-heading">AtmaVeda Yog</p>
                        <p class="font-roboto">
                            AtmaVeda Yog Pvt Ltd. is an innovative one of its kind company around the globe which works in following fields:
                            <ul class="font-roboto">
                                <li>Invention of diagnostic tools based on yoga.</li>
                                <li>YOG-E yoga- based e-clinics.</li>
                                <li>Holistic residential medical centres</li>
                                <li>Research in yoga and life sciences</li>
                                <li>Development of Homecare and criticare tools for management at home.</li>
                                <li>Training institutions in AtmaVeda Yog.</li>
                                <li>Making proprietary medicinal preparations</li>
                            </ul>
                        </p>

                        <p class="font-roboto mb-3">
                            It works for, Social sector, Corporate sector and is also open to work for governments around the
                            world in field of medicine, community screening, yoga therapies and education.
                        </p>
                        <a href="about.php" class="d-inline-block mt-2 Explore-box ">Explore</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pilars marginTop">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="images/pilar1.png" width="85px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Chirayu</h5>
                        <p class="text-center mt-3 font-roboto">Life is meaningful when we have happiness, inner peace, strength &
                            worth
                            living long.</p>
                    </div>
                    <div class="col-md-3">
                        <img src="images/pilar2.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Diet Pratyahara</h5>
                        <p class="text-center mt-3 font-roboto">Diet Pratyahara improves Guna-dharma, Sanskar &amp; Yog-anurup falaprapti. It cures disease and give
                            health.</p>
                    </div>
                    <div class="col-md-3">
                        <img src="images/pilar3.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Exercise Chiratarunya</h5>
                        <p class="text-center mt-3 font-roboto">Exercise healing disease, giving Arogya-sampada &amp; staying young without aging is Exercise
                            Chiratarunya.</p>
                    </div>
                    <div class="col-md-3">
                        <img src="images/pilar4.png" width="52px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3 font-mongolian">Yog-E Nidaan</h5>
                        <p class="text-center mt-3 font-roboto">Yog-E diagnoses the unknown Root Cause, your Dosha&#39;s. Detects early before the disease
                            process begins ,helps to prevent and cure disease.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 marginTop " id="consult">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/doctor.png" width="250" class="img-fluid" alt="Dr Sadanand photo" />
                    </div> 
                    <div class="col-md-8 pb-3">
                        <em>Consult</em>
                        <h3 class="font-mongolian">Dr. Sadanand</h3>
                        <p class="font-roboto mt-4">
                            Consult Dr Sadanand for "Advanced Holistic Consultation". Heal your disease, illness. 
                            Solve your health problems, get your holistic diet prescriptions, consult for personal sessions. 
                            You can also "Ask Dr Sadanand" for information about your disease, your health queries, doubts, medicines, diagnostic test. 
                            Have a "Pre-Treatment Consultation before you join treatment programmes. Know all, see all, learn all.
                        </p>
                        
                        <div class="mt-4">
                            <a data-target="#Appointment" data-toggle="modal" class="Explore-box">Book Appointment</a>
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
                                                <img src="images/medical_treatment/diabetes.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease1" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Purna Diabetes Chikitsa</h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="post-slide">
                                        <div class="card mx-auto h-100" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/heart.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease2" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Hrudayasparsh - Cardiac Care</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/stree.jpg"  class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease3" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/medical_treatment/joint.webp" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease4" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Joint Healing</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/spine.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease5" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Spine Strenghtening</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/stree.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease6" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Stri Rog Chikitsa</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/liver.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease7" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Liv Strong</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/stmoch.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease8" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Stomach - Heal the Fire</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/colon.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease9" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Colon</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/breath.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease10" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/medical_treatment/blood.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease11" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Blood Disorder Treatment</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/cancer.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease12" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title font-roboto-500 text-center">Cancer Therpay - therapeutic or Supportive</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/medical_treatment/covid.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease13" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/medical_treatment/chronic.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease14" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/weight_loss.webp" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet1" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/anti-aging.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet2" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/stress.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet3" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/weight-gain.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet4" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/taning.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet5" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/relaxing.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet6" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/muscle-gain.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet7" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/fair.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet8" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/super-fitness.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet9" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/figure.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet10" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/persnality.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet11" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/diet-management.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet12" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/diet/curve.webp" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet13" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                    <div class="col-md-4 text-img">
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
                                                <img src="images/yoga/b1.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga1" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/fitness.jpeg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga2" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/relaxation.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga3" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/b4.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga4" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/a1.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga5" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/sparsh.jpeg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga6" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/ashtang.jpeg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga7" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/hath.jpeg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga8" data-toggle="modal"
                                                        class="explore" title="User Profile">
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
                                                <img src="images/yoga/a3.jpg" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga9" data-toggle="modal"
                                                        class="explore" title="User Profile">
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

        <div class="pb-3 pt-3" id="test">
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
                        <img src="images/lady.png" alt="" class="img-fluid" />

                    </div>
                </div>
            </div>
        </div>

        <div class="review marginTop">
            <div class="container">
                <h2 class="text-center">What Our Patient Says</h2>
                <div class="row mt-5 pt-3">
                    <div class="col-md-12">
                        <div id="review-slider" class="owl-carousel">
                            <div class="post-slide">
                                <div class="review">
                                    <img src="images/background_review.png" width="500px"
                                        class="img-fluid d-block mx-auto" />
                                    <div class="container-fluid review-text">
                                        <img src="images/Quote.png" width="80px" /><br><br><br>

                                        <p style="padding-top:20px;">
                                            I joined Dr sadanand's "selective weight loss programme". I have reduced my weight 
                                            by 15 kg , my abdomen has reduced. My abnormal Insulin levels have 
                                            also been corrected. Feel lighter,strong and improved vigor.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mr. Hemant Choudhari. </b><br>
                                            <em><small>Director Delta flow Pvt Ltd</small></em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-slide">
                                <div class="review">
                                    <img src="images/background_review.png" width="500px"
                                        class="img-fluid d-block mx-auto" />
                                    <div class="container-fluid review-text">
                                        <img src="images/Quote.png" width="80px" /><br><br><br>

                                        <p>
                                            I suffered from severe cervical spondylitis and hyper uriac acid level.
                                            I joined Dr sadanand's Chronic pain and spine management prog.
                                            Now I do push-ups,pull-ups, suryanamaskar, weights , head stand. My uric acid levels are normal too. Miraculous!!!
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mr. Balasaheb More </b><br>
                                            <em><small>Director Saras Enterprises Pvt Ltd.</small></em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-slide">
                                <div class="review">
                                    <img src="images/background_review.png" width="500px"
                                        class="img-fluid d-block mx-auto" />
                                    <div class="container-fluid review-text">
                                        <img src="images/Quote.png" width="80px" /><br><br><br>

                                        <p>
                                            I suffered from SLE arthritis and immunosuppressant drug side effects.
                                            Joining Dr Sadanand's "chronic disease management prog." Has made me recover completely. No injection,no steroid, no hospitalization. My body is also in good shape now.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mrs. Swarna Malatpure </b><br>
                                            
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-slide">
                                <div class="review">
                                    <img src="images/background_review.png" width="500px"
                                        class="img-fluid d-block mx-auto" />
                                    <div class="container-fluid review-text">
                                        <img src="images/Quote.png" width="80px" /><br><br><br>

                                        <p style="padding-top: 40px;">
                                            I joined Dr Sadanand's Stress management programme. 
                                            I feel stress free, energetic ,alert now. I can now work for long hours.
                                            Its helping me serve my nation and duty.
                                        </p>
                                        <p style="padding-left: 250px;"><b>- Mr Narendra </b><br>
                                            
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-slide">
                                <div class="review">
                                    <img src="images/background_review.png" width="500px"
                                        class="img-fluid d-block mx-auto" />
                                    <div class="container-fluid review-text">
                                        <img src="images/Quote.png" width="80px" /><br><br><br>

                                        <p>
                                            Living in UK ,hectic lifestyle I had Weight ,skin and hormone problems. Joining Dr Sadanand's "Womaniya holistic health"programme. My PCOD is cured. Weight and skin problem all solved. I feel the change within.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Miss. Kanchan More </b><br>
                                            
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="post-slide">
                                <div class="review">
                                    <img src="images/background_review.png" width="500px"
                                        class="img-fluid d-block mx-auto" />
                                    <div class="container-fluid review-text">
                                        <img src="images/Quote.png" width="80px" /><br><br><br>

                                        <p>Joining Dr Sadanand's Chronic disease management programme has helped me totally cure my problem of"spleenic vein thrombosis". My body proportions have improved too.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mrs. Vidya Anarse </b><br>
                                            <em><small>teaching & coaching</small></em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php 
            $all_blogs ="SELECT * FROM `blogs`";
            $all_blogs_run = mysqli_query($con, $all_blogs);
             
        ?>
        <div class="blogs paddingTobBottom" id="blogs" style="margin-top: 405px;  background-color: rgb(249, 250, 255);">
            <div class="container">
                <h2 class="text-center">Blogs & Videos</h2>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div id="blog-slider" class="owl-carousel">
                            <?php 
                                while($all_blogs_res = mysqli_fetch_assoc($all_blogs_run)){
                            ?>
                            <div class="post-slide">
                                <div class="card mx-auto" style="width: 15rem; border-radius: 12px;">
                                    <div class="contain">
                                        <img src="admin/img/blog_images/<?php echo $all_blogs_res['cover_img']; ?>"
                                            height="300" class="card-img-top image" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="post-title text-center">
                                            <a href="<?php echo $all_blogs_res['blog_link']; ?>" target="_blank" style="color:darkblue">
                                                <?php echo $all_blogs_res['blog_name']; ?>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                            ?>

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
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true"
                                title="General Consultation" data-content="Consult online and seek advice treatment for general issues. 25 years experience of general practise as family physician and general practitioner."><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type2"
                                value="2">
                            <label class="form-check-label" for="consult_type2">
                                Holistic Pre-program Counselling
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true"
                                title="Holistic Pre-program Counselling" data-content="Want to know about our treatment?, want to know your decision to choose is right?. want to discuss your health programme with us? want to show your reports? want to seek holistic perspective?  take our counselling pre programme session."><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type3"
                                value="3">
                            <label class="form-check-label" for="consult_type3">
                                Advanced Holistic Consultation
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus" data-html="true"
                                title="Advanced Holistic Consultation" data-content="Specialized personal consultation includes advice and prescription of,<ol><li>medical consultation and prescription</li> <li>yogic consultation and advice</li> <li>holsitic diet prescription and reciepe</li> <li>atma veda yog session</li>"><i
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

    <!-- Include all modal html -->
    <?php include("includes/modal.php"); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js">
    </script>
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
    // for slider
    $(document).ready(function () {
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
            items: 1,
            itemsDesktop: [1199, 1],
            itemsDesktopSmall: [980, 1],
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
    });

    // for popover
    $('[data-toggle="popover"]').popover();

    // for switching modal
 
    $('body').on('click', '.info-modal-btn', function() {
        $('.info-modal').modal('hide');
        $('#Appointment').modal('show');
    });


    function availableSlots(date) {
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
                document.getElementById("time_slots").innerHTML = htmlSlotsOption;

                // console.log(slots_array);
            }
        };
        xmlhttp.open("GET", "includes/getSlots.php?date=" + date, true);
        xmlhttp.send();
    }
</script>