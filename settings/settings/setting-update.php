
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $current_user_id = $_SESSION['id'];

    if ( isset( $_POST['edit_setting_id'] ) && isset( $_POST['edit_agenda_pefix'] )  && isset( $_POST['edit_meeting_signatory_name'] ) && isset( $_POST['edit_meeting_signatory_designation'] ) ) {
        $edit_setting_id   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_setting_id'] ) ) );
        $edit_agenda_pefix   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_agenda_pefix'] ) ) );
        $edit_meeting_signatory_name   = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_meeting_signatory_name'] ) ) );
        $edit_meeting_signatory_designation = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['edit_meeting_signatory_designation'] ) ) );

        $settingUpdateSql = "UPDATE `settings` SET `agenda_pefix`='$edit_agenda_pefix',`meeting_signatory_name`='$edit_meeting_signatory_name',`meeting_signatory_designation`='$edit_meeting_signatory_designation' WHERE id='$edit_setting_id'";

        $settingUpdateQuery = mysqli_query( $connect, $settingUpdateSql );
        if ( $settingUpdateQuery ) {
             // generate log start
             $logDataSql = "SELECT `id`, `company_id`, `agenda_pefix`, `meeting_signatory_name`, `meeting_signatory_designation`, `entry_user`  FROM `settings` WHERE id='$edit_setting_id' ";
             $logDataQuery = mysqli_query($connect,$logDataSql);
             $logData = mysqli_fetch_array($logDataQuery);
             settingHistory($logData['id'], $logData['company_id'], $logData['agenda_pefix'], $logData['meeting_signatory_name'], $logData['meeting_signatory_designation'],$logData['entry_user'], "Setting Update", $current_user_id);
             // generate log end
            echo true;
        } else {
            echo "Setting Update Failed";
        }

}
?>