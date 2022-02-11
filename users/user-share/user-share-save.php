
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id      = $_SESSION['company_id'];
    $current_user_id = $_SESSION['id'];

    if (isset($_POST['own_share']) && isset($_POST['user_id'])) {
        $own_share = strip_tags(mysqli_real_escape_string($connect, trim($_POST['own_share'])));
        $family_share = strip_tags(mysqli_real_escape_string($connect, trim($_POST['family_share'])));
        $user_id   = strip_tags(mysqli_real_escape_string($connect, trim($_POST['user_id'])));

        if(userDataCheckInProfiTable($company_id,$user_id) == true){
            $sql = "UPDATE user_profiles SET own_share='{$own_share}',family_share='{$family_share}' WHERE company_id='{$company_id}' and user_id='{$user_id}' ";
        }else{
            $sql = "INSERT INTO user_profiles (`company_id`,`user_id`,`own_share`,`family_share`,`entry_user_id`) VALUES ('{$company_id}','{$user_id}','{$own_share}','{$family_share}','{$current_user_id}') ";
        }

        $userShareHolderQuery = mysqli_query($connect, $sql);
        if ($userShareHolderQuery) {
            echo true;
        } else {
            echo "users share setup failed.";
        }

    }

?>