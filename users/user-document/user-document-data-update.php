
<?php include '../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id    = $_SESSION['company_id'];
    $entry_user_id = $_SESSION['id'];

    if (isset($_POST['edit_user_document_id']) && isset($_POST['edit_user_document_name'])) {

        $edit_user_document_id   = mysqli_real_escape_string($connect, $_POST['edit_user_document_id']);
        $edit_user_document_name = mysqli_real_escape_string($connect, $_POST['edit_user_document_name']);

        // find out old document information start
        $oldInfoSql   = "SELECT document_file FROM user_documents WHERE id='$edit_user_document_id'";
        $oldInfoQuery = mysqli_query($connect, $oldInfoSql);
        $oldInfoData  = mysqli_fetch_array($oldInfoQuery);

        // find out old document information end

        // if (!empty($_FILES['edit_user_document_file']['name'])) {
        //     $docuemnt_file_name = $_FILES['edit_user_document_file']['name'];
        //     $document_file_temp = $_FILES['edit_user_document_file']['tmp_name'];
        //     $docuemnt_file_ext  = pathinfo($docuemnt_file_name, PATHINFO_EXTENSION);

        //     $docuemnt_file_name = "user-document-" . $user_id . time() . uniqid() . '.' . $docuemnt_file_ext;
        //     if (!file_exists("../../storage/company/" . $company_id . "/users/user-document/")) {
        //         mkdir("../../storage/company/" . $company_id . "/users/user-document/", 0777, true);
        //     }
        //     $documentFileMoved = move_uploaded_file($document_file_temp, "../../storage/company/" . $company_id . "/users/user-document/" . $docuemnt_file_name);
        // } else {
        //     $docuemnt_file_name = $oldInfoData['document_file']
        // }

        $documentUpdateSql  = "UPDATE `user_documents` SET `document_name`='$edit_user_document_name' WHERE  id='$edit_user_document_id' ";

        $documentUpdateQuery = mysqli_query($connect, $documentUpdateSql);
        if ($documentUpdateQuery) {
            echo true;
        } else {
            echo "User Document Update Failed.";
        }

    } else {
        echo "Please select required filed";
    }

?>