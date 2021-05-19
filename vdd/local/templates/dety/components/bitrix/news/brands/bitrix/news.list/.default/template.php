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
$this->addExternalCss(DEFAULT_TEMPLATE_PATH . '/css/brands/brands.min.css');
$this->addExternalJs(DEFAULT_TEMPLATE_PATH . '/js/component/brands-page.js');

if($APPLICATION->GetCurPage() == '/heroes/' || $APPLICATION->GetCurPage() == '/brands/'):
    $APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
endif;
?>
<div class="brands<?if($arParams['IBLOCK_URL'] == '/heroes/'):?> heroes<?endif?>">
    <div class="container">
        <div class="brands-header">
            <h1><?$APPLICATION->ShowTitle(false); ?></h1>
            <div class="brands-header__favorite active">
                <span>Избранные</span>
                <span><?if($arParams['IBLOCK_URL'] == '/heroes/'):?> Все интересы<?else:?>Все бренды<?endif?></span>
            </div>
        </div>
        <div class="brands-alphabet">
            <div class="rus">
            <?foreach($arResult["WORD"]['RUS'] as $item):?>
                <span<?if(empty($arResult["WORD"]['BRAND'][$item])):?> class="none"<?endif?>><?=($item == '0') ? '0-9': $item;?></span>
            <?endforeach?>
            </div>
            <div class="eng">
                <?foreach($arResult["WORD"]['ENG'] as $item):?>
                    <span<?if(empty($arResult["WORD"]['BRAND'][$item])):?> class="none"<?endif?>><?=($item == '0') ? '0-9': $item;?></span>
                <?endforeach?>
            </div>
        </div>
        <div class="brands-all">
            <?
            foreach($arResult["WORD"]['BRAND'] as $key => $item):
                if(is_numeric($key)):
            ?>
            <div class="brands-all-card" data-card="<?=$key?>">
                <div class="brands-all-card__title" data-id="<?=$key?>">
                    0 - 9
                </div>
                <div class="brands-all-card__list">
                    <?foreach($item as $elem):?>
                        <a href="<?=$elem["DETAIL_PAGE_URL"]?>"><?=$elem["NAME"]?></a>
                    <?endforeach;?>
                </div>
            </div>
            <?endif;
            endforeach?>

            <?
            foreach($arResult["WORD"]['BRAND'] as $key => $item):
                if(is_string($key)):
                    ?>
                    <div class="brands-all-card" data-card="<?=$key?>">
                        <div class="brands-all-card__title" data-id="<?=$key?>">
                            <?=$key?>
                        </div>
                        <div class="brands-all-card__list">
                            <?foreach($item as $elem):?>
                                <a href="<?=$elem["DETAIL_PAGE_URL"]?>"><?=$elem["NAME"]?></a>
                            <?endforeach;?>
                        </div>
                    </div>
                <?endif;
            endforeach?>
        </div>

        <div class="brands-list active">
            <?foreach($arResult["ITEMS"] as $arItem):
                if($arItem['PROPERTIES']['BRANDS_TOP']['VALUE'] || $arItem['PROPERTIES']['HEROES_TOP']['VALUE'] == 'Да'):?>
                <div class="heroes-item">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="heroes-item__img">
                        <picture class="notes-page__img">
                            <source srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>" media="(max-width: 576.98px)">
                            <source srcset="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>" media="(min-width: 577px)">
                            <img src="<?=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']?>" alt="<?=$arItem["NAME"]?>">
                        </picture>
                    </a>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                </div>
            <?endif;
            endforeach;?>
        </div>
    </div>
</div>

<section class="text-block">
    <div class="container">
        <div class="section__title">
            <h2>Интернет-магазин «ВсёДляДеток.ру»</h2>
        </div>
        <span class="hideElem active" data-scroll="start">описание</span>
        <div class="showElem active">
            <div class="column">
                <p>
                    Сеть магазинов работает в среднем ценовом сегменте. Целевой аудиторией компании являются семьи  со средними доходами, к которым относится большинство посетителей  торговых центров. Современный супермаркет ВсеДляДеток.ру включает около 20-30 тыс. наименований товаров детского ассортимента: игрушки, одежда и обувь, товары для новорожденных, канцелярские товары, наборы для творчества, товары для активного отдыха, автокресла, мебель.
                </p>
                <p>
                    Группа компаний ВсеДляДеток.ру укрепляет лидирующие позиции на рынке детских товаров, сохраняя высокие темпы развития на протяжении последних лет. Так, в 2018 году распахнули свои двери 100 новых магазина сети ВсеДляДеток.ру. Магазины сети ВсеДляДеток.ру посетили свыше 220 млн человек. Выручка ВсеДляДеток.ру по итогам 2018 года составила 110,9 млрд руб. (+14,3% год к году), при этом доля на рынке детских товаров составила 23%.
                </p>
            </div>
        </div>
    </div>
</section>
