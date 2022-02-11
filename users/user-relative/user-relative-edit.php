
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

        $userRelativeDataQuery = mysqli_query($connect,"SELECT * FROM user_relatives where id='$id' ");
        $userRelativeData = mysqli_fetch_array($userRelativeDataQuery);
        echo  json_encode($userRelativeData);

    }

?>