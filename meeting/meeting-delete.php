<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['id'])) {
        $id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['id'])));
        // generate log start
        $logDataSql   = "SELECT `id`, `meeting_unique_id`, `company_id`, `committee_id`, `chairman_id`, `title`, `meeting_date`, `meeting_time`, `location`, `is_open`, `entry_user_id`FROM `meetings` WHERE id='$id' ";
        $logDataQuery = mysqli_query($connect, $logDataSql);
        $logData      = mysqli_fetch_array($logDataQuery);

        $meetingDeleteQuery = mysqli_query($connect, "DELETE FROM meetings where id='$id' ");
        if ($meetingDeleteQuery) {
            meetingHistory($logData['id'], $logData['meeting_unique_id'], $logData['company_id'], $logData['committee_id'], $logData['chairman_id'], $logData['title'], $logData['meeting_date'], $logData['meeting_time'], $logData['location'], $logData['is_open'], $logData['entry_user_id'], "Meeting Deleted", $user_id);
            // generate log end
            echo true;
        } else {
            echo "Meeting Delete Failed";
        }

    }

?>