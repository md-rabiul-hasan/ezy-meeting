function mySubmitFunction() {
    return false;
}

// Settings Create
jQuery('#submit').on('click', function() {
    var client_id = $('#client_id').val();
    var secret_key = $('#secret_key').val();
    var redirect_url = $('#redirect_url').val();

    if (client_id != '' && secret_key != '' && redirect_url != '') {
        $('#submit').val('saving......');
        $('#submit').attr('disabled', true);
        $.ajax({
            url: "zoom-registration.php",
            method: 'post',
            data: {
                "client_id": client_id,
                "secret_key": secret_key,
                "redirect_url": redirect_url
            },
            success: function(response) {
                $('#submit').val('save');
                $('#submit').attr('disabled', false);
                if (response == true) {
                    $('#add-company-zoom-modal').modal('hide');
                    $.toast({
                        heading: 'Company Zoom',
                        text: 'Zoom Setup Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#zoom_list").load(location.href + " #zoom_list");
                } else {
                    $.toast({
                        heading: 'Company Zoom',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-company-zoom-modal').modal('hide');
            }
        });
    }
});

// Edit Settings
function EditZoom(id) {
    $.ajax({
        url: "zoom-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#edit_zoom_id').val(data.id);
            $('#edit_client_id').val(data.client_id);
            $('#edit_secret_key').val(data.client_secret);
            $('#edit_redirect_url').val(data.redirect_url);
        }
    });
}

// Update Settings
jQuery('#edit_zoom_update').on('click', function() {
    var edit_zoom_id = $('#edit_zoom_id').val();
    var edit_client_id = $('#edit_client_id').val();
    var edit_secret_key = $('#edit_secret_key').val();
    var edit_redirect_url = $('#edit_redirect_url').val();

    if (edit_zoom_id != '' && edit_client_id != '' && edit_secret_key != '' && edit_redirect_url != '') {
        $('#edit_zoom_update').val('updating......');
        $('#edit_zoom_update').attr('disabled', true);
        $.ajax({
            url: "zoom-update.php",
            method: 'post',
            data: {
                "edit_zoom_id": edit_zoom_id,
                "edit_client_id": edit_client_id,
                "edit_secret_key": edit_secret_key,
                "edit_redirect_url": edit_redirect_url,
            },
            success: function(response) {
                $('#edit_zoom_update').val('update');
                $('#edit_zoom_update').attr('disabled', false);
                if (response == true) {
                    $('#zoom-setting').modal('hide');
                    $('#edit_mome_name').val('');
                    $.toast({
                        heading: 'Zoom Update',
                        text: 'Zoom Update Successfully',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#zoom_list").load(location.href + " #zoom_list");
                } else {
                    $.toast({
                        heading: 'Zoom Update',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-zoom').modal('hide');
            }
        });
    }
});