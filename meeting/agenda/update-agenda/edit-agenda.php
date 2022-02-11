<!-- Database Connection -->
<?php include '../../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->
<?php
    if (isset($_GET['meeting_id']) && isset($_GET['agenda_id'])) {
        $meeting_unique_id =  filter_input(INPUT_GET,'meeting_id',FILTER_SANITIZE_STRING);
        $agenda_id         =  decryptData(filter_input(INPUT_GET,'agenda_id',FILTER_SANITIZE_STRING));

        $meetingInfoSql   = "SELECT id,title FROM meetings where meeting_unique_id='$meeting_unique_id' ";
        $meetingInfoQuery = mysqli_query($connect, $meetingInfoSql);
        $meetingInfoData  = mysqli_fetch_array($meetingInfoQuery);
        $meeting_id       = $meetingInfoData['id'];

        // agenda info start
        $agendaInfoSql   = "SELECT * FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' and id='$agenda_id'";
        $agendaInfoQuery = mysqli_query($connect, $agendaInfoSql);
        $agendaInfoData  = mysqli_fetch_array($agendaInfoQuery);
        // agenda info end

         $title = $agendaInfoData['title'];

         if (strlen($title) != strlen(utf8_decode($title))) {
                   $font = "title";

                  }else {
                     $font = "title2";
                  }

    }
?>


<style type="text/css">
    
.title{
  font-family:'SutonnyMJ','SolaimanLipi';
}



.title2{
  font-family:'sans-serif';
}

</style>

<?php include '../../../partial/_header.php';?>

<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5"><?php echo $meetingInfoData['title']; ?></h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Edit Agenda</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Edit Agenda</li>
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
                                    <h5 class="box-title"><?php echo $agendaInfoData['agenda_prefix'] . $agendaInfoData['agenda_sl']; ?></h5>
                                    <form id="edit-meeting-agenda-form" action="update-agenda-submit.php?meeting_id=<?php echo $meeting_id; ?>&meeting_unique_id=<?php echo $meeting_unique_id; ?>&agenda_id=<?php echo $agendaInfoData['id']; ?>" method="POST" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="name">Agenda Title <span class="required_sign">**</span></label>
                                            <input class="form-control <?php echo $font; ?>" type="text" name="title" id="title" value="<?php echo $agendaInfoData['title']; ?>" style="">
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
                                                                    <option value="<?php echo $memoData['id']; ?>"<?php if ($memoData['id'] == $agendaInfoData['memo_id']) {echo "selected";}?>  ><?php echo $memoData['name']; ?></option>
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
                                                                <option value="<?php echo $divisionData['id']; ?>"<?php if ($divisionData['id'] == $agendaInfoData['division_id']) {echo "selected";}?> ><?php echo $divisionData['name']; ?></option>
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
                                                    <input class="form-control" type="text" name="client" id="client" value="<?php echo $agendaInfoData['client']; ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Amount</label>
                                                    <input class="form-control" type="text" name="amount" id="amount" value="<?php echo $agendaInfoData['amount']; ?>">
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
                                                                    <option value="<?php echo $templateData['id']; ?>"<?php if ($templateData['id'] == $agendaInfoData['explanatory_template_id']) {echo "selected";}?> ><?php echo $templateData['name']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="explanatory_description_div">
                                            <label for="emailaddress">Explanatory Description <span class="required_sign">**</span></label>
                                            <textarea class="form-control" id="explanatory_description" name="explanatory_description" data-toggle="wysiwyg">
                                                <?php echo $agendaInfoData['explanatory_description']; ?>
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <?php if ($agendaInfoData['memo_file'] != '') {?>
                                                <a href="<?php echo $addDot  . $agendaInfoData['memo_file']; ?>" download>Old Memo File Download</a>
                                            <?php }?> <br>
                                            <label for="emailaddress">Memo File</label>
                                            <input class="form-control" type="file" id="memo_file" name="memo_file" >
                                        </div>

                                        <?php if(isMeetingEnd($company_id, $meeting_id)) : ?>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <label class="form-control-label">Resolved</label><br>
                                                <label class="form-control-label">Select Agenda Templates (Resolved)</label>
                                                <select class="m-b-10 form-control"  name="resolved_template_id" id="resolved_template_id" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}'>
                                                    <optgroup label="Template List">
                                                        <option value="">Select Agenda Template</option>
                                                        <?php
                                                            $templateSql   = "SELECT id,name FROM agenda_templates WHERE company_id='$company_id' and type=2";
                                                            $templateQuery = mysqli_query($connect, $templateSql);
                                                            while ($templateData = mysqli_fetch_array($templateQuery)) {
                                                            ?>
                                                                    <option value="<?php echo $templateData['id']; ?>"<?php if ($templateData['id'] == $agendaInfoData['resolved_template_id']) {echo "selected";}?>><?php echo $templateData['name']; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group" id="resolved_description_div">
                                            <label for="emailaddress">Resolve Description</label>
                                            <textarea class="form-control" required id="resolved_description" name="resolved_description" data-toggle="wysiwyg" >
                                                <?php echo $agendaInfoData['resolved_description']; ?>
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <?php if ($agendaInfoData['minute_file'] != '') {?>
                                                <a href="<?php echo $addDot .$agendaInfoData['minute_file']; ?>" download>Old Minute File Download</a>
                                            <?php }?> <br>
                                            <label for="emailaddress">Minute File</label>
                                            <input class="form-control" type="file" id="minute_file" name="minute_file">
                                        </div>

                                        <?php endif; ?>

                                        <div class="text-center mr-b-30">
                                            <input type="submit" name="submit" value="Update" class="btn btn-success">
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



<?php include '../../../partial/_footer.php';?>
    <script>
        $('#explanatory_template_id').on('change',function(){
            var explanatory_template_id = $("#explanatory_template_id").val();
            if(explanatory_template_id != ''){
                $.ajax({
                    url: '../search-explanatory.php',// point to server-side PHP script 
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
                    url: '../search-resolved.php',// point to server-side PHP script 
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
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/agenda/agenda.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>