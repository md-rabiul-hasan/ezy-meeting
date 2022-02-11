
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['role_id']) && isset($_POST['password']) && isset($_POST['committee_id'])) {
        $name         = mysqli_real_escape_string($connect, $_POST['name']);
        $email        = mysqli_real_escape_string($connect, $_POST['email']);
        $phone        = mysqli_real_escape_string($connect, $_POST['phone']);
        $painPassword = mysqli_real_escape_string($connect, $_POST['password']);
        $role_id      = mysqli_real_escape_string($connect, $_POST['role_id']);
        $committee_id = mysqli_real_escape_string($connect, $_POST['committee_id']);
        $password     = password_hash($painPassword, PASSWORD_DEFAULT);

        if (($role_id == 1) && (is_superAdminEnable($company_id) == false)) {
            echo "You cannot create more super admin. Update your package";
            die();
        }

        $userCreateSql = "INSERT INTO `users`( `company_id`, `name`, `email`, `phone`, `password`, `role_id`, `is_active`, `entry_user_id`)  VALUES ('$company_id','$name','$email', '$phone','$password','$role_id',1,'$user_id')";

        $userCreateQuery = mysqli_query($connect, $userCreateSql);
        if ($userCreateQuery) {
            $lastInsertId = findOutLastInsetUserId($email, $company_id);
                $mailMessage = "Welcome to the Ezy-Meeting.<br>Your registation are successfully compleated. please <a href='http://ezy-meeting.com/demo/login/login.php'>Login Here</a> with your email:{$email} address and default password:{$painPassword}";
                if (sendMail($email, $name, "Ezy-Meeting User Registation", $mailMessage) == false) {
                    echo "Mail sent failed";
                    die();
                }
            // if committee selected
            if ($committee_id != '' && $role_id == 3) {
                $addCommitteeMember = addCommitteeMember($company_id, $committee_id, $lastInsertId);
            }

            if ($role_id == 3) { //member
                $userProfilesInsertSql = "INSERT INTO user_profiles (`company_id`,`user_id`,`is_voter`,`entry_user_id`)  VALUES ('{$company_id}','{$lastInsertId}','1','{$user_id}')";

                $userProfilesInsertQuery = mysqli_query($connect, $userProfilesInsertSql);
                if ($userProfilesInsertQuery) {
                   
                        $_SESSION['user_registation_message'] = "User Created Successfully";
                        echo true;
                    

                } else {
                    echo "user create but user profiles update failed";
                }
            } else {
                $_SESSION['user_registation_message'] = "User Created Successfully";
                echo true;
            }

        } else {
            echo "users creation failed.";
        }

    }


?>