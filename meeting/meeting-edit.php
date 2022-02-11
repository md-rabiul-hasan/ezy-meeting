<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }
    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>

<!-- meetin Data -->
<?php
    if(isset($_GET['id'])){
        $meetingId = decryptData(filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING));
        $meetingSql = "SELECT * FROM meetings where id='$meetingId'";
        $meetingQuery = mysqli_query($connect,$meetingSql);
        $meetingData = mysqli_fetch_array($meetingQuery);
    }

?>

<?php include '../partial/_header.php';?>
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
                            <h6 class="page-title-heading mr-0 mr-r-5">Meeting Edit</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Company Meeting Edit</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
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

                    <div class="col-md-8 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-body clearfix">
                                <h5 class="box-title">Meeting Edit</h5>
                                    <form id="edit-meeting" action="meeting-update.php?id=<?php echo $meetingData['id'];  ?>" method="POST">
                                        <div class="form-group select_error row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Select Committee <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <select class="m-b-10 form-control select2"  required="" name="committee_id" id="committee_id" data-toggle="select2">
                                                    <optgroup label="Committee List">
                                                        <option value="">Select Committee</option>
                                                        <?php
                                                            $comSql = "SELECT id,name FROM committees WHERE company_id='$company_id'";
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
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Title <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" value="<?php echo $meetingData['title']; ?>" name="title" id="title" required="" placeholder="">
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Date <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control datepicker"  value="<?php echo  date("m/d/Y", strtotime($meetingData['meeting_date'])); ?>"  name="meeting_date" id='meeting_date'>
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Time <span class="required_sign">**</span></label>
                                            <div class="col-sm-9">
                                            <input type="text" class="form-control clockpicker" value="<?php echo $meetingData['meeting_time']; ?>"  name="meeting_time" required>
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3">Meeting Location</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" id="location" value="<?php echo $meetingData['location']; ?>" name="location" >
                                            </div>
                                            <!-- /.col-sm-9 -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="text-left text-sm-right col-form-label col-sm-3"></label>
                                            <div class="col-sm-9">
                                                <input type="submit" value="Update" class="btn btn-success">
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



<?php include '../partial/_footer.php';?>
    <script>
          // suggesting meeting name start
          $('#committee_id').on('change',function(){
            var committee_id = $('#committee_id').val();
            if(committee_id != ''){
                $.ajax({
                    url: "meeting-name-suggesting.php",
                    method: 'post',
                    data: {
                        committee_id : committee_id
                    },
                    success:function(response){
                        
                        $('#title').val(response);
                    }
                });
            }
        });
        // suggesting meeting name end

        
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
$("#edit-meeting").validate({
    rules: {
        title: {
            required: true,
        },
        committee_id :{
            required: true,
        },
        meeting_date: {
            required: true,
        },
        meeting_time: {
            required: true,
        }        
    },
    messages: {
        title: {
            required: 'Please enter meeting title.',
        },
        committee_id :{
            required: 'Please select committee',
        },
        meeting_date: {
            required: "Please select meeting date",
        },
        meeting_time: {
            required: "Please select meeting time",
        }

    }
});

});

$('.datepicker').datepicker({
                startDate : new Date()
            })
            
    </script>

    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/meeting.js"></script>
</body>

</html>