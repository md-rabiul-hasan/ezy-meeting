
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if ( isset( $_POST['name'] ) ) {
        $name = mysqli_real_escape_string( $connect, $_POST['name'] );

        $divisionCreateSql = "INSERT INTO `memos`( `company_id`, `name`, `entry_user_id`)
        VALUES ('$company_id','$name','$user_id')";

        $divisionCreateQuery = mysqli_query( $connect, $divisionCreateSql );
        if ( $divisionCreateQuery ) {
            echo true;
        } else {
            echo "memo creation failed.";
        }

    }

?>