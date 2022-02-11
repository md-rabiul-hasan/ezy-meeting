
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id      = $_SESSION['company_id'];
    $current_user_id = $_SESSION['id'];

    if (isset($_POST['education_user_id']) && isset($_POST['education_institute_name']) && isset($_POST['education_profession_education'])) {
        $education_user_id              = strip_tags(mysqli_real_escape_string($connect, trim($_POST['education_user_id'])));
        $education_institute_name       = strip_tags(mysqli_real_escape_string($connect, trim($_POST['education_institute_name'])));
        $education_profession_education = strip_tags(mysqli_real_escape_string($connect, trim($_POST['education_profession_education'])));
        $education_seminar_training     = strip_tags(mysqli_real_escape_string($connect, trim($_POST['education_seminar_training'])));

        $userEducationCreateSql = "INSERT INTO `user_educations`( `company_id`, `user_id`, `institute_name`, `profession_education`, `seminar_training`, `entry_user_id`)
        VALUES ('$company_id','$education_user_id','$education_institute_name','$education_profession_education','$education_seminar_training', '$current_user_id')";

        $userEducationCreateQuery = mysqli_query($connect, $userEducationCreateSql);
        if ($userEducationCreateQuery) {
            echo true;
        } else {
            echo "users education creation failed.";
        }

    }

?>