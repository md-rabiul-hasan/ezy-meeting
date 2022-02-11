
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['user_id'] )  ) {
        $user_id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['user_id'] ) ) );

        $userShareDataDeleteQuery = mysqli_query($connect,"UPDATE user_profiles SET family_share='0',own_share='0' WHERE company_id='{$company_id}' and user_id='{$user_id}' ");
        if ( $userShareDataDeleteQuery ) {
            echo true;
        } else {
            echo "users share data delete failed.";
        }

    }

?>