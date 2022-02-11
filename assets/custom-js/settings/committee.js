
$('#quorum').on('change',function(){
    var quorum = jQuery('#quorum').val();
    var committee_users = jQuery('#committee_users').val();
    var total_selected_user = committee_users.filter(val=>val != '').length;
    if( quorum > total_selected_user ){
        $('#quorum_error').html('<label id="name-error" class="help-block" for="name">You will give maximum quorum in '+total_selected_user+'</label>');      
    }else{
        $('#quorum_error').html('');
    }
});

jQuery('#submit').on('click',function(){
    var name = jQuery('#name').val();
    var description = jQuery('#description').val();
    var prefix = jQuery('#prefix').val();
    var quorum = jQuery('#quorum').val();
    var current_index = jQuery('#current_index').val();
    var committee_users = jQuery('#committee_users').val();
    var chairman_id = $('#chairman_id').val();


    var total_selected_user = committee_users.filter(val=>val != '').length;
    if( quorum > total_selected_user ){
        $('#quorum_error').html('<label id="name-error" class="help-block" for="name">You will give maximum quorum in '+total_selected_user+'</label>');
         return false;
    }else{
        $('#quorum_error').html('');
    }


    if(name != ''  && quorum != '' && committee_users != '' && chairman_id != ''){
        $('#submit').val('saving......');
        $('#submit').attr('disabled', true);
        $.ajax({
            url: "committee-registration.php",
            method: 'post',
            data: {
                name : name,
                description : description,
                prefix : prefix,
                quorum : quorum,
                current_index : current_index,
                committee_users : committee_users,
                chairman_id : chairman_id
            },
            success: function(response){
                $('#submit').val('save');
                $('#submit').attr('disabled', false);
                if(response == true ){
                    jQuery('#name').val('');
                    jQuery('#description').val('');
                    jQuery('#prefix').val('');
                    jQuery('#quorum').val('');
                    jQuery('#current_index').val('');
                    $("chairman_id select").val("");
                    $("committee_users select").val("");
                    $.toast({
                        heading: 'Company Committee',
                        text: 'Committee Created Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#company_committee_list").load(location.href + " #company_committee_list");
                }else{
                    $.toast({
                        heading: 'Company Committee',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#committee-create-modal').modal('hide');
            }
        });
    }
});



// delete committee 

function deleteCommittee(id) {
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
            // ajax code here
            $.ajax({
                url: "committee-delete.php",
                method: 'post',
                data: {
                    id : id
                },
                success:function(response){
                    if(response == true){                      
                        $.toast({
                            heading: 'Company Committee',
                            text: 'Committee Deleted Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#company_committee_list").load(location.href + " #company_committee_list");
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



