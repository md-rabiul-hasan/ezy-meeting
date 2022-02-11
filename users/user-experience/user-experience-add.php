
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id      = $_SESSION['company_id'];
    $current_user_id = $_SESSION['id'];

    if (isset($_POST['user_id']) && isset($_POST['experience_institute_name']) && isset($_POST['experience_appointment_date']) && isset($_POST['experience_designation']) && isset($_POST['experience_responsibilities'])) {
        $user_id                     = strip_tags(mysqli_real_escape_string($connect, trim($_POST['user_id'])));
        $experience_institute_name   = strip_tags(mysqli_real_escape_string($connect, trim($_POST['experience_institute_name'])));
        $experience_appointment_date = strip_tags(mysqli_real_escape_string($connect, trim($_POST['experience_appointment_date'])));
        $experience_designation      = strip_tags(mysqli_real_escape_string($connect, trim($_POST['experience_designation'])));
        $experience_responsibilities = strip_tags(mysqli_real_escape_string($connect, trim($_POST['experience_responsibilities'])));

        $userexperienceCreateSql = "INSERT INTO `user_experiences`(`company_id`, `user_id`, `institute_name`, `appointment_date`, `designation`, `responsibilities`, `entry_user_id`)
        VALUES ('$company_id','$user_id','$experience_institute_name','$experience_appointment_date','$experience_designation','$experience_responsibilities','$current_user_id')";

        $userExperienceCreateQuery = mysqli_query($connect, $userexperienceCreateSql);
        if ($userExperienceCreateQuery) {
            echo true;
        } else {
            echo "users experience creation failed.";
        }

    }

?>