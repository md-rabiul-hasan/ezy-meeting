<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->

<?php
    if (isset($_GET['meeting_id'])) {
        $meeting_unique_id = $_GET['meeting_id'];
        $meetingSql        = "SELECT * FROM meetings where meeting_unique_id='$meeting_unique_id'";
        $meetingQuery      = mysqli_query($connect, $meetingSql);
        $meetingData       = mysqli_fetch_array($meetingQuery);

        $meeting_unique_id = $meetingData['meeting_unique_id'];
        $meeting_id        = $meetingData['id'];
        $chairman_id       = $meetingData['chairman_id'];

        // check meeting agend
        $meetingAgentCheckSql   = "SELECT * FROM agendas WHERE meeting_id='$meeting_id' and company_id='$company_id'";
        $meetingAgentCheckQuery = mysqli_query($connect, $meetingAgentCheckSql);
        $meetingAgentCount      = mysqli_num_rows($meetingAgentCheckQuery);

        $q_check_chairman = mysqli_query($connect, "SELECT vote_option_id FROM votes WHERE company_id='$company_id' and meeting_id='$meeting_id'  and user_id='$chairman_id'");
        $chairman_voted   = mysqli_num_rows($q_check_chairman);

    }

?>

<style type="text/css">
    .title{
  font-family:'SutonnyMJ','SolaimanLipi';
}



.title2{
  font-family:'SolaimanLipi';
}
</style>

<input type="hidden" id="meeting_unique_id" value="<?php echo $meeting_unique_id; ?>">
<input type="hidden" id="meeting_id" value="<?php echo $meeting_id; ?>">

<?php include '../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Meeting Setup</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Company Meeting Setup</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Meeting</li>
                                <li class="breadcrumb-item active">Meeting Setup</li>
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
                            <div class="widget-bg" id="meeting_setup">
                                <div class="widget-body">
                                    <h5 class="box-title">
                                        <?php echo $meetingData['title']; ?> Setup
                                    </h5>
                                    <p>This is company meeting setup page
                                        <!-- Add Agenda  -->
                                        <?php  if(isMeetingClose($company_id,$meeting_id))  { ?>
                                            <button disabled class="btn btn-danger btn-sm" style="float:right"> Add Agenda (Meeting Closed)</button>
                                        <?php }else { ?>
                                            <a class="btn btn-sm btn-success" href="agenda/add-agenda.php?meeting_id=<?php echo $meeting_unique_id; ?>" style="float:right;"><i class="list-icon lnr lnr-book"></i>  <span>Add New Agenda</span></a>
                                        <?php } ?>                                        
                                        <a readonly="true" class="btn btn-sm btn-danger ml-2"  href="agenda/draft-agenda.php?id=<?php echo $meeting_unique_id; ?>" style="margin-right:10px; float:right;"><i class="list-icon lnr lnr-trash"></i>  <span>Add Agenda from Draft </span></a>
                                       
                                        
                                    </p>
                                   
                                    <!-- Start Meeting Setup Option  -->
                                    <div class="row">
                                        <div class="btn-list mr-b-20 ml-2">
                                        
                                            <!-- Meeting Notice Panel -->
                                            <?php  if(isMeetingClose($company_id,$meeting_id))  { ?>
                                            <button disabled class="btn btn-danger btn-sm ripple"><i class="list-icon lnr lnr-upload"></i>&nbsp; Meeting Notice Upload</button>
                                            <?php }else { ?>
                                                <button id="meeting_notice_upload" class="btn btn-success btn-sm ripple"><i class="list-icon lnr lnr-upload"></i>&nbsp; Meeting Notice Upload</button>
                                            <?php } ?>

                                            <!-- Meeting Update Agenda Panel -->
                                            <?php  if(isMeetingClose($company_id,$meeting_id))  { ?>
                                                <button disabled class="btn btn-danger btn-sm"> Update Agenda (Meeting Closed)</button>
                                            <?php }else { ?>
                                                <?php if(isAgendaFound($company_id,$meeting_id) > 0): ?>
                                                    <a class="btn btn-success btn-sm ripple" href="agenda/update-agenda/agenda-list.php?meeting_id=<?php echo $meeting_unique_id; ?>"><i class="list-icon lnr lnr-book"></i><span>&nbsp;Update Agenda</span> </a>
                                                <?php else: ?>
                                                    <button disabled class="btn btn-danger btn-sm"> Update Agenda (No agenda added)</button>
                                                <?php endif; ?>
                                            <?php } ?>

                                            <!-- Agenda List Panel -->
                                            <button data-toggle="modal" data-target="#agenda-list-modal" id="agenda_list" class="btn btn-success btn-sm ripple"><i class="list-icon lnr lnr-list"></i><span>&nbsp;Agenda List</span></button>

                                            <!-- Resulation -->
                                            <?php if(isMeetingClose($company_id,$meeting_id)): ?>
                                                <a disabled class="btn btn-success btn-sm ripple" data-toggle="modal" data-target="#meeting-resolution" >
                                                    <i class="list-icon lnr lnr-history"></i>
                                                    <span>&nbsp;Resolution</span>
                                                </a>
                                            <?php else: ?>
                                                <button disabled class="btn btn-danger btn-sm ripple"><i class="list-icon lnr lnr-history"></i><span>&nbsp;Resolution</span></button>
                                            <?php endif; ?>

                                            <!-- Minute Generate -->
                                            <?php if(isMeetingEnd($company_id,$meeting_id)) : ?>
                                                <button class="btn btn-success btn-sm ripple" data-toggle="modal" data-target="#meeting-generate-modal"> <i <i class="list-icon lnr lnr-download"></i><span>&nbsp;Minute Generate</span> </button>
                                            <?php else: ?>
                                                <button disabled class="btn btn-danger btn-sm ripple"><i <i class="list-icon lnr lnr-download"></i><span>&nbsp;Minute Generate</span> </button>
                                            <?php endif; ?>



                                             <!-- Signed Minute Upload -->
                                             <?php if(isMeetingEnd($company_id,$meeting_id)) : ?>
                                                <button id="meeting_signed_minute_upload" class="btn btn-success btn-sm ripple"><i class="list-icon lnr lnr-upload"></i><span>&nbsp;Signed Minute Upload</span> </button>
                                            <?php else: ?>
                                                <button disabled class="btn btn-danger btn-sm ripple"><i class="list-icon lnr lnr-upload"></i><span>&nbsp;Signed Minute Upload</span> </button>
                                            <?php endif; ?>


                                            <!-- Zoom Video Call -->

                                            <?php  if(isMeetingClose($company_id,$meeting_id))  : ?>
                                                <button disabled class="btn btn-danger btn-sm ripple"><i class="list-icon lnr lnr-camera-video"></i><span>&nbsp;Zomm Meeting</span></button>
                                            <?php else : ?>
                                                <?php if(isEnableVideoCall($company_id) != false ) : ?>
                                                    <a href="zoom/index.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-success btn-sm ripple">
                                                        <i class="list-icon lnr lnr-camera-video"></i><span>&nbsp;Zoom Meeting</span>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <!-- End Meeting Setup Option  -->



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body bg-default">
                                                    Meeting Participant
                                                    <button  style="float: right" data-toggle="modal" data-target="#meeting-absent-attendance-list-modal" class="btn btn-danger btn-sm ripple ml-2">
                                                        <i class="list-icon lnr lnr-upload"></i><span>&nbsp;Absent</span>
                                                    </button>
                                                    <button  data-toggle="modal" data-target="#meeting-present-attendance-list-modal" style="float: right" class="btn btn-success btn-sm ripple ml-2">
                                                        <i class="list-icon lnr lnr-upload"></i><span>&nbsp;Present</span>
                                                    </button>
                                                    <button  data-toggle="modal" data-target="#meeting-attendance-list-modal" style="float: right" class="btn btn-info btn-sm ripple ml-2">
                                                        <i class="list-icon lnr lnr-text-align-left"></i><span>&nbsp; Attendance List</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card" id="attendance_setup">
                                                <div class="card-header bg-primary">
                                                    Meeting Attendance
                                                    <?php
                                                        $attendanceCheckSql      = "SELECT * FROM attendances WHERE meeting_id='$meeting_id'";
                                                        $attendanceCheckQuery    = mysqli_query($connect, $attendanceCheckSql);
                                                        $attendanceCheckRowCount = mysqli_num_rows($attendanceCheckQuery);
                                                        $attendanceData          = mysqli_fetch_array($attendanceCheckQuery);
                                                        if ($attendanceData['is_open'] == 1) {
                                                        ?>
                                                                <button  class="btn btn-sm btn-danger" style="float:right;" onclick="deactiveAttendance(<?php echo $meeting_id; ?>,<?php echo $attendanceData['id']; ?>)">Attendance De-active</button>
                                                             <?php
                                                                 } else if ($attendanceData['is_open'] == 0 || $attendanceCheckRowCount == 0) {
                                                                 ?>
                                                                <button class="btn btn-sm btn-dark" style="float:right;" onclick="activeAttendance(<?php echo $meeting_id; ?>)">Attendance Active</button>
                                                            <?php
                                                                }
                                                            ?>

                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                        if ($attendanceData['is_open'] == 1) {
                                                        ?>
                                                                 <div class="alert  alert-success border-success fade show" role="alert">
                                                                    </button> <strong> Attendance!</strong>
                                                                    Currently Meeting Attendace Are Enabled.
                                                                </div>

                                                            <?php

                                                                } else if ($attendanceData['is_open'] == 0) {
                                                                ?>
                                                                 <div class="alert  alert-danger border-danger fade show" role="alert">
                                                                    </button> <strong> Attendance!</strong>
                                                                    Currently Meeting Attendace Are Disabled.
                                                                </div>
                                                            <?php
                                                                }
                                                            ?>


                                                </div>
                                            </div>
                                            <br>
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <?php
                                                        $totalAgendaCountSql   = "SELECT id FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ";
                                                        $totalAgendaCountQuery = mysqli_query($connect, $totalAgendaCountSql);
                                                        $totalMettingAgenda    = mysqli_num_rows($totalAgendaCountQuery);
                                                    ?>
                                                    Final Decision <br>
                                                    Total Agenda :                                                                     <?php echo $totalMettingAgenda; ?>
                                                </div>
                                                <div class="card-body">
                                                <?php
                                                            $progressBarSql ="SELECT count(*) as total_single_vote_option,vts.name as voteOption,vts.color as vote_color FROM agendas ag 
                                                            left join meetings mt on ag.meeting_id=mt.id 
                                                            left join votes vt on vt.agenda_id=ag.id 
                                                            left join vote_options vts on vts.id=vt.vote_option_id 
                                                            WHERE mt.meeting_unique_id='$meeting_unique_id' and mt.company_id='$company_id' and vt.user_id='$chairman_id' group by vt.vote_option_id";
                                                            $progressBarQuery = mysqli_query($connect,$progressBarSql);
                                                             
                                                        ?>
                                                    <!-- /.progress -->
                                                    <div class="progress progress-lg">

                                                        <?php 
                                                        $voteOptionDataArray = [];
                                                            while($progressBarData = mysqli_fetch_assoc($progressBarQuery)){
                                                                $voteOptionDataArray[] =[
                                                                    "vote_option_name" => $progressBarData['voteOption'],
                                                                    "vote_option_color" => $progressBarData['vote_color']
                                                                ];
                                                                $percentage = get_percentage ($totalMettingAgenda,$progressBarData['total_single_vote_option']);
                                                                ?>
                                                                <style>
                                                                    .bg-<?php echo $progressBarData['voteOption'] ?>  {
                                                                        background : <?php  echo $progressBarData['vote_color']; ?>!important
                                                                    }
                                                                </style>
                                                                    <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%" class="progress-bar  bg-<?php echo $progressBarData['voteOption']; ?> progress-bar-striped progress-bar-animated"><?php echo $percentage; ?>%</div>
                                                                <?php
                                                            }

                                                        ?>
                                                        </div>
                                                        <div class="mt-2">
                                                                   <?php for($i=0; $i<count($voteOptionDataArray); $i++){ ?>                                                              
                                                                        <button class="bote_option" style=" background: <?php echo $voteOptionDataArray[$i]['vote_option_color']; ?>; padding: 8px;border: none; margin-right: 5px;"></button> <span class="label-text"><?php echo $voteOptionDataArray[$i]['vote_option_name'] ?></span>
                                                                    <?php } ?>
                                                        </div>
                                                    <!-- /.progress -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card" >
                                                <div class="card-header bg-primary">
                                                    Meeting Comment <button class="btn btn-sm btn-dark" id="meeting_comment_modal"   style="float: right;">all-comment</button>
                                                </div>
                                                <div class="card-body" id="comment_section">
                                                    <div class="form">
                                                        <div class="form-group">
                                                            <textarea name="meeting_comment" class="form-control" id="meeting_comment"  cols="10" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-sm btn-primary" id="comment_submit" >comment</button>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

          <!-- Agenda List Modal Start -->
          <div id="meeting-attendance-list-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // Attendance Query Start
                                                $attendanceMemberSql = "SELECT users.name as user_name,user_profiles.designation as user_designation,users.avatar as user_image,attendance_members.is_attend as attendance_status from attendance_members
                                                INNER JOIN attendances on attendance_members.attendance_id=attendances.id
                                                INNER JOIN meetings on attendances.meeting_id=meetings.id
                                                LEFT JOIN users on attendance_members.user_id=users.id
                                                LEFT JOIN user_profiles on user_profiles.user_id=users.id
                                                WHERE attendance_members.meeting_id='$meeting_id' and meetings.company_id='$company_id'";

                                                $attendenceMemberQuery = mysqli_query($connect, $attendanceMemberSql);
                                                $sl                    = 1;
                                                while ($attendanceMemberData = mysqli_fetch_array($attendenceMemberQuery)) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $sl++; ?></th>
                                                        <th class="attendance-user-image text-center">
                                                            <?php
                                                                if ($attendanceMemberData['user_image'] != NULL) {
                                                                    ?>
                                                                        <img src='<?php echo $addDot; ?><?php echo $attendanceMemberData['user_image']; ?>' alt="">
                                                                    <?php
                                                                        } else {
                                                                            ?>
                                                                        <img src="data:image/png;base64,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" alt="">
                                                                    <?php
                                                                        }
                                                                        ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($attendanceMemberData['user_name']) ?? ''; ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($attendanceMemberData['user_designation']) ?? ''; ?></th>
                                                        <th>
                                                            <?php
                                                            if ($attendanceMemberData['attendance_status'] == 1) {?>
                                                                    <div class="checkbox checkbox-primary">
                                                                        <label>
                                                                            <input disabled type="checkbox" name="present" checked="checked"> <span class="label-text">Attend</span>
                                                                        </label>
                                                                    </div>
                                                                <?php } else {?>
                                                                    <div class="checkbox checkbox-pink">
                                                                        <label>
                                                                            <input disabled type="checkbox" name="absent" checked="checked"> <span class="label-text">Absent</span>
                                                                        </label>
                                                                    </div>
                                                                <?php }
                                                                    ?>

                                                        </th>
                                                    </tr>
                                                   <?php
                                                       }
                                                   ?>

                                        </tbody>
                                    </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


          <!-- Agenda List Modal Start -->
          <div id="meeting-present-attendance-list-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // Attendance Query Start
                                                $attendanceMemberSql = "SELECT users.name as user_name,user_profiles.designation as user_designation,users.avatar as user_image,attendance_members.is_attend as attendance_status from attendance_members
                                                INNER JOIN attendances on attendance_members.attendance_id=attendances.id
                                                INNER JOIN meetings on attendances.meeting_id=meetings.id
                                                LEFT JOIN users on attendance_members.user_id=users.id
                                                LEFT JOIN user_profiles on user_profiles.user_id=users.id
                                                WHERE attendance_members.meeting_id='$meeting_id' and meetings.company_id='$company_id' and attendance_members.is_attend = 1";

                                                $attendenceMemberQuery = mysqli_query($connect, $attendanceMemberSql);
                                                $sl                    = 1;
                                                while ($attendanceMemberData = mysqli_fetch_array($attendenceMemberQuery)) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $sl++; ?></th>
                                                        <th class="attendance-user-image text-center">
                                                            <?php
                                                                if ($attendanceMemberData['user_image'] != NULL) {
                                                                    ?>
                                                                        <img src='<?php echo $addDot; ?><?php echo $attendanceMemberData['user_image']; ?>' alt="">
                                                                    <?php
                                                                        } else {
                                                                            ?>
                                                                        <img src="data:image/png;base64,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" alt="">
                                                                    <?php
                                                                        }
                                                                        ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($attendanceMemberData['user_name']) ?? ''; ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($attendanceMemberData['user_designation']) ?? ''; ?></th>
                                                        <th>
                                                            <?php
                                                            if ($attendanceMemberData['attendance_status'] == 1) {?>
                                                                    <div class="checkbox checkbox-primary">
                                                                        <label>
                                                                            <input disabled type="checkbox" name="present" checked="checked"> <span class="label-text">Attend</span>
                                                                        </label>
                                                                    </div>
                                                                <?php } else {?>
                                                                    <div class="checkbox checkbox-pink">
                                                                        <label>
                                                                            <input disabled type="checkbox" name="absent" checked="checked"> <span class="label-text">Absent</span>
                                                                        </label>
                                                                    </div>
                                                                <?php }
                                                                    ?>

                                                        </th>
                                                    </tr>
                                                   <?php
                                                       }
                                                   ?>

                                        </tbody>
                                    </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


             <!-- Agenda List Modal Start -->
          <div id="meeting-absent-attendance-list-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // Attendance Query Start
                                                $attendanceMemberSql = "SELECT users.name as user_name,user_profiles.designation as user_designation,users.avatar as user_image,attendance_members.is_attend as attendance_status from attendance_members
                                                INNER JOIN attendances on attendance_members.attendance_id=attendances.id
                                                INNER JOIN meetings on attendances.meeting_id=meetings.id
                                                LEFT JOIN users on attendance_members.user_id=users.id
                                                LEFT JOIN user_profiles on user_profiles.user_id=users.id
                                                WHERE attendance_members.meeting_id='$meeting_id' and meetings.company_id='$company_id' and attendance_members.is_attend = 0";

                                                $attendenceMemberQuery = mysqli_query($connect, $attendanceMemberSql);
                                                $sl                    = 1;
                                                while ($attendanceMemberData = mysqli_fetch_array($attendenceMemberQuery)) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $sl++; ?></th>
                                                        <th class="attendance-user-image text-center">
                                                            <?php
                                                                if ($attendanceMemberData['user_image'] != NULL) {
                                                                    ?>
                                                                        <img src='<?php echo $addDot; ?><?php echo $attendanceMemberData['user_image']; ?>' alt="">
                                                                    <?php
                                                                        } else {
                                                                            ?>
                                                                        <img src="data:image/png;base64,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" alt="">
                                                                    <?php
                                                                        }
                                                                        ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($attendanceMemberData['user_name']) ?? ''; ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($attendanceMemberData['user_designation']) ?? ''; ?></th>
                                                        <th>
                                                            <?php
                                                            if ($attendanceMemberData['attendance_status'] == 1) {?>
                                                                    <div class="checkbox checkbox-primary">
                                                                        <label>
                                                                            <input disabled type="checkbox" name="present" checked="checked"> <span class="label-text">Attend</span>
                                                                        </label>
                                                                    </div>
                                                                <?php } else {?>
                                                                    <div class="checkbox checkbox-pink">
                                                                        <label>
                                                                            <input disabled type="checkbox" name="absent" checked="checked"> <span class="label-text">Absent</span>
                                                                        </label>
                                                                    </div>
                                                                <?php }
                                                                    ?>

                                                        </th>
                                                    </tr>
                                                   <?php
                                                       }
                                                   ?>

                                        </tbody>
                                    </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

<!-- Resolution modal start-->

 <div id="meeting-resolution" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Agenda</th>
                                                <th>Chairman Vote</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // check vote table if chairman has voted . if so then it will be the result for the meeting .if the chairman did not vote then it will go to draft .
                                                $sl           = 1;
                                                $q_resolution = mysqli_query($connect, "SELECT *,ag.title as agendaTitle,vts.name as voteOption FROM agendas ag left join meetings mt on ag.meeting_id=mt.id left join votes vt on vt.agenda_id=ag.id left join vote_options vts on vts.id=vt.vote_option_id WHERE mt.meeting_unique_id='$meeting_unique_id' and mt.company_id='$company_id' and vt.user_id='$chairman_id'");

                                                while ($d_resolution = mysqli_fetch_array($q_resolution)) {

                                                     if (strlen($title) != strlen(utf8_decode($title))) {

                                                           $font = "title";

                                                          }else {
                                                             $font = "title2";
                                                          }

                                                   $title = $d_resolution['agendaTitle'];

                                                ?>
                                                    <tr>
                                                        <th><?php echo $sl++; ?></th>
                                                        <th class="<?php echo $font; ?>">
                                                            <?php echo ($d_resolution['agendaTitle']) ?? ''; ?>
                                                        </th>
                                                        <th>
                                                            <?php echo ($d_resolution['voteOption']) ?? ''; ?></th>

                                                    </tr>
                                                   <?php
                                                       }
                                                   ?>
                                           <tr>
                                           </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="pdf_template_option">Select PDF Template</label>
                                            <div class="form-group">
                                                <div class="radiobox">
                                                <?php
                                                    $minutePdfTemplateSql   = "SELECT id,template_name FROM  minute_pdf_template WHERE company_id='$company_id' ";
                                                    $minutePdfTemplateQuery = mysqli_query($connect, $minutePdfTemplateSql);
                                                    while ($minutePdfTemplateData = mysqli_fetch_array($minutePdfTemplateQuery)) {
                                                    ?>
                                                            <label>
                                                                <input type="radio" name="pdf_template_option" value="<?php echo $minutePdfTemplateData['id']; ?>" > <span class="label-text"><?php echo $minutePdfTemplateData['template_name']; ?></span>
                                                            </label>
                                                        <?php
                                                            }
                                                        ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <br>
                                    <div class="text-center mr-b-30">
                                        <button class="btn btn-success btn-sm" id="minute_pdf_generate">Generate PDF</button>
                                        <!-- <input type="submit" id="upload_meeting_notice_file_sumbit" class="btn btn-success btn-sm" value="Create Meeting Resolution" onclick="meetingResolution(<?php echo $meeting_id; ?>,<?php echo $chairman_id; ?>)"> -->
                                    </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>



<!-- Resoulation modal ends-->






        <!-- Agenda List Modal End -->


        <!-- Notice Upload Modal Start -->
        <div id="meeting-notice-upload-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <form onsubmit="return mySubmitFunction(event)" id="meeting-notice-upload-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Meeting Notice Upload <span class="required_sign">**</span></label>
                                    <input type="file" class="form-control" name="meeting_notice_file" id="meeting_notice_file" required>
                                </div>
                                <div class="text-center mr-b-30">
                                    <input type="submit" id="upload_meeting_notice_file" class="btn btn-success btn-sm" value="upload">
                                    <?php if(alreadyNoticeUploaded($company_id,$meeting_id)) : ?>
                                        <?php 
                                            $noticeUrlSql= "SELECT * FROM meeting_notices where company_id='{$company_id}' and meeting_id='{$meeting_id}'";
                                            $noticeUrlQuery = mysqli_query($connect,$noticeUrlSql);
                                            $noticeUrlData = mysqli_fetch_assoc($noticeUrlQuery);
                                        ?>
                                        <a style="margin-left: 10px;" href="<?php echo $addDot.$noticeUrlData['notice_file']; ?>" class="btn btn-info btn-sm" download>Old Notice Download</a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- /.modal -->
        <!-- Notice Upload Modal End -->



        <!-- Singed Minute Upload Modal Start -->
            <div id="meeting-signed-minute-upload-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <form onsubmit="return mySubmitFunction(event)" id="meeting-signed-minute-upload-form" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label for="name">Meeting Signed Minute Upload <span class="required_sign">**</span></label>
                                    <input type="file" class="form-control" name="meeting_signed_minute_file" id="meeting_signed_minute_file" required>
                                </div>
                                <div class="text-center mr-b-30">
                                    <input type="submit" id="upload_meeting_signed_minute_file_sumbit" class="btn btn-success btn-sm" value="upload">
                                    <?php if(alreadyMeetingSignedMinuteUpload($company_id,$meeting_id)) : ?>
                                        <?php 
                                            $signedMinuteUrlSql= "SELECT * FROM signed_minute_uploads where company_id='{$company_id}' and meeting_id='{$meeting_id}'";
                                            $signedMinuteUrlQuery = mysqli_query($connect,$signedMinuteUrlSql);
                                            $signedMinuteUrlData = mysqli_fetch_assoc($signedMinuteUrlQuery);
                                        ?>
                                        <a style="margin-left: 10px;" href="<?php echo $addDot.$signedMinuteUrlData['signed_minute_file']; ?>" class="btn btn-info btn-sm" download>Old Signed Minute Download</a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- /.modal -->
        <!-- Signed Minute Upload Modal End -->

        <!-- Agenda List Modal Start -->
            <div id="agenda-list-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <form target="_blank" action="agenda-list/agenda-list.php" id="agenda-list-form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="meeting_id" value="<?php echo $meeting_id; ?>" >
                                <div class="form-group">
                                    <label for="name">Notice Reference Number <span class="required_sign">**</span></label>
                                    <input type="text" class="form-control" name="agenda_list_notice_reference_number" id="agenda_list_notice_reference_number" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Notice Date <span class="required_sign">**</span></label>
                                    <input type="date" class="form-control" name="agenda_list_notice_date" id="agenda_list_notice_date" required>
                                </div>
                                <div class="text-center mr-b-30">
                                    <input type="submit" id="agenda_list_generate" class="btn btn-success" value="Generate Agenda List">
                                    &nbsp;
                                     <a href="agenda-list/docfile.php?meeting_id=<?php echo $meeting_id; ?>" >Agenda list DOCS</a>
                                </div>

                               
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- /.modal -->
        <!-- Agenda List Modal End -->



        
        <!-- Meeting Comment List Start -->
        <div id="meeting_comment_report" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <div class="comment_list">
                                  
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- /.modal -->
         <!-- Meeting Comment List Start -->

        <!-- Minute Generate Modal Start -->
        <div id="meeting-generate-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <form onsubmit="return mySubmitFunction(event)" id="meeting-generate-radio-form" enctype="multipart/form-data">
                                <label for="name">Select Minute Generate Type<span class="required_sign">**</span></label>
                                <div class="form-group"> 
                                    <label>
                                        <input type="radio" required name="minute_generate_type"  value="1"> <span class="label-text">File Merge</span> &nbsp;&nbsp;&nbsp;
                                    </label>   
                                    <label>
                                        <input type="radio" required name="minute_generate_type"  value="2"> <span class="label-text">Content Merge</span>
                                    </label>   
                                </div>
                                <div class="text-center mr-b-30">
                                    <input type="submit" id="generate_meeting_minute_file" class="btn btn-success btn-sm" value="generate">                                   
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- /.modal -->
        <!-- Minute Generate  Modal End -->







<?php include '../partial/_footer.php';?>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#comment_submit').on('click', function() {
        var meeting_comment = $('#meeting_comment').val();
        var meeting_id = $('#meeting_id').val();
        if (meeting_comment != '') {
            $.ajax({
                type: 'post',
                url: "meeting_comment.php",
                data: {
                    "meeting_id": meeting_id,
                    "meeting_comment": meeting_comment
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Meeting Comment',
                            text: "comment successfully",
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error
                            stack: false
                        });
                        $("#comment_section").load(location.href + " #comment_section");
                    } else {
                        $.toast({
                            heading: 'Meeting Comment',
                            text: response,
                            position: 'top-right',
                            icon: 'error', //info, warning, success, and error
                            stack: false
                        });
                    }
                }
            });
        } else {
            $.toast({
                heading: 'Meeting Comment',
                text: "comment box cannot be empty",
                position: 'top-right',
                icon: 'error', //info, warning, success, and error
                stack: false
            });
        }
    });

    $('#meeting_comment_modal').on('click', function() {

        var meeting_id = $('#meeting_id').val();
        if (meeting_id != '') {
            $.ajax({
                type: 'post',
                url: "meeting_comment_fetch.php",
                data: {
                    "meeting_id": meeting_id
                },
                success: function(response) {
                    $('#meeting_comment_report').modal("show");
                    $('.comment_list').html(response);
                }
            });
        }
    });

    $('#minute_pdf_generate').on('click', function() {
        var meeting_unique_id = $('#meeting_unique_id').val();
        var pdf_template_option = $("input[name='pdf_template_option']:checked").val();
        if (meeting_unique_id != '') {

            if (meeting_unique_id != undefined) {
                var link = "minute-generate/minute-pdf-generate.php?meeting_id=" + meeting_unique_id + "&template_id=" + pdf_template_option;
                var generate_link = '<a href="' + link + '" target="_blank">Generate Link</a>';
                $.toast({
                    heading: 'Minute PDF Generate Link',
                    text: generate_link,
                    position: 'top-right',
                    icon: 'success', //info, warning, success, and error
                    stack: false
                });
            } else {
                $.toast({
                    heading: 'Minute PDF Generate',
                    text: "please select pdf template",
                    position: 'top-right',
                    icon: 'error', //info, warning, success, and error
                    stack: false
                });
            }

        }
    })

    <?php
        if(isset($_SESSION['meeting_notice_message'])){
            $meeting_notice_message = $_SESSION['meeting_notice_message'];
            if(!empty($meeting_notice_message)){
                ?>
                    $.toast({
                        heading: 'Meeting Notice',
                        text: "Meeting Notice Upload Successfully",
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    }); 
                <?php
                }            
            $_SESSION['meeting_notice_message'] = null;
        }
    ?>

    <?php
        if(isset($_SESSION['meeting_signed_minute_upload_message'])){
            $meeting_signed_minute_upload_message = $_SESSION['meeting_signed_minute_upload_message'];
            if(!empty($meeting_signed_minute_upload_message)){
                ?>
                    $.toast({
                        heading: 'Meeting Signed Minute',
                        text: "Meeting Signed Minute Upload Successfully",
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    }); 
                <?php
                }            
            $_SESSION['meeting_signed_minute_upload_message'] = null;
        }
    ?>


  
  


    $('#minute_generate').on('click', function() {
        var meeting_id = $('#meeting_id').val();
        swal({
            title: 'Are you sure?',
            text: "You want to generate minute download  link",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate link!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                // ajax code here
                if (meeting_id != '') {
                    $.ajax({
                        url: "minute-generate/minute-generate.php",
                        method: 'post',
                        data: {
                            meeting_id: meeting_id,
                        },
                        success: function(response) {
                            $.toast({
                                heading: 'Meeting Minute Generate',
                                text: response,
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error
                                stack: false
                            });
                        }
                    });
                }
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your meeting is  not published :)',
                    'error'
                )
            }
        })

    })

</script>


    <script src="<?php echo $addDot; ?>assets/vendors/switchery/switchery.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/notice.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/minute_generate.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/signed_minute_upload.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/agenda-list.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/attendance-active-deactive.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>