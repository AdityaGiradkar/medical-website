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

    <!-- Custom css File -->
    <link rel="stylesheet" href="css/index.css">

    <!-- for take test card -->
    <!-- <link rel="stylesheet" href="css/login.css"> -->

    <!-- SLider css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <title>login</title>
</head>

<body>
    <div class="main">

        <div class="container-fluid p-0 sticky-top">
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
        </div>

        <div class="intro pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-7">

                    </div>
                    <div class="col-5">
                        <img src="images/doctor.png" width="350" class="img-fluid d-block mx-auto" />
                    </div>
                </div>
            </div>
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
                        <p>
                            AtmaVeda Yog Pvt. Ltd. is an innovative one of its kind company around the glob which
                            invents
                            diagnostic tools based on yoga, runs clinics, manages hospitals, conducts research in yoga
                            and medicine, trains doctors and students in AtmaVeda Yog. It also involves in making
                            proprietary medical preparation.
                        </p>
                        <p>
                            It works for, Social sector, Corporate sector And is also open to work for governments
                            around the world in field of medicine, community screening, yoga therapies and education.
                        </p>
                        <a href="#" class="Explore-box">Explore</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pilars marginTop ">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="images/pilar1.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3">Chirayu</h5>
                        <p class="text-center mt-3">Life is meaningful when we have happiness, inner peace, strength &
                            worth
                            living long</p>
                    </div>
                    <div class="col-md-3">
                        <img src="images/pilar2.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3">Diet Pratyahara</h5>
                        <p class="text-center mt-3">Diet improve guna dharma, sanskar and yoganurup falaprapti cures
                            disease and give health.</p>
                    </div>
                    <div class="col-md-3">
                        <img src="images/pilar3.png" width="65px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3">Exercise Chiratarunya</h5>
                        <p class="text-center mt-3">Exercise healing disease giving arogya sampada & staying young
                            without aging is exercise chiratarunya</p>
                    </div>
                    <div class="col-md-3">
                        <img src="images/pilar4.png" width="52px" alt="" class="d-block mx-auto" />
                        <h5 class="text-center mt-3">Yodha's Nidaan</h5>
                        <p class="text-center mt-3">YODHAS diagnosesthe unknown root cause. know your dosha's prevent
                            and cure disease.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5 marginTop " id="consult">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/doctor.png" width="250" class="img-fluid" alt="Dr Sadanand photo" />
                    </div>
                    <div class="col-md-8">
                        <em>Consult</em>
                        <h4>Dr. Sadanand</h4>
                        <p>
                            ask your questions , doubts queries. know more of your medicine. know treatment options
                            available. know what you need to do in illness. know which is the right pathy or mode of
                            treatment for your disease.
                        </p>
                        <p>
                            have a non biased advice. discuss your symptom . disease ,
                            treatment and medicines.
                        </p>
                        <a data-target="#Appointment" data-toggle="modal" class="Explore-box">Book an
                            Appointment</a>
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
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease1" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">PURNA DIABETES CHIKITSA</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease2" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">HRUDAYASPARSH - CARDIAC CARE PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease3" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">HORMONE CORRECTION PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease4" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">JOINT HEALING PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease5" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">SPINE STRENGHTENING PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease6" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">STRI ROG CHIKITSA</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease7" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">LIV STRONG</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease8" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">STOMACH-HEAL THE FIRE</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease9" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">COLON</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease10" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">BREATHE NORMAL PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease11" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">BLOOD DISORDER TREATMENT</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease12" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">CANCER THERPAY - THERAPEUTIC OR SUPPORTIVE</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease13" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">COVID 19 MANAGEMENT PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#disease14" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="h6 post-title text-center">CHRONIC DISEASE MANAGEMENT PROGRAME</h6>
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
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet1" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">WEIGHT LOSS PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet2" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">ANTI AGING PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet3" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">STRESS MANAGEMENT PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet4" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">WEIGHT GAIN PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet5" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">ANTI TANNING PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet6" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">RELAXATION PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet7" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">MUSCLE GAIN PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet8" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">FAIR ANND GLOW PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet9" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">SUPER FITNESS PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet10" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">FIGURE MANAGEMENT PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet11" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">PERSONALITY DEVELOPMENT PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet12" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">DIET MANAGEMENT PROGRAMME</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#diet13" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">SHAPE UP CURVES</h5>
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
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga1" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Basic yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga2" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Fitness yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga3" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Relaxation yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga4" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Combo yoga</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga5" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Atmanubuti yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga6" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Sparsha yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga7" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Ashtang yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga8" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Hath yog</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-slide">
                                        <div class="card mx-auto" style="width: 12rem; border-radius: 12px;">
                                            <div class="contain">
                                                <img src="images/Rectangle 19 copy.png" class="card-img-top image"
                                                    alt="...">
                                                <div class="overlay-img">
                                                    <a data-target="#yoga9" data-toggle="modal"
                                                        class="explore" title="User Profile">
                                                        Explore
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="h6 post-title text-center">Power yoga</h5>
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
                    <div class="col-md-9" style="color: white;">
                        <h3>Diagnose at your home with <b>Yodha's Nidaan</b></h3>
                        <p><span>Sed ut perspiciatis</span> unde
                            omnis iste natus error sit voluptatem
                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                            omnis iste natus error sit voluptatem
                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                            omnis iste natus error sit voluptatem
                            accusantium doloremque laudantium.
                        </p>
                        <a href="#" data-target="#select_test" data-toggle="modal" class="take-test">Take The Test</a>
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

                                        <p><span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mr. Narendra </b><br>
                                            <em><small>State Government Officier</small></em>
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

                                        <p><span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mr. Narendra </b><br>
                                            <em><small>State Government Officier</small></em>
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

                                        <p><span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium. <span>Sed ut perspiciatis</span> unde
                                            omnis iste natus error sit voluptatem
                                            accusantium doloremque laudantium.
                                        </p>
                                        <p style="padding-left: 200px;"><b>- Mr. Narendra </b><br>
                                            <em><small>State Government Officier</small></em>
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
        <div class="blogs paddingTobBottom" style="margin-top: 405px;  background-color: rgb(249, 250, 255);">
            <div class="container">
                <h2 class="text-center">Blogs</h2>
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
                                        <h5 class="post-title text-center">
                                            <a href="<?php echo $all_blogs_res['blog_link']; ?>" target="_blank"
                                                title="User Profile">
                                                <?php echo $all_blogs_res['blog_name']; ?>
                                            </a>
                                        </h5>
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

        <div class="bg-dark" style="padding:1%; color:white;">
            <h6 class="text-center">&copy; 2020 by AtmaVeda Yog Pvt. Ltd.</h6>
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
                                value="1">
                            <label class="form-check-label" for="consult_type1">
                                General Consultation
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="General Consultation" data-content="Some nice text hereknjfsdb"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type2"
                                value="2">
                            <label class="form-check-label" for="consult_type2">
                                Holistic Pre-program Counselling
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="Holistic Pre-program Counselling" data-content="Some nice text hereknjfsdb"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="consult_type" id="consult_type3"
                                value="3">
                            <label class="form-check-label" for="consult_type3">
                                Advanced Holistic Consultation
                            </label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="Advanced Holistic Consultation" data-content="Some nice text hereknjfsdb"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-group mt-5 mb-4">
                            <!-- <label for="exampleInputEmail1">Username</label> -->
                            <input type="date" class="form-control input-box" name="consult_date"
                                onchange="availableSlots(this.value)" id="datepicker" min="<?php echo date("Y-m-d"); ?>"
                                max="<?php echo $maxDate['maxDate']; ?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control input-box" id="time_slots" name="time_slots">
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
                            <input class="form-check-input" type="radio" name="test_type" id="test_type1" value="1">
                            <label class="form-check-label" for="test_type1">YodhaE TEST</label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="General Consultation" data-content="Some nice text hereknjfsdb"><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="test_type" id="test_type2" value="2">
                            <label class="form-check-label" for="test_type2">YogE@HOME</label>
                            <a tabindex="0" class="info-btn" data-toggle="popover" data-trigger="focus"
                                title="YogE @ HOME"
                                data-content="Vital parameters and measurements give an instant insight in to the condition of the patient. Our application helps to manage the simple ,moderate and critical cases at home or under domicillary hospitalization or in hospitals. It is a helping hand of a doctor 24hr round the clock.  it helps in disease staging . disease prognosis, disease diagnosis, treatment response, detecting alarm signs etc."><i
                                    class="fas fa-info-circle"></i></a>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="radio" name="test_type" id="test_type3" value="3">
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

    // Php for taking test
    if(isset($_POST['start_test'])){
        if(isset($_SESSION['user_id'])){
            $test_type = $_POST['test_type'];
            if($test_type == 1){
                echo "<script>window.location.href='test1.php'</script>";
            }else if($test_type == 2){
                echo "<script>window.location.href='YogE_HOME.php'</script>";
            }else if($test_type == 3){
                echo "<script>window.location.href='test3.php'</script>";
            } 
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


    function availableSlots(date) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var slots_array = JSON.parse(this.responseText);
                var htmlSlotsOption = "<option selected='true' disabled='disabled' hidden>Select Time</option>";

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