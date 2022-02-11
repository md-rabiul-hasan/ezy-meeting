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