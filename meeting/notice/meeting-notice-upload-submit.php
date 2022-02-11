
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    


    if (isset($_POST['meeting_id'])  && (!empty($_FILES['meeting_notice_file']['name'])) ) {

        $meeting_id = mysqli_real_escape_string($connect, $_POST['meeting_id']);

        $meetingUniqueId = meetingUniqueId($meeting_id);


     
        if (!empty($_FILES['meeting_notice_file']['name'])) {
            $notice_file_name = $_FILES['meeting_notice_file']['name'];
            $notice_file_tmp  = $_FILES['meeting_notice_file']['tmp_name'];
            $notice_file_ext  = pathinfo($notice_file_name, PATHINFO_EXTENSION);
            $allowed = array('pdf');
            if (!in_array(strtolower($notice_file_ext), $allowed)) {
                echo "Only Pdf File Supported";
                die();
            }
            $notice_file_name = "meeting-notice-" . $meeting_id . time() . uniqid(). '.' . $notice_file_ext;
            $notice_file_url = "storage/company/{$company_id}/meeting/{$meeting_id}/notice/{$notice_file_name}";
            if (!file_exists("../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/notice")) {
                mkdir("../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/notice", 0777, true);
            }
            $minuteFileMoved = move_uploaded_file($notice_file_tmp, "../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/notice/" . $notice_file_name);
        } else {
            echo "please selct file and upload";
            die();
        }


        $cwd = getcwd();
        $cwd = str_replace("\\meeting\\notice","",$cwd);


        $attachmentpath = $cwd.DIRECTORY_SEPARATOR."storage".DIRECTORY_SEPARATOR."company".DIRECTORY_SEPARATOR.$company_id.DIRECTORY_SEPARATOR."meeting".DIRECTORY_SEPARATOR.$meeting_id.DIRECTORY_SEPARATOR."notice".DIRECTORY_SEPARATOR.$notice_file_name;
        // mail send start 
        if( sendMeetingCommitteUsersMail($company_id,$meeting_id,$attachmentpath) == false){
            echo "Mail Sent Failed";
            die();
        }

        // mail sent end

       

        if(alreadyNoticeUploaded($company_id,$meeting_id)){
            $meetingNoticeUploadSql =   "UPDATE `meeting_notices` SET  `notice_file`='{$notice_file_url}',`entry_user_id`='{$user_id}' where company_id='{$company_id}' and meeting_id='{$meeting_id}'";
        }else{
            $meetingNoticeUploadSql = "INSERT INTO `meeting_notices`(`company_id`, `meeting_id`, `notice_file`, `entry_user_id`) VALUES ('$company_id','$meeting_id','$notice_file_url','$user_id')";
        }

        $redirectUrl = "../meeting/meeting-setup.php?meeting_id=".$meetingUniqueId;

        
        $meetingNoticeUploadQuery = mysqli_query($connect, $meetingNoticeUploadSql);
        if ($meetingNoticeUploadQuery) {
            $_SESSION['meeting_notice_message'] = true;
            echo "<script>window.location.href='".$redirectUrl."'</script>";
        } else {
           echo "Meeting Notice Upload File Failed.";
        }

    }else{
        echo "Please select required filed";
    }


// send all users meeting notice
function sendMeetingCommitteUsersMail(int $company_id, int $meeting_id, $attachment){
    global $connect;
    $sql = "SELECT ui.name as user_name,ui.email as user_email,me.title as meeting_title from  meetings me
    left join committees co on me.committee_id=co.id
    left join committee_users cu on cu.committee_id=co.id
    left join users ui on cu.user_id=ui.id 
    where me.id='{$meeting_id}' and me.company_id='{$company_id}'";
    $query = mysqli_query($connect,$sql);
    while($data = mysqli_fetch_array($query)){
        $message = "{$data['meeting_title']} Meeting Notice Upload";
        if(sendMail($data['user_email'],$data['user_name'],"Meeting Notice",$message,$attachment) == false ){
            return false;
        }
    }
    return true;
}




?>