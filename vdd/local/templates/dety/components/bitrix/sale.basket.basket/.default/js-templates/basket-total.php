<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */



$getCoupone = \Bitrix\Sale\DiscountCouponsManager::get(false, array(), true, false);
?>


<script id="basket-total-template" type="text/html">
    <div data-entity="basket-checkout-aligner">
        <?
        if ($arParams['HIDE_COUPON'] == 'Y') //TODO: Исправить на !==
        {
            ?>
            <div class="basket-coupon-section">
                <div class="basket-coupon-block-field">
                    <div class="basket-coupon-block-field-description">
                        <?= Loc::getMessage('SBB_COUPON_ENTER') ?>:
                    </div>
                    <div class="form">
                        <div class="form-group" style="position: relative;">
                            <input type="text" class="form-control" id="" placeholder=""
                                   data-entity="basket-coupon-input">
                            <span class="basket-coupon-block-coupon-btn"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?
        }
        ?>
        <div class="cart-total">
            <div class="cart-total__head">
                <p>Итого</p>
                <p data-entity="basket-total-price"> {{{PRICE_FORMATED}}}</p>
            </div>

            <div class="cart-total__item">
                <p>Сумма:</p>
                <p data-entity="basket-total-price"> {{{PRICE_FORMATED}}}</p>
            </div>

            {{#DISCOUNT_PRICE_FORMATED}}
            <div class="cart-total__item">
                <p>Экономия:</p>
                <p> {{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}</p>
            </div>
            {{/DISCOUNT_PRICE_FORMATED}}

            <div class="cart-total__item bonus">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/cart/bonus.svg" alt="">
                <p>4 290 Б</p>
            </div>

            <button type="submit" class="checkout basket-btn-checkout{{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}"
                    data-entity="basket-checkout-button">
                <?= Loc::getMessage('SBB_ORDER') ?>
            </button>
            <button class="credit" type="submit">Купить в кредит</button>
            <button class="installment" type="submit">Купить в рассрочку</button>
        </div>
        <div class="cart-total code">
            <div class="promo <?if (!empty($getCoupone[0])): ?>active<?endif?>" <?if (empty($getCoupone[0])): ?>data-toggle="modal" data-target="code"<?endif?>>
                <span class="delete" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}"></span>
                <img src="/local/templates/.default/img/cart/coupon.svg" alt="">
                <p class="default">Использовать <span>промокод</span></p>
                {{#COUPON_LIST}}
                <p class="your">Ваш промокод: <span>{{COUPON}}</span></p>
                {{/COUPON_LIST}}
                <p class="change" <?if (!empty($getCoupone[0])): ?>data-toggle="modal" data-target="code"<?endif?>>Ввести новый</p>
            </div>

            <div href="" class="bonus <?if (!empty($getCoupone[0])): ?>disabled<?endif?>" <?if (empty($getCoupone[0])): ?>data-toggle="modal" data-target="bonus"<?endif?>>
                <span class="delete"></span>
                <img src="/local/templates/.default/img/cart/star.svg" alt="">
                <p class="default">Списать <span>бонусы</span></p>
                <p class="your">Списанно: <span>4 290 Б</span></p>
                <p class="change">Изменить сумму</p>
            </div>
        </div>
    </div>
</script>

