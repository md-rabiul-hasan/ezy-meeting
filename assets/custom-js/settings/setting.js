function mySubmitFunction() {
    return false;
}

// Settings Create
jQuery('#submit').on('click', function() {
    var agenda_pefix = $('#agenda_pefix').val();
    var meeting_signatory_name = $('#meeting_signatory_name').val();
    var meeting_signatory_designation = $('#meeting_signatory_designation').val();

    if (agenda_pefix != '' && meeting_signatory_name != '' && meeting_signatory_designation != '') {
        $('#submit').val('saving......');
        $('#submit').attr('disabled', true);
        $.ajax({
            url: "setting-registration.php",
            method: 'post',
            data: {
                agenda_pefix: agenda_pefix,
                meeting_signatory_name: meeting_signatory_name,
                meeting_signatory_designation: meeting_signatory_designation
            },
            success: function(response) {
                $('#submit').val('save');
                $('#submit').attr('disabled', false);
                if (response == true) {
                    $('#add-company-setting-modal').modal('hide');
                    jQuery('#name').val('');
                    $.toast({
                        heading: 'Company Setting',
                        text: 'Settings Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#setting_list").load(location.href + " #setting_list");
                } else {
                    $.toast({
                        heading: 'Company Settings',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-company-setting-modal').modal('hide');
            }
        });
    }
});

// Edit Settings
function EditSetting(id) {
    $.ajax({
        url: "setting-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $('#edit_setting_id').val(data.id);
            $('#edit_agenda_pefix').val(data.agenda_pefix);
            $('#edit_meeting_signatory_name').val(data.meeting_signatory_name);
            $('#edit_meeting_signatory_designation').val(data.meeting_signatory_designation);
        }
    });
}

// Update Settings
jQuery('#edit_setting_update').on('click', function() {
    var edit_setting_id = $('#edit_setting_id').val();
    var edit_agenda_pefix = $('#edit_agenda_pefix').val();
    var edit_meeting_signatory_name = $('#edit_meeting_signatory_name').val();
    var edit_meeting_signatory_designation = $('#edit_meeting_signatory_designation').val();

    if (edit_setting_id != '' && edit_agenda_pefix != '' && edit_meeting_signatory_name != '' && edit_meeting_signatory_designation != '') {
        $('#edit_setting_update').val('updating......');
        $('#edit_setting_update').attr('disabled', true);
        $.ajax({
            url: "setting-update.php",
            method: 'post',
            data: {
                edit_setting_id: edit_setting_id,
                edit_agenda_pefix: edit_agenda_pefix,
                edit_meeting_signatory_name: edit_meeting_signatory_name,
                edit_meeting_signatory_designation: edit_meeting_signatory_designation,
            },
            success: function(response) {
                $('#edit_setting_update').val('update');
                $('#edit_setting_update').attr('disabled', false);
                if (response == true) {
                    $('#edit-setting').modal('hide');
                    $('#edit_mome_name').val('');
                    $.toast({
                        heading: 'Company Setting',
                        text: 'Setting Update Successfully',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#setting_list").load(location.href + " #setting_list");
                } else {
                    $.toast({
                        heading: 'Company Setting',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-setting').modal('hide');
            }
        });
    }
});