
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if (isset($_POST['explanatory_template_id'])) {

        $explanatory_template_id  = mysqli_real_escape_string($connect, $_POST['explanatory_template_id']);

        $explanatoryTemplateSql = "SELECT description FROM agenda_templates WHERE id='$explanatory_template_id'";
        $explanatoryTemplateQuery = mysqli_query($connect,$explanatoryTemplateSql);
        $explanatoryTemplateData = mysqli_fetch_array($explanatoryTemplateQuery);
        $explanatoryTemplateDescription = $explanatoryTemplateData['description'];
        echo $explanatoryTemplateDescription;

       

    }

?>