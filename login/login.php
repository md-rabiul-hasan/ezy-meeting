
<?php
session_start();
if (isset($_SESSION['id'] ) && !isset($_SESSION['login_message']) ) {
    header( "location:../dashboard.php" );
    exit;
}
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/demo/favicon.html">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700" rel="stylesheet" type="text/css">
    <link href="../assets/vendors/feather-icons/feather.css" rel="stylesheet" type="text/css">
    <link href="../assets/vendors/linear-icons/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/vendors/mono-social-icons/monosocialiconsfont.css" rel="stylesheet" type="text/css">
    <link href="../assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- Head Libs -->
    <script src="../assets/cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body class="body-bg-full profile-page" style="background-image: url(../assets/img/site-bg.jpg)">
<div id="wrapper" class="row wrapper">
    <div class="container-min-full-height d-flex justify-content-center align-items-center">
        <div class="login-center">
            <div class="navbar-header text-center mt-2 mb-4" >
                <a href="index.php">
                    <img alt="" src="../assets/img/logo-dark.png" style="margin-bottom: 30px">
                </a>
            </div>
            <!-- /.navbar-header -->
            <form action="login_submit.php" id="login-form" method="post">
                <div class="btn-group btnbox" role="group">
                    <input type="button" class="btn btn-default lft active" value="Admin" name="Usertype" onclick="GetType(this.value)">
                    <input type="button" class="btn btn-default rgt" value="Member" name="Usertype" onclick="GetType(this.value)">
                    <input type="hidden" name="Usertype_val" id="Usertype_val">
                </div>
                <div class="form-group">
                    <label for="example-email">Email Or Phone</label>
                    <input type="text" name="email" required placeholder="johndoe@site.com" class="form-control form-control-line" name="example-email" id="example-email">
                </div>
                <div class="form-group">
                    <label for="example-password">Password</label>
                    <input type="password" name="password" required placeholder="password" id="example-password" name="example-password" class="form-control form-control-line">
                </div>
                <div class="form-group">
                    <input type="submit"  class="btn btn-block btn-lg btn-secondary text-uppercase fs-12 fw-600" name="login" value="Login">

                </div>
                <div class="form-group no-gutters mb-0">
                    <div class="col-md-12 d-flex">
                        <div class="checkbox checkbox-primary mr-auto mr-0-rtl ml-auto-rtl">
                            <label class="d-flex">
                                <input type="checkbox"> <span class="label-text">Remember me</span>
                            </label>
                        </div><a href="javascript:void(0)" id="to-recover" class="my-auto pb-2 text-right"><i class="lnr lnr-lock mr-1 fs-14"></i> Forgot Password?</a>
                    </div>
                    <!-- /.col-md-12 -->
                </div>
                <!-- /.form-group -->
            </form>
            <!-- /.form-material -->

            <footer class="col-sm-12 text-center">
                <hr>
                <p>Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a>
                </p>
            </footer>
        </div>
        <!-- /.login-center -->
    </div>
    <!-- /.d-flex -->
</div>
<!-- /.body-container -->
<?php if(isset($_SESSION['login_message']) && $_SESSION['login_message'] != null) : ?>
    <input type="hidden" name="error_message" id="error_message" value="<?php echo $_SESSION['login_message']; ?> ">
<?php endif; ?>


<!-- Scripts -->
<script src="../assets/cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../assets/js/jquery.toast.min.js"></script>
<script src="../assets/cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../assets/js/material-design.js"></script>
<script src="../assets/js/validation.js"></script>
<script>
 $(function() {

$.validator.setDefaults({
    errorClass: 'help-block',
    highlight: function(element) {
        $(element)
            .closest('.form-group')
            .addClass('has-error');
    },
    unhighlight: function(element) {
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
    }
});

// Login form validation 
$("#login-form").validate({
    rules: {
        email: {
            required: true,
        },
        password :{
            required: true
        },
        
    },
    messages: {
        email: {
            required: "Please enter email or phone"
        },
        password :{
            required: "Please enter user password",
        }

    }
});

});
    $(".btnbox  .btn-default").click(function(){
        $('.btnbox  .btn-default').removeClass("active");
        $(this).addClass("active");
    });
    function GetType(val)
    {
        if(val=='Admin')
            document.getElementById("Usertype_val").value = "1";
        if(val=='Member')
            document.getElementById("Usertype_val").value = "3";
    }

    var login_failed_message = $('#error_message').val();
    if(login_failed_message != null){
        $.toast({
            heading: 'Login',
            text: login_failed_message,
            position: 'top-right',
            icon: 'error', //info, warning, success, and error 
            stack: false
        }); 
    }      
</script>
<style>
    .btnbox{
        margin-bottom: 20px;
        text-align: center;display: inherit !important;
    }
    .btnbox .btn-default{
        border: 1px solid #e1e1e1;
        color: #000;
        font-size: 16px;
        border-radius: 42px;
        border-top-right-radius: 42px;
        border-bottom-right-radius: 42px;
        background: #fff;
        text-transform: uppercase;
        padding: 8px 25px;
    }
    .btnbox  .btn-default.active{
        background: #011453;
        color: #fff;
    }
    .login-center {
        min-width: 434px;
    }
    .btn.btn-default.rgt{
        border-radius: 0px 43px 43px 0px !important;
    }
</style>

<?php 
    if(isset($_SESSION['login_message'])){
        unset($_SESSION['login_message']);
    }
?>
</body>
</html>