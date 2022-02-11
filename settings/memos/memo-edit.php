
<?php include '../../database_connection.php';?>

<?php
    header("Content-type: text/javascript");
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['id'] )  ) {
        $id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['id'] ) ) );

        $memoDataQuery = mysqli_query($connect,"SELECT * FROM memos where id='$id' ");
        $memoData = mysqli_fetch_array($memoDataQuery);
        echo  json_encode($memoData);

    }

?>