
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
     //$name = mysqli_real_escape_string( $connect, $_POST['name'] );

    if ( isset( $_POST['name'] ) ) {
        $name = mysqli_real_escape_string( $connect, $_POST['name'] );
         $color = mysqli_real_escape_string( $connect, $_POST['color_id'] );

        $voteOptionCreateSql = "INSERT INTO `vote_options`( `company_id`, `name`,`color`,
         `entry_user_id`)
        VALUES ('$company_id','$name','$color','$user_id')";

        $voteOptionCreateQuery = mysqli_query( $connect, $voteOptionCreateSql );
        if ( $voteOptionCreateQuery ) {
            echo true;
        } else {
            echo "vote option creation failed.";
        }

    }

?>