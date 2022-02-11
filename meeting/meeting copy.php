<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id    = $_SESSION['id'];
?>
<!-- Authentication Check End -->
<?php
    if (isset($_GET['id'])) {
        $meeting_id = $_GET['id'];
        $meetingInfoSql    = "SELECT id,title,meeting_unique_id,chairman_id,is_open,meeting_date FROM meetings where id='$meeting_id' ";
        $meetingInfoQuery  = mysqli_query($connect, $meetingInfoSql);
        $meetingInfoData   = mysqli_fetch_array($meetingInfoQuery);
        $meeting_id        = $meetingInfoData['id'];
        $meeting_unique_id = $meetingInfoData['meeting_unique_id'];
        $chairman_id       = $meetingInfoData['chairman_id'];
        $is_open_meeting   = $meetingInfoData['is_open'];
        $meeting_date      = $meetingInfoData['meeting_date'];
        $meeting_date      = $meetingInfoData['meeting_date'];
    }
    if(isset($_GET['agenda_id']))
    {
        $agendaQ=" and id=".$_GET['agenda_id'];
        $agendaID=$_GET['agenda_id'];
    }
    else{
        $agendaQ=NULL;
        $agendaID=NULL;
    }


    $q_check_att=mysqli_query($connect,"SELECT is_open FROM attendances WHERE company_id='$company_id' AND meeting_id='$meeting_id'");
$d_check_att=mysqli_fetch_array($q_check_att);
$is_open_att=$d_check_att['is_open'];
?>

<?php include '../partial/_header.php';?>
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
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Settings</li>
                                <li class="breadcrumb-item active">Meetings</li>
                                
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
                                        <?php 
                                        if(!empty($is_open_att))
                                        {
                                        	if(date("Y-m-d")<=$meeting_date)
                                            {                                    		


                                            ?>
                                            <a href="#" class="btn btn-sm btn-success att_member" style="float:right;">
                                                <input type="hidden" name="company_id_att" id="company_id_att" value="<?php print $company_id;?>">
                                                <input type="hidden" name="meeting_id_att" id="meeting_id_att" value="<?php print $meeting_id;?>">
                                                <input type="hidden" name="member_id_att" id="member_id_att" value="<?php print $user_id?>">
                                    
                                            &nbsp;&nbsp; <span>Attendance</span>
                                        </a>
                                        <?php
                                        }
                                    }
                                    ?>
                                    </h5>
                                    <div class="tabs tabs-bordered">
                                        <ul class="nav nav-tabs">
                                            <?php
                                                $meetingAgendaSql = "SELECT id,agenda_prefix,agenda_sl,meeting_id FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' ORDER BY agenda_sl";
                                                $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);
                                                $defaultActiveSlNavigation = 0;
                                                while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
                                                    $defaultActiveSlNavigation++;
                                                    $agendaId=$meetingAgendaData['id'];
                                                    $agendaMeeting_id=$meetingAgendaData['meeting_id'];
                                                    ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?php if(isset($agendaID)){ if($agendaID==  $agendaId) print 'active ';} ?>" href="#<?php echo $meetingAgendaData['id']; ?>" data-toggle="tab" aria-expanded="true" onclick="activeAgenda(<?php print $agendaId;?>,<?php print $agendaMeeting_id;?>)"><?php echo $meetingAgendaData['agenda_prefix'].$meetingAgendaData['agenda_sl'] ?></a>
                                                         </li>
                                                    <?php
                                                }
                                            ?>

                                            

                                        </ul>
                                        <!-- /.nav-tabs -->
                                        <div class="tab-content">
                                            <?php
                                                $meetingAgendaSql = "SELECT * FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' $agendaQ ORDER BY agenda_sl";
                                                $meetingAgendaQuery = mysqli_query($connect,$meetingAgendaSql);
                                                $defaultActiveSl = 0;
                                                while($meetingAgendaData = mysqli_fetch_array($meetingAgendaQuery)){
                                                    $defaultActiveSl++;
                                                    $agenda_sl=$meetingAgendaData['agenda_sl'];
                                                    $agenda=$meetingAgendaData['id'];

                                                    ?>
                                                        <div class="tab-pane <?php echo ($defaultActiveSl == 1)? 'active' : ''; ?>" id="<?php echo $meetingAgendaData['id']; ?>" >
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

                                                                
                                                                    <?php
                                                           if($is_open_meeting==1)
                                                           {
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                Final Decision

                                                                            </div>
                                                                            
                                                                            <div class="card-body font-weight-bold ">
                                                                                <div class="form-group">
                                                                                     <div class="radios">
											                                        	<?php 
											                                        	
											                                        	$q_check=mysqli_query($connect,"SELECT vote_option_id FROM votes WHERE company_id='$company_id' and meeting_id='$meeting_id' and agenda_id='$agenda' and user_id='$user_id'");
                                                                                        $q_check_chairman=mysqli_query($connect,"SELECT vote_option_id FROM votes WHERE company_id='$company_id' and meeting_id='$meeting_id' and agenda_id='$agenda' and user_id='$chairman_id'");
                                                                                        $chairman_voted=mysqli_num_rows($q_check_chairman);
											                                        	$d_check=mysqli_fetch_array($q_check);
											                                        	$voted=$d_check['vote_option_id'];

											                                        	$q_vote=mysqli_query($connect,"SELECT * FROM vote_options Where company_id='$company_id'");
											                                        	while($d_vote=mysqli_fetch_array($q_vote))
											                                        	{
											                                        		$vote_id=$d_vote['id'];
											                                        		$vote_name=$d_vote['name'];

											                                                ?>
											                                        		<div class="radiobox">
											                                                    <label>
											                                                        <input type="radio" name="radio1Option_<?php print $agenda;?>" value="<?php print $vote_id;?>" <?php if($vote_id==$voted) print 'checked="checked";'?>> <span
											                                                                class="label-text"><?php print $vote_name;?></span>
											                                                    </label>
											                                                </div>
											                                                <?php 
											                                            }

											                                                ?>
											                                                <input type="hidden" name="meeting_id" id="meeting_id" value="<?php print $meeting_id;?>">
											                                                <input type="hidden" name="company_id" id="company_id" value="<?php print $company_id;?>">
											                                                <input type="hidden" name="agenda_id" id="agenda_id" value="<?php print $agenda;?>">
											                                                <input type="hidden" name="user_id" id="user_id" value="<?php print $user_id;?>">
											                                               
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
                                                                            <!-- <div class="card-header  bg-primary">
                                                                                Resolved
                                                                            </div> -->
                                                                            <div class="card-body font-weight-bold ">
                                                                                <!-- <div class="row">
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
                                                                                </div> -->

                                                                                <div class="form-group" id="resolved_description_div<?php echo $meetingAgendaData['id'];  ?>">
                                                                                    <label for="emailaddress">Remarks</label>
                                                                                    <textarea class="form-control" required id="remarks_<?php print $agenda;?>" name="remarks" data-toggle="wysiwyg" >
                                                                                        
                                                                                    </textarea>
                                                                                </div>
                                                                                
                                                                                <div class="form-group">
                                                                                	<?php
                                                                                	 $prev_agenda=$agenda_sl-1;
                                                                                	
                                                                                	$agenda_previous=mysqli_query($connect, "SELECT id FROM agendas WHERE company_id='$company_id' and meeting_id='$meeting_id' and agenda_sl='$prev_agenda'");

                                                                                	$agenda_previous_d=mysqli_fetch_array($agenda_previous);
                                                                                	
                                                                                	if($agenda_sl>1)
                                                                                		$agenda_previous_id=$agenda_previous_d['id'];
                                                                                	else
                                                                                		$agenda_previous_id=$agenda;
                                                                                	$q_agend_dec=mysqli_query($connect,"SELECT * FROM  votes  WHERE company_id='$company_id' and meeting_id='$meeting_id' and agenda_id='$agenda_previous_id' and user_id='$chairman_id'");
                                                                                	
                                                                                	//if chairman then show vote. if member and agenda is 1st show vote. if member and agenda is not 1st the check if the previous agenda has a deceision 
                                                                                	
                                                                                	if($agenda_sl==1 or (mysqli_num_rows($q_agend_dec)>0) or $chairman_id==$user_id )
                                                                                	{
                                                                                		if(date("Y-m-d")<=$meeting_date and $chairman_voted==0)
                                                                                		{
                                                                                		
                                                                                	?>
                                                                                    <input type="submit" value="Vote" class="btn  btn-primary" id="agendaVote" onclick="addVote('<?php print $meeting_id;?>','<?php print $company_id;?>','<?php print $agenda;?>','<?php print $user_id;?>')">

                                                                                    <?php 
                                                                                    	}
                                                                               		 }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 

                                                                <?php
                                                            }
                                                                ?>

                                                            </div>
                                                            <?php
                                                        if($user_id==$chairman_id)
                                                        {

                                                        	$color=['secondary','primary','success','danger','warning','info','dark'];

                                                            ?>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-header  bg-primary">
                                                                                Member Dicision
                                                                            </div>

                                                                            <div class="card-body font-weight-bold">
                                                                                 <div class="col-md-6 mr-b-50">
										                                           
										                                            
										                                            <!-- /.progress -->
										                                            
										                                            <!-- /.progress -->
										                                           
										                                            <!-- /.progress -->
										                                          
										                                            <!-- /.progress -->
										                                             <?php
										                                        	$q_vote_num=mysqli_query($connect,"SELECT count(vt.id) as vote_count,vto.name as optname FROM `votes` vt left join vote_options vto on vt.vote_option_id=vto.id WHERE vt.company_id='$company_id' and vt.meeting_id='$meeting_id' and vt.agenda_id='$agenda' group by vote_option_id ORDER by count(vt.id) DESC");
										                                        	$q_total=mysqli_query($connect,"SELECT * FROM votes where company_id='$company_id' and meeting_id='$meeting_id' and agenda_id='$agenda'");
										                                        	$total_vote=mysqli_num_rows($q_total);
										                                        	$sl=0;
										                                        	while($d_vote_num=mysqli_fetch_array($q_vote_num))
										                                        	{
										                                        		$vote=$d_vote_num['vote_count'];
										                                        		 $per=ceil(($vote/$total_vote)*100);

										                                            ?>
										                                            <?php print $d_vote_num['optname'];?><div class="progress progress-md">
										                                                <div class="progress-bar bg-<?php print $color[$sl]?>" style="width: <?php print $per;?>%" role="progressbar"></div><?php print $per?>%
										                                            </div>
										                                            <?php
										                                            $sl++;
										                                       			 }
										                                            ?>
										                                            <!-- /.progres -->
										                                        </div>                                                                           
                                                                            </div>
                                                                            <a href="agenda/agenda-sorting -chairman/agenda-sorting.php?meeting_id=<?php print $meeting_unique_id  ?>" class="btn btn-sm btn-success att_member" ><span>Sort Agenda</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                            ?>
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



<?php include '../partial/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/bootstrap-notify.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script>
       




function addVote(meeting_id,company_id,agenda_id,user_id)
{
            
      	var voteID=$('input[name="radio1Option_'+agenda_id+'"]:checked').val();
        
        var remarks = jQuery('#remarks_'+agenda_id).val();
        
        
        console.log(voteID+"---"+meeting_id+"---"+company_id+"---"+agenda_id+"---"+user_id+"---"+remarks)
       // $("#user_list_tbody").load(location.href + " #user_list_tbody");
        if(voteID != '' && meeting_id != '' && company_id != '' && agenda_id != '' && user_id != ''){
            $.ajax({
                url: "agendaVote.php",
                method: 'post',
                data: {
                    voteID : voteID,
                    meeting_id : meeting_id,
                    company_id : company_id,
                    agenda_id : agenda_id,
                    user_id : user_id,
                    remarks:remarks
                    
                },
                success: function(response){
                    console.log(response);
                    var a=response.split(':');

                    if(a[0] == '1' ){
                        
                        $.notify({
                            message: a[1],
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'success'
                        });
                       
                      
                       
                    }else{
                        $.notify({
                            message: a[1],
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'danger'
                        });
                        
                    }

                   
                    
                }
            });
        }
   
 }



  $(document).ready(function() {
    $('.att_member').click(function() {

          
	        var company_id_att = jQuery('#company_id_att').val();
	        var meeting_id_att = jQuery('#meeting_id_att').val();
	        var member_id_att = jQuery('#member_id_att').val();
	       
	         $.ajax({
                url: "attend.php",
                method: 'post',
                data: {
                    company_id_att : company_id_att,
                    meeting_id_att : meeting_id_att,
                    member_id_att : member_id_att
                    
                    
                },
                success: function(response){
                    console.log(response);
                    var a=response.split(':');

                    if(a[0] == '1' ){
                        $.toast({
                            heading: 'Meeting Attendance',
                            text: a[1],
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });                       
                       
                    }else{
                        $.toast({
                            heading: 'Meeting Attendance',
                            text: a[1],
                            position: 'top-right',
                            icon: 'error', //info, warning, success, and error 
                            stack: false
                        });                         
                    }

                   
                    
                }
            });

        
    });
});
  function activeAgenda(agendaid,meetingid)
  {
    window.location.href = "meeting.php?id="+meetingid+"&agenda_id="+agendaid;
  }
    </script>
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>