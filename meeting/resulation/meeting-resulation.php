<!-- Database Connection -->
<?php include '../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->
<?php
    if (isset($_GET['meeting_id'])) {
        $meeting_unique_id = $_GET['meeting_id'];
        $meetingInfoSql    = "SELECT id,title,meeting_unique_id FROM meetings where meeting_unique_id='$meeting_unique_id' ";
        $meetingInfoQuery  = mysqli_query($connect, $meetingInfoSql);
        $meetingInfoData   = mysqli_fetch_array($meetingInfoQuery);
        $meeting_id        = $meetingInfoData['id'];
        $meeting_unique_id        = $meetingInfoData['meeting_unique_id'];
    }
?>

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5"><?php echo $meetingInfoData['title']; ?></h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">Meeting Resulation</p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                <li class="breadcrumb-item active">Resulation</li>
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
                                    <h5 class="box-title">
                                        <?php echo $meetingInfoData['title']; ?>
                                        <a href="../meeting-setup.php?meeting_id=<?php echo $meeting_unique_id; ?>" class="btn btn-sm btn-danger" style="float:right;">
                                        <i class="list-icon lnr  lnr-undo"></i> &nbsp;&nbsp; <span>Back To Meeting Panel</span></a>
                                    </h5>
                                    <div class="tabs tabs-bordered">
                                        <ul class="nav nav-tabs">
                                            <?php
                                                $meetingAgendaSql = "SELECT id,agenda_prefix,agenda_sl FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl";
                                                $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);
                                                $defaultActiveSlNavigation = 0;
                                                while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
                                                    $defaultActiveSlNavigation++;
                                                    ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?php echo ($defaultActiveSlNavigation == 1)? 'active' : ''; ?>" href="#<?php echo $meetingAgendaData['id']; ?>" data-toggle="tab" aria-expanded="true"><?php echo $meetingAgendaData['agenda_prefix'].$meetingAgendaData['agenda_sl'] ?></a>
                                                        </li>
                                                    <?php
                                                }
                                            ?>

                                            

                                        </ul>
                                        <!-- /.nav-tabs -->
                                        <div class="tab-content">
                                            <?php
                                                $meetingAgendaSql = "SELECT * FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl";
                                                $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);
                                                $defaultActiveSl = 0;
                                                while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
                                                    $defaultActiveSl++;
                                                    ?>
                                                        <div class="tab-pane <?php echo ($defaultActiveSl == 1)? 'active' : ''; ?>" id="<?php echo $meetingAgendaData['id']; ?>">
                                                        <div class="row">
                                                            <div class="col-md-8">

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                <?php echo $meetingAgendaData['title']; ?>
                                                                            </div>
                                                                            <div class="card-body font-weight-bold ">
                                                                                <span><i class="list-icon lnr lnr-user"></i> <?php echo $meetingAgendaData['client']; ?> </span> 
                                                                                /
                                                                                <span> <i class="list-icon lnr lnr-layers"></i> <?php echo number_format($meetingAgendaData['amount'],2); ?> </span>                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                Explanatory
                                                                            </div>
                                                                            <div class="card-body font-weight-bold ">
                                                                                <?php
                                                                                    echo $meetingAgendaData['explanatory_description'];
                                                                                ?>                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                Final Disitions
                                                                            </div>
                                                                            <div class="card-body font-weight-bold ">
                                                                                <div class="form-group">
                                                                                    <div class="radiobox">
                                                                                        <label>
                                                                                            <input type="radio" name="radio1Option" value="1" > <span class="label-text">Decline</span>
                                                                                        </label>
                                                                                        <label>
                                                                                            <input type="radio" name="radio1Option" value="2" > <span class="label-text">Approved</span>
                                                                                        </label>
                                                                                        <label>
                                                                                            <input type="radio" name="radio1Option" value="3"> <span class="label-text">Note Of Decent</span>
                                                                                        </label>
                                                                                        <label>
                                                                                            <input type="radio" name="radio1Option" value="4"> <span class="label-text">Defer</span>
                                                                                        </label>
                                                                                        <label>
                                                                                            <input type="radio" name="radio1Option" value="5"> <span class="label-text">Note Comments</span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>                                                                     
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                Resolved
                                                                            </div>
                                                                            <div class="card-body font-weight-bold ">
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-12">
                                                                                    <label class="form-control-label">Resolved</label><br>
                                                                                        <label class="form-control-label">Select Agenda Templates (Resolved)</label>
                                                                                        <select class="m-b-10 form-control" onchange="resolveTemplate(<?php echo $meetingAgendaData['id'];  ?>)"  name="resolved_template_id" id="resolved_template_id<?php echo $meetingAgendaData['id'];  ?>" data-toggle="select2" data-plugin-options='{"minimumResultsForSearch": -1}'>
                                                                                            <optgroup label="Template List">
                                                                                                <option value="">Select Agenda Template</option>
                                                                                                <?php
                                                                                                    $templateSql   = "SELECT id,name FROM agenda_templates WHERE company_id='$company_id' and type=2";
                                                                                                    $templateQuery = mysqli_query($connect, $templateSql);
                                                                                                    while ($templateData = mysqli_fetch_array($templateQuery)) {
                                                                                                    ?>
                                                                                                            <option value="<?php echo $templateData['id']; ?>"><?php echo $templateData['name']; ?></option>
                                                                                                        <?php
                                                                                                            }
                                                                                                        ?>
                                                                                            </optgroup>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group" id="resolved_description_div<?php echo $meetingAgendaData['id'];  ?>">
                                                                                    <label for="emailaddress">Resolve Description</label>
                                                                                    <textarea class="form-control" required id="resolved_description" name="resolved_description" data-toggle="wysiwyg" >
                                                                                        
                                                                                    </textarea>
                                                                                </div>
                                                                                
                                                                                <div class="form-group">
                                                                                    <input type="submit" value="Save" class="btn  btn-primary">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                Member Dicision
                                                                            </div>
                                                                            <div class="card-body font-weight-bold">
                                                                                <h6>Total Vote  : 0</h6>                                                                             
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- /.tabs -->
                                   
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



<?php include '../../partial/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
    <script>
        function resolveTemplate(id){
            var resolved_template_id = $("#resolved_template_id"+id).val();
            if(resolved_template_id != ''){
                $.ajax({
                    url: '../agenda/search-resolved.php',// point to server-side PHP script 
                    type: 'post',
                    data : {
                        'resolved_template_id' : resolved_template_id
                    },
                    success:function(response){
                        $('#resolved_description_div'+id+' iframe').contents().find('.wysihtml5-editor').html(response);
                    }
                });
            }
            
        }
    </script>
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>