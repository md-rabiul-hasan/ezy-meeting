
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['type'])) {
        $name        = strip_tags(mysqli_real_escape_string($connect, trim($_POST['name'])));
        $description = mysqli_real_escape_string($connect, trim($_POST['description']));
        $type        = strip_tags(mysqli_real_escape_string($connect, trim($_POST['type'])));

        $agendaTemplateSql = "INSERT INTO `agenda_templates` (`company_id`, `name`, `type`, `description`, `entry_user_id`)
        VALUES ('$company_id','$name','$type','$description','$user_id')";

        $agendaTemplateQuery = mysqli_query($connect, $agendaTemplateSql);
        if ($agendaTemplateQuery) {
            echo true;
        } else {
            echo "Agenda Template Creation Failed.";
        }

    }

?>