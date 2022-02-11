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

                <div class="col-md-12 widget-holder">
                    <?php
                    if( $_SESSION['msg']){
                        echo  $_SESSION['msg'];
                        $_SESSION['msg'] = null;
                    }
                    ?>


                    <div class="widget-bg">
                        <div class="widget-body clearfix">
                            <h5 class="box-title mr-b-0">Add New Section</h5>
                            <form action="insert-section-query.php" method="POST" accept-charset="UTF-8"    enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Section Title</label>
                                            <input class="form-control" id="title" name="title" value=""  placeholder="Section Title" required type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Section Summary Info</label>
                                            <textarea class="form-control" name="summary_info"   required  data-toggle="wysiwyg" ></textarea>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Section Icon</label>
                                            <input class="form-control"  name="icon" type="file"  required >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Section Image</label>
                                            <input class="form-control"  name="image" type="file"  required >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions btn-list">
                                    <button class="btn btn-primary" id="submit" name="submit" type="submit">Submit</button>

                                </div>
                            </form>
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