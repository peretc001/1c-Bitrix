<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if ($request->get('clear') !== null && Loader::includeModule("sale")) {
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());

    $redirect = $APPLICATION->GetCurPageParam('', ['clear']);

    LocalRedirect($redirect);
}

global $APPLICATION;

#ID КАТЛАОГА
$arParams['IBLOCK_ID'] = 4;

if (!empty($arResult['IN_BASKET'])):
    $GLOBALS['arrFilter'] = array('!ID' => $arResult['IN_BASKET']);
endif;
?>

<section class="resent">
    <div class="container">
        <h4>Не забудьте купить</h4>
        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"recent_product", 
	array(
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
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
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
		"RCM_TYPE" => "similar_sell",
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
		"COMPONENT_TEMPLATE" => "recent_product",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":{\"1\":{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":55}}}}",
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
		"PROPERTY_CODE_MOBILE" => array(
		)
	),
	false
);?>
    </div>
</section>

<?$APPLICATION->IncludeComponent(
                "bitrix:catalog.products.viewed",
                "",
                Array(
                    "FILTER_NAME" => "arrFilter",
                    "ACTION_VARIABLE" => "action_cpv",
                    "ADDITIONAL_PICT_PROP_4" => "-",
                    "ADDITIONAL_PICT_PROP_5" => "-",
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
                    "LABEL_PROP_4" => array("CREDIT", "INSTALLMENT", "TOP", "NEW", "DISCOUNT", "SALE"),
                    "LABEL_PROP_MOBILE_4" => array(),
                    "LABEL_PROP_POSITION" => "top-left",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "PAGE_ELEMENT_COUNT" => "9",
                    "PARTIAL_PRODUCT_PROPERTIES" => "Y",
                    "PRICE_CODE" => array("price", "sale"),
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
                    "USE_PRODUCT_QUANTITY" => "N"
                )
            );?>