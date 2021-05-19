<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
/*echo "<pre>";
print_r($arResult);
echo "</pre>";
die;*/
?>
<!-- rs-product -->
<div class="block-013">

    <div class="container" id="product-page">
        <div class="row">
            <input type="hidden" name="product_name" value="<?= $arResult['NAME'] ?>">
            <input type="hidden" name="product_link" value="<?= $arResult['DETAIL_PAGE_URL'] ?>">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="thumbnail">
                    <div class="carousel2">

                        <? if (is_array($arResult['GALLERY'])) { ?>
                            <?php foreach ($arResult['GALLERY'] as $key => $item) { ?>
                                <? if ($key == 0) { ?>
                                    <div class="item">
                                        <div class="product-carousel-item">
                                            <? if ($item['BIG']['src']) { ?>
                                                <a href="<?= $item['ORIGINAL']['SRC'] ?>" data-fancybox="gallery">
                                                    <img src="<?= $item['BIG']['src'] ?>" alt>
                                                </a>
                                            <? } else { ?>
                                                <i class="fa fa-camera"></i>
                                            <? } ?>
                                        </div>
                                    </div>
                                <? } else { ?>
                                    <div class="item">
                                        <div class="product-carousel-item">
                                            <a href="<?= $item['ORIGINAL']['SRC'] ?>" data-fancybox="gallery">
                                                <img src="<?= $item['ORIGINAL']['SRC'] ?>" alt>
                                            </a>
                                        </div>
                                    </div>
                                <? } ?>
                            <? } ?>
                        <? } ?>

                    </div>

                    <? if (is_array($arResult['GALLERY'])) { ?>
                        <div class="small-slider">
                            <?php foreach ($arResult['GALLERY'] as $i => $Ritem) { ?>
                                <? if ($i == 0) { ?>
                                    <? if ($Ritem['SMALL']['src']) { ?>
                                        <div class="small-slider-item">
                                            <img src="<?= $Ritem['SMALL']['src'] ?>" alt="" class="img-responsive">
                                        </div>
                                    <? } ?>
                                <? } else { ?>
                                    <div class="small-slider-item">
                                        <img src="<?= $Ritem['SMALL']['src'] ?>" alt="" class="img-responsive">
                                    </div>
                                <? } ?>
                            <? } ?>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <h1 class="product-title"><?=$arResult['NAME'] ?></h1>
                <? if ($arResult['PREVIEW_TEXT']) { ?>
                    <div class="block-013__description" style="margin-bottom: 15px;">
                        <?= $arResult['PREVIEW_TEXT']; ?>
                    </div>
                <? } ?>
				<div style="width: 100%;text-align: center;">
					<? if ($arResult["PROPERTIES"]['PRICE']['VALUE']) { ?>
						<p class="block-013__price" style="margin-right: 40px;">
							<?= $arResult["PROPERTIES"]['PRICE']['VALUE']; ?>
							<? if ($arResult["PROPERTIES"]['PRICECURRENCY']['VALUE'] == 'руб.') echo '<i class="fa fa-rub" aria-hidden="true"></i>'; else echo $arResult["PROPERTIES"]['PRICECURRENCY']['VALUE'] ?>
						</p>
					<? } ?>
					<button class="b24-web-form-popup-btn-15" style="margin-left: 0;">Заказать</button> 
				</div>
                <? if ($arResult['DETAIL_TEXT']) { ?>
                    <div class="block-013__description">
                        <?= $arResult['DETAIL_TEXT']; ?>
                    </div>
                <? } ?>

				<!-- <a href="" data-toggle="modal" data-target="#ModalPresentation" class="btn">Презентация</a> -->

                <div class="row">
                    <div class="col-xs-12 success"></div>
                </div>
            </div>
        </div>
		<?/*<hr>
					<a href="https://ok.ru/group/55262589157475" target="_blank" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fab fa-odnoklassniki fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://vk.com/gk22bek" target="_blank" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fab fa-vk fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://www.facebook.com/gk22bek/" target="_blank" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://wa.me/79650111125" target="_blank" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://www.youtube.com/channel/UCRPI4co92zKaSejJIGBmBrw?view_as=subscriber" target="_blank" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                        </span>
					</a>
					<a href="https://www.instagram.com/gk_22bek/" target="_blank" style="color: #42af6e;">
						<span class="fa-stack fa-lg">
				        	<i class="fas fa-square fa-stack-2x"></i>
				        	<i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                        </span>
					</a>*/
			?>
		<?$manufacturer = $arResult['PROPERTIES']['MANUFACTURER']['VALUE'];
		$manRes = CIBlockElement::GetList(Array(), Array("NAME" => $manufacturer), false, Array(), Array("ID", "NAME", "DETAIL_PAGE_URL"));
		$manOb = $manRes->GetNextElement();
		$manFields = $manOb->GetFields();
		$sectionRes = CIBlockSection::GetByID($arResult['IBLOCK_SECTION_ID']);
		$sectionArray = $sectionRes->GetNext();?>
		<p class="bottomFields">Производитель: <?if ($manFields['ID'] > 0):?><a href="<?=$manFields['DETAIL_PAGE_URL']?>"><?=$manFields['NAME']?></a><?else: echo $manufacturer;?><?endif?></p>
		<p class="bottomFields">Категория: <a href="<? echo $sectionArray['SECTION_PAGE_URL']; ?>"><? echo $sectionArray['NAME']; ?></a></p>
    </div>
	
</div>
<div class="block-014" style="margin-top: 0px;">
    <div class="block-014__tabs">
		<? if ($arResult['PROPERTIES']['TECH']['~VALUE']) { ?>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-1" data-toggle="tab" id="link-1" onclick="state('1');">Технические характеристики</a></li>
			</ul>
			<div class="block-014__description">
				<div class="container">
					<div class="tab-content">
							<div class="tab-pane active fade in" id="tab-1">
								<?= $arResult['PROPERTIES']['TECH']['~VALUE']['TEXT'] ?>
							</div>
					</div>
				</div>
			</div>
		<?}?>
		<? if (count($arResult['TABS']['CATALOGS']) > 0) { ?>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-1" data-toggle="tab" id="link-2" onclick="state('2');">Каталоги</a></li>
			</ul>	
			<div class="block-014__description">
				<div class="container">
					<div class="tab-content">
							<div class="tab-pane active fade in" id="tab-2">
                            <div class="row block-016">
                                <?php foreach ($arResult['TABS']['CATALOGS'] as $item) {
                                    $file = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 193, 'height' => 211), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                    ?>
                                    <? if ($file['src']){ ?>
                                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 block-015 product-item">
                                            <div class="thumbnail">
                                                <div class="thumbnail-img">
                                                    <div class="thumbnail-icons">
                                                        <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank"><i class="fa fa-eye"></i></a>
                                                        <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank" download=""><i class="fa fa-download"></i></a>


                                                        <? $x_filez = CFile::GetPath($item['BLOCK_FILE']);
                                                        $x_filez_all = round(filesize($_SERVER['DOCUMENT_ROOT'] . $x_filez)/(1024*1024), 2);
                                                        ?>

                                                        <?php echo  '<h5 class="sizer"><strong>Размер: </strong>' . $x_filez_all . ' мб</h5>'; ?>

                                                    </div>
                                                    <div class="thumbnail-background" style="background-image: url('<?= $file['src']; ?>');" title="<?=$item['NAME']?>">
                                                        <!--<img src="<?= $file['src']; ?>" alt="<?=$item['NAME']?>">-->
                                                    </div>
                                                </div>
                                                <div class="thumbnail-inner">
                                                    <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank">
                                                        <p><?=$item['NAME']?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                    <? unset($file); ?>
                                <? } ?>
                            </div>
							</div>
					</div>
				</div>
			</div>			
		<?}?>
		<? if (count($arResult['TABS']['CERTIFICATE']) > 0) { ?>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-3" data-toggle="tab" id="link-3" onclick="state('3');">Сертификаты</a></li>
			</ul>
			<div class="block-014__description">
				<div class="container">
					<div class="tab-content">
						<div class="tab-pane active fade in" id="tab-3">
                            <div class="row block-016">
                                <?php foreach ($arResult['TABS']['CERTIFICATE'] as $item) {
                                    $file = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 193, 'height' => 211), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                    ?>
                                    <? if ($file['src']){ ?>
                                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 block-015 product-item">
                                            <div class="thumbnail">
                                                <div class="thumbnail-img">
                                                    <div class="thumbnail-icons">
                                                        <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank"><i class="fa fa-eye"></i></a>
                                                        <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank" download=""><i class="fa fa-download"></i></a>


                                                        <? $x_filez = CFile::GetPath($item['BLOCK_FILE']);
                                                        $x_filez_all = round(filesize($_SERVER['DOCUMENT_ROOT'] . $x_filez)/(1024*1024), 2);
                                                        ?>

                                                        <?php echo  '<h5 class="sizer"><strong>Размер: </strong>' . $x_filez_all . ' мб</h5>'; ?>

                                                    </div>
                                                    <div class="thumbnail-background" style="background-image: url('<?= $file['src']; ?>');" title="<?=$item['NAME']?>">
                                                        <!--<img src="<?= $file['src']; ?>" alt="<?=$item['NAME']?>">-->
                                                    </div>
                                                </div>
                                                <div class="thumbnail-inner">
                                                    <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank">
                                                       <p><?=$item['NAME']?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                <? unset($file); ?>
                                <? } ?>
                            </div>
						</div>
					</div>
				</div>
			</div>
		<?}?>
		<? if (count($arResult['TABS']['INSTRUCTIONS']) > 0) { ?>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab-4" data-toggle="tab" id="link-4" onclick="state('4');">Инструкции</a></li>
			</ul>
			<div class="block-014__description">
				<div class="container">
					<div class="tab-content">
						<div class="tab-pane active fade in" id="tab-4">
                            <div class="row block-016">
                                <?php foreach ($arResult['TABS']['INSTRUCTIONS'] as $item) {
                                    $file = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 193, 'height' => 211), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                    ?>
                                    <? if ($file['src']){ ?>
                                        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 block-015 product-item">
                                            <div class="thumbnail">
                                                <div class="thumbnail-img">
                                                    <div class="thumbnail-icons">
                                                        <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank"><i class="fa fa-eye"></i></a>
                                                        <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank" download=""><i class="fa fa-download"></i></a>


                                                        <? $x_filez = CFile::GetPath($item['BLOCK_FILE']);
                                                        $x_filez_all = round(filesize($_SERVER['DOCUMENT_ROOT'] . $x_filez)/(1024*1024), 2);
                                                        ?>

                                                        <?php echo  '<h5 class="sizer"><strong>Размер: </strong>' . $x_filez_all . ' мб</h5>'; ?>

                                                    </div>
                                                    <div class="thumbnail-background" style="background-image: url('<?= $file['src']; ?>');" title="<?=$item['NAME']?>">
                                                        <!--<img src="<?= $file['src']; ?>" alt="<?=$item['NAME']?>">-->
                                                    </div>
                                                </div>
                                                <div class="thumbnail-inner">
                                                    <a href="<?=CFile::GetPath($item['BLOCK_FILE']);?>" target="_blank">
                                                        <p><?=$item['NAME']?></p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                    <? unset($file); ?>
                                <? } ?>
                            </div>							
						</div>
					</div>
				</div>
			</div>		
		<?}?>
    </div>
</div>
<? if ($arResult['WITHBUY']) { ?>
    <div class="block-015">
        <div class="container">
            <h1>C этим товаром покупают</h1>
            <div class="row">

                <?php foreach ($arResult['WITHBUY'] as $item) {
                    //var_dump($item['FIELDS']['DETAIL_PICTURE']);
                    $file = CFile::ResizeImageGet($item['FIELDS']['DETAIL_PICTURE'], array('width' => 261, 'height' => 211), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    ?>
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">

                        <? if ($file['src']){ ?>
						<a href="<?= $item['FIELDS']['DETAIL_PAGE_URL'].'/' ?>">

                            <? } else{ ?>
                            <a href="<?= $item['FIELDS']['DETAIL_PAGE_URL'].'/' ?>">
                                <i class="fa fa-camera"></i>
                                <? } ?>
                                <div class="thumbnail">
                                    <img src="<?= $file['src'] ?>" alt="">
                                    <p><?= $item['FIELDS']['NAME'] ?></p>
                                </div>
                            </a>
                    </div>
                <? } ?>
                <? unset($file); ?>
            </div>
        </div>
    </div>

<? } ?>
<script id="bx24_form_button" data-skip-moving="true">
        (function(w,d,u,b){w['Bitrix24FormObject']=b;w[b] = w[b] || function(){arguments[0].ref=u;
                (w[b].forms=w[b].forms||[]).push(arguments[0])};
                if(w[b]['forms']) return;
                var s=d.createElement('script');s.async=1;s.src=u+'?'+(1*new Date());
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://22bek.bitrix24.ru/bitrix/js/crm/form_loader.js','b24form');

        b24form({"id":"15","lang":"ru","sec":"fsq49s","type":"button","click":""});
</script>
