BX.ready(function() {
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map('map', {
                center: [45.058434,39.032428],
                zoom: 15,
                controls: ['fullscreenControl'],
            }, {
                searchControlProvider: 'yandex#search'
            }),


            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            }, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: '<?=DEFAULT_TEMPLATE_PATH?>/img/favicon.svg',
                // Размеры метки.
                iconImageSize: [30, 42],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-5, -38]
            });

        myMap.behaviors.disable('scrollZoom')

        myMap.geoObjects
            .add(myPlacemark)

        $('.open-map').on('click', function () {
            $('#map').addClass('maxMap')
            myMap.container.enterFullscreen()
            myMap.container.fitToViewport();
        });

        myMap.events.add('boundschange', function (e) {
            if ( myMap.container.isFullscreen() == false ) $('#map').removeClass('maxMap');
        });
    }

})