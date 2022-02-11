<!-- Database Connection -->
<?php
    include 'zoom-functions.php';
?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }
    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['submit'])) {
        $meeting_unique_id = $_POST['meeting_unique_id'] ?? '';
        $meeting_id        = $_POST['meeting_id'] ?? '';
        $title             = $_POST['title'] ?? '';
        $date              = $_POST['date'] ?? '';
        $time              = $_POST['time'] ?? '';
        $duration          = $_POST['duration'] ?? '';
        $password          = $_POST['password'] ?? '';

        $dateTime = sprintf("%sT%s:00", $date, $time);
    }

?>

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Zoom Meeting</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Zoom meeting Response</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Zoom Meeting Response</li>
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
                                <h5 class="box-title">Zoom Meeting Response
                                <a href="../meeting-setup.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-danger" style="float:right;">
                                <i class="list-icon lnr  lnr-undo"></i> &nbsp;&nbsp; <span>Back To Meeting Panel</span></a>
                                </h5>
                                <hr>

                                <?php
                                    $meetingCall = create_meeting($company_id,$meeting_id,$title,$dateTime,$duration,$password);
                                    if(isset($meetingCall)){
                                        $joinUrl = $meetingCall['join_url'] ?? '';
                                        $joinCode = $meetingCall['id'] ?? '';
                                        $joinPassword = $meetingCall['password'] ?? '';
                                        $topic = $meetingCall['topic'] ?? '';    

                                        $date = date('Y-m-d',strtotime($dateTime));
                                        $time = date('h:i a',strtotime($dateTime));
                                        
                                        if($joinUrl != ''){
                                            if( zoomMeetingInfo($company_id, $meeting_id, $topic, $date, $time, $duration, $joinCode, $joinUrl, $joinPassword, $user_id) != true){
                                                echo "Mail sent failed";
                                                die();
                                            }
                                        }
                                        
                                ?>

                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <div class="list-group">
                                                <a href="#"  class="text-center list-group-item list-group-item-action d-flex justify-content-end">
                                                    <span class="mr-auto mr-0-rtl ml-auto-rtl">
                                                    <?php echo $topic; ?>
                                                    </span> 
                                                    
                                                    
                                                </a>

                                                <a href=" <?php echo $joinUrl; ?> " class="list-group-item list-group-item-action d-flex justify-content-end">
                                                    <span class="mr-auto mr-0-rtl ml-auto-rtl">
                                                        Join Url : 
                                                    </span> 
                                                    <span class="badge badge-pill bg-danger-contrast fs-12 mr-1 my-auto">
                                                        <?php echo $joinUrl; ?>
                                                    </span> 
                                                    
                                                </a>
                                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-end">
                                                    <span class="mr-auto mr-0-rtl ml-auto-rtl">
                                                        Zoom id : 
                                                    </span> 
                                                    <span class="badge badge-pill bg-danger-contrast fs-12 mr-1 my-auto">
                                                        <?php echo $joinCode; ?>
                                                    </span> 
                                                    
                                                </a>

                                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-end">
                                                    <span class="mr-auto mr-0-rtl ml-auto-rtl">
                                                       Zoom Password : 
                                                    </span> 
                                                    <span class="badge badge-pill bg-danger-contrast fs-12 mr-1 my-auto">
                                                    <?php echo $joinPassword; ?>
                                                    </span> 
                                                    
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                <?php 
                                    }
                                    
                                ?>
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
</body>

</html>