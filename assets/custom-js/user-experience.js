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
    $("#add-user-experience").validate({
        rules: {
            experience_institute_name: {
                required: true,
            },
            experience_appointment_date: {
                required: true,
            },
            experience_designation: {
                required: true,
            },
            experience_responsibilities: {
                required: true,
            }

        },
        messages: {
            experience_institute_name: {
                required: 'Please enter institute name.',
            },
            experience_appointment_date: {
                required: 'Please select appointment date',
            },
            experience_designation: {
                required: 'Please enter designation.',
            },
            experience_responsibilities: {
                required: 'Please enter responsibilities',
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


    $("#edit-user-experience").validate({
        rules: {
            edit_experience_institute_name: {
                required: true,
            },
            edit_experience_appointment_date: {
                required: true,
            },
            edit_experience_designation: {
                required: true,
            },
            edit_experience_responsibilities: {
                required: true,
            }

        },
        messages: {
            edit_experience_institute_name: {
                required: 'Please enter institute name.',
            },
            edit_experience_appointment_date: {
                required: 'Please select appointment date',
            },
            edit_experience_designation: {
                required: 'Please enter designation.',
            },
            edit_experience_responsibilities: {
                required: 'Please enter responsibilities',
            }

        }
    });


});


// form action off
function mySubmitFunction() {
    return false;
}
// User experience Information Stored 
jQuery('#experience_data_store').on('click', function() {
    var user_id = jQuery('#user_id').val();
    var experience_institute_name = jQuery('#experience_institute_name').val();
    var experience_appointment_date = jQuery('#experience_appointment_date').val();
    var experience_designation = jQuery('#experience_designation').val();
    var experience_responsibilities = jQuery('#experience_responsibilities').val();


    if (experience_institute_name != '' && experience_appointment_date != '' && experience_designation != '' && experience_institute_name != '') {
        $('#experience_data_store').val('saving......');
        $('#experience_data_store').attr('disabled', true);
        $.ajax({
            url: "user-experience/user-experience-add.php",
            method: 'post',
            data: {
                user_id: user_id,
                experience_institute_name: experience_institute_name,
                experience_appointment_date: experience_appointment_date,
                experience_designation: experience_designation,
                experience_responsibilities: experience_responsibilities
            },
            success: function(response) {
                $('#experience_data_store').val('save');
                $('#experience_data_store').attr('disabled', false);
                if (response == true) {
                    $('#add-user-experience-modal').modal('hide');
                    jQuery('#experience_institute_name').val('');
                    jQuery('#experience_appointment_date').val('');
                    jQuery('#experience_designation').val('');
                    jQuery('#experience_responsibilities').val('');
                    $.toast({
                        heading: 'User Experience Setup',
                        text: 'Experience Created  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_exparience_table").load(location.href + " #user_exparience_table");
                } else {
                    $.toast({
                        heading: 'User Experience Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-user-experience-modal').modal('hide');
            }
        });
    }
});

// Edit experience Information
function editExperienceInformation(id) {
    $.ajax({
        url: "user-experience/user-experience-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#update_user_experience_id').val(data.id);
            $('#edit_experience_institute_name').val(data.institute_name);
            $('#edit_experience_appointment_date').val(data.appointment_date);
            $('#edit_experience_designation').val(data.designation);
            $('#edit_experience_responsibilities').val(data.responsibilities);
        }

    });
}

// update user experience data
jQuery('#update_experience_data_store').on('click', function() {
    var update_user_experience_id = jQuery('#update_user_experience_id').val();
    var edit_experience_institute_name = jQuery('#edit_experience_institute_name').val();
    var edit_experience_appointment_date = jQuery('#edit_experience_appointment_date').val();
    var edit_experience_designation = jQuery('#edit_experience_designation').val();
    var edit_experience_responsibilities = jQuery('#edit_experience_responsibilities').val();

    if (update_user_experience_id != '' && edit_experience_institute_name != '' && edit_experience_appointment_date != '' && edit_experience_designation != '' && edit_experience_responsibilities != '') {
        $('#update_experience_data_store').val('updating......');
        $('#update_experience_data_store').attr('disabled', true);
        $.ajax({
            url: "user-experience/user-experience-data-update.php",
            method: 'post',
            data: {
                update_user_experience_id: update_user_experience_id,
                edit_experience_institute_name: edit_experience_institute_name,
                edit_experience_appointment_date: edit_experience_appointment_date,
                edit_experience_designation: edit_experience_designation,
                edit_experience_responsibilities: edit_experience_responsibilities
            },
            success: function(response) {
                $('#update_experience_data_store').val('update');
                $('#update_experience_data_store').attr('disabled', false);
                if (response == true) {
                    $('#edit-user-experience-modal').modal('hide');
                    jQuery('#edit_experience_institute_name').val('');
                    jQuery('#edit_experience_appointment_date').val('');
                    jQuery('#edit_experience_designation').val('');
                    jQuery('#edit_experience_responsibilities').val('');
                    $.toast({
                        heading: 'User Experience Setup',
                        text: 'Experience Update  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_exparience_table").load(location.href + " #user_exparience_table");
                } else {
                    $.toast({
                        heading: 'User Experience Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-user-experience-modal').modal('hide');
            }
        });
    }
});


// user experience Delete
function deleteExperienceInformation(id) {
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
                url: "user-experience/user-experience-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'User Experience Setup',
                            text: 'Experience Delete  Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#user_exparience_table").load(location.href + " #user_exparience_table");
                    } else {
                        $.toast({
                            heading: 'User Experience Setup',
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