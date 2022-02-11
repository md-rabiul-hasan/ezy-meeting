
<?php include '../../../database_connection.php';?>

<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];

    if(isset($_POST['agenda_id_array']) && isset($_POST['agenda_prefix'])){
       $agenda_prefix = mysqli_real_escape_string($connect,$_POST['agenda_prefix']);
       $agenda_id_array = $_POST['agenda_id_array'];
       $sl = 1;
       $success = 0;
       $error = 0;
       foreach($agenda_id_array as $agenda_id){
           $sortingSql = "UPDATE agendas SET agenda_sl='$sl',agenda_prefix='$agenda_prefix' WHERE id='$agenda_id'";
           $sortingQuery = mysqli_query($connect,$sortingSql);
           if($sortingQuery){
               ++$success;
           }else{
               ++$error;
           }
           $sl++;
       }
       if($error > 0){
           echo "Agenda Sorting Failed";
       }else{
           echo true;
       }
    }
