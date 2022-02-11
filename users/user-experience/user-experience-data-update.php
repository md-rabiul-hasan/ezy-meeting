
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['update_user_experience_id'] ) && isset( $_POST['edit_experience_institute_name'] ) && isset( $_POST['edit_experience_appointment_date'] ) && isset( $_POST['edit_experience_designation'] )  && isset( $_POST['edit_experience_responsibilities'] ) ) {
        $update_user_experience_id                 = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['update_user_experience_id'] ) ) );
        $edit_experience_institute_name           = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_experience_institute_name'] ) ) );
        $edit_experience_appointment_date      = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_experience_appointment_date'] ) ) );
        $edit_experience_designation  = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_experience_designation'] ) ) );
        $edit_experience_responsibilities = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_experience_responsibilities'] ) ) );

        $userexperienceUpdateSql = "UPDATE `user_experiences` SET  `institute_name`='$edit_experience_institute_name',`appointment_date`='$edit_experience_appointment_date',`designation`='$edit_experience_designation',`responsibilities`='$edit_experience_responsibilities' WHERE id='$update_user_experience_id'";     
       
        $userexperienceUpdateQuery = mysqli_query( $connect, $userexperienceUpdateSql );
        if ( $userexperienceUpdateQuery ) {
            echo true;
        } else {
            echo "users experience update failed.";
        }

    }
?>