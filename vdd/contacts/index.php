<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/contact/contact.min.css');
Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1?apikey=c57f1f7d-1b5e-46b5-8a3c-28866f6be64d&lang=ru_RU"></script>');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/component/contact-page.js');
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

global $company;
$company = 'yes';
?><div class="contact">
    <div class="container">
        <div class="contact-head">
            <h1><?$APPLICATION->ShowTitle(false); ?></h1>
        </div>

        <div class="contact-map">
            <div class="map-info">
                <div class="map-info--item">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/contact/phone.svg" alt="">
                    <p>
                        <span>Звоните нам:</span>
                        <a href="tel:88006007727">8-800-600-77-27</a>
                    </p>
                </div>
                <div class="map-info--item">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/contact/email.svg" alt="">
                    <p>
                        <span>Наш e-mail:</span>
                        <a href="mailto:info@vsedlyadetok.ru">info@vsedlyadetok.ru</a>
                    </p>
                </div>
                <div class="map-info--item">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/contact/city.svg" alt="">
                    <p>
                        <span>Мы находимся по адресу:</span>
                        <b>г. Краснодар, ул. <i>Героев-Разведчиков, 26/1</i></b>
                    </p>
                </div>
                <button class="btn btn-outline-accent open-map">Показать на карте</button>
                <button class="btn btn-accent" data-toggle="modal" data-target="question">Задать вопрос</button>
                <button class="btn btn-outline-accent" data-toggle="modal" data-target="company">Показать реквизиты</button>
            </div>

            <div id="map"></div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>