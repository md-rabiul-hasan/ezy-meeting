<!-- Database Connection -->
<?php include '../../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
?>
<!-- Authentication Check End -->

<?php include '../../partial/_header.php';?>
<main class="main-wrapper clearfix">

            <div class="container">
                <div class="widget-list tablelists">
                    <div class="row">
                        <!-- /.widget-holder -->
                        <div class="widget-holder col-md-12 lisingv2">
                            <div class="widget-bg">
                                <div class="widget-body">
                                    <div class="tabletop">
                                   <div> <h5 class="box-title">Company Vote Option List</h5></div>
                                    <p>This table has showing company all vote Option .
                                        <div class="buttonright">
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-company-memo-modal" style="float:right;"><i class="feather  feather-plus"></i>  <span>Add New</span>
                                        </button>
                                        </div>
                                    </p>
                                    </div>

                                    <div class="col-md-12">
                                        <div>
                                            <div class="boxxarea table-responsive">
                                    <table class="table table-bordered table-striped DataTables" id="memo_list">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Color</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $allMemosSql = "SELECT * FROM vote_options WHERE company_id='$company_id'";
                                                $allMemosQuery = mysqli_query($connect,$allMemosSql);
                                                $sl = 1;
                                                while($allMemosData = mysqli_fetch_array($allMemosQuery)){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $sl++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $allMemosData['name']; ?>
                                                        </td>
                                                       
                                                       <td>
                                                        <input  type="color" id="color" name="color" required="" value="<?php echo str_replace(" ",'', $allMemosData['color']); ?>">
                                                            <?php echo $allMemosData['color']; ?>
                                                        </td>

                                                         <td>
                                                        <button data-toggle="modal" data-target="#edit-vote-option" class="btn btn-primary custom" onclick="EditVoteOption(<?php
                                                         echo $allMemosData['id'] ?>)"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-danger custom" onclick="deleteVoteOption(<?php
                                                         echo $allMemosData['id'] ?>)"><i class="fa fa-trash-o"></i></button>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }

                                            ?>  
                                           
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                </div>
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                    </div>
                    <div style="background: #fff; width: 100%;">
                        <img src="../../assets/img/meeting-bg.png" alt="">
                    </div>
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>


    <!-- Add Modal Added  Start -->
        <!-- Custom Modals -->
        
        <!-- Signup Modal -->
        <div id="add-company-memo-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <div class="modal-body">
                        <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                        </div>
                        <form onsubmit="return mySubmitFunction(event)" id="add-memo">
                            <div class="form-group">
                                <label for="name">Vote Option Name</label>
                                <input class="form-control" type="text" id="name" required="">
                               
                            </div>  

                               <div class="form-group">
                                 <label for="color">color</label>
                                <input  type="color" id="color_id" name="name_color" required="">
                               </div>                            
                            
                            <div class="text-center mr-b-30">
                                <input type="submit" id="submit" class="btn btn-success" value="save">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    
    <!-- Add Modal Added  End-->


    
 <!-- Signup Modal -->
                <div id="edit-vote-option" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">
                                <div class="text-center my-2"><a href="#"><span><img src="<?php echo $addDot; ?>assets/img/logo-dark.png" alt=""></span></a>
                                </div>
                                <form onsubmit="return mySubmitFunction(event)" id="edit-vote-option">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_vote_option_id" name="edit_vote_option_id">
                                        
                                        <label for="name">Vote Option Name</label>
                                        <input class="form-control" type="text" id="edit_vote_option_name" name="edit_vote_option_name" required="" >

                                    </div>                                 
                                   <div class="form-group">
                                     <label for="color">color</label>
                                     <input  type="color" id="edit_color" name="edit_color" required="">
                                   </div> 

                                    <div class="text-center mr-b-30">
                                        <input type="submit" id="edit_vote_option_update" class="btn btn-success" value="update">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

<?php include '../../partial/_footer.php';?>
   
    <script>
        $(document).ready(function() {
            $('.DataTables').DataTable();
        } );
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

// Login form validation 
$("#add-memo").validate({
    rules: {
        name: {
            required: true,
        }

    },
    messages: {
        name: {
            required: 'Please enter memo name.',
        }

    }
});



});

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

 $("#edit-vote-option").validate({
                rules: {
                    edit_vote_option_name: {
                        required: true,
                    }

                },
                messages: {
                    edit_vote_option_name: {
                        required: 'Please enter vote-option name.',
                    }

                }
            });


});
    </script>  
    <!--  <script src="<?php echo $addDot; ?>assets/custom-js/settings/vote-option.js"></script>   -->
    <script type="text/javascript">
     function mySubmitFunction()
         {
           return false;
         }
          jQuery('#submit').on('click',function(){
             var name = jQuery('#name').val();
             var color_id = jQuery('#color_id').val();
             //alert(color_id);

              if(name != ''){
        $('#submit').val('saving......');
        $('#submit').attr('disabled', true);
        $.ajax({
            url: "vote-option-registration.php",
            method: 'post',
            data: {
                name : name,
                color_id:color_id
            },
            success: function(response){
                $('#submit').val('save');
                $('#submit').attr('disabled', false);
                if(response == true ){
                    jQuery('#name').val('');
                    jQuery('#color_id').val('');
                    $.toast({
                        heading: 'Company Vote Option',
                        text: 'Vote Option Created Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#memo_list").load(location.href + " #memo_list");
                }else{
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



        function EditVoteOption(id) {
            $.ajax({
                url: "vote-option-edit.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    // console.log(data.name);
                    // console.log(data.color);
                    $('#edit_vote_option_id').val(data.id);
                    $('#edit_vote_option_name').val(data.name);
                    $('#edit_color').val(data.color);
                }
            });
        }  


  //   update vote option data
jQuery('#edit_vote_option_update').on('click', function() {
    var edit_vote_option_id = jQuery('#edit_vote_option_id').val();
    var edit_vote_option_name = jQuery('#edit_vote_option_name').val();
    var edit_color = jQuery('#edit_color').val();
   // alert(edit_vote_option_id);

    if (edit_vote_option_id != '') {
        //alert(edit_vote_option_id);
        $('#edit_vote_option_update').val('updating......');
        $('#edit_vote_option_update').attr('disabled', true);
        $.ajax({
            url: "voteoptionupdate.php",
            method: 'post',
            data: {
                edit_vote_option_id: edit_vote_option_id,
                edit_vote_option_name: edit_vote_option_name,
                edit_color:edit_color
            },
            success: function(response) {
                $('#edit_vote_option_update').val('update');
                $('#edit_vote_option_update').attr('disabled', false);
                if (response == true) {
                    $('#edit-vote-option').modal('hide');
                    $('#edit_vote_option_name').val('');
                    $.toast({
                        heading: 'Vote Option',
                        text: 'Vote Option Update Successfully.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                    $("#memo_list").load(location.href + " #memo_list");
                } else {
                    $.toast({
                        heading: 'Vote Option',
                        text: 'Vote Option Update Failed.',
                        position: 'top-right',
                        icon: 'error', //info, warning, success, and error 
                        stack: false
                    });
                }

                $('#edit-vote-option').modal('hide');
            }
        });
    }
});


function deleteVoteOption(id) {
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
            $.ajax({
                url: "vote-option-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Vote Option',
                            text: 'Vote Option Delete Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#memo_list").load(location.href + " #memo_list");
                    } else {
                        $.toast({
                            heading: 'Vote Option',
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

    </script>
    <script src="<?php echo $addDot; ?>assets/js/template.js"></script>
    <script src="<?php echo $addDot; ?>assets/js/custom.js"></script>
    <!-- default Script For Every Pages End -->
</body>


<!-- Mirrored from horizon.thinqteam.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Apr 2020 04:59:09 GMT -->
</html>

