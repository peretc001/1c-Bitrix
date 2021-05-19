// Check is mobile
var isMobile = function() {
    return (/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera);
}

// Initialize search form in header.
var initSearchForm = function() {
    var HS = $( '.header__search' );

    // Open search form
    $( '.sf-open' ).on( 'click', function( e ) {
        e.preventDefault();
        HS.fadeIn();
        HS.find( 'input[type="text"]' ).focus();
    });
    $( '#sf-close' ).on( 'click', function() {
        HS.fadeOut();
    });
}


$('.js-slider-1').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    $(".slider-2__fix").addClass("active");
    $(".slider-2__item").removeClass("active");
    $(".slider-2__item[data-item=" + nextSlide + "]").addClass("active");
    var swipeDir = slick.swipeDirection();
    if (swipeDir == "left") {
        $(".js-slider-2 .slick-next").click();
    }
    if (swipeDir == "right") {
        $(".js-slider-2 .slick-prev").click();
    }
});
$('.js-slider-1').on('afterChange', function (event, slick, currentSlide, nextSlide) {
    $(".slider-2__fix").removeClass("active");
    if ($(".slider-2__item.active").hasClass("slick-active")) {
        return;
    } else {
        $(".js-slider-2").slick("slickGoTo", currentSlide);
    }
});
$(".js-slider-link").live("click", function () {
    var curData = $(this).closest(".js-slider-item").data("item");
    $(".js-slider-1").slick("slickGoTo", curData);
})
$(".slider-1__prev").live("click", function () {
    $(".js-slider-2 .slick-prev").click();
})
$(".slider-1__next").live("click", function () {
    $(".js-slider-2 .slick-next").click();
})


var backToTop = function() {
    var el = $( '#jas-backtop' );
    $( window ).scroll(function() {
        if( $( this ).scrollTop() > $( window ).height() ) {
            el.show();
        } else {
            el.hide();
        }
    });
    el.click( function() {
        $( 'body,html' ).animate({
            scrollTop: 0
        }, 500);
        return false;
    });
}