
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id      = $_SESSION['company_id'];
    $user_id         = $_SESSION['id'];
    $current_user_id = $_SESSION['id'];

    if (isset($_POST['agenda_pefix']) && isset($_POST['meeting_signatory_name']) && isset($_POST['meeting_signatory_designation'])) {
        $agenda_pefix                  = strip_tags(mysqli_real_escape_string($connect, trim($_POST['agenda_pefix'])));
        $meeting_signatory_name        = strip_tags(mysqli_real_escape_string($connect, trim($_POST['meeting_signatory_name'])));
        $meeting_signatory_designation = strip_tags(mysqli_real_escape_string($connect, trim($_POST['meeting_signatory_designation'])));

        $seetingCreateSql = "INSERT INTO `settings`( `company_id`, `agenda_pefix`, `meeting_signatory_name`, `meeting_signatory_designation`, `entry_user`)
        VALUES ('$company_id','$agenda_pefix','$meeting_signatory_name','$meeting_signatory_designation','$user_id')";

        $settingCreateQuery = mysqli_query($connect, $seetingCreateSql);
        if ($settingCreateQuery) {
            // Log Generate Section Start
            $settingIdQuery = mysqli_query($connect, "SELECT id from settings where company_id='$company_id' ORDER BY id DESC limit 1");
            $settingIdData  = mysqli_fetch_array($settingIdQuery);
            $seetingId      = $settingIdData['id'];
            settingHistory($seetingId, $company_id, $agenda_pefix, $meeting_signatory_name, $meeting_signatory_designation,$user_id, "Setting Create", $current_user_id);
            // log generate section end
            echo true;
        } else {
            echo "Setting  creation failed.";
        }

    }

?>