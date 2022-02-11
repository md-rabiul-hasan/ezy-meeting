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
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Company User List</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">
                                admins , members
                            </p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Users List</li>
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
                        <div class="col-md-12 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-heading clearfix">
                                    <h5>Company All Users</h5>
                                    
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-user-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span>
                                </button>
                                </div>

                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <table id="user_list" class="table table-bordered table-striped DataTables">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Designation</th>
                                                <th>Committee</th>
                                                <th>Voter</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                       <?php
                                            $allUserSql = "SELECT users.name,users.company_id as usercompnay_id,users.email,users.role_id,users.is_active,users.id as user_id,user_profiles.designation,user_profiles.is_voter,user_profiles.avatar FROM users 
                                                left join user_profiles  on users.id=user_profiles.user_id WHERE users.company_id='$company_id'";
                                                $allUserQuery = mysqli_query($connect,$allUserSql);
                                                $sl = 1;
                                                while($allUserData = mysqli_fetch_array($allUserQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td >
                                                            <?php 
                                                                if($allUserData['avatar'] != NULL){
                                                                    ?>
                                                                        <img style="height: 50px; width:50px; border-radius:50%;" src="<?php echo $addDot; ?>storage/<?php echo $allUserData['usercompnay_id'] ?>/users/<?php echo $allUserData['avatar'] ?>" alt="">
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <img style="height: 50px; width:50px; border-radius:50%;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQhV-1WFMMQ51o-DTXomekBeH453xVtdr4W1T_cccS4kDkRPbxY&usqp=CAU" alt="">
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
                                                            <?php echo $allUserData['designation']; ?>
                                                        </td>
                                                        <td>
                                                        <?php 
                                                            $userId= $allUserData['user_id'];
                                                            $userCommitteeListSql = "SELECT name FROM committees where find_in_set('$userId',committee_users)";
                                                            $userCommitteeListQuery = mysqli_query($connect,$userCommitteeListSql);
                                                            while($userCommitteeListData = mysqli_fetch_array($userCommitteeListQuery)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                                    <?php echo $userCommitteeListData['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td>
                                                        <td>
                                                        <?php 
                                                            if($allUserData['is_voter'] ==  1){
                                                                echo 'voter';
                                                            }else{
                                                                echo 'non-voter';
                                                            }
                                                        ?>
                                                        </td>
                                                        <td class="text-capitalize">
                                                        <?php 
                                                            if($allUserData['role_id'] ==  1){
                                                                echo '<span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                                super-admin
                                                               </span>';
                                                            }else if($allUserData['role_id'] ==  2){
                                                                echo '<span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                                admin
                                                               </span>';
                                                            }else if($allUserData['role_id'] ==  3){
                                                                echo '<span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;">
                                                                member
                                                               </span>';
                                                            }
                                                        ?>
                                                        </td>
                                                        <td>
                                                        <?php 
                                                            if($allUserData['is_active'] ==  1){
                                                                echo 'active';
                                                            }else{
                                                                echo 'de-active';
                                                            }
                                                        ?>
                                                        </td>
                                                        <td style="width: 20px;">
                                                            <span>
                                                                <a class="btn btn-sm btn-primary" href="edit_user.php?id=<?php echo $allUserData['user_id'] ?>"><i class="list-icon lnr lnr-pencil"></i></a>
                                                            </span>
                                                            <span>
                                                                <a class="btn btn-sm btn-danger" href=""><i class="list-icon lnr lnr-trash"></i></a>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }

                                            ?>  
                                           
                                       </tbody>
                                    </table>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
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
                                <div class="text-center my-2"><a href="#"><span><img src="assets/img/logo-dark.png" alt=""></span></a>
                                </div>
                                <form action="#">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" id="name" required="" placeholder="John Doe">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Select a State</label>
                                        <select class="m-b-10 form-control" required="" name="role_id" id="role_id" data-placeholder="Select user role" data-toggle="select2">
                                            <optgroup label="Role List">
                                                <option value="">Select Role</option>
                                                <option value="2">Admin</option>
                                                <option value="3">Member</option>
                                            </optgroup>                                                
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="email" required="" placeholder="john@deo.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
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

<?php include '../partial/_footer.php';?> 
<script src="<?php echo $addDot; ?>assets/js/bootstrap-notify.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script>
    jQuery('#submit').on('click',function(){
        var name = jQuery('#name').val();
        var email = jQuery('#email').val();
        var password = jQuery('#password').val();
        var role_id = jQuery('#role_id').val();

       // $("#user_list_tbody").load(location.href + " #user_list_tbody");


        if(name != '' && email != '' && password != '' && role_id != ''){
            $('#submit').val('saving......');
            $('#submit').attr('disabled', true);
            $.ajax({
                url: "user-registration.php",
                method: 'post',
                data: {
                    name : name,
                    email : email,
                    password : password,
                    role_id : role_id
                },
                success: function(response){
                    $('#submit').val('save');
                    $('#submit').attr('disabled', false);
                    if(response == true ){
                        jQuery('#name').val('');
                        jQuery('#email').val('');
                        jQuery('#password').val('');
                        jQuery('#role_id').val('');
                        $.notify({
                            message: "User Created Successfully.",
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'success'
                        });
                        $("#user_list").load(location.href + " #user_list");
                    }else{
                        $.notify({
                            message: response,
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'danger'
                        });
                    }

                    $('#add-user-modal').modal('hide');
                }
            });
        }
    });

    $(document).ready(function() {
        $('.DataTables').DataTable();

    } );


</script>   

</body>

</html>