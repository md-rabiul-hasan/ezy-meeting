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

    jQuery.validator.addMethod("accept", function(value, element, param) {
        return value.match(new RegExp("." + param + "$"));
    });

    // Login form validation 
    $("#add-user-document-form").validate({
        rules: {
            user_document_name: {
                required: true,
            },
            user_document_file: {
                required: true,
                extension: "pdf|xls|docx"
            }

        },
        messages: {
            user_document_name: {
                required: 'Please enter user document  name.',
            },
            user_document_file: {
                required: 'Please select user docuemnt',
                extension : 'only pdf | xls | docx file supported'
            }
        }
    });
});


// User experience Information Stored 
$('#user_document_submit').on('click', function() {
    var user_id = jQuery('#user_id').val();
    var user_document_name = $('#user_document_name').val();
    var file_data = $('#user_document_file').prop('files')[0];

    var form_data = new FormData();
    form_data.append('user_id', user_id);
    form_data.append('user_document_name', user_document_name);
    form_data.append('user_document_file', file_data);



    if (user_id != '' && user_document_name != '' && user_document_file != '') {
        $('#user_document_submit').val('saving......');
        $('#user_document_submit').attr('disabled', true);
        $.ajax({
            url: 'user-document/user-document-submit.php', // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                $('#user_document_submit').val('save');
                $('#user_document_submit').attr('disabled', false);
                if (response == true) {
                    $('#add-user-document-modal').modal('hide');
                    $.toast({
                        heading: 'User Document',
                        text: 'User Document Upload Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });

                    $("#user_document_list").load(location.href + " #user_document_list");
                    // $("#add-user-document-form").reset();
                } else {
                    $('#add-user-document-modal').modal('hide');
                    $.toast({
                        heading: 'User Document',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-user-document-modal').modal('hide');
            }
        });
    }
});

// Edit Relative Information
function editUserDocument(id) {
    $.ajax({
        url: "user-document/user-document-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#edit_user_document_id').val(data.id);
            $('#edit_user_document_name').val(data.document_name);
        }

    });
}

// User Document data update
$('#edit_user_document_submit').on('click',function(){
    alert("ok");
});


function deleteUserDocument(id) {
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
                url: "user-document/user-document-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'User Document',
                            text: 'User Document Delete  Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#user_document_list").load(location.href + " #user_document_list");
                    } else {
                        $.toast({
                            heading: 'User Document',
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