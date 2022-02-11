<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if (!isset($_SESSION['id'])) {
        header("location:../login/login.php");
        exit;
    }

    $company_id = $_SESSION['company_id'];
?>
<?php
    if (isset($_GET['notice_id'])) {
        $notice_id = decryptData(filter_input(INPUT_GET, 'notice_id', FILTER_SANITIZE_STRING));
        $sql       = "SELECT * FROM notices WHERE id={$notice_id} and company_id='{$company_id}'";
        $query     = mysqli_query($connect, $sql);
        $data      = mysqli_fetch_assoc($query);
    }

?>
<!-- Authentication Check End -->

<?php include '../partial/_header.php';?>
<main class="main-wrapper clearfix">
            <!-- Page Title Area -->
            <div class="page-title">
                <div class="container">
                    <div class="row">
                        <div class="page-title-left">
                            <h6 class="page-title-heading mr-0 mr-r-5">Notice Panel</h6>
                            <p class="page-title-description mr-0 d-none d-md-inline-block">
                                all notice
                            </p>
                        </div>
                        <!-- /.page-title-left -->
                        <div class="page-title-right d-none d-sm-inline-flex align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Notice Panel</li>
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
                    <div class="row">
                        <div class="col-md-12 widget-holder">
                            <div class="widget-bg" id="user_list">
                                <div class="widget-heading clearfix">
                                    <h5>Edit Notice</h5>
                                </div>

                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form id="notice-add-form" action="notice-udpate.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="notice_id" value="<?php echo $data['id']; ?>">
                                                <div class="form-group select_error">
                                                    <label for="type">Select User Group Type <span class="required_sign">**</span> </label>
                                                    <select class="m-b-10 form-control select2" required="" name="type" id="type" data-toggle="select2">
                                                        <optgroup label="User Group Type List">
                                                            <option value="">Select Type</option>
                                                            <option value="committee"                                                                                      <?php if ($data['type'] == 'committee') {echo "selected";}?> >Committee</option>
                                                            <option value="all"                                                                                <?php if ($data['type'] == 'all') {echo "selected";}?>>All</option>
                                                        </optgroup>
                                                    </select>
                                                </div>

                                                <div class="form-group select_error">
                                                    <label for="type">Select User Group <span class="required_sign">**</span> </label>
                                                    <select class="m-b-10 form-control select2" required="" name="type_id[]" multiple id="type_id" data-toggle="select2">
                                                        <optgroup label="Select User Group List">
                                                            <option value="">Select User Group</option>
                                                            <?php
                                                                if ($data['type'] == "committee" || $data['type'] == "all") {
                                                                    $committeQuery      = mysqli_query($connect, "SELECT name,id FROM committees WHERE company_id='{$company_id}'");
                                                                    $committeeListArray = explode(",", $data['committee_id']);
                                                                    while ($committeeList = mysqli_fetch_assoc($committeQuery)) {
                                                                    ?>
                                                                            <option value="<?php echo $committeeList['id'] ?>"<?php if (in_array($committeeList['id'], $committeeListArray)) {echo "selected";}?>><?php echo $committeeList['name'] ?></option>
                                                                        <?php
                                                                            }
                                                                            }
                                                                        ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Title <span class="required_sign">**</span></label>
                                                    <input class="form-control" type="text" name="title" id="title" value="<?php echo $data['notice_title']; ?>" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">Select File</label>
                                                    <input class="form-control" type="file" name="file" id="file">
                                                </div>
                                                <div class="mr-b-30">
                                                    <input type="submit" id="submit" class="btn btn-success" value="update">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>

<?php include '../partial/_footer.php';?>
<?php
    if (isset($_SESSION['update_notice'])) {
        $update_notice_msg = $_SESSION['update_notice'];
        if ($update_notice_msg == false) {
        ?>
                <script>
                    $.toast({
                        heading: 'Company Notice',
                        text: 'Notice Update Failes.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error
                        stack: false
                    });
                </script>
            <?php
                }
                    $_SESSION['update_notice'] = null;
                }
            ?>
<script>
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
$("#notice-add-form").validate({
    rules: {
        title: {
            required: true,
        },
        file : {
            extension: "docx|pdf"
        }
    },
    messages: {
        title: {
            required: 'Please enter notice title.',
        },
        file : {
            extension: "Unsupported file format" 
        }
        

    }
});

});

$('#type').on('change',function(){
    var type = $(this).val();
    if(type != ''){
        $.ajax({
            "method" : "post",
            "url" : "user-group-list.php",
            "data" : {
                "type" : type
            },
            success:function(response){
                document.getElementById('type_id').innerHTML = response;
            }
        });
    }
});

</script>
</body>

</html>


