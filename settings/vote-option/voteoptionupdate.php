
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

     $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['edit_vote_option_id'] ) ) {
    	
        $edit_vote_option_id   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_vote_option_id'] ) ) );
       
        $edit_vote_option_name = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_vote_option_name'] ) ) );

        $edit_color = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_color'] ) ) );

        $voteOptionUpdateSql = "UPDATE `vote_options` SET  `name`='$edit_vote_option_name',
        `color`=' $edit_color' WHERE id='$edit_vote_option_id' ";

        $voteOptionUpdateQuery = mysqli_query( $connect, $voteOptionUpdateSql );
        if ( $voteOptionUpdateQuery ) {
            echo true;
        } else {
            echo "Vote options Update Failed.....";
        }

}
?>