<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */
?>
<script id="basket-item-template" type="text/html">
    {{^SHOW_RESTORE}}
<!--    {{#SHOW_LABEL}}-->
<!--    <div class="basket-item-label-text basket-item-label-big --><?//=$labelPositionClass?><!--">-->
<!--        {{#LABEL_VALUES}}-->
<!--        <div{{#HIDE_MOBILE}} class="hidden-xs"{{/HIDE_MOBILE}}>-->
<!--        <span title="{{NAME}}">{{NAME}}</span>-->
<!--    </div>-->
<!--    {{/LABEL_VALUES}}-->
<!--    </div>-->
<!--    {{/SHOW_LABEL}}-->

    <div class="cart-item"
         id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        <div class="cart-item__check">
            <input type="checkbox" id="p{{ID}}">
            <label for="p{{ID}}"></label>
        </div>

        <?
        if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST'])) {
        ?>
        <div class="cart-item__img <?= (!isset($mobileColumns['PREVIEW_PICTURE']) ? ' hidden-xs' : '') ?>">
            {{#DETAIL_PAGE_URL}}
            <a href="{{DETAIL_PAGE_URL}}">
                {{/DETAIL_PAGE_URL}}
                <img class="basket-item-image" alt="{{NAME}}"
                     src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?= $templateFolder ?>/images/no_photo.png{{/IMAGE_URL}}">
                {{#DETAIL_PAGE_URL}}
            </a>
            {{/DETAIL_PAGE_URL}}
        </div>


        <div class="cart-item__name">
            {{#DETAIL_PAGE_URL}}
            <a href="{{DETAIL_PAGE_URL}}" class="basket-item-info-name-link">
                {{/DETAIL_PAGE_URL}}
                <span data-entity="basket-item-name">{{NAME}}</span>
                {{#DETAIL_PAGE_URL}}
            </a>
            {{/DETAIL_PAGE_URL}}
            {{#CREDIT}}
            <p class="credit">В кредит: от <span>{{{CREDIT}}}</span> руб/мес</p>
            {{/CREDIT}}
            <p class="bottom"><span data-id="{{ID}}" class="wishlist addToFavorite">В избранное</span> <span data-entity="basket-item-delete">Удалить</span></p>
        </div>

        <div class="cart-item__qty" data-entity="basket-item-quantity-block">
            <input type="text" class="basket-item-amount-filed" value="{{QUANTITY}}"
                   {{#NOT_AVAILABLE}} disabled="disabled" {{/NOT_AVAILABLE}}
            data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
            id="basket-item-quantity-{{ID}}"> шт.
            <div class="plus-minus">
                <span class="minus" data-entity="basket-item-quantity-minus">-</span>
                <span class="plus" data-entity="basket-item-quantity-plus">+</span>
            </div>
        </div>

        <div class="cart-item__subtotal">
            {{#SHOW_DISCOUNT_PRICE}}
            <p class="old"><span>{{{SUM_FULL_PRICE_FORMATED}}}</span></p>
            {{/SHOW_DISCOUNT_PRICE}}
            <p class="subtotal"><span id="basket-item-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</span></p>
            {{#SHOW_DISCOUNT_PRICE}}
            <p class="economy">Экономия <span>14 230 ₽</span></p>
            {{/SHOW_DISCOUNT_PRICE}}
        </div>

        {{#SHOW_LOADING}}
        <div class="basket-items-list-item-overlay"></div>
        {{/SHOW_LOADING}}
    </div>
    {{/SHOW_RESTORE}}
<?php }?>
</script>