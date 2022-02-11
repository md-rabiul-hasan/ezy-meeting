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
        <div class="col-md-12 widget-holder">
            <div class="widget-bg-transparent">
                <div class="widget-body clearfix">
                    <h5 class="box-title">Packages</h5>
                    <div class="accordion" id="accordion-3" role="tablist" aria-multiselectable="true">
                        <?php
                        $sql = "SELECT *  FROM package_info";
                        $query = mysqli_query($connect, $sql);

                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <div class="card card-outline-success">
                            <div class="card-header" role="tab" id="heading4">
                                <h6 class="card-title"><a role="button" data-toggle="collapse" data-parent="#accordion-3" href="#collapse<?php echo $data['sl'];?>" aria-expanded="false" aria-controls="collapse21" class="collapsed"><?php echo $data['package_title'];?></a></h6>
                            </div>
                            <!-- /.card-header -->
                            <div id="collapse<?php echo $data['sl'];?>" class="card-collapse collapse" role="tabpanel" aria-labelledby="heading4" style="">
                                <div class="card-body">

                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>
                                                <td>Package Title</td>
                                                <td><?php echo $data['package_title']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Package Price Bdt </td>
                                                <td><?php echo $data['package_price_bdt']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Package Price Usd </td>
                                                <td><?php echo $data['package_price_usd']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Super Admin</td>
                                                <td><?php echo $data['super_admin']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Committee Member </td>
                                                <td><?php echo $data['committee_member']; ?></td>
                                            </tr>
                                            <tr>
                                                <td> Number of Committee</td>
                                                <td><?php echo $data['number_of_committee']; ?></td>
                                            </tr>
                                            <tr>
                                                <td> Subscription Type</td>
                                                <td><?php
                                                    if($data['subscription_type']==1){
                                                        echo "Monthly";
                                                    }
                                                    else{
                                                        echo "Yearly";
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <td> Audio Calling</td>
                                                <td><?php
                                                    if($data['audio_calling']==0){
                                                        echo "No";
                                                    }
                                                    else{
                                                        echo "Yes";
                                                    }
                                                     ?></td>
                                            </tr>  <tr>
                                                <td>Video Calling </td>
                                                <td><?php
                                                    if($data['video_calling']==0){
                                                        echo "No";
                                                    }
                                                    else{
                                                        echo "Yes";
                                                    }
                                                     ?></td>
                                            </tr>  <tr>
                                                <td>Individual Chat </td>
                                                <td><?php
                                                    if($data['individual_chat']==0){
                                                        echo "No";
                                                    }
                                                    else{
                                                        echo "Yes";
                                                    }

                                                    ?></td>
                                            </tr>  <tr>
                                                <td>Multiple Meeting </td>
                                                <td><?php
                                                    if($data['multiple_meeting']==0){
                                                        echo "No";
                                                    }
                                                    else{
                                                        echo "Yes";
                                                    }
                                                    ?></td>
                                            </tr>  <tr>
                                                <td>Storage</td>
                                                <td><?php echo $data['storage']; ?></td>
                                            </tr>  <tr>
                                                <td>Payment Method </td>
                                                <td><?php echo $data['payment_method']; ?></td>
                                            </tr>  <tr>
                                                <td> Transaction Charge</td>
                                                <td><?php echo $data['transaction_charge']; ?></td>
                                            </tr>  <tr>
                                                <td>Display Status </td>
                                                <td><?php
                                                    if($data['display_status']==0){
                                                        echo "No";
                                                    }
                                                    else{
                                                        echo "Yes";
                                                    }

                                                    ?></td>
                                            </tr>  <tr>
                                                <td>Entry Date </td>
                                                <td><?php echo $data['entry_dt']; ?></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card-collapse -->
                        </div>
                        <!-- /.panel -->
                        <?php   } ?>
                    </div>
                    <!-- /.panel-group -->
                </div>
                <!-- /.widget-body -->
            </div>
            <!-- /.widget-bg -->
        </div>

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