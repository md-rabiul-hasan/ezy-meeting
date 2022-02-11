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
        <div class="widget-list">
            <div class="row">
                <?php
                $banner_sql="SELECT * FROM `banner_info` WHERE `id`=1" ;
                $query=mysqli_query($connect, $banner_sql);
                $banner=mysqli_fetch_array($query);
                ?>
                <div class="col-md-12 widget-holder">
                    <div class="widget-bg">
                        <div class="widget-body clearfix">
                            <h5 class="box-title mr-b-0">Banner Information</h5>
                            <form action="javascrip.void();">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Banner Title</label>
                                            <input class="form-control" id="title" name="title" value="<?php echo $banner['title']; ?>"  placeholder="Banner Title" required type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="l30">Banner Description</label>
                                          <textarea   id="description" data-toggle="wysiwyg" name="description"  ><?php echo $banner['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-12 -->
                                </div>

                                <div class="form-actions btn-list">
                                    <button class="btn btn-primary" id="submit" type="button">Submit</button>

                                </div>
                            </form>
                        </div>
                        <!-- /.widget-body -->
                    </div>
                    <!-- /.widget-bg -->
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.widget-list -->
    </div>
</main>


<?php include '../partial/_footer.php';?>
<script>

    jQuery('#submit').on('click',function(){
        var title = jQuery('#title').val();
        var description = jQuery('#description').val();

        // $("#user_list_tbody").load(location.href + " #user_list_tbody");


        if(title != '' && description != ''){
            $.ajax({
                url: "update-banner.php",
                method: 'post',
                data: {
                    title : title,
                    description : description
                },
                success: function(response){
                    if(response == true ){
                       // jQuery('#name').val('');
                        $.notify({
                            message: "Banner Info Updated Successfully.",
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'success'
                        });
                    }else{
                        $.notify({
                            message: response,
                            icon: 'fa fa-check' ,
                            newest_on_top: true
                        },{
                            type: 'danger'
                        });
                    }

                }
            });
        }
    });
</script>

<!-- default Script For Every Pages End -->
</body>

</html>