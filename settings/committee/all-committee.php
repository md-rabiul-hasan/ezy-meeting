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
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
<!--            <div class="page-title">-->
<!--                <div class="container">-->
<!--                    <div class="row">-->
<!--                        <div class="page-title-left">-->
<!--                            <h6 class="page-title-heading mr-0 mr-r-5">Committee List</h6>-->
<!--                            <p class="page-title-description mr-0 d-none d-md-inline-block">company all committe list</p>-->
<!--                        </div>-->
<!--                         /.page-title-left -->
<!--                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">-->
<!--                            <ol class="breadcrumb">-->
<!--                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>-->
<!--                                </li>-->
<!--                                <li class="breadcrumb-item active">Settings</li>-->
<!--                                <li class="breadcrumb-item active">Committees</li>-->
<!--                            </ol>-->
<!--                        </div>-->
<!--                      /.page-title-right -->
<!--                    </div>-->
<!--                    /.row -->
<!--                </div>-->
<!--                 /.container -->
<!--            </div>-->
            <!-- /.page-title -->
            <!-- =================================== -->
            <!-- Different data widgets ============ -->
            <!-- =================================== -->
            <div class="container">
                <div class="widget-list   tablelists">
                    <div class="row">
                        <!-- /.widget-holder -->
                        <div class="widget-holder col-md-12 lisingv2" >
                            <div class="widget-bg" id="company_committee_list">
                                <div class="widget-body">
                                    <div class="tabletop">
                                  <div>  <h5 class="box-title">Committe List</h5></div>
                                    <p>This table has showing our company all committe list . </p>
                                        <div class="buttonright">
                                        <?php if(isEanableComitteCreate($company_id) != false): ?>
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#committee-create-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></button>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-danger"  style="float:right;"> <span>Already added maximum committee</span></button>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class=""></div>
                                      <div class="boxxarea table-responsive">
                                    <table class="table table-striped table-bordered dataTable" >
                                        <thead>
                                            <tr>
                                                <th width="35px">SL</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Chairman</th>
                                                <th>Members</th> 
                                                <th>Total Members</th>                                               
                                                <th>Prefix</th>
                                                <th>Quorum</th>
                                                <th>Current Index</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $allCommitteeSql = "SELECT committees.id as committee_id,committees.*,users.name as user_name FROM committees inner join users on committees.chairman_id=users.id WHERE users.company_id='$company_id'";
                                                $allCommitteeQuery = mysqli_query($connect,$allCommitteeSql);
                                                $sl = 1;
                                                while($allCommitteeData = mysqli_fetch_array($allCommitteeQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allCommitteeData['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allCommitteeData['description']; ?>
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $allCommitteeData['user_name']; ?></span>                                                            
                                                        </td>
                                                        <td>
                                                        <?php 
                                                            $committeeUsers = $allCommitteeData['committee_users'];
                                                            $userListSql = "SELECT name from users where id in ($committeeUsers)";
                                                            $userListQuery = mysqli_query($connect,$userListSql);
                                                            while($userListData = mysqli_fetch_array($userListQuery)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $userListData['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td>

                                                        <td>
                                                            <?php 
                                                                echo totalCommitteemembers($allCommitteeData['committee_id']);
                                                            ?>
                                                        </td>
                                                      
                                                        <td>
                                                            <?php echo $allCommitteeData['prefix']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allCommitteeData['quorum']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $allCommitteeData['current_index']; ?>
                                                        </td>
                                                        
                                                        <td style="width: 20px;">
                                                        <span>
                                                                <a class="btn btn-sm btn-warning editbtn" href="edit_committee.php?id=<?php echo encryptData($allCommitteeData['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            </span>
                                                            <span>
                                                                <button class="btn btn-sm btn-danger delbtn"   onclick="deleteCommittee(<?php echo $allCommitteeData['id'] ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }

                                            ?>  
                                           
                                        </tbody>
                                    </table>
                                      </div>

                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                    </div>
                    <div style="background: #fff; width: 100%;">
                        <img src="../../assets/img/meeting-bg.png" alt="">
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


        <!-- Add Modal Added  Start -->
         <!-- Custom Modals -->
                
                <!-- Signup Modal -->
                <div id="committee-create-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">
                                <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                                </div>
                                <form action="#" id="add-committee-form">
                                    <div class="form-group">
                                        <label for="name">Committee Name <span class="required_sign">**</span></label>
                                        <input class="form-control" type="text" name="name" id="name" required="" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Description </label>
                                        <input class="form-control" type="text" id="description" name="description">
                                    </div>
                                    <div class="form-group select_error">
                                        <label for="name">Select Chairman <span class="required_sign">**</span></label>
                                        <select class="m-b-10 form-control select2"  required="" name="chairman_id" id="chairman_id">
                                            <optgroup label="Chairman  List">
                                                <option value="">Select Chairman</option>
                                                <?php
                                                    $allMemberListSql = "SELECT id,name FROM users WHERE company_id='$company_id' and (role_id != 1 and  role_id != 2)";
                                                    $allMemberQuery = mysqli_query($connect,$allMemberListSql);
                                                    while($allMemberData = mysqli_fetch_array($allMemberQuery)){
                                                        ?>
                                                            <option value="<?php echo $allMemberData['id']; ?>">
                                                            <?php echo $allMemberData['name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                 ?>
                                                
                                            </optgroup>                                                
                                        </select>
                                    </div>
                                    <div class="form-group select_error">
                                        <label class="form-control-label">Select Committees Members <span class="required_sign">**</span></label>
                                        <select class="m-b-10 form-control select2"  required="" name="committee_users" id="committee_users" multiple="multiple">
                                            <optgroup label="Member List">
                                                <option value="">Select Members</option>
                                            </optgroup>                                                
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="emailaddress">Short Name</label>
                                        <input class="form-control" type="text" id="prefix" >
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Quorum <span class="required_sign">**</span></label>
                                        <input class="form-control" type="text" id="quorum" required="" >
                                        <span id="quorum_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Current Index</label>
                                        <input class="form-control" type="text" id="current_index" >
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

      
<?php include '../../partial/_footer.php';?>
<?php
        if(isset($_SESSION['msg'])){
            $message = $_SESSION['msg'];
            if($message == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Committee Setup',
                        text: 'Committee Updated  Successfully.',
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
                        heading: 'Committee Setup',
                        text: 'Committee Updated  Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['msg'] = null;
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
            $("#add-committee-form").validate({
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


        $(document).ready(function() {
            $('#committee-create-modal .select2').each(function() {
                var $p = $(this).parent();
                $(this).select2({
                    dropdownParent: $p
                });
            });
        } );
    </script>
    <script src="<?php echo $addDot; ?>assets/custom-js/settings/committee.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->


</body>
</html>