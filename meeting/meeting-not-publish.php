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

        $meetingNotPublishQuery = mysqli_query($connect, "UPDATE meetings SET is_open='0' where id='$id' ");
        if ($meetingNotPublishQuery) {
            meetingActivatyHistory($id, $company_id, "Meeting Not Published", $user_id);
            echo true;
        } else {
            echo "Meeting  Not Published Failed.";
        }

    }

?>