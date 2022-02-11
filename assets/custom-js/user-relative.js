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
    $("#add-user-relative").validate({
        rules: {
            relative_name: {
                required: true,
            },
            relation_with_user: {
                required: true,
            }

        },
        messages: {
            relative_name: {
                required: 'Please enter user relative name.',
            },
            relation_with_user: {
                required: 'Please enter relative and user relation',
            }

        }
    });



});

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


    $("#edit-user-relative").validate({
        rules: {
            edit_relative_name: {
                required: true,
            },
            edit_relation_with_user: {
                required: true,
            }

        },
        messages: {
            edit_relative_name: {
                required: 'Please enter user relative name.',
            },
            edit_relation_with_user: {
                required: 'Please enter relative and user relation',
            }

        }
    });


});
// form action off
function mySubmitFunction() {
    return false;
}
// User Relative Information Stored 
jQuery('#relative_data_store').on('click', function() {
    var user_id = jQuery('#user_id').val();
    var relative_name = jQuery('#relative_name').val();
    var relation_with_user = jQuery('#relation_with_user').val();
    var relative_date_of_birth = jQuery('#relative_date_of_birth').val();
    var relative_institute_name = jQuery('#relative_institute_name').val();


    if (relative_name != '' && relation_with_user != '') {
        $('#relative_data_store').val('saving......');
        $('#relative_data_store').attr('disabled', true);
        $.ajax({
            url: "user-relative/user-relative-registration.php",
            method: 'post',
            data: {
                user_id: user_id,
                relative_name: relative_name,
                relation_with_user: relation_with_user,
                relative_date_of_birth: relative_date_of_birth,
                relative_institute_name: relative_institute_name
            },
            success: function(response) {
                $('#relative_data_store').val('save');
                $('#relative_data_store').attr('disabled', false);
                if (response == true) {
                    jQuery('#relative_name').val('');
                    jQuery('#relation_with_user').val('');
                    jQuery('#relative_date_of_birth').val('');
                    jQuery('#relative_institute_name').val('');
                    $.toast({
                        heading: 'User Relative Setup',
                        text: 'Relative Created  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_relative_talble").load(location.href + " #user_relative_talble");
                } else {
                    $.toast({
                        heading: 'User Relative Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-user-relative-modal').modal('hide');
            }
        });
    }
});

// Edit Relative Information
function editRelativeInformation(id) {
    $.ajax({
        url: "user-relative/user-relative-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#update_user_realtive_id').val(data.id);
            $('#edit_relative_name').val(data.name);
            $('#edit_relation_with_user').val(data.relation_with_user);
            $('#edit_relative_date_of_birth').val(data.date_of_birth);
            $('#edit_relative_institute_name').val(data.institute_name);
        }

    });
}

// update user relative data
jQuery('#updaterelative_data_store').on('click', function() {
    var update_user_realtive_id = jQuery('#update_user_realtive_id').val();
    var edit_relative_name = jQuery('#edit_relative_name').val();
    var edit_relation_with_user = jQuery('#edit_relation_with_user').val();
    var edit_relative_date_of_birth = jQuery('#edit_relative_date_of_birth').val();
    var edit_relative_institute_name = jQuery('#edit_relative_institute_name').val();


    if (update_user_realtive_id != '' && edit_relative_name != '' && edit_relation_with_user != '') {
        $('#relative_data_store').val('updating......');
        $('#relative_data_store').attr('disabled', true);
        $.ajax({
            url: "user-relative/user-relative-data-update.php",
            method: 'post',
            data: {
                update_user_realtive_id: update_user_realtive_id,
                edit_relative_name: edit_relative_name,
                edit_relation_with_user: edit_relation_with_user,
                edit_relative_date_of_birth: edit_relative_date_of_birth,
                edit_relative_institute_name: edit_relative_institute_name
            },
            success: function(response) {
                $('#relative_data_store').val('update');
                $('#relative_data_store').attr('disabled', false);
                if (response == true) {
                    jQuery('#edit_relative_name').val('');
                    jQuery('#edit_relation_with_user').val('');
                    jQuery('#edit_relative_date_of_birth').val('');
                    jQuery('#edit_relative_institute_name').val('');
                    $.toast({
                        heading: 'User Relative Setup',
                        text: 'Relative Update  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_relative_talble").load(location.href + " #user_relative_talble");
                } else {
                    $.toast({
                        heading: 'User Relative Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-user-relative-modal').modal('hide');
            }
        });
    }
});


// user relative Delete

function deleteRelativeInformation(id) {
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
                url: "user-relative/user-relative-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'User Relative Setup',
                            text: 'Relative Delete  Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#user_relative_talble").load(location.href + " #user_relative_talble");
                    } else {
                        $.toast({
                            heading: 'User Relative Setup',
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