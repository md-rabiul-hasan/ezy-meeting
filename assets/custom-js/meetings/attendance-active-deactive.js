function activeAttendance(id){
    swal({
        title: 'Are you sure?',
        text: "You want to active this meeting attendance!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, active it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(id != ''){
                $.ajax({
                    url: "active-attendance.php",
                    method: 'post',
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Metting Attendane',
                                text: 'Attendance Activation Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#attendance_setup").load(location.href + " #attendance_setup");
                        } else {
                            $.toast({
                                heading: 'Metting Attendane',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Meeting attendance are inactive :)',
                'error'
            )
        }
    })
}

function deactiveAttendance(meeting_id,attendance_id){
    swal({
        title: 'Are you sure?',
        text: "You want to deactive this meeting attendance!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactive it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(meeting_id != '' && attendance_id != ''){
                $.ajax({
                    url: "deactive-attendance.php",
                    method: 'post',
                    data: {
                        meeting_id: meeting_id,
                        attendance_id: attendance_id
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Metting Attendane',
                                text: 'Attendance Deactivation Successfully.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            $("#attendance_setup").load(location.href + " #attendance_setup");
                        } else {
                            $.toast({
                                heading: 'Metting Attendane',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Meeting attendance are action :)',
                'error'
            )
        }
    })
}


function meetingResolution(meeting_id,chairman_id){
    swal({
        title: 'Are you sure?',
        text: "You want to Create Meeting Resulation.! The Agendas that are not voted will be sent to Draft",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactive it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            // ajax code here
            if(meeting_id != ''){
                $.ajax({
                    url: "meeting-resolution.php",
                    method: 'post',
                    data: {
                        meeting_id: meeting_id,
                        chairman_id:chairman_id
                        
                    },
                    success: function(response) {
                        if (response == true) {
                            $.toast({
                                heading: 'Meeting Resulation',
                                text: 'Meeting is Successfully Resolved.',
                                position: 'top-right',
                                icon: 'success', //info, warning, success, and error 
                                stack: false
                            });
                            // $("#attendance_setup").load(location.href + " #attendance_setup");
                        } else {
                            $.toast({
                                heading: 'Meeting Resulation',
                                text: response,
                                position: 'top-right',
                                icon: 'error', //info, warning, success, and error 
                                stack: false
                            });
                        }
                        $('#meeting-resolution').modal('hide');
                    }
                });
            }
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                '',
                'error'
            )
        
            $('#meeting-resolution').modal('hide');
        }
    })
}