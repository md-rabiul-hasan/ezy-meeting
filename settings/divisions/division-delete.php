
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['id'] )  ) {
        $id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['id'] ) ) );

        $divisionDeleteQuery = mysqli_query($connect,"DELETE FROM divisions where id='$id' ");
        if ( $divisionDeleteQuery ) {
            echo true;
        } else {
            echo "Division Delete Failed.";
        }

    }

?>