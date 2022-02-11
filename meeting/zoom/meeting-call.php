<!-- Database Connection -->
<?php
    include '../../database_connection.php';
    require_once 'config.php';
?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }
    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    $meeting_id     = $_GET['meeting_id'] ?? '';
    $url_company_id = $_GET['company_id'] ?? '';

    // meeting info
    $meetingInfoSql    = "SELECT id,title,meeting_date,meeting_unique_id FROM meetings WHERE id='$meeting_id' and company_id='$url_company_id'";
    $meetingInfoQuery  = mysqli_query($connect, $meetingInfoSql);
    $meetingInfoData   = mysqli_fetch_array($meetingInfoQuery);
    $meetingTitle      = $meetingInfoData['title'] ?? '';
    $meetingDate       = $meetingInfoData['meeting_date'] ?? '';
    $meeting_unique_id = $meetingInfoData['meeting_unique_id'] ?? '';
    $meeting_id        = $meetingInfoData['id'] ?? '';

?>

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Zoom Meeting Call</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Zoom meeting Call</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Zoom Meeting Call</li>
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

                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                    <form action="create-meeting.php" method="POST">

                                        <input type="hidden" name="meeting_unique_id" value="<?php echo $meeting_unique_id; ?>">
                                        <input type="hidden" name="meeting_id" value="<?php echo $meeting_id; ?>">


                                        <label for="title">Meeting Title</label>
                                        <input type="text" class="form-control" value="<?php echo $meetingTitle; ?>" name="title">

                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" value="<?php echo $meetingDate; ?>" name="date">

                                        <label for="time">Time</label>
                                        <input type="time" class="form-control" name="time">

                                        <label for="duration">Duration (Minute)</label>
                                        <input type="number" class="form-control" name="duration" value="30">

                                        <label for="duration">Password <span style="margin-left:250px; cursor:pointer; color:red" id="generateStrongPassword">Generate Password</span> </label>
                                        <input type="text" class="form-control" name="password" id="password">
                                        <br>

                                        <input type="submit" name="submit" value="create meeting" class="btn btn-success">
                                    </form>
                                    </div>
                                </div>

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
        $('#generateStrongPassword').on('click',function(){
            var randomstring = Math.random().toString(36).slice(-8);
            $('#password').val(randomstring);
        });
    </script>
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>

</html>