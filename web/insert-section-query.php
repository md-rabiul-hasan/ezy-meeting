<?php include '../database_connection.php';?>
<?php session_start();?>
<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

if (isset($_POST['submit'])) {
    $summary_info = mysqli_real_escape_string( $connect, $_POST['summary_info'] );
    $title = mysqli_real_escape_string( $connect, $_POST['title'] );
    $tmp_file = $_FILES['image']['tmp_name'];
    $ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $rand = md5(uniqid().rand());
    $image = $rand.".".$ext;
    $mv_img=move_uploaded_file($tmp_file,"../landing-assets/section/".$image);

    $tmp_file1 = $_FILES['icon']['tmp_name'];
    $ext1 = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
    $rand1 = md5(uniqid().rand());
    $icon = $rand1.".".$ext1;
    $mv_icon=move_uploaded_file($tmp_file1,"../landing-assets/section/".$icon);

    if($mv_img==1 && $mv_icon==1){
         $Sql = "INSERT INTO `web_sections` SET image='$image', icon='$icon',title='$title',summary_info='$summary_info'";

       $Query = mysqli_query( $connect, $Sql );
        if ( $Query ) {
            $_SESSION['msg'] = '
                    <div class="alert alert-icon alert-success border-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button> <i class="material-icons list-icon"> </i>   <strong>New  Section </strong>   Added Successfully. </div>';
            echo "<script>window.location.href='add-section.php'</script>";
            exit();
        }else{
            $_SESSION['msg'] = '
           <div class="alert alert-icon alert-warning border-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button> <i class="material-icons list-icon"> </i>   Something Wrong</div>';
            echo "<script>window.location.href='add-section.php'</script>";
        }
    }
}



?>