
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $current_user_id = $_SESSION['id'];

    if ( isset( $_POST['edit_zoom_id'] ) && isset( $_POST['edit_client_id'] )  && isset( $_POST['edit_secret_key'] ) && isset( $_POST['edit_redirect_url'] ) ) {
        $edit_zoom_id   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_zoom_id'] ) ) );
        $edit_client_id   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_client_id'] ) ) );
        $edit_secret_key   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_secret_key'] ) ) );
        $edit_redirect_url = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_redirect_url'] ) ) );

        $settingUpdateSql = "UPDATE `zoom_credential` SET  `client_id`='{$edit_client_id}',`client_secret`='{$edit_secret_key}',`redirect_url`='{$edit_redirect_url}' WHERE id='{$edit_zoom_id}' and company_id='{$company_id}'";

        $settingUpdateQuery = mysqli_query( $connect, $settingUpdateSql );
        if ( $settingUpdateQuery ) {            
            echo true;
        } else {
            echo "Zoom Update Failed";
        }

}
?>