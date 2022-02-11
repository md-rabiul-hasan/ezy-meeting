<?php include '../../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['id'])) {
        $id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['id'])));
          // log generate start
          $logDataSql   = "SELECT * FROM  agendas WHERE  id='$id' and company_id='$company_id' ORDER BY id DESC LIMIT 1";
          $logDataQuery = mysqli_query($connect, $logDataSql);
          $logData      = mysqli_fetch_array($logDataQuery);
          agendaHistory($logData['id'], $logData['company_id'], $logData['meeting_id'], $logData['title'], $logData['memo_id'], $logData['division_id'], $logData['client'], $logData['amount'], $logData['explanatory_template_id'], $logData['explanatory_description'], $logData['memo_file'], $logData['resolved_template_id'], $logData['resolved_description'], $logData['minute_file'], $logData['agenda_sl'], $logData['agenda_prefix'], $logData['entry_user_id'], 'Agenda Deleted', $user_id);
            // log generate end

        $agendaDeleteQuery = mysqli_query($connect, "DELETE FROM agendas where id='$id' and company_id='$company_id' ");
        if ($agendaDeleteQuery) {
          
            
            echo true;
        } else {
            echo "Agenda Delete Failed.";
        }

    }

?>