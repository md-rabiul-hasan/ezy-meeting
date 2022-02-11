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

<!-- Query  Start -->
<?php
    if(isset($_GET['id'])){
        $user_id = decryptData(filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING));
        $userDataSql = "SELECT *,users.id as userId FROM users left join user_profiles on users.id=user_profiles.user_id where users.id='$user_id'";
        $userDataQuery = mysqli_query($connect,$userDataSql);
        $userData = mysqli_fetch_array($userDataQuery);

    }

?>
<input type="hidden" id="is_share_holder" value="<?php echo $userData['designation']; ?>">
<!-- Query  End -->
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Company User List</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">admins , members</p>
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
                       <!-- Tabs Bordered -->
                       <div class="col-md-12 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-body clearfix">
                                    <h5 class="box-title">User Profile Update</h5>
                                    <div class="tabs tabs-bordered">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#profile" data-toggle="tab" aria-expanded="true">Profile</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#user-relative" data-toggle="tab" aria-expanded="true">Relatives</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#user-education"  data-toggle="tab" aria-expanded="true">Education</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#user-experience" data-toggle="tab" aria-expanded="true">Experience</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#user-document" data-toggle="tab" aria-expanded="true">Document</a>
                                            </li>
                                            <li class="nav-item" id="share_holder_tab">
                                                <a class="nav-link" href="#share-holder" data-toggle="tab" aria-expanded="true">Share</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-tabs -->
                                        <div class="tab-content">

                                            <!-- Profile  Section Start -->
                                            <div class="tab-pane active" id="profile">
                                                <div class="row">
                                                    <div class="col-md-12 widget-holder">
                                                    <form id="user-profile-update-form" class="" action="users_profile_update.php?id=<?php echo $userData['userId'] ?>" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="l30">Name <span class="required_sign">**</span></label>
                                                                        <input class="form-control" id="name" name="name"  value="<?php echo $userData['name'] ?>" placeholder="Name" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="l30">Email <span class="required_sign">**</span></label>

                                                                        <input class="form-control" id="email" name="email" required value="<?php echo $userData['email'] ?>" placeholder="Email" type="email">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="l30">Phone <span class="required_sign">**</span></label>
                                                                        <input class="form-control" id="phone" name="phone" required value="<?php echo $userData['phone'] ?>" placeholder="Phone" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="l30">Designation <span class="required_sign">**</span></label>
                                                                        <select class="form-control" id="designation" name="designation" required>
                                                                            <option value="">Select Designation</option>                                                                            
                                                                            <option value="share_holder" <?php if($userData['designation'] == 'share_holder'){ echo "selected"; } ?> >Share Holder</option>
                                                                            <option value="senior_manager" <?php if($userData['designation'] == 'senior_manager'){ echo "selected"; } ?> >Senior Manager</option>
                                                                            <option value="executive" <?php if($userData['designation'] == 'executive'){ echo "selected"; } ?> >Executive</option>
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="row" id="share_holder" style="display: none;">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="l30">Own Share (in percentage)</label>

                                                                        <input class="form-control" id="own_share" name="own_share" value="<?php echo $userData['own_share'] ?>" placeholder="Own Share (in percentage)" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="family_share">Family Share (in percentage)</label>

                                                                        <input class="form-control" id="family_share" name="family_share" value="<?php echo $userData['family_share'] ?>" placeholder="Family Share (in percentage)" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <label for="l30">NID <span class="required_sign">**</span></label>
                                                                    <div class="form-group">
                                                                        <input class="form-control"  id="nid" name="nid" required placeholder="NID" value="<?php echo $userData['nid'] ?>" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                         <label for="l30">TIN <span class="required_sign">**</span></label>
                                                                        <input class="form-control" id="tin" name="tin" required placeholder="TIN" value="<?php echo $userData['nid'] ?>" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                         <label for="l38">Select Role <span class="required_sign">**</span></label>
                                                                        <select class="form-control" id="role_id" name="role_id" required>
                                                                            <option>Select Role</option>
                                                                            <?php if(maxCreateSuperAdmin($company_id) > companyTotalSuperAdmin($company_id)) : ?>
                                                                                <option value="1" <?php if($userData['role_id'] == 1){ echo "selected"; } ?> >Super Admin</option>
                                                                            <?php endif; ?> 

                                                                            <?php if(isSuperAdmin($company_id,$user_id) === true) : ?>
                                                                                <option value="1" <?php if($userData['role_id'] == 1){ echo "selected"; } ?> >Super Admin</option>
                                                                            <?php endif; ?>
                                                                            
                                                                            <option value="2" <?php if($userData['role_id'] == 2){ echo "selected"; } ?> >Admin</option>
                                                                            <option value="3" <?php if($userData['role_id'] == 3){ echo "selected"; } ?> >Member</option>
                                                                        </select>
                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="234">Hierarchy <span class="required_sign">**</span></label>
                                                                        <input class="form-control" id="hierarchy" name="hierarchy" required value="<?php echo $userData['hierarchy'] ?>" placeholder="Hierarchy" type="number">
                                                                        
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                <label for="l38">Is Voter <span class="required_sign">**</span></label>
                                                                    <div class="form-group"> 
                                                                        <div class="radiobox">
                                                                            <label>
                                                                                <input type="radio" required name="is_voter" value="1" <?php if($userData['is_voter'] == 1){ echo "checked"; } ?> > <span class="label-text">Yes</span>
                                                                            </label>
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            <label>
                                                                                <input type="radio" required name="is_voter" value="0" <?php if($userData['is_voter'] == 0){ echo "checked"; } ?> > <span class="label-text">No</span>
                                                                            </label>                                                                            
                                                                        </div>                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="234">Date Of Birth</label>
                                                                        <input class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth"  value="<?php echo $userData['date_of_birth'] ?>" type="date">
                                                                        
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <label for="l38">Maritial Status</label>
                                                                    <div class="form-group">
                                                                       
                                                                        <div class="radiobox">
                                                                            <label>
                                                                                <input type="radio" required name="maritial_status" value="1" <?php if($userData['maritial_status'] == 1){ echo "checked"; } ?> > <span class="label-text">Married</span>
                                                                            </label>
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            <label>
                                                                                <input type="radio" required name="maritial_status" value="0" <?php if($userData['maritial_status'] == 0){ echo "checked"; } ?> > <span class="label-text">Non-Married</span>
                                                                            </label>                                                                            
                                                                        </div>                                                                          
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <label for="l38">Login Status <span class="required_sign">**</span></label>
                                                                    <div class="form-group">
                                                                        
                                                                         <div class="radiobox">
                                                                            <label>
                                                                                <input type="radio" required name="is_active" value="1" <?php if($userData['is_active'] == 1){ echo "checked"; } ?> > <span class="label-text">Active</span>
                                                                            </label>
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            <label>
                                                                                <input type="radio" required name="is_active" value="0" <?php if($userData['is_active'] == 0){ echo "checked"; } ?> > <span class="label-text">Deactive</span>
                                                                            </label>                                                                            
                                                                        </div>                                                                        
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="father_name">Father Name</label>

                                                                        <input class="form-control" id="father_name" name="father_name" value="<?php echo $userData['father_name'] ?>" placeholder="Father Name" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="mother_name">Mother Name</label>

                                                                        <input class="form-control" id="mother_name" name="mother_name" value="<?php echo $userData['mother_name'] ?>"  placeholder="Mother Name" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                         <label for="present_working_institute_name">Present Working Institute Name</label>

                                                                        <input class="form-control" id="present_working_institute_name" name="present_working_institute_name" value="<?php echo $userData['present_working_institute_name'] ?>" placeholder="Present Working Institute Name" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                       <label for="l30">Present Working Institute Nature Of Business</label>

                                                                        <input class="form-control"  id="present_working_institue_business" name="present_working_institue_business" value="<?php echo $userData['present_working_institue_business'] ?>" placeholder="Present Working Institute Nature Of Business" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                         <label for="l30">Present Working Institute Designation</label>

                                                                        <input class="form-control" id="present_working_institute_desingnation" name="present_working_institute_desingnation" value="<?php echo $userData['present_working_institute_desingnation'] ?>" placeholder="Present Working Institute Designation" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                         <label for="nationality">Nationality</label>

                                                                    <input class="form-control" id="nationality" name="nationality" value="<?php echo $userData['nationality'] ?>" placeholder="Present Working Institute Designation" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                          <label for="l30">Work Phone</label>

                                                                        <input class="form-control" id="work_phone" name="work_phone" value="<?php echo $userData['work_phone'] ?>" placeholder="Work Phone" type="text">
                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="l30">Spouse Name (if any)</label>

                                                                        <input class="form-control" id="spouse_name" name="spouse_name" value="<?php echo $userData['spouse_name'] ?>"  placeholder="Spouse Name (if any)" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="l30">Spouse Profession (if any)</label>

                                                                        <input class="form-control" id="spouse_profession" name="spouse_profession" value="<?php echo $userData['spouse_profession'] ?>" placeholder="Spouse Profession (if any)" type="text">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                         <label for="l30">Spouse Nationality (if any</label>

                                                                        <input class="form-control" id="spouse_nationality" name="spouse_nationality" value="<?php echo $userData['spouse_nationality'] ?>" placeholder="Spouse Nationality (if any)" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                          <label for="l30">Emergency Contact Name</label>

                                                                        <input class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="<?php echo $userData['emergency_contact_name'] ?>" placeholder="Emergency Contact Name" type="text">
                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                         <label for="l30">Emergency Contact Phone</label>

                                                                        <input class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" value="<?php echo $userData['emergency_contact_phone'] ?>" placeholder="Emergency Contact Phone" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                         <label for="l30">Emergency Contact Fax</label>

                                                                        <input class="form-control" id="emergency_contact_fax" name="emergency_contact_fax" value="<?php echo $userData['emergency_contact_fax'] ?>" placeholder="Emergency Contact Fax" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                         <label for="l30">Emergency Contact Email</label>

                                                                        <input class="form-control" id="emergency_contact_email" name="emergency_contact_email" value="<?php echo $userData['emergency_contact_email'] ?>" placeholder="Emergency Contact Email" type="text">
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="present_address">Present Address</label>

                                                                        <textarea class="form-control"  id="present_address" name="present_address" rows="3"><?php echo $userData['present_address'] ?></textarea>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="permanent_addess">Permanent Address</label>
                                                                        <textarea class="form-control"  id="permanent_addess" name="permanent_addess" rows="3"><?php echo $userData['parmanent_address'] ?></textarea>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="l38">Profile Picture</label>
                                                                        
                                                                        <input class="form-control" id="avatar" name="avatar" placeholder="select profile picture" type="file">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 offset-lg-1">
                                                                    <div class="form-group">
                                                                        <label for="234">Joining Date <span class="required_sign">**</span></label>
                                                                        <input class="form-control" required id="joining_date" name="joining_date"   value="<?php echo $userData['joining_date']; ?>" type="date">
                                                                        
                                                                    </div>
                                                                </div>  
                                                            </div>

                                                            <div class="form-actions btn-list">
                                                                 <input type="submit" name="user_profile_update" class="btn btn-primary" value="update">
                                                                <!-- <input type="button" onclick="userUpdate()" class="btn btn-primary" value="update"> -->
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- /.widget-holder -->
                                                </div>

                                            </div>
                                            <!-- Profile  Section End -->



                                             <!-- Relative  Section Start -->
                                            <div class="tab-pane" id="user-relative">
                                                <div class="widget-heading clearfix">
                                                    <h5>User Relative</h5>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-user-relative-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></button>
                                                </div>
                                                <!-- /.widget-heading -->
                                                <div class="widget-body clearfix">
                                                    <table id="user_relative_talble" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Relative Name</th>
                                                                <th>Relation with user</th>
                                                                <th>Date Of Birth</th>
                                                                <th>Relative Institute Name</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $sl = 1;
                                                                $allRelativeWithUserSql ="SELECT * FROM user_relatives WHERE user_id='$user_id'";
                                                                $allRelativeWithUserQuery = mysqli_query($connect,$allRelativeWithUserSql);
                                                                while($allRelativeWithUserData = mysqli_fetch_array($allRelativeWithUserQuery)){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $sl++; ?></td>
                                                                        <td><?php echo $allRelativeWithUserData['name']; ?></td>
                                                                        <td><?php echo $allRelativeWithUserData['relation_with_user']; ?></td>
                                                                        <td><?php echo $allRelativeWithUserData['date_of_birth']; ?></td>
                                                                        <td><?php echo $allRelativeWithUserData['institute_name']; ?></td>
                                                                        <td>
                                                                            <button data-toggle="modal" data-target="#edit-user-relative-modal" class="btn btn-primary btn-sm" onclick="editRelativeInformation(<?php echo $allRelativeWithUserData['id'] ?>)"><i class="list-icon lnr lnr-pencil"></i></button>                                                                       
                                                                            <button class="btn btn-danger btn-sm" onclick="deleteRelativeInformation(<?php echo $allRelativeWithUserData['id'] ?>)"><i class="list-icon lnr lnr-trash"></i></button>                                                                       
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }

                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.widget-body -->
                                            </div>
                                             <!-- Relative  Section End -->

                                             <!-- Eduction  Section Start -->
                                            <div class="tab-pane" id="user-education">
                                                <div class="widget-heading clearfix">
                                                    <h5>User Education</h5>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-user-education-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></button>
                                                </div>
                                                <!-- /.widget-heading -->
                                                <div class="widget-body clearfix">
                                                    <table id="user_education_talble" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Institute Name</th>
                                                                <th>Professional Education</th>
                                                                <th>Semina/Trainning</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $sl = 1;
                                                                $allEductionWithUserSql ="SELECT * FROM user_educations WHERE user_id='$user_id'";
                                                                $allEducationWithUserQuery = mysqli_query($connect,$allEductionWithUserSql);
                                                                while($allEducationUserData = mysqli_fetch_array($allEducationWithUserQuery)){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $sl++; ?></td>
                                                                        <td><?php echo $allEducationUserData['institute_name']; ?></td>
                                                                        <td><?php echo $allEducationUserData['profession_education']; ?></td>
                                                                        <td><?php echo $allEducationUserData['seminar_training']; ?></td>
                                                                        <td>
                                                                            <button data-toggle="modal" data-target="#edit-user-education-modal" class="btn btn-primary btn-sm" onclick="editEducationInformation(<?php echo $allEducationUserData['id'] ?>)"><i class="list-icon lnr lnr-pencil"></i></button>                                                                       
                                                                            <button class="btn btn-danger btn-sm" onclick="deleteEducationInformation(<?php echo $allEducationUserData['id'] ?>)"><i class="list-icon lnr lnr-trash"></i></button>                                                                       
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }

                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.widget-body -->
                                            </div>
                                             <!-- Education  Section End -->


                                             <!-- Experience  Section Start -->
                                            <div class="tab-pane" id="user-experience">
                                                <div class="widget-heading clearfix">
                                                    <h5>User Experience</h5>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-user-experience-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></button>
                                                </div>
                                                <!-- /.widget-heading -->
                                                <div class="widget-body clearfix">
                                                    <table id="user_exparience_table" class="table table-bordered table-striped ">
                                                        <thead>
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Institute Name</th>
                                                                <th>Appointment Date</th>
                                                                <th>Designation</th>
                                                                <th>Responsibilities</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $sl = 1;
                                                                $allExperienceWithUserSql ="SELECT * FROM user_experiences WHERE user_id='$user_id'";
                                                                $allExperienceWithUserQuery = mysqli_query($connect,$allExperienceWithUserSql);
                                                                while($allExperienceWithUserData = mysqli_fetch_array($allExperienceWithUserQuery)){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $sl++; ?></td>
                                                                        <td><?php echo $allExperienceWithUserData['institute_name']; ?></td>
                                                                        <td><?php echo $allExperienceWithUserData['appointment_date']; ?></td>
                                                                        <td><?php echo $allExperienceWithUserData['designation']; ?></td>
                                                                        <td><?php echo $allExperienceWithUserData['responsibilities']; ?></td>
                                                                        <td>
                                                                            <button data-toggle="modal" data-target="#edit-user-experience-modal" class="btn btn-primary btn-sm" onclick="editExperienceInformation(<?php echo $allExperienceWithUserData['id'] ?>)"><i class="list-icon lnr lnr-pencil"></i></button>                                                                       
                                                                            <button class="btn btn-danger btn-sm" onclick="deleteExperienceInformation(<?php echo $allExperienceWithUserData['id'] ?>)"><i class="list-icon lnr lnr-trash"></i></button>                                                                       
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }

                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.widget-body -->
                                            </div>
                                             <!-- Relative  Section End -->

                                             <!-- User Document Start -->
                                            <div class="tab-pane" id="user-document">
                                                <div class="widget-heading clearfix">
                                                    <h5>User Docuement</h5>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-user-document-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></button>
                                                </div>
                                                <!-- /.widget-heading -->
                                                <div  class="widget-body clearfix">
                                                    <table id="user_document_list"  class="table table-bordered table-striped ">
                                                        <thead>
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Docuemnt Name</th>
                                                                <th>Download Link</th>
                                                                <th>Created At</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $sl = 1;
                                                                $allDocumentWithUserSql ="SELECT * FROM user_documents WHERE user_id='$user_id' and company_id='$company_id'";
                                                                $allDocumentWithUserQuery = mysqli_query($connect,$allDocumentWithUserSql);
                                                                $allDocumentCount = mysqli_num_rows($allDocumentWithUserQuery);
                                                                if($allDocumentCount > 0){
                                                                    while($allDocumentWithUserData = mysqli_fetch_array($allDocumentWithUserQuery)){
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $sl++; ?></td>
                                                                            <td><?php echo $allDocumentWithUserData['document_name']; ?></td>
                                                                            <td style="text-align: center;">
                                                                                <?php
                                                                                    $documentPath = sprintf('%sstorage/company/%s/users/user-document/%s',$addDot,$company_id,$allDocumentWithUserData['document_file']);
                                                                                ?>
                                                                                <a  class="btn btn-primary btn-sm" href="<?php echo $documentPath; ?>" download="">
                                                                                    <i class="list-icon lnr lnr-download"></i> &nbsp; Download
                                                                                </a>
                                                                            </td>
                                                                            <td><?php echo  date('jS F,Y',strtotime($allDocumentWithUserData['created_at'])); ?></td>
                                                                            <td>      
                                                                                <!-- <button data-toggle="modal" data-target="#edit-user-document-modal" class="btn btn-primary btn-sm" onclick="editUserDocument(<?php echo $allDocumentWithUserData['id'] ?>)"><i class="list-icon lnr lnr-pencil"></i></button>   -->                                                        
                                                                                <button class="btn btn-danger btn-sm" onclick="deleteUserDocument(<?php echo $allDocumentWithUserData['id'] ?>)"><i class="list-icon lnr lnr-trash"></i></button>                                                                       
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                

                                                            ?>                                                     
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.widget-body -->
                                            </div>
                                              <!-- User Document Start -->

                                              <!-- Relative  Section Start -->
                                            <div class="tab-pane" id="share-holder">
                                                <div class="widget-heading clearfix">
                                                    <h5>User Share Holder</h5>
                                                    <?php
                                                        if(userDataCheckInProfiTable($company_id,$user_id) == true){
                                                            ?>
                                                                 <button class="btn btn-sm btn-danger" style="float:right;"><span>Already Added User Share Holder</span></button>
                                                            <?php
                                                        }else{
                                                            ?>  
                                                                 <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-share-holder-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></button>
                                                            <?php
                                                        }
                                                    ?>
                                                   
                                                </div>
                                                <!-- /.widget-heading -->
                                                <div class="widget-body clearfix">
                                                    <table id="user_share_table" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>SL</th>
                                                                <th>Own Share</th>
                                                                <th>Family Share</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $sl = 1;
                                                                $shareSql ="SELECT user_id,own_share,family_share FROM user_profiles WHERE user_id='$user_id'";
                                                                $shareQuery = mysqli_query($connect,$shareSql);
                                                                while($shareData = mysqli_fetch_array($shareQuery)){
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $sl++; ?></td>
                                                                        <td><?php echo $shareData['own_share']; ?></td>
                                                                        <td><?php echo $shareData['family_share']; ?></td>
                                                                        <td>
                                                                            <button data-toggle="modal" data-target="#edit-user-share-modal" class="btn btn-primary btn-sm" onclick="editUserShareModal(<?php echo $shareData['user_id'] ?>)"><i class="list-icon lnr lnr-pencil"></i></button>                                                                       
                                                                            <button class="btn btn-danger btn-sm" onclick="deleteShare(<?php echo $shareData['user_id'] ?>)"><i class="list-icon lnr lnr-trash"></i></button>                                                                       
                                                                        </th>
                                                                    </tr>
                                                                    <?php
                                                                }

                                                            ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.widget-body -->
                                            </div>
                                             <!-- Relative  Section End -->
                                            
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- /.tabs -->
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
        <input type="hidden" name="user_id" id="user_id" value="<?php  echo $user_id; ?>">

    <!--  User Relative Add Modal Start  --> 
        <div id="add-user-relative-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-user-relative">
                            
                            <div class="form-group">
                                <label for="name">Relative Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="relative_name" id="relative_name" required="" placeholder="John Doe">
                            </div>
                            <div class="form-group">
                                <label for="relation_with_user">Relation with Relative <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="relation_with_user" id="relation_with_user" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="emailaddress">Relative Date of birth</label>
                                <input class="form-control" type="date" name="relative_date_of_birth" id="relative_date_of_birth" >
                            </div>
                            <div class="form-group">
                                <label for="password">Institute name where relative is director</label>
                                <input class="form-control" type="text" name="relative_institute_name"  id="relative_institute_name">
                            </div>
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="relative_data_store" class="btn btn-success" value="save">
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->            
    <!--  User Relative Add Modal End  -- > 


    <-- User Relative Edit Modal Start  --> 
        <div id="edit-user-relative-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-user-relative">
                            <input type="hidden" name="update_user_realtive_id" id="update_user_realtive_id">
                            <div class="form-group">
                                <label for="name">Relative Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_relative_name" id="edit_relative_name" required="">
                            </div>
                            <div class="form-group">
                                <label for="relation_with_user">Relation with Relative <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_relation_with_user" id="edit_relation_with_user" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="emailaddress">Relative Date of birth</label>
                                <input class="form-control" type="date" name="edit_relative_date_of_birth" id="edit_relative_date_of_birth">
                            </div>
                            <div class="form-group">
                                <label for="password">Institute name where relative is director</label>
                                <input class="form-control" type="text" name="edit_relative_institute_name"  id="edit_relative_institute_name">
                            </div>
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="updaterelative_data_store" class="btn btn-success" value="update">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>       
    <!--  User Relative edit Modal End  -- > 



    <--  Add User education modal start  --> 
    <div id="add-user-education-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-user-education">
                            <input type="hidden" name="education_user_id" id="education_user_id" value="<?php  echo $user_id; ?>">
                            <div class="form-group">
                                <label for="name">Institute Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="education_institute_name" id="education_institute_name" required="">
                            </div>
                            <div class="form-group">
                                <label for="relation_with_user">Professional Education <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="education_profession_education" id="education_profession_education" required="">
                            </div>
                            <div class="form-group">
                                <label for="password">Seminar/Training</label>
                                <input class="form-control" type="text" name="education_seminar_training"  id="education_seminar_training">
                            </div>
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="education_data_store" class="btn btn-success" value="save">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->            
    <!--  Add user education modal end  -- > 


    <--  Edit user education modal start  --> 
        <div id="edit-user-education-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-user-education">
                            <input type="hidden" name="edit_user_education_id" id="edit_user_education_id">
                            <div class="form-group">
                                <label for="name">Institute Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_education_institute_name" id="edit_education_institute_name" required="">
                            </div>
                            <div class="form-group">
                                <label for="relation_with_user">Professional Education <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_education_profession_education" id="edit_education_profession_education" required="">
                            </div>
                            <div class="form-group">
                                <label for="password">Seminar/Training</label>
                                <input class="form-control" type="text" name="edit_education_seminar_training"  id="edit_education_seminar_training">
                            </div>
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="update_education_data" class="btn btn-success" value="update">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>       
    <!--  Edit Uer Education modal end -- > 



    <--  User Experience Modal start  --> 
    <div id="add-user-experience-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-user-experience">
                            <div class="form-group">
                                <label for="name">Institute Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="experience_institute_name" id="experience_institute_name" required="">
                            </div>
                            <div class="form-group">
                                <label for="relation_with_user">Date of Appointment <span class="required_sign">**</span></label>
                                <input class="form-control" type="date" name="experience_appointment_date" id="experience_appointment_date" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="emailaddress">Designation <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="experience_designation" id="experience_designation" required="" >
                            </div>
                            <div class="form-group">
                                <label for="password">Responsibilities <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="experience_responsibilities"  id="experience_responsibilities">
                            </div>
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="experience_data_store" class="btn btn-success" value="save">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->            
    <!--  Add User Experience Modal End -- > 


    <--  Edit user expreirecne modal start  --> 
        <div id="edit-user-experience-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-user-experience">
                            <input type="hidden" name="update_user_experience_id" id="update_user_experience_id">
                            <div class="form-group">
                                <label for="name">Institute Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_experience_institute_name" id="edit_experience_institute_name" required="">
                            </div>
                            <div class="form-group">
                                <label for="relation_with_user">Date of Appointment <span class="required_sign">**</span></label>
                                <input class="form-control" type="date" name="edit_experience_appointment_date" id="edit_experience_appointment_date" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="emailaddress">Designation <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_experience_designation" id="edit_experience_designation" required="" >
                            </div>
                            <div class="form-group">
                                <label for="password">Responsibilities <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_experience_responsibilities"  id="edit_experience_responsibilities">
                            </div>
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="update_experience_data_store" class="btn btn-success" value="update">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>       
 <!--  Edit User Experience Modal End  --> 


 
    <!--  Add User Document Modal Start  --> 
    <div id="add-user-document-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-user-document-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Document Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="user_document_name" id="user_document_name" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">Document Upload<span class="required_sign">**</span></label>
                                <input type="file" class="form-control" name="user_document_file" id="user_document_file" required="">
                            </div>
                            <div class="text-center mr-b-30">
                                <input type="submit" id="user_document_submit" class="btn btn-success" value="save">
                            </div>                        
                        </form>                           
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->            
    <!-- Edit User Document Modal End  -- > 

 <-- Edit user document modal start  --> 
 <div id="edit-user-document-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-user-document" enctype="multipart/form-data">
                            <input type="hidden" name="edit_user_document_id" id="edit_user_document_id">
                            <div class="form-group">
                                <label for="name">Document Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_user_document_name" id="edit_user_document_name" required="">
                            </div>
                            <div class="text-center mr-b-30">
                                <input type="submit" id="edit_user_document_submit" class="btn btn-success" value="update">
                            </div>     
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>       
 <!--  Edit user document modal end  --> 


  <!-- Add Company Share Holder Tab Start  --> 
  <div id="add-share-holder-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-user-share-form" enctype="multipart/form-data">
                        <div class="form-group">
                                <label for="name">Own Share<span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="own_share" id="own_share" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">Family Share</label>
                                <input class="form-control" type="text" name="family_share" id="family_share">
                            </div>
                            <div class="text-center mr-b-30">
                                <input type="submit" id="user_share_holder_submit" class="btn btn-success" value="save">
                            </div>                   
                        </form>                           
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->            
    <!-- Add User Share modal end  -- > 


     <-- Edit user document modal start  --> 
 <div id="edit-user-share-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-user-share" enctype="multipart/form-data">
                        <input type="hidden" name="update_user_share_id" id="update_user_share_id">
                        <div class="form-group">
                                <label for="name">Own Share<span class="required_sign">**</span></label>
                                <input class="form-control" type="text" name="edit_own_share" id="edit_own_share" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">Family Share</label>
                                <input class="form-control" type="text" name="edit_family_share" id="edit_family_share">
                            </div>
                            <div class="text-center mr-b-30">
                                <input type="submit" id="user_share_holder_update" class="btn btn-success" value="update">
                            </div>     
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>       
 <!--  Edit user document modal end  --> 

<?php include '../partial/_footer.php';?>
<?php
        if(isset($_SESSION['user_profile_update_massage'])){
            $user_profile_update_massage = $_SESSION['user_profile_update_massage'];
            if($user_profile_update_massage == true){
            ?>
                <script>
                    $.toast({
                        heading: 'User Profile',
                        text: 'User Profile Update  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }else{
                ?>
                <script>
                    $.toast({
                        heading: 'User Profile',
                        text: 'User Profile Update Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['user_profile_update_massage'] = null;
        }
    ?>
     
    <script>
        $(document).ready(function(){
            var user_designation  = $('#is_share_holder').val();
            if(user_designation == "share_holder"){
                $('#share_holder_tab').show();
            }else{
                $('#share_holder_tab').hide();
            }
        })
        $('#designation').on('change',function(){
            var designation = $(this).val();
            if(designation == "share_holder"){
                $('#share_holder').show();
            }else{
                $('#share_holder').hide();
            }
        });

        
function userUpdate() {
    swal({
        title: 'Are you sure?',
        text: "You want to do this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            document.getElementById("user-profile-update-form").submit();
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Your data is safe :)',
                'error'
            )
        }
    })
}


    </script> 
    <script src="<?php echo $addDot; ?>assets/custom-js/user-profile.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/user-relative.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/user-education.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/user-experience.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/user-document.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/user-share.js"></script>
 
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
</body>
</html>