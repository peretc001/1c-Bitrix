<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
foreach ($arResult['ITEMS'] as $key => $item) {
        $file = [];
		
		 $file_s = CFile::ResizeImageGet($item['DETAIL_PICTURE'], array('width' => 67, 'height' => 70), BX_RESIZE_IMAGE_EXACT , true);
        $file_b = CFile::ResizeImageGet($item['DETAIL_PICTURE'], array('width' => 363, 'height' => 363), BX_RESIZE_IMAGE_EXACT , true);
        $file[] = [
            'SMALL' => $file_s,
            'BIG'   => $file_b
        ];
		
        if (is_array($item['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
            foreach ($item['PROPERTIES']['MORE_PHOTO']['VALUE'] as $value) {
                $file_sm = CFile::ResizeImageGet($value, array('width' => 67, 'height' => 70), BX_RESIZE_IMAGE_EXACT , true);
                $file_big = CFile::ResizeImageGet($value, array('width' => 363, 'height' => 363), BX_RESIZE_IMAGE_EXACT , true);
                $file[] = [
                    'SMALL' => $file_sm,
                    'BIG'   => $file_big
                ];
            }
        }
       $res = CIBlockSection::GetByID($item["IBLOCK_SECTION_ID"]);
		if($ar_res = $res->GetNext()) $arResult['ITEMS'][$key]['SECTION_ID'] = $ar_res['NAME'];

        $arResult['ITEMS'][$key]['GALLERY'] = $file;
    }
	