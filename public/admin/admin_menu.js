$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({theme: "minimal" });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar,#content').toggleClass('active');
        $('.navbar').toggleClass('active');
        $('#arrow').toggleClass('active');
        $('.img_admin').toggleClass('active');
        if($('#arrow').hasClass('fa-chevron-left')){ 
         $('#arrow').removeClass('fa-chevron-left').addClass('fa-chevron-right');}
        else{
         $('#arrow').removeClass('fa-chevron-right').addClass('fa-chevron-left');
         }               
    });//click


    // $('.tr_index').on('click', function () {
    //     $('.table_user_show').toggleClass('active'); 
        
    // });//click


});