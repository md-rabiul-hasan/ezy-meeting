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
    $("#add-user-share-form").validate({
        rules: {
            own_share: {
                required: true,
            },

        },
        messages: {
            own_share: {
                required: 'Please write user share.',
            }

        }
    });



});

// form action off
function mySubmitFunction() {
    return false;
}
// User Relative Information Stored 
jQuery('#user_share_holder_submit').on('click', function() {
    var user_id = jQuery('#user_id').val();
    var family_share = jQuery('#family_share').val();
    var own_share = jQuery('#own_share').val();


    if (own_share != '' && user_id != '') {
        $('#user_share_holder_submit').val('saving......');
        $('#user_share_holder_submit').attr('disabled', true);
        $.ajax({
            url: "user-share/user-share-save.php",
            method: 'post',
            data: {
                user_id: user_id,
                family_share: family_share,
                own_share: own_share
            },
            success: function(response) {
                $('#user_share_holder_submit').val('save');
                $('#relativeuser_share_holder_submit_data_store').attr('disabled', false);
                if (response == true) {                    
                    $.toast({
                        heading: 'User Share Setup',
                        text: 'Share Setup Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_share_table").load(location.href + " #user_share_table");
                } else {
                    $.toast({
                        heading: 'User Share Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-share-holder-modal').modal('hide');
            }
        });
    }
});

// Edit Relative Information
function editUserShareModal(id) {
    $.ajax({
        url: "user-share/user-share-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#update_user_share_id').val(data.user_id);
            $('#edit_family_share').val(data.family_share);
            $('#edit_own_share').val(data.own_share);
        }

    });
}

// update user relative data
jQuery('#user_share_holder_update').on('click', function() {
    var update_user_share_id = jQuery('#update_user_share_id').val();
    var edit_family_share = jQuery('#edit_family_share').val();
    var edit_own_share = jQuery('#edit_own_share').val();


    if (update_user_share_id != '' && edit_own_share != '') {
        $('#user_share_holder_update').val('updating......');
        $('#user_share_holder_update').attr('disabled', true);
        $.ajax({
            url: "user-share/user-share-data-update.php",
            method: 'post',
            data: {
                update_user_share_id: update_user_share_id,
                edit_family_share: edit_family_share,
                edit_own_share: edit_own_share
            },
            success: function(response) {
                $('#user_share_holder_update').val('update');
                $('#user_share_holder_update').attr('disabled', false);
                if (response == true) {
                    jQuery('#edit_family_share').val('');
                    jQuery('#edit_own_share').val('');
                    $.toast({
                        heading: 'User Share Update',
                        text: 'Share Update  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_share_table").load(location.href + " #user_share_table");
                } else {
                    $.toast({
                        heading: 'User Share Update',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-user-share-modal').modal('hide');
            }
        });
    }
});


// user relative Delete

function deleteShare(user_id) {
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
                url: "user-share/user-share-delete.php",
                method: 'post',
                data: {
                    user_id: user_id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'User Share Delete',
                            text: 'Relative Delete  Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#user_share_table").load(location.href + " #user_share_table");
                    } else {
                        $.toast({
                            heading: 'User Share Delete',
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