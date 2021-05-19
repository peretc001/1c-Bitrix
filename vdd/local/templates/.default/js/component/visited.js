BX.ready(function() {
    if ( $('div').hasClass('visited-products')) {
        $('.visited-products').slick({
            lazyLoad: 'ondemand',
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: false,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2
                    }
                },
            ]
        });
    }
})