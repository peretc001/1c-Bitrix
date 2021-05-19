<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);

$NavPageSize = $arResult['NAV_RESULT']->NavPageSize;
$NavPageNomer = $arResult['NAV_RESULT']->NavPageNomer;
$NavRecordCount = $arResult['NAV_RESULT']->NavRecordCount;

?>

	<?php
			$filebaner = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width' => 848, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	?>
	<?if($filebaner['src']){?>
	<img src="<?=$filebaner['src']?>" class="img-responsive" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>">
	<?}?>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex">
            <div>
                <a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=name&method=asc" class="block-018__sorting-link">Сортировать по названию </a>
                <div class="dropdown sorting">
				<a href="<?=$arResult["SECTION_PAGE_URL"]?>" class="block-018__sorting-link" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" id="sortmanuf">
				Сортировать по производителю <b class="caret"></b>
				</a>
				<? foreach ($arResult['ITEMS'] as $arItem) {?>
						<?if($arItem["PROPERTIES"]['MANUFACTURER']['VALUE'])
																	$arr[] = $arItem["PROPERTIES"]['MANUFACTURER']['VALUE'];}
$arRes = array_unique($arr);
?>

				<ul class="dropdown-menu" aria-labelledby="sortmanuf">
					<li><a href="<?=$arResult["SECTION_PAGE_URL"]?>">Все производители</a></li>
					<? foreach($arRes as $aItem) {?>
						<li><a href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=manuf&value=<?=$aItem?>">
						<?=$aItem;?></a></li>
					<?}?>
				</ul>

			</div>
            </div>
			<div class="viewSwitch">
				<div class="viewSwitch__item tale-view <?if(empty($_COOKIE['view']) || $_COOKIE['view'] == 'tale'):?>selected<?endif?>"></div>
				<div class="viewSwitch__item line-view <?if($_COOKIE['view'] == 'line'):?>selected<?endif?>"></div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<h1 class="align-center"><?=($arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] ? $arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] : $arResult['NAME'])?></h1>
									<?
										if(!empty($arResult['ITEMS'])){
										foreach ($arResult['ITEMS'] as $key => $arItem) {
										 $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
										$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
										?>
										<?if(empty($_COOKIE['view']) || $_COOKIE['view'] == 'tale'):?>
											<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 product-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
												<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
													<div class="thumbnail">
															<?php
																$file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 262, 'height' => 284), BX_RESIZE_IMAGE_EXACT, true);
															?>
															<?if($file['src']){?>
															<img src="<?= $file['src']; ?>" alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>">
															<?} else{?>
																<div class="thumbnail-nophoto"><i class="fa fa-camera"></i></div>
															<?}?>
														<div class="thumbnail-inner">
															<p><?= $arItem["PROPERTIES"]['MANUFACTURER']['VALUE']; ?></p>
															<p><?= $arItem['NAME']; ?></p>

															<?if($arItem["PROPERTIES"]['PRICE']['VALUE']){?>
																	<p class="block-018__price"><?= $arItem["PROPERTIES"]['PRICE']['VALUE']; ?>
																	<?if($arItem["PROPERTIES"]['PRICECURRENCY']['VALUE']=='руб.') echo '<i class="fa fa-rub" aria-hidden="true"></i>'; else echo $arItem["PROPERTIES"]['PRICECURRENCY']['VALUE']?> </p>
																<?}?>

															<div  class="btn btn-color">Подробнее</div>
														</div>
													</div>
												</a>
											</div>
										<?else:?>
										<div class="line-view-container">
											<div class="col-xs-12 col-sm-12 col-lg-12 product-item line-view" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
												<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="col-xs-4 col-sm-2 line-thumb">
															<?php
																$file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 262, 'height' => 284), BX_RESIZE_IMAGE_EXACT, true);
															?>
															<?if($file['src']){?>
															<img src="<?= $file['src']; ?>" alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>">
															<?} else{?>
																<div class="thumbnail-nophoto"><i class="fa fa-camera"></i></div>
															<?}?>
												</a>
												<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="col-xs-8 col-sm-6  col-sm-offset-1 description">
													<div class="manufacturer"><?= $arItem["PROPERTIES"]['MANUFACTURER']['VALUE']; ?></div>
													<div class="title"><?= $arItem['NAME']; ?></div>
												</a>
												<div class="xs-hidden col-sm-3">
													<a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="link">Подробнее</a>
												</div>
											</div>
										</div>
										<?endif?>
									<? }
									} else echo '<div class="col-xs-12">В категории нет товаров.</div>'
									?>

	</div>
	<div class="row">
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	</div>
	<div id="section_description_text"><?=$arResult['DESCRIPTION']?></div>

<script>

</script>
