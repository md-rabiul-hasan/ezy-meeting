
<?php include '../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if ( isset( $_GET['id'] ) && isset( $_POST['name'] ) && isset( $_POST['description'] ) && isset( $_POST['type'] )) {
        $id        = strip_tags( mysqli_real_escape_string( $connect, trim( $_GET['id'] ) ) );
        $name        = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['name'] ) ) );
        $description = mysqli_real_escape_string( $connect, trim( $_POST['description'] ) ) ;
        $type = mysqli_real_escape_string( $connect, trim( $_POST['type'] ) ) ;

        $agendaTemplateUpdateSql = "UPDATE `agenda_templates` SET `name`='$name',`type`='$type',`description`='$description' WHERE id='$id' ";

        $agendaTemplateUpdateQuery = mysqli_query( $connect, $agendaTemplateUpdateSql );
        if ( $agendaTemplateUpdateQuery ) {
            $_SESSION['msg'] = true;
            echo "<script>window.location.href='all-agenda-template.php'</script>";
        } else {
            $_SESSION['msg'] = false;
            echo "<script>window.location.href='all-agenda-template.php'</script>";
        }

    }

?>