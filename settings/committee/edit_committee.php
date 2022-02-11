<!-- Database Connection -->
<?php include '../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }
    $company_id = $_SESSION['company_id'];
?>

<?php include '../../partial/_header.php';?>
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
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Committees</li>
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
            <?php
                $committeId =  decryptData(filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING));
                $committeeInfoSql = "SELECT committees.*,users.name as user_name FROM committees inner join users on committees.chairman_id=users.id WHERE committees.id='$committeId'";
                $committeeInfoQuery = mysqli_query($connect,$committeeInfoSql);
                $committeeInfoData = mysqli_fetch_array($committeeInfoQuery);
            ?>
            <?php
                $chairman_id = $committeeInfoData['chairman_id'];
            ?>
            
            <div class="container">
                <div class="widget-list">
                    <div class="row">

                    <div class="col-md-8 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-body clearfix">
                                    <h5 class="box-title mr-b-0">Comitte Edit</h5>
                                    <form id="edit-committee-form" action="committee_update.php?id=<?php echo $committeId; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Committee Name <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="name" id="name" value="<?php echo $committeeInfoData['name'] ?>" required="">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group select_error row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Select Chairman <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <select class="m-b-10 form-control select2"  required="" name="chairman_id" id="chairman_id" data-toggle="select2">
                                                    <optgroup label="User List">
                                                        <option value="">Select Chairman</option>
                                                        <?php
                                                            $allMemberListSql = "SELECT id,name FROM users WHERE company_id='$company_id' and (role_id != 1 and role_id != 2)";
                                                            $allMemberQuery = mysqli_query($connect,$allMemberListSql);
                                                            while($allMemberData = mysqli_fetch_array($allMemberQuery)){
                                                                ?>
                                                                    <option  value="<?php echo $allMemberData['id']; ?>" <?php if($allMemberData['id'] == $chairman_id) { echo "selected"; } ?> ><?php echo $allMemberData['name']; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                    </optgroup>                                                
                                                </select>
                                            </div>                                           
                                        </div>
                                      
                                        <div class="form-group row select_error">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Committee Members <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <select class="m-b-10 form-control select2"   name="committee_users[]" id="committee_users" multiple="multiple" required data-toggle="select2">
                                                    <optgroup label="User List">
                                                        <option value="">Select Members</option>
                                                        <?php
                                                            $allUserSql = "SELECT id,name FROM users WHERE id != '$chairman_id' and company_id='$company_id' and (role_id != 1 and role_id != 2)";
                                                            $allUserQuery = mysqli_query($connect,$allUserSql);
                                                            $selectedUser = explode(',',$committeeInfoData['committee_users']);
                                                            while($allUserData = mysqli_fetch_array($allUserQuery)){
                                                                ?>
                                                                    <option id="members<?php echo $allUserData['id']; ?>" class="all_members <?php if($allUserData['id'] == $chairman_id){ echo "old_chairman"; } ?>" value="<?php echo $allUserData['id']; ?>" <?php if( in_array($allUserData['id'],$selectedUser) ){ echo "selected"; } ?>>
                                                                    <?php echo $allUserData['name']; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                    </optgroup>                                                
                                                </select>
                                                <span class="committee_users_error"></span>
                                            </div>
                                            <!-- /.col-sm-10 -->
                                        </div>
                                          <!-- /.form-group -->
                                          <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Description</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" id="description" name="description"  value="<?php echo $committeeInfoData['description'] ?>">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <!-- /.form-group -->
                                            <!-- /.form-group -->
                                            <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Short Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="prefix" value="<?php echo $committeeInfoData['prefix'] ?>" id="prefix" >
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Quorum <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" value="<?php echo $committeeInfoData['quorum'] ?>" name="quorum"  id="quorum" required="" >
                                                <span id="quorum_error"></span>
                                            </div>
                                            
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Current Index</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" value="<?php echo $committeeInfoData['current_index'] ?>" name="current_index" id="current_index" required="" >
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



<?php include '../../partial/_footer.php';?>
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
$("#edit-committee-form").validate({
    rules: {
        name: {
            required: true,
        },
        chairman_id :{
            required: true,
        },
        committee_users: {
            required: true,
        },
        quorum :{
            required: true,
            number: true
        }
        
    },
    messages: {
        name: {
            required: 'Please write committee name.',
        },
        chairman_id :{
            required: 'Please select committee chairman',
        },
        committee_users: {
            required: "Please select committee members",
        },
        quorum :{
            required: "Please write quorum members",
            number: "Invalid Format,only number format supported"
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
    <!-- default Script For Every Pages End -->
</body>

</html>