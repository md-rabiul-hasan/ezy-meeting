
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
    if ( isset( $_POST['title'] ) && isset( $_POST['committee'] ) && isset( $_POST['meeting_time'] ) && isset( $_POST['meeting_date'] ) && isset( $_POST['location'] ) ) {
        $title            = mysqli_real_escape_string( $connect, $_POST['title'] );
        $committee     = mysqli_real_escape_string( $connect, $_POST['committee'] );
        $meeting_time          = mysqli_real_escape_string( $connect, $_POST['meeting_time'] );
        $meeting_date          = date("Y-m-d",strtotime(mysqli_real_escape_string( $connect, $_POST['meeting_date'] )));
        $location   = mysqli_real_escape_string( $connect, $_POST['location'] );
       // $committee_users = mysqli_real_escape_string( $connect, $_POST['committee_users']);
        $committee_users= '';

      

        $committeeCreateSql = "INSERT INTO `meetings`(`company_id`, `committee_id`, `meeting_time`, `title`, `meeting_date`, `location`, `is_open`, `entry_user_id`, `create_at`) VALUES ('$company_id','$committee','$meeting_time ','$title  ','$meeting_date','$location','0','$user_id','$dt')";

        

        $committeeCreateQuery = mysqli_query( $connect, $committeeCreateSql );
        if ( $committeeCreateQuery ) {
            echo true;
        } else {
            echo "Meeting creation failed.";
        }

    }

?>