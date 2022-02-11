<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id  = $_SESSION['company_id'];
    $user_id     = $_SESSION['id'];
    $dt          = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $currentTime = $dt->format('h:i:s');
    $currentData = date('Y-m-d h:i:s');
$ok=0;
$not_ok=0;
    if (isset($_POST['meeting_id'])) {

        $meeting_id=$_POST['meeting_id'];
        $chairman_id=$_POST['chairman_id'];
         $q_resolution=mysqli_query($connect,"SELECT *,ag.id as agendaId,vts.name as voteOption,vts.id as voteOptId FROM agendas ag left join meetings mt on ag.meeting_id=mt.id left join votes vt on vt.agenda_id=ag.id left join vote_options vts on vts.id=vt.vote_option_id WHERE mt.id='$meeting_id' and mt.company_id='$company_id' and vt.user_id='$chairman_id'");
         while($d_resolution=mysqli_fetch_array($q_resolution))
         {

            $agenda_id=$d_resolution['agendaId'];
            $voteOptId=$d_resolution['voteOptId'];
            $q_agenda_result=mysqli_query($connect,"INSERT INTO `agenda_results`(`company_id`, `meeting_id`, `agenda_id`, `max_vote_option`, `max_vote`, `created_at`) VALUES ('$company_id','$meeting_id','$agenda_id','$voteOptId','1','$currentData')");
            $a_up_agenda=mysqli_query($connect,"UPDATE agendas set status='1' where id='$agenda_id'");
            if($q_agenda_result and  $a_up_agenda)
                $ok++;
            else
                $not_ok++;

         }
        $a_up_meeting=mysqli_query($connect,"UPDATE meetings set is_open='2' where id='$meeting_id'");
        if($ok>0 and $not_ok==0  and $a_up_meeting)
            print true;
        else
            print "Failed to Resolve Meeting";
    }

?>