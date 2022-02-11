<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['id'])) {
        $meeting_id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['id'])));

        if(meetingAttendanceActive($meeting_id) === true){
            echo "Please attendace off before meeting end.";
        }else{
            $meetingEndQuery = mysqli_query($connect, "UPDATE meetings SET is_open='3' where id='$meeting_id' ");
            if ($meetingEndQuery) {
                //meeting colsed mail sent
                meetingActivatyHistory($meeting_id, $company_id, "Meeting End", $user_id);
                echo true;
            } else {
                echo "Meeting End Failed.";
            }
        }
    }

?>