<?php error_reporting(0); ?>
<?php include 'database_connection.php';?>
<?php
  if(isset($_POST['submit'])){
      $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
      $company = filter_input(INPUT_POST,'company',FILTER_SANITIZE_STRING);
      $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
      $hashPassword = password_hash($password,PASSWORD_DEFAULT);
      $companySql = "INSERT INTO companies (`name`,`email`) VALUES ('{$company}','{$email}') ";
      $companyQuery = mysqli_query($connect,$companySql);
      if($companyQuery){
          // findoutCompnayId    
          if(getCompanyId($email) != false){
            $compnayId = getCompanyId($email);

            // user registation
            $userSql = "INSERT INTO `users`(`company_id`, `name`, `email`, `password`, `role_id`, `is_active`) VALUES ($compnayId,'$name','$email','$password','1','1')";
            $userQuery = mysqli_query($connect,$userSql);
            if($userQuery){
                header('Location:../demo/dashboard.php');
            }
            // user registation
          }else{
              echo "ok";
          }

      }
  }
 ?>

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
 <?php include_once 'header.php'; ?>
<!-- End of Main header -->
<section class="form-area register">
    <div class="login-page signup_form">
        
        
          <div class="opt-login-form" style="padding: 0;border-top-left-radius: 14px !important;">
        
    <img src="landing-assets/img/welcome1.png" />
          <div style="padding: 30px 30px 5px 30px;">
            <h2>Signup Customer</h2>
             
            
            <!-- Email -->
            <!--<h3>Login Form</h3>-->
            <form method="POST" action="">
               <div class="row">
                   <div class="col-md-6"> <div class="md-form">
                           <label for="phone">Full Name <span>*</span></label>
                           <input type="text" name="name"  class="form-control" required>
                       </div></div>
                   <div class="col-md-6">   <div class="md-form">
                           <label for="phone">Email Address <span>*</span></label>
                           <input type="email"  name="email" class="form-control" required>
                       </div></div>
               </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="phone">Company Name <span>*</span></label>
                            <input type="text"  name="company" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">

                    
                    <div class="col-md-6">
                <div class="md-form">
                    <label for="password">Password <span>*</span></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                </div>
                 
                </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 10px;">
                <div class="  mt30">
                    <button type="submit" name="submit" class="btn btn-login  btn-primary btn-rounded">Submit</button>
                </div>
                </div>
                </div>

            </form>
            <p class="create-text mt30"> Have an account? <a href="login.php"><b>LOGIN</b></a></p>
        </div>
 </div>
    </div>
</section>

 <?php include_once 'footer.php'; ?>

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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>

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
