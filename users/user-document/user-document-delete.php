
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['id'] )  ) {
        $id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['id'] ) ) );
        
        $userEducationDataDeleteQuery = mysqli_query($connect,"DELETE FROM user_documents where id='$id' ");
        if ( $userEducationDataDeleteQuery ) {
            echo true;
        } else {
            echo "users documentation data delete failed.";
        }

    }

?>