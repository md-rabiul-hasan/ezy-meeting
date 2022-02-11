// form action off
function mySubmitFunction()
{
  return false;
}
// User Relative Information Stored 
jQuery('#agenda_template_store').on('click', function() {
    var name        = jQuery('#name').val();
    var description = jQuery('#description').val();
    var type        = $("input[name='type']:checked").val();

    if (name != '' && description != '' && type != '' ) { 
        $('#agenda_template_store').val('saving......');
        $('#agenda_template_store').attr('disabled', true);
        $.ajax({
            url: "agenda-template-store.php",
            method: 'post',
            data: {
                name       : name,
                description: description,
                type      : type
            },
            success: function(response) {
                console.log(response);
                $('#agenda_template_store').val('save');
                $('#agenda_template_store').attr('disabled', false);
                if (response == true) {
                    $('#add-agenda-template-modal').modal('hide');
                    jQuery('#name').val('');
                    $('iframe').contents().find('.wysihtml5-editor').html('');
                    // $("input[name='type']:checked").false;
                    $("input[name='type']").prop("checked", false);
                    $.toast({
                        heading: 'Agent Template Setup',
                        text: 'Agenda Template Setup Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#agenda_template_table").load(location.href + " #agenda_template_table");
                } else {
                    $.toast({
                        heading: 'Agent Template Setup',
                        text: response,
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#add-agenda-template-modal').modal('hide');
            }
        });
    }
});

// Edit Relative Information
function EditAgenda(id) {
    $.ajax({
        url: "agenda-template-edit.php",
        method: 'post',
        data: {
            id: id,
        },
        success: function(response) {
            
            var data = JSON.parse(response);
            alert(data.description);
            $('#edit_agenda_id').val(data.id);
            $('#edit_name').val(data.name);
            // $("#edit_description").html(data.description);
            $('textarea#edit_description').html(data.description);
            if(data.type == 1){
                $("#edit_type1").attr('checked', true);
                $("#edit_type2").attr('checked', false);
            }else{
                $("#edit_type1").attr('checked', false);
                $("#edit_type2").attr('checked', true);
            }
            $('#edit-agenda').modal('show');
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

                $('#edit-user-education-modal').modal('hide');
            }
        });
    }
});


// user relative Delete

function  deleteAgendaTemplate(id){
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
                url: "agenda-template-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Agenda Template',
                            text: 'Agenda Template Delete  Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#agenda_template_table").load(location.href + " #agenda_template_table");
                    } else {
                        $.toast({
                            heading: 'Agenda Template',
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