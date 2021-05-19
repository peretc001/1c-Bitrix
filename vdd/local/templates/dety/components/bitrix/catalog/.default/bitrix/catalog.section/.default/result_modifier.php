<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arColorTMP = array();
foreach ($arResult['ITEMS'] as $key => $offer):
    foreach ($offer['OFFERS'] as $j => $elem):
        $arColorTMP[$elem['ID']] = $elem['PROPERTIES']['COLOR']['VALUE'];
    endforeach;
endforeach;
$arColor = array_unique($arColorTMP);

//$arResult['ITEMS'];
//foreach ($arResult['ITEMS'] as $key => $offer):
//    if(!empty($offer['OFFERS'])):
//        foreach ($offer['OFFERS'] as $j => $elem):
//            if( array_key_exists($elem['ID'], $arColor)):
//                if($arResult['FILTERED_OFFERS_ID']):
//                    foreach ($arResult['FILTERED_OFFERS_ID'] as $of):
//                        foreach ($of as $ofID):
//                            if($ofID == $elem['ID']):
//                                $elem['DETAIL_PAGE_URL'] = $offer['DETAIL_PAGE_URL'] .'?offer='. $elem['ID'];
//                                $elem['PROPERTIES'] = $offer['PROPERTIES'];
//                                array_push($arResult['ITEMS'], $elem);
//                            endif;
//                        endforeach;
//                    endforeach;
//                else:
//                    $elem['DETAIL_PAGE_URL'] = $offer['DETAIL_PAGE_URL'] .'?offer='. $elem['ID'];
//                    $elem['PROPERTIES'] = $offer['PROPERTIES'];
//                    array_push($arResult['ITEMS'], $elem);
//                    echo $elem['ID'];
//                endif;
//            endif;
//        endforeach;
//        unset($arResult['ITEMS'][$key]);
//    endif;
//endforeach;


//debug($arResult['ITEMS'],1);
//$arSKU = CCatalogSKU::getOffersList(
//    $arResult['ID'],
//    $iblockID = 0,
//    $skuFilter = array('ACTIVE' => 'Y'),
//    $fields = array('NAME', 'PREVIEW_PICTURE'),
//    $propertyFilter = array("CODE"=>array('SIZE', 'COLOR'))
//);
//if(!empty($arSKU)):
//    #CURRENT
//    $arResult['CURRENT_OFFER'] = $offer > 0 ? $arSKU[$arResult['ID']][$offer] : current($arSKU[$arResult['ID']]);
//    #SIZE
//    foreach($arSKU[$arResult['ID']] as $item):
//        if($item['PROPERTIES']['COLOR']['VALUE'] == $arResult['CURRENT_OFFER']['PROPERTIES']['COLOR']['VALUE'])
//            $arResult['OFFER_SIZE'][$item['ID']] = $item;
//    endforeach;
//    #COLOR
//    foreach($arSKU[$arResult['ID']] as $item):
//        $arColor[$item['ID']][] = $item['PROPERTIES']['COLOR']['VALUE'];
//    endforeach;
//    $arColor = array_map( 'unserialize', array_unique(array_map( 'serialize', $arColor )));
//    foreach($arColor as $key => $item):
//        $arResult['OFFER_COLOR'][$key] = $arSKU[$arResult['ID']][$key];
//    endforeach;
//endif;
//debug($arResult['OFFER_COLOR'],1);