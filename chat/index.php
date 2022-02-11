<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
    $user_id = $_SESSION['id'];
?>
<!-- Authentication Check End -->

<input type="hidden" id="current_user_id" value="<?php echo $user_id ?>" >
<input type="hidden" id="current_company_id" value="<?php echo $company_id ?>" >

<?php include '../partial/_header.php';?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="assets/css/emoji.css">
<link rel="stylesheet" href="assets/css/style.css">

<main class="main-wrapper clearfix">

            <div class="mb-3"></div>
            <!-- /.page-title -->
            <!-- =================================== -->
            <!-- Different data widgets ============ -->
            <!-- =================================== -->

        <div class="clearf massanger">
        <div class="people-list" id="people-list">
          <div class="search">
            <input type="text" placeholder="search"  id="search-user"/>
            <i class="fa fa-search"></i>
          </div>
          <!-- Here is the user detils show section -->
          <ul class="list" id="user-list-details">
          </ul>
        </div>



        <div class="chat">


        </div> <!-- end chat -->


      </div> <!-- end container -->

            <!-- /.container -->
        </main>



<?php include '../partial/_footer.php';?>
  <script src="assets/js/script.js"></script>
<script>

$(document).ready(function(){
    // jQuery("body").click(function()
    // {
    //     var mydiv = $("#chat_history");
    //     mydiv.scrollTop(mydiv.prop("scrollHeight"));
    // });


    var from_user_id = $('#current_user_id').val();
    var current_company_id = $('#current_company_id').val();
    if(from_user_id != '' && current_company_id != ''){
        $.ajax({
            type: "post",
            url: "fetch_group_chat_history.php",
            data: {
                'from_user_id': from_user_id,
                'current_company_id': current_company_id
            },
            success: function(response) {
                $('.chat').html(response);
            }
        });
    }

});

fetch_user();


// fetch user list with details
function fetch_user() {
    $.ajax({
        url: "fetch_user.php",
        method: "POST",
        success: function(data) {
            $('#user-list-details').html(data);
        }
    })
}

// user search



$(document.body).on('click', '#user-list-details .singleuser', function() {
    var to_user_id = $(this).data("userid");
    var from_user_id = $('#current_user_id').val();
    var current_company_id = $('#current_company_id').val();
    if (to_user_id == "group-chat") {
        $.ajax({
            type: "post",
            url: "fetch_group_chat_history.php",
            data: {
                'from_user_id': from_user_id,
                'current_company_id': current_company_id
            },
            success: function(response) {
                $('.chat').html(response);
                chatScrollHeight();
            }
        });

    } else {
        if (to_user_id != '' && from_user_id != '') {
            $.ajax({
                type: "post",
                url: "fetch_user_message_history.php",
                data: {
                    'to_user_id': to_user_id,
                    'from_user_id': from_user_id,
                    'current_company_id': current_company_id
                },
                success: function(response) {
                    $('.chat').html(response);
                    chatScrollHeight();
                }
            });
        }
    }


});


$(document.body).on('click', '#send-single-message', function() {
    var send_to_user_id = $('#send_to_user_id').val();
    var send_single_message = $('#send_single_message').val();
    if (send_to_user_id != '' && send_single_message != '') {
        $.ajax({
            type: "post",
            url: "single_message_insert.php",
            data: {
                "send_to_user_id": send_to_user_id,
                "send_single_message": send_single_message
            },
            success: function(response) {
                if (response != false) {
                    $('.chat').html(response);
                    chatScrollHeight();
                } else {
                    alert("Message Sent Failed.");
                }
            }

        });
    }

});

$(document.body).on('click', '#send-group-message-submit', function() {
    var send_group_message = $('#send_group_message').val();
    if (send_group_message != '') {
        $.ajax({
            type: "post",
            url: "group_message_insert.php",
            data: {
                "send_group_message": send_group_message
            },
            success: function(response) {
                if (response != false) {
                    $('.chat').html(response);
                    chatScrollHeight();
                } else {
                    alert("Message Sent Failed.");
                }
            }

        });
    }

});



setInterval(function() {
    update_last_activity();
    if(checkSearchValue() == ''){
        fetch_user();
    }

    var current_chat_active_user = $('#chat_history').data("currentactivechatuserid");


    if (Math.floor(current_chat_active_user) == current_chat_active_user && $.isNumeric(current_chat_active_user)) {
        userFetchDate(current_chat_active_user);
    } else if (current_chat_active_user == "group-chat") {
        updateGroupChatMessage("group-chat");
    }


}, 5000);

function checkSearchValue(){
    var search_text = $("#search-user").val();
    return search_text;
}

function userFetchDate(current_chat_active_user) {
    $.ajax({
        type: "post",
        url: "update_user_conversion.php",
        data: {
            "current_chat_active_user": current_chat_active_user
        },
        success: function(response) {
            //$('#chat_history').data(current_chat_active_user).html(response);
            //console.log(response);
            $('#update-chat-history-' + current_chat_active_user).html(response);
            chatScrollHeight();
        }
    });
}

function updateGroupChatMessage(current_chat_active_user) {
    $.ajax({
        type: "post",
        url: "update_group_chate.php",
        data: {
            "current_chat_active_user": current_chat_active_user
        },
        success: function(response) {
            //$('#chat_history').data(current_chat_active_user).html(response);
            //console.log(response);
            $('#update-chat-history-' + current_chat_active_user).html(response);
            chatScrollHeight();
        }
    });
}

function update_last_activity() {
    $.ajax({
        type: "post",
        url: "update_last_activity.php"
    })
}


$(document.body).on('keyup', '#search-user', function() {
    var search_text = $(this).val();
    if(search_text != ''){
        $.ajax({
            type : "post",
            url : "fetch_user.php",
            data : {
                "search_text" : search_text
            },
            success:function(response){
                $('#user-list-details').html(response);
            }
        });
    }else{
        fetch_user();
    }
});

function chatScrollHeight(){
    var mydiv = $("#chat_history");
    mydiv.scrollTop(mydiv.prop("scrollHeight"));
}




</script>

<style>
    #chat_history {
        scrollbar-width: thin;
    }
    .massanger {
        height: calc( 100vh - 100px );
        overflow: hidden;
    }
    .massanger .people-list ul {
        padding: 20px;
        height: 100%;
        overflow-y: scroll;
        scrollbar-width: thin;

    }
    .chat .chat-header{
        padding: 0 20px;
    }
    .chat .chat-history{
        height:  calc( 100% - 190px ) !important;
    }

    }
    .chat .chat-message textarea {
        height: 78px !important;
    }
    .main-wrapper{
        padding: 0 34px 0 !important;
    }
    .chat .chat-history{
        background: #fff;
    }
    .chat .chat-header{
        border: none;
    }
#chat_history{

    overflow-x: hidden;
    overflow-y: auto;

    text-align:left;
}
    #update-chat-history-group-chat{
        overflow: hidden;
        transform: rotate(0deg) !important;
    }
</style>

</body>

</html>