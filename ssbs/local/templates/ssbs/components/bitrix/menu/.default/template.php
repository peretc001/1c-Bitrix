<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?foreach($arResult as $arItem):?>
    <li><a <?if(!empty($arItem['PARAMS']['class'])):?>class="<?=$arItem['PARAMS']['class']?>" <?endif?>href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?endforeach?>
<?endif?>
