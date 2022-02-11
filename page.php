<!-- Database Connection -->
<?php include '../database_connection.php'; ?>

<!-- Authentication Check Start -->
<?php
if (!isset($_SESSION['id'])) {
    header("location:../login/login.php");
    exit;
}

$company_id = $_SESSION['company_id'];
?>
<!-- Authentication Check End -->
<style type="text/css">
    .media.sctive{
  background: #2adc9c;
  color: #fff;
}
.rights{
  float: right;
  width: 60px;
  text-align: center;
  font-size: 11px;
}
.rights i{
  display: block;
  margin-top: 10px;
}
.lft{
  float: left;
  padding-left: 19px;
  width: calc( 100% - 60px );
}
.section-o{
  width: 100%;
}
.decesion h5{
  font-size: 18px;
  font-weight: 400;
  margin: 0;
}
.radios .radiobox{
  margin-right: 10px;
  display:  inline-block;
}
.panel.memo{
  margin-top: 10px;
  overflow: hidden;
}
.panel.memo h6{
  margin: 0;
}
.panel.memo .badge{
  font-size: 11px;
  padding: 3px 6px;
  border-radius: 5px;
  font-size: 11px;
}
.panel.memo .badge.red{
  background: red;
  color: #fff;
}
.panel.memo .badge.blue{
  background:  dodgerblue;
  color: #fff;
}
.ml20{
  margin-left: 20px;
}
.agendapan{
  padding-bottom: 50px;
}
.ml-10{
  margin-left: 10px;
}
</style>
<?php include '../partial/_header.php'; ?>
<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="page-title-left">
                    <h6 class="page-title-heading mr-0 mr-r-5">10th Board Meeting for VSL</h6>

                </div>
                <!-- /.page-title-left -->
                <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="index-2.html">Meetings</a></li>
                        <li class="breadcrumb-item active"><a href="index-2.html">Meeting Panel</a></li>
                        <li class="breadcrumb-item active">Agendas</li>
                    </ol>
                </div>
                <!-- /.page-title-right -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="container">
        <div class="widget-list">
            <div class="row no-gutters">
                <div class="col-md-9 widget-holder widget-full-content">
                    <div class="widget-bg">
                        <div class="widget-body clearfix">
                            <div class="mail-inbox row no-gutters" style="height: 90vh">
                                <!-- Mail Sidebar -->
                                <div class="col-md-3 d-none d-md-flex flex-column mail-sidebar h-100">

                                    <!-- /.mail-inbox-header -->
                                    <div class="mail-list flex-1 scrollbar-enabled pr-0">

                                        <a href="" class="mail-list-item unread media sctive">
                                            <div class="media-body">
                                                <div class="d-flex">
                                                    <div class="headings-font-family">
                                                        <span class="mail-title headings-color d-block zi-3">Agenda Name Here</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="" class="mail-list-item unread media">
                                            <div class="media-body">
                                                <div class="d-flex">
                                                    <div class="headings-font-family">
                                                        <span class="mail-title headings-color d-block zi-3">Agenda Name Here</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>


                                    </div>
                                    <!-- /.mail-inbox -->
                                </div>
                                <!-- /.mail-sidebar -->
                                <div class="col-md-9 col-12 h-100 d-flex flex-column agendapan">
                                    <div class="mail-inbox-header">
                                        <ul class="mail-inbox-categories list-unstyled list-inline headings-font-family fw-semibold mb-0">

                                            <li class="list-inline-item"><h5>15th Meeting Memo -1</h5>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- /.mail-inbox-header -->
                                    <div class="mail-single flex-1 scrollbar-enabled pr-4">
                                        <div class="panel memo">
                                            <div class="panel-body">
                                                <div class="lft">
                                                    <h6>New Memo/Loan <br>
                                                        <small>
                                                            <span class="badge blue">New Client</span>
                                                            <span class="badge red">10000  BDT</span>
                                                        </small>
                                                    </h6>
                                                </div>

                                                <div class="rights">
                                                    <a href=""><i class="list-icon lnr lnr-file-empty"></i>
                                                        Agenda File
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mail-single-reply mx-3 decesion my-5 clearfix">
                                            <div class="triangle-top"></div>
                                            <span class="float-left">


                                             <h5>Final Decisions</h5>
                                        <div class="radios">
                                        <div class="radiobox">
                                                    <label>
                                                        <input type="radio" name="radio1Option[]" value="1"
                                                               checked="checked"> <span
                                                                class="label-text">Decline</span>
                                                    </label>
                                                </div>
                                                <div class="radiobox">
                                                    <label>
                                                        <input type="radio" name="radio1Option[]" value="1"
                                                               checked="checked"> <span
                                                                class="label-text">Approve</span>
                                                    </label>
                                                </div>
                                                <div class="radiobox">
                                                    <label>
                                                        <input type="radio" name="radio1Option[]" value="1"
                                                               checked="checked"> <span class="label-text">Defer</span>
                                                    </label>
                                                </div>
                                                <div class="radiobox">
                                                    <label>
                                                        <input type="radio" name="radio1Option[]" value="1"
                                                               checked="checked"> <span
                                                                class="label-text">No Comments</span>
                                                    </label>
                                                </div>
                                        </div>

                                         <h5>Resolved</h5>

                                          <textarea data-toggle="wysiwyg"></textarea>
                                             </span>
                                        </div>
                                        <button class="btn  btn-primary ml20">Submit</button>
                                    </div>
                                    <!-- /.mail-single -->
                                </div>
                                <!-- /.col-lg-9 -->

                            </div>
                            <!-- /.mailbox -->

                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>
                <!-- /.widget-holder -->
                <div class="col-md-3 widget-holder widget-full-content">

                    <div class="card card-body shadow-sm ml-10"><h5 class="text-primary">Member Decisions</h5><h5
                                class="card-title">Total vote :0</h5>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-12">
                                <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-target=".bs-modal-lg">Edit Decisions
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                         aria-hidden="true" style="display: none">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="myLargeModalLabel">Add Member Decisions</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="media mb-2 "><img width="40px" alt=""
                                                                  class="rounded-circle member-avatar border border-primary mr-3 mt-2"
                                                                  src="https://ezymeeting-dev.s3.ap-south-1.amazonaws.com/5d99e1c8ba74ce929f1c18d6/users/5d9a6d6bd05f2f10feed7d1b/1570401790874.png">
                                        <div class="media-body"><h5 class="mt-1 mb-0">Board Member 2 </h5>
                                            <small class="text-primary">Director 1</small>
                                            <div class="clear-fix"></div>
                                            <div class="">
                                                <div class="form-group mt-2">

                                                    <div class="radios">
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Decline</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Approve</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span class="label-text">Defer</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">No Comments</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label for="exampleFormControlTextarea1">Comments</label><textarea
                                                            class="form-control" id="exampleFormControlTextarea1"
                                                            rows="2"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media mb-2 "><img width="40px" alt=""
                                                                  class="rounded-circle member-avatar border border-primary mr-3 mt-2"
                                                                  src="https://ezymeeting-dev.s3.ap-south-1.amazonaws.com/5d99e1c8ba74ce929f1c18d6/users/5d9a6d6bd05f2f10feed7d1b/1570401790874.png">
                                        <div class="media-body"><h5 class="mt-1 mb-0">Board Member 2 </h5>
                                            <small class="text-primary">Director 1</small>
                                            <div class="clear-fix"></div>
                                            <div class="">
                                                <div class="form-group mt-2">

                                                    <div class="radios">
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Decline</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Approve</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span class="label-text">Defer</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">No Comments</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label for="exampleFormControlTextarea1">Comments</label><textarea
                                                            class="form-control" id="exampleFormControlTextarea1"
                                                            rows="2"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media mb-2 "><img width="40px" alt=""
                                                                  class="rounded-circle member-avatar border border-primary mr-3 mt-2"
                                                                  src="https://ezymeeting-dev.s3.ap-south-1.amazonaws.com/5d99e1c8ba74ce929f1c18d6/users/5d9a6d6bd05f2f10feed7d1b/1570401790874.png">
                                        <div class="media-body"><h5 class="mt-1 mb-0">Board Member 2 </h5>
                                            <small class="text-primary">Director 1</small>
                                            <div class="clear-fix"></div>
                                            <div class="">
                                                <div class="form-group mt-2">

                                                    <div class="radios">
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Decline</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Approve</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span class="label-text">Defer</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">No Comments</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label for="exampleFormControlTextarea1">Comments</label><textarea
                                                            class="form-control" id="exampleFormControlTextarea1"
                                                            rows="2"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media mb-2 "><img width="40px" alt=""
                                                                  class="rounded-circle member-avatar border border-primary mr-3 mt-2"
                                                                  src="https://ezymeeting-dev.s3.ap-south-1.amazonaws.com/5d99e1c8ba74ce929f1c18d6/users/5d9a6d6bd05f2f10feed7d1b/1570401790874.png">
                                        <div class="media-body"><h5 class="mt-1 mb-0">Board Member 2 </h5>
                                            <small class="text-primary">Director 1</small>
                                            <div class="clear-fix"></div>
                                            <div class="">
                                                <div class="form-group mt-2">

                                                    <div class="radios">
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Decline</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Approve</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span class="label-text">Defer</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">No Comments</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label for="exampleFormControlTextarea1">Comments</label><textarea
                                                            class="form-control" id="exampleFormControlTextarea1"
                                                            rows="2"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media mb-2 "><img width="40px" alt=""
                                                                  class="rounded-circle member-avatar border border-primary mr-3 mt-2"
                                                                  src="https://ezymeeting-dev.s3.ap-south-1.amazonaws.com/5d99e1c8ba74ce929f1c18d6/users/5d9a6d6bd05f2f10feed7d1b/1570401790874.png">
                                        <div class="media-body"><h5 class="mt-1 mb-0">Board Member 2 </h5>
                                            <small class="text-primary">Director 1</small>
                                            <div class="clear-fix"></div>
                                            <div class="">
                                                <div class="form-group mt-2">

                                                    <div class="radios">
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Decline</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">Approve</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span class="label-text">Defer</span>
                                                            </label>
                                                        </div>
                                                        <div class="radiobox">
                                                            <label>
                                                                <input type="radio" name="radio1Option[]" value="1"
                                                                       checked="checked"> <span
                                                                        class="label-text">No Comments</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label for="exampleFormControlTextarea1">Comments</label><textarea
                                                            class="form-control" id="exampleFormControlTextarea1"
                                                            rows="2"></textarea></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer"><a href="#" class="btn btn-info ">Save</a>
                                    <button type="button" class="btn btn-danger "
                                            data-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.widget-list -->
    </div>
    <!-- /.container -->
</main>
<!-- Add Modal Added  End-->

<?php include '../partial/_footer.php'; ?>
<script src="<?php echo $addDot; ?>assets/js/bootstrap-notify.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script>
    jQuery('#submit').on('click', function () {
        var name = jQuery('#name').val();
        var email = jQuery('#email').val();
        var password = jQuery('#password').val();
        var role_id = jQuery('#role_id').val();

        // $("#user_list_tbody").load(location.href + " #user_list_tbody");


        if (name != '' && email != '' && password != '' && role_id != '') {
            $('#submit').val('saving......');
            $('#submit').attr('disabled', true);
            $.ajax({
                url: "user-registration.php",
                method: 'post',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    role_id: role_id
                },
                success: function (response) {
                    $('#submit').val('save');
                    $('#submit').attr('disabled', false);
                    if (response == true) {
                        jQuery('#name').val('');
                        jQuery('#email').val('');
                        jQuery('#password').val('');
                        jQuery('#role_id').val('');
                        $.notify({
                            message: "User Created Successfully.",
                            icon: 'fa fa-check',
                            newest_on_top: true
                        }, {
                            type: 'success'
                        });
                        $("#user_list").load(location.href + " #user_list");
                    } else {
                        $.notify({
                            message: response,
                            icon: 'fa fa-check',
                            newest_on_top: true
                        }, {
                            type: 'danger'
                        });
                    }

                    $('#add-user-modal').modal('hide');
                }
            });
        }
    });

    $(document).ready(function () {
        $('.DataTables').DataTable();

    });


</script>

</body>

</html>