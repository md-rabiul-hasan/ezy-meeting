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

        $meetingPublishedQuery = mysqli_query($connect, "UPDATE meetings SET is_open='1' where id='$id' ");
        if ($meetingPublishedQuery) {
            meetingActivatyHistory($id, $company_id, "Meeting Published", $user_id);
            echo true;
        } else {
            echo "Meeting Published Failed.";
        }

    }

?>