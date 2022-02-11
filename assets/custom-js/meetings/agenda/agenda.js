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
    $("#add-meeting-agenda-form").validate({
        rules: {
            title: {
                required: true,
            },
            memo_id: {
                required: true,
            },
            memo_file : {
                extension: "pdf"
            },
            division_id :{
                required : true,
            },
            explanatory_template_id : {
                required : true,
            },
            explanatory_description : {
                required : true,
            },
            amount : {
                number: true,
                range: [1, 999999999999999]
            }
            

        },
        messages: {
            title: {
                required: 'Please enter meeting agenda title',
            },
            memo_id: {
                required: 'Please select memo type',
            },
            division_id : {
                required : 'Please select division type'
            },
            explanatory_template_id: {
                required: 'Please select explanatory template',
            },
            explanatory_description : {
                required : 'Please write explanatory description'
            },
            amount : {
                number: "Invalid Format",
                range: "Invalid Amount"
            },
            memo_file: {
                extension: "Only pdf file supported"
            }

        }
    });

});





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
    $("#edit-meeting-agenda-form").validate({
        rules: {
            title: {
                required: true,
            },
            memo_id: {
                required: true,
            },
            division_id :{
                required : true,
            },
            explanatory_template_id : {
                required : true,
            },
            explanatory_description : {
                required : true,
            },
            amount : {
                number: true
            },
            minute_file : {
                extension: "docx"
            }

            

        },
        messages: {
            title: {
                required: 'Please enter meeting agenda title',
            },
            memo_id: {
                required: 'Please select memo type',
            },
            division_id : {
                required : 'Please select division type'
            },
            explanatory_template_id: {
                required: 'Please select explanatory template',
            },
            explanatory_description : {
                required : 'Please write explanatory description'
            },
            amount : {
                number: "Invalid Format"
            },
            minute_file : {
                extension: "Only Docx file supported" 
            }


        }
    });

});


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
    $("#agenda-minute-upload-form").validate({
        rules: {
            minute_file : {
                required : true,
                extension: "docx"
            }
        },
        messages: {
            minute_file : {
                required : 'Please select and upload agenda minute',
                extension: "Only Docx file supported" 
            }
    
    
        }
    });
    
    });