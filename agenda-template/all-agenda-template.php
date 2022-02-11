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
                <div class="widget-list tablelists"  >
                    <div class="row">
                        <div class="col-md-12 widget-holder lisingv2">
                            <div class="widget-bg">
                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <div class="tabletop">
                                        <div> <h5 class="box-title">Agenda Template</h5></div>

                                        <p> Agenda Template List Show
                                        <div class="buttonright">
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-agenda-template-modal" style="float:right;"><i class="feather  feather-plus"></i><span>Add New</span>
                                            </button>
                                        </div>

                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="boxxarea table-responsive">
                                    <table id="agenda_template_table" class="table table-bordered table-striped DataTables">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Template Name</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                       <?php
                                            $allAgendaTemplateSql = "SELECT * from agenda_templates WHERE company_id='$company_id'";
                                                $allAgendaTemplateQuery = mysqli_query($connect,$allAgendaTemplateSql);
                                                $sl = 1;
                                                while($allAgendaData = mysqli_fetch_array($allAgendaTemplateQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allAgendaData['name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($allAgendaData['type'] == 1){
                                                                    echo "Explanatory";
                                                                }else if($allAgendaData['type'] == 2){
                                                                    echo "Resolved";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <a href="edit-agenda-template.php?id=<?php echo encryptData($allAgendaData['id']); ?>" class="btn btn-primary custom"> <i class="fa fa-pencil"></i> </a>
                                                            </span>  
                                                            <button class="btn btn-danger custom" onclick="deleteAgendaTemplate(<?php echo $allAgendaData['id']; ?>)"><i class="fa fa-trash-o"></i></button>
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
                        <!-- /.widget-holder -->
                    </div>
                    <div style="background: #fff; width: 100%;">
                        <img src="../assets/img/meeting-bg.png" alt="">
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


    <!-- Add Modal Added  Start -->
        <div id="add-agenda-template-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-agenda-template">

                            <div class="form-group">
                                <label for="name">Name <span class="required_sign">**</span> </label>
                                <input class="form-control" type="text" id="name" name="name" required="">
                            </div>

                            <div class="form-group">
                                <label for="name">Description <span class="required_sign">**</span></label>
                                <textarea class="form-control" id="description" name="description" data-toggle="wysiwyg" ></textarea>
                                <span id="description_error"></span>
                            </div>

                            <label for="name">Template Type <span class="required_sign">**</span></label>
                            <div class="form-group"> 
                                <label>
                                    <input type="radio" required name="type"  value="1"> <span class="label-text">Explanatory</span> &nbsp;&nbsp;&nbsp;
                                </label>   
                                <label>
                                    <input type="radio" required name="type"  value="2"> <span class="label-text">Resolved</span>
                                </label>   
                            </div>

                            <div class="text-center mr-b-30">
                                <input type="submit" id="agenda_template_store" class="btn btn-success" value="save">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



    <?php include '../partial/_footer.php';?>
    <?php
        if(isset($_SESSION['msg'])){
            $message = $_SESSION['msg'];
            if($message == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Agenda Template Setup',
                        text: 'Agenda Template Update  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }else{
                ?>
                <script>
                    $.toast({
                        heading: 'Agenda Template Setup',
                        text: 'Agenda Template Update  Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['msg'] = null;
        }
    ?>
    <script>
          // validation 
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
                $("#add-agenda-template").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        description :{
                            required: true,
                        },
                        type: {
                            required: true,
                        },
                        
                    },
                    messages: {
                        name: {
                            required: 'Please write agenda template name.',
                        },
                        description :{
                            required: 'Please enter template description',
                        },
                        type: {
                            required: "Please select template type",
                        }

                    }
                });

            });
    </script>
    <script src="<?php echo $addDot; ?>assets/custom-js/agenda-template/agenda-template.js"></script>   
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>