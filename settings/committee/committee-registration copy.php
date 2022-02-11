<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['name']) && isset($_POST['quorum']) && isset($_POST['committee_users']) && isset($_POST['chairman_id'])) {
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

        $committeeCreateSql = "INSERT INTO `committees`(`company_id`, `name`, `description`, `prefix`, `quorum`, `current_index`, `committee_users`, `chairman_id`, `entry_user_id`)
        VALUES ('$company_id','$name','$description','$prefix','$quorum','$current_index','$committee_users','$chairman_id','$user_id')";

        $committeeCreateQuery = mysqli_query($connect, $committeeCreateSql);
        if ($committeeCreateQuery) {
            // Log Generate Section Start
            $committeeIdQuery = mysqli_query($connect, "SELECT id from committees where company_id='$company_id' ORDER BY id DESC limit 1");
            $committeeIdData  = mysqli_fetch_array($committeeIdQuery);
            $committeeId      = $committeeIdData['id'];
            committeeHistory($committeeId,$company_id,$name,$description,$prefix,$quorum,$current_index,$committee_users,$chairman_id,$user_id,"Committee Create",$user_id);

            // log generate section end
            echo true;
        } else {
            echo "committeee creation failed.";
        }

    }

?>