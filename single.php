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


                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Navbar-->
</header>
<!-- End of Main header -->
<section class="form-area">
    <div class="login-page signup_form">
        <div class="opt-login-form">
            <h2>Login Customer</h2>
            <!-- Email -->
            <!--<h3>Login Form</h3>-->
            <form>

                <div class="md-form">
                    <label for="phone">Email Address <span>*</span></label>
                    <input type="email"  class="form-control" required>
                </div>
                <div class="md-form">
                    <label for="password">Password <span>*</span></label>
                    <input type="password" id="password" class="form-control" required>
                </div>
                <div class="clearfix mt30">
                    <button type="submit" class="btn btn-login btn-block btn-primary btn-rounded">Submit</button>
                </div>
            </form>
            <p class="create-text mt30">Don't Have an account? <a href="login.html"><b>SIGN UP</b></a></p>
        </div>

    </div>
</section>

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
