<!-- Database Connection -->
<?php include '../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
?>
<!-- Authentication Check End -->

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">

            <div class="container">
                <div class="widget-list tablelists">
                    <div class="row">
                        <!-- /.widget-holder -->
                        <div class="widget-holder col-md-12 lisingv2">
                            <div class="widget-bg">
                                <div class="widget-body" id="zoom_list">
                                    <div class="tabletop">
                                        <div>
                                    <h5 class="box-title">Zoom Setup</h5>
                                            </div>
                                    <p> Here is the company video call setup
                                        <?php
                                             $zoomSql = "SELECT * FROM zoom_credential where company_id='$company_id'";
                                             $zoomQuery = mysqli_query($connect,$zoomSql);
                                             $zoomRowCount = mysqli_num_rows($zoomQuery);
                                             if($zoomRowCount < 1){
                                                ?>
                                        <div class="buttonright">
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-company-zoom-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span>
                                                    </button>
                                        </div>
                                                <?php
                                             }
                                        ?>
                                        
                                    </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="boxxarea table-responsive">
                                    <table class="table table-bordered table-striped DataTables" >
                                        <thead>
                                            <tr>
                                                <th>Client ID</th>
                                                <th>Secret Key</th>
                                                <th>Redirect Url</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                               
                                                $sl = 1;
                                                while($zoomData = mysqli_fetch_array($zoomQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $zoomData['client_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $zoomData['client_secret']; ?>
                                                        </td>    
                                                        <td>
                                                            <?php echo $zoomData['redirect_url']; ?>
                                                        </td>                                                      
                                                        <td>
                                                            <button data-toggle="modal" data-target="#edit-zoom" class="btn btn-primary custom" onclick="EditZoom(<?php echo $zoomData['id'] ?>)">
                                                            <i class="fa fa-pencil"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }

                                            ?>  
                                           
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                </div>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                    </div>
                    <div style="background: #fff; width: 100%;">
                        <img src="../../assets/img/meeting-bg.png" alt="">
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


    <!-- Add Modal Added  Start -->
        <!-- Custom Modals -->
        
        <!-- Signup Modal -->
        <div id="add-company-zoom-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-zoom">
                            <div class="form-group">
                                <label for="name">Client ID <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="client_id" name="client_id" required="">
                            </div> 
                            <div class="form-group">
                                <label for="name">Secret Key <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="secret_key" name="secret_key" required="">
                            </div>                                   
                            <div class="form-group">
                                <label for="name">Redirect Url <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="redirect_url" name="redirect_url" required="">
                            </div>   
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="submit" class="btn btn-success" value="save">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    
    <!-- Add Modal Added  End-->


    
<!-- Edit Modal Added  Start -->        
        <!-- Signup Modal -->
        <div id="edit-zoom" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-zoom"> 
                            <input type="hidden" id="edit_zoom_id">         
                            <div class="form-group">
                                <label for="name">Client ID <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="edit_client_id" name="edit_client_id" required >
                            </div> 
                            <div class="form-group">
                                <label for="name">Secret Key <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="edit_secret_key" name="edit_secret_key" required="">
                            </div>                                   
                            <div class="form-group">
                                <label for="name">Redirect Url<span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="edit_redirect_url" name="edit_redirect_url" required="">
                            </div>                                
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="edit_zoom_update" class="btn btn-success" value="update">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    
        <!-- Add Modal Added  End-->

<?php include '../../partial/_footer.php';?>
    <script>
                $(function() {

$.validator.setDefaults({
    errorClass: 'help-block',
    highlight: function(element) {
        $(element)
            .closest('.form-group')
            .addClass('has-error');
    },
    unhighlight: function(element) {
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
    }
});

// Login form validation 
$("#edit-setting").validate({
    rules: {
        edit_agenda_pefix: {
            required: true,
        },
        edit_meeting_signatory_name: {
            required: true,
        },
        edit_meeting_signatory_designation: {
            required: true,
        }

    },
    messages: {
        edit_agenda_pefix: {
            required: 'Please enter agenda pefix.',
        },
        edit_meeting_signatory_name: {
            required: 'Please enter meeting signatory name.',
        },
        edit_meeting_signatory_designation: {
            required: 'Please enter meeting signatory designation.',
        },

    }
});



});

$(function() {

$.validator.setDefaults({
    errorClass: 'help-block',
    highlight: function(element) {
        $(element)
            .closest('.form-group')
            .addClass('has-error');
    },
    unhighlight: function(element) {
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
    }
});

// Login form validation 
$("#add-zoom").validate({
    rules: {
        client_id: {
            required: true,
        },
        secret_key: {
            required: true,
        },
        redirect_url  : {
            required: true,
        }

    },
    messages: {
        client_id: {
            required: 'Please enter your zoom client id',
        },
        serket_key: {
            required: 'Please enter your client secret key.',
        },
        redirect_url: {
            required: 'Please enter your redirect url',
        },

    }
});


});
    </script>
    <script src="<?php echo $addDot; ?>assets/custom-js/settings/zoom.js"></script>   
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>