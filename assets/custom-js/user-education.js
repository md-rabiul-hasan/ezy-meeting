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
    $("#add-user-education").validate({
        rules: {
            education_institute_name: {
                required: true,
            },
            education_profession_education: {
                required: true,
            }

        },
        messages: {
            education_institute_name: {
                required: 'Please enter education institute name.',
            },
            education_profession_education: {
                required: 'Please enter professional education ',
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


    $("#edit-user-education").validate({
        rules: {
            edit_education_institute_name: {
                required: true,
            },
            edit_education_profession_education: {
                required: true,
            }

        },
        messages: {
            edit_education_institute_name: {
                required: 'Please enter education institute name.',
            },
            edit_education_profession_education: {
                required: 'Please enter professional education ',
            }

        }
    });


});
// form action off
function mySubmitFunction() {
    return false;
}
// User Relative Information Stored 
jQuery('#education_data_store').on('click', function() {
    var education_user_id = jQuery('#education_user_id').val();
    var education_institute_name = jQuery('#education_institute_name').val();
    var education_profession_education = jQuery('#education_profession_education').val();
    var education_seminar_training = jQuery('#education_seminar_training').val();


    if (education_user_id != '' && education_institute_name != '' && education_profession_education != '') {
        $('#education_data_store').val('saving......');
        $('#education_data_store').attr('disabled', true);
        $.ajax({
            url: "user-education/user-education-registration.php",
            method: 'post',
            data: {
                education_user_id: education_user_id,
                education_institute_name: education_institute_name,
                education_profession_education: education_profession_education,
                education_seminar_training: education_seminar_training
            },
            success: function(response) {
                $('#education_data_store').val('save');
                $('#education_data_store').attr('disabled', false);
                if (response == true) {
                    $('#add-user-education-modal').modal('hide');
                    jQuery('#education_institute_name').val('');
                    jQuery('#education_profession_education').val('');
                    jQuery('#education_seminar_training').val('');
                    $.toast({
                        heading: 'User Education Setup',
                        text: 'Education Created  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_education_talble").load(location.href + " #user_education_talble");
                } else {
                    $.toast({
                        heading: 'User Education Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-user-education-modal').modal('hide');
            }
        });
    }
});

// Edit Relative Information
function editEducationInformation(id) {
    $.ajax({
        url: "user-education/user-education-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#edit_user_education_id').val(data.id);
            $('#edit_education_institute_name').val(data.institute_name);
            $('#edit_education_profession_education').val(data.profession_education);
            $('#edit_education_seminar_training').val(data.seminar_training);
        }

    });
}

// update user relative data
jQuery('#update_education_data').on('click', function() {
    var edit_user_education_id = jQuery('#edit_user_education_id').val();
    var edit_education_institute_name = jQuery('#edit_education_institute_name').val();
    var edit_education_profession_education = jQuery('#edit_education_profession_education').val();
    var edit_education_seminar_training = jQuery('#edit_education_seminar_training').val();


    if (edit_user_education_id != '' && edit_education_institute_name != '' && edit_education_profession_education != '') {
        $('#update_education_data').val('updating......');
        $('#update_education_data').attr('disabled', true);
        $.ajax({
            url: "user-education/user-education-data-update.php",
            method: 'post',
            data: {
                edit_user_education_id: edit_user_education_id,
                edit_education_institute_name: edit_education_institute_name,
                edit_education_profession_education: edit_education_profession_education,
                edit_education_seminar_training: edit_education_seminar_training
            },
            success: function(response) {
                $('#update_education_data').val('update');
                $('#update_education_data').attr('disabled', false);
                if (response == true) {
                    $('#edit-user-education-modal').modal('hide');
                    jQuery('#edit_education_institute_name').val('');
                    jQuery('#edit_education_profession_education').val('');
                    jQuery('#edit_education_seminar_training').val('');
                    $.toast({
                        heading: 'User Education Setup',
                        text: 'Education Updated  Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#user_education_talble").load(location.href + " #user_education_talble");
                } else {
                    $.toast({
                        heading: 'User Education Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-user-education-modal').modal('hide');
            }
        });
    }
});


// user relative Delete
function deleteEducationInformation(id) {
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
                url: "user-education/user-education-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'User Education Setup',
                            text: 'Education Delete  Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#user_education_talble").load(location.href + " #user_education_talble");
                    } else {
                        $.toast({
                            heading: 'User Education Setup',
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