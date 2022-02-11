<?php include '../../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];



    if (isset($_POST['submit'])) {

        if (isset($_GET['agenda_id']) && isset($_GET['meeting_unique_id']) && isset($_GET['meeting_id']) && isset($_POST['title']) && isset($_POST['memo_id']) && isset($_POST['division_id']) && isset($_POST['explanatory_template_id']) && isset($_POST['explanatory_description']) ) {

            $agenda_id               = mysqli_real_escape_string($connect, $_GET['agenda_id']);
            $meeting_id              = mysqli_real_escape_string($connect, $_GET['meeting_id']);
            $meeting_unique_id       = mysqli_real_escape_string($connect, $_GET['meeting_unique_id']);
            $title                   = mysqli_real_escape_string($connect, $_POST['title']);
            $memo_id                 = mysqli_real_escape_string($connect, $_POST['memo_id']);
            $division_id             = mysqli_real_escape_string($connect, $_POST['division_id']);
            $client                  = mysqli_real_escape_string($connect, $_POST['client']);
            $amount                  = mysqli_real_escape_string($connect, $_POST['amount']);
            $explanatory_template_id = mysqli_real_escape_string($connect, $_POST['explanatory_template_id']);
            $explanatory_description = mysqli_real_escape_string($connect, $_POST['explanatory_description']);
            $resolved_template_id    = mysqli_real_escape_string($connect, $_POST['resolved_template_id']);
            $resolved_description    = mysqli_real_escape_string($connect, $_POST['resolved_description']);

            // meeeting old data fetch start
            $meetingOldInfoSql   = "SELECT memo_file,minute_file from agendas WHERE meeting_id='$meeting_id' and company_id='$company_id' and id='$agenda_id'";
            $meetingOldInfoQuery = mysqli_query($connect, $meetingOldInfoSql);
            $meetingOldInfoData  = mysqli_fetch_array($meetingOldInfoQuery);
            // meeeting old data fetch end

            // memo file upload
            if (!empty($_FILES['memo_file']['name'])) {
                $memo_file_name = $_FILES['memo_file']['name'];
                $memo_file_tmp  = $_FILES['memo_file']['tmp_name'];
                $memo_file_ext  = pathinfo($memo_file_name, PATHINFO_EXTENSION);
                $memo_file_name = "agenda-memo-" . $meeting_id . time() . '.' . $memo_file_ext;
                $memo_full_file_url = "storage/company/{$company_id}/meeting/agenda/{$memo_file_name}";
                if (!file_exists("../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda")) {
                    mkdir("../../../storage/company/" . $company_id . "/meeting/" . $company_id . "/agenda", 0777, true);
                }
                $memoFileMoved = move_uploaded_file($memo_file_tmp, "../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda/" . $memo_file_name);
            } else {
                $memo_full_file_url = $meetingOldInfoData['memo_file'];
            }

            // minute file upload
            if (!empty($_FILES['minute_file']['name'])) {
                $minute_file_name = $_FILES['minute_file']['name'];
                $minute_file_tmp  = $_FILES['minute_file']['tmp_name'];
                $minute_file_ext  = pathinfo($minute_file_name, PATHINFO_EXTENSION);
                $minute_file_name = "agenda-minute-" . $meeting_id . time() . '.' . $minute_file_ext;
                $minute_full_file_url = "storage/company/{$compnay_id}/meeting/{$meeting_id}/agenda/{$minute_file_name}";
                if (!file_exists("../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda")) {
                    mkdir("../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda", 0777, true);
                }
                $minuteFileMoved = move_uploaded_file($minute_file_tmp, "../../../storage/company/" . $company_id . "/meeting/" . $meeting_id . "/agenda/" . $minute_file_name);
            } else {
                $minute_full_file_url = $meetingOldInfoData['minute_file'];
            }

            $agendaUpdatedSql = "UPDATE `agendas` SET `title` = '$title', `memo_id` = '$memo_id', `division_id`= '$division_id', `client` = '$client', `amount` = '$amount', `explanatory_template_id` = '$explanatory_template_id', `explanatory_description` = '$explanatory_description', `memo_file` = '$memo_full_file_url', `resolved_template_id` = '$resolved_template_id', `resolved_description` = '$resolved_description', `minute_file` = '$minute_full_file_url'    WHERE id  = '$agenda_id' and meeting_id = '$meeting_id' and company_id = '$company_id' ";

            $agendaUpdatedQuery = mysqli_query($connect, $agendaUpdatedSql);
            if ($agendaUpdatedQuery) {
                // log generate start
                $logDataSql = "SELECT * FROM  agendas WHERE  id  = '$agenda_id' and meeting_id = '$meeting_id' and company_id = '$company_id' ORDER BY id DESC LIMIT 1";
                $logDataQuery = mysqli_query($connect,$logDataSql);
                $logData = mysqli_fetch_array($logDataQuery);
                agendaHistory($logData['id'],$logData['company_id'],$logData['meeting_id'],$logData['title'],$logData['memo_id'],$logData['division_id'],$logData['client'],$logData['amount'],$logData['explanatory_template_id'],$logData['explanatory_description'],$logData['memo_file'],$logData['resolved_template_id'],$logData['resolved_description'],$logData['minute_file'],$logData['agenda_sl'],$logData['agenda_prefix'],$logData['entry_user_id'],'Agenda Updated',$user_id);
                // log generate end
                $_SESSION['ageda_updated_message'] = true;
                echo "<script>window.location='agenda-list.php?meeting_id={$meeting_unique_id}'</script>"; //success
            } else {
                $_SESSION['ageda_updated_message'] = false;
                echo "<script>window.location='agenda-list.php?meeting_id={$meeting_unique_id}'</script>"; //failed
            }
            

        }

    }

?>