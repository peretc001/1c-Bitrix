<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/account/account.min.css');
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/js/slick/slick.css');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/slick/slick.min.js');

$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 6;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arResult['ID'] = array();
if ($USER->IsAuthorized()):
    $idUser = $USER->GetID();

    $data = array(
        "UF_FAVORITE_USER_ID" => $idUser,
    );
    $rsData = $entity_data_class::getList(array(
        "select" => array('UF_FAVORITE_ID'),
        "filter" => $data
    ));
    while ($getID = $rsData->Fetch()):
        $arResult['ID'][] = $getID['UF_FAVORITE_ID'];
    endwhile;
endif;

global $oneClickBtn;
$oneClickBtn = 'yes';
?>
    <section class="account">
        <div class="container">
            <h1>Личный кабинет</h1>

            <div class="row">
                <ul class="account-menu">
                    <li><a href="/personal/private/">Профиль</a></li>
                    <li><a href="/personal/orders/">История заказы</a></li>
                    <li class="active"><a href="/personal/wishlist/">Избранные товары</a></li>
                </ul>
            </div>
        </div>
    </section>

    <?if (!empty($arResult['ID'])):?>
    <section class="products">
        <div class="container">
        <?$GLOBALS['arrFilter'] = array('ACTIVE' => 'Y', 'ID' => $arResult['ID']);
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "home",
                    array(
                        "FILTER_NAME" => "arrFilter",
                        "ACTION_VARIABLE" => "action",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "BACKGROUND_IMAGE" => "-",
                        "BASKET_URL" => "/personal/cart/",
                        "BROWSER_TITLE" => "-",
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPATIBLE_MODE" => "Y",
                        "CONVERT_CURRENCY" => "N",
                        "DETAIL_URL" => "",
                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_COMPARE" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "ELEMENT_SORT_FIELD" => "shows",
                        "ELEMENT_SORT_ORDER" => "desc",
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "ENLARGE_PRODUCT" => "STRICT",
                        "HIDE_NOT_AVAILABLE" => "Y",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
                        "IBLOCK_ID" => "4",
                        "IBLOCK_TYPE" => "catalog",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "LAZY_LOAD" => "N",
                        "LINE_ELEMENT_COUNT" => "3",
                        "LOAD_ON_SCROLL" => "N",
                        "MESSAGE_404" => "",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "META_DESCRIPTION" => "-",
                        "META_KEYWORDS" => "-",
                        "OFFERS_LIMIT" => "0",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Товары",
                        "PAGE_ELEMENT_COUNT" => "8",
                        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
                        "PRICE_CODE" => array(
                            0 => "price",
                            1 => "sale",
                        ),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION" => "N",
                        "RCM_PROD_ID" => $arResult["ID"],
                        "RCM_TYPE" => "personal",
                        "SECTION_CODE" => "",
                        "SECTION_ID" => "0",
                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array(
                            0 => "",
                            1 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "Y",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "SHOW_CLOSE_POPUP" => "Y",
                        "SHOW_DISCOUNT_PERCENT" => "Y",
                        "SHOW_FROM_SECTION" => "Y",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "Y",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_SLIDER" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_MAIN_ELEMENT_SECTION" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N",
                        "COMPONENT_TEMPLATE" => "home",
                        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                        "OFFERS_SORT_FIELD" => "sort",
                        "OFFERS_SORT_ORDER" => "asc",
                        "OFFERS_SORT_FIELD2" => "id",
                        "OFFERS_SORT_ORDER2" => "desc",
                        "OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "SLIDER_INTERVAL" => "3000",
                        "SLIDER_PROGRESS" => "N",
                        "PRODUCT_DISPLAY_MODE" => "N",
                        "ADD_PICT_PROP" => "-",
                        "LABEL_PROP" => array(
                            0 => "CREDIT",
                            1 => "INSTALLMENT",
                            2 => "TOP",
                            3 => "NEW",
                        ),
                        "LABEL_PROP_MOBILE" => array(
                            0 => "CREDIT",
                            1 => "INSTALLMENT",
                            2 => "TOP",
                            3 => "NEW",
                        ),
                        "LABEL_PROP_POSITION" => "top-left",
                        "SECTION_CODE_PATH" => "",
                        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                        "SEF_MODE" => "Y",
                        "SEF_RULE" => "",
                        "PROPERTY_CODE_MOBILE" => array()
                    ),
                    false
                );
        ?>
        </div>
    </section>
    <?else:?>
        <div class="no-favorite">
            У вас еще нет избранных товаров<? if (!$USER->IsAuthorized()): ?>, <br>
            чтобы добавить товары в избранное, пожалуйста, <a
                    data-toggle="modal" data-target="login" href="#">авторизуйтесь.<? endif ?> </a>
        </div>
    <?endif?>

    <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.products.viewed",
            ".default",
            array(
                "ACTION_VARIABLE" => "action_cpv",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "BASKET_URL" => "/personal/cart/",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CONVERT_CURRENCY" => "N",
                "DEPTH" => "2",
                "DISPLAY_COMPARE" => "N",
                "ENLARGE_PRODUCT" => "STRICT",
                "HIDE_NOT_AVAILABLE" => "Y",
                "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
                "IBLOCK_ID" => "4",
                "IBLOCK_MODE" => "single",
                "IBLOCK_TYPE" => "catalog",
                "LABEL_PROP_POSITION" => "top-left",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "PAGE_ELEMENT_COUNT" => "9",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "price",
                    1 => "sale",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "N",
                "SECTION_CODE" => "",
                "SECTION_ELEMENT_CODE" => "",
                "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "N",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "COMPONENT_TEMPLATE" => ".default",
                "ADDITIONAL_PICT_PROP_4" => "-",
                "LABEL_PROP_4" => array(),
                "ADDITIONAL_PICT_PROP_5" => "-"
            ),
            false
        ); ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
