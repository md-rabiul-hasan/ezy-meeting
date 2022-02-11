<!-- Database Connection -->
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

    <div class="container">
        <div class="widget-list">
            <div class="row">

                <div class="col-md-12 widget-holder">
                    <?php
                    if( $_SESSION['msg']){
                        echo  $_SESSION['msg'];
                        $_SESSION['msg'] = null;
                    }else{

                    }
                    ?>


                    <div class="widget-bg">
                        <div class="widget-body clearfix">
                            <h5 class="box-title mr-b-0">Add New Package</h5>
                            <form action="insert-package-query.php" method="POST" accept-charset="UTF-8"    enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Package Name</label>
                                            <input class="form-control" id="package_title" name="package_title" value=""  placeholder="Package Name" required type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Package Price BDT</label>
                                            <input class="form-control"  name="package_price_bdt" value=""  placeholder="Package Price BDT" required type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Package Price USD</label>
                                            <input class="form-control" name="package_price_usd" value=""  placeholder="Package Price USD" required type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Super Admin</label>
                                            <input class="form-control" name="super_admin" value=""  placeholder="Super Admin" required type="number">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Committee Member</label>
                                            <input class="form-control" name="committee_member" value=""  placeholder="Committee Member" required type="number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Number of Committee  </label>
                                            <input class="form-control" name="number_of_committee" value=""  placeholder="Number of Committee " required type="number">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Subscription Type</label>
                                            <select class="form-control" name="subscription_type" required>
                                                <option value="1">Monthly</option>
                                                <option value="2">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Audio Calling</label>
                                            <select class="form-control" name="audio_calling" required>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Video  Calling</label>
                                            <select class="form-control" name="video_calling" required>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Individual Chat</label>
                                            <select class="form-control" name="individual_chat" required>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Multiple Meeting  </label>
                                            <select class="form-control" name="multiple_meeting" required>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Storage  </label>
                                            <input class="form-control" name="storage" value=""  placeholder="storage" required type="text">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Payment Method   </label>
                                            <input class="form-control" name="payment_method" value=""  placeholder="Payment Method" required type="text">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Transaction Charge   </label>
                                            <input class="form-control" name="transaction_charge" value=""  placeholder="Transaction Charge" required type="text">

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Display Status</label>
                                            <select class="form-control" name="display_status" required>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
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




