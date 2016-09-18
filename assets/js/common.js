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
    $('.menuLink').click(function () {
        $root.animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 1500);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 160) {
            if (!$('.header-bottom').hasClass('header-fixed')) {
                $('.header-bottom').stop().addClass('header-fixed').css('top', '-86px').animate(
                    {
                        'top': '0px'
                    }, 700);
            }
        }
        else {
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

function _search(event) {
    var search_value = $('#search').val();

    search_value = search_value.replace(/[%\\\/\^]/g, '');

    var key = event.keyCode;

    if (key === 13) {
        var host_url_part = 'http://' + window.location.hostname;

        if (search_value != '') {
            var url_search_key = host_url_part + '/index.php?route=product/search&search=' + encodeURIComponent(search_value);

            window.location.href = url_search_key;
        }

    }
}

function _searchButton(event) {
    var search_value = $('#search').val();
    search_value = search_value.replace(/[%\\\/\^]/g, '');

    if (event.type == 'click') {
        var host_url_part = 'http://' + window.location.hostname;

        if (search_value != '') {
            var url_search_key = host_url_part + '/index.php?route=product/search&search=' + encodeURIComponent(search_value);

            window.location.href = url_search_key;
        }
    }
}

function saveOrder() {
    $.ajax({
        url: '/index.php?route=product/product/addOrder',
        type: 'post',
        data: $('#form_callback').serialize(),
        dataType: 'json',
        success: function (response) {
            $('.error-name').hide();
            if (!response.status) {
                for (var key in response.error) {
                    $('#order_error_' + key).show();
                }
            } else {
                $('#form_callback')[0].reset();
                $('.order-wrapper').hide();
                $('#order_thanks').fadeIn(2000);
                setTimeout(function() {
                    $('#order_thanks').fadeOut(2000);
                }, 2000);
            }
        }
    });
}
function searchAutocomplete(event) {
    if (event.keyCode != 13) {
        var search_block;
        var search_result;
        var search_url;

        search_block = $('#search');
        search_result = $('.search-block');

        search_url = '/index.php?route=product/search/autocomplete';

        search_block.autocomplete({
            source: function (request, response) {

                var value = request.term.replace(/[%\\\/\^]/g, '');

                $.ajax({
                    type: 'POST',
                    url: search_url,
                    data: {
                        nameStartsWith: value
                    },
                    success: function (data) {
                        if(data) {
                            search_result.html(data);
                            search_result.css('display', 'block');
                        } else {
                            search_result.html('');
                            search_result.hide();
                        }
                    }
                });
            },
            minLength: 0
        });

        search_result.mouseleave(function () {
            search_result.hide();
        });

        $('.search').mouseenter(function () {
            if (search_result.html()) {
                search_result.show();
            }
        });

    } else {
        _search(event);
    }
}

