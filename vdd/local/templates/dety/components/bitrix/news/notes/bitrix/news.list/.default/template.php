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
$this->addExternalCss(DEFAULT_TEMPLATE_PATH . '/css/notes-page/notes-page.min.css');
?>
<section class="notes-page">
    <div class="container">
        <h1>Полезные материалы</h1>
        <div class="row">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-md-6 col-lg-4">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <picture class="notes-page__img">
                        <source class="lazy" srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>375, 'height'=>375), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>" media="(max-width: 576.98px)">
                        <source class="lazy" srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>500, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>" media="(min-width: 577px)">
                        <img class="lazy" data-srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>500, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>" src="<?=DEFAULT_TEMPLATE_PATH?>/img/empty.svg" alt="<?=$arItem["NAME"]?>">
                    </picture>
                </a>
                <div class="notes-page__title">
                    <b><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></b>
                </div>
                <div class="notes-page__desc">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <?=$arItem["PREVIEW_TEXT"]?>
                    </a>
                </div>
            </div>
            <?endforeach;?>
        </div>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            <br /><?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
</section>
