
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if (isset($_POST['update_user_share_id']) && isset($_POST['edit_own_share'])) {
        $update_user_share_id = strip_tags(mysqli_real_escape_string($connect, trim($_POST['update_user_share_id'])));
        $edit_family_share    = strip_tags(mysqli_real_escape_string($connect, trim($_POST['edit_family_share'])));
        $edit_own_share       = strip_tags(mysqli_real_escape_string($connect, trim($_POST['edit_own_share'])));

        $userShareUpdateSql = "UPDATE `user_profiles` SET  `family_share`='$edit_family_share',`own_share`='$edit_own_share' WHERE company_id='{$company_id}' and user_id='{$update_user_share_id}'";

        $userShareUpdateQuery = mysqli_query($connect, $userShareUpdateSql);
        if ($userShareUpdateQuery) {
            echo true;
        } else {
            echo "users share update failed.";
        }

}
?>