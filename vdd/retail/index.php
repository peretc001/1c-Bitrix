<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Розничные магазины");use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/contact/contact.min.css');
Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1?apikey=c57f1f7d-1b5e-46b5-8a3c-28866f6be64d&lang=ru_RU"></script>');
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>
    <div class="contact point">
        <div class="container">
            <div class="contact-head">
                <h1><?$APPLICATION->ShowTitle(false); ?></h1>
                <p>Ваш город: <a href="#" class="open-city" data-toggle="modal" data-target="city"><? global $city; echo $city ?></a></p>
            </div>

            <div class="contact-map">
                <div class="map-point">
                    <div class="map-point--list">
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                        <div class="map-point--item">
                            <p>Кранодар, ул.Красная 1, д.15</p>
                            <p>Ежедневно 09:00 - 22:00 </p>
                            <p>В среду, 5 февраля, 149 ₽</p>
                            <button class="btn btn-accent set-position">Показать</button>
                        </div>
                    </div>
                </div>

                <div id="map"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const openCity = document.querySelector('.open-city')
            openCity.addEventListener('click', () => {
                document.querySelector('.nav').scrollIntoView({block: "start", behavior: "smooth"})
            })

            ymaps.ready(init);

            function init() {
                var myMap;

                var geolocation = ymaps.geolocation,
                    myMap = new ymaps.Map('map', {
                        center: [55.022,80.976],
                        zoom: 4,
                        controls: ['fullscreenControl', 'zoomControl', 'geolocationControl'],
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    objectManager = new ymaps.ObjectManager({
                        // Чтобы метки начали кластеризоваться, выставляем опцию.
                        clusterize: true,
                        // ObjectManager принимает те же опции, что и кластеризатор.
                        gridSize: 32,
                        clusterDisableClickZoom: false
                    });

                objectManager.objects.options.set('preset', 'islands#violetIcon');
                objectManager.clusters.options.set('preset', 'islands#violetClusterIcons');
                myMap.geoObjects.add(objectManager);

                objectManager.objects.events.add('balloonopen', function (e) {
                    var id = e.get('objectId'),
                        geoObject = objectManager.objects.getById(id);
                    setPoint([geoObject], id);
                });

                function setPoint(geoObject, id) {
                    $('.select-point').on('click', function() {
                        $(this).hide()
                        var currentPoint = geoObject[0].properties.balloonContentHeader + geoObject[0].properties.balloonContentBody
                        $('.change-point .current').html(currentPoint)
                        $('.change-point').addClass('selected')
                        myMap.balloon.close();
                        $('#map').removeClass('maxMap')
                        myMap.container.exitFullscreen()
                        myMap.container.fitToViewport();
                    })
                };

                $.ajax({
                    url: "./point.json"
                }).done(function(data) {
                    objectManager.add(data);
                });

                myMap.events.add('click', function (e) {
                    myMap.balloon.close();
                });

                geolocation.get({
                    provider: 'yandex',
                }).then(function (result) {
                    myMap.setCenter(result.geoObjects.get(0).geometry.getCoordinates(), 4, {duration: 500});
                    setTimeout(() => {
                        result.geoObjects.options.set('preset', 'islands#geolocationIcon');
                        result.geoObjects.get(0).properties.set({
                            balloonContentBody: 'Мое местоположение'
                        });
                        myMap.geoObjects.add(result.geoObjects);
                    }, 1000);
                });

                geolocation.get({
                    provider: 'browser',
                }).then(function (result) {
                    setTimeout(() => {
                        myMap.setCenter(result.geoObjects.get(0).geometry.getCoordinates(), 4, {duration: 500});
                        result.geoObjects.options.set('preset', 'islands#geolocationIcon');
                        myMap.geoObjects.add(result.geoObjects);
                    }, 1000);
                });

                $('.set-position').on('click', function () {
                    if (document.body.clientWidth > 991) {
                        myMap.setCenter([45.022,38.976], 15, {duration: 500});
                    } else {
                        $('#map').addClass('maxMap')
                        myMap.container.enterFullscreen()
                        myMap.container.fitToViewport();
                    }
                });

                myMap.behaviors.disable('scrollZoom')

                myMap.events.add('boundschange', function (e) {
                    if ( myMap.container.isFullscreen() == false ) $('#map').removeClass('maxMap');
                });

            }

        })
    </script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>