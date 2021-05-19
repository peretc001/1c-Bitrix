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
<div class="grid home-week--wrap">
    <?$i = 1;
    foreach($arResult["ITEMS"] as $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        if ($arItem["PROPERTIES"]["WEEK_MOBILE"]["VALUE"]):
            $photo_mobile = CFile::GetPath($arItem["PROPERTIES"]["WEEK_MOBILE"]["VALUE"]);
        else:
            $photo_mobile = $arItem["PREVIEW_PICTURE"]["SRC"];
        endif;
        $photo_desctop = $arItem["PREVIEW_PICTURE"]["SRC"];
        ?>
    <<?if(!empty($arItem["PROPERTIES"]['WEEK_LINK']['VALUE'])):?>a href="<?=$arItem["PROPERTIES"]['WEEK_LINK']['VALUE']?>"<?else:?>span<?endif?> class="grid-col<?if($i == 1): echo ' first'; elseif($i == 4): echo ' last'; endif?>">
        <picture>
            <source
                    srcset="<?=$photo_mobile?>"
                    media="(max-width: 767.98px)" />
            <source
                    srcset="<?=$photo_desctop?>"
                    media="(min-width: 768px)" />
            <img
                    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                    data-src="<?=$photo_desctop?>"
                    class="lazy"
                    alt="<?echo $arItem["NAME"]?>" />
        </picture>
        <div class="caption<?if($i == 1): echo ' left'; elseif($i == 3): echo ' right'; endif?>">
            <p>
                <b>
                    <?echo $arItem["NAME"]?>
                </b>
            </p>
            <span>Подробнее</span>
        </div>
    </<?if(!empty($arItem["PROPERTIES"]['WEEK_LINK']['VALUE'])):?>a<?else:?>span<?endif?>>
        <?$i++;
    endforeach;?>
</div>
