<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }
    $company_id = $_SESSION['company_id'];
?>

<?php include '../partial/_header.php';?>
<style>
    .old_chairman{
        display: none;
    }
    .select_error .help-block {
        position: absolute;
        background: f4364c;
        margin-top: 50px;
    }
</style>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Committee List</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">company all committe list</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Password</li>
                                <li class="breadcrumb-item active">Password Change</li>
                            </ol>
                        </div>
                        <!-- /.page-title-right -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.page-title -->
            <!-- =================================== -->
            <!-- Different data widgets ============ -->
            <!-- =================================== -->

            
            <div class="container">
                <div class="widget-list">
                    <div class="row">

                    <div class="col-md-7 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-body clearfix">
                                    <h5 class="box-title mr-b-0">Password Change</h5>
                                    <br>
                                    <form id="password-change-form" action="password-update.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Old Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="password" name="old_password" id="old_password" value="" required="">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">New Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="password" name="new_password" id="new_password" value="" required="">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Confirm Password</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="password" name="confirm_password" id="confirm_password" value="" required="">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        
                                       
                                        <!-- /.form-group -->
                                        <div class="ml-auto col-sm-9 no-padding">
                                            <button class="btn btn-primary" id="update" type="submit">Update</button>
                                            <button class="btn btn-default" type="reset">Reset</button>
                                        </div>
                                        <!-- /.col-sm-9 -->
                                    </form>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>



<?php include '../partial/_footer.php';?>
<?php
        if(isset($_SESSION['password_change_message'])){
            $message = $_SESSION['password_change_message'];
            if($message == "success"){
            ?>
                <script>
                    $.toast({
                        heading: 'Password Change',
                        text: 'Password change successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }else if($message == "old_not_match"){
                ?>
                <script>
                    $.toast({
                        heading: 'Password Change',
                        text: "Old password does not match",
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }else if($message == "failed"){
                ?>
                <script>
                    $.toast({
                        heading: 'Password Change',
                        text: "Password change failed",
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }else if($message == "new_confirm_not_match"){
                ?>
                <script>
                    $.toast({
                        heading: 'Password Change',
                        text: "New password and old password does not match",
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['password_change_message'] = null;
        }
    ?>
    <script>
                // validation 
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
$("#password-change-form").validate({
    rules: {
        old_password: {
            required: true,
        },
        new_password :{
            required: true,
            minlength : 6,
        },
        confirm_password: {
            required: true,
            equalTo : "#new_password"
        }
        
    },
    messages: {
        old_password: {
            required: "Enter old password",
        },
        new_password :{
            required: "Enter new password",
            minlength : "Password at least 6 caracter"
        },
        confirm_password: {
            required: "Retype new password",
            equalTo : "Password does not match"
        }

    }
});

});

$('#chairman_id').on('change',function(){
    chairman_id = $(this).val();
    if(chairman_id != ''){
        $.ajax({
            url: "committee-members-list.php",
            method: 'post',
            data: {
                chairman_id : chairman_id
            },
            success:function(response){
                $('#committee_users').empty().append(response);
            }
        });
    }        
});


        $("#update").on('click',function(e){  

            var committee_users = jQuery('#committee_users').val();
            if(committee_users == ''){
                $('.committee_users_error').html('<label id="name-error" class="help-block" for="name">Please select committee uses.</label>');
                return false;
            }else{
                $('.committee_users_error').html('');
               
            }
            var quorum = jQuery('#quorum').val();
            var total_selected_user = committee_users.filter(val=>val != '').length;
            if( quorum > total_selected_user ){
                $('#quorum_error').html('<label id="name-error" class="help-block" for="name">You will give maximum quorum in '+total_selected_user+'</label>');
                return false;
            }else{
                $('#quorum_error').html('');
                return  true;
            }
        });

    </script> 
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>

</html>