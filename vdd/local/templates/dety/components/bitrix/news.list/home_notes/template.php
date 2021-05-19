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

foreach($arResult["ITEMS"] as $arItem):
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="notes-item">
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="notes-item__img">
            <picture class="notes-page__img">
                <source
                    srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>375, 'height'=>375), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>"
                    media="(max-width: 576.98px)">
                <source
                    srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>500, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>"
                    media="(min-width: 577px)">
                <img
                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                    data-src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>375, 'height'=>375), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>"
                    class="lazy"
                    alt="<?=$arItem["NAME"]?>">
            </picture>
        </a>
        <div class="notes-item__title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
        <div class="notes-item__desc">
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=
                $arItem["PREVIEW_TEXT"]?></a>
        </div>
    </div>
<?endforeach?>