<!-- Database Connection -->
<?php include '../database_connection.php';?>

<!-- Authentication Check Start -->
<?php
    if ( !isset( $_SESSION['id'] ) ) {
        header( "location:../login/login.php" );
        exit;
    }

    $company_id = $_SESSION['company_id'];
?>
<!-- Authentication Check End -->

<?php include '../partial/_header.php';?>
<main class="main-wrapper clearfix">

            <div class="container">
                <div class="widget-list tablelists">
                    <div class="row">
                        <div class="col-md-12 widget-holder lisingv2">
                            <div class="widget-bg" id="user_list">

                                <!-- /.widget-heading -->
                                <div class="widget-body clearfix">
                                    <div class="tabletop">
                                        <div> <h5 class="box-title">All Notice</h5></div>

                                        <p> Here is the All Notice list

                                        <div class="buttonright">
                                            <a href="add-notice.php" class="btn btn-sm btn-success" style="float: right;">
                                                <i class="feather  feather-plus"></i>  <span>Add New Notice</span>
                                            </a>
                                        </div>


                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="boxxarea table-responsive">
                                    <table  class="table table-bordered table-striped DataTables" id="notice_list">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>Type</th>
                                                <th>To Users</th>
                                                <th>User</th>
                                                <th>Date Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                           <?php
                                                $sql = "SELECT notices.*,users.name as user_name FROM notices INNER JOIN users on notices.entry_user_id=users.id   where notices.company_id='{$company_id}'";
                                                
                                                $query = mysqli_query($connect,$sql);
                                                $sl = 1;
                                                while($data = mysqli_fetch_assoc($query)){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $sl++; ?></td>
                                                            <td><?php echo $data['notice_title']; ?></td>
                                                            <td>
                                                                <?php 
                                                                    if(isset($data['notice_file'])){
                                                                        printf("<a href='%s' download class='btn btn-success btn-sm'>Download</a>",$addDot.$data['notice_file']);
                                                                    } 
                                                                ?>
                                                            </td>
                                                            <td style="text-transform:capitalize"><?php echo $data['type']; ?></td>
                                                            <td>
                                                                <?php echo  noticeToUsers($company_id,$data['to_users']); ?>
                                                            </td>
                                                            <td><?php echo $data['user_name'] ?></td>
                                                            <td><?php echo date('jS F, Y h:i a',strtotime($data['updated_at'])); ?></td>
                                                            <td>
                                                                <a href="edit-notice.php?notice_id=<?php echo encryptData($data['id']); ?>" class="btn custom btn-primary"><i class="list-icon lnr lnr-pencil"></i></a>
                                                                <button class="btn custom btn-danger" onclick="deleteNotice(<?php echo $data['id']; ?>)"><i class="list-icon lnr lnr-trash"></i></button>
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
                        <!-- /.widget-holder -->
                    </div>
                    <div style="background: #fff; width: 100%;">
                        <img src="../assets/img/meeting-bg.png" alt="">
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.widget-list -->
            </div>
            <!-- /.container -->
        </main>

<?php include '../partial/_footer.php';?> 
<?php
        if(isset($_SESSION['store_notice'])){
            $store_notice_msg = $_SESSION['store_notice'];
            if($store_notice_msg == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Company Notice',
                        text: 'Notice Upload Success.',
                        position: 'top-right',
                        icon: 'success', //info, warning, success, and error 
                        stack: false
                    });
                </script>
            <?php
            }
            $_SESSION['store_notice'] = null;
        }

        if(isset($_SESSION['update_notice'])){
            $update_notice_msg = $_SESSION['update_notice'];
            if($update_notice_msg == true){
            ?>
                <script>
                    $.toast({
                        heading: 'Company Notice',
                        text: 'Notice Update Success.',
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
    $(document).ready(function() {
        $('.DataTables').DataTable();
    } );

    function deleteNotice(id){
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
            // ajax code here
            $.ajax({
                url: "notice-delete.php",
                method: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    if (response == true) {
                        $.toast({
                            heading: 'Company Notice',
                            text: 'Notice Delete Successfully.',
                            position: 'top-right',
                            icon: 'success', //info, warning, success, and error 
                            stack: false
                        });
                        $("#notice_list").load(location.href + " #notice_list");
                    } else {
                        $.toast({
                            heading: 'Company Notice',
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

</body>

</html>