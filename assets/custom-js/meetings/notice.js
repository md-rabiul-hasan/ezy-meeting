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
    $("#meeting-notice-upload-form").validate({
        rules: {
            meeting_notice_file : {
                required : true,
                extension: 'pdf'
            }
        },
        messages: {
            meeting_notice_file : {
                required : 'Please select and upload meeting notice file',
                extension: 'Only Pdf file supported' 
            }
    
    
        }
    });
    
    
    });

$("#meeting_notice_upload").on('click',function(){
   
   $('#meeting-notice-upload-modal').modal('show');
   
   $('#upload_meeting_notice_file').on('click',function(){

        $('#upload_meeting_notice_file').val("uploading....");
        document.getElementById("upload_meeting_notice_file").disabled = true;
        
        var meeting_id = $("#meeting_id").val();
        var file_data  = $('#meeting_notice_file').prop('files')[0];
        var form_data  = new FormData();
        form_data.append('meeting_id', meeting_id);                           
        form_data.append('meeting_notice_file', file_data);
          
        if(file_data != undefined){
            $.ajax({
                url: 'notice/meeting-notice-upload-submit.php',// point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    $('#upload_meeting_notice_file').val("upload");
                    $('#upload_meeting_notice_file').attr('disabled', false);
                    console.log(response);
                    if(response == true){
                       location.realod();
                    }else{
                        $('#meeting-notice-upload-modal').modal('hide');
                        $.toast({
                            heading: 'Meeting Notice Upload',
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