
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id      = $_SESSION['company_id'];
    $user_id         = $_SESSION['id'];
    $current_user_id = $_SESSION['id'];

    if (isset($_POST['client_id']) && isset($_POST['secret_key']) && isset($_POST['redirect_url'])) {
        $client_id    = strip_tags(mysqli_real_escape_string($connect, trim($_POST['client_id'])));
        $secret_key   = strip_tags(mysqli_real_escape_string($connect, trim($_POST['secret_key'])));
        $redirect_url = strip_tags(mysqli_real_escape_string($connect, trim($_POST['redirect_url'])));

        $zoomCreateSql = "INSERT INTO `zoom_credential`( `company_id`, `client_id`, `client_secret`, `redirect_url`, `entry_user_id`) VALUES   ('{$company_id}','{$client_id}','{$secret_key}','{$redirect_url}','{$current_user_id}')";

        $zoomCreateQuery = mysqli_query($connect, $zoomCreateSql);
        if ($zoomCreateQuery) {
            echo true;
        } else {
            echo "Zoom  creation failed.";
        }

    }

?>