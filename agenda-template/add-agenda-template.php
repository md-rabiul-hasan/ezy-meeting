<?php include '../database_connection.php';?>

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
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Company Agenda Template</h6>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Agenda Template</li>
                            </ol>
                        </div>
                        <!-- /.page-title-right -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.page-title -->
            <!-- =================================== -->
            <!-- Different data widgets ============ -->
            <!-- =================================== -->
            <div class="container">
                <div class="widget-list">
                    <div class="row">
                        <div class="col-md-8 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-heading clearfix">
                                    <h5>Add Agenda Template</h5> 
                                    
                                    
                                </div>

                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <form action="agenda-template-store.php" method="POST">

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control" type="text" id="name" name="name" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <textarea class="form-control" required id="description" name="description" data-toggle="wysiwyg" ></textarea>
                                        </div>

                                        <label for="name">Template Type</label>
                                        <div class="form-group"> 
                                            <label>
                                                <input type="radio" required name="type" value="1"> <span class="label-text">Explanatory</span> &nbsp;&nbsp;&nbsp;
                                            </label>   
                                            <label>
                                                <input type="radio" required name="type"  value="2"> <span class="label-text">Resolved</span>
                                            </label>   
                                        </div>

                                        <div class="text-center mr-b-30">
                                            <input type="submit"  class="btn btn-success" value="save">
                                        </div>
                                    </form>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>



    <?php include '../partial/_footer.php';?>
    <script src="<?php echo $addDot; ?>assets/custom-js/agenda-template/agenda-template.js"></script>   
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>