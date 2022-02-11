<!-- Database Connection -->
<?php include '../database_connection.php';?>
<?php session_start(); ?>

<!-- Authentication Check Start -->
<?php
if ( !isset( $_SESSION['id'] ) ) {
    header( "location:../login/login.php" );
    exit;
}

$company_id = $_SESSION['company_id'];
?>
<!-- Authentication Check End -->

<?php include '../partial/_header.php';?>
<main class="main-wrapper clearfix">

    <div class="container">
        <div class="widget-list">
            <div class="row">

                <div class="widget-holder col-md-12">
                    <div class="widget-bg">
                        <div class="widget-body">
                            <h5 class="box-title">App Screen List</h5>
                             <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th width="55px"> </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT *  FROM app_screen";
                                $query = mysqli_query($connect, $sql);
                                $counter=1;
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><img src="../landing-assets/app-screen/<?php echo $data['image']; ?>" height="150px"  ></td>
                                    <td class="text-center">
                                        <a href="del-app-screen.php?id=<?php echo $data['id'];; ?>" class="content-color"><i class="lnr lnr-trash md-18"></i></a>
                                    </td>
                                </tr>
                               <?php  $counter++;} ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.widget-list -->
    </div>
</main>


<?php include '../partial/_footer.php';?>
<script src="<?php echo $addDot; ?>assets/js/bootstrap-notify.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

<script src="<?php echo $addDot; ?>assets/js/template.js"></script>
<script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
<!-- default Script For Every Pages End -->
</body>

</html>