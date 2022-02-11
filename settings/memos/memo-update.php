
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['edit_memo_id'] ) && isset( $_POST['edit_memo_name'] ) ) {
        $edit_memo_id   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_memo_id'] ) ) );
        $edit_memo_name = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_memo_name'] ) ) );

        $memoUpdateSql = "UPDATE `memos` SET  `name`='$edit_memo_name' WHERE id='$edit_memo_id'";

        $memoUpdateQuery = mysqli_query( $connect, $memoUpdateSql );
        if ( $memoUpdateQuery ) {
            echo true;
        } else {
            echo "Memo Update Failed";
        }

}
?>