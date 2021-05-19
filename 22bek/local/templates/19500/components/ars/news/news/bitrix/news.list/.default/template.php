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
$this->addExternalCss('/local/templates/19500/css/block-css/rs-news.css');
$this->addExternalCss('/local/templates/19500/css/block-css/rs-catalog.css');
?>
	  
<section class="rs-17">
	<div class="rs-news rs-catalog">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
						<? $APPLICATION->IncludeComponent(
										"bitrix:main.include",
										 "",
										 Array(
										 "AREA_FILE_SHOW"      => "file",
										"PATH"                => SITE_DIR . "include/index/article_title.php",
										"AREA_FILE_RECURSIVE" => "N",
										"EDIT_MODE"           => "text",
										),
										false,
										Array('HIDE_ICONS' => 'N')
						); ?>
				</div>
			</div>
			<div class="row">
				<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="col-xs-6 col-sm-6 col-md-3 news-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					
						<div class="news-item" data-nekoanim="fadeInUp" data-nekodelay="400">
						
							<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
									<a class="news-image" href="<?=$arItem["DETAIL_PAGE_URL"]?>"
									   style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>')"
									   title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" rel="nofollow">
									</a>
									<?else:?>
									<a class="news-image" href="<?=$arItem["DETAIL_PAGE_URL"]?>"
									   title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" rel="nofollow">
									   <i class="fa fa-camera"></i>
									</a>
							<?endif?>
							<div class="news-title">
								<h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>
							</div>
							<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
								<div class="news-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
							<?endif?>
							<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
								<div class="news-content">
									<p>	
										<? echo TruncateText(strip_tags($arItem['PREVIEW_TEXT']), 60); ?>
									</p>
								</div>
							<?endif;?>
							<div class="news-more"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-outline" rel="nofollow"><?echo GetMessage("BTN_LINK");?></a></div>
						</div>
					</div>
				<?endforeach;?>
			</div>
			<div class="pagination pull-left">
				<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
					<?=$arResult["NAV_STRING"]?>
				<?endif;?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</section>

