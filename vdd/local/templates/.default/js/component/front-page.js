BX.ready(function () {

    let width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    // const sliderList = [...document.querySelector('.slider-wrapper').children]
    // for (item of sliderList) {
    // 	if (document.body.clientWidth < 767) {
    // 		item.querySelector('img').dataset.lazy = item.querySelector('img').dataset.mobile
    // 	} else if (document.body.clientWidth > 767) {
    // 		item.querySelector('img').dataset.lazy = item.querySelector('img').dataset.desctop
    // 	}
    // }

    let resizeWindow;
    width < 767 ? resizeWindow = false : resizeWindow = true
    const addTopSlider = (w) => {
        if (w) width = w
        $('.slider-wrapper').on('init', function (event, slick) {
            if (width < 767) {
                setTimeout(() => {
                    if (slick.$dots != null) slick.$dots[0].style.opacity = '1'
                }, 500);
            }
        });
        $('.slider-wrapper').slick({
            draggable: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            dots: false,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        dots: true
                    }
                }
            ],
            customPaging: function (slider, i) {
                return '<button></button>';
            }
        })
    }
    addTopSlider()

    const gridCol = document.querySelectorAll('.grid-col')
    gridCol.forEach(item => {
        if (width < 768) {
            item.dataset.mobile ? item.style.backgroundImage = item.dataset.mobile : ''
        } else {
            item.style.backgroundImage = item.dataset.desctop
        }
    })
    const addHomeSlider = () => {
        if (document.body.clientWidth < 767) {
            $('.home-week--wrap').slick({
                draggable: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            });
            $('.home-notes--wrap').slick({
                draggable: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false
            });
        }
    }
    if (width < 767) addHomeSlider()

    const reinitSlider = () => {
        const slider = document.querySelector('.slider')
        const main = document.querySelector('main')
        const week = document.querySelector('.home-week')

        if (document.body.clientWidth < 767 && resizeWindow == true) {
            // $('.slider-wrapper').slick('unslick')
            // main.removeChild(slider)
            // setTimeout(() => {
            // 	main.insertBefore(slider, week)
            // 	// for (item of sliderList) {
            // 	// 	item.querySelector('img').dataset.lazy = item.querySelector('img').dataset.mobile
            // 	// 	item.querySelector('img').src = item.querySelector('img').dataset.mobile
            // 	// }
            // 	setTimeout(() => {
            // 		addTopSlider(document.body.clientWidth)
            // 	}, 100);
            // }, 100);
            addHomeSlider()
            resizeWindow = false
        } else if (document.body.clientWidth > 767 && resizeWindow == false) {
            // $('.slider-wrapper').slick('unslick')
            // main.removeChild(slider)
            // setTimeout(() => {
            // 	main.insertBefore(slider, week)
            // 	setTimeout(() => {
            // 		for (item of sliderList) {
            // 			item.querySelector('img').dataset.lazy = item.querySelector('img').dataset.desctop
            // 			item.querySelector('img').src = item.querySelector('img').dataset.desctop
            // 		}
            // 		setTimeout(() => {
            // 			addTopSlider(document.body.clientWidth)
            // 		}, 100);
            // 	}, 100);
            // }, 100);
            $('.home-week--wrap').slick('unslick')
            $('.home-notes--wrap').slick('unslick')
            resizeWindow = true
        }
    }
    //Resize
    window.addEventListener('resize', reinitSlider)
    document.body.style.opacity = '1';
});