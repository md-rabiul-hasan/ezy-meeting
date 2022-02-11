
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['update_user_realtive_id'] ) && isset( $_POST['edit_relative_name'] ) && isset( $_POST['edit_relation_with_user'] ) ) {
        $update_user_realtive_id                 = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['update_user_realtive_id'] ) ) );
        $edit_relative_name           = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_relative_name'] ) ) );
        $edit_relation_with_user      = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_relation_with_user'] ) ) );
        $edit_relative_date_of_birth  = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_relative_date_of_birth'] ) ) );
        $edit_relative_institute_name = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_relative_institute_name'] ) ) );

        $userRelativeUpdateSql = "UPDATE `user_relatives` SET  `name`='$edit_relative_name',`relation_with_user`='$edit_relation_with_user',`date_of_birth`='$edit_relative_date_of_birth',`institute_name`='$edit_relative_institute_name' WHERE id='$update_user_realtive_id'";     
       
        $userRelativeUpdateQuery = mysqli_query( $connect, $userRelativeUpdateSql );
        if ( $userRelativeUpdateQuery ) {
            echo true;
        } else {
            echo "users relaive update failed.";
        }

    }
?>