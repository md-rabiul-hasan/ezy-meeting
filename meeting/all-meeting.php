<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->

<?php include '../partial/_header.php';?>


<main class="main-wrapper clearfix" style="">

            <div class="container">
                <div class="widget-list tablelists">
                    <div class="row">
                        <!-- /.widget-holder -->
                        <div class="widget-holder col-md-12 lisingv2">
                            <div class="widget-bg" id="company_meeting_list">
                                <div class="widget-body table-responsive ">
                                    <div class="tabletop">
                                        <div><h5 class="box-title">Meeting List</h5></div>
                                    <p>This table has showing our company all Meeting list .
                                        <div class="buttonright">
                                        <a href="add-meeting.php" class="btn btn-sm btn-success" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span></a>
                                        </div>
                                    </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="boxxarea table-responsive">
                                    <table  class="table   table-bordered table-striped DataTables">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Meeting Name</th>
                                                <th>Date</th>
                                                <th>Meeting Location</th>
                                                <th>Committee</th>
                                                <th>status</th>
                                                <th width="70px">Action</th>
                                                <th width="100px">Setup</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $allMeetingSql = "SELECT meetings.*,meetings.id as meeting_id,committees.name as committee_name,users.name as chairman_name FROM meetings  
                                                inner join committees  on meetings.committee_id=committees.id
                                                left JOIN users on  meetings.chairman_id=users.id WHERE meetings.company_id='$company_id' ORDER by meetings.meeting_date DESC,meetings.is_open ASC";
                                                $allMeetingQuery = mysqli_query($connect,$allMeetingSql);
                                                $sl = 1;
                                                while($allMeetingData = mysqli_fetch_array($allMeetingQuery)){


                                                    $meeting_id=$allMeetingData['meeting_id'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allMeetingData['title']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo  date('jS F, Y', strtotime($allMeetingData['meeting_date']));  ?> 
                                                            <?php echo date('h:i A', strtotime($allMeetingData['meeting_time'])); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allMeetingData['location']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allMeetingData['committee_name']; ?>
                                                        </td>
                                                       
                                                         <td>
                                                            <?php if($allMeetingData['is_open']==1) { ?>
                                                                <span class="btn btn-xs  btn-round btn-primary mb-1" style="padding:1px 6px ; border-radius:16px;">Publish</span>

                                                                <?php
                                                            }else if ($allMeetingData['is_open']==2){
                                                                ?>
                                                                    <span class="btn btn-xs btn-round btn-info mb-1" style="padding:1px 6px ; border-radius:16px;">Complete</span>
                                                                <?php
                                                            }else if ($allMeetingData['is_open']==3){
                                                                ?>
                                                                    <span class="btn btn-xs btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;">End</span>
                                                                <?php
                                                            }else
                                                            {
                                                                ?>
                                                            
                                                                <span class="btn btn-xs btn-round btn-danger mb-1" style="padding:1px 6px ; border-radius:16px;">Not-Publish</span>
                                                            <?php
                                                        }
                                                            ?>
                                                        </td>
                                                        <td style="width: 80px;" >       
                                                            <?php if(isMeetingClose($company_id,$meeting_id)) : ?>
                                                                <button class="btn btn-primary custom" disabled> <i class="fa fa-pencil"></i></button>
                                                            <?php elseif(isMeetingEnd($company_id,$meeting_id)) : ?>
                                                                <button class="btn btn-primary custom" disabled> <i class="fa fa-pencil"></i></button>
                                                            <?php else: ?>
                                                                <a class="btn btn-primary custom" href="meeting-edit.php?id=<?php echo encryptData($meeting_id); ?>"> <i class="fa fa-pencil"></i></a>
                                                            <?php endif; ?>

                                                            <?php if(isMeetingNotPublish($company_id,$meeting_id)) : ?>
                                                                <a class="btn  btn-danger custom" onclick="meetingDelete(<?php echo $meeting_id; ?>)" >  <i class="fa fa-trash-o"></i></a>
                                                            <?php else: ?>
                                                                <button class="btn btn-danger custom" disabled><i class="fa fa-trash-o"></i></button>
                                                            <?php endif; ?>

                                                            
                                                         </td>
                                                        <td style="width: 150px;" >
                                                            <?php if($allMeetingData['is_open']==0) { ?>
                                                                <button data-toggle="tooltip" data-placement="top" title="Meeting Publish" class="btn btn-sm btn-success custom" onclick="meetingPublish(<?php echo $meeting_id; ?>)">
                                                                <i class="text-success list-icon lnr lnr-bullhorn"></i></button>
                                                            <?php } ?>

                                                            <?php if($allMeetingData['is_open']== 1) { ?>
                                                                <button class="btn btn-danger custom" data-toggle="tooltip" data-placement="top" title="Meeting Not Publish" onclick="meetingNotPublish(<?php echo $meeting_id; ?>)">
                                                                    <!-- <i class=" fa fa-times-circle-o"></i> -->
                                                                    <i class="text-danger list-icon lnr lnr-bullhorn"></i>
                                                                </button>
                                                            <?php } ?>
                                                            <!-- Meeting End -->
                                                            <?php if($allMeetingData['is_open'] == 3 ) { ?>
                                                                <button class="btn  btn-info custom meeting_closed_icon_<?php echo $meeting_id; ?>" data-toggle="tooltip" data-placement="top"  title="Meeting Close" onclick="meetingClose(<?php echo $meeting_id; ?>)"><i class="fa fa-lock"></i></button>
                                                            <?php } ?>   

                                                            <?php if($allMeetingData['is_open'] == 1 ) { ?>
                                                                <button class="btn  btn-danger custom meeting_end_icon_<?php echo $meeting_id; ?>" data-toggle="tooltip" data-placement="top"  title="Meeting End" onclick="meetingEnd(<?php echo $meeting_id; ?>)"> <i class="fa fa-power-off"></i> </button>
                                                            <?php } ?>  
                                                            
                                                            <?php if($allMeetingData['is_open']== 2 ) { ?>
                                                                <button class="btn  btn-danger custom" data-toggle="tooltip" data-placement="top" title="Meeting Closed"><i class="list-icon lnr  lnr-lock"></i></button>
                                                            <?php } ?> 
                                                            
                                                            <!-- Meeting Setup  -->
                                                            <a class="btn btn-primary custom" data-toggle="tooltip" data-placement="top" title="Meeting Setup" href="meeting-setup.php?meeting_id=<?php echo $allMeetingData['meeting_unique_id']; ?>" data-toggle="tooltip" data-placement="top" title="Hooray!"><i class="fa fa-cog"></i></a>
                                                        
                                                        
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
                        <img src="../assets/img/meeting-bg.png" alt="">
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


     

<?php include '../partial/_footer.php';?>
<?php
        if(isset($_SESSION['msg'])){
            $message = $_SESSION['msg'];
            if($message == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Company Meeting',
                        text: 'Meeting Created Successfully.',
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
                        heading: 'Company Meeting',
                        text: 'Meeting Created Failed.',
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
    <?php
        if(isset($_SESSION['update_meeting_msg'])){
            $update_meeting_msg = $_SESSION['update_meeting_msg'];
            if($update_meeting_msg == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Company Meeting',
                        text: 'Meeting Updated Successfully.',
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
                        heading: 'Company Meeting',
                        text: 'Meeting Updated Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['update_meeting_msg'] = null;
        }
    ?>

    <?php
        if(isset($_SESSION['update_agenda_msg'])){
            $update_agenda_msg = $_SESSION['update_agenda_msg'];
            if($update_agenda_msg == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Company Meeting',
                        text: 'Agenda(s) From Draft Successfully Added.',
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
                        heading: 'Company Meeting',
                        text: 'Agenda(s) From Draft Failed to Add',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['update_agenda_msg'] = null;
        }
    ?>
    <?php
        if(isset($_SESSION['delete_meeting_msg'])){
            $delete_meeting_msg = $_SESSION['delete_meeting_msg'];
            if($delete_meeting_msg == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Company Meeting',
                        text: 'Meeting Delete Successfully.',
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
                        heading: 'Company Meeting',
                        text: 'Meeting Delete Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['delete_meeting_msg'] = null;
        }
    ?>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/meeting.js"></script>
    <script src="<?php echo $addDot; ?>assets/custom-js/meetings/meeting-activaty.js"></script>
     <script>
        $(document).ready(function() {
            $('.DataTables').DataTable();
        } );

       
    </script>
<style>


</style>
  
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>



