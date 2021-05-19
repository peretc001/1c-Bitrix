<?
use Bitrix\Currency\CurrencyTable;
use Bitrix\Iblock;
use Bitrix\Main\Type\Collection;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
 
if (!empty($arResult['PROPERTIES']['GOODS']['VALUE'])) {
    $arFil = Array("IBLOCK_ID" => 2, 'ID' => $arResult['PROPERTIES']['GOODS']['VALUE'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res2 = CIBlockElement::GetList(Array(), $arFil, false, false, $arSelect);
    while ($ob = $res2->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $arr2[] = [
            'FIELDS' => $arFields,
            'PROPS' => $arProps
        ];
    }
    $arResult['WITHBUY'] = $arr2;
}
 