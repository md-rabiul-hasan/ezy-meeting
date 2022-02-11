<!-- Database Connection -->
<?php include '../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }
    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>

<!-- meetin Data -->
<?php
    if(isset($_GET['id'])){
        $meetingId = $_GET['id'];
        $meetingSql = "SELECT * FROM meetings where meeting_unique_id='$meetingId'";
        $meetingQuery = mysqli_query($connect,$meetingSql);
        $meetingData = mysqli_fetch_array($meetingQuery);
        $committee_id=$meetingData['committee_id'];
        $company_id=$meetingData['company_id'];
        $committee_id=$meetingData['committee_id'];
    }

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
                            <h6 class="page-title-heading mr-0 mr-r-5">Add Agenda </h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Company Meeting Agenda</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                 <li class="breadcrumb-item active">Add Agenda from Draft</li>
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
                                <h5 class="box-title">Meeting Edit</h5>
                                    <form id="edit-meeting" action="agendaListUpdate.php?id=<?php echo $meetingData['id'];  ?>" method="POST">
                                        <div class="form-group select_error row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Committee</label>
                                            <div class="col-sm-9">
                                                <select class="m-b-10 form-control select2"  required="" name="committee_id" id="committee_id" data-toggle="select2">
                                                    <optgroup label="Committee List">
                                                        
                                                        <?php
                                                            $comSql = "SELECT id,name FROM committees WHERE company_id='$company_id' and id='$committee_id'";
                                                            $allComQuery = mysqli_query($connect,$comSql);
                                                            while($allComData = mysqli_fetch_array($allComQuery)){
                                                                ?>
                                                                    <option value="<?php echo $allComData['id']; ?>" <?php if($meetingData['committee_id'] == $allComData['id'] ) { echo "selected"; } ?> ><?php echo $allComData['name']; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </optgroup>                                                
                                                </select>
                                            </div>                                           
                                        </div>
                                        <div class="form-group select_error row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Draft Agenda</label>
                                            <div class="col-sm-9">
                                                <select class="m-b-10 form-control select2"  required="" name="agenda_id[]" id="committee_id" data-toggle="select2" multiple="multiple">
                                                    <optgroup label="Committee List">
                                                        
                                                        <?php
                                                            $AgnSql = "SELECT * FROM `agendas` WHERE `status` = 2";
                                                            $agnDataQ = mysqli_query($connect,$AgnSql);
                                                            while($agnData = mysqli_fetch_array($agnDataQ)){
                                                                ?>
                                                                    <option value="<?php echo $agnData['id']; ?>"><?php echo $agnData['title']; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </optgroup>                                                
                                                </select>
                                            </div>                                           
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Title</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" value="<?php echo $meetingData['title']; ?>" name="title" id="title" required="" placeholder="">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control"  value="<?php echo $meetingData['meeting_date']; ?>"  name="meeting_date" id='meeting_date'>
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Time</label>
                                            <div class="col-sm-9">
                                            <input type="time" class="form-control" value="<?php echo $meetingData['meeting_time']; ?>"  name="meeting_time" required>
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Location</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" id="location" value="<?php echo $meetingData['location']; ?>" name="location" required="" >
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3"></label>
                                            <div class="col-sm-9">
                                                <input type="submit" value="Add" class="btn btn-success">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        
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
    <script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
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


});
    </script>

    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/meeting.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>

</html>