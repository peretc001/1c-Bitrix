<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/delivery/delivery.min.css');
Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1?apikey=c57f1f7d-1b5e-46b5-8a3c-28866f6be64d&lang=ru_RU"></script>');
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?><div class="delivery">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <h1>Доставка и оплата</h1>
                <div class="delivery-head">
                    <p>Доставляем в <a href="#" class="open-city" data-toggle="modal" data-target="city"><? global $city; echo $city ?></a> и по всей России</p>
                    <p><a href="/point/">59 пунктов выдачи</a> в Краснодаре - посмотреть <a class="set-position" href="#">на карте</a></p>
                </div>
                <div class="delivery-type">
                    <div class="delivery-type--item">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/delivery1.svg" alt="Самовывоз из магазина">
                        <p>Самовывоз <i>из магазина</i></p>
                        <p class="marked"><b>0 ₽</b></p>
                    </div>
                    <div class="delivery-type--item">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/delivery2.svg" alt="Самовывоз с пункта выдачи">
                        <p>Самовывоз с <i>пункта выдачи</i></p>
                        <p class="marked"><b>99 ₽</b></p>
                    </div>
                    <div class="delivery-type--item">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/delivery3.svg" alt="Доставка курьером">
                        <p>Доставка <i>курьером</i></p>
                        <p class="marked"><b>299 ₽</b></p>
                    </div>
                </div>
                <div class="delivery-free">
                    <p>Бесплатная доставка от 3 000 ₽</p>
                    <a href="#">Подробные условия доставки</a>
                </div>
            </div>
            <div class="col-lg-7 delivery-package">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/package.png" alt="">
            </div>
        </div>

        <h2>Оплата заказа</h2>
        <div class="delivery-pay">
            <div class="delivery-pay--caption">
                Принимаем к оплате карты:
            </div>
            <div class="delivery-pay--cards">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/visa.png" alt="">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/mastercrd.png" alt="">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/xalva.png" alt="">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/hcb.png" alt="">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/delivery/sovest.png" alt="">
            </div>
        </div>

        <div class="delivery-button">
            <div class="delivery-button--item icon-checkbox">
                <p class="online">Онлайн картой <span>на сайте</span></p>
            </div>
            <div class="delivery-button--item icon-checkbox">
                <p class="upon">Наличными или картой при получении</span></p>
            </div>
            <div class="delivery-button--item icon-checkbox">
                <p class="credit">Онлайн кредит <a href="">Подробные условия</a></p>
            </div>
        </div>
    </div>
    <div id="map"></div>
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
                url: "<?=DEFAULT_TEMPLATE_PATH?>/point.json"
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

            $('.set-position').on('click', function (e) {
                e.preventDefault();
                console.log('123');
                $('#map').addClass('maxMap')
                myMap.container.enterFullscreen()
                myMap.container.fitToViewport();
            });

            myMap.behaviors.disable('scrollZoom')

            myMap.events.add('boundschange', function (e) {
                if ( myMap.container.isFullscreen() == false ) $('#map').removeClass('maxMap');
            });

        }

        })
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>