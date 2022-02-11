
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['id'] )  ) {
        $id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['id'] ) ) );

        $userRelativeDataDeleteQuery = mysqli_query($connect,"DELETE FROM user_relatives where id='$id' ");
        if ( $userRelativeDataDeleteQuery ) {
            echo true;
        } else {
            echo "users relaive data delete failed.";
        }

    }

?>