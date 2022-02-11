<?php include '../database_connection.php';?>
<?php session_start();?>
<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string( $connect, $_POST['title'] );
    $description = mysqli_real_escape_string( $connect, $_POST['description'] );

    $tmp_file = $_FILES['icon']['tmp_name'];
    $ext = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
    $rand = md5(uniqid().rand());
    $image = $rand.".".$ext;
    $mv_img=move_uploaded_file($tmp_file,"../landing-assets/icons/".$image);
    if($mv_img==1){
        $Sql = "INSERT INTO `features` SET title='$title', description='$description',icon='$image'";
        $Query = mysqli_query( $connect, $Sql );
        if ( $Query ) {
            $_SESSION['msg'] = '
                    <div class="alert alert-icon alert-success border-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button> <i class="material-icons list-icon"> </i>   <strong>New Feature </strong>   Added Successfully. </div>';
            echo "<script>window.location.href='add-feature.php'</script>";
            exit();
        }else{
            $_SESSION['msg'] = '
           <div class="alert alert-icon alert-warning border-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button> <i class="material-icons list-icon"> </i>   Something Wrong</div>';
            echo "<script>window.location.href='add-feature.php'</script>";
        }
    }
}



?>