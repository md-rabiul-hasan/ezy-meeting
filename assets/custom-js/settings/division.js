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
            url: "division-registration.php",
            method: 'post',
            data: {
                name: name
            },
            success: function(response) {
                $('#submit').val('save');
                $('#submit').attr('disabled', false);
                if (response == true) {
                    $('#add-company-division-modal').modal('hide');
                    jQuery('#name').val('');
                    $.toast({
                        heading: 'Company Division',
                        text: 'Division Created Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#division_list").load(location.href + " #division_list");
                } else {
                    $.toast({
                        heading: 'Company Division',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-company-division-modal').modal('hide');
            }
        });
    }
});

// Edit Division
// Edit Relative Information
function EditDivision(id) {
    $.ajax({
        url: "division-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#edit_division_id').val(data.id);
            $('#edit_division_name').val(data.name);
        }
    });
}

// update division data
jQuery('#edit_division_update').on('click', function() {
    var edit_division_id = jQuery('#edit_division_id').val();
    var edit_division_name = jQuery('#edit_division_name').val();


    if (edit_division_name != '' && edit_division_name != '') {
        $('#edit_division_update').val('updating......');
        $('#edit_division_update').attr('disabled', true);
        $.ajax({
            url: "division-update.php",
            method: 'post',
            data: {
                edit_division_id: edit_division_id,
                edit_division_name: edit_division_name
            },
            success: function(response) {
                $('#edit_division_update').val('update');
                $('#edit_division_update').attr('disabled', false);
                if (response == true) {
                    $('#edit-division').modal('hide');
                    $('#edit_division_name').val('');
                    $.toast({
                        heading: 'Company Division',
                        text: 'Division Update Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#division_list").load(location.href + " #division_list");
                } else {
                    $.toast({
                        heading: 'Company Division',
                        text: 'Division Update Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-division').modal('hide');
            }
        });
    }
});


// Divisions Delete
function deleteDivisions(id) {
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
                url: "division-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Company Division',
                            text: 'Division Delete Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#division_list").load(location.href + " #division_list");
                    } else {
                        $.toast({
                            heading: 'Company Division',
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