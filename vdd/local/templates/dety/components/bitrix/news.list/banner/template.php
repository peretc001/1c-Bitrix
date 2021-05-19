<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="banner container<?= $arParams['FILTER_NAME'] == 'BANNER_SHOW3' ? ' banner3' : ''?>"><?
    foreach($arResult["ITEMS"] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if (!empty($arItem["PROPERTIES"]["BANNER_DESCTOP"]["VALUE"])):
            $photo_desctop = CFile::GetPath($arItem["PROPERTIES"]["BANNER_DESCTOP"]["VALUE"]);
        endif;
        if (!empty($arItem["PROPERTIES"]["BANNER_MOBILE"]["VALUE"])):
            $photo_mobile = CFile::GetPath($arItem["PROPERTIES"]["BANNER_MOBILE"]["VALUE"]);
        endif;
        if (!empty($arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"])):
            $link = $arItem["PROPERTIES"]["BANNER_LINK"]["VALUE"];
        endif
    ?>
     <a href="<?=$link?>">
         <picture>
             <source srcset="<?=$photo_mobile?>" media="(max-width: 767.98px)">
             <source srcset="<?=$photo_desctop?>" media="(min-width: 768px)">
             <img class="lazy" data-srcset="<?=$photo_mobile?>" src="<?=$photo_mobile?>" alt="<?=$arItem['NAME']?>">
         </picture>
     </a>
    <?endforeach;?>
</div>