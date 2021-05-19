<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
//		if ($solution == "eshop")
//		{
//			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
//			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
//			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
//			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
//		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";


empty($arParams['SECTION_ID']) ? $arParams['SECTION_ID'] = $GLOBALS['SECTION_ID'] : '';
//catalog tree
$IBLOCK_ID = $arParams['IBLOCK_ID'];
$rs = CIBlockSection::GetList(
    array(),
    array('ID'=>$arParams['SECTION_ID'],'IBLOCK_ID'=>$IBLOCK_ID)
);
$ar = $rs->GetNext();
$rs = CIBlockSection::GetList(
    array('ID'=>'ASC'),
    array(
        'SECTION_ID'=>$arParams['SECTION_ID'],
    ),
    false,
    array('NAME', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL')
//    array(
//        'IBLOCK_ID'=>$IBLOCK_ID,
//        '>LEFT_MARGIN'=>$ar['LEFT_MARGIN'],
//        '<RIGHT_MARGIN'=>$ar['RIGHT_MARGIN'],
//    )
);
while($row = $rs->GetNext()):
    if (!empty($row)):
        $arResult['category'][] = $row;
    endif;
endwhile;

//$res = CIBlockSection::GetByID($arResult['category'][0]["IBLOCK_SECTION_ID"]);
//    if($ar_res = $res->GetNext()) $arResult['parent'] = $ar_res;
//$res2 = CIBlockSection::GetByID($arResult['parent']["IBLOCK_SECTION_ID"]);
//    if($ar_res2 = $res2->GetNext()) $arResult['general'] = $ar_res2;

unset($ar, $rs, $row, $res, $res2, $ar_res, $ar_res2);
