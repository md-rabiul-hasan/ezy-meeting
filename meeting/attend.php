<?php include '../database_connection.php';

$company_id_att = $_POST['company_id_att'];
$meeting_id_att = $_POST['meeting_id_att'];
$member_id_att  = $_POST['member_id_att'];
$q_check_att    = mysqli_query($connect, "SELECT id FROM attendances WHERE company_id='$company_id_att' AND meeting_id='$meeting_id_att'");
$d_check_att    = mysqli_fetch_array($q_check_att);
$att_id         = $d_check_att['id'];
$dt             = date("Y-d-m H:i:s");
$dt1            = date("Y-d-m");
$q_check        = mysqli_query($connect, "SELECT id FROM attendance_members WHERE company_id='$company_id_att' and meeting_id='$meeting_id_att' and user_id='$member_id_att' and is_attend=1");
if (mysqli_num_rows($q_check) > 0) {

    print "0:Already Present for Meeting";
} else {
    $user_check_query = mysqli_query($connect,"SELECT id FROM attendance_members WHERE company_id='$company_id_att' and meeting_id='$meeting_id_att' and user_id='$member_id_att'");
    if(mysqli_num_rows($user_check_query) == 0){
        $q_insert = mysqli_query($connect, "INSERT INTO `attendance_members`(`company_id`, `meeting_id`, `attendance_id`, `user_id`, `is_attend`, `created_at`) VALUES ('$company_id_att','$meeting_id_att','$att_id','$member_id_att','1','$dt')");
        if ($q_insert) {
            print "1:Attendance Successfully Taken";
        } else {
            print "0:Attendance Failed to Add";
        }
    }else{
        $dateTime = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $timeStamp = $dateTime->format('Y-m-d H:i:s');
        $q_update_sql = "UPDATE attendance_members SET is_attend=1,created_at='$timeStamp',updated_at='$timeStamp' where  company_id='$company_id_att' and meeting_id='$meeting_id_att' and user_id='$member_id_att'";
        $q_update_Query = mysqli_query($connect,$q_update_sql);
        if ($q_update_Query) {
            print "1:Attendance Successfully Taken";
        } else {
            print "0:Attendance Failed to Add";
        }
    }
    

}

?>