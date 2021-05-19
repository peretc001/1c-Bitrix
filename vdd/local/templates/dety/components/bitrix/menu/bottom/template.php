<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<?
foreach($arResult as $arItem):
if ($arItem["LINK"]):
?>
    <li>
        <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
    </li>
<?endif?>
<?endforeach?>
<?endif?>
