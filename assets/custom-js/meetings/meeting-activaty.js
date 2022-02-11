
function meetingPublish(id){
    swal({
        title: 'Are you sure?',
        text: "You want to publish this meeting!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, publish it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(id != ''){
                $.ajax({
                    url: "meeting-publish.php",
                    method: 'post',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Company Meeting',
                                text: 'Meeting Published Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#company_meeting_list").load(location.href + " #company_meeting_list");
                        } else {
                            $.toast({
                                heading: 'Company Meeting',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Your meeting is  not published :)',
                'error'
            )
        }
    })
}


function meetingNotPublish(id){
    swal({
        title: 'Are you sure?',
        text: "You want to not published this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, not published it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(id != ''){
                $.ajax({
                    url: "meeting-not-publish.php",
                    method: 'post',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Company Meeting',
                                text: 'Meeting Not-Published Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#company_meeting_list").load(location.href + " #company_meeting_list");
                        } else {
                            $.toast({
                                heading: 'Company Meeting',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Your meeting is published :)',
                'error'
            )
        }
    })
}


function  meetingClose(id){
    $(".meeting_closed_icon_"+id).html('<i class="list-icon lnr  lnr-sync"></i>');
    $(".meeting_closed_icon_"+id).attr('disabled',true);
    swal({
        title: 'Are you sure?',
        text: "You want to close this meeting!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, close it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(id != ''){
                $.ajax({
                    url: "meeting-close.php",
                    method: 'post',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Company Meeting',
                                text: 'Meeting Close Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#company_meeting_list").load(location.href + " #company_meeting_list");
                            $(".meeting_closed_icon_"+id).html('<i class="list-icon lnr  lnr-lock"></i>');
                            $(".meeting_closed_icon_"+id).attr('disabled',false);
                        } else {
                            $.toast({
                                heading: 'Company Meeting',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Your meeting are active :)',
                'error'
            )
        }
    })
}


// meeting end

function  meetingEnd(id){
    $(".meeting_end_icon_"+id).html('<i class="list-icon lnr  lnr-sync"></i>');
    $(".meeting_end_icon_"+id).attr('disabled',true);
    swal({
        title             : 'Are you sure?',
        text              : "You want to end this meeting!",
        type              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, end it!',
        cancelButtonText  : 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass : 'btn btn-danger',
        buttonsStyling    : false,
        reverseButtons    : true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(id != ''){
                $.ajax({      
                    url   : "meeting-end.php",
                    method: 'post',
                    data  : {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading : 'Company Meeting',
                                text    : 'Meeting End Successfully.',
                                position: 'top-right',
                                icon    : 'success',                     //info, warning, success, and error 
                                stack   : false
                            });
                            $("#company_meeting_list").load(location.href + " #company_meeting_list");
                            $(".meeting_end_icon_"+id).html('<i class="list-icon lnr  lnr-lock"></i>');
                            $(".meeting_end_icon_"+id).attr('disabled',false);
                        } else {
                            $("#company_meeting_list").load(location.href + " #company_meeting_list");
                            $(".meeting_end_icon_"+id).html('<i class="list-icon lnr  lnr-lock"></i>');
                            $(".meeting_end_icon_"+id).attr('disabled',false);
                            $.toast({
                                heading : 'Company Meeting',
                                text    : response,
                                position: 'top-right',
                                icon    : 'error',             //info, warning, success, and error 
                                stack   : false
                            });
                        }
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Your meeting are not end :)',
                'error'
            )
        }
    })
}

