
<?php include '../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['id'] )  ) {
        $id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['id'] ) ) );

        $noticeDeleteQuery = mysqli_query($connect,"DELETE FROM notices where id='$id' LIMIT 1 ");
        if ( $noticeDeleteQuery ) {
            echo true;
        } else {
            echo "Notice Delete Failed.";
        }

    }

?>