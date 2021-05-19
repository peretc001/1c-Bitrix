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
$this->addExternalCss('/local/templates/19500/css/block-css/rs-page.css');
?>
<div class="rs-17">
	<div class="rs-page">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
						<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
							<h1 class="text-center">
								<?=$arResult["NAME"]?>
							</h1>
						<?endif;?>
				</div>
				<div class="col-xs-12 clearfix about-main">
					<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
						<img
							class="img-responsive"
							border="0"
							src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
							width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
							height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
							alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
							title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
							/>
					<?endif?>
									</div>
											<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
							<span class="rs-news-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
						<?endif;?>
<?
$rowSize=12;
if(!empty($arResult["PROPERTIES"]['GALERY']['VALUE'])){
	$rowSize-=3;
}
if(!empty($arResult["PROPERTIES"]['GOODS']['VALUE'])){
	$rowSize-=3;
}
?>					
						
					<div class="row">
<?if(!empty($arResult["PROPERTIES"]['GALERY']['VALUE'])): ?>	
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 block-016" style="border-bottom: none;">	
						<?global $statiGalley;
						$statiGalley['ID']=$arResult["PROPERTIES"]['GALERY']['VALUE'];?>				
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"gallery", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "statiGalley",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "gallery",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"MESS_BTN_COMPARE" => "Сравнить"
	),
	false
);?>						
						</div>
						<?endif ?>
						<div class="col-xs-12 col-sm-<?=$rowSize ?> col-md-<?=$rowSize ?> col-lg-<?=$rowSize ?>" style="text-align: justify;"><?echo $arResult["DETAIL_TEXT"];?></div>		
						<?if(!empty($arResult["PROPERTIES"]['GOODS']['VALUE'])): ?>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 block-015">
<? if ($arResult['WITHBUY']): ?>

                <?foreach ($arResult['WITHBUY'] as $item) {
                    //var_dump($item['FIELDS']['DETAIL_PICTURE']);
                    $file = CFile::ResizeImageGet($item['FIELDS']['DETAIL_PICTURE'], array('width' => 270, 'height' => 270), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <div  style="margin-bottom: 20px;">
                      <? if ($file['src']){ ?>
						<a href="<?= $item['FIELDS']['DETAIL_PAGE_URL'].'/' ?>"  >

                      <? } else{ ?>
                        <a href="<?= $item['FIELDS']['DETAIL_PAGE_URL'].'/' ?>">
                                <i class="fa fa-camera"></i>
                      <? } ?>
                                <div class="thumbnail">
                                    <img src="<?= $file['src'] ?>" alt="" style="border: none; margin: auto;">
                                    <p><?= $item['FIELDS']['NAME'] ?></p>
                                </div>
                            </a>
                </div>
                <? } ?>

				
<?endif ?>
							</div>
						<?endif ?>						
					</div>
					
					
					<hr>
					<a href="https://ok.ru/group/55262589157475" target="_blank" class="social-link" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fab fa-odnoklassniki fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://vk.com/gk22bek" target="_blank" class="social-link" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fab fa-vk fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://www.facebook.com/gk22bek/" class="social-link" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://www.youtube.com/channel/UCRPI4co92zKaSejJIGBmBrw?view_as=subscriber" target="_blank" class="social-link" style="color: #42af6e;">
						<span class="fa-stack fa-lg"">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://www.instagram.com/22bek_22bek/" target="_blank" class="social-link" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                        </span>
					</a>	
			</div>
		</div>
	</div>
</div>
