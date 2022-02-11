function mySubmitFunction() {
    return false;
}
jQuery('#submit').on('click', function() {
    var name = jQuery('#name').val();

    // $("#user_list_tbody").load(location.href + " #user_list_tbody");


    if (name != '') {
        $('#submit').val('saving......');
        $('#submit').attr('disabled', true);
        $.ajax({
            url: "memo-registration.php",
            method: 'post',
            data: {
                name: name
            },
            success: function(response) {
                $('#submit').val('save');
                $('#submit').attr('disabled', false);
                if (response == true) {
                    jQuery('#name').val('');
                    $.toast({
                        heading: 'Company Memo',
                        text: 'Memo Created Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#memo_list").load(location.href + " #memo_list");
                } else {
                    $.toast({
                        heading: 'Company Memo',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-company-memo-modal').modal('hide');
            }
        });
    }
});

// Edit Division
// Edit Relative Information
function EditMemo(id) {
    $.ajax({
        url: "memo-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#edit_memo_id').val(data.id);
            $('#edit_memo_name').val(data.name);
        }
    });
}

// update division data
jQuery('#edit_memo_update').on('click', function() {
    var edit_memo_id = jQuery('#edit_memo_id').val();
    var edit_memo_name = jQuery('#edit_memo_name').val();

    if (edit_memo_id != '' && edit_memo_name != '') {
        $('#edit_memo_update').val('updating......');
        $('#edit_memo_update').attr('disabled', true);
        $.ajax({
            url: "memo-update.php",
            method: 'post',
            data: {
                edit_memo_id: edit_memo_id,
                edit_memo_name: edit_memo_name
            },
            success: function(response) {
                $('#edit_memo_update').val('update');
                $('#edit_memo_update').attr('disabled', false);
                if (response == true) {
                    $('#edit-memo').modal('hide');
                    $('#edit_mome_name').val('');
                    $.toast({
                        heading: 'Company Memo',
                        text: 'Memo Update Successfully',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#memo_list").load(location.href + " #memo_list");
                } else {
                    $.toast({
                        heading: 'Company Memo',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-memo').modal('hide');
            }
        });
    }
});


// Divisions Delete
function deleteMemo(id) {
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
                url: "memo-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Company Memo',
                            text: 'Memo Delete Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#memo_list").load(location.href + " #memo_list");
                    } else {
                        $.toast({
                            heading: 'Company Memo',
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