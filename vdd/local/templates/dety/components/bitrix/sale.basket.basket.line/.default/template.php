<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
?>
<span class="cart"><?
    if ($arResult['NUM_PRODUCTS'] > 0):?>
    <a href="<?= $arParams['PATH_TO_BASKET'] ?>"><?
        if ($arResult['NUM_PRODUCTS'] > 0):
            echo '<span class="qty">'. $arResult['NUM_PRODUCTS'] .'</span>';
        endif;

        if ($arResult['TOTAL_PRICE_RAW'] > 0):
            echo '<span class="total">'. number_format($arResult['TOTAL_PRICE_RAW'], 0, ',', ' ') .' ₽</span>';
        endif;?>
    </a>
    <?endif?>
</span>