<?php  error_reporting(0); ?>
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

    <!--==== Bootstrap css file ====-->
    <link rel="stylesheet" href="landing-assets/css/bootstrap.min.css">

    <!--==== Font-Awesome css file ====-->
    <link rel="stylesheet" href="landing-assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="landing-assets/css/swiper.min.css">

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
                            <a href="index.php">
                                <img  src="landing-assets/logo.png" data-rjs="2" alt="jironis" style="max-height:76px;" >
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
                                            <li class="<?php if(basename($_SERVER['REQUEST_URI'])=='index.php') echo "active" ?>"><a href="index.php">Home</a>
                                            </li>

                                            <li><a href="#">About Us    <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-custom">
                                                <li><a href="#how"><i class="fa fa-angle-right pull-left"></i> How to Use</a></li>
                                                <li><a href="#who"><i class="fa fa-angle-right pull-left"></i> Who will Use</a></li>
                                                <li><a href="#why"><i class="fa fa-angle-right pull-left"></i> Why Will Use</a></li>

                                            </ul>
                                            </li>


                                            <li><a href="feature.php">Features</a></li>

                                            <li><a href="index.php#pricing">Package</a></li>

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
                            <a href="#" class="btn">Free Trial</a>
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
                <div class="col-md-8">
                    <!-- banner text -->
                    <div class="banner-text-inner">


                    </div>
                    <!-- banner text -->
                </div>
                <div class="   col-md-4 ">
                    <!-- banner image-->
                    <div class="banner-image">

                        <?php
                        $banner_info_sql = "SELECT *  FROM  banner_info";
                        $banner_query = mysqli_query($connect, $banner_info_sql);
                        $banner = mysqli_fetch_array($banner_query);
                        ?>
                        <h1>A new experience at  the meeting</h1>
                        <p style="margin-top: 10px;">EZYMEETING provides a 360 degree solution to simplify
                            and digitalize any meeting - with few  Keystrokes and
                            Clicks.
                            <br />
                            It reduces all the repetitive writing, printing, archiving
                            memo/minutes and saves cost, time and keeps track   of
                            every stage of meeting in digital manner.?
                        </p>


                        <a href="#" class="btn">Start Trial</a>
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
        <div class="row ">

            <div class="col-md-6">
                <img src="http://megaone.themesindustry.com/agency/img/vector-art-2.png"   class="img-responsive">
            </div>
            <div class="col-md-6 ">
                <div class="section-title fture ">
                    <p class="mb-1">FEATURES</p>
                    <h2><span>Ezy Meeting</span> is  for  your  business</h2>
                    <div class="f-list">
                        <div class="icon">
                            <img src="landing-assets/img/icons/ic3.png" alt="">
                        </div>
                        <div class="summary">
                            <h4>Calendar and Meeting Scheduler</h4>
                            <p> From gathering meeting data, tracking meetings, and viewing important documents, it's the only scheduler you'll be needing for your workplace.
                            </p>
                        </div>
                    </div>
                    <div class="f-list">
                        <div class="icon">
                            <img src="landing-assets/img/icons/ic2.png" alt="">
                        </div>
                        <div class="summary">
                            <h4>Dynamic Agenda Builder

                            </h4>
                            <p>The agenda builder helps the admin to create agendas quickly and smoothly with the help of the agenda template. The PDF agenda memos will be sync to the related committee members with just push of a button.

                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-12 mt-30 mb20" ></div>
            <div class="col-md-3 mt-30">
                <div class="box">
                    <img src="landing-assets/img/icons/ic7.png" width="70px" alt="">
                    <h5>Secure and Share Your Documents
                    </h5>
                    <p class="text-center">EzyMeeting is allowing the top-notch security for your valuable documents. Sync documents with your team members and never left out of any importance.

                    </p>
                </div>
            </div>
            <div class="col-md-3 mt-30">

                <div class="box">
                    <img src="landing-assets/img//icons/ic4.png" width="70px" alt="">
                    <h5>Voting and Discussion


                    </h5>
                    <p class="text-center">Your team members can now contribute and share their decision. The voting data will highlight the importance of the meeting.


                    </p>
                </div>
            </div>
            <div class="col-md-3 mt-30">
                <div class="box">
                    <img src="landing-assets/img//icons/ic8.png" width="70px" alt="">
                    <h5>Never Stay Behind


                    </h5>
                    <p class="text-center">Real-time notification from the system, email, and SMS meaning that you'll be up to date with all the information and schedules.


                    </p>
                </div>
            </div>
            <div class="col-md-3 mt-30">
                <div class="box">
                    <img src="landing-assets/img/icons/ic9.png" width="70px" alt="">
                    <h5>Easy to Use


                    </h5>
                    <p class="text-center">The user-friendly graphical interface allows you to navigate smoothly and quickly in times of need. Supports multiple devices and mobile app allows you the full freedom of mobility.




                    </p>
                </div>
            </div>



        </div>
        <div class="row justify-content-center" style="display:  none;">
            <div class="col-md-12 col-lg-8">
                <!-- section title -->
                <div class="section-title text-center">

                    <h2>Why <span>Ezy Meeting</span> is  for  your business</h2>
                    <p> Sync your Active Directory database to GoToMeeting to make your life simpler when managing large numbers of corporate users.</p>
                </div>
                <!-- End of section title -->
            </div>
        </div style>
        <div class="row justify-content-center" style="display: none">
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
        <section class="pt-120 pb-120" style="display: none;">
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
        <section class="bg-2 pt-120 pb-120" >
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


<section class="pb-90 pt-80" id='pricing'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8">
                <!-- section title -->
                <div class="section-title text-center">
                    <h2>  <span> Choose Package  </span> for Subscription</h2>
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
                                <a class="price--nav-item active" id="nav-contact-tab" data-toggle="tab" href="#all">All</a>
                                <a class="price--nav-item  " id="nav-contact-tab" data-toggle="tab" href="#month">Monthly</a>
                                <a class="price--nav-item" data-toggle="tab" href="#year">Yearly</a>
                            </div>
                        </nav>
                    </div>
                    <!-- End of price nav -->
                </div>
                <!-- nav tab content -->
                <div class="tab-content price-content">
                    <div class="tab-pane fade active show" id="all" role="tabpanel">

                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                $counter=1;
                                $package_sql1 = "SELECT *  FROM package_info where display_status=1  ";
                                $package_query1 = mysqli_query($connect, $package_sql1);
                                while ($package_monthly = mysqli_fetch_array($package_query1)) {
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_monthly['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_monthly['package_price_usd'] ?> / <?php echo $package_monthly['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_monthly['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_monthly['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_monthly['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_monthly['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_monthly['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_monthly['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_monthly['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_monthly['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_monthly['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_monthly['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_monthly['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_monthly['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>

                                <?php } ?>



                            </div>
                            <!-- Add Pagination -->

                        </div>
                        <div class="swiper-pagination"></div>
                        <div style="display: none;">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                        <?php
                                        $counter=1;
                                        $package_sql1 = "SELECT *  FROM package_info where display_status=1  ";
                                        $package_query1 = mysqli_query($connect, $package_sql1);
                                        while ($package_monthly = mysqli_fetch_array($package_query1)) {
                                            ?>

                                            <div class="col-sm-4">
                                                <div class="card text-center">
                                                    <div class="title">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                        <h2><?php echo $package_monthly['package_title'] ?></h2>
                                                    </div>
                                                    <div class="price">
                                                        <h4><sup>$</sup><?php echo $package_monthly['package_price_usd'] ?> / <?php echo $package_monthly['package_price_bdt'] ?>Tk</h4>
                                                    </div>
                                                    <div class="option">
                                                        <ul>
                                                            <li> <i class="fa <?php if($package_monthly['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['super_admin'];?></b> Super Admin </li>
                                                            <li> <i class="fa <?php if($package_monthly['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['committee_member'];?></b> Committee member </li>
                                                            <li> <i class="fa <?php if($package_monthly['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['number_of_committee'];?></b> Number of Committee</li>
                                                            <li> <i class="fa <?php if($package_monthly['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                            <li> <i class="fa <?php if($package_monthly['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?> </li>
                                                            <li> <i class="fa <?php if($package_monthly['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                            <li> <i class="fa <?php if($package_monthly['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_monthly['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                            <li> <i class="fa <?php if($package_monthly['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_monthly['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                            <li> <i class="fa <?php if($package_monthly['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_monthly['storage'];?></b> Total Storage size </li>
                                                            <li> <i class="fa <?php if($package_monthly['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_monthly['payment_method'];?></b></li>
                                                            <li> <i class="fa <?php if($package_monthly['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_monthly['transaction_charge'];?></b>  </li>

                                                        </ul>
                                                    </div>
                                                    <a href="#">Order Now </a>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <?php
                                            $counter=1;
                                            $package_sql1 = "SELECT *  FROM package_info where display_status=1  ";
                                            $package_query1 = mysqli_query($connect, $package_sql1);
                                            while ($package_monthly = mysqli_fetch_array($package_query1)) {
                                                ?>

                                                <div class="col-sm-4">
                                                    <div class="card text-center">
                                                        <div class="title">
                                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                            <h2><?php echo $package_monthly['package_title'] ?></h2>
                                                        </div>
                                                        <div class="price">
                                                            <h4><sup>$</sup><?php echo $package_monthly['package_price_usd'] ?> / <?php echo $package_monthly['package_price_bdt'] ?>Tk</h4>
                                                        </div>
                                                        <div class="option">
                                                            <ul>
                                                                <li> <i class="fa <?php if($package_monthly['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['super_admin'];?></b> Super Admin </li>
                                                                <li> <i class="fa <?php if($package_monthly['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['committee_member'];?></b> Committee member </li>
                                                                <li> <i class="fa <?php if($package_monthly['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['number_of_committee'];?></b> Number of Committee</li>
                                                                <li> <i class="fa <?php if($package_monthly['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                                <li> <i class="fa <?php if($package_monthly['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?> </li>
                                                                <li> <i class="fa <?php if($package_monthly['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                                <li> <i class="fa <?php if($package_monthly['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_monthly['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                                <li> <i class="fa <?php if($package_monthly['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_monthly['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                                <li> <i class="fa <?php if($package_monthly['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_monthly['storage'];?></b> Total Storage size </li>
                                                                <li> <i class="fa <?php if($package_monthly['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_monthly['payment_method'];?></b></li>
                                                                <li> <i class="fa <?php if($package_monthly['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_monthly['transaction_charge'];?></b>  </li>

                                                            </ul>
                                                        </div>
                                                        <a href="#">Order Now </a>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>

                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>

                                </a>
                            </div>
                            <!-- END Col three -->
                        </div>





                    </div>
                    <div class="tab-pane fade" id="month" role="tabpanel">

                        <div class="row">
                            <?php
                            $counter=1;
                            $package_sql1 = "SELECT *  FROM package_info where display_status=1 and subscription_type=1";
                            $package_query1 = mysqli_query($connect, $package_sql1);
                            while ($package_monthly = mysqli_fetch_array($package_query1)) {
                                ?>
                                <?php if($counter==1){ ?>
                                    <div class="col-sm-4">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_monthly['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_monthly['package_price_usd'] ?> / <?php echo $package_monthly['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_monthly['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_monthly['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_monthly['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_monthly['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_monthly['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_monthly['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_monthly['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_monthly['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_monthly['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_monthly['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_monthly['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_monthly['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>
                                    <!-- END Col one -->
                                <?php } ?>
                                <?php if($counter==2){ ?>
                                    <div class="col-sm-4">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_monthly['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_monthly['package_price_usd'] ?> / <?php echo $package_monthly['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_monthly['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_monthly['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_monthly['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_monthly['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_monthly['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_monthly['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_monthly['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_monthly['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_monthly['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_monthly['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_monthly['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_monthly['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- END Col two -->
                                <?php if($counter==3){ ?>
                                    <div class="col-sm-4">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_monthly['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_monthly['package_price_usd'] ?> / <?php echo $package_monthly['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_monthly['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_monthly['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_monthly['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_monthly['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_monthly['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_monthly['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_monthly['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_monthly['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_monthly['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_monthly['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_monthly['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_monthly['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_monthly['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_monthly['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_monthly['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_monthly['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- END Col three -->
                                <?php $counter++; } ?>
                        </div>




                        <div class="row" style="display: none;">
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
                                            <span><?php echo "?".$package['package_price_bdt']." / $".$package['package_price_usd'].""; ?></span>
                                        </div>
                                        <div class="single-price-body">
                                            <div class="price-list">
                                                <table class="table-responsive text-left">
                                                    <tbody>
                                                    <tr>
                                                        <td width="40px" class="text-center"> <span><i class="<?php if($package['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td>  Super admin:  </td>
                                                        <td class="text-center" width="100px"><?php print $package['super_admin'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><i class="<?php if($package['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td>Committee member: </td>
                                                        <td><?php print $package['committee_member'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><i class="<?php if($package['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td>Number of Committee: </td>
                                                        <td> <?php print $package['number_of_committee'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><i class="<?php if($package['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td>Subscription type: </td>
                                                        <td><?php print 'Monthly';?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><i class="<?php if($package['audio_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td>Audio calling feature:</td>
                                                        <td> <?php if($package['audio_calling']==0) print "NO";else print "YES";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><i class="<?php if($package['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td> Video calling feature:  </td>
                                                        <td>  <?php if($package['video_calling']==0) print "NO";else print "YES";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>  <span><i class="<?php if($package['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td>  Members individual chat feature:  </td>
                                                        <td>  <?php if($package['individual_chat']==0) print "NO";else print "YES";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>  <span><i class="<?php if($package['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td> Multiple meeting feature:  </td>
                                                        <td> <?php if($package['multiple_meeting']==0) print "NO";else print "YES";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>  <span><i class="<?php if($package['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td> Total document storage size:</td>
                                                        <td> <?php print $package['storage'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <span><i class="<?php if($package['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span></td>
                                                        <td> Payment Method: </td>
                                                        <td> <?php print $package['payment_method'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td> <span><i class="fa fa-check" aria-hidden="true"></i></span></td>
                                                        <td> Package price: </td>
                                                        <td>  <?php echo "?".$package['package_price_bdt']." / $".$package['package_price_usd'].""; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><i class="<?php if($package['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i></span>
                                                        </td>
                                                        <td> Transaction charge:</td>
                                                        <td><?php print $package['transaction_charge'];?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <a href="#" class="btn">Get Started</a>
                                        </div>
                                    </div>
                                    <!--end of Single price plan -->
                                </div>
                            <?php } ?>

                        </div styled style>
                    </div>
                    <div class="tab-pane fade" id="year" role="tabpanel">
                        <div class="row">
                            <?php
                            $counter=1;
                            $package_sql1 = "SELECT *  FROM package_info where display_status=1 and subscription_type=2";
                            $package_query1 = mysqli_query($connect, $package_sql1);
                            while ($package_year = mysqli_fetch_array($package_query1)) {
                                ?>
                                <?php if($counter==1){ ?>
                                    <div class="col-sm-4">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_year['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_year['package_price_usd'] ?> / <?php echo $package_year['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_year['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_year['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_year['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_year['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_year['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_year['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_year['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_year['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_year['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_year['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_year['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_year['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_year['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_year['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_year['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_year['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_year['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_year['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>
                                    <!-- END Col one -->
                                <?php } ?>
                                <?php if($counter==2){ ?>
                                    <div class="col-sm-4">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_year['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_year['package_price_usd'] ?> / <?php echo $package_year['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_year['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_year['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_year['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_year['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_year['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_year['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_year['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_year['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_year['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_year['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_year['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_year['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_year['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_year['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_year['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_year['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_year['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_year['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- END Col two -->
                                <?php if($counter==3){ ?>
                                    <div class="col-sm-4">
                                        <div class="card text-center">
                                            <div class="title">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                <h2><?php echo $package_year['package_title'] ?></h2>
                                            </div>
                                            <div class="price">
                                                <h4><sup>$</sup><?php echo $package_year['package_price_usd'] ?> / <?php echo $package_year['package_price_bdt'] ?>Tk</h4>
                                            </div>
                                            <div class="option">
                                                <ul>
                                                    <li> <i class="fa <?php if($package_year['super_admin']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['super_admin'];?></b> Super Admin </li>
                                                    <li> <i class="fa <?php if($package_year['committee_member']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['committee_member'];?></b> Committee member </li>
                                                    <li> <i class="fa <?php if($package_year['number_of_committee']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  <b><?php print $package_year['number_of_committee'];?></b> Number of Committee</li>
                                                    <li> <i class="fa <?php if($package_year['subscription_type']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Subscription Type <b>  <?php print 'Monthly';?></b>     </li>
                                                    <li> <i class="fa <?php if($package_year['audio_calling']===0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> Audio  calling <?php if($package_year['video_calling']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_year['video_calling']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Video calling  <?php if($package_year['video_calling']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_year['individual_chat']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Individual Chat Feature  <?php if($package_year['individual_chat']==0) print "No";else print "Yes";?>  </li>
                                                    <li> <i class="fa <?php if($package_year['multiple_meeting']>0) print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Multiple meeting feature <?php if($package_year['multiple_meeting']==0) print "No";else print "Yes";?> </li>
                                                    <li> <i class="fa <?php if($package_year['storage']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i> <b><?php print $package_year['storage'];?></b> Total Storage size </li>
                                                    <li> <i class="fa <?php if($package_year['payment_method']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Payment Method: <b><?php print $package_year['payment_method'];?></b></li>
                                                    <li> <i class="fa <?php if($package_year['transaction_charge']!='') print 'fa fa-check'; else print 'fa fa-times'; ?>" aria-hidden="true"></i>  Transaction charge: <b><?php print $package_year['transaction_charge'];?></b>  </li>

                                                </ul>
                                            </div>
                                            <a href="#">Order Now </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- END Col three -->
                                <?php $counter++; } ?>
                        </div>
                        <div class="row" style="display: none">
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
                                            <span><?php echo "?".$package1['package_price_bdt']." / $".$package1['package_price_usd'].""; ?></span>
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
                                                        Package price: <?php echo "?".$package1['package_price_bdt']." / $".$package1['package_price_usd'].""; ?>
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


<!-- app video -->
<section class="app-video">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- why bottle video -->
                <div class="theme-video-wrap">
                    <a href="https://www.youtube.com/watch?v=z5e3FhEc13Q" class="video-btn" data-popup="video"><i class="fa fa-play"></i></a>
                </div>
                <!-- end of why bottle video -->
            </div>
        </div>
    </div>
</section>
<!-- End of why bottol water -->
<section class="border-top whyarea pt-115 pb-80" id='blog'  >
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-md-4">
                <!-- single blog inner -->
                <div class="single-blog-inner">
                    <!-- blog image -->
                    <div class="post-image">
                        <a href="#">
                            <img src="landing-assets/img/blog/blog1.png" alt="">
                        </a>

                    </div>
                    <!--/.End of  blog image -->

                    <!-- post content -->
                    <div class="post-content">
                        <div class="post-details">


                            <div class="post-title">
                                <h3><a href="#">Choose BETTER Option, Experience with EzzyMeeting </a></h3>
                            </div>
                            <p> Designed to meet the needs of Senior Executives to secretariat team members, EzzyMeeting has been developed with rich tools empowering the users to organize a digital meeting with enhancing transparency and accountability in...</p>

                        </div>
                    </div><!-- /.End of post content -->
                    <div class="text-center">
                        <a href="#" class="btn btn-sm " style="margin: 15px  0">Read More</a>
                    </div>
                </div><!-- /.End of single blog inner -->
            </div>

            <div class="col-lg-4 col-md-4">
                <!-- single blog inner -->
                <div class="single-blog-inner">
                    <!-- blog image -->
                    <div class="post-image">
                        <a href="#">
                            <img src="landing-assets/img/blog/blog2.png" alt="">
                        </a>

                    </div>
                    <!--/.End of  blog image -->

                    <!-- post content -->
                    <div class="post-content">
                        <div class="post-details">

                            <div class="post-title">
                                <h3><a href="#">Why EZYMEETING</a></h3>
                            </div>
                            <ul>
                                <li><i class="fa fa-check blue"></i> Comparative price and package with other meeting management solutions</li>
                                <li><i class="fa fa-check blue"></i> Easy to use and packed with rich tools</li>
                                <li><i class="fa fa-check blue"></i> Time consuming for arranging meeting</li>
                                <li><i class="fa fa-check blue"></i> Secured file transaction</li>

                            </ul>

                        </div>
                    </div><!-- /.End of post content -->
                    <div class="text-center">
                        <a href="#" class="btn btn-sm " style="margin: 15px  0">Read More</a>
                    </div>
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

                    </div>
                    <!--/.End of  blog image -->

                    <!-- post content -->
                    <div class="post-content">
                        <div class="post-details">


                            <div class="post-title">
                                <h3><a href="#">Can I use EZYMEETING? </a></h3>
                            </div>
                            <p> If you determine to level up your games, EZYMEETING is surely for you. EZYMEETING helps you boost your productivity and make your life easier at the same time. This product may not be necessary but necessity indeed. </p>
                        </div>
                    </div><!-- /.End of post content -->
                    <div class="text-center">
                        <a href="#" class="btn btn-sm " style="margin: 15px  0">Read More</a>
                    </div>
                </div><!-- /.End of single blog inner -->
            </div>
        </div>
    </div>
</section>

<section id="how" class=" pt-90 pb-60" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-7">
                <!-- user interact image -->
                <div class="user-interact-image">
                    <img src="landing-assets/section/86186db8992399ecae7cb5b217ad3b77.png" class="svg" alt="">
                </div>
                <!-- End of user interact image -->
            </div>
            <div class="col-lg-5 col-sm-5">
                <!-- user ineract text -->
                <div class="user-interact-inner">

                    <h2 style="font-size: 32px;">Choose BETTER Option, Experience with EzzyMeeting
                    </h2>
                    <p class="text-justify">
                        Designed to meet the needs of Senior Executives to secretariat team members, EzzyMeeting has been developed with rich tools empowering the users to organize a digital meeting with enhancing transparency and accountability in the organization. The simplicity of the design and easy-to-use functionalities of the system makes it stand out from our competitors.

                    </p>
                    <p class="text-justify">
                        The system provides you with mobility, freedom, boosting productivity, and security for all your important meeting documents and files. And our dedicated developers keep continuing their R&D and development to give you the perfect and smooth experience of EzzyMeeting. This is the perfect choice to make your life easy in your busy schedule.


                    </p>


                </div>
                <!--End of user ineract text -->
            </div>
        </div>
    </div>
</section>
<section class="bg-3 pt-90 pb-60" id="why" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <!-- user ineract text -->
                <div class="user-interact-inner">

                    <h2>Why EZYMEETING</h2>
                    <ul>
                        <li><i class="fa fa-check blue"></i> Comparative price and package with other meeting management solutions</li>
                        <li><i class="fa fa-check blue"></i> Easy to use and packed with rich tools</li>
                        <li><i class="fa fa-check blue"></i> Time consuming for arranging meeting</li>
                        <li><i class="fa fa-check blue"></i> Secured file transaction</li>
                        <li><i class="fa fa-check blue"></i> Allows to other team members to contribute with voting, discussion and more.</li>
                        <li><i class="fa fa-check blue"></i> Reduces paper usage and wastage</li>
                        <li><i class="fa fa-check blue"></i> Gives you the mobility and freedom of work.</li>
                    </ul>

                </div>
                <!--End of user ineract text -->
            </div>
            <div class="col-lg-6 col-sm-6">
                <!-- user interact image -->
                <div class="user-interact-image" style="margin-left: -50px;">
                    <img src="landing-assets/section/86186db8992399ecae7cb5b217ad3b77.png" class="svg" alt="">
                </div>
                <!-- End of user interact image -->
            </div>

        </div>
    </div>
</section>
<section id="who" class=" pt-90 pb-60" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-7">
                <!-- user interact image -->
                <div class="user-interact-image">
                    <img src="landing-assets/section/86186db8992399ecae7cb5b217ad3b77.png" class="svg" alt="">
                </div>
                <!-- End of user interact image -->
            </div>
            <div class="col-lg-5 col-sm-5">
                <!-- user ineract text -->
                <div class="user-interact-inner">

                    <h2 style="font-size: 32px;">Can I use EZYMEETING?       </h2>
                    <p>
                        If you determine to level up your games, EZYMEETING is surely for you. EZYMEETING helps you boost your productivity and make your life easier at the same time. This product may not be necessary but necessity indeed.
                    </p>
                    <ul>
                        <li><i class="fa fa-check blue"></i> Board Secretary and Board Secretariat Team</li>
                        <li><i class="fa fa-check blue"></i> Head of Department or Division to track the team members</li>
                        <li><i class="fa fa-check blue"></i> Project Co-ordinator</li>
                        <li><i class="fa fa-check blue"></i> Small Companies</li>
                    </ul>

                </div>
                <!--End of user ineract text -->
            </div>
        </div>
    </div>
</section>
<!-- start blog area -->
<section class="border-top pt-115 pb-80 bg-2" id='blog' style="display: none;" >
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

<footer class="footer">

    <div class="footer-top pb-30 pt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <!-- footer widget -->
                    <div class="footer-widget">
                        <div class="footer-logo" style="margin-top: 15px">
                            <a href="index.php"><img src="landing-assets/f-logo.png" alt="" width="180px"></a>
                        </div>
                        <div class="footer-social-area mt-30">
                            <ul class="social-icons social-icons-light nav">
                                <li><a href="https://www.facebook.com/EZY-Meeting-103714791329300/" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>


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
                                    +88 02 7192907
                                </li>
                                <li>
                                    <span><i class="fa  fa-envelope"></i></span>
                                    info@ventureNXT.com
                                </li>
                                <li>
                                    <span><i class="fa  fa-map"></i></span>
                                    Jomidar Palace, Level: 10, 291 <br>

                                    Fakirapool Inner Circular Road,<br>

                                    Motijheel, Dhaka-1000
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer-widget">
                        <!-- widget header -->
                        <div class="widget-header">
                            <h5>Company</h5>
                        </div>
                        <!-- widget header -->
                    </div>

                    <div class="widget-body">
                        <div class="extra-link">
                            <div class="link-left">
                                <ul>
                                    <li><a href="index.php"><i class="fa fa-angle-double-right"></i> About Us</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Careers</a></li>



                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer-widget">
                        <!-- widget header -->
                        <div class="widget-header">
                            <h5>Features</h5>
                        </div>
                        <!-- widget header -->
                    </div>

                    <div class="widget-body">
                        <div class="extra-link">
                            <div class="link-left">
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Meeting App</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Screen Sharing</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Video Conferencing</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Conference Call</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Free Meeting Software</a></li>



                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer-widget">
                        <!-- widget header -->
                        <div class="widget-header">
                            <h5>Resources</h5>
                        </div>
                        <!-- widget header -->
                    </div>

                    <div class="widget-body">
                        <div class="extra-link">
                            <div class="link-left">
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Blog</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Community </a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Contact Sales</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Support & FAQs</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> Site Map</a></li>



                                </ul>
                            </div>

                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="footer-bottom"  >
        <div class="footer-text text-center">
            <p>Â© copyright 2020  VSL</p>
        </div>
    </div>

</footer>

<!-- back to top
<div class="back-to-tops">
    <a href="https://m.me/1678638095724206"><img src="landing-assets/img/chatbot.png" alt="" /></a>
</div>
  back to top -->
<script>

    var div = document.createElement('div');
    div.className = 'fb-customerchat';
    div.setAttribute('page_id', '103714791329300');
    div.setAttribute('ref', '');
    document.body.appendChild(div);
    window.fbMessengerPlugins = window.fbMessengerPlugins || {
        init: function () {
            FB.init({
                appId            : '1678638095724206',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v3.3'
            });
        }, callable: []
    };
    window.fbAsyncInit = window.fbAsyncInit || function () {
        window.fbMessengerPlugins.callable.forEach(function (item) { item(); });
        window.fbMessengerPlugins.init();
    };
    setTimeout(function () {
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    }, 0);
</script>

<style>
    .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{
        width: 100% !important;
    }
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        margin: -8px 5px;
    }
    .carousel-control-next, .carousel-control-prev {

        width: 1% !important;
        color: #26ABE2 !important;
        font-size: 38px !important;
    }
    .carousel-control-prev {
        left: -11px;
    }
    .carousel-control-next {
        right: -11px;
    }
    .single-blog-inner{
        border-radius: 4px;
    }
    .whyarea .single-blog-inner {
        margin-bottom: 30px;
        background: #ececec36;
        border-radius: 4px !important;
        border: 1px solid #9393932e;
    }
    .whyarea  .single-blog-inner:hover{
        box-shadow: 0 13px 30px rgba(0,0,0,.20);
    }
    .whyarea  .post-content{
        padding: 0 15px;
        min-height: 307px;
    }
    .post-content{
        padding: 0 15px;
    }
    .whyarea  .single-blog-inner:hover .post-image{

        box-shadow:  none;
    }
    .whyarea   .single-blog-inner .post-image{
        border-radius: 4px 4px 0px 0px  !important;
        box-shadow:  none;
    }
    .blogbg{
        background: #eee;
        border-top: 1px solid #ccc;
    }
    .single-blog-inner .post-title h3 {
        min-height: 55px;
        font-weight: 400;
        font-size: 20px;
        margin-bottom: 15px;
        line-height: 26px;

    }
    .single-blog-inner .post-details ul li{
        font-size: 15px;
    }
</style>
<style>
    .main-header.bg-white{
        border-top: 2px solid #26ABE2;
        background: #fff;
        background-color: rgb(255, 255, 255);
        position: fixed;
        width: 100%;
        -webkit-animation-duration: .5s;
        animation-duration: .5s;
        box-shadow: 0 0 10px rgba(0,0,0,.15);
    }
    .banner-area-inner{
        background: url('landing-assets/img/wall.jpg') no-repeat;
        margin-top: 81px;
        padding-top: 30px;
        margin-bottom: 30px;
        background-size: cover;
    }
    #features{
        background: none;
    }
    .banner-inner-area{
        padding-top: 30px;
    }
    .banner-image h1{
        color: #f5731f;
        font-weight: bolder;
        font-size: 39px;
        line-height: 41px;
    }
    .banner-image p{
        color: #fff !important;
        text-align: justify;
        font-size: 16px;
    }
    .banner-image .btn{
        color: #f5731f;
        border-color: #f5731f;
    }
    .banner-image .btn:hover{
        background: #f5731f;
    }
</style>
<style>
    .box {

        padding: 30px 18px 0px 18px;
        min-height: 398px;
    }
</style>

<style>
    .box {

        padding: 30px 18px 0px 18px;
        min-height: 398px;
    }
</style>




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
<script src="landing-assets/js/swiper.min.js"></script>

<!-- ==== Custom js file==== -->
<script src="landing-assets/js/custom.js"></script>
<script>
    $('.log').click(function() {
        $('#registerModal').modal('hide');
    });
    $('.reg').click(function() {
        $('#loginModal').modal('hide');
    });

    $('.header-menu li a').click(function() {
        $('.header-menu li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
</script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            260: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
            1120: {
                slidesPerView: 3,
            },
        }
    });
</script>
</body>
</html>
