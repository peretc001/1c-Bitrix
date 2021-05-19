<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if ($arParams["DATE_FORMAT"])
    $arResult['DATE'] = date($arParams["DATE_FORMAT"]);
else
    $arResult['DATE'] = date('Y-m-d');

$this->IncludeComponentTemplate();
