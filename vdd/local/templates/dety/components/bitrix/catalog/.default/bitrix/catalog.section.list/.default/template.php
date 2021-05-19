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
$this->addExternalCss(DEFAULT_TEMPLATE_PATH."/css/category/category.css");

if($APPLICATION->GetCurPage() == '/catalog/'):
    $APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
endif;

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


$APPLICATION->SetTitle($arResult["SECTION"]["NAME"]);
$APPLICATION->SetPageProperty("ADDITIONAL_TITLE", $arResult["SECTION"]["NAME"]);

$APPLICATION->SetPageProperty("title", $arResult["SECTION"]["NAME"]);
$APPLICATION->SetPageProperty("description", $arResult["SECTION"]["NAME"]);
$APPLICATION->SetPageProperty("keywords", $arResult["SECTION"]["NAME"]);

if ($arResult["SECTION"]["DEPTH_LEVEL"] == 0): $APPLICATION->SetTitle('Каталог'); endif;
?>
<div class="category">
    <div class="container">
        <h1><?$APPLICATION->ShowTitle(false);?></h1>
        <?if (0 < $arResult["SECTIONS_COUNT"]):?>
            <div class="row">
                <?
                foreach ($arResult['SECTIONS'] as &$arSection):
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

                    if (false === $arSection['PICTURE'] || NULL === $arSection['PICTURE'])
                        $arSection['PICTURE'] = array(
                            'SRC' => $arCurView['EMPTY_IMG'],
                            'ALT' => (
                            '' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
                                ? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
                                : $arSection["NAME"]
                            ),
                            'TITLE' => (
                            '' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
                                ? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
                                : $arSection["NAME"]
                            )
                        );

                    ?>
                    <div class="col-md-6 col-lg-6">
                        <div class="category-card">
                            <div class="category-card__img">
                                <a href="<?=$arSection['SECTION_PAGE_URL']?>">
                                    <img class="lazy" src="<?=$arSection['PICTURE']['SRC']?>" data-src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>">
                                </a>
                            </div>
                            <div class="category-card__text">
                                <p>
                                    <b>
                                        <a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
                                    </b>
                                </p>
                                <?
                                $curLevel = $arResult["SECTION"]["DEPTH_LEVEL"] + 2;
                                $res = CIBlockSection::GetList(
                                    Array('ID' => 'asc'),
                                    Array('SECTION_ID' => $arSection['ID'], 'DEPTH_LEVEL' => $curLevel, 'ACTIVE' => 'Y'), false, array('ID', 'NAME', 'SECTION_PAGE_URL')
                                );?>
                                <ul>
                                    <?
                                        $i = 0;
                                        while($row = $res->GetNext()):
                                            if($i < 6):
                                    ?>
                                        <li>
                                            <a href="<?=$row['SECTION_PAGE_URL']?>"><?=$row['NAME']?></a>
                                        </li>
                                    <?
                                            elseif($i == 6):
                                                $more = true;
                                            endif;
                                        $i++;
                                        endwhile;
                                    ?>
                                </ul>
                                <?if($more):?>
                                <a class="more" href="<?=$arSection['SECTION_PAGE_URL']?>">показать все</a>
                                <?endif?>
                            </div>

                        </div>
                    </div>
                <?
                endforeach;
                unset($arSection);
                ?>
            </div>
        <?endif?>
    </div>
</div>
