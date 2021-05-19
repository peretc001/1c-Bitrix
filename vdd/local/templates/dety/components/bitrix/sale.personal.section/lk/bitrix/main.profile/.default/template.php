<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;


Loader::IncludeModule("highloadblock");

$hlbl = 8; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("ID" => "ASC"),
    "filter" => array("UF_USER_ID" => $USER->GetID())  // Задаем параметры фильтра выборки
));



Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/account/account.min.css');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/component/account.js');

#Add to delivery
Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1?apikey=c57f1f7d-1b5e-46b5-8a3c-28866f6be64d&lang=ru_RU"></script>');
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/account/add2delivery.min.css');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/component/add2delivery.js');

//debug($arResult["arUser"]);
$bonus = CSaleUserAccount::GetByUserID($USER->GetID(), "RUB");
if (isset($bonus)) {
    $bonus = number_format($bonus["CURRENT_BUDGET"]);
} else {
    $bonus = 0;
}

CModule::IncludeModule("sale");
$bonuseHistory = CSaleUserTransact::GetList(array("ID" => "DESC"), array("USER_ID" => $USER->GetID()));
if (isset($bonuseHistory)) {
    $bonuseHistoryRes = [];
    while ($arFields = $bonuseHistory->Fetch()) {
        if ($arFields["DEBIT"] == "Y") {
            $bonuseHistoryRes['DEBIT'][] = ['TRANSACT_DATE' => date('d.m.Y', strtotime($arFields["TRANSACT_DATE"])), 'AMOUNT' => number_format($arFields["AMOUNT"])];
        } else {
            $bonuseHistoryRes['CREDIT'][] = ['TRANSACT_DATE' => date('d.m.Y', strtotime($arFields["TRANSACT_DATE"])), 'AMOUNT' => number_format($arFields["AMOUNT"])];
        }
    }
}


//CSaleUserAccount::UpdateAccount($USER->GetID(), 100, 'RUB', "Бонус за покупку");
?>
<section class="account">
    <div class="container">
        <h1>Личный кабинет</h1>
        <?
        ShowError($arResult["strProfileError"]);

        if ($arResult['DATA_SAVED'] == 'Y') {
//            ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
        }

        ?>
        <div class="row">
            <ul class="account-menu">
                <li class="active"><a href="/personal/private/">Профиль</a></li>
                <li><a href="/personal/orders/">История заказы</a></li>
                <li><a href="/personal/wishlist/">Избранные товары</a></li>
            </ul>
        </div>

        <div class="row account-profile">
            <div class="account-profile__wrap">

                <form method="post" name="form1" action="<?= POST_FORM_ACTION_URI ?>" enctype="multipart/form-data"
                      role="form" class="account-data">
                    <?= $arResult["BX_SESSION_CHECK"] ?>
                    <input type="hidden" name="lang" value="<?= LANG ?>"/>
                    <input type="hidden" name="ID" value="<?= $arResult["ID"] ?>"/>
                    <input type="hidden" name="LOGIN" value="<?= $arResult["arUser"]["LOGIN"] ?>"/>
                    <h2>Ваш профиль</h2>
                    <div class="account-data-info">
                        <div class="account-data-info__img">
                            <?php if ($arResult["arUser"]["UF_GENDER"] == 4): ?>
                                <img src="/local/templates/.default/img/personal/personal-man.svg" alt="">
                            <?php elseif ($arResult["arUser"]["UF_GENDER"] == 5): ?>
                                <img src="/local/templates/.default/img/personal/personal-woman.svg" alt="">
                            <?php else: ?>
                                <img src="/local/templates/.default/img/personal/personal-pol.svg" alt="">
                            <?php endif; ?>
                        </div>

                        <div class="account-data-private-wrap">
                            <div class="account-data-private">

                                <div class="form-row">
                                    <label for="main-profile-last-name"><?= Loc::getMessage('LAST_NAME') ?></label>
                                    <input class="form-control" type="text" name="LAST_NAME" maxlength="50"
                                           id="main-profile-last-name" value="<?= $arResult["arUser"]["LAST_NAME"] ?>"
                                           pattern="^[А-Яа-яЁё\s]+$"/>
                                    <span>Введите Фамилию на русском языке</span>
                                </div>
                                <div class="form-row">
                                    <label for="main-profile-name"><?= Loc::getMessage('NAME') ?></label>
                                    <input class="form-control" type="text" name="NAME" maxlength="50"
                                           id="main-profile-name"
                                           value="<?= $arResult["arUser"]["NAME"] ?>"
                                           pattern="^[А-Яа-яЁё\s]+$"
                                    />
                                    <span>Введите Имя на русском языке</span>
                                </div>
                                <div class="form-row">
                                    <label for="main-profile-second-name"><?= Loc::getMessage('SECOND_NAME') ?></label>
                                    <input class="form-control" type="text" name="SECOND_NAME" maxlength="50"
                                           id="main-profile-second-name"
                                           value="<?= $arResult["arUser"]["SECOND_NAME"] ?>"
                                           pattern="^[А-Яа-яЁё\s]+$"
                                    />
                                    <span>Введите Отчество на русском языке</span>
                                </div>
                                <div class="form-row">
                                    <label for="main-profile-second-name"><?= Loc::getMessage('PERSONAL_PHONE') ?></label>
                                    <input type="text" id="userphone" class="phone-mask" name="PERSONAL_PHONE"
                                           maxlength="50"
                                           value="<?= $arResult["arUser"]["PERSONAL_PHONE"] ?>"/>
                                    <span>Введите телефон</span>
                                </div>
                                <div class="form-row">
                                    <label for="main-profile-email"><?= Loc::getMessage('EMAIL') ?></label>
                                    <input class="form-control" type="text" name="EMAIL" maxlength="50"
                                           id="main-profile-email"
                                           value="<?= $arResult["arUser"]["EMAIL"] ?>"
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                    />
                                    <span>Введите корректный Email</span>
                                </div>
                                <div class="form-row"></div>

                                <div class="form-row">
                                    <label for="main-profile-date-birth"><?= Loc::getMessage('UF_DATE_BIRTH') ?></label>
                                    <input class="form-control" type="text" name="UF_DATE_BIRTH" maxlength="50"
                                           id="main-profile-date-birth"
                                           value="<?= $arResult["arUser"]["UF_DATE_BIRTH"] ?>"
                                    />
                                    <span>Введите корректную дату рождения</span>
                                </div>

                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label"><?= Loc::getMessage('UF_GENDER') ?></legend>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="UF_GENDER"
                                                   id="main-profile-gender-man" value="4"
                                                <?= $arResult["arUser"]["UF_GENDER"] == 4 ? 'checked' : '' ?>
                                            >
                                            <label class="form-check-label"
                                                   for="main-profile-gender-man"><?= Loc::getMessage('UF_GENDER_MAN') ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="UF_GENDER"
                                                   id="main-profile-gender-woman" value="5"
                                                <?= $arResult["arUser"]["UF_GENDER"] == 5 ? 'checked' : '' ?>
                                            >
                                            <label class="form-check-label"
                                                   for="main-profile-gender-woman"><?= Loc::getMessage('UF_GENDER_WOMAN') ?></label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <input type="submit" class="btn btn-accent main-profile-submit" name="save"
                                   value="<?= (($arResult["ID"] > 0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD")) ?>">

                        </div>
                    </div>
                </form>
            </div>

            <div class="account-data account-card">
                <h2>Платёжные карты</h2>
                <p class="account-data__text">
                    Сохраните в личном кабинете платёжную карту<br/>
                    и оплачивайте заказы в один клик
                </p>

                <button class="account-data__add-card">
                    <img src="/local/templates/.default/img/personal/plus.svg" alt="">
                    Добавить<br/>
                    новую карту
                </button>
            </div>

            <div class="account-address-wrap">
                <div class="account-data account-delivery-addresses">
                    <h2>Адреса доставки</h2>
                    <ul class="account-data__address">
                        <?php while ($arItem = $rsData->Fetch()): $address = true;?>
                            <li class="account-data__address-item <?= $arItem['UF_ADDRESS_FAVORITE'] == 1 ? 'active' : '' ?>" data-id="<?=$arItem['ID']?>">
                                <span class="account-data__address-item-favorite"></span>
                                <span><?=$arItem['UF_CITY']?>,<?=$arItem['UF_STREET']?>,<?=$arItem['UF_HOUSE_NUMBER']?></span>
                                <span class="account-data__address-item-delete">
                                    <img src="/local/templates/.default/img/personal/trashcan.svg" alt="">
                                </span>
                            </li>
                        <?php endwhile;?>
                    </ul>
                    <?php if(!$address):?>
                    <p class="account-data__text">
                        У вас пока нет сохранённых адресов доставки
                    </p>
                    <?php endif;?>
                    <button class="btn btn-accent">
                        Добавить новый адрес доставки
                    </button>

                    <div id="map"></div>
                </div>

                <div class="account-data account-pickup-points">
                    <h2>Пункты самовывоза</h2>

                    <p class="account-data__text">
                        У вас пока нет сохранённых пунктов самовывоза
                    </p>

                    <button class="btn btn-accent">
                        Добавить новый пункт самовывоза
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Add to delivery point -->
<div class="suggest">
    <input type="text" id="suggest" class="input" placeholder="Введите адрес доставки...">
    <span type="button" id="suggest-clear"></span>
    <button type="submit" id="find"></button>
</div>
<form action="/" class="js-delivery" method="post">
    <p class="js-adress">Улица</p>
    <p class="js-city">Город</p>
    <input type="hidden" id="delivery-user" name="delivery-user" value="<?=$USER->GetID()?>">
    <input type="hidden" id="delivery-country" name="delivery-country">
    <input type="hidden" id="delivery-city" name="delivery-city">
    <input type="hidden" id="delivery-adress" name="delivery-adress">
    <div class="form-group">
        <div class="form-item js-number">
            <input type="text" name="delivery-number" id="delivery-number" placeholder="Номер">
            <label for="delivery-number">Дом</label>
        </div>
        <div class="form-item">
            <input type="tel" name="delivery-flat" id="delivery-flat" placeholder="Номер">
            <label for="delivery-flat">Квартира</label>
        </div>
        <div class="form-item chb">
            <input type="checkbox" name="delivery-house" id="delivery-house">
            <label for="delivery-house">Частный дом</label>
        </div>
    </div>
    <div class="form-group">
        <div class="form-item">
            <input type="tel" name="delivery-entrance" id="delivery-entrance" placeholder="Номер">
            <label for="delivery-entrance">Подъезд</label>
        </div>
        <div class="form-item">
            <input type="tel" name="delivery-doorphone" id="delivery-doorphone" placeholder="Номер">
            <label for="delivery-doorphone">Домофон</label>
        </div>
        <div class="form-item">
            <input type="tel" name="delivery-floor" id="delivery-floor" placeholder="Номер">
            <label for="delivery-floor">Этаж</label>
        </div>
    </div>
    <button type="submit" class="btn btn-accent">Выбрать</button>
</form>
<!-- Add to delivery point -->
