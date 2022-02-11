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
            url: "vote-option-registration.php",
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
                        heading: 'Company Vote Option',
                        text: 'Vote Option Created Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#memo_list").load(location.href + " #memo_list");
                } else {
                    $.toast({
                        heading: 'Company Vote Option',
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