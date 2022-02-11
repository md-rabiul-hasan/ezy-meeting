<!-- Database Connection -->
<?php include '../../database_connection.php';?>
<?php session_start(); ?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
$user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Meeting List</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">company all Meeting list</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meeting</li>
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
                        <!-- /.widget-holder -->
                        <div class="widget-holder col-md-12">
                            <div class="widget-bg">
                                <div class="widget-body">
                                    <h5 class="box-title">Meeting List</h5>
                                    <p>List of all meeting .
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#meeting-create-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span>
                                        </button>
                                    </p>
                                    <table class="table table-striped table-bordered" id="company_meeting_list">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Meeting Date</th>
                                                <th>Meeting Time</th>
                                                <th>Meeting Location</th>
                                                <th>Meeting Status</th>
                                                <th>Edit Meeting</th>
                                                <th>Delete Meeting</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $allUserSql = "SELECT * FROM meetings WHERE company_id='$company_id' and entry_user_id='$user_id'";
                                                $allUserQuery = mysqli_query($connect,$allUserSql);
                                                $sl = 1;
                                                while($allUserData = mysqli_fetch_array($allUserQuery)){
                                                    $meeting_id=$allUserData['meeting_id'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allUserData['title']; ?>
                                                        </td>
                                                        <!-- <td>
                                                            <?php echo $allUserData['description']; ?>
                                                        </td> -->
                                                        <!--  <td>
                                                        <?php 
                                                            $committeeChairman = $allUserData['chairman_id'];
                                                            $userListSqlC = "SELECT name from users where id in ($committeeChairman)";
                                                            $userListQueryC = mysqli_query($connect,$userListSqlC);
                                                            while($userListDataC = mysqli_fetch_array($userListQueryC)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $userListDataC['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td> -->
                                                       <!--  <td>
                                                        <?php 
                                                            $committeeUsers = $allUserData['committee_users'];
                                                            $userListSql = "SELECT name from users where id in ($committeeUsers)";
                                                            $userListQuery = mysqli_query($connect,$userListSql);
                                                            while($userListData = mysqli_fetch_array($userListQuery)){
                                                                ?>
                                                                    <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo $userListData['name'];  ?></span>
                                                                <?php
                                                            }

                                                        ?>
                                                        </td> -->
                                                        <td>
                                                            <?php echo $allUserData['meeting_date']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allUserData['meeting_time']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allUserData['location']; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($allUserData['is_open']==0) { ?>
                                                                <span class="btn btn-sm btn-round btn-success mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo "Open";  ?></span>

                                                                <?php
                                                            }else
                                                            {
                                                                ?>
                                                            
                                                                <span class="btn btn-sm btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;"><?php echo "Closed";  ?></span>
                                                            <?php
                                                        }
                                                            ?>
                                                        </td>                                                        
                                                        <td>
                                                            <button class="btn btn-sm btn-success edit_data_class"  data-toggle="tooltip" data-placement="top" title="Hooray!"  style="float:right;" id="<?php print $meeting_id;?>">  <span>Edit</span>
                                                            </button>
                                                         </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger delete_data_class"  style="float:right;" id="del_<?php print $meeting_id;?>"><span>delete</span>
                                                            </button>
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
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


<?php include '../../partial/_footer.php';?>
    <script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/bootstrap-notify.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>  
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>