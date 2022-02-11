</div>
    <!-- /.content-wrapper -->

    </div>
    <!--/ #wrapper -->
    <!-- Scripts -->






    <!-- default Script For Every Pages Start -->
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="<?php echo $addDot; ?>assets/js/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>
<script src="<?php echo $addDot; ?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.27/daterangepicker.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo $addDot; ?>assets/js/fullcalendar.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script src="<?php echo $addDot; ?>assets/cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script src="<?php echo $addDot; ?>assets/js/moment.min.js"></script>

<script src="<?php echo $addDot; ?>assets/js/validation.js"></script>
<script src="<?php echo $addDot; ?>assets/js/jquery.toast.min.js"></script>
<script src="<?php echo $addDot; ?>assets/js/sweetalert2.min.js"></script>


<!--/ #wrapper -->
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="<?php echo $addDot; ?>assets/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>


<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(".menu-item-has-children .main").click(function(){
        $('.collapse').removeClass("in");
       $(this).parent().toggleClass("active");
        $('.active .collapse').addClass("in");
        //if ( $("selector").hasClass("someClass") ) {   /*EXISTS (has class) */  }
    });
    $(".ripple").click(function(){
      $(".site-sidebar").toggleClass("scrollbar-enabled");
        $('body').attr('data-sidebar-state', $('body').attr('data-sidebar-state') == 'expand' ? 'collapse' : 'expand')
        //$("body").attr("data-sidebar-state", 'collapse'); // yes it worked!
    });
</script>