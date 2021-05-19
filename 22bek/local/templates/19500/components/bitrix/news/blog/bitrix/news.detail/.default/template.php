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

$component->SetResultCacheKeys(array("TAGS"));
?>
<div class="container">
    <div class="blog-detail">
        <h1><?=$arResult["NAME"]?></h1>

        <div class="description">
            <?echo $arResult["DETAIL_TEXT"];?>
        </div>
        <br><br>

        <?if(!empty($arResult['PROPERTIES']['GOODS']['VALUE'])):?>
        <h2><?=$arResult['PROPERTIES']['GOODS_TITLE']['VALUE'] ? $arResult['PROPERTIES']['GOODS_TITLE']['VALUE'] : $arResult['PROPERTIES']['GOODS_TITLE']['DEFAULT_VALUE']?></h2>
        <div class="products-list">
        <?
            $arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "DETAIL_PAGE_URL");
            $arFilter = Array("IBLOCK_ID"=> 2, "ID" => $arResult['PROPERTIES']['GOODS']['VALUE']);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arItem = $ob->GetFields();
                $PHOTO = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array("width" => 280, "height" => 250), BX_RESIZE_IMAGE_EXACT);
                ?>
            <div class="product-item">
                <div class="card">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <img src="<?=$PHOTO["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"/>
                    </a>
                    <a class="caption" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                </div>
            </div>
                <?
            }

            ?>
        </div>
        <br><br>
        <?endif?>


        <?if (!empty($arResult['PROPERTIES']['GALERY']['VALUE'])):?>
        <h2><?=$arResult['PROPERTIES']['GALLERY_TITLE']['VALUE'] ? $arResult['PROPERTIES']['GALLERY_TITLE']['VALUE'] : $arResult['PROPERTIES']['GALLERY_TITLE']['DEFAULT_VALUE']?></h2>
        <div class="gallery-items">
        <?
            $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
            $arFilter = Array("IBLOCK_ID"=> 11, "ID" => $arResult['PROPERTIES']['GALERY']['VALUE']);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
            while($ob = $res->GetNextElement()) {
                $arItem = $ob->GetFields();
                echo '<div class="item"><a href="'. $arItem['DETAIL_PAGE_URL'] .'"><img src="'. CFile::GetPath($arItem['PREVIEW_PICTURE']) .'" alt="'. $arItem['NAME'] .'">'. $arItem['NAME'] .'</a></div>';
            }
            ?>
        </div>
        <?endif?>
    </div>
</div>
