
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['title']) && isset($_POST['committee_id']) && isset($_POST['meeting_date']) && isset($_POST['meeting_time']) && isset($_POST['location'])) {
        $title        = mysqli_real_escape_string($connect, $_POST['title']);
        $committee_id = mysqli_real_escape_string($connect, $_POST['committee_id']);
        $meeting_date = date("Y-m-d", strtotime(mysqli_real_escape_string($connect, $_POST['meeting_date'])));
        $meeting_time = date("H:i:m", strtotime(mysqli_real_escape_string($connect, $_POST['meeting_time'])));
        $location     = mysqli_real_escape_string($connect, $_POST['location']);

        // unique id for url
        $meeting_unique_id = md5(time() . uniqid(rand(), true));

        //find out committee Chairman id
        $committee_chairman_id = getCommitteChairmanId($compnay_id, $committee_id);

        // find out committee users
        $committee_users = getCommitteeUsers($company_id, $committee_id);

        $meetingCreateSql = "INSERT INTO `meetings`(`meeting_unique_id`,`company_id`, `committee_id`,  `chairman_id`, `member_list`, `title`, `meeting_date`, `meeting_time`, `location`, `entry_user_id`)  VALUES ('$meeting_unique_id','$company_id','$committee_id','$committee_chairman_id', '$committee_users','$title','$meeting_date','$meeting_time','$location','$user_id')";

        $meetingCreateQuery = mysqli_query($connect, $meetingCreateSql);
        if ($meetingCreateQuery) {
            // Log Generate Section Start
            $meetingIdQuery = mysqli_query($connect, "SELECT id from meetings where company_id='$company_id' ORDER BY id DESC limit 1");
            $meetinIdData   = mysqli_fetch_array($meetingIdQuery);
            $meetingId      = $meetinIdData['id'];
            meetingHistory($meetingId, $meeting_unique_id, $company_id, $committee_id, $committee_chairman_id, $title, $meeting_date, $meeting_time, $location, 0, $user_id, "Meeting Create", $user_id);

            // log generate section end
            $_SESSION['msg'] = true;
            echo "<script>window.location.href='all-meeting.php'</script>";
        } else {
            $_SESSION['msg'] = false;
            echo "<script>window.location.href='all-meeting.php'</script>";
        }

    }

?>