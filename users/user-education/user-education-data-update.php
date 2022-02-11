
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['edit_user_education_id'] ) && isset( $_POST['edit_education_institute_name'] ) && isset( $_POST['edit_education_profession_education'] ) ) {
        $edit_user_education_id                 = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_user_education_id'] ) ) );
        $edit_education_institute_name           = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_education_institute_name'] ) ) );
        $edit_education_profession_education      = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_education_profession_education'] ) ) );
        $edit_education_seminar_training  = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_education_seminar_training'] ) ) );

        $userEducationUpdateSql = "UPDATE `user_educations` SET  `institute_name`='$edit_education_institute_name',`profession_education`='$edit_education_profession_education',`seminar_training`='$edit_education_seminar_training' WHERE id='$edit_user_education_id'";     
       
        $userEducationUpdateQuery = mysqli_query( $connect, $userEducationUpdateSql );
        if ( $userEducationUpdateQuery ) {
            echo true;
        } else {
            echo "users education update failed.";
        }

    }
?>