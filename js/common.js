$(document).ready(function () {
    $('.mobile_nav').click(function () {
        $('.nav').slideToggle('normal');
    });

    $('#close_menu_tab').click(function () {
        $('.menu-tab').fadeOut('500');
    });

    $('#open-order-window').click(function () {
        $('.order-wrapper').fadeIn('500');
    });

    $('.close-order').click(function () {
        $('.order-wrapper').fadeOut('500');
    });

    $('.slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 900,
        autoplay: false,
        autoplaySpeed: 5000,
        fade: true,
        cssEase: 'linear',
        responsive: [
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
                arrows: false
              }
            },

        ]
    });


    $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: false,
          asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          dots: false,
          arrows: false,
          centerMode: false,
          focusOnSelect: true
    });

    $('.item-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 900,
        autoplay: false,
        autoplaySpeed: 5000,
        fade: true,
        cssEase: 'linear'
    });


    var $root = $('html, body');
    $('.menuLink').click(function() {
        $root.animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 1500);
        return false;
    });

    $(window).scroll(function () {
    if($(this).scrollTop() > 160)
    {
        if (!$('.header-bottom').hasClass('header-fixed'))
        {
            $('.header-bottom').stop().addClass('header-fixed').css('top', '-86px').animate(
                {
                    'top': '0px'
                }, 700);
        }
    }
    else
    {
        $('.header-bottom').removeClass('header-fixed');
    }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 160) {
            $('.navbar').addClass('slideup');
        } else {
            $('.navbar').removeClass('slideup');
        }
    });

    
});


