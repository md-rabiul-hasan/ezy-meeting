
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

        $voteOptionsDataQuery = mysqli_query($connect,"SELECT * FROM vote_options where id='$id' ");
        $voteOptionsData = mysqli_fetch_array($voteOptionsDataQuery);
        echo  json_encode($voteOptionsData);

    }

?>