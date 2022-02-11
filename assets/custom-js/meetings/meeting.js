function mySubmitFunction(){
  return false;
}
$("#company_meeting_list").load(location.href + " #company_meeting_list");
$('#meeting_register').on('click',function(){
    var title = $('#title').val();
    var committee_id = $('#committee_id').val();
    var meeting_date = $('#meeting_date').val();
    var meeting_time = $('#meeting_time').val();
    var location = $('#location').val();
    

   // $("#user_list_tbody").load(location.href + " #user_list_tbody");


    if(title != '' && committee_id != '' && meeting_date != '' && meeting_time != '' && location != ''){
        $('#meeting_register').val('saving......');
        $('#meeting_register').attr('disabled', true);
        $.ajax({
            url: "meeting-registration.php",
            method: 'post',
            data: {
                title : title,
                committee_id : committee_id,
                meeting_date : meeting_date,
                meeting_time : meeting_time,
                location : location
            },
            success: function(response){
                $('#meeting_register').val('save');
                $('#meeting_register').attr('disabled', false);
                if(response == true ){
                    $('#meeting-create-modal').modal('hide');
                    $('#title').val('');
                    $('#committee_id').val('');
                    $('#meeting_date').val('');
                    $('#meeting_time').val('');
                    $('#location').val('');
                    $.toast({
                        heading: 'Company Meeting',
                        text: 'Meeting Created Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#company_meeting_list").load(location.href + " #company_meeting_list");
                }else{
                    $.toast({
                        heading: 'Company Committee',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                
            }
        });
    }
});

$('#committee_users').on('change',function(){
    $('#chairman_id').empty();
    var selected_committee_users = $('#committee_users').val();
    $.ajax({
        url: "committee-chairmain.php",
        method: 'post',
        data: {
            selected_committee_users : selected_committee_users
        },
        success:function(response){
           $('#chairman_id').append(response);
        }
    });
});

function meetingDelete(id){
    swal({
        title: 'Are you sure?',
        text: "You want to delete this!",
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
                url: "meeting-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Company Meeting',
                            text: 'Meeting Delete Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#company_meeting_list").load(location.href + " #company_meeting_list");
                    } else {
                        $.toast({
                            heading: 'Company Metting',
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
                'Your data is safe :)',
                'error'
            )
        }
    })
}