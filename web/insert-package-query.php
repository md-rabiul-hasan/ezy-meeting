<?php include '../database_connection.php';?>

<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}


if (isset($_POST['submit'])) {
    $package_title = mysqli_real_escape_string( $connect, $_POST['package_title'] );
    $package_price_bdt = mysqli_real_escape_string( $connect, $_POST['package_price_bdt'] );
    $package_price_usd = mysqli_real_escape_string( $connect, $_POST['package_price_usd'] );
    $super_admin = mysqli_real_escape_string( $connect, $_POST['super_admin'] );
    $committee_member = mysqli_real_escape_string( $connect, $_POST['committee_member'] );
    $number_of_committee = mysqli_real_escape_string( $connect, $_POST['number_of_committee'] );
    $subscription_type = mysqli_real_escape_string( $connect, $_POST['subscription_type'] );
    $audio_calling = mysqli_real_escape_string( $connect, $_POST['audio_calling'] );
    $video_calling = mysqli_real_escape_string( $connect, $_POST['video_calling'] );
    $individual_chat = mysqli_real_escape_string( $connect, $_POST['individual_chat'] );
    $multiple_meeting = mysqli_real_escape_string( $connect, $_POST['multiple_meeting'] );
    $storage = mysqli_real_escape_string( $connect, $_POST['storage'] );
    $payment_method = mysqli_real_escape_string( $connect, $_POST['payment_method'] );
    $transaction_charge = mysqli_real_escape_string( $connect, $_POST['transaction_charge'] );
    $display_status = mysqli_real_escape_string( $connect, $_POST['display_status'] );
    $entry_dt=date('Y-m-d');
 echo $Sql = "INSERT INTO `package_info` SET
     package_title='$package_title', 
     package_price_bdt='$package_price_bdt',
     package_price_usd='$package_price_usd',
     super_admin='$super_admin',
     committee_member='$committee_member',
     number_of_committee='$number_of_committee',
     subscription_type='$subscription_type',
     audio_calling='$audio_calling',
     video_calling='$video_calling',
     individual_chat='$individual_chat',
     multiple_meeting='$multiple_meeting',
     storage='$storage',
     payment_method='$payment_method',
     transaction_charge='$transaction_charge',
     display_status='$display_status',
     entry_dt='$entry_dt'";

        $Query = mysqli_query( $connect, $Sql );

        if ( $Query ) {
            $_SESSION['msg'] = '
                    <div class="alert alert-icon alert-success border-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button> <i class="material-icons list-icon"> </i>   <strong>New Package </strong>   Added Successfully. </div>';
            echo "<script>window.location.href='add-package.php'</script>";
            exit();
        }else{
            $_SESSION['msg'] = '
           <div class="alert alert-icon alert-warning border-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button> <i class="material-icons list-icon"> </i>   Something Wrong</div>';
            echo "<script>window.location.href='add-package.php'</script>";
        }

}



?>