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

        $agendaResultSql = "SELECT meetings.id as meeting_id,meetings.company_id as meeting_company_id,agendas.id as agenda_id,votes.vote_option_id FROM meetings
        INNER JOIN agendas on meetings.id=agendas.meeting_id
        INNER JOIN votes on votes.agenda_id=agendas.id
        INNER JOIN vote_options on votes.vote_option_id=vote_options.id
        WHERE meetings.id='$meeting_id' and votes.user_id=(SELECT chairman_id FROM meetings WHERE id='$meeting_id') GROUP by votes.agenda_id ";

        $agendaResultQuery = mysqli_query($connect, $agendaResultSql);
        while ($agendaResultData = mysqli_fetch_array($agendaResultQuery)) {
            $agenda_result_company_id      = $agendaResultData['meeting_company_id'];
            $agenda_result_meeting_id      = $agendaResultData['meeting_id'];
            $agenda_result_agenda_id       = $agendaResultData['agenda_id'];
            $agenda_result_max_vote_option = $agendaResultData['vote_option_id'];

            // check already inserted data start 
            $checkAgendaResultSql = "SELECT id  FROM agenda_results WHERE company_id='$agenda_result_company_id' and  meeting_id='$agenda_result_meeting_id' and agenda_id='$agenda_result_agenda_id'  ";
            $checkAgendaResultQuery = mysqli_query($connect,$checkAgendaResultSql);
            $checkAgendaResultRowCount = mysqli_num_rows($checkAgendaResultQuery);
            if($checkAgendaResultRowCount > 0 ){

            }else{                
                $agendaResultInsertSql   = "INSERT INTO `agenda_results`(`company_id`, `meeting_id`, `agenda_id`, `max_vote_option`,  `entry_user_id`) VALUES ('$agenda_result_company_id','$agenda_result_meeting_id','$agenda_result_agenda_id','$agenda_result_max_vote_option','$user_id')";
                file_put_contents("test.txt",$agendaResultInsertSql);
                $agendaResultInsertQuery = mysqli_query($connect, $agendaResultInsertSql);
            }
            // check already inserted data end


        }        

        $meetingCloseQuery = mysqli_query($connect, "UPDATE meetings SET is_open='2' where id='$meeting_id' ");
        if ($meetingCloseQuery) {
            //meeting colsed mail sent
            // if(meetingClosedMailSent($company_id,$meeting_id) == false){
            //     echo "Mail sent failed";
            //     die();
            // }
            //meeting colsed mail sent
            meetingActivatyHistory($meeting_id, $company_id, "Meeting Closed", $user_id);
            echo true;
        } else {
            echo "Meeting Close Failed.";
        }

    }

    function meetingClosedMailSent(int $company_id, int $meeting_id){
        global $connect;
        $sql = "SELECT ui.name as user_name,ui.email as user_email,me.title as meeting_title from  meetings me
        left join committees co on me.committee_id=co.id
        left join committee_users cu on cu.committee_id=co.id
        left join users ui on cu.user_id=ui.id 
        where me.id='{$meeting_id}' and me.company_id='{$company_id}'";
        $query = mysqli_query($connect,$sql);
        while($data = mysqli_fetch_array($query)){
            $message = "{$data['meeting_title']} Meeting Closed";
            if(sendMail($data['user_email'],$data['user_name'],"Meeting Close",$message) == false ){
                return false;
            }
        }
        return true;
    }
?>