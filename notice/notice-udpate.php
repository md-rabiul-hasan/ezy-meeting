
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['title']) && isset($_POST['notice_id']) && isset($_POST['type']) && isset($_POST['type_id'])) {
        $notice_id    = mysqli_real_escape_string($connect, $_POST['notice_id']);
        $notice_title = mysqli_real_escape_string($connect, $_POST['title']);
        $notice_type  = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        $type_id      = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_STRING);

        if ($notice_type == "committee") {
            $notice_user_list = committeUsersList($company_id, $_POST['type_id']);
            $type_id          = join(',', $_POST['type_id']);
        } else if ($notice_type == "all") {
            $notice_user_list = committeUsersList($company_id, $_POST['type_id']);
            $type_id          = join(',', $_POST['type_id']);
        }

        date_default_timezone_set('Asia/Dhaka');
        $dataTime = date('Y-m-d H:i:s');

        if (!empty($_FILES['file']['name'])) {
            $notice_file_name = $_FILES['file']['name'];
            $notice_file_tmp  = $_FILES['file']['tmp_name'];
            $notice_file_ext  = pathinfo($notice_file_name, PATHINFO_EXTENSION);

            $allowed = array('pdf', 'docx', 'xls', 'xlsx');
            if (!in_array(strtolower($notice_file_ext), $allowed)) {
                echo "Invalid file format";
                die();
            }
            $notice_file_name = "notice-{$notice_file_name}";
            $noticeFullPath   = "storage/company/{$company_id}/notice/{$notice_file_name}";
            if (!file_exists("../storage/company/" . $company_id . "/notice")) {
                mkdir("../storage/company/" . $company_id . "/notice", 0777, true);
            }
            $minuteFileMoved        = move_uploaded_file($notice_file_tmp, "../storage/company/" . $company_id . "/notice/" . $notice_file_name);
            $meetingNoticeUploadSql = "UPDATE`notices` SET `notice_title`='{$notice_title}',`notice_file`='{$noticeFullPath}', `type`='{$notice_type}',`committee_id`='{$type_id}',`to_users`='{$notice_user_list}',  `entry_user_id`='{$user_id}',`updated_at`='{$dataTime}' WHERE id='{$notice_id}' and company_id='{$company_id}'";
        } else {
            $meetingNoticeUploadSql = "UPDATE`notices` SET `notice_title`='{$notice_title}',`type`='{$notice_type}',`committee_id`='{$type_id}',`to_users`='{$notice_user_list}',`entry_user_id`='{$user_id}',`updated_at`='{$dataTime}' WHERE id='{$notice_id}' and company_id='{$company_id}'";
        }

        $meetingNoticeUploadQuery = mysqli_query($connect, $meetingNoticeUploadSql);
        if ($meetingNoticeUploadQuery) {
            $_SESSION['update_notice'] = true;
            echo "<script>window.location.href='all-notice.php'</script>";
        } else {
            $_SESSION['update_notice'] = false;
            echo "<script>window.location.href='edit-notice.php'</script>";
        }

    }

?>