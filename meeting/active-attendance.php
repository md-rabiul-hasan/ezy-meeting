<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id  = $_SESSION['company_id'];
    $user_id     = $_SESSION['id'];
    $dt          = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $currentTime = $dt->format('h:i:s');
    $currentData = date('Y-m-d');

    if (isset($_POST['id'])) {
        $meeting_id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['id'])));

        $checkMeetingIsOpenSql   = "SELECT committee_id,is_open,member_list FROM meetings WHERE company_id='$company_id' and id='$meeting_id'";
        $checkMeetingIsOpenQuery = mysqli_query($connect, $checkMeetingIsOpenSql);
        $checkMeetingIsOpenData  = mysqli_fetch_array($checkMeetingIsOpenQuery);
        $committee_id  = $checkMeetingIsOpenData['committee_id'];
        
        if ($checkMeetingIsOpenData['is_open'] == 1) {
            $checkMeetingAttendanceSql      = "SELECT * FROM attendances WHERE meeting_id='$meeting_id' and company_id='$company_id'";
            $checkMeetingAttendanceQuery    = mysqli_query($connect, $checkMeetingAttendanceSql);
            $checkMeetingAttendanceRowCount = mysqli_num_rows($checkMeetingAttendanceQuery);
            if ($checkMeetingAttendanceRowCount > 0) {
                $meetingAttendanceSql = "UPDATE attendances SET is_open=1 WHERE meeting_id='$meeting_id' and company_id='$company_id'";
                // log generate
            } else {
                $meetingAttendanceSql = "INSERT INTO `attendances`(`company_id`, `meeting_id`, `is_open`, `opening_time`, `date`, `entry_user_id`) VALUES ('$company_id','$meeting_id',1,'$currentTime','$currentData','$user_id')";
                // attendance member table data entry off
            }
            $meetingAttendanceQuery = mysqli_query($connect, $meetingAttendanceSql);
            if ($meetingAttendanceQuery) {

                // log + attendance member start
                // log generate
                $attendanceLogDataQuery = mysqli_query($connect, "SELECT id,company_id,meeting_id FROM attendances WHERE meeting_id='$meeting_id' and company_id='$company_id' ORDER BY id DESC LIMIT 1");
                $attendanceLogData      = mysqli_fetch_array($attendanceLogDataQuery);
                meetingAttendanceActivityHistory($attendanceLogData['id'], $attendanceLogData['company_id'], $attendanceLogData['meeting_id'], 'Meeting Attendance Active', $user_id);
                // attendance memeber table data entry start

                // check attendance member table already users
                $checkAttendanceMemberQuery    = mysqli_query($connect, "SELECT id FROM attendance_members WHERE meeting_id='$meeting_id' and attendance_id='$attendanceLogData[id]' ");
                $checkAttendanceMemberRowCount = mysqli_num_rows($checkAttendanceMemberQuery);
                if ($checkAttendanceMemberRowCount == 0) {
                    // attendance generate start 
                    $attendanceUsersQuery = mysqli_query($connect,"SELECT cu.user_id,ui.name as user_name,ui.email as user_email FROM committee_users cu left join users ui on cu.user_id=ui.id WHERE cu.company_id='{$company_id}' and cu.committee_id='{$committee_id}'");
                    
                    while($attendanceUserData = mysqli_fetch_assoc($attendanceUsersQuery)){
                        $attendanceMemberInsertSql   = "INSERT INTO `attendance_members`( `company_id`, `meeting_id`, `attendance_id`, `user_id`, `is_attend`)  VALUES ('$company_id','$meeting_id','$attendanceLogData[id]','$attendanceUserData[user_id]',0)";
                        $attendanceMemberInsertQuery = mysqli_query($connect, $attendanceMemberInsertSql);
                        $meetingName = meetingName($meeting_id);
                        if(sendMail($attendanceUserData['user_email'],$attendanceUserData['user_name'],"Meeting Attendance Open","{$meetingName} meeting attendance has been opened.Please put your attendance for agenda votaing"));
                        if (!$attendanceMemberInsertQuery) {
                            die("Member Attendance Form Creationg Failed");
                        }
                    }
                    // attendance generate end
                }
                // log + attendance member end

                echo true;
            } else {
                echo "Attendance Activation Failed";
            }
        }elseif($checkMeetingIsOpenData['is_open'] == 2){
            echo "Meeting are already closed.";
        } else {
            echo "Please Meeting publish before attendance active ";
        }

    }

    function meetingName($meeting_id){
        global $connect;
        $sql = "SELECT title from meetings WHERE id='{$meeting_id}'";
        $query = mysqli_query($connect,$sql);
        $data = mysqli_fetch_array($query);
        return $data['title'];
    }
?>