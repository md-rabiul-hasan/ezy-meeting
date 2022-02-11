<?php include 'database_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Document Title -->
    <title>Ezy Meeting</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="landing-assets/fav.png">

    <!-- CSS Files -->
    <!--==== Google Fonts ====-->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">


    <!--==== Bootstrap css file ====-->
    <link rel="stylesheet" href="landing-assets/css/bootstrap.min.css">

    <!--==== Font-Awesome css file ====-->
    <link rel="stylesheet" href="landing-assets/css/font-awesome.min.css">

    <!-- Owl Carusel css file -->
    <link rel="stylesheet" href="landing-assets/plugins/owl-carousel/owl.carousel.min.css">

    <!-- ====video poppu css==== -->
    <link rel="stylesheet" href="landing-assets/plugins/Magnific-Popup/magnific-popup.css">

    <!--==== Style css file ====-->
    <link rel="stylesheet" href="landing-assets/css/style.css">

    <!--==== Responsive css file ====-->
    <link rel="stylesheet" href="landing-assets/css/responsive.css">

    <!--==== Custom css file ====-->
    <link rel="stylesheet" href="landing-assets/css/custom.css">
</head>

<body>
<!-- Preloader -->
<div class="preLoader">
    <div class="preload-inner">
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
        </div>
    </div>
</div>
<!-- End Of Preloader -->

<!-- Main header -->
<header class="header">
    <!-- Start Header Navbar-->
    <div class="main-header">
        <div class="main-menu-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index-2.html">
                                <img  src="landing-assets/logo.png" data-rjs="2" alt="jironis" style="height:76px;" >
                            </a>
                        </div>
                        <!-- End of Logo -->
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-4 col-6 menu-button">
                        <div class="menu--inner-area clearfix">
                            <div class="menu-wraper">
                                <nav>
                                    <!-- Header-menu -->
                                    <div class="header-menu dosis">
                                        <ul>
                                            <li class="active"><a href="index.php">Home</a>
                                            </li>
                                            <li><a href="#features">Features</a></li>
                                            <li><a href="#app">App Screens</a></li>
                                            <li><a href="#pricing  ">Pricing</a></li>

                                            <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                                        </ul>
                                    </div>
                                    <!-- End of Header-menu -->
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5 d-md-block d-none">
                        <div class="urgent-call text-right">
                            <a href="#" class="btn">Demo Version</a>
                        </div>


                        <!-- Modal -->
                        <div id="loginModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="logo">
                                        <img src="landing-assets/logo.png" alt="" />
                                    </div>
                                    <div class="modal-body">
                                        <form action="">

                                            <div class="form-group">
                                                <label for="email">Email address:</label>
                                                <input type="email" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Password:</label>
                                                <input type="password" class="form-control" />
                                            </div>
                                            <div class="form-group mt30">
                                                <button type="submit" class="btn btn-default">Login</button>
                                            </div>
                                        </form>
                                        <div class="form-group mt30 text-right">
                                            Dont Have an account? <a href="#"  data-toggle="modal" data-target="#registerModal" class="reg">Register Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="registerModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="logo">
                                        <img src="landing-assets/logo.png" alt="" />
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="form-group">
                                                <label for="email">Company Name:</label>
                                                <input type="text" class="form-control"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address:</label>
                                                <input type="email" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">Password:</label>
                                                <input type="password" class="form-control" />
                                            </div>
                                            <div class="form-group mt30">
                                                <button type="submit" class="btn btn-default">Submit</button>
                                            </div>
                                        </form>
                                        <div class="form-group mt30 text-right">
                                            Have an account <a href="#" data-toggle="modal" data-target="#loginModal" class="log">Login Here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Navbar-->
</header>
<!-- End of Main header -->

<!-- home banner area -->
<div class="banner-area-inner">
    <div class="banner-inner-area banner-area1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-6 col-xl-5">
                    <!-- banner text -->
                    <div class="banner-text-inner">
                        <div class="banner-shape-wrap">
                            <div class="banner-shape-inner">
                                <img src="landing-assets/img/banner/shaps1.png" alt="" class='shape shape1 rotate3d'>
                                <img src="landing-assets/img/banner/shaps2.png" alt="" class='shape shape2 rotate2d'>
                                <img src="landing-assets/img/banner/shaps3.png" alt="" class='shape shape3 rotate-2d'>
                                <img src="landing-assets/img/banner/shaps4.png" alt="" class='shape shape4 rotate3d'>
                                <img src="landing-assets/img/banner/shaps5.png" alt="" class='shape shape5 rotate2d'>
                                <img src="landing-assets/img/banner/shaps6.png" alt="" class='shape shape6 rotate-2d'>
                                <img src="landing-assets/img/banner/shaps7.png" alt="" class='shape shape7 rotate3d'>
                            </div>
                        </div>

                        <h1>Jironis is for your internet app business</h1>
                        <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit lorem ipsum anim id est laborum perspiciatis unde.</p>
                        <a href="#" class="btn">Registration</a>

                    </div>
                    <!-- banner text -->
                </div>
                <div class="col-lg-7  col-md-5 offse-xl-2">
                    <!-- banner image-->
                    <div class="banner-image">
                        <img src="landing-assets/img/macbook.png" alt="">
                    </div>
                    <!--End of banner image-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of home banner area -->

<!-- feature area -->
<section class="pb-110" id='features'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <!-- section title -->
                <div class="section-title text-center">
                    <?php
                    $banner_sql="SELECT * FROM `banner_info` WHERE `id`=1" ;
                    $query=mysqli_query($connect, $banner_sql);
                    $banner=mysqli_fetch_array($query);
                    ?>
                    <h2><?php echo $banner['title']; ?></h2>
                    <p><?php echo $banner['description']; ?></p>
                </div>
                <!-- End of section title -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="feature-carousel owl-carousel">
                    <?php
                    $sql = "SELECT *  FROM features";
                    $query = mysqli_query($connect, $sql);
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <!-- single feature inner -->
                        <div class="single-feature-inner text-center">
                            <div class="feature-icon"><img src="landing-assets/icons/<?php echo $data['icon']; ?>" class="svg" alt=""></div>
                            <h5><?php echo $data['title']; ?></h5>
                            <p><?php echo $data['description']; ?></p>
                        </div>
                        <!-- End of single feature inner -->
                    <?php } ?>
                </div><!--/.feature-carousel-->
            </div><!--/.col-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!-- End of feature area -->

<?php
$sql1 = "SELECT *  FROM web_sections";
$query1 = mysqli_query($connect, $sql1);
$num = 0;
$class = "";
$counter=1;
while ($row = mysqli_fetch_array($query1)){
    $num=$counter;
    if($num % 2 == 0){ ?>
        <!-- interact user -->
        <section class="pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-5">
                        <!-- user ineract text -->
                        <div class="user-interact-inner">
                            <div class="interact-icon">
                                <img src="landing-assets/section/<?php echo $row['icon'] ?>" class="svg" alt="">
                            </div>
                            <h2><?php echo $row['title'] ?></h2>
                            <?php echo $row['summary_info'] ?>
                            <a href="#" class="btn">Get Started</a>
                        </div>
                        <!--End of user ineract text -->
                    </div>
                    <div class="col-lg-7 col-sm-7">
                        <!-- user interact image -->
                        <div class="user-interact-image type2">
                            <img src="landing-assets/section/<?php echo $row['image'] ?>"  alt="">
                        </div>
                        <!-- End of user interact image -->
                    </div>
                </div>
            </div>
        </section>
        <!-- interact user -->


    <?php   }else{ ?>
        <!-- interact user -->
        <section class="bg-2 pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-7">
                        <!-- user interact image -->
                        <div class="user-interact-image">
                            <img src="landing-assets/section/<?php echo $row['image'] ?>" class="svg" alt="">
                        </div>
                        <!-- End of user interact image -->
                    </div>
                    <div class="col-lg-5 col-sm-5">
                        <!-- user ineract text -->
                        <div class="user-interact-inner">
                            <div class="interact-icon">
                                <img src="landing-assets/section/<?php echo $row['icon'] ?>"  alt="">
                            </div>
                            <h2><?php echo $row['title'] ?></h2>
                            <?php echo $row['summary_info'] ?>
                            <a href="#" class="btn">Get Started</a>
                        </div>
                        <!--End of user ineract text -->
                    </div>
                </div>
            </div>
        </section>
        <!-- interact user -->
    <?php  }
    $counter++;
}
?>





<!-- app video -->
<section class="app-video">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- why bottle video -->
                <div class="theme-video-wrap">
                    <a href="https://www.youtube.com/watch?v=SZEflIVnhH8" class="video-btn" data-popup="video"><i class="fa fa-play"></i></a>
                </div>
                <!-- end of why bottle video -->
            </div>
        </div>
    </div>
</section>
<!-- End of why bottol water -->

<!-- app screen -->
<section class="pt-120 pb-115" id='app'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <!-- section title -->
                <div class="section-title text-center">
                    <h2>Jironis App Screens</h2>
                    <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit lorem ipsum anim id est laborum perspiciatis unde.</p>
                </div>
                <!-- End of section title -->
            </div>
        </div>
    </div>
    <div class="app-scrin-inner">
        <div class="app-carousel-inner">
            <div class="app-carousel owl-carousel">
                <?php
                $sql1 = "SELECT *  FROM app_screen";
                $query1 = mysqli_query($connect, $sql1);
                while ($screen = mysqli_fetch_array($query1)) {
                    ?>
                    <!-- slingle app image -->
                    <div class="single-app-image">
                        <img src="landing-assets/app-screen/<?php echo $screen['image']; ?>" data-rjs="2" alt="">
                    </div>

                <?php } ?>


            </div>
        </div>
    </div>
</section>
<!-- End of app screen -->

<!-- app pricing plan -->
<section class="pb-90" id='pricing'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <!-- section title -->
                <div class="section-title text-center">
                    <h2>Choose Plans & Pricing</h2>
                    <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt    mollit lorem ipsum anim id est laborum perspiciatis unde.</p>
                </div>
                <!-- End of section title -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="price-nav-wrap">
                    <!-- price nav -->
                    <div class="price--nav-inner">
                        <nav>
                            <div class="nav info-tabs">
                                <a class="price--nav-item active" id="nav-contact-tab" data-toggle="tab" href="#month">Monthly</a>
                                <a class="price--nav-item" data-toggle="tab" href="#year">Yearly</a>
                            </div>
                        </nav>
                    </div>
                    <!-- End of price nav -->
                </div>
                <!-- nav tab content -->
                <div class="tab-content price-content">
                    <div class="tab-pane fade active show" id="month" role="tabpanel">
                        <div class="row">
                            <?php
                            $package_sql = "SELECT *  FROM package_info where display_status=1 and subscription_type=1";
                            $package_query = mysqli_query($connect, $package_sql);
                            while ($package = mysqli_fetch_array($package_query)) {
                                ?>

                                <div class="col-md-6 col-lg-4">
                                    <!--Single price plan -->
                                    <div class="single-price-plan text-center">
                                        <div class="single-price-top">
                                            <h4><?php echo $package['package_title']; ?></h4>
                                            <span><?php echo "৳".$package['package_price_bdt']." / $".$package['package_price_usd'].""; ?></span>
                                        </div>
                                        <div class="single-price-body">
                                            <div class="price-list">
                                                <ul>
                                                    <li>
                                                        <span><i class="<?php if($package['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Super admin:  <?php print $package['super_admin'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Committee member: <?php print $package['committee_member'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Number of Committee: <?php print $package['number_of_committee'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Subscription type: <?php print 'Monthly';?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['audio_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Audio calling feature: <?php if($package['audio_calling']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Video calling feature:   <?php if($package['video_calling']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Members individual chat feature:   <?php if($package['individual_chat']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Multiple meeting feature:   <?php if($package['multiple_meeting']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Total document storage size: <?php print $package['storage'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Payment Method: <?php print $package['payment_method'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                        Package price: <?php echo "৳".$package['package_price_bdt']." / $".$package['package_price_usd'].""; ?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Transaction charge: <?php print $package['transaction_charge'];?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="#" class="btn">Get Started</a>
                                        </div>
                                    </div>
                                    <!--end of Single price plan -->
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="year" role="tabpanel">
                        <div class="row">
                            <?php
                            $package_sql1 = "SELECT *  FROM package_info where display_status=1 and subscription_type=2";
                            $package_query1 = mysqli_query($connect, $package_sql1);
                            while ($package1 = mysqli_fetch_array($package_query1)) {
                                ?>

                                <div class="col-md-6 col-lg-4">
                                    <!--Single price plan -->
                                    <div class="single-price-plan text-center">
                                        <div class="single-price-top">
                                            <h4><?php echo $package1['package_title']; ?></h4>
                                            <span><?php echo "৳".$package1['package_price_bdt']." / $".$package1['package_price_usd'].""; ?></span>
                                        </div>
                                        <div class="single-price-body">
                                            <div class="price-list">
                                                <ul>
                                                    <li>
                                                        <span><i class="<?php if($package1['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Super admin:  <?php print $package1['super_admin'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Committee member: <?php print $package1['committee_member'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Number of Committee: <?php print $package1['number_of_committee'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Subscription type: <?php print 'Yearly';?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['audio_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Audio calling feature: <?php if($package1['audio_calling']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Video calling feature:   <?php if($package1['video_calling']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Members individual chat feature:   <?php if($package1['individual_chat']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Multiple meeting feature:   <?php if($package1['multiple_meeting']==0) print "NO";else print "YES";?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Total document storage size: <?php print $package1['storage'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Payment Method: <?php print $package1['payment_method'];?>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                        Package price: <?php echo "৳".$package1['package_price_bdt']." / $".$package1['package_price_usd'].""; ?>
                                                    </li>
                                                    <li>
                                                        <span><i class="<?php if($package1['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        Transaction charge: <?php print $package1['transaction_charge'];?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a href="#" class="btn">Get Started</a>
                                        </div>
                                    </div>

                                    <
                                    <!--end of Single price plan -->
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End of nav tab content -->

            </div>
        </div>
    </div>
</section>
<!-- End of app pricing plan -->

<!-- testimonial area -->

<!--End of testimonial area -->

<!-- our partner -->
<!--    <section class="pt-120 pb-120">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                      partner carosel inner -->
<!--                    <div class="partner-carousel-wrap">-->
<!--                        <div class="partner-carousel owl-carousel">-->
<!--                              single partner -->
<!--                            <div class="single-partner">-->
<!--                                <img src="landing-assets/img/partner2.png" alt="">-->
<!--                            </div>-->
<!--                             End of single partner -->
<!--    -->
<!--                           single partner -->
<!--                            <div class="single-partner">-->
<!--                                <img src="landing-assets/img/partner2.png" alt="">-->
<!--                            </div>-->
<!--                             End of single partner -->
<!--    -->
<!--                              single partner -->
<!--                            <div class="single-partner">-->
<!--                                <img src="landing-assets/img/partner2.png" alt="">-->
<!--                            </div>-->
<!--                            End of single partner -->
<!--    -->
<!--                          single partner -->
<!--                            <div class="single-partner">-->
<!--                                <img src="landing-assets/img/partner2.png" alt="">-->
<!--                            </div>-->
<!--                              End of single partner -->
<!--                        </div>-->
<!--                    </div>-->
<!--                     End of  partner carosel inner -->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!-- End of our partner -->

<!-- start blog area -->
<section class="border-top pt-115 pb-80" id='blog' style="display: none;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <!-- section title -->
                <div class="section-title text-center">
                    <h2>Our News & Articles</h2>
                    <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt    mollit lorem ipsum anim id est laborum perspiciatis unde.</p>
                </div>
                <!-- End of section title -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <!-- single blog inner -->
                <div class="single-blog-inner">
                    <!-- blog image -->
                    <div class="post-image">
                        <a href="blog-details.html">
                            <img src="landing-assets/img/blog/blog1.png" alt="">
                        </a>
                        <div class="post-date">
                            <p><span>30</span>Sep</p>
                        </div>
                    </div>
                    <!--/.End of  blog image -->

                    <!-- post content -->
                    <div class="post-content">
                        <div class="post-details">
                            <div class="post-info d-flex">
                                <a href="#"><span>By</span>Admin</a>
                                <a href="#"><span>1</span> Comment</a>
                            </div>

                            <div class="post-title">
                                <h3><a href="blog-details.html">Pre and Post Launch Mobile App Marketing Pitfalls to Avoid</a></h3>
                            </div>
                            <p>There are many variations of passages of available but majority have alteration in some by inject humour or random
                                words.</p>
                            <a class='blog-btn' href="blog-details.html">Read More</a>
                        </div>
                    </div><!-- /.End of post content -->
                </div><!-- /.End of single blog inner -->
            </div>

            <div class="col-lg-4 col-md-4">
                <!-- single blog inner -->
                <div class="single-blog-inner">
                    <!-- blog image -->
                    <div class="post-image">
                        <a href="blog-details.html">
                            <img src="landing-assets/img/blog/blog2.png" alt="">
                        </a>
                        <div class="post-date">
                            <p><span>11</span>Sep</p>
                        </div>
                    </div>
                    <!--/.End of  blog image -->

                    <!-- post content -->
                    <div class="post-content">
                        <div class="post-details">
                            <div class="post-info d-flex">
                                <a href="#"><span>By</span>Admin</a>
                                <a href="#"><span>2</span> Comments</a>
                            </div>

                            <div class="post-title">
                                <h3><a href="blog-details.html">Nascetur Etiam tempus sit amet vestibulum quis variations.</a></h3>
                            </div>
                            <p>There are many variations of passages of available but majority have alteration in some by inject
                                humour or random
                                words.</p>
                            <a class='blog-btn' href="blog-details.html">Read More</a>
                        </div>
                    </div><!-- /.End of post content -->
                </div><!-- /.End of single blog inner -->
            </div>

            <div class="col-lg-4 col-md-4">
                <!-- single blog inner -->
                <div class="single-blog-inner">
                    <!-- blog image -->
                    <div class="post-image">
                        <a href="blog-details.html">
                            <img src="landing-assets/img/blog/blog3.png" alt="">
                        </a>
                        <div class="post-date">
                            <p><span>20</span>Nov</p>
                        </div>
                    </div>
                    <!--/.End of  blog image -->

                    <!-- post content -->
                    <div class="post-content">
                        <div class="post-details">
                            <div class="post-info d-flex">
                                <a href="#"><span>By</span>Admin</a>
                                <a href="#"><span>5</span> Comments</a>
                            </div>

                            <div class="post-title">
                                <h3><a href="blog-details.html">It is a long established fact that and reader will be distracted.</a></h3>
                            </div>
                            <p>There are many variations of passages of available but majority have alteration in some by inject
                                humour or random
                                words.</p>
                            <a class='blog-btn' href="blog-details.html">Read More</a>
                        </div>
                    </div><!-- /.End of post content -->
                </div><!-- /.End of single blog inner -->
            </div>
        </div>
    </div>
</section>
<!-- end of blog artea -->

<!-- download app -->
<section class="border-top pt-110 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="download-app-inner text-center">
                    <h2 class="h1">
                        Download our App Today &<br>
                        Experience Endless Possibilities.
                    </h2>
                    <h3>and get started with a free 1 month trial for your business</h3>
                    <a href="#" class="btn">Download App</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of download app -->

<footer class="footer">
    <div class="footerbg">
        <img src="landing-assets/img/footer-bg.png" alt="">
    </div>
    <div class="footer-top pt-120 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <!-- footer widget -->
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index-2.html"><img src="landing-assets/logo.png" alt=""></a>
                        </div>
                        <p>Lorem ipsum dolor sit ame consy ect etur adipisc de elit. Quisque act raqum nunc no dolor sit de
                            amet.</p>
                        <!-- footer social area -->
                        <div class="footer-social-area">
                            <ul class="social-icons social-icons-light nav">
                                <li><a href="#" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <!-- End of footer social area -->
                    </div>
                    <!--End of footer widget -->
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <!-- widget header -->
                        <div class="widget-header">
                            <h5>Our Address</h5>
                        </div>
                        <!-- widget header -->
                        <div class="widget-body">
                            <ul class="address-list">
                                <li>
                                    <span><i class="fa  fa-phone-square"></i></span>
                                    888 999 0000
                                </li>
                                <li>
                                    <span><i class="fa  fa-envelope"></i></span>
                                    needhelp@jironis.com
                                </li>
                                <li>
                                    <span><i class="fa  fa-map"></i></span>
                                    855 road, broklyn street,
                                    new york 600
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <!-- widget header -->
                        <div class="widget-header">
                            <h5>Extra Links</h5>
                        </div>
                        <!-- widget header -->
                    </div>

                    <div class="widget-body">
                        <div class="extra-link">
                            <div class="link-left">
                                <ul>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Our Team</a></li>
                                    <li><a href="#">Features</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">How It Works</a></li>
                                </ul>
                            </div>
                            <div class="link-right">
                                <ul>
                                    <li><a href="#">Help</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="#">Clients</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="widget-body">
                            <div class="twetter-post-inner">
                                <div class="footer-post-details">
                                    @Layerdrops Take your web design to new heights with jironix. <br><a href="">http://yhdj58.tp8/JK</a>
                                </div>
                                <div class="twetter-post">
                                    <span><i class="fa fa-twitter"></i></span>
                                    Jironis - Nov 23, 2018
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-text text-center">
            <p>© copyright 2019 by Layerdrops.com</p>
        </div>
    </div>

</footer>

<!-- back to top -->
<div class="back-to-top">
    <a href="#"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- back to top -->


<!-- JS Files -->
<!-- ==== JQuery 3.3.1 js file==== -->
<script src="landing-assets/js/jquery-3.3.1.min.js"></script>

<!-- ==== Bootstrap js file==== -->
<script src="landing-assets/js/bootstrap.bundle.min.js"></script>

<!-- ==== JQuery Waypoint js file==== -->
<script src="landing-assets/plugins/waypoints/jquery.waypoints.min.js"></script>

<!-- ==== Parsley js file==== -->
<script src="landing-assets/plugins/parsley/parsley.min.js"></script>

<!-- ==== parallax js==== -->
<script src="landing-assets/plugins/parallax/parallax.js"></script>

<!-- ==== Owl Carousel js file==== -->
<script src="landing-assets/plugins/owl-carousel/owl.carousel.min.js"></script>

<!-- ==== Menu  js file==== -->
<script src="landing-assets/js/menu.min.js"></script>

<!-- ===video popup=== -->
<script src="landing-assets/plugins/Magnific-Popup/jquery.magnific-popup.min.js"></script>

<!-- ====Counter js file=== -->
<script src="landing-assets/plugins/waypoints/jquery.counterup.min.js"></script>

<!-- ==== Script js file==== -->
<script src="landing-assets/js/scripts.js"></script>

<!-- ==== Custom js file==== -->
<script src="landing-assets/js/custom.js"></script>
<script>
    $('.log').click(function() {
        $('#registerModal').modal('hide');
    });
    $('.reg').click(function() {
        $('#loginModal').modal('hide');
    });
</script>

</body>
</html>