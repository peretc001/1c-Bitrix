BX.ready(function() {

    if ($('div').hasClass('code')) {
        $('.code-input').on('keydown', function (e) {
            let value = $(this).val();
            let len = value.length;
            let curTabIndex = parseInt($(this).attr('tabindex'));
            let nextTabIndex = curTabIndex + 1;
            let prevTabIndex = curTabIndex - 1;
            if (len > 0 && e.key != 'Backspace') {
                $(this).val(value.substr(0, 1));
                $('[tabindex=' + nextTabIndex + ']').focus();
            } else if (len == 0 && prevTabIndex !== 0) {
                $('[tabindex=' + prevTabIndex + ']').focus();
            }
        });
    }

    if( document.querySelector('.setPromocode') ) {
        $('.setPromocode').on('submit', function (e) {
            e.preventDefault();
            let formData = $('.setPromocode').serialize();
            $.ajax({
                url: "/ajax/add2promocode.php",
                type: 'post',
                data: formData,
                success: function (response) {
                    let data = JSON.parse(response)
                    if (data.status) {
                        location.reload()
                    } else {
                        $('.setPromocode .error').html('Купон ' + data.message)
                        $('.setPromocode').trigger('reset');
                        $('.setPromocode').find('input')[0].focus();
                    }
                }
            });
        });

        $('.cart-total.code .promo').on('click', '.delete', function(e) {
            e.preventDefault();

            $.ajax({
                url: "/ajax/add2promocode.php",
                type: 'post',
                data: 'clear=true',
                success: function (response) {
                    let data = JSON.parse(response)
                    if (data.status) {
                        location.reload()
                    } else {
                        console.log(data.message);
                    }
                }
            });

        })
    }



    if ($('div').hasClass('resent-products')) {
        $('.resent-products').slick({
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
    if ($('div').hasClass('visited-products')) {
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

    if ( document.querySelector('.addToCart') ) {
        const addToCart = document.querySelectorAll('.addToCart');

        addToCartEvent = (event) => {

            let maxQTY = event.target.closest('.products-card__add').dataset.maxqty;

            event.target.parentNode.classList.add('process')

            $.ajax({
                url: "/ajax/add2basket.php",
                type: 'post',
                data: {
                    ID: event.target.dataset.id
                },
                success: function (responce) {
                    let data = JSON.parse(responce);
                    if(data.status){
                        location.reload()
                    }
                    else
                    {
                        console.log('error')
                    }
                }
            })
        };

        addToCart.forEach(item => {
            item.addEventListener('click', addToCartEvent)
        });
    }
})