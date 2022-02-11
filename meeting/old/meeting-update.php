
<?php include '../../database_connection.php';?>
<?php session_start();?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
$dt=date("Y-m-d");
    if ( isset( $_POST['title'] ) && isset( $_POST['committee'] ) && isset( $_POST['committee_chairman'] ) && isset( $_POST['meeting_date'] ) && isset( $_POST['location'] ) && isset( $_POST['meeting_id'] )) {
        $title            = mysqli_real_escape_string( $connect, $_POST['title'] );
        $committee     = mysqli_real_escape_string( $connect, $_POST['committee'] );
        $committee_chairman          = mysqli_real_escape_string( $connect, $_POST['committee_chairman'] );
        $meeting_date          = date("Y-m-d",strtotime(mysqli_real_escape_string( $connect, $_POST['meeting_date'] )));
        $location   = mysqli_real_escape_string( $connect, $_POST['location'] );
        $meeting_id=mysqli_real_escape_string( $connect, $_POST['meeting_id'] );
       // $committee_users = mysqli_real_escape_string( $connect, $_POST['committee_users']);
        $committee_users= '';

      

        $committeeCreateSql = "UPDATE `meetings` set  `committee_id`='$committee', `chairman_id`='$committee_chairman', `title`='$title', `meeting_date`='$meeting_date ', `location`='$location',`updated_at`='$dt' WHERE meeting_id='$meeting_id'";

        

        $committeeCreateQuery = mysqli_query( $connect, $committeeCreateSql );
        if ( $committeeCreateQuery ) {
            echo true;
        } else {
            echo "Meeting Update failed.";
        }

    }

?>