<?// if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
/*
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
//$this->setFrameMode(true);

//$replacer = function ($matches) use ($APPLICATION) {
//    ob_start();








    $url = strtolower($arResult["ELEMENT_CHAIN"]);

    $APPLICATION->AddChainItem($arResult["NAME"], '/brands/'. $url );
    $APPLICATION->AddChainItem("Фильтр", '/brands/'. $url .'/filter/');


    $brandName = $arResult["NAME"];
    $GLOBALS['arrFilter'] = array('ACTIVE' => 'Y', 'PROPERTY_19_VALUE' => $brandName);
    $GLOBALS['brand'] = 'Бренд';

    $IBLOCK_ID = 4;
    $arFilter = Array('IBLOCK_ID' => $IBLOCK_ID, 'PROPERTY_19_VALUE' =>  $brandName);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array('IBLOCK_SECTION_ID'));
    while($ob = $res->GetNextElement()):
        $arFields = $ob->GetFields();
        $arSection[] = $arFields['IBLOCK_SECTION_ID'];
    endwhile;
    $arSection = array_unique($arSection);

    ?>
    <?if(!empty($arSection)):?>
    <section class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <?
                    $APPLICATION->IncludeComponent(
                "bitrix:catalog.smart.filter",
                "",
                Array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => $IBLOCK_ID,
                    "SECTION_ID" => !!$arSection[0]?$arSection[0]:0,
                    "SHOW_ALL_WO_SECTION" => !!$arSection?"N":"Y",
                    "FILTER_NAME" => "arrFilter",
                    "PREFILTER_NAME" => "arrFilter",
                    "PRICE_CODE" => array(
                        0 => 'price'
                    ),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "Y",
                    "SAVE_IN_SESSION" => "N",
                    "FILTER_VIEW_MODE" => "vertical",
                    "XML_EXPORT" => "N",
                    "SECTION_TITLE" => "NAME",
                    "SECTION_DESCRIPTION" => "-",
                    "HIDE_NOT_AVAILABLE" => "Y",
                    "TEMPLATE_THEME" => '',
                    "CONVERT_CURRENCY" => "N",
                    'CURRENCY_ID' => '',
                    'SEF_MODE' => 'Y',
                    "SEF_RULE" => "/brands/filter/#SMART_FILTER_PATH#/apply/",
                    "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
                    "SECTION_CODE_PATH" => "",
                    "PAGER_PARAMS_NAME" => "arrPager",
                    "INSTANT_RELOAD" => '',
                    "POPUP_POSITION" => "right",
                    "DISPLAY_ELEMENT_COUNT" => "Y"
                ), $component
            );
                    ?>
                </div>

                <div class="col-md-8 col-lg-9">
                    <?
                    if (isset($_GET["sort"]) && isset($_GET["method"]) && (
                            $_GET["sort"] == "show_counter" ||
                            $_GET["sort"] == "catalog_price_1" )
                    ):
                        $arParams["ELEMENT_SORT_FIELD"] = $_GET["sort"];
                        $arParams["ELEMENT_SORT_ORDER"] = $_GET["method"];
                    else:
                        global $sort;
                        if(empty($sort)) $sort = 'shown';
                    endif;
                    ?>
                    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        ".default",
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
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMPATIBLE_MODE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "DETAIL_URL" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_COMPARE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
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
            "OFFERS_LIMIT" => "8",
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
            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
            "RCM_TYPE" => "personal",
            "SECTION_CODE" => "",
            "SECTION_ID" => $_REQUEST["SECTION_ID"],
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
            "COMPONENT_TEMPLATE" => ".default",
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
            "PROPERTY_CODE_MOBILE" => array(
            ),
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "USE_FILTER"=>"Y",
        ),
        $component
    );?>
                </div>
            </div>
        </div>
    </section>
    <?else:?>
        <div class="not_find">К сожалению, ничего не найдено</div>
    <?endif;




//    return ob_get_clean();
//};

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

*/
?>