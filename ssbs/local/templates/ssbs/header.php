<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
CJSCore::Init(['jquery', 'fx']);
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/scripts.min.js');
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/main.min.css');
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= DEFAULT_TEMPLATE_PATH ?>/img/favicon.png"/>
    <link rel="icon" href="/favicon.png" type="image/png">
    <style>body {opacity: 0; overflow-x: hidden;}</style>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-56LS9K9');</script>
    <!-- End Google Tag Manager -->
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-56LS9K9"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
    <nav class="menu">
        <div class="container">
            <?
            #LOGO
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/logo.php"),
                false
            ); ?>
            <ul>
            <?
            #MENU
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "top",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N"
                )
            );?>
            </ul>
            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <aside class="mobile-menu">
        <ul>
            <?
            #MENU
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "top",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N"
                )
            );?>
            <li class="phone">
                <?
                #LOGO
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/phone.php"),
                    false
                ); ?>
            </li>
            <li class="callback">
                <a data-target="modal" data-modal="consulting" data-form="Блок: Разработка и сопровождение сайтов">Заказать консультацию</a>
            </li>
        </ul>
    </aside>
