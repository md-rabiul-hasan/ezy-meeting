
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['resolved_template_id'])) {

        $resolved_template_id = mysqli_real_escape_string($connect, $_POST['resolved_template_id']);

        $resolvedTemplateSql          = "SELECT description FROM agenda_templates WHERE id='$resolved_template_id'";
        $resolvedTemplateQuery        = mysqli_query($connect, $resolvedTemplateSql);
        $resloveTemplateDate          = mysqli_fetch_array($resolvedTemplateQuery);
        $reslolvedTemplateDescription = $resloveTemplateDate['description'];
        echo $reslolvedTemplateDescription;

    }

?>