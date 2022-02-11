
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

        $userShareDataQuery = mysqli_query($connect,"SELECT user_id,family_share,own_share FROM user_profiles where company_id='{$company_id}' and  user_id='{$id}' ");
        $userShareData = mysqli_fetch_array($userShareDataQuery);
        echo  json_encode($userShareData);

    }

?>