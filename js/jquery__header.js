jQuery(function($){
    $(document).ready(function(){
        $(window).scrollTop(0);
        // evento de scroll
        $(window).scroll(function() {
            if ($(this).scrollTop() > 0) {
                $('.header').addClass('active');
                $('.header__logo--img').attr('src', 'assets/Isologo Prospectiva Final-02.png');
            } else {
                $('.header').removeClass('active');
                $('.header__logo--img').attr('src', 'assets/Isologo Prospectiva Final-06.png');
            }
        });
    
        // evento de menu
        $('.nav-burguer').click(function() {
            $('.header__navigation').toggleClass('active');
            $('.nav-burguer').toggleClass('active');
            $('body').toggleClass('active');
        });
        $('.header__navigation--list a').on('click', function() {
            $('.nav-burguer').toggleClass('active');
            $('.header__navigation').toggleClass('active');
            $('body').toggleClass('active');
          });
    
        // evento de botones para contratar  
        $('#btn-silver').click(function(){
            $('#texto__dos').text('Hola! Me interesa saber más sobre el plan Silver.');
        });  
        $('#btn-gold').click(function(){
            $('#texto__dos').text('Hola! Me interesa saber más sobre el plan Gold.');
        });  
          
    });

});
