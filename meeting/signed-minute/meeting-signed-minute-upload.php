
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['meeting_id']) && (!empty($_FILES['meeting_signed_minute_file']['name']))) {

        $meeting_id = mysqli_real_escape_string($connect, $_POST['meeting_id']);
        $meetingUniqueId = meetingUniqueId($meeting_id);

        if (!empty($_FILES['meeting_signed_minute_file']['name'])) {
            $meeting_signed_minute_file_name     = $_FILES['meeting_signed_minute_file']['name'];
            $meeting_signed_minute_temp_name     = $_FILES['meeting_signed_minute_file']['tmp_name'];
            $meeting_signed_minutee_ext          = pathinfo($meeting_signed_minute_file_name, PATHINFO_EXTENSION);
            
            $allowed                             = array('pdf');
            if (!in_array(strtolower($meeting_signed_minutee_ext), $allowed)) {
                echo "Only Pdf File Supported";
                die();
            }
            $meeting_signed_minute_file_name = "meeting-signed-minute-" . $meeting_id . time() . uniqid() . '.' . $meeting_signed_minutee_ext;
            $meeting_signed_minute_full_file_url = "storage/company/{$company_id}/meeting/{$meeting_id}/signed-minute/{$meeting_signed_minute_file_name}";
            if (!file_exists("../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/signed-minute")) {
                mkdir("../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/signed-minute", 0777, true);
            }
            $minuteFileMoved = move_uploaded_file($meeting_signed_minute_temp_name, "../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/signed-minute/" . $meeting_signed_minute_file_name);
        } else {
            die("Please select and upload file");
        }


        $cwd = getcwd();
        $cwd = str_replace("\\meeting\\signed-minute","",$cwd);      

        $attachmentpath = $cwd.DIRECTORY_SEPARATOR."storage".DIRECTORY_SEPARATOR."company".DIRECTORY_SEPARATOR.$company_id.DIRECTORY_SEPARATOR."meeting".DIRECTORY_SEPARATOR.$meeting_id.DIRECTORY_SEPARATOR."signed-minute".DIRECTORY_SEPARATOR.$meeting_signed_minute_file_name;
        
     

        // mail send start 
        if( sendMeetingCommitteUsersSignedMinuteMail($company_id,$meeting_id,$attachmentpath) == false){
            echo "Mail Sent Failed";
            die();
        }

        // mail sent end






        if (alreadyMeetingSignedMinuteUpload($company_id, $meeting_id)) {
            $meetingSignedMinuteUploadSql = "UPDATE signed_minute_uploads SET `signed_minute_file`='{$meeting_signed_minute_full_file_url}' where company_id='{$company_id}' and meeting_id='{$meeting_id}'";
        } else {
            $meetingSignedMinuteUploadSql = "INSERT INTO `signed_minute_uploads`( `company_id`, `meeting_id`, `signed_minute_file`, `entry_user_id`) VALUES ('$company_id','$meeting_id','$meeting_signed_minute_full_file_url','$user_id')";
        }

        $meetingSignedMinuteUploadQuery = mysqli_query($connect, $meetingSignedMinuteUploadSql);
        if ($meetingSignedMinuteUploadQuery) {
            $redirectUrl = "../meeting/meeting-setup.php?meeting_id=".$meetingUniqueId;
            $_SESSION['meeting_signed_minute_upload_message'] = true;
            echo "<script>window.location.href='".$redirectUrl."'</script>";
        } else {
            echo "Meeting Signed Minute Upload Failed.";
        }

    } else {
        echo "Please select required filed";
    }


    // send all users meeting notice
function sendMeetingCommitteUsersSignedMinuteMail(int $company_id, int $meeting_id, $attachment){
    global $connect;
    $sql = "SELECT ui.name as user_name,ui.email as user_email,me.title as meeting_title from  meetings me
    left join committees co on me.committee_id=co.id
    left join committee_users cu on cu.committee_id=co.id
    left join users ui on cu.user_id=ui.id 
    where me.id='{$meeting_id}' and me.company_id='{$company_id}'";
    $query = mysqli_query($connect,$sql);
    while($data = mysqli_fetch_array($query)){
        $message = "{$data['meeting_title']} Meeting Signed Minute Upload";
        if(sendMail($data['user_email'],$data['user_name'],"Meeting Signed Minute",$message,$attachment) == false ){
            return false;
        }
    }
    return true;
}


?>