
<?php include '../../database_connection.php';?>

<?php
    header("Content-type: text/javascript");
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['id'] )  ) {
        $id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['id'] ) ) );
        
        $userDocumentationDataQuery = mysqli_query($connect,"SELECT id,document_name FROM user_documents where id='$id' ");
        $userDocumentationData = mysqli_fetch_array($userDocumentationDataQuery);
        echo  json_encode($userDocumentationData);

    }

?>