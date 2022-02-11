
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['type_id'])) {

        $notice_title = mysqli_real_escape_string($connect, $_POST['title']);
        $notice_type  = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        $attachmentpath = null;
        if(!empty($_FILES['file']['name'])){
            $notice_file_name = $_FILES['file']['name'];
            $notice_file_tmp  = $_FILES['file']['tmp_name'];
            $notice_file_ext  = pathinfo($notice_file_name, PATHINFO_EXTENSION);
            $allowed          = array('pdf', 'docx', 'xls', 'xlsx');
            if (!in_array(strtolower($notice_file_ext), $allowed)) {
                echo "Invalid file format";
                die();
            }
            $notice_file_name = uniqid()."notice-{$notice_file_name}";
            $noticeFullPath   = "storage/company/{$company_id}/notice/{$notice_file_name}";
            if (!file_exists("../storage/company/" . $company_id . "/notice")) {
                mkdir("../storage/company/" . $company_id . "/notice", 0777, true);
            }
            $minuteFileMoved        = move_uploaded_file($notice_file_tmp, "../storage/company/" . $company_id . "/notice/" . $notice_file_name); $attachmentpath = rtrim(getcwd(),"notice").DIRECTORY_SEPARATOR."storage".DIRECTORY_SEPARATOR."company".DIRECTORY_SEPARATOR.$company_id.DIRECTORY_SEPARATOR."notice".DIRECTORY_SEPARATOR.$notice_file_name;
        }

        if ($notice_type == "committee") {
            $type_id          = join(',', $_POST['type_id']);
            $notice_user_list = committeUsersList($company_id, $_POST['type_id'],$attachmentpath,$notice_title);
        } else if ($notice_type == "all") {
            $type_id          = join(',', $_POST['type_id']);
            $notice_user_list = committeUsersList($company_id, $_POST['type_id'],$attachmentpath,$notice_title);
        }

        if (!empty($_FILES['file']['name'])) {            
            $meetingNoticeUploadSql = "INSERT INTO `notices`(`company_id`,`notice_title`, `notice_file`, `type`, `committee_id`, `to_users`, `entry_user_id`) VALUES ('$company_id','$notice_title','$noticeFullPath', '$notice_type', '$type_id', '$notice_user_list','$user_id')";
        } else {
            $meetingNoticeUploadSql = "INSERT INTO `notices`(`company_id`,`notice_title`,  `type`, `committee_id`, `to_users`, `entry_user_id`) VALUES ('$company_id','$notice_title', '$notice_type', '$type_id', '$notice_user_list','$user_id')";
        }       
      
        $meetingNoticeUploadQuery = mysqli_query($connect, $meetingNoticeUploadSql);
        if ($meetingNoticeUploadQuery) {
            $_SESSION['store_notice'] = true;
            echo "<script>window.location.href='all-notice.php'</script>";
        } else {
            $_SESSION['store_notice'] = false;
            echo "<script>window.location.href='add-notice.php'</script>";
        }

    }

?>