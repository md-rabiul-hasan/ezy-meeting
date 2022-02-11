
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['id'])) {
        $id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['id'])));

        // generate log start
        $logDataSql   = "SELECT `id`, `company_id`, `name`, `description`, `prefix`, `quorum`, `current_index`, `committee_users`, `chairman_id`, `entry_user_id` FROM `committees` WHERE id='$id' ";
        $logDataQuery = mysqli_query($connect, $logDataSql);
        $logData      = mysqli_fetch_array($logDataQuery);        
        // generate log end

        $committeeDeleteQuery = mysqli_query($connect, "DELETE FROM committees where id='$id' ");
        if ($committeeDeleteQuery) {
            mysqli_query($connect,"DELETE FROM committee_users WHERE company_id='{$company_id}' and committee_id='{$id}'");
            committeeHistory($logData['id'], $logData['company_id'], $logData['name'], $logData['description'], $logData['prefix'], $logData['quorum'], $logData['current_index'], $logData['committee_users'], $logData['chairman_id'], $logData['entry_user_id'], "Committee Deleted", $user_id);
            echo true;
        } else {
            echo "Company Committee Delete Failed.";
        }

    }

?>