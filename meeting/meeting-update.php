<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    $meeting_id = $_GET['id'];

    if (isset($meeting_id) && isset($_POST['title']) && isset($_POST['committee_id']) && isset($_POST['meeting_date']) && isset($_POST['meeting_time']) && isset($_POST['location'])) {
        $meeting_id   = mysqli_real_escape_string($connect, $_GET['id']);
        $title        = mysqli_real_escape_string($connect, $_POST['title']);
        $committee_id = mysqli_real_escape_string($connect, $_POST['committee_id']);
        $meeting_date = date("Y-m-d", strtotime(mysqli_real_escape_string($connect, $_POST['meeting_date'])));
        $meeting_time = date("H:i:m", strtotime(mysqli_real_escape_string($connect, $_POST['meeting_time'])));
        $location     = mysqli_real_escape_string($connect, $_POST['location']);

        //find out committee Chairman id
        $committee_chairman_id = getCommitteChairmanId($compnay_id, $committee_id);

        // find out committee users
        $committee_users = getCommitteeUsers($company_id, $committee_id);

        $meetingUpdateSql = "UPDATE `meetings` SET `committee_id`='$committee_id',`chairman_id`='$committee_chairman_id', `member_list`='$committee_users', `title`='$title',`meeting_date`='$meeting_date',`meeting_time`='$meeting_time',`location`='$location' WHERE id='$meeting_id'";

        $meetingUpdateQuery = mysqli_query($connect, $meetingUpdateSql);
        if ($meetingUpdateQuery) {
            // generate log start
            $logDataSql   = "SELECT `id`, `meeting_unique_id`, `company_id`, `committee_id`, `chairman_id`, `title`, `meeting_date`, `meeting_time`, `location`, `is_open`, `entry_user_id`FROM `meetings` WHERE id='$meeting_id' ";
            $logDataQuery = mysqli_query($connect, $logDataSql);
            $logData      = mysqli_fetch_array($logDataQuery);
            meetingHistory($logData['id'], $logData['meeting_unique_id'], $logData['company_id'], $logData['committee_id'], $logData['chairman_id'], $logData['title'], $logData['meeting_date'], $logData['meeting_time'], $logData['location'], $logData['is_open'], $logData['entry_user_id'], "Meeting Update", $user_id);
            // generate log end
            $_SESSION['update_meeting_msg'] = true;
            echo "<script>window.location.href='all-meeting.php'</script>";
        } else {
            $_SESSION['update_meeting_msg'] = false;
            echo "<script>window.location.href='all-meeting.php'</script>";
        }

    }

?>