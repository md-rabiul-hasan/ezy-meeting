function mySubmitFunction(){
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
    $("#agenda-list-form").validate({
        rules: {
            agenda_list_notice_reference_number : {
                required : true
            },
            agenda_list_notice_date : {
                required : true
            }
        },
        messages: {
            agenda_list_notice_reference_number : {
                required : 'Please enter notice reference number'
            },
            agenda_list_notice_date : {
                required : 'Please select notice date'           }
    
    
        }
    });
    
    
    });

    $('#agenda_list_generate').on('click',function(){
        $('#agenda-list-modal').modal('show');
    });

// Agenda Minute Upload By Ajax Modal  End 