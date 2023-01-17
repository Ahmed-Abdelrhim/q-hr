<!DOCTYPE html>

<?php
// $logos = asset(Storage::url('uploads/logo/'));
$logos=\App\Models\Utility::get_file('uploads/logo/');

$company_favicon = Utility::getValByName('company_favicon');

$company_logo = App\Models\Utility::get_superadmin_logo();
$footer_text = Utility::getValByName('footer_text');
$SITE_RTL=env('SITE_RTL');

$setting = App\Models\Utility::colorset();
$mode_setting = App\Models\Utility::mode_layout();
$color = 'theme-3';
if (!empty($mode_setting['theme_color'])) {
    $color = $mode_setting['theme_color'];
}

?>

<html lang="en">
<html dir="<?php echo e(env('SITE_RTL') == 'on' ? 'rtl' : ''); ?>">

<head>
    
    <title>
        <?php echo e(App\Models\Utility::getValByName('title_text') ? App\Models\Utility::getValByName('title_text') : config('app.name', 'HRMGO ')); ?>

    </title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />

    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e(asset(Storage::url('uploads/logo')) . '/favicon.png'); ?>" type="image/x-icon" />

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>" />
    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

    <!-- vendor css -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/landing.css')); ?>" />


    <?php if(env('SITE_RTL') == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>">
    <?php endif; ?>
     <?php if(isset($mode_setting['dark_mode']) && $mode_setting['dark_mode'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <?php endif; ?>


</head>

<body class="<?php echo e($color); ?>">
    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-dark default top-nav-collapse">
        <div class="container">
            <a class="navbar-brand bg-transparent" href="#">
                
                
                <img src="<?php echo e($logos . '/' . 'light_logo.png'); ?>" style="width: 30% !important;" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#layouts">Layouts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonial">Testimonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">Faq</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="btn btn-light ms-2 me-1" href="<?php echo e(route('login')); ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Nav ] start -->
    <!-- [ Header ] start -->
    <header id="home" class="bg-primary">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm-5">
                    <h1 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        <?php echo e(__('Q-HRM')); ?>

                    </h1>
                    <h2 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <!--<div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-light me-2"><i class="far fa-eye me-2"></i>Live
                            Demo</a>
                        <a href="https://codecanyon.net/item/hrmgo-hrm-and-payroll-tool/25982864"
                            class="btn btn-outline-light" target="_blank"><i class="fas fa-shopping-cart me-2"></i>Buy
                            now</a>
                    </div>-->
                </div>
                <div class="col-sm-5">
                    <img src="<?php echo e(asset('assets/images/front/header-mokeup.svg')); ?>" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
        </div>
    </header>
    <!-- [ Header ] End -->
    <!-- [ client ] Start -->
    <section id="dashboard" class="theme-alt-bg dashboard-block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2><span>Happy clients use Dashboard</span></h2>
                </div>
            </div>
            <div class="row align-items-center justify-content-center mb-5 mobile-screen">
                <div class="col-auto">
                    
                    <img src="<?php echo e($logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                        alt="" class="img-fluid" />
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.4s">
                        
                        <img src="<?php echo e($logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.6s">
                        
                        <img src="<?php echo e($logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="0.8s">
                        
                        <img src="<?php echo e($logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                            alt="" class="img-fluid" />
                    </div>
                </div>
                <div class="col-auto">
                    <div class="wow animate__fadeInRight mobile-widget" data-wow-delay="1s">
                        
                        <img src="<?php echo e($logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                            alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
            <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>" alt=""
                class="img-fluid img-dashboard wow animate__fadeInUp" data-wow-delay="0.2s"
                style="border-radius: 15px;" />
        </div>
    </section>
    <!-- [ client ] End -->
    <!-- [ dashboard ] start -->
    <section class="">
        <div class="container">
            <div class="row align-items-center justify-content-end mb-5">
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        Q-HRM
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <!--<div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i class="fas fa-shopping-cart me-2"></i>Buy
                            now</a>
                    </div>-->
                </div>
                <div class="col-sm-6">
                    <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
            <div class="row align-items-center justify-content-start">
                <div class="col-sm-6">
                    <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInLeft" data-wow-delay="0.2s" />
                </div>
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInRight" data-wow-delay="0.2s">
                        Q-HRM
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <!--<div class="my-4 wow animate__fadeInRight" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i class="fas fa-shopping-cart me-2"></i>Buy
                            now</a>
                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    <!-- [ feature ] start -->
    <section id="feature" class="feature">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2>
                        <span class="d-block mb-3">Features</span> All in one place CRM
                        system
                    </h2>
                    <p class="m-0">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.2s" style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-home"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.4s" style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-success">
                                <i class="ti ti-user-plus"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.6s" style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-users"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card wow animate__fadeInUp" data-wow-delay="0.8s" style="
                visibility: visible;
                animation-delay: 0.2s;
                animation-name: fadeInUp;
              ">
                        <div class="card-body">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-report-money"></i>
                            </div>
                            <h6 class="text-muted mt-4">ABOUT</h6>
                            <h4 class="my-3 f-w-600">Feature</h4>
                            <p class="mb-0">
                                Use these awesome forms to login or create new account in your
                                project for free.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="text-center pt-sm-5 feature-mobile-screen">
                <button class="btn px-sm-5 btn-primary me-sm-3">Buy Now</button>
                <button class="btn px-sm-5 btn-outline-primary">
                    View documentation
                </button>
            </div>-->
        </div>
    </section>
    <!-- [ feature ] End -->
    <!-- [ dashboard ] start -->
    <section class="">
        <div class="container">
            <div class="row align-items-center justify-content-end mb-5">
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        Q-HRM
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <!--<div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy now</a>
                    </div>-->
                </div>
                <div class="col-sm-6">
                    <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
            <div class="row align-items-center justify-content-start">
                <div class="col-sm-6">
                    <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInLeft" data-wow-delay="0.2s" />
                </div>
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInRight" data-wow-delay="0.2s">
                        Q-HRM
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <!--<div class="my-4 wow animate__fadeInRight" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy now</a>
                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    <!-- [ price ] start -->
    
    <!-- [ price ] End -->
    <!-- [ faq ] start -->
    <section class="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2><span>Frequently Asked Questions</span></h2>
                    <p class="m-0">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10 col-xxl-8">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> How do I
                                        order?
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It
                                    is shown by default, until the collapse plugin adds the
                                    appropriate classes that we use to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> How do I
                                        order?
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong>
                                    It is hidden by default, until the collapse plugin adds the
                                    appropriate classes that we use to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> How do I
                                        order?
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It
                                    is hidden by default, until the collapse plugin adds the
                                    appropriate classes that we use to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    It's also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ faq ] End -->
    <!-- [ dashboard ] start -->
    <section class="side-feature">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        Q-HRM
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        HRM and Payroll Tool
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Use these awesome forms to login or create new account in your
                        project for free.
                    </p>
                    <!--<div class="my-4 wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="#" class="btn btn-primary" target="_blank"><i
                                class="fas fa-shopping-cart me-2"></i>Buy now</a>
                    </div>-->
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                    <div class="row feature-img-row m-auto">
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.2s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-1.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.4s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-4.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.6s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-3.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.8s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-7.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.3s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-12.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.5s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-8.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.7s"
                                alt="Admin" />
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <img src="<?php echo e(asset('landing/hrmgo-pic-13.png')); ?>"
                                class="img-fluid header-img wow animate__fadeInRight mt-5" data-wow-delay="0.9s"
                                alt="Admin" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    <!-- [ dashboard ] start -->

    </section>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    
                    <img src="<?php echo e($logos . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png')); ?>"
                        alt="" class="img-fluid" />
                </div>
                <div class="col-lg-6 col-sm-12 text-end">

                    
                    <p class="text-body"> <?php echo e(__('Copyright')); ?>

                        <?php echo e(Utility::getValByName('footer_text') ? Utility::getValByName('footer_text') : config('app.name', 'Q-HRM SaaS')); ?>

                        <?php echo e(date('Y')); ?> | Design By Q-HRM </p>
                </div>
            </div>
        </div>

    </section>
    <!-- [ dashboard ] End -->
    <!-- Required Js -->
    <script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pages/wow.min.js')); ?>"></script>
    <script>
        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener("scroll", function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
            } else if (cOst > ost) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
                document.querySelector(".navbar").classList.remove("default");
            } else {
                document.querySelector(".navbar").classList.add("default");
                document
                    .querySelector(".navbar")
                    .classList.remove("top-nav-collapse");
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: "animate__animated", // animation css class (default is animated)
        });
        wow.init();
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: "#navbar-example",
        });
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\q-hr\resources\views/layouts/landing.blade.php ENDPATH**/ ?>