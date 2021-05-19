<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
CJSCore::Init(['jquery', 'fx']);
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/scripts.min.js');
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/main.min.css');

Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH .'/lib/jquery-ui/css/jquery-ui.css');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH .'/lib/jquery-ui/js/jquery-ui.js');

Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/city.js');


$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/png" href="<?= DEFAULT_TEMPLATE_PATH ?>/img/favicon.png"/>
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>


<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>


<main>
<nav class="nav">
    <div class="nav-top">
        <div class="container">
            <div class="nav-top__city">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/city.php"),
                    false
                ); ?>
                <div class="nav-top__city__location__item">
                    <a href="/point/">Пункты выдачи</a>
                    <a href="/delivery/">Условия доставки</a>
                </div>
            </div>
            <div class="nav-top__right">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/phone.php"),
                    false
                ); ?>
                <div class="has-children">
                    <a class="nav-top__right__user">Покупателям</a>
                    <ul>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "bottom2",
                                "USE_EXT" => "N"
                            )
                        );?>
                    </ul>
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/login.php"),
                    false
                );?>
            </div>
        </div>
    </div>
    <div class="nav-search">
        <div class="container">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="/" class="brand"></a>
            <?$APPLICATION->IncludeComponent(
                "bitrix:search.title",
                ".default",
                Array(
                    "CATEGORY_0" => array(0=>"iblock_catalog"),
                    "CATEGORY_0_TITLE" => "",
                    "CATEGORY_0_iblock_catalog" => array(0=>"all"),
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => ".default",
                    "CONTAINER_ID" => "title-search",
                    "INPUT_ID" => "title-search-input",
                    "NUM_CATEGORIES" => "all",
                    "ORDER" => "date",
                    "PAGE" => "#SITE_DIR#search/index.php",
                    "SHOW_INPUT" => "Y",
                    "SHOW_OTHERS" => "N",
                    "TOP_COUNT" => "5",
                    "USE_LANGUAGE_GUESS" => "Y"
                )
            );?>
            <div class="nav-search--right">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/cart.php"),
                    false
                ); ?>
            </div>
        </div>
    </div>
    <div class="nav-mobile"><?
        $APPLICATION->IncludeComponent(
            "bitrix:search.title",
            "mobile",
            Array(
                "CATEGORY_0" => array(0=>"iblock_catalog"),
                "CATEGORY_0_TITLE" => "",
                "CATEGORY_0_iblock_catalog" => array(0=>"all"),
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => ".default",
                "CONTAINER_ID" => "nav-mobile",
                "INPUT_ID" => "title-search-input-mobile",
                "NUM_CATEGORIES" => "all",
                "ORDER" => "date",
                "PAGE" => "#SITE_DIR#search/index.php",
                "SHOW_INPUT" => "Y",
                "SHOW_OTHERS" => "N",
                "TOP_COUNT" => "5",
                "USE_LANGUAGE_GUESS" => "Y"
            )
        );
        ?>
        <div class="catalog-btn">
            <div class="icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            Каталог товаров
        </div>
    </div>

    <div class="nav-catalog">
        <?
        $APPLICATION->IncludeComponent("bitrix:menu", ".default", Array(
            "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "N",
            ),
            false
        );
        ?>
    </div>
</nav>
    <?if ($curPage != '/index.php'):
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
            "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
            ),
            false
        );
    endif?>
