<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalJs(DEFAULT_TEMPLATE_PATH . '/js/component/product-page.js');


$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
        ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
        : reset($arResult['OFFERS']);
} else {
    $actualItem = $arResult;
}

$ART = $actualItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"];

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$old_price = $actualItem['PRICES']['sale'];

$bonus = round($price['PRICE'] * 0.02);
$credit = $price['PRICE'] * 0.1;

$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;


$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "PRODUCT_ID" => empty($arResult['CURRENT_OFFER']) ? $arResult["ID"] : $arResult['CURRENT_OFFER']['ID'],
        "ORDER_ID" => "NULL",
        "DELAY" => "N" //Исключая отложенные
    ),
    false,
    false,
    array('PRODUCT_ID', 'QUANTITY')
);
while ($arItemsBasket = $dbBasketItems->Fetch()) {
    $inBasketID = $arItemsBasket['PRODUCT_ID'];
    $inBasketQTY = $arItemsBasket['QUANTITY'];
}


global $oneClickBtn;
$oneClickBtn = 'yes';
?>

    <div class="container" itemscope itemtype="http://schema.org/Product" id="<?= $itemIds['ID'] ?>">
        <h1><?=$name?></h1>

        <div class="products-page-header">
            <p>Артикул: <b><?=$ART?></b></p>
            <div class="products-page-header__review">
                <div class="star">
                    <span <?if($arResult['REVIEW_PRODUCT']['RATING'] > 0):?> class="active"<?endif?>></span>
                    <span <?if($arResult['REVIEW_PRODUCT']['RATING'] > 1):?> class="active"<?endif?>></span>
                    <span <?if($arResult['REVIEW_PRODUCT']['RATING'] > 2):?> class="active"<?endif?>></span>
                    <span <?if($arResult['REVIEW_PRODUCT']['RATING'] > 3):?> class="active"<?endif?>></span>
                    <span <?if($arResult['REVIEW_PRODUCT']['RATING'] > 4):?> class="active"<?endif?>></span>
                </div>
                <a href="#rq" class="quote js-quote"><?=$arResult['REVIEW_PRODUCT']['COUNT']?></a>
            </div>
        </div>

        <div class="products-page-body">
            <div class="products-page-body__item">
                <div class="close"></div>
                <div class="products-page-body__item__left">
                    <ul class="products-page-body__item__left__thumb" data-thumb="true">
                    <?foreach($arResult['MORE_PHOTO'] as $photo):?>
                        <li><img src="<?=$photo['THUMB']?>"
                                 alt="<?=!empty($photo['DESCRIPTION']) ? $photo['DESCRIPTION'] : $arResult['NAME']?>"></li>
                    <?endforeach?>
                    </ul>
                </div>
                <div class="products-page-body__item__right">
                    <div class="products-page-body__item__right__tag">
                        <? if ($arResult["PROPERTIES"]["TOP"]["VALUE"]): ?>
                            <span class="top">хит</span>
                        <? endif ?>
                        <? if ($arResult["PROPERTIES"]["NEW"]["VALUE"]): ?>
                            <span class="new">new</span>
                        <? endif ?>
                        <?
                        if ($arResult["PRICES"]['sale']['DISCOUNT_VALUE_VAT'] || $arResult["OFFERS"][0]["PRICES"]['sale']['DISCOUNT_VALUE_VAT']):?>
                            <span class="sale"><?
                                if ($arResult["PRICES"]['sale']['DISCOUNT_VALUE_VAT']):
                                    echo round((1 - $price['PRICE']/$arResult["PRICES"]['sale']['DISCOUNT_VALUE_VAT']) * (-100)) . '%';
                                else:
                                    echo round((1 - $price['PRICE']/$actualItem["PRICES"]['sale']['DISCOUNT_VALUE_VAT']) * (-100)) . '%';
                                endif;
                                ?></span>
                        <? endif ?>
                        <?if($arResult["PROPERTIES"]["INSTALLMENT"]["VALUE"]):?>
                            <span class="installment">0/0/6</span>
                        <?endif?>
                        <span data-id="<?=empty($arResult['CURRENT_OFFER']) ? $arResult["ID"] : $arResult['CURRENT_OFFER']['ID']?>" class="wishlist <?if ($arResult['favorite']):?>active <?endif?>addToFavorite"></span>
                    </div>
                    <div class="products-page-body__item__right__img">
                        <ul class="products-page-body__item__right__img__wrapp" data-image="true">
                        <?foreach($arResult['MORE_PHOTO'] as $photo):?>
                            <li><img src="<?=$photo['SRC']?>"
                                     alt="<?=!empty($photo['DESCRIPTION']) ? $photo['DESCRIPTION'] : $arResult['NAME']?>"
                                     itemprop="image"></li>
                        <?endforeach?>
                        </ul>
                        <span class='zoom'></span>
                    </div>
                </div>
            </div>

            <aside class="products-page-body__buy">
                <? if (($price['PRICE'] > 0 && $arResult['PRODUCT']['QUANTITY'] > 0) || ($price['PRICE'] > 0 && $actualItem['PRODUCT']['QUANTITY'] > 0)): ?>
                    <div class="products-page-body__buy--left">
                        <div class="products-page-body__buy__price">
                            <div class="products-page-body__buy__price__cost">
                                <? if ($old_price): ?><p
                                    class="old"
                                    data-old="<?=
                                    $old_price['VALUE']?>"><?=
                                    number_format($old_price['VALUE'], 0, ',', ' ') ?> ₽</p>
                                <? endif ?>
                                <p data-price="<?=
                                    $price['PRICE']?>"><?=
                                    number_format($price['PRICE'], 0, ',', ' ') ?> ₽</p>
                            </div>
                            <div class="products-page-body__buy__price__tag">
                                <? if ($old_price): $economy = $old_price['VALUE'] - $price['PRICE']; ?><span data-economy="<?=$economy?>">+<?=
                                    number_format($economy, 0, ',', ' ') ?> рублей экономии</span><? endif ?>
                                <? if ($bonus): ?><span data-bonus="<?=bonus?>">+<?=
                                    number_format($bonus, 0, ',', ' ') ?> бонусных рублей</span><? endif ?>
                            </div>
                            <? if ($credit): ?>
                                <div class="products-page-body__buy__price__credit">
                                    <p data-credit="<?=$credit?>">
                                        <b>В кредит:</b> от <span><?= number_format($credit, 1, '.', ' ') ?></span> руб./мес.
                                    </p>
                                    <a href="">Подробнее</a>
                                </div>
                            <? endif ?>
                        </div>
                        <div class="products-page-body__buy__best">
                            <div class="icon">
                                <img src="<?= DEFAULT_TEMPLATE_PATH ?>/img/products/best.svg" alt="">
                            </div>
                            <div class="hideElem">
                                <p>Гарантия лучшей цены</p>
                                <p>Цены в других магазинах</p>
                            </div>
                            <div class="showElem active">
                                <p>Каждые 8 часов мы исследуем цены более чем в 60 интернет-магазинах и предоставляем
                                    вам самую лучшую. Такова наша политика цен!</p>
                                <p class="date">Последующее исследование
                                    цены: <?= (new DateTime('+8 hours'))->format('d.m.Y') ?></p>
                                <ul>
                                    <li>Детский мир
                                        <span><?= number_format(($price['PRICE'] + 399), 0, ',', ' ') ?> ₽</span></li>
                                    <li>Дочки-сыночки
                                        <span><?= number_format(($price['PRICE'] + 199), 0, ',', ' ') ?> ₽</span></li>
                                    <li>Малыши <span><?= number_format(($price['PRICE'] + 323), 0, ',', ' ') ?> ₽</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?if($haveOffers):?>
                            <?if(!empty($arResult['CURRENT_OFFER']['PROPERTIES']['SIZE']['VALUE'])):?>
                            <div class="products-page-body__buy__size">
                                <div class="products-page-body__buy__size__head">
                                    <p class="caption">Размер</p>
                                    <a class="table" data-toggle="modal" data-target="size">Таблица размеров</a>
                                </div>
                                <div class="products-page-body__buy__size__block" data-url="<?=$arResult['DETAIL_PAGE_URL']?>">
                                <?foreach($arResult['OFFER_SIZE'] as $key => $offer):?>
                                    <a href="<?=$arResult['DETAIL_PAGE_URL']?>?offer=<?=$offer['ID']?>" class="js-offer js-size<?if($offer['ID'] == $arResult['CURRENT_OFFER']['ID']):?> active<?endif?>" data-offer="<?=$offer['ID']?>" data-url="<?=$arResult['DETAIL_PAGE_URL']?>"><?=$offer['PROPERTIES']['SIZE']['VALUE'];?></a>
                                <?endforeach?>
                                </div>
                            </div>
                            <?endif?>
                            <?if(!empty($arResult['CURRENT_OFFER']['PROPERTIES']['COLOR']['VALUE'])):?>
                            <div class="products-page-body__buy__color">
                                <div class="products-page-body__buy__size__head">
                                    <p class="caption">Цвет</p>
                                </div>
                                <div class="products-page-body__buy__color__block">
                                <?foreach($arResult['OFFER_COLOR'] as $key => $offer):?>
                                    <a href="<?=$arResult['DETAIL_PAGE_URL']?>?offer=<?=$offer['ID']?>">
                                        <?
                                        $THUMB = CFile::ResizeImageGet($offer['PREVIEW_PICTURE'], array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                        ?>
                                        <img class="js-offer js-color<?if($offer['PROPERTIES']['COLOR']['VALUE'] == $arResult['CURRENT_OFFER']['PROPERTIES']['COLOR']['VALUE']):?> active<?endif?>"
                                             src="<?=$THUMB['src']?>"
                                             alt="<?=$offer['NAME'];?>"
                                             data-offer="<?=$offer['ID']?>"
                                             data-url="<?=$arResult['DETAIL_PAGE_URL']?>"></a>
                                <?endforeach?>
                                </div>
                            </div>
                            <?endif?>
                        <?endif?>
                    </div>
                    <div class="products-page-body__buy--right">
                        <div class="products-card__buy" data-maxqty="<?=$actualItem['PRODUCT']['QUANTITY']?>">
                            <?if(!$inBasketID):?>
                                <div class="addToBasket">
                                    <button
                                        class="btn btn-accent addBtn"
                                        data-id="<?=empty($arResult['CURRENT_OFFER']) ? $arResult["ID"] : $arResult['CURRENT_OFFER']['ID']?>"
                                        <?=$actualItem['PRODUCT']['QUANTITY'] == 0 ? 'disabled' : ''?>
                                        >В корзину</button>
                                    <button
                                        class="btn btn-outline-yellow"
                                        data-id="<?=empty($arResult['CURRENT_OFFER']) ? $arResult["ID"] : $arResult['CURRENT_OFFER']['ID']?>"
                                        data-toggle="modal"
                                        data-target="oneclick">в 1 клик</button>
                                </div>
                            <?else:?>
                                <div class="inBasket">
                                    <div class="btn hasBasket">
                                        <a href="/personal/cart/">В корзине<?if($inBasketID):?> <span><?=$inBasketQTY?></span> шт<?endif?><br>
                                            <small>Перейти</small>
                                        </a>
                                    </div>
                                    <button
                                        class="btn addToBasketPlus"
                                        data-id="<?=empty($arResult['CURRENT_OFFER']) ? $arResult["ID"] : $arResult['CURRENT_OFFER']['ID']?>"
                                        data-qty="<?=$inBasketQTY?>"
                                        <?=$actualItem['PRODUCT']['QUANTITY'] == $inBasketQTY ? 'disabled' : ''?>>+1 шт</button>
                                </div>
                            <?endif?>
                        </div>
                        <div class="products-page-body__buy__delivery">
                            <div class="products-page-body__buy__delivery__head">
                                <p class="caption">Условия доставки</p>
                                <a class="table" href="">Подробнее</a>
                            </div>
                            <p>
                                Самовывоз — <b>сегодня, от 99 рублей</b>
                            </p>
                            <p>
                                Курьером — <b>2 февраля, от 199 рублей</b>
                            </p>
                        </div>
                    </div>
                <? else: ?>
                    <div class="no-available">
                        <p><?= $arParams['MESS_NOT_AVAILABLE'] ?></p>
                        <span class="btn btn-outline-accent">Не доступно</span>
                    </div>
                <? endif ?>
            </aside>

            <div class="products-page-body__about">
                <div class="products-page-body__about__title">
                <?if($arResult['PROPERTIES']['CML2_MANUFACTURER']['VALUE']):?>
                    <?if($arResult['PROPERTIES']['CML2_MANUFACTURER']['PREVIEW_PICTURE']):?>
                    <div class="products-page-body__about__title__img">
                        <img src="<?=$arResult['PROPERTIES']['CML2_MANUFACTURER']['PREVIEW_PICTURE']?>" alt="<?=$arResult['PROPERTIES']['CML2_MANUFACTURER']['VALUE']?>">
                    </div>
                    <?endif?>
                    <div class="products-page-body__about__title__brand">
                        <p>Бренд: <b><?=$arResult['PROPERTIES']['CML2_MANUFACTURER']['VALUE']?></b></p>
                        <?if($arResult['PROPERTIES']['CML2_MANUFACTURER']['PREVIEW_TEXT']):?><p><?=$arResult['PROPERTIES']['CML2_MANUFACTURER']['PREVIEW_TEXT']?></p><?endif?>
                    </div>
                <?endif?>
                </div>
                <div class="products-page-body__about__text">
                    <div class="caption">
                        <h3>
                            О товаре
                        </h3>
                    </div>
                    <?if($arResult['DETAIL_TEXT']):
                        echo $arResult['DETAIL_TEXT'];
                    endif?>
                    <span class="hideElem active">характеристики</span>
                    <div class="showElem active">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    Страна-производитель
                                </td>
                                <td>
                                    Китай
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Материал
                                </td>
                                <td>
                                    Состав товара: 100% Полиэстер
                                </td>
                            </tr>
                            <?if($arResult['PRODUCT']['WIDTH']):?>
                            <tr>
                                <td>
                                    Габариты упаковки
                                </td>
                                <td>
                                    <?=$arResult['PRODUCT']['WIDTH']?>см x <?=$arResult['PRODUCT']['LENGTH']?>см x <?=$arResult['PRODUCT']['HEIGHT']?>см
                                </td>
                            </tr>
                            <?endif?>
                            <?if($arResult['PRODUCT']['WEIGHT']):?>
                            <tr>
                                <td>
                                    Вес упаковки
                                </td>
                                <td>
                                <?=$arResult['PRODUCT']['WEIGHT']?> кг
                                </td>
                            </tr>
                            <?endif?>
                            <tr>
                                <td>
                                    Сезон
                                </td>
                                <td>
                                    Зима
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Длина изделия по спинке
                                </td>
                                <td>
                                    60 см
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Размер
                                </td>
                                <td>
                                    140
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="review" class="products-page-body__review">
                <div class="products-page-body__review__head">
                    <h3 class="active">Отзывы</h3>
                    <?if ($_SESSION['REVIEW']['ID'] != $arResult['ID']): ?>
                        <button class="btn btn-accent js-add-review" data-toggle="modal" data-target="review" data-product="<?=$arResult['ID']?>">Оставить отзыв</button>
                    <?endif?>
                </div>

                <?if($arResult['REVIEW']):
                    foreach($arResult['REVIEW'] as $key => $review):
                       if($arResult['REVIEW_PRODUCT']['COUNT'] > 3 && $key == 3): echo '<div class="showElem active">';endif;
                ?>
                <div class="products-page-body__review__card" id="<?=$review['ID'];?>">
                    <div class="products-page-body__review__card__name">
                        <p><?=$review['UF_REVIEW_NAME'];?></p>
                        <div class="products-page-header__review">
                            <div class="star">
                                <span<?if($review['UF_REVIEW_RATING'] > 0):?> class="active"<?endif?>></span>
                                <span<?if($review['UF_REVIEW_RATING'] > 1):?> class="active"<?endif?>></span>
                                <span<?if($review['UF_REVIEW_RATING'] > 2):?> class="active"<?endif?>></span>
                                <span<?if($review['UF_REVIEW_RATING'] > 3):?> class="active"<?endif?>></span>
                                <span<?if($review['UF_REVIEW_RATING'] > 4):?> class="active"<?endif?>></span>
                            </div>
                        </div>
                    </div>
                    <p class="products-page-body__review__card__date"><?=$review['UF_REVIEW_DATE'];?></p>

                    <div class="products-page-body__review__card__text">
                        <p><span class="caption">Достоинства</span> <?=$review['UF_REVIEW_ADVANTAGE'];?></p>
                        <p><span class="caption">Недостатки</span> <?=$review['UF_REVIEW_DISADVANTAGE'];?></p>
                        <p><span class="caption">Комментарий</span> <?=$review['UF_REVIEW_COMMENT'];?></p>
                    </div>

                    <?if($review['UF_REVIEW_PHOTO']):?>
                    <div class="products-page-body__review__card__gallery">
                        <?foreach ($review['UF_REVIEW_PHOTO'] as $photo):
                            $FILE = CFile::GetFileArray($photo);
                            $THUMB = CFile::ResizeImageGet($photo, array('width'=>90, 'height'=>90), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                            <span><a href="<?=$FILE['SRC']?>" data-fancybox="gallery"><img src="<?=$THUMB['src']?>" alt=""></a></span>
                        <?endforeach;?>
                    </div>
                    <?endif?>
                </div>
                <?
                        if($arResult['REVIEW_PRODUCT']['COUNT'] > 3 && $key == count($arResult['REVIEW'])-1): echo '</div><span class="hideElem active">все отзывы</span>'; endif;
                    endforeach;
                else:
                    echo '<p class="not_find">Отзывов к этому товау еще нет, будьте первым!</p>';
                endif?>

            </div>
        </div>
    </div>



<?
//TODO: Страница-товара: доделать ОТЗЫВЫ
//TODO: Страница-товара: доделать ВОПРОСЫ
//TODO: Страница-товара: доделать РЕЙТИНГ
//TODO: Страница-товара: доделать ЛАЙК
//TODO: Страница-товара: доделать Купит в 1 клик
//TODO: Страница-товара: доделать ТОРГОВЫЕ ПРЕДЛОЖЕНИЯ
unset($actualItem, $itemIds, $jsParams);