
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id      = $_SESSION['company_id'];
    $current_user_id = $_SESSION['id'];

    if (isset($_POST['user_id']) && isset($_POST['relative_name']) && isset($_POST['relation_with_user'])) {
        $user_id                 = strip_tags(mysqli_real_escape_string($connect, trim($_POST['user_id'])));
        $relative_name           = strip_tags(mysqli_real_escape_string($connect, trim($_POST['relative_name'])));
        $relation_with_user      = strip_tags(mysqli_real_escape_string($connect, trim($_POST['relation_with_user'])));
        $relative_date_of_birth  = strip_tags(mysqli_real_escape_string($connect, trim($_POST['relative_date_of_birth'])));
        $relative_institute_name = strip_tags(mysqli_real_escape_string($connect, trim($_POST['relative_institute_name'])));

        $userRelativeCreateSql = "INSERT INTO `user_relatives`(`company_id`, `user_id`, `name`, `relation_with_user`, `date_of_birth`, `institute_name`, `entry_user_id`)
        VALUES ('$company_id','$user_id','$relative_name','$relation_with_user','$relative_date_of_birth','$relative_institute_name','$current_user_id')";

        $userReletiveCreateQuery = mysqli_query($connect, $userRelativeCreateSql);
        if ($userReletiveCreateQuery) {
            echo true;
        } else {
            echo "users relaive creation failed.";
        }

    }

?>