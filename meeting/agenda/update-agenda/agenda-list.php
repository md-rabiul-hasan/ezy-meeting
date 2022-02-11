<!-- Database Connection -->
<?php include '../../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->
<?php
    if (isset($_GET['meeting_id'])) {
        $meeting_unique_id = $_GET['meeting_id'];
        $meetingInfoSql    = "SELECT id,title FROM meetings where meeting_unique_id='$meeting_unique_id' ";
        $meetingInfoQuery  = mysqli_query($connect, $meetingInfoSql);
        $meetingInfoData   = mysqli_fetch_array($meetingInfoQuery);
        $meeting_id        = $meetingInfoData['id'];

    }
?>

<?php include '../../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5"><?php echo $meetingInfoData['title']; ?></h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Add Agenda</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Add Agenda</li>
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
                        <!-- /.widget-holder -->
                        <div class="widget-holder col-md-12">
                            <div class="widget-bg">
                                <div class="widget-body">
                                <h5 class="box-title"><?php echo $meetingInfoData['title']; ?> </h5>
                                    <p>Agenda List
                                        
                                        
                                        <a href="../agenda-sorting/agenda-sorting.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-success ml-2" style="float:right;"><i class="list-icon lnr  lnr-line-spacing"></i> &nbsp;&nbsp; <span>Agenda Sorting</span></a>
                                        &nbsp;&nbsp;                                        
                                        <a href="../add-agenda.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-success ml-2" style="float:right;"><i class="list-icon lnr  lnr-plus-circle"></i> &nbsp;&nbsp; <span>Add Agenda</span></a>
                                        &nbsp;&nbsp;
                                        <a href="../../meeting-setup.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-danger" style="float:right;"><i class="list-icon lnr  lnr-undo"></i> &nbsp;&nbsp; <span>Back To Meeting Panel</span></a>
                                    </p>
                                    <table id="agenda_list" class="table table-bordered table-striped DataTables">
                                        <thead>
                                            <tr>
                                                <th>Agenda No</th>
                                                <th>Subject</th>
                                                <th>Memo</th>
                                                <th>Division</th>
                                                <th>Decision</th>
                                                <th>Agenda Minute</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $agendaInfoSql = "SELECT agendas.*,agendas.id as agenda_id,memos.name as memo_name,divisions.name as division_name FROM agendas
                                                inner join memos on agendas.memo_id=memos.id
                                                INNER JOIN divisions on agendas.division_id = divisions.id
                                                WHERE agendas.meeting_id='$meeting_id' and agendas.company_id='$company_id'";                                                

                                                $agendaInfoQuery = mysqli_query($connect, $agendaInfoSql);
                                                while($agendaInfoData  = mysqli_fetch_array($agendaInfoQuery)){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $agendaInfoData['agenda_prefix'].$agendaInfoData['agenda_sl'] ?></td>

                                                             

                                                            <td style="
                                                                <?php

                                                                 $title = $agendaInfoData['title']; 

                                                                 if (strlen($title) != strlen(utf8_decode($title))) {
                                                                             echo "font-family:'SutonnyMJ' ";

                                                                            }else {
                                                                               echo "font-family:'sans-sarif' ";
                                                                            }

                                                                 ?>
                                                            " class="title_show" >

                                                            <?php echo $title; ?>
                                                                 
                                                             </td>

                                                            <td><?php echo $agendaInfoData['memo_name']; ?></td>
                                                            <td><?php echo $agendaInfoData['division_name']; ?></td>
                                                            <td></td>
                                                            <td>
                                                                <?php if($agendaInfoData['minute_file'] != ''){ ?>
                                                                    <a class="btn btn-sm btn-primary" href="<?php echo $addDot.$agendaInfoData['minute_file']; ?>" download>
                                                                        <i class="list-icon lnr lnr-download"></i>  
                                                                    </a>
                                                                    &nbsp;&nbsp;
                                                                <?php } ?>
                                                                <span>
                                                                    <button class="btn btn-sm btn-info" onclick="agendaMinuteUpload(<?php echo $agendaInfoData['agenda_id'] ?>)"> <i class="list-icon lnr lnr-upload"></i></button>
                                                                </span>

                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <a class="btn btn-sm btn-primary" href="edit-agenda.php?meeting_id=<?php echo $meeting_unique_id; ?>&agenda_id=<?php echo encryptData($agendaInfoData['agenda_id']); ?>  "><i class="list-icon lnr lnr-pencil"></i></a>
                                                                </span>
                                                                <span>
                                                                    <button class="btn btn-sm btn-danger" onclick="deleteAgenda(<?php echo $agendaInfoData['agenda_id'] ?>)"><i class="list-icon lnr lnr-trash"></i></button>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>

        <!-- Agenda Minute Upload Modal Start -->
        <div id="agenda-minute-upload-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="modal-body">
                            <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                            </div>
                            <form onsubmit="return mySubmitFunction(event)" id="agenda-minute-upload-form" enctype="multipart/form-data">
                                <input type="hidden" id="meeting_id" value="<?php echo $meeting_id; ?>">
                                <div class="form-group">
                                    <label for="name">Agenda Minute Upload <span class="required_sign">**</span></label>
                                    <input type="file" class="form-control" name="minute_file" id="minute_file" required>
                                </div>
                                <div class="text-center mr-b-30">
                                    <input type="submit" id="upload_agenda_minute_file_sumbit" class="btn btn-success" value="save">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- /.modal -->
        <!-- Agenda Minute Upload Modal End -->



<?php include '../../../partial/_footer.php';?>
<?php
    if(isset($_SESSION['agenda_minute_file_upload_message'])){
        $agenda_minute_file_upload_message = $_SESSION['agenda_minute_file_upload_message'];
            if($agenda_minute_file_upload_message == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Agenda Minute Upload',
                        text: 'Agenda Minute Upload Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
        }
        $_SESSION['agenda_minute_file_upload_message'] = null;
    }
?>
   
    <script>
        $(document).ready(function() {
            $('.DataTables').DataTable();
        } );
        
        // agenda minute file upload validation start
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

            jQuery.validator.addMethod("accept", function(value, element, param) {
                return value.match(new RegExp("." + param + "$"));
            });

            // Login form validation 
            $("#agenda-minute-upload-form").validate({
                rules: {
                    minute_file : {
                        required : true,
                        extension: "docx"
                    }
                },
                messages: {
                    minute_file : {
                        required : 'Please select and upload agenda minute',
                        extension: "Only Docx file supported" 
                    }


                }
            });

        });
        // agenda minute file upload validation start

        
        function mySubmitFunction(){
        return false;
        }

        // Agenda Minute Upload By Ajax Modal  Start 
        function agendaMinuteUpload(id){

            $('#agenda-minute-upload-modal').modal('show');

            $('#upload_agenda_minute_file_sumbit').on('click',function(){
                var agenda_id = id;
                var meeting_id = $('#meeting_id').val();
                var file_data = $('#minute_file').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('agenda_id', agenda_id);                           
                form_data.append('meeting_id', meeting_id);                           
                form_data.append('minute_file', file_data);  
                if(file_data != undefined){
                    $.ajax({
                        url: 'agenda-minute-upload.php',// point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function(response){
                            if(response == true){
                                $('#agenda-minute-upload-modal').modal('hide');
                                $.toast({
                                    heading: 'Agenda Minute Upload',
                                    text: 'Agenda Minute Upload Successfully.',
                                    position: 'top-right',
                                    icon: 'success', //info, warning, success, and error 
                                    stack: false
                                });
                                
                                $("#agenda-minute-upload-form").reset();
                                //$("#agenda_list").load(location.href + " #agenda_list");
                                //$("#agenda-minute-upload-modal").load(location.href + " #agenda-minute-upload-modal");
                            }else{
                                $('#agenda-minute-upload-modal').modal('hide');
                                $.toast({
                                    heading: 'Agenda Minute Upload',
                                    text: response,
                                    position: 'top-right',
                                    icon: 'error', //info, warning, success, and error 
                                    stack: false
                                });
                                
                                //$("#agenda-minute-upload-modal").load(location.href + " #agenda-minute-upload-modal");
                            }
                        }
                    });
                }                         
               
            })
     

        }
        // Agenda Minute Upload By Ajax Modal  End 

        function deleteAgenda(id){
        swal({
            title: 'Are you sure?',
            text: "You want to delete this agenda!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $.ajax({
                    url: "delete-agenda.php",
                    method: 'post',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Meeting Agenda',
                                text: 'Agenda Delete Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#agenda_list").load(location.href + " #agenda_list");
                        } else {
                            $.toast({
                                heading: 'Meeting Agenda',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your agenda is safe :)',
                    'error'
                )
            }
        })
    }





    </script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/agenda/agenda.js"></script>
    <!-- default Script For Every Pages End -->
    

<?php
    if (isset($_SESSION['ageda_added_message'])) {
        $ageda_added_message = $_SESSION['ageda_added_message'];
        if ($ageda_added_message == true) {
        ?>
        <script>
            $.toast({
                heading: 'Agenda Setup',
                text: 'Agenda Added  Successfully.',
                position: 'top-right',
                icon: 'success', //info, warning, success, and error
                stack: false
            });
        </script>
    <?php
        } else {
            ?>
        <script>
            $.toast({
                heading: 'Agenda Setup',
                text: 'Agenda Added Failed.',
                position: 'top-right',
                icon: 'error', //info, warning, success, and error
                stack: false
            });
        </script>
    <?php
        }
            $_SESSION['ageda_added_message'] = null;
        }
    ?>
<?php
    if (isset($_SESSION['ageda_updated_message'])) {
        $ageda_updated_message = $_SESSION['ageda_updated_message'];
        if ($ageda_updated_message == true) {
        ?>
        <script>
            $.toast({
                heading: 'Agenda Update',
                text: 'Agenda Update  Successfully.',
                position: 'top-right',
                icon: 'success', //info, warning, success, and error
                stack: false
            });
        </script>
    <?php
        } else {
            ?>
        <script>
            $.toast({
                heading: 'Agenda Update',
                text: 'Agenda Update Failed.',
                position: 'top-right',
                icon: 'error', //info, warning, success, and error
                stack: false
            });
        </script>
    <?php
        }
            $_SESSION['ageda_updated_message'] = null;
        }
    ?>



</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>
