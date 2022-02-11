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

    $.validator.addMethod('phone', function(value) {
        return /\b(88)?01[3-9][\d]{8}\b/.test(value);
    }, 'Please enter valid phone number');

    $.validator.addMethod('nid', function(value) {
        return /^([0-9]{9})(X|V)$/.test(value);
    }, 'Please enter user valid nid number');

    // Login form validation 
    $("#user-profile-update-form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                phone: true
            },
            designation: {
                required: true
            },
            nid: {
                required: true,
            },
            tin: {
                required: true
            },
            role_id: {
                required: true
            },
            hierarchy: {
                required: true
            },
            is_voter: {
                required: true
            },
            is_active: {
                required: true
            },
            avatar: {
                extension: "jpg|jpeg|png|JPG|JPEG|PNG"
            },
            joining_date: {
                required: true
            }

        },
        messages: {
            name: {
                required: 'Please enter user name.',
            },
            email: {
                required: 'Please enter user email address',
                email: 'Please enter valid email address'
            },
            phone: {
                required: 'please enter user phone number'
            },
            designation: {
                required: 'Please enter user designation'
            },
            nid: {
                required: 'Please enter user nid number',
            },
            tin: {
                required: 'Pleae enter user tin number'
            },
            role_id: {
                required: 'Please select user role'
            },
            hierarchy: {
                required: 'Please enter user hierarchy'
            },
            is_voter: {
                required: 'Please select user voating activaty'
            },
            is_active: {
                required: 'Please select user login activaty'
            },
            avatar: {
                extension: "Invalida file format.Please select jpg|jpeg|png|JPG|JPEG|PNG "
            },
            joining_date: {
                required: 'Please select user joining date'
            }

        }
    });



});