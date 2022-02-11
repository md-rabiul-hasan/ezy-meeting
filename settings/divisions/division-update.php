
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['edit_division_id'] ) && isset( $_POST['edit_division_name'] ) ) {
        $edit_division_id   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_division_id'] ) ) );
        $edit_division_name = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_division_name'] ) ) );

        $divisionUpdateSql = "UPDATE `divisions` SET  `name`='$edit_division_name' WHERE id='$edit_division_id'";

        $divisionUpdateQuery = mysqli_query( $connect, $divisionUpdateSql );
        if ( $divisionUpdateQuery ) {
            echo true;
        } else {
            echo "Division Update Failed";
        }

}
?>