$(document).ready(function(){

    const bgWhite = getComputedStyle(document.documentElement).getPropertyValue('--bg-white');

    // Definimos la función para actualizar el padding-top del header
    // function updateHeaderPadding() {
    //     if ($(window).width() > 1400) {
    //         $('.header').css('padding-top', 'calc(10vh + 125px)');
    //     } else {
    //         $('.header').css('padding-top', 'calc(1vh + 50px)');
    //     }
    // }

    // Llamamos a la función para actualizar el padding-top inicialmente
    // updateHeaderPadding();

    $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            // $('.header').css({
            //     'padding-top': '0px',
            //     'background': '#ffff',
            //     'border-bottom': '1px solid #999'
            // });
            // $('.bar').css('background-color', 'black');
            // $('.header__logo--img').css('transform', 'scale(.7)');
            $('.header').addClass('active');
            $('.header__logo--img').attr('src', 'assets/Isologo Prospectiva Final-02.png');
        } else {
            // $('.header').css({
            //     'background': 'none',
            //     'border-bottom': 'none'
            // });
            // $('.bar').css('background-color', bgWhite);
            // $('.header__logo--img').css('transform', 'scale(1)');
            $('.header__logo--img').attr('src', 'assets/Isologo Prospectiva Final-06.png');
            $('.header').removeClass('active');
            // updateHeaderPadding(); // Llamamos a la función para actualizar el padding-top
        }
    });

    // $(window).on('resize', function() {
    //     updateHeaderPadding(); // Llamamos a la función para actualizar el padding-top
    // });

    $('.nav-burguer').click(function() {
        $('.header__navigation').toggleClass('active');
        $('.nav-burguer').toggleClass('active');
        $('body').toggleClass('active');
    });
    $('.header__navigation--list a').on('click', function() {
        $('.nav-burguer').toggleClass('active');
        $('.header__navigation').toggleClass('active');
      });
});
