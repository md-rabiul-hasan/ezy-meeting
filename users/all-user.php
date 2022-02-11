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
<!-- Authentication Check End -->

<?php include '../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
<!--            <div class="page-title">-->
<!--                <div class="container">-->
<!--                    <div class="row">-->
<!--                        <div class="page-title-left">-->
<!--                            <h6 class="page-title-heading mr-0 mr-r-5">Company User List</h6>-->
<!--                            <p class="page-title-description mr-0 d-none d-md-inline-block">-->
<!--                                company all user list-->
<!--                            </p>-->
<!--                        </div>-->
<!--                        <!-- /.page-title-left -->
<!--                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">-->
<!--                            <ol class="breadcrumb">-->
<!--                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>-->
<!--                                </li>-->
<!--                                <li class="breadcrumb-item active">Users List</li>-->
<!--                            </ol>-->
<!--                        </div>-->
<!--                        <!-- /.page-title-right -->
<!--                    </div>-->
<!--                    <!-- /.row -->
<!--                </div>-->
<!--                <!-- /.container -->
<!--            </div>-->
            <!-- /.page-title -->
            <!-- =================================== -->
            <!-- Different data widgets ============ -->
            <!-- =================================== -->
            <div class="container">
                <div class="widget-list tablelists">
                    <div class="row">
                        <div class="col-md-12 widget-holder lisingv2">
                            <div class="widget-bg" id="user_list">
                                <div class="tabletop">
                                   <div> <h5>Users List</h5></div>
                                    <p>This Table has showing all Users list</p>
                                    <div class="buttonright">
                                        <?php if(companyPackageUser($company_id) != false) : ?>
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-user-modal" style="float:right;"><i class="fa fa-plus"></i>  <span>Add New</span></button>
                                        <?php else:  ?>
                                            <button class="btn btn-sm btn-danger"  style="float:right;"><span>Already Added Maximum User</span></button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                     <div class="col-md-12">
                                         <div>
                                             <div class="boxxarea table-responsive">
                                                 <table  class="table table-bordered table-striped DataTables">
                                                     <thead>
                                                     <tr>
                                                         <th width="35px">SL</th>
                                                         <th>Image</th>
                                                         <th>Name</th>
                                                         <th>Email</th>
                                                         <th>Phone</th>
<!--                                                         <th>Designation</th>-->
                                                        <th>Committee</th>
<!--                                                         <th>Voter</th>-->
                                                         <th>Role</th>
                                                         <th>Status</th>
                                                         <th>Action</th>
                                                     </tr>
                                                     </thead>
                                                     <tbody>
                                                     <?php
                                                     $allUserSql = "SELECT users.name,users.company_id as usercompnay_id,users.email,users.phone,users.role_id,users.is_active,users.id as user_id,
                                            user_profiles.designation,user_profiles.is_voter,users.avatar FROM users 
                                                left join user_profiles  on users.id=user_profiles.user_id WHERE users.company_id='$company_id' ORDER BY users.id asc";
                                                     $allUserQuery = mysqli_query($connect,$allUserSql);
                                                     $sl = 1;
                                                     while($allUserData = mysqli_fetch_array($allUserQuery)){
                                                         ?>
                                                         <tr>
                                                             <td>
                                                                 <?php echo $sl++; ?>
                                                             </td>
                                                             <td width="50px" >
                                                                 <?php
                                                                 if($allUserData['avatar'] != NULL){
                                                                     ?>
                                                                     <img class="img-circle imground img-bordered"  src="<?php echo $addDot; ?><?php echo $allUserData['avatar'] ?>" alt="">
                                                                     <?php
                                                                 }else{
                                                                     ?>
                                                                     <img   class="img-circle imground img-bordered"  src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQhV-1WFMMQ51o-DTXomekBeH453xVtdr4W1T_cccS4kDkRPbxY&usqp=CAU" alt="">
                                                                     <?php

                                                                 }
                                                                 ?>
                                                             </td>
                                                             <td>
                                                                 <?php echo $allUserData['name']; ?>
                                                             </td>
                                                             <td>
                                                                 <?php echo $allUserData['email']; ?>
                                                             </td>
                                                             <td>
                                                                 <?php echo $allUserData['phone']; ?>
                                                             </td>
<!--                                                             <td>-->
<!--                                                                 --><?php //echo $allUserData['designation']; ?>
<!--                                                             </td>-->
                                                                <td>
                                                                <?php
                                                                    $userId= $allUserData['user_id'];
                                                                    $userCommitteeListSql = "SELECT name FROM committees where find_in_set('$userId',committee_users) or chairman_id='$userId' ";
                                                                    $userCommitteeListQuery = mysqli_query($connect,$userCommitteeListSql);
                                                                    while($userCommitteeListData = mysqli_fetch_array($userCommitteeListQuery)){
                                                                        ?>
                                                                            <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"> <?php echo $userCommitteeListData['name'];  ?></span>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                </td>
<!--                                                             <td>-->
<!--                                                                 --><?php
//                                                                 if($allUserData['is_voter'] ==  1){
//                                                                     echo 'voter';
//                                                                 }else{
//                                                                     echo 'non-voter';
//                                                                 }
//                                                                 ?>
<!--                                                             </td>-->
                                                             <td class="text-capitalize">
                                                                 <?php
                                                                 if($allUserData['role_id'] ==  1){
                                                                     echo '<span class=" mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                              <i class="fa fa-user-o" aria-hidden="true"></i> Super-admin
                                                               </span>';
                                                                 }else if($allUserData['role_id'] ==  2){
                                                                     echo '<span class=" mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                                <i class="fa fa-user-o" aria-hidden="true"></i> Admin
                                                               </span>';
                                                                 }else if($allUserData['role_id'] ==  3){
                                                                     echo '<span class=" mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                                <i class="fa fa-user-o" aria-hidden="true"></i> Member
                                                               </span>';
                                                                 }
                                                                 ?>
                                                             </td>
                                                             <td class="text-center">
                                                                 <?php
                                                                 if($allUserData['is_active'] ==  1){
                                                                     echo "<img width='20px' src='../assets/img/success.png'>";
                                                                 }else{
                                                                     echo "<img width='20px' src='../assets/img/error.png'>";
                                                                 }
                                                                 ?>
                                                             </td>
                                                             <td style="width: 20px;">
                                                            <span>
                                                                <a class="btn btn-sm btn-warning editbtn" href="edit_user.php?id=<?php echo encryptData($allUserData['user_id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            </span>
                                                                 <!-- <span>
                                                                <?php if($allUserData['role_id'] != 1) : ?>
                                                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $allUserData['user_id'] ?>)">
                                                                        <i class="list-icon lnr lnr-trash"></i>
                                                                    </button>
                                                                <?php endif; ?>

                                                            </span> -->
                                                             </td>
                                                         </tr>
                                                         <?php
                                                     }

                                                     ?>

                                                     </tbody>
                                                 </table>
                                             </div>
                                         </div>

                                     </div>
                                <!-- /.widget-heading -->
                                <div class="table-responsive">

                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                    <div style="background: #fff; width: 100%;">
                    <img src="../assets/img/meeting-bg.png" alt="">
                    </div>
                        <!-- /.row -->
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


        <!-- Add Modal Added  Start -->
         <!-- Custom Modals -->
                
                <!-- Signup Modal -->
                <div id="add-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">
                                <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                                </div>
                                <form action="#" id="add-user-form">
                                    <div class="form-group">
                                        <label for="name">Name <span class="required_sign">**</span> </label>
                                        <input class="form-control" type="text" autocomplete="off" id="name" required="" placeholder="John Doe">
                                    </div>
                                    <div class="form-group select_error">
                                        <label class="form-control-label">Select a Role <span class="required_sign">**</span></label>
                                        <select class="m-b-10 form-control select2" onchange="selectRole()" autocomplete="off" required="" name="role_id" id="role_id">
                                            <optgroup label="Role List">
                                                <option value="">Select Role</option>
                                                <?php if(maxCreateSuperAdmin($company_id) > companyTotalSuperAdmin($company_id)) : ?>
                                                    <option value="1">Super Admin</option>
                                                <?php endif; ?>  
                                                <option value="2">Admin</option>
                                                <option value="3">Member</option>
                                            </optgroup>                                                
                                        </select>
                                    </div>
                                    <div class="form-group select_error" id="committee_div">
                                        <label class="form-control-label">Select Committee</label>
                                        <select class="m-b-10 form-control select2" autocomplete="off" required="" name="committee_id" id="committee_id">
                                            <optgroup label="Committee List">
                                                <option value="">Select Committee</option>
                                                <?php
                                                    $committeeListSql = "SELECT name,id FROM committees WHERE company_id='{$company_id}'";
                                                    $committeeListQuery = mysqli_query($connect,$committeeListSql);
                                                    while($committeeListData = mysqli_fetch_assoc($committeeListQuery)){
                                                        ?>
                                                            <option value="<?php  echo $committeeListData['id']; ?>"><?php  echo $committeeListData['name']; ?></option>
                                                        <?php
                                                    }
                                                ?>                                                
                                            </optgroup>                                                
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address <span class="required_sign">**</span></label>
                                        <input class="form-control" type="email" autocomplete="off" id="email" name="email" required="" placeholder="john@deo.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Phone <span class="required_sign">**</span></label>
                                        <input class="form-control" type="text" autocomplete="off" id="phone" name="phone" required="" placeholder="01XXXXXXXXXXX">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span class="required_sign">**</span></label>
                                        <input class="form-control" type="password"  autocomplete="off" required="" id="password" name="password" placeholder="Enter your password">
                                    </div>
                                   
                                    <div class="text-center mr-b-30">
                                        <input type="submit" id="submit" class="btn btn-success" value="save">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            
        <!-- Add Modal Added  End-->

        <?php if(isset($_SESSION['user_registation_message']) && $_SESSION['user_registation_message'] != null) : ?>
            <input type="hidden" name="user_registation_message" id="user_registation_message" value="<?php echo $_SESSION['user_registation_message']; ?> ">
        <?php endif; ?>

<?php include '../partial/_footer.php';?> 

<script>
    $(document).ready(function(){
        $('#committee_div').hide();
    })
    // only member need to show committee opiton
    function selectRole(){
        var role_id = $('#role_id').val();
        if(role_id == 3){
            $('#committee_div').show();
        }else{
            $('#committee_div').hide();
        }
    }

    // only member need committe option show
    var user_registation_message = $('#user_registation_message').val();
    if(user_registation_message != null){
        $.toast({
            heading: 'User Create',
            text: user_registation_message,
            position: 'top-right',
            icon: 'success', //info, warning, success, and error 
            stack: false
        }); 
    }    
    $.validator.addMethod('phone', function(value) {
        return /\b(88)?01[3-9][\d]{8}\b/.test(value);
    }, 'Please enter valid phone number');
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
                $("#add-user-form").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        role_id :{
                            required: true,
                        },
                        email: {
                            required: true,
                            email : true
                        },
                        password :{
                            required: true
                        },
                        phone : {
                            required : true,
                            phone: true
                        }
                        
                    },
                    messages: {
                        name: {
                            required: 'Please enter user name.',
                        },
                        role_id :{
                            required: 'Please select user role',
                        },
                        email: {
                            required: "Please enter user email",
                            email : "Invalid email address"
                        },
                        password :{
                            required: "Please enter user password",
                        },
                        phone : {
                            required : "pleas enter user phone number",
                            regex: 'invalid format'
                        }

                    }
                });

            });

            $(document).ready(function() {
            $('#add-user-modal .select2').each(function() {
                var $p = $(this).parent();
                $(this).select2({
                    dropdownParent: $p
                });
            });
        } );
    jQuery('#submit').on('click',function(){
        var name     = jQuery('#name').val();
        var email    = jQuery('#email').val();
        var phone    = jQuery('#phone').val();
        var password = jQuery('#password').val();
        var role_id  = jQuery('#role_id').val();
        var committee_id  = jQuery('#committee_id').val();

       // $("#user_list_tbody").load(location.href + " #user_list_tbody");


        if(name != '' && email != '' && password != '' && role_id != '' && phone != ''){
            $('#submit').val('saving......');
            $('#submit').attr('disabled', true);
            $.ajax({
                url: "user-registration.php",
                method: 'post',
                data: {
                    name : name,
                    email : email,
                    phone : phone,
                    password : password,
                    role_id : role_id,
                    committee_id : committee_id
                },
                success: function(response){
                    console.log(response);
                    $('#submit').val('save');
                    $('#submit').attr('disabled', false);
                    if(response == true ){  
                        location.reload(true);
                    }else{
                        $.toast({
                            heading: 'Company User',
                            text: response,
                            position: 'top-right',
                            icon: 'error', //info, warning, success, and error 
                            stack: false
                        });
                    }

                    $('#add-user-modal').modal('hide');
                }
            });
        }
    });

    function deleteUser(id){
        swal({
            title: 'Are you sure?',
            text: "You want to delete this user!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    url: "user-delete.php",
                    method: 'post',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Company User',
                                text: 'User Delete Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#user_list").load(location.href + " #user_list");
                        } else {
                            $.toast({
                                heading: 'Company User',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your user is safe :)',
                    'error'
                )
            }
        })
    }

    $(document).ready(function() {
        $('.DataTables').DataTable();
    } );
</script> 

<?php 
    if(isset($_SESSION['user_registation_message'])){
        unset($_SESSION['user_registation_message']);
    }
?>

</body>

</html>