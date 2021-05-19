<? if(CModule::IncludeModule("iblock")) {
    //GET ALL GENERAL CATEGORY
    $IBLOCK_ID = 4;
    $res = CIBlockSection::GetList(
        Array('ID' => 'asc'),
        Array('IBLOCK_ID' => $IBLOCK_ID, 'DEPTH_LEVEL' => 1, 'ACTIVE' => 'Y'), false, array('ID', 'NAME', 'SECTION_PAGE_URL', 'UF_ICON')
    );
    while($row = $res->GetNext()):
        if (!empty($row)):
            $arResult['MENU'][] = $row;
        endif;

        //GET SUBCATEGORY
        $res2 = CIBlockSection::GetList(
            Array('ID' => 'asc'),
            Array('SECTION_ID' => $row['ID'], 'DEPTH_LEVEL' => 2, 'ACTIVE' => 'Y'), false, array('ID', 'IBLOCK_SECTION_ID', 'NAME', 'SECTION_PAGE_URL')
        );
        while($list = $res2->GetNext()):
            $arResult['SUBMENU'][$row['ID']][] = $list;

            //GET SUBCATEGORY2
            $res3 = CIBlockSection::GetList(
                Array('ID' => 'asc'),
                Array('SECTION_ID' => $list['ID'], 'DEPTH_LEVEL' => 3, 'ACTIVE' => 'Y'), false, array('ID', 'IBLOCK_SECTION_ID', 'NAME', 'SECTION_PAGE_URL')
            );
            while($sublist = $res3->GetNext()):
                $arResult['SUBSUBMENU'][$list['ID']][] = $sublist;
            endwhile;
        endwhile;
    endwhile;
    unset($res,$res2,$res3,$row,$list,$sublist);
}?>