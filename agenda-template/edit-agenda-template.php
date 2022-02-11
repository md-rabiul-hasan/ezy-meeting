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
                                    <h5>Edit Agenda Template</h5>                                  
                                    
                                </div>

                                <?php
                                    $templateId  = decryptData(filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING));
                                    $agendaTemplateSql = "SELECT * FROM agenda_templates WHERE id='$templateId' ";
                                    $agendaTemplateQuery = mysqli_query($connect,$agendaTemplateSql);
                                    $agendaTemplateData = mysqli_fetch_array($agendaTemplateQuery);

                                ?>

                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <form id="edit-agenda-template" action="agenda-template-update.php?id=<?php echo $agendaTemplateData['id'] ?>" method="POST">

                                        <div class="form-group">
                                            <label for="name">Name <span class="required_sign">**</span></label>
                                            <input class="form-control" type="text" id="name" name="name" value="<?php echo $agendaTemplateData['name']; ?>" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Description <span class="required_sign">**</span></label>
                                            <textarea class="form-control" required id="description" name="description" data-toggle="wysiwyg" > <?php echo $agendaTemplateData['description']; ?> </textarea>
                                        </div>

                                        <label for="name">Template Type <span class="required_sign">**</span></label>
                                        <div class="form-group"> 
                                            <label>
                                                <input type="radio" required name="type" value="1" <?php if($agendaTemplateData['type'] == 1){ echo "checked"; } ?> > <span class="label-text">Explanatory</span> &nbsp;&nbsp;&nbsp;
                                            </label>   
                                            <label>
                                                <input type="radio" required name="type"  value="2" <?php if($agendaTemplateData['type'] == 2){ echo "checked"; } ?> > <span class="label-text">Resolved</span> &nbsp;&nbsp;&nbsp;
                                            </label> 
                                            </label>   
                                        </div>

                                        <div class="text-center mr-b-30">
                                            <input type="submit"  class="btn btn-success" value="update">
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
$("#edit-agenda-template").validate({
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