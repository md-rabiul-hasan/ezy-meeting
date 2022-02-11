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

    if (isset($_POST['meeting_id']) && isset($_POST['attendance_id'])) {

        $meeting_id    = strip_tags(mysqli_real_escape_string($connect, trim($_POST['meeting_id'])));
        $attendance_id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['attendance_id'])));

        $checkMeetingIsOpenSql   = "SELECT is_open FROM meetings WHERE company_id='$company_id' and id='$meeting_id'";
        $checkMeetingIsOpenQuery = mysqli_query($connect, $checkMeetingIsOpenSql);
        $checkMeetingIsOpenData  = mysqli_fetch_array($checkMeetingIsOpenQuery);

        if ($checkMeetingIsOpenData['is_open'] == 1) {

            $meetingAttendanceDeactiveSql   = "UPDATE attendances SET is_open=0,closing_time='$currentTime' WHERE meeting_id='$meeting_id' and id='$attendance_id'";
            $meetingAttendanceDeactiveQuery = mysqli_query($connect, $meetingAttendanceDeactiveSql);
            if ($meetingAttendanceDeactiveQuery) {
                  // log generate 
                  $attendanceLogDataQuery = mysqli_query($connect,"SELECT id,company_id,meeting_id FROM attendances WHERE meeting_id='$meeting_id' and id='$attendance_id'");
                  $attendanceLogData = mysqli_fetch_array($attendanceLogDataQuery);
                  meetingAttendanceActivityHistory($attendanceLogData['id'],$attendanceLogData['company_id'],$attendanceLogData['meeting_id'],'Meeting Attendance Deactive',$user_id);
                  // log generate
                echo true;
            } else {
                echo "Attendance Deactivation Failed";
            }
        } else {
            echo "Please Meeting open before deactive attendance";
        }

    }

?>