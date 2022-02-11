
<?php include '../../database_connection.php';?>

<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];

    if ( isset( $_POST['selected_user_id'] )  ) {
        $selected_user_id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['selected_user_id'] ) ) );
        $old_chairman_id = strip_tags( mysqli_real_escape_string( $connect, trim( $_POST['old_chairman_id'] ) ) );
        $selected_user_id = str_replace("'",'',$selected_user_id);

        $committeeMemberQuery = mysqli_query($connect,"SELECT id,name FROM users where id in ($selected_user_id) ");
        $selectedUserlist = '';
        $selectedUserlist .= "<option value=''>Select Member</option>";
        while($committeeMemberData = mysqli_fetch_array($committeeMemberQuery) ){
            if($committeeMemberData['id'] == $old_chairman_id){
                $selectedVariable = "selected";
            }else{
                $selectedVariable = "";
            }
            $selectedUserlist .= "<option {$selectedVariable} value=".$committeeMemberData['id'].">".$committeeMemberData['name']."</option>";  
        }
        echo $selectedUserlist;


    }

?>