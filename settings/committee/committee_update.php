<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_GET['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['prefix']) && isset($_POST['quorum']) && isset($_POST['current_index']) && isset($_POST['committee_users']) && isset($_POST['chairman_id'])) {
        $committee_id    = mysqli_real_escape_string($connect, $_GET['id']);
        $name            = mysqli_real_escape_string($connect, $_POST['name']);
        $description     = mysqli_real_escape_string($connect, $_POST['description']);
        $prefix          = mysqli_real_escape_string($connect, $_POST['prefix']);
        $quorum          = mysqli_real_escape_string($connect, $_POST['quorum']);
        $current_index   = mysqli_real_escape_string($connect, $_POST['current_index']);
        $chairman_id     = mysqli_real_escape_string($connect, $_POST['chairman_id']);
        $committee_users = '';

        foreach ($_POST['committee_users'] as $select_user) {
            if ($committee_users != '') {
                $committee_users = $committee_users . ',' . $select_user;
            } else {
                $committee_users = $select_user;
            }

        }

        

        $committeUpdateSql = "UPDATE `committees` SET `name`='$name',`description`='$description',`prefix`='$prefix',`quorum`='$quorum',`current_index`='$current_index',`committee_users`='$committee_users',`chairman_id`='$chairman_id' WHERE id='$committee_id' ";

        $committeUpdateQuery = mysqli_query($connect, $committeUpdateSql);
        if ($committeUpdateQuery) {
            // generate log start
            $logDataSql = "SELECT `id`, `company_id`, `name`, `description`, `prefix`, `quorum`, `current_index`, `committee_users`, `chairman_id`, `entry_user_id` FROM `committees` WHERE id='$committee_id' ";
            $logDataQuery = mysqli_query($connect,$logDataSql);
            $logData = mysqli_fetch_array($logDataQuery);
            mysqli_query($connect,"DELETE FROM committee_users WHERE company_id='{$company_id}' and committee_id='{$committee_id}'");
            $committee_users_create   = createCommitteeUsers($company_id, $committee_id, $_POST['committee_users']);
            $committe_chairman_create = createCommitteeChairman($company_id, $committee_id, $chairman_id);
            if ($committee_users_create && $committe_chairman_create) {
                if(updateMeetingChaimanAndUsers($company_id,$committee_id) != true){
                    echo "Committee does not replacted meeting";
                    die();
                }
                committeeHistory($logData['id'],$logData['company_id'],$logData['name'],$logData['description'],$logData['prefix'],$logData['quorum'],$logData['current_index'],$logData['committee_users'],$logData['chairman_id'],$logData['entry_user_id'],"Committee Update",$user_id);
            } else {
                echo "Committee Update Failed";
                die();
            }            
            // generate log end           
            $_SESSION['msg'] = true;
            echo "<script>window.location='all-committee.php'</script>"; //success
        } else {
            $_SESSION['msg'] = false;
            echo "<script>window.location='all-committee.php'</script>"; //success
        }

    }

?>