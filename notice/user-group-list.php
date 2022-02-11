
<?php include '../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];



    if (isset($_POST['type'])) {
       $type = filter_input(INPUT_POST,'type',FILTER_SANITIZE_STRING);
       if($type == "committee"){
            $sql = "SELECT id,name FROM `committees` WHERE company_id='{$company_id}'";
       }else if($type == "all"){
            $sql = "SELECT id,name FROM `committees` WHERE company_id='{$company_id}'";
       }

       $query = mysqli_query($connect,$sql);
       $output = '<option value="">Select User Group</option>';
       while($data = mysqli_fetch_assoc($query)){
            $output .= '<option value="'.$data['id'] .'">'.$data['name'] .'</option>';
       }
       echo $output;

    }

?>
