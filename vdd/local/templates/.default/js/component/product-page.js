//TODO  Сделать мин версию скрипта
//TODO Сделать ограничение добавления в корзину по количеству
//TODO Обновлять ТЕГ Скидка
//TODO Починить кнопку в Одинк клик после ajax

//TODO Не работает Избранное и добавление в корзину если нет похожих или просмотренных товаров, так как js лежит в catalog.item


BX.ready(function(){
    const chLocation = function(loc) {
        try {
            history.pushState({}, '', loc);
            return;
        } catch(e) {}
        location.hash = '#' + loc;
    }

    const thumb = document.querySelectorAll('.products-page-body__item__left__thumb li')
    let slideCount = thumb.length
    if (thumb.length <= 6) {
        thumb.forEach((item,index) => {
            item.addEventListener('click', () => {
                document.querySelector('.products-page-body__item__left__thumb li.slick-current').classList.remove('slick-current')
                item.classList.add('slick-current')
                imgSlider.slick('slickGoTo', index)
            })
        })
    }

    const thumbSlider = $('.products-page-body__item__left__thumb').slick({
        vertical: true,
        infinite: thumb.length > 6 ? true : false,
        slidesToShow: 6,
        asNavFor: thumb.length > 6 ? '.products-page-body__item__right__img__wrapp' : false,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 5,
                }
            }
        ]
    });

    const imgSlider = $('.products-page-body__item__right__img__wrapp').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: true,
        asNavFor: '.products-page-body__item__left__thumb',
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    arrows: false,
                    dots: true
                }
            }
        ]
    });

    const disableScroll = () => {
        document.body.classList.add('no-scroll')
    }
    const enableScroll = () => {
        document.body.classList.remove('no-scroll')
    }

    let galleryIsOpen = false;
    const card = document.querySelector('.products-page-body__item')

    const closeGalleryEsc = () => {
        if (event.keyCode == 27) {
            closeGallery()
        }
    }
    const openGallery = () => {
        if ( galleryIsOpen == false) {
            disableScroll()
            card.classList.add('open')
            setTimeout(() => {
                // document.body.append(card)
                setTimeout(() => {
                    card.classList.add('is-active')
                    imgSlider.slick('setPosition')
                }, 1);
            }, 1);
            galleryIsOpen = true
            document.addEventListener('keydown', closeGalleryEsc)
        } else {
            closeGallery()
        }
    }
    const closeGallery = () => {
        if ( galleryIsOpen == true) {
            card.classList.remove('is-active')
            card.classList.remove('open')
            // const parent = document.querySelector('.products-page-body')
            // const nextElem = document.querySelector('.products-page-body__buy')
            // document.body.removeChild(card)
            // parent.insertBefore(card, nextElem)
            imgSlider.slick('setPosition')
            galleryIsOpen = false
            document.removeEventListener('keydown', closeGalleryEsc)
            enableScroll()
        }
    }

    if (document.body.clientWidth < 767) {
        const imgList = document.querySelectorAll('.products-page-body__item__right__img__wrapp img')
        for(elem of imgList) {
            elem.addEventListener('click', openGallery)
        }
    }
    const zoomBtn = document.querySelector('.products-page-body__item__right__img .zoom')
    const closeBtn = document.querySelector('.products-page-body__item .close')
    zoomBtn.addEventListener('click', openGallery)
    closeBtn.addEventListener('click', closeGallery)

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

    $('[data-fancybox="gallery"]').fancybox({
        loop: true,
        infobar: false,
        toolbar: false,
    });

    if(document.querySelector('.js-offer')) {
        const BLOCK = document.querySelector('.products-page-body__buy')
        sizeVariation = BLOCK.querySelectorAll('.js-size'),
            colorVariation = BLOCK.querySelectorAll('.js-color'),
            PriceOld = BLOCK.querySelector('[data-old]'),
            Price = BLOCK.querySelector('[data-price]'),
            Economy = BLOCK.querySelector('[data-economy]'),
            Bonus = BLOCK.querySelector('[data-bonus]'),
            Credit = BLOCK.querySelector('[data-credit]');

        changeParams = (data, target) => {
            const result = JSON.parse(data)
            let dataPriceOld = +result.old_price,
                dataPrice = +result.price,
                dataQTY = +result.qty,
                dataInbasket = +result.inbasket,
                dataInbasketQTY = +result.inbasketQTY,
                dataEconomy = dataPriceOld - dataPrice,
                dataBonus = dataPrice * 0.02,
                dataCredit = dataPrice * 0.01;

            //TODO: JS Бонусы Скидка Кредит
            BLOCK.querySelector('.products-page-body__buy__price').classList.add('progress')
            setTimeout(() => {
                if(PriceOld) {
                    PriceOld.innerHTML = dataPriceOld.toLocaleString('ru-RU') + ' ₽'
                    PriceOld.dataset.old = dataPriceOld
                }
                Price.innerHTML = dataPrice.toLocaleString('ru-RU') + ' ₽'
                Price.dataset.price = dataPrice
                if(Economy) {
                    Economy.innerHTML = '+' + dataEconomy + ' рублей экономии'
                    Economy.dataset.economy = dataEconomy
                }
                if(Bonus) {
                    Bonus.innerHTML = '+' + dataBonus.toFixed() + ' бонусных рублей'
                    Bonus.dataset.bonus = dataBonus.toFixed()
                }
                if(Credit) {
                    Credit.children[1].innerHTML = dataCredit.toLocaleString('ru-RU')
                    Credit.dataset.credit = dataCredit
                }
                BLOCK.querySelector('.products-page-body__buy__price').classList.remove('progress')
            }, 500)

            const BTN = BLOCK.querySelector('.products-card__buy')
            const div = document.createElement('div')

            //InBasket
            if(dataInbasket) {
                div.classList.add('inBasket')
                div.innerHTML = `<div class="btn hasBasket">
                            <a href="/personal/cart/">В корзине <span>${dataInbasketQTY}</span> шт<br>
                                <small>Перейти</small>
                            </a>
                        </div>
                        <button class="btn addToBasketPlus" data-id="${target.dataset.offer}" data-qty="${dataInbasketQTY}">+1 шт</button>`
                BTN.children[0].classList.add('progress')
                setTimeout(() => {
                    BTN.removeChild(BTN.children[0])
                    BTN.append(div)
                    div.querySelector('.addToBasketPlus').addEventListener('click', addToBasketPlus)
                },500)
            }
            else {
                div.classList.add('addToBasket')
                div.innerHTML = `<button class="btn btn-accent addBtn" data-avalibility="" data-id="${target.dataset.offer}">
                            В корзину
                        </button>
                        <button class="btn btn-outline-yellow" data-id="${target.dataset.offer}" data-toggle="modal" data-target="oneclick">В 1 клик</button>`
                BTN.children[0].classList.add('progress')
                setTimeout(() => {
                    BTN.removeChild(BTN.children[0])
                    BTN.append(div)
                    div.querySelector('.addBtn').addEventListener('click', addToBasket)
                },500)
            }

            if(result.img){
                const ITEM = document.querySelector('.products-page-body__item');
                ITEM.classList.add('progress')
                let ITEM_HEIGHT = ITEM.clientHeight
                ITEM.style.height = ITEM_HEIGHT +'px'
                ITEM.style.overflow = 'hidden'
                thumbSlider.slick('unslick');
                imgSlider.slick('unslick');
                setTimeout(()=>{
                    thumbContainer = document.querySelector('[data-thumb]')
                    thumbContainer.style.transition = 'opacity .3s ease'
                    thumbContainer.style.opacity = 0
                    setTimeout(() => {
                        thumbContainer.innerHTML = ''
                        result.img.THUMB.forEach(item => {
                            let li = document.createElement('li')
                            li.innerHTML = '<img src="'+ item +'">';
                            thumbContainer.append(li)
                        })
                    }, 300)

                    imgContainer = document.querySelector('[data-image]')
                    imgContainer.style.transition = 'opacity .3s ease'
                    imgContainer.style.opacity = 0
                    setTimeout(() => {
                        imgContainer.innerHTML = ''
                        result.img.IMG.forEach(item => {
                            let li = document.createElement('li')
                            li.innerHTML = '<img src="'+ item +'">';
                            imgContainer.append(li)
                        })
                    }, 300)
                    setTimeout(() => {
                        thumbSlider.slick({
                            vertical: true,
                            infinite: thumb.length > 6 ? true : false,
                            slidesToShow: 6,
                            asNavFor: thumb.length > 6 ? '.products-page-body__item__right__img__wrapp' : false,
                            focusOnSelect: true,
                            arrows: false,
                            responsive: [
                                {
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 4,
                                    }
                                },
                                {
                                    breakpoint: 991,
                                    settings: {
                                        slidesToShow: 5,
                                    }
                                }
                            ]
                        });
                        imgSlider.slick({
                            infinite: true,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            draggable: true,
                            asNavFor: '.products-page-body__item__left__thumb',
                            responsive: [
                                {
                                    breakpoint: 767,
                                    settings: {
                                        arrows: false,
                                        dots: true
                                    }
                                }
                            ]
                        });
                        thumbContainer.style.opacity = 1
                        imgContainer.style.opacity = 1
                        ITEM.style.height = ''
                        ITEM.style.overflow = ''
                        ITEM.classList.remove('progress')
                        if (document.body.clientWidth < 767) {
                            const imgSliderList = document.querySelectorAll('.products-page-body__item__right__img__wrapp img')
                            for(elem of imgSliderList) {
                                elem.addEventListener('click', openGallery)
                            }
                        }
                    },500)

                },100)
            }
            if(result.sizes) {
                const SIZE = document.querySelector('.products-page-body__buy__size__block')
                if(SIZE) {
                    SIZE.innerHTML = ''
                    for (let index in result.sizes) {
                        let link = document.createElement('a')
                        link.href = SIZE.dataset.url + '?offer=' + index
                        link.classList.add('js-offer')
                        link.classList.add('js-size')
                        if (index == target.dataset.offer) link.classList.add('active')
                        link.dataset.offer = index
                        link.dataset.url = SIZE.dataset.url
                        link.textContent = result.sizes[index]
                        SIZE.append(link)
                        link.addEventListener('click', changeSize)
                    }
                }
            }
            chLocation(target.dataset.url +'?offer='+ target.dataset.offer)
        }

        changeSize = (e) => {
            e.preventDefault()
            $.ajax({
                url: "/ajax/changeoffer.php",
                type: 'post',
                data: {
                    ID: e.target.dataset.offer,
                    BLOCK: 'size'
                },
                success: function (data) {
                    document.querySelector('.js-size.active').classList.remove('active')
                    e.target.classList.add('active')

                    changeParams(data, e.target)
                }
            })
        }

        changeColor = (e) => {
            e.preventDefault()
            $.ajax({
                url: "/ajax/changeoffer.php",
                type: 'post',
                data: {
                    ID: e.target.dataset.offer,
                    BLOCK: 'color'
                },
                success: function (data) {
                    document.querySelector('.js-color.active').classList.remove('active')
                    e.target.classList.add('active')

                    changeParams(data, e.target)
                }
            })
        }

        sizeVariation.forEach(item => item.addEventListener('click', changeSize))
        colorVariation.forEach(item => item.addEventListener('click', changeColor))
    }

    // Back to top button
    let backToTop = function() {
        var el = $( '.toTop' );
        el.hide()
        $( window ).scroll(function() {
            if( $( this ).scrollTop() < 50 ) {
                el.fadeOut();
            } else {
                el.fadeIn();
            }
        });
        el.click( function() {
            $( 'body,html' ).animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    }
    backToTop()

    if ( document.querySelector('[data-target="review"]') ) {
        //Input file
        let inputs = document.querySelectorAll('.input__file')
        inputs.forEach(input =>{
            let label = input.nextElementSibling,
                labelVal = label.querySelector('.input__file-button-text').innerText;

            input.addEventListener('change', function (e) {
                let countFiles = '';
                if (this.files && this.files.length >= 1) {
                    countFiles = this.files.length;
                    label.classList.add('active')
                } else {
                    label.classList.remove('active')
                }

                if (countFiles)
                    label.querySelector('.input__file-button-text').innerText = 'Выбрано файлов: ' + countFiles;
                else
                    label.querySelector('.input__file-button-text').innerText = labelVal;
            });
        });
    }



    $('.review_form').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData();

        let review = $('.review_form').serialize()

        formData.append("ID", document.querySelector('.js-add-review').dataset.product);
        formData.append("ACTION", 'add');
        formData.append("REVIEW", review);

        let photo = document.getElementById("input__file");
        if (photo.files.length > 0) {
            for (let x = 0; x < photo.files.length; x++) {
                formData.append(x, photo.files[x]);
            }
        }
        if (
            $('[name="user"]').val().length > 0 &&
            $('[name="advantage"]').val().length > 0 &&
            $('[name="review_comment"]').val().length > 0
        ) {

            $.ajax({
                url: "/ajax/add2review.php",
                type: 'post',
                data: formData,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                success: function (responce) {
                    let data = JSON.parse(responce);
                    if (data.status) {
                        $('.modal-body.review .close').trigger('click');
                        setTimeout(() => {
                            location.reload();
                        },1000)
                    } else {
                        console.log('error')
                    }
                }
            })
        } else {
            console.log('Пиздец какой-то')
        }
    });

    function likeDislike(arg, elem) {
        const id = elem.dataset.review
        if (!elem.classList.contains('disabled')) {
            $.ajax({
                url: "/ajax/add2review.php",
                type: 'post',
                data: {
                    ID: id,
                    ACTION: arg
                },
                success: function (responce) {
                    let data = JSON.parse(responce);
                    if (data.status) {
                        if (arg == 'like') {
                            elem.textContent = data.like
                            elem.classList.add('disabled')
                            elem.nextElementSibling.classList.add('disabled')
                        } else {
                            elem.textContent = data.dislike
                            elem.classList.add('disabled')
                            elem.previousElementSibling.classList.add('disabled')
                        }
                    } else {
                        console.log('error')
                    }
                }
            })
        }
    }

    document.querySelectorAll('.like-block .like').forEach(item => {
        item.addEventListener('click', () => {
            likeDislike('like', item)
        })
    });
    document.querySelectorAll('.like-block .dislike').forEach(item => {
        item.addEventListener('click', () => {
            likeDislike('dislike', item)
        })
    });

    $('.js-quote').on('click', function() {
        event.preventDefault();
        jQuery("html, body").animate({ scrollTop: jQuery(jQuery(this).attr("href")).offset().top }, 500);
    });
});