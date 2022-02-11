<!-- Database Connection -->
<?php include '../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->
<?php
    if (isset($_GET['meeting_id'])) {
        $meeting_unique_id = $_GET['meeting_id'];
        $meetingInfoSql    = "SELECT id,title FROM meetings where meeting_unique_id='$meeting_unique_id' ";
        $meetingInfoQuery  = mysqli_query($connect, $meetingInfoSql);
        $meetingInfoData   = mysqli_fetch_array($meetingInfoQuery);
        $meeting_id        = $meetingInfoData['id'];

        // company setting info start
        $settingInfoSql   = "SELECT agenda_pefix FROM settings  WHERE company_id='$company_id'";
        $settingInfoQuery = mysqli_query($connect, $settingInfoSql);
        $settingInfoData  = mysqli_fetch_array($settingInfoQuery);
        // company setting info end

        // agenda sl info stat
        $agendaSlSql   = "SELECT max(agenda_sl) as max_agenda FROM agendas where meeting_id='$meeting_id' and company_id='$company_id' ";
        $agendaSlQuery = mysqli_query($connect, $agendaSlSql);
        $agendaSlData  = mysqli_fetch_array($agendaSlQuery);

        $agendaSerial = $agendaSlData['max_agenda'];
        if(!empty($agendaSerial)){
            $agendaSerial += 1;
        }else{
            $agendaSerial = 1;
        }
        // agenda sl info end
    }

    // meeting puslish or close
    $buttomSection = 'style="display: none;"';
    if(isMeetingPublish($company_id, $meeting_id) == true || isMeetingClose($company_id, $meeting_id) == true){
        $buttomSection = 'style="display: visible;"';
    }

?>

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5"><?php echo $meetingInfoData['title']; ?></h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Add Agenda</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Add Agenda</li>
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
                        <div class="widget-holder col-md-8">
                            <div class="widget-bg">
                                <div class="widget-body">
                                    <h5 class="box-title"><?php echo $settingInfoData['agenda_pefix']; ?><?php echo $agendaSerial; ?></h5>
                                    <form id="add-meeting-agenda-form" action="add-agenda-submit.php?meeting_id=<?php echo $meeting_id; ?>&meeting_unique_id=<?php echo $meeting_unique_id;  ?>" method="POST" enctype="multipart/form-data">

                                         <label for="name">Select Language <span class="required_sign">**</span></label>
                                    <div class="form-group"> 
                                        <label>
                                            <input type="radio" required checked  
                                             name="bedStatus" id="english" value="english"> <span class="label-text">English</span> &nbsp;&nbsp;&nbsp;
                                        </label>   
                                        <label>
                                            <input type="radio" required name="bedStatus" id="bangla" value="bangla"> <span class="label-text">Bangla</span>
                                        </label>   
                                    </div>


                                        <input type="hidden" name="agenda_sl" value="<?php echo $agendaSerial; ?>">
                                        <input type="hidden" name="agenda_pefix" value="<?php echo $settingInfoData['agenda_pefix']; ?>">

                                        <div class="form-group">
                                            <label for="name">Agenda Title <span class="required_sign">**</span></label>
                                            <input class="form-control agenda_title" type="text" name="title" id="title"  placeholder="">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 select_error">
                                                <label class="form-control-label">Select Memo Type <span class="required_sign">**</span></label>
                                                <select class="m-b-10 form-control"  name="memo_id" id="memo_id" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}'>
                                                    <optgroup label="Member List">
                                                        <option value="">Select Memo</option>
                                                        <?php
                                                            $memoSql   = "SELECT id,name FROM memos WHERE company_id='$company_id'";
                                                            $memoQuery = mysqli_query($connect, $memoSql);
                                                            while ($memoData = mysqli_fetch_array($memoQuery)) {
                                                            ?>
                                                                    <option value="<?php echo $memoData['id']; ?>"><?php echo $memoData['name']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>

                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 select_error">
                                                <label class="form-control-label">Select Division <span class="required_sign">**</span></label>
                                                <select class="m-b-10 form-control"  name="division_id" id="division_id" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}'>
                                                    <optgroup label="Member List">
                                                        <option value="">Select Division</option>
                                                        <?php
                                                            $divisionSql   = "SELECT id,name FROM divisions WHERE company_id='$company_id'";
                                                            $divisionQuery = mysqli_query($connect, $divisionSql);
                                                            while ($divisionData = mysqli_fetch_array($divisionQuery)) {
                                                            ?>
                                                                <option value="<?php echo $divisionData['id']; ?>"><?php echo $divisionData['name']; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="name">Client</label>
                                                    <input class="form-control" type="text" name="client" id="client" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Amount</label>
                                                    <input class="form-control" type="text" name="amount" id="amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 select_error">
                                            <label class="form-control-label">Explenatory <span class="required_sign">**</span></label><br>
                                                <label class="form-control-label">Select Agenda Templates</label>
                                                <select class="m-b-10 form-control"  name="explanatory_template_id" id="explanatory_template_id" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}'>
                                                    <optgroup label="Template List">
                                                        <option value="">Select Explanatory Agenda Template</option>
                                                        <?php
                                                            $templateSql   = "SELECT id,name FROM agenda_templates WHERE company_id='$company_id'  and  type=1 ";
                                                            $templateQuery = mysqli_query($connect, $templateSql);
                                                            while ($templateData = mysqli_fetch_array($templateQuery)) {
                                                            ?>
                                                                    <option value="<?php echo $templateData['id']; ?>"><?php echo $templateData['name']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="explanatory_description_div">
                                            <label for="emailaddress">Explanatory Description <span class="required_sign">**</span></label>
                                            <textarea  class="form-control" id="explanatory_description" name="explanatory_description" data-toggle="wysiwyg"></textarea>
                                        </div>



                                        <div class="form-group">
                                            <label for="emailaddress">Memo File</label>
                                            <input class="form-control" type="file" id="memo_file" name="memo_file" >
                                        </div>

                                    <?php if(isMeetingEnd($company_id, $meeting_id)) : ?>
                                        <div class="row" <?php echo $buttomSection; ?> >
                                            <div class="form-group col-md-12">
                                            <label class="form-control-label">Resolved</label><br>
                                                <label class="form-control-label">Select Agenda Templates (Resolved)</label>
                                                <select class="m-b-10 form-control"  name="resolved_template_id" id="resolved_template_id" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}'>
                                                    <optgroup label="Template List">
                                                        <option value="">Select Resolved Agenda Template</option>
                                                        <?php
                                                            $templateSql   = "SELECT id,name FROM agenda_templates WHERE company_id='$company_id' and type=2";
                                                            $templateQuery = mysqli_query($connect, $templateSql);
                                                            while ($templateData = mysqli_fetch_array($templateQuery)) {
                                                            ?>
                                                                    <option value="<?php echo $templateData['id']; ?>"><?php echo $templateData['name']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="resolved_description_div" <?php echo $buttomSection; ?>>
                                            <label for="emailaddress">Resolve Description</label>
                                            <textarea class="form-control" required id="resolved_description" name="resolved_description" data-toggle="wysiwyg" ></textarea>
                                        </div>

                                        <div class="form-group" <?php echo $buttomSection; ?> >
                                            <label for="emailaddress">Minute File</label>
                                            <input class="form-control" type="file" id="minute_file" name="minute_file">
                                        </div>
                                    <?php endif; ?>


                                        <div class="text-center mr-b-30">
                                            <input type="submit" name="submit" value="Save" class="btn btn-success">
                                        </div>
                                    </form>
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
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/agenda/agenda.js"></script>
    <script>
        $('#explanatory_template_id').on('change',function(){
            var explanatory_template_id = $("#explanatory_template_id").val();
            if(explanatory_template_id != ''){
                $.ajax({
                    url: 'search-explanatory.php',// point to server-side PHP script 
                    type: 'post',
                    data : {
                        'explanatory_template_id' : explanatory_template_id
                    },
                    success:function(response){
                        $('#explanatory_description_div iframe').contents().find('.wysihtml5-editor').html(response);
                    }
                });
            }
        });

        $('#resolved_template_id').on('change',function(){
            var resolved_template_id = $("#resolved_template_id").val();
            if(resolved_template_id != ''){
                $.ajax({
                    url: 'search-resolved.php',// point to server-side PHP script 
                    type: 'post',
                    data : {
                        'resolved_template_id' : resolved_template_id
                    },
                    success:function(response){
                        $('#resolved_description_div iframe').contents().find('.wysihtml5-editor').html(response);
                    }
                });
            }
        });

    </script>
    <!-- default Script For Every Pages End -->


    <script type="text/javascript">
       $('input[type=radio][name=bedStatus]').change(function() {
            if (this.value == 'english') {
               $(".agenda_title").css({"font-family": "sans-serif"});
            }
            else if (this.value == 'bangla') {
                $(".agenda_title").css({"font-family": "SutonnyMJ"});
            }
        });
    </script>
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>