<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    $meeting_id = $_GET['id'];
    $agenda_id = $_POST['agenda_id'];
    $ok=0;
    $not_ok=0;
    foreach ( $_POST['agenda_id'] as $selectedOption)
    {
        $agenda_id=$selectedOption;
        $agendaUpdate = "UPDATE `agendas` SET `meeting_id`='$meeting_id' WHERE id='$agenda_id'";
   
        $agendaUpdateQ = mysqli_query( $connect, $agendaUpdate );
        if($agendaUpdateQ)
            $ok++;
        else
            $not_ok++;

    }
    if ( $ok>0 and $not_ok==0 ) {
             // generate log start
            
             // generate log end
            $_SESSION['update_agenda_msg'] = true;
            echo "<script>window.location.href='../all-meeting.php'</script>";
        } else {
            $_SESSION['update_agenda_msg'] = false;
            echo "<script>window.location.href='../all-meeting.php'</script>";
        }


    

?>