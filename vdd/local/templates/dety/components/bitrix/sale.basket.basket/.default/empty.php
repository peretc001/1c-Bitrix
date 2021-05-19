<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
$this->addExternalCSS(DEFAULT_TEMPLATE_PATH . '/css/cart/cart.css');

//$APPLICATION->AddChainItem('Корзина', '/cart/' );
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>

<section class="cart-empty">
    <div class="container">
        <div class="cart-empty--wrapper">
            <h2>В корзину ещё ничего не прилетело</h2>
            <p>Отправляйтесь за поиском товаров, чтобы найти всё что нужно.
                А если в корзине были товары - <a href="#" data-toggle="modal" data-target="login">войдите</a>, чтобы посмотреть список.</p>
            <div class="cart-empty--button">
                <a href="/catalog/" class="btn btn-accent">Отправиться за покупками</a>
                <a href="/sale/" class="btn btn-outline-yellow">Заглянуть в акции</a>
            </div>
            <div class="cart-empty--img">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/cart/empty.svg" alt="">
            </div>
        </div>
    </div>
</section>