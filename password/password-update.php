
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $old_password     = filter_input(INPUT_POST, 'old_password', FILTER_SANITIZE_STRING);
        $new_password     = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

        $sql                  = "SELECT password FROM users where id='{$user_id}' LIMIT 1";
        $query                = mysqli_query($connect, $sql);
        $rowCount             = mysqli_num_rows($query);
        $data                 = mysqli_fetch_assoc($query);
        if ($rowCount > 0) {
            if(password_verify($old_password, $data['password'])){
                if ($new_password == $confirm_password) {
                    $encryptedNewPassword = password_hash($new_password, PASSWORD_DEFAULT);
                    $updatePasswordSql    = "UPDATE users SET password='{$encryptedNewPassword}' where id='{$user_id}'";
                    $updatePasswordQuery  = mysqli_query($connect, $updatePasswordSql);
                    if ($updatePasswordQuery) {
                        $_SESSION['password_change_message'] = "success";
                        echo "<script>window.location='password-change.php'</script>"; //error
                    } else {
                        $_SESSION['password_change_message'] = "failed";
                        echo "<script>window.location='password-change.php'</script>"; //error
                    }
                } else {
                    $_SESSION['password_change_message'] = "new_confirm_not_match";
                    echo "<script>window.location='password-change.php'</script>"; //error
                }
                
            } else {

                $_SESSION['password_change_message'] = "old_not_match";
                echo "<script>window.location='password-change.php'</script>"; //error
            }
        } 
}
?>