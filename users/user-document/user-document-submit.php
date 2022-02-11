
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id    = $_SESSION['company_id'];
    $entry_user_id = $_SESSION['id'];

    if (isset($_POST['user_id']) && isset($_POST['user_document_name']) && (!empty($_FILES['user_document_file']['name']))) {

        $user_id            = mysqli_real_escape_string($connect, $_POST['user_id']);
        $user_document_name = mysqli_real_escape_string($connect, $_POST['user_document_name']);

        if (!empty($_FILES['user_document_file']['name'])) {
            $docuemnt_file_name = $_FILES['user_document_file']['name'];
            $document_file_temp = $_FILES['user_document_file']['tmp_name'];
            $docuemnt_file_ext  = pathinfo($docuemnt_file_name, PATHINFO_EXTENSION);
            $allowed = array('pdf','xls','docx');
            if (!in_array(strtolower($docuemnt_file_ext), $allowed)) {
                echo "Only Pdf | xls | Docx File Supported";
                die();
            }

            $docuemnt_file_name = "user-document-" . $user_id . time() . uniqid() . '.' . $docuemnt_file_ext;
            if (!file_exists("../../storage/company/" . $company_id . "/users/user-document/")) {
                mkdir("../../storage/company/" . $company_id . "/users/user-document/", 0777, true);
            }
            $documentFileMoved = move_uploaded_file($document_file_temp,"../../storage/company/" . $company_id . "/users/user-document/" . $docuemnt_file_name);
        } else {
            $docuemnt_file_name = $docuemnt_file_name;
        }

        if ($documentFileMoved) {
            $documentUploadSql = "INSERT INTO `user_documents`(`company_id`, `user_id`, `document_name`, `document_file`, `entry_user_id`)
            VALUES ('$company_id','$user_id','$user_document_name','$docuemnt_file_name','$entry_user_id')";

            $documentUploadQuery = mysqli_query($connect, $documentUploadSql);
            if ($documentUploadQuery) {
                echo true;
            } else {
                echo "User Document Upload Failed.";
            }
        } else {
            echo "Document does not stored";
        }

    } else {
        echo "Please select required filed";
    }

?>