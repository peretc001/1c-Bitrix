<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$offer = intval($_REQUEST["offer"]);
if ($offer > 0):
    foreach ($arResult['JS_OFFERS'] as $key => $jsOffer):
        if ($jsOffer["ID"] == $offer):
            $arResult['OFFERS_SELECTED'] = $key;
            break;
        endif;
    endforeach;
endif;

#SKU
$arSKU = CCatalogSKU::getOffersList(
    $arResult['ID'],
    $iblockID = 0,
    $skuFilter = array('ACTIVE' => 'Y'),
    $fields = array('NAME', 'PREVIEW_PICTURE'),
    $propertyFilter = array("CODE"=>array('SIZE', 'COLOR'))
);
if(!empty($arSKU)):
    #CURRENT
    $arResult['CURRENT_OFFER'] = $offer > 0 ? $arSKU[$arResult['ID']][$offer] : current($arSKU[$arResult['ID']]);
    #SIZE
    foreach($arSKU[$arResult['ID']] as $item):
        if($item['PROPERTIES']['COLOR']['VALUE'] == $arResult['CURRENT_OFFER']['PROPERTIES']['COLOR']['VALUE'])
        $arResult['OFFER_SIZE'][$item['ID']] = $item;
    endforeach;
    #COLOR
    foreach($arSKU[$arResult['ID']] as $item):
        $arColor[$item['ID']][] = $item['PROPERTIES']['COLOR']['VALUE'];
    endforeach;
    $arColor = array_map( 'unserialize', array_unique(array_map( 'serialize', $arColor )));
    foreach($arColor as $key => $item):
        $arResult['OFFER_COLOR'][$key] = $arSKU[$arResult['ID']][$key];
    endforeach;
endif;


#MORE_PHOTO
$arResult['MORE_PHOTO'] = array();
if(!empty($arResult['PREVIEW_PICTURE']['ID'])):
    $arPrev = [
        'ID' => $arResult['PREVIEW_PICTURE']['ID'],
        'DESCRIPTION' => $arResult['PREVIEW_PICTURE']['DESCRIPTION'],
        'SRC' => $arResult['PREVIEW_PICTURE']['SRC'],
        'THUMB' => CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']
    ];
    array_push($arResult['MORE_PHOTO'], $arPrev);
    unset($arPrev);
endif;
if(!empty($arResult['DETAIL_PICTURE']['ID'])):
    $arDetail = [
        'ID' => $arResult['DETAIL_PICTURE']['ID'],
        'DESCRIPTION' => $arResult['DETAIL_PICTURE']['DESCRIPTION'],
        'SRC' => $arResult['DETAIL_PICTURE']['SRC'],
        'THUMB' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']
    ];
    array_push($arResult['MORE_PHOTO'], $arDetail);
    unset($arDetail);
endif;
if(isset($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])):
    foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $item):
        $FILE = CFile::GetFileArray($item);
        if(is_array($FILE)):
            $THUMB = CFile::ResizeImageGet($FILE, array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $arResult['MORE_PHOTO'][] = [
                'ID' => $FILE['ID'],
                'DESCRIPTION' => $arResult["PROPERTIES"]["MORE_PHOTO"]['DESCRIPTION'][$key],
                'SRC' => $FILE['SRC'],
                'THUMB' => CFile::ResizeImageGet($FILE['ID'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']
            ];
        endif;
    endforeach;
endif;

if(!empty($arResult['OFFERS'])):
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']];
    if(!empty($actualItem['PREVIEW_PICTURE']['ID'])):
        $arPrev = [
            'ID' => $actualItem['PREVIEW_PICTURE']['ID'],
            'DESCRIPTION' => $actualItem['PREVIEW_PICTURE']['DESCRIPTION'],
            'SRC' => $actualItem['PREVIEW_PICTURE']['SRC'],
            'THUMB' => CFile::ResizeImageGet($actualItem['PREVIEW_PICTURE']['ID'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']
        ];
        array_push($arResult['MORE_PHOTO'], $arPrev);
        unset($arPrev);
    endif;
    if(!empty($actualItem['DETAIL_PICTURE']['ID'])):
        $arDetail = [
            'ID' => $actualItem['DETAIL_PICTURE']['ID'],
            'DESCRIPTION' => $actualItem['DETAIL_PICTURE']['DESCRIPTION'],
            'SRC' => $actualItem['DETAIL_PICTURE']['SRC'],
            'THUMB' => CFile::ResizeImageGet($actualItem['DETAIL_PICTURE']['ID'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']
        ];
        array_push($arResult['MORE_PHOTO'], $arDetail);
        unset($arDetail);
    endif;
    if(isset($actualItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($actualItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])):
        foreach($actualItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $item):
            $FILE = CFile::GetFileArray($item);
            if(is_array($FILE)):
                $arResult['MORE_PHOTO'][] = [
                    'ID' => $FILE['ID'],
                    'DESCRIPTION' => $actualItem["PROPERTIES"]["MORE_PHOTO"]['DESCRIPTION'][$key],
                    'SRC' => $FILE['SRC'],
                    'THUMB' => CFile::ResizeImageGet($FILE['ID'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']
                ];
            endif;
        endforeach;
    endif;
endif;


//Бренд
$IBLOCK_ID = 10;
$arFilter = Array('IBLOCK_ID' => $IBLOCK_ID, 'NAME' => $arResult['PROPERTIES']['CML2_MANUFACTURER']['VALUE'] );
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, Array('ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT'));
while($ob = $res->GetNextElement()):
    $arFields = $ob->GetFields();
    $arrBrand = array();
    $FILE = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
    $THUMB = CFile::ResizeImageGet($FILE, array('width'=>150, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    !empty($THUMB['src']) ? $arResult['PROPERTIES']['CML2_MANUFACTURER']['PREVIEW_PICTURE'] = $THUMB['src'] : '';
    !empty($arFields['PREVIEW_TEXT']) ? $arResult['PROPERTIES']['CML2_MANUFACTURER']['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'] : '';
endwhile;

//Избранное
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 6;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arResult['favorite'] = false;
if($USER->IsAuthorized()):
    $idUser = $USER->GetID();

    $data = array(
        "UF_FAVORITE_ID" => (int)empty($arResult['CURRENT_OFFER']) ? $arResult["ID"] : $arResult['CURRENT_OFFER']['ID'],
        "UF_FAVORITE_USER_ID" => $idUser,
    );
    $rsData = $entity_data_class::getList(array(
        "select" => array('ID', 'UF_FAVORITE_ID', 'UF_FAVORITE_USER_ID'),
        "filter" => $data
    ));
    while($getID = $rsData->Fetch()):
        $id = $getID['ID'];
    if($id) $arResult['favorite'] = true;
    endwhile;
endif;
unset($data, $rsData, $getID, $id, $entity_data_class);

#ОТЗЫВЫ
$hlbl = 7;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$arResult['REVIEW'] = false;

$rsData = $entity_data_class::getList(array(
    "select" => array('ID', 'UF_REVIEW_NAME', 'UF_REVIEW_RATING', 'UF_REVIEW_ADVANTAGE', 'UF_REVIEW_DISADVANTAGE', 'UF_REVIEW_COMMENT', 'UF_REVIEW_LIKE', 'UF_REVIEW_DISLIKE', 'UF_REVIEW_PARENT', 'UF_REVIEW_DATE', 'UF_REVIEW_PHOTO'),
    'order' => array('ID' => 'DESC'),
    "filter" => array('UF_REVIEW_ID' => $arResult['ID'], 'UF_REVIEW_PARENT' => '')
));
while($getReview = $rsData->Fetch()):
    $arResult['REVIEW'][] = $getReview;
    $rating[] =  $getReview['UF_REVIEW_RATING'];
endwhile;

$arResult['REVIEW_PRODUCT'] = [
    'COUNT' => !empty($arResult['REVIEW']) ? count($arResult['REVIEW']) : 0,
    'RATING' => round(array_sum($rating)/count($arResult['REVIEW']))
];