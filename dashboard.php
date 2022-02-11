<?php
include 'database_connection.php';

?>

<!-- Authentication Check Start -->

<?php

if ( !isset( $_SESSION['id'] ) ) {

    echo "<script>window.location='login/login.php'</script>";
    exit;

}
?>

<!-- Authentication Check End -->

<?php include 'partial/_header.php';?>
        <!-- /.site-sidebar -->
        <main class="main-wrapper clearfix" style="background: #dadbdc">

            <div class="container">
                <div class="widget-list" style="  background: #005ba7;overflow:hidden; border-radius: 0px 10px 10px 0;margin-top:30px">
                    <!-- Events List -->
                    <div class="col-md-8 " style="padding: 0;float: left">
                        <div class="widget-holder widget-full-content">
                       <div class="first">
                           <div class="second">
                               <div class="third">
                                   <div class="calenderarea">
                                       <div class=" fullcalendar" id="fullcalendar-1" data-toggle="fullcalendar"></div>
                                   </div>

                               </div>
                           </div>
                       </div>
                        </div>
                    </div>

                    <div class="col-md-4" style="padding: 0;float: right" id="selected_date_info">
                        
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>

    </div>

</div>

<input type="hidden" id="today" value="<?php echo date('Y-m-d'); ?>">
<!--/ #wrapper -->
<?php if(isset($_SESSION['login_message']) && $_SESSION['login_message'] != null) : ?>
    <input type="hidden" name="login_message" id="login_message" value="<?php echo $_SESSION['login_message']; ?> ">
<?php endif; ?>

<!-- Scripts -->
<style>
    .calenderarea{

        overflow: hidden;
        padding: 30px;
    }
    .widget-holder.widget-full-content{
        background: #fff;
        min-height: 0px !important;
        margin: -1px;
    }

</style>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
<script src="assets/js/jquery.toast.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<!--<script src="assets/js/template.js"></script>-->
<script src="assets/js/custom.js"></script>

<script>

$(document).ready(function(){
    var today = $('#today').val();
    getMeetingInfo("today");
});


$('body').on('click','.fc-prev-button',function(e){  
    checkCalanderMonthMeetingList();
});

$('body').on('click','.fc-next-button',function(e){  
    checkCalanderMonthMeetingList();
});



function checkMeetingExist(meetingListArray,meeting_date) {
    return (meetingListArray.indexOf(meeting_date) != -1);
}

function  getMonthYear() {
    var getMonthYear =$(".fc-center h2").text();
    return getMonthYear;
}

function checkCalanderMonthMeetingList(){    
    var monthYear = getMonthYear();
    if(monthYear != ''){
        $.ajax({
            type : "post",
            url : "calander_meeting_list.php",
            data : {
                "monthYear" : monthYear
            },
            success:function(response){
                $( ".fc-day-top" ).each(function( index ) {
                    var check_date =  $(this).attr("data-date"); 
                    if(checkMeetingExist(response,check_date) == true){
                        $(this).addClass("exist");
                    }
                });
            }
        });
    }
    
}



$(document).ready(function() {
    var calendar = $('#fullcalendar-1').fullCalendar({
        editable: true,
        header: {
            left:'',
            center:'prev,next,title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: 'event.php',
        selectable: true,
        selectHelper:  false,

        editable: true,
            eventClick: function(event) {            
        },       
    });
    checkCalanderMonthMeetingList();
});

$('body').on('click','.fc-day-top',function(e){    
    var selected_date =  $(this).attr("data-date");
    $(".fc-day-number").removeClass('marked');
    $("span", this).addClass('marked');
    if(selected_date != ''){
        getMeetingInfo(selected_date);
    }
});



// alert(         $('#fullcalendar-1').fullCalendar().getDate());

function getMeetingInfo(date){
    $.ajax({
        type : "post",
        url :"search_meeting_by_date.php",
        data : {
            "meeting_date" : date
        },
        success:function(response){
            $('#selected_date_info').html(response);
        }
    });
}

</script>
  <?php
        if(isset($_SESSION['msg'])){
            $message = $_SESSION['msg'];
            if(!empty($message)){
            ?>
                <script>
                    console.log('<?php print $message;?>');
                     $.notify({
                            message: '<?php print $message;?>',
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'danger'
                        });;
                </script>
            <?php
            }
                ?>
                
            <?php
            
            $_SESSION['msg'] = null;
        }
    ?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

    });


    $(".menu-item-has-children .main").click(function(){
        $('.collapse').removeClass("in");
        $(this).parent().toggleClass("active");
        $('.active .collapse').addClass("in");
        //if ( $("selector").hasClass("someClass") ) {   /*EXISTS (has class) */  }
    });
    $(".ripple").click(function(){
        $(".site-sidebar").toggleClass("scrollbar-enabled");
        $('body').attr('data-sidebar-state', $('body').attr('data-sidebar-state') == 'expand' ? 'collapse' : 'expand')
        //$("body").attr("data-sidebar-state", 'collapse'); // yes it worked!
    });

    var login_success_message = $('#login_message').val();
    if(login_success_message != null){
        $.toast({
            heading: 'Login',
            text: login_success_message,
            position: 'top-right',
            icon: 'success', //info, warning, success, and error 
            stack: false
        }); 
    }

</script>
<style>
    .template-switcher{
        display: none;
    }

</style>
<?php 
    if(isset($_SESSION['login_message']) && $_SESSION['login_message'] != null){
        unset($_SESSION['login_message']);
    }

?>

</body>
</html>