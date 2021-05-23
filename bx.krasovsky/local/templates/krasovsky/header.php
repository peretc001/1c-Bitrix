<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/scripts.min.js');
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/style.min.css');
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>body {opacity: 0; overflow-x: hidden;}</style>
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
    <header class="header">
        <div class="top-line">
            <div class="container">
                <a href="">Режим работы</a>
                <a href="">Правила посещения</a>
            </div>
        </div>

        <nav class="menu">
            <div class="container">
                <a href="/" class="logo">LOGOTYPE</a>

                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="menu-wrapper">

                    <ul class="catalog">
                        <li><a href="">Меню</a></li>
                        <li><a href="">Меню</a></li>
                        <li class="has-children">
                            <a href="">Меню</a>

                            <div class="sub-menu">
                                <div class="container offset-left-fix">
                                    <ul class="menu-item">
                                        <li><a href="">Меню</a></li>
                                        <li><a href="">Меню</a></li>
                                        <li><a href="">Меню</a></li>
                                        <li><a href="">Меню</a></li>
                                        <li><a href="">Меню</a></li>
                                    </ul>
                                    <ul class="menu-item">
                                        <li><a href="">Меню</a></li>
                                        <li><a href="">Меню</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li><a href="">Меню</a></li>
                        <li><a href="">Меню</a></li>
                        <li><a href="">Меню</a></li>
                    </ul>

                    <div class="auth">
                        <a href="" class="signup">Регистрация</a>
                        <a href="" class="signin">Вход</a>
                    </div>

                    <div class="mobile-line">
                        <a href="">Режим работы</a>
                        <a href="">Правила посещения</a>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <main>