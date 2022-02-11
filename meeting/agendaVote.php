<?php include '../database_connection.php';

$voteID     = $_POST['voteID'];
$meeting_id = $_POST['meeting_id'];
$company_id = $_POST['company_id'];
$agenda_id  = $_POST['agenda_id'];
$user_id    = $_POST['user_id'];
$remarks    = $_POST['remarks'];
$dt         = date("Y-d-m H:i:s");

$q_check = mysqli_query($connect, "SELECT id,remarks FROM votes WHERE company_id='$company_id' and meeting_id='$meeting_id' and agenda_id='$agenda_id' and user_id='$user_id'");
// check user atteandance
$checkUserAttendanceSql   = "SELECT is_attend FROM `attendance_members` WHERE meeting_id='$meeting_id' and user_id='$user_id'";
$checkUserAttendanceSql1   = "SELECT is_attend FROM `attendance_members` WHERE meeting_id='$meeting_id' and user_id='$user_id' and is_attend='1'";
$checkUserAttendanceQuery = mysqli_query($connect, $checkUserAttendanceSql);
$checkUserAttendanceQuery1 = mysqli_query($connect, $checkUserAttendanceSql1);
$checkUserAttendanceData  = mysqli_fetch_array($checkUserAttendanceQuery);
if(mysqli_num_rows($checkUserAttendanceQuery)>0)
{
   if (mysqli_num_rows($checkUserAttendanceQuery1)>0) {
    if (mysqli_num_rows($q_check) > 0) {
        $d_check      = mysqli_fetch_array($q_check);
        $vote         = $d_check['id'];
        $vote_remakrs = $d_check['remarks'];
        if (empty($remarks)) {
            $remarks = $vote_remakrs;
        }

        $q_update = mysqli_query($connect, "UPDATE votes set vote_option_id='$voteID',remarks='$remarks',updated_at='$dt' where id='$vote'");
        if ($q_update) {
            print "1:Agenda Vote Successfully Updated";
        } else {
            print "0:Agenda Vote Update Failed";
        }

    } else {
        $q_insert = mysqli_query($connect, "INSERT INTO `votes`(`company_id`, `meeting_id`, `agenda_id`, `user_id`, `remarks`, `vote_option_id`, `created_at`) VALUES ('$company_id','$meeting_id','$agenda_id','$user_id','$remarks','$voteID','$dt')");
        if ($q_insert) {
            print "1:Agenda Vote Successfully Added";
        } else {
            print "0:Agenda Vote Failed to Add";
        }
    }

} else {
    echo "0:First give your attendance";
} 
}
else
{
    print "0:Attendance is not opened yet"; 
}


?>