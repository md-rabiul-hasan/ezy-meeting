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

         // company setting info start
         $settingInfoSql   = "SELECT agenda_pefix FROM settings  WHERE company_id='$company_id'";
         $settingInfoQuery = mysqli_query($connect, $settingInfoSql);
         $settingInfoData  = mysqli_fetch_array($settingInfoQuery);
         // company setting info end

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
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Agenda Sorting</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Agenda</li>
                                <li class="breadcrumb-item active">Agenda Sorting</li>
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

                        <div class="col-md-12 widget-holder">
                            <div class="widget-bg">
                                <div class="widget-body p-4">
                                <h5 class="box-title"><?php echo $meetingInfoData['title']; ?> Agenda Sorting </h5>
                                    <p>Agenda List
                                        <a id="saved_agenda_sorting" class="btn btn-sm btn-primary ml-2" style="float:right;"><i class="list-icon lnr  lnr-sync"></i> &nbsp;&nbsp; <span>Agenda Sorting Saved</span></a>
                                        <a href="../../meeting-setup.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-danger" style="float:right;"><i class="list-icon lnr  lnr-undo"></i> &nbsp;&nbsp; <span>Back To Meeting Panel</span></a>
                                    </p>

                                    <ol class="list-group sortable" id="agenda_sorting_list">
                                        <?php 
                                            $agendaSortingSql = "SELECT id,title,agenda_prefix,agenda_sl FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl ";
                                            $agendaSortingQuery = mysqli_query($connect,$agendaSortingSql);
                                            $sl = 1;
                                            while($agendaSortingData = mysqli_fetch_array($agendaSortingQuery)){
                                                ?>
                                                    <input type="hidden" value="<?php echo $settingInfoData['agenda_pefix']; ?>" id="agenda_prefix">
                                                    <li id="<?php echo $agendaSortingData["id"]; ?>" class="list-group-item bg-primary text-inverse d-flex" id="tableList">
                                                        <div style="font-size: 18px;
                                                             <?php

                                                                $title = $agendaSortingData['title']; 

                                                                 if (strlen($title) != strlen(utf8_decode($title))) {
                                                                             echo "font-family:'SutonnyMJ' ";

                                                                            }else {
                                                                               echo "font-family:'sans-sarif' ";
                                                                            }

                                                                 ?>
                                                        " class="mr-auto mr-0-rtl ml-auto-rtl" category="product">
                                                            <i class="list-icon lnr lnr-sort-alpha-asc"></i> &nbsp; 
                                                            <span style="font-family: sans-serif;"><?php echo $settingInfoData['agenda_pefix']; ?> </span>
                                                            <span style="font-family: sans-serif;"><?php echo $sl++; ?></span>
                                                            <br>
                                                            <i class="list-icon lnr lnr-book"></i> &nbsp; <?php echo $title; ?>
                                                        </div>
                                                    </li>
                                                <?php
                                            }
                                        ?>
                                        
                                    </ol>
                                    <!-- /.list-group -->
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


<?php include '../../../partial/_footer.php';?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/vendors/jquery.nestable.js"></script>
    <script>
        $(document).ready(function(){
            $( "#agenda_sorting_list" ).sortable({
                update  : function(event, ui)
                {
                    $('#agenda_sorting_list span').each(function (i) {
                        var humanNum = i + 1;
                        $(this).html(humanNum + '');
                    });
                }
            });
        });

        (function($){
            $(document).ready(function(){
                
                // update sorting agenda
                $('#saved_agenda_sorting').on('click',function(){
                    var agenda_prefix = $('#agenda_prefix').val();
                    var agenda_id_array = new Array();
                    $('#agenda_sorting_list li').each(function(){
                        agenda_id_array.push($(this).attr("id"));                        
                    });
                    $.ajax({
                        url: 'agenda-sorting-saved.php',// point to server-side PHP script 
                        type: 'post',
                        data: {
                            'agenda_id_array' : agenda_id_array,
                            'agenda_prefix' : agenda_prefix
                        },    
                        success:function(response){
                            if(response == true){
                                $.toast({
                                    heading: 'Agenda Sorting',
                                    text: 'Agenda Sorting Sucessfully.',
                                    position: 'top-right',
                                    icon: 'success', //info, warning, success, and error 
                                    stack: false
                                });
                                $("#agenda_sorting_list").load(location.href + " #agenda_sorting_list");
                            }else{
                                $.toast({
                                    heading: 'Agenda Sorting',
                                    text: response,
                                    position: 'top-right',
                                    icon: 'error', //info, warning, success, and error 
                                    stack: false
                                });
                            }
                        }                     
                        
                    });
                })
                
            });

        })(jQuery);       
       
 
    </script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/agenda/agenda.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>