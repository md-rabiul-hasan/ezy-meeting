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
            <!-- Page Title Area -->

            <div class="container">
                <div class="widget-list tablelists">
                    <div class="row">
                        <div class="widget-holder col-md-12 lisingv2">
                            <div class="widget-bg">
                                <div class="widget-body table-responsive ">
                                    <div>
                                        <h5 class="box-title">Company Division List</h5>
                                    </div>
                                    <p>This table has showing company all divions .
                                    <div class="buttonright">
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-company-division-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span>
                                        </button>
                                    </div>
                                    </p>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="boxxarea table-responsive">
                                    <table class="table  table-striped DataTables" id="division_list">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Entry User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $allDivisionSql = "SELECT divisions.id as division_id,divisions.name as division_name,users.name as username FROM divisions 
                                                inner join users on divisions.entry_user_id=users.id WHERE divisions.company_id='$company_id'";
                                                $allDivisionQuery = mysqli_query($connect,$allDivisionSql);
                                                $sl = 1;
                                                while($allDivisionData = mysqli_fetch_array($allDivisionQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allDivisionData['division_name']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allDivisionData['username']; ?>
                                                        </td>                                                        
                                                        <td>
                                                        <button data-toggle="modal" data-target="#edit-division" class="btn btn-primary custom" onclick="EditDivision(<?php echo $allDivisionData['division_id'] ?>)"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-danger custom" onclick="deleteDivisions(<?php echo $allDivisionData['division_id'] ?>)"><i class="fa fa-trash-o"></i></button>
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
                <div id="add-company-division-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">
                                <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                                </div>
                                <form onsubmit="return mySubmitFunction(event)" id="add-division">
                                    <div class="form-group">
                                        <label for="name">Division Name <span class="required_sign">**</span></label>
                                        <input class="form-control" type="text" id="name" name="name" required="" >
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
                <div id="edit-division" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">
                                <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                                </div>
                                <form onsubmit="return mySubmitFunction(event)" id="edit-division">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_division_id">
                                        <label for="name">Division Name <span class="required_sign">**</span></label>
                                        <input class="form-control" type="text" name="edit_division_name" id="edit_division_name" required="">
                                    </div>                                 
                                   
                                    <div class="text-center mr-b-30">
                                        <input type="submit" id="edit_division_update" class="btn btn-success" value="update">
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
        $(document).ready(function() {
            $('.DataTables').DataTable();
        } );
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
            $("#add-division").validate({
                rules: {
                    name: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: 'Please enter division name.',
                    }

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
            $("#edit-division").validate({
                rules: {
                    edit_division_name: {
                        required: true,
                    }

                },
                messages: {
                    edit_division_name: {
                        required: 'Please enter division name.',
                    }

                }
            });
        });      

    </script>

    
    <script src="<?php echo $addDot; ?>assets/custom-js/settings/division.js"></script>  
  
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>