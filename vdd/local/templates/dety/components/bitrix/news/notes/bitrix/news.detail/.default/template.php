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

if (!empty($arResult['PROPERTIES']['NOTES__PRODUCT']['VALUE'])):

    $this->addExternalCss(DEFAULT_TEMPLATE_PATH . '/js/slick/slick.css');
    $this->addExternalJs(DEFAULT_TEMPLATE_PATH . '/js/slick/slick.min.js');
    $this->addExternalJs(DEFAULT_TEMPLATE_PATH . '/js/component/notes.js');

endif;

#Передаем товары в component_epilog
$component->SetResultCacheKeys(array("PROPERTIES"));

?>
<section class="notes-page">
    <div class="container" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="identifier" content="<?=$arResult['ID']?>">
	<meta itemprop="author" content="ВсеДляДеток">
	<meta itemprop="datePublished" content="<?=FormatDateFromDB($arResult["TIMESTAMP_X"], 'YYYY-MM-DD')?>">
	<meta itemprop="dateModified" content="<?=FormatDateFromDB($arResult["TIMESTAMP_X"], 'YYYY-MM-DD')?>">
	<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?=$arResult['DETAIL_PAGE_URL']?>" />
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <img itemprop="url image" src="<?= DEFAULT_TEMPLATE_PATH ?>/img/favicon.png" style="display:none;" />
       	</div>
        <meta itemprop="name" content="ВсеДляДеток">
        <meta itemprop="telephone" content="8-800-600-77-27">
        <meta itemprop="address" content="Москва">
    </div>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
        <picture class="notes-page__img">
            <source class="lazy" srcset="<?=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>375, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true)['src']?>" media="(max-width: 576.98px)">
            <source class="lazy" srcset="<?=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>1000, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true)['src']?>" media="(min-width: 577px)">
            <img src="<?=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>1000, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true)['src']?>" alt="<?=$arResult["NAME"]?>">
        </picture>
	<?endif?>
    <div class="row">
        <div class="col-lg-3 notes-page__date">
			<a href="<?=$arResult['LIST_PAGE_URL']?>">
				<?=FormatDateFromDB($arResult["TIMESTAMP_X"], 'SHORT')?></a>
        </div>
        <div class="col-lg-9 notes-page__text">
            <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                <h1 itemprop="headline" itemprop="headline"><?=$arResult["NAME"]?></h1>
            <?endif;?>
            <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
				<div itemprop="articleBody">
                <?echo $arResult["DETAIL_TEXT"];?>
				</div>
            <?endif?>

			<div class="notes-page__gallery" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
    		<?foreach($arResult["PROPERTIES"]['MORE_PHOTO']['VALUE'] as $key=>$file):?>
				<div class="notes-page__gallery-item"><?
                    if($key < 15):
                        $FILE = CFile::GetPath($file);
                        if ($key == 0 || $key == 1 || $key == 5 || $key == 6 || $key == 10 || $key == 11):
                            $desctop = CFile::ResizeImageGet($file, array('width'=>500, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true)['src'];
                        elseif ($key == 2 || $key == 3 || $key == 4 || $key == 7 || $key == 8 || $key == 9 || $key == 12 || $key == 13 || $key == 14):
                            $desctop = CFile::ResizeImageGet($file, array('width'=>300, 'height'=>400), BX_RESIZE_IMAGE_EXACT, true)['src'];
                        endif;
                        $mobile = CFile::ResizeImageGet($file, array('width'=>375, 'height'=>375), BX_RESIZE_IMAGE_EXACT, true)['src'];
                    ?>
                    <?if(!empty($arResult["PROPERTIES"]['MORE_PHOTO']['DESCRIPTION'][$key])):?>
                    <a href="<?=$arResult["PROPERTIES"]['MORE_PHOTO']['DESCRIPTION'][$key]?>">
                    <?endif?>
                    <picture>
                        <source srcset="<?=$mobile?>" media="(max-width: 767.98px)">
                        <source srcset="<?=$desctop?>" media="(min-width: 768px)">
                        <img src="<?=$desctop?>" alt="" itemprop="url" itemprop="contentUrl">
                    </picture>
                    <?if(!empty($arResult["PROPERTIES"]['MORE_PHOTO']['DESCRIPTION'][$key])):?>
                    </a>
                    <?endif?>
                    <?endif?>
				</div>
			<?endforeach?>
    		</div>
			<meta itemprop="author" content="ВсеДляДеток">
			<meta itemprop="datePublished" content="<?=FormatDateFromDB($arResult["TIMESTAMP_X"], 'Y-m-d H:i:s')?>">
			<meta itemprop="dateModified" content="<?=FormatDateFromDB($arResult["TIMESTAMP_X"], 'Y-m-d H:i:s')?>">
			<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?=$arResult['DETAIL_PAGE_URL']?>" />
		</div>
        <div class="col-lg-9 offset-lg-3 notes-page__more">
            <?
            $prev = CIBlockElement::GetList(
                array(),
                array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ID"=>$arResult["ID"] + 1),
                false, false,
                array("DETAIL_PAGE_URL")
            );
            $next = CIBlockElement::GetList(
                array(),
                array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ID"=>$arResult["ID"] - 1),
                false, false,
                array("DETAIL_PAGE_URL")
            );
            $prevId = $prev->GetNext(); $prevURL = $prevId['DETAIL_PAGE_URL'];
            $nextId = $next->GetNext(); $nextURL = $nextId["DETAIL_PAGE_URL"];
            ?>
            <?if($prevURL):?><a class="prev" href="<?=$prevURL?>">Предыдущая</a><?endif?>
            <?if($nextURL):?><a class="next" href="<?=$nextURL?>">Следующия</a><?endif?>
        </div>
	</div>
</section>