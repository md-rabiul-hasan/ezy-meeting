
<?php include '../../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    


    if (isset($_POST['agenda_id']) && isset($_POST['meeting_id']) && (!empty($_FILES['minute_file']['name'])) ) {

        $agenda_id  = mysqli_real_escape_string($connect, $_POST['agenda_id']);
        $meeting_id = mysqli_real_escape_string($connect, $_POST['meeting_id']);

        $meeting_unique_id_query = mysqli_query($connect,"SELECT meeting_unique_id FROM  meetings WHERE id='$meeting_id'");
        $meeting_unique_id_data = mysqli_fetch_array($meeting_unique_id_query);
        $meeting_unique_id = $meeting_unique_id_data['meeting_unique_id'];


        $oldAgendInfoSql = "SELECT minute_file FROM agendas WHERE id='$agenda_id' and meeting_id='$meeting_id'";
        $oldAgendInfoQuery = mysqli_query($connect,$oldAgendInfoSql);
        $oldAgendInfoData = mysqli_fetch_array($oldAgendInfoQuery);
     
        if (!empty($_FILES['minute_file']['name'])) {
            $minute_file_name = $_FILES['minute_file']['name'];
            $minute_file_tmp  = $_FILES['minute_file']['tmp_name'];
            $minute_file_ext  = pathinfo($minute_file_name, PATHINFO_EXTENSION);
            $allowed = array('docx');
            if (!in_array(strtolower($minute_file_ext), $allowed)) {
                echo "Only Docx File Supported";
                die();
            }
            $minute_file_name = "agenda-minute-" . $meeting_id . time() . uniqid(). '.' . $minute_file_ext;
            $minute_full_file_url = "storage/company/{$company_id}/meeting/{$meeting_id}/agenda/{$minute_file_name}";
            if (!file_exists("../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda")) {
                mkdir("../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda", 0777, true);
            }
            $minuteFileMoved = move_uploaded_file($minute_file_tmp, "../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda/" . $minute_file_name);        
        } else {
            $minute_full_file_url = $oldAgendInfoData['minute_file'];
        }

        $agendaUpdatedSql = "UPDATE `agendas` SET  `minute_file` = '$minute_full_file_url'  WHERE id = '$agenda_id' and meeting_id = '$meeting_id' and company_id = '$company_id' ";
        
        $agendaUpdatedQuery = mysqli_query($connect, $agendaUpdatedSql);
        if ($agendaUpdatedQuery) {
            $_SESSION['agenda_minute_file_upload_message'] = true;
            echo "<script>window.location.href='agenda-list.php?meeting_id=".$meeting_unique_id."'</script>";
        } else {
           echo "Agend Minute Upload Failed.";
        }

    }else{
        echo "Please select required filed";
    }

?>