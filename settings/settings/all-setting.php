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
                                <div class="widget-body" id="setting_list">
                                    <div class="tabletop">
                                   <div> <h5 class="box-title">Company Settings</h5></div>

                                    <p> Here is the Company Settings
                                        <?php
                                             $settingsSql = "SELECT * FROM settings where company_id='$company_id'";
                                             $settingsQuery = mysqli_query($connect,$settingsSql);
                                             $settingRowCount = mysqli_num_rows($settingsQuery);
                                             if($settingRowCount < 1){
                                                ?>
                                        <div class="buttonright">
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-company-setting-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span>
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
                                                <th>Agenda Pefix</th>
                                                <th>Meeting Notice Signatory Name</th>
                                                <th>Meeting Notice Signatory Designation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                               
                                                $sl = 1;
                                                while($settingsData = mysqli_fetch_array($settingsQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $settingsData['agenda_pefix']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $settingsData['meeting_signatory_name']; ?>
                                                        </td>    
                                                        <td>
                                                            <?php echo $settingsData['meeting_signatory_designation']; ?>
                                                        </td>                                                      
                                                        <td>
                                                            <button data-toggle="modal" data-target="#edit-setting" class="btn custom btn-primary btn-sm" onclick="EditSetting(<?php echo $settingsData['id'] ?>)">
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
        <div id="add-company-setting-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-setting">
                            <div class="form-group">
                                <label for="name">Agenda Prefix <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="agenda_pefix" name="agenda_pefix" required="">
                            </div> 
                            <div class="form-group">
                                <label for="name">Meeting Notice Signatory Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="meeting_signatory_name" name="meeting_signatory_name" required="">
                            </div>                                   
                            <div class="form-group">
                                <label for="name">Meeting Notice Signatory Designation <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="meeting_signatory_designation" name="meeting_signatory_designation" required="">
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
        <div id="edit-setting" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="edit-setting"> 
                            <input type="hidden" id="edit_setting_id">         
                            <div class="form-group">
                                <label for="name">Agenda Prefix <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="edit_agenda_pefix" name="edit_agenda_pefix" required >
                            </div> 
                            <div class="form-group">
                                <label for="name">Meeting Notice Signatory Name <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="edit_meeting_signatory_name" name="edit_meeting_signatory_name" required="">
                            </div>                                   
                            <div class="form-group">
                                <label for="name">Meeting Notice Signatory Designation <span class="required_sign">**</span></label>
                                <input class="form-control" type="text" id="edit_meeting_signatory_designation" name="edit_meeting_signatory_designation" required="">
                            </div>                                
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="edit_setting_update" class="btn btn-success" value="update">
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
$("#add-setting").validate({
    rules: {
        agenda_pefix: {
            required: true,
        },
        meeting_signatory_name: {
            required: true,
        },
        meeting_signatory_designation: {
            required: true,
        }

    },
    messages: {
        agenda_pefix: {
            required: 'Please enter agenda pefix.',
        },
        meeting_signatory_name: {
            required: 'Please enter meeting signatory name.',
        },
        meeting_signatory_designation: {
            required: 'Please enter meeting signatory designation.',
        },

    }
});


});
    </script>
    <script src="<?php echo $addDot; ?>assets/custom-js/settings/setting.js"></script>   
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>