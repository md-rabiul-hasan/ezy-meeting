function mySubmitFunction() {
    return false;
}

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
    $("#meeting-generate-radio-form").validate({
        rules: {
            minute_generate_type: {
                required: true,
            }
        },
        messages: {
            minute_generate_type: {
                required: 'Please select  meeting  minute generate type'
            }


        }
    });


});


// action work start 
$('#generate_meeting_minute_file').on('click',function(){
    var minute_generate_type  = $("input[name='minute_generate_type']:checked").val();
    var meeting_id = $('#meeting_id').val();
    if (typeof minute_generate_type != "undefined") {
       if(minute_generate_type == 1){ // file merge
        $('#meeting-generate-modal').modal('hide');
        swal({
            title: 'Are you sure?',
            text: "You want to generate minute download  link",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate link!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                // ajax code here
                if (meeting_id != '') {
                    $.ajax({
                        url: "minute-generate/minute-generate.php",
                        method: 'post',
                        data: {
                            meeting_id: meeting_id,
                        },
                        success: function(response) {
                            $.toast({
                                heading: 'Meeting Minute Generate',
                                text: response,
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error
                                stack: false
                            });
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

       }else{  // content merge
        $('#meeting-generate-modal').modal('hide');
        swal({
            title: 'Are you sure?',
            text: "You want to generate minute download  link",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, generate link!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                // ajax code here
                if (meeting_id != '') {
                    $.ajax({
                        url: "minute-generate/content_merge_minute_generate.php",
                        method: 'post',
                        data: {
                            meeting_id: meeting_id,
                        },
                        success: function(response) {
                            if(response != false){
                                $.toast({
                                    heading: 'Meeting Minute Generate',
                                    text: response,
                                    position: 'top-right',
                                    icon: 'success', //info, warning, success, and error
                                    stack: false
                                });
                            }else{
                                $.toast({
                                    heading: 'Meeting Minute Generate',
                                    text: "Minute Generate Failed",
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

    }

});

    