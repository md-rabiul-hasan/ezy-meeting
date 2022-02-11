<!-- Database Connection -->
<?php 
    include '../../database_connection.php';
    require_once 'config.php';
?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }
    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    $meeting_unique_id = $_GET['meeting_id'] ?? '';

    $meeting_id = meetingId($meeting_unique_id);
    $_SESSION['session_meeting_id'] = '';
    $_SESSION['session_meeting_id'] = $meeting_id;

    $db = new DB();
    $apiCredential = $db->getZoomApiCridential($company_id);
    
    $url = sprintf($apiCredential['login_url']."&company_id=%d&meeting_id=%d&entry_user_id=%d" ,CLIENT_ID,REDIRECT_URI,$compnay_id,$meeting_id,$user_id);
        
?>

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Zoom Meeting</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Zoom Login</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Zoom Login</li>
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
                                <div class="widget-body clearfix">
                                <h5 class="box-title">Zoom Meeting Call
                                <a href="../meeting-setup.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-danger" style="float:right;">
                                <i class="list-icon lnr  lnr-undo"></i> &nbsp;&nbsp; <span>Back To Meeting Panel</span></a>
                                </h5>
                                <hr>
                                <a href="<?php echo $url;?>" class="btn btn-sm btn-success">
                                    <i class="list-icon lnr  lnr-undo"></i> &nbsp;&nbsp; <span>Generate Meeting Token</span>
                                </a>
                                    
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
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>

</html>