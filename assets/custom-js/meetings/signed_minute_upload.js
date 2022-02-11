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
    $("#meeting-signed-minute-upload-form").validate({
        rules: {
            meeting_signed_minute_file : {
                required : true,
                extension: 'pdf'
            }
        },
        messages: {
            meeting_signed_minute_file : {
                required : 'Please select and upload meeting signed minute file',
                extension: 'Only Pdf file supported'
            }
    
    
        }
    });
    
    
    });

$("#meeting_signed_minute_upload").on('click',function(){
   
   $('#meeting-signed-minute-upload-modal').modal('show');

   $('#upload_meeting_signed_minute_file_sumbit').on('click',function(){
        $('#upload_meeting_signed_minute_file_sumbit').val("uploading....");
        document.getElementById("upload_meeting_signed_minute_file_sumbit").disabled = true;
        var meeting_id = $("#meeting_id").val();
        var file_data  = $('#meeting_signed_minute_file').prop('files')[0];
        var form_data  = new FormData();
        form_data.append('meeting_id', meeting_id);                           
        form_data.append('meeting_signed_minute_file', file_data);
          
        if(file_data != undefined){
            $.ajax({
                url: 'signed-minute/meeting-signed-minute-upload.php',// point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    if(response == true){
                        $('#meeting-signed-minute-upload-modal').modal('hide');
                        $.toast({
                            heading: 'Meeting Signed Minute',
                            text: 'Meeting Singed Minute Upload Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        document.getElementById("meeting-signed-minute-upload-form").reset();
                    }else{
                        $('#meeting-signed-minute-upload-modal').modal('hide');
                        $.toast({
                            heading: 'Meeting Signed Minute',
                            text: response,
                            position: 'top-right',
                            icon: 'error', //info, warning, success, and error 
                            stack: false
                        });
                    }
                }
            });
        }                        
      
    });

});
// Agenda Minute Upload By Ajax Modal  End 