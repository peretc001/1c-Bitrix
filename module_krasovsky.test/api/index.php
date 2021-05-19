<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

$posts = json_decode(file_get_contents('php://input'), true);

if ($posts)
{

    #Определяем название Архивного инфоблока
    $res = CIBlockSection::GetByID($posts);
    if ($ar_res = $res->GetNext())
    {
        $res2 = CIBlock::GetByID($ar_res['IBLOCK_ID']);
        if ($ar_res2 = $res2->GetNext())
            $IBLOCK_NAME = $ar_res2['NAME'] ."_Архив";
    }


    #Ищем инфоблок Архив
    $res = CIBlock::GetList(
        Array(),
        Array(
            'SITE_ID'=>SITE_ID,
            "NAME" => $IBLOCK_NAME,
        ), true
    );
    while($result = $res->Fetch())
    {
        $ARCHIVE_ID = $result['ID'];
    }
    unset($result, $res);

    #Если такого нет - Создаем
    if (!$ARCHIVE_ID)
    {
        $IBLOCK = new CIBlock;

        $arINFO = Array(
            "ACTIVE" => "Y",
            "NAME" => $IBLOCK_NAME,
            "CODE" => "archive",
            "IBLOCK_TYPE_ID" => "test",
            "LID" => "s1",
        );

        $ARCHIVE_ID = $IBLOCK->Add($arINFO);


        if (!$ARCHIVE_ID)
        {
            echo $IBLOCK->LAST_ERROR;
        }
    }

    if ($ARCHIVE_ID)
    {
        #Раздел
        $SECTION = new CIBlockSection;
        $res = $SECTION->GetByID($posts);

        if($result = $res->GetNext()) {
            $NAME = $result['NAME'] . ' (' . date('Y-m-d H:i:s') . ')';

            $arFields = Array(
                "ACTIVE" => "N",
                "CODE" => $result["CODE"],
                "EXTERNAL_ID" => $result["EXTERNAL_ID"],
                "IBLOCK_SECTION_ID" => $result["IBLOCK_SECTION_ID"],
                "IBLOCK_ID" => $ARCHIVE_ID,
                "NAME" => $NAME,
                "SORT" => $result["SORT"],
                "DESCRIPTION" => $result["DESCRIPTION"],
                "DESCRIPTION_TYPE" => $result["DESCRIPTION_TYPE"],
                "LEFT_MARGIN" => $result["LEFT_MARGIN"],
                "RIGHT_MARGIN" => $result["RIGHT_MARGIN"],
                "DEPTH_LEVEL" => $result["DEPTH_LEVEL"],
                "DATE_CREATE" => $result["DATE_CREATE"],
                "CREATED_BY" => $result["CREATED_BY"],
                "DETAIL_PICTURE" => $result["DETAIL_PICTURE"],
                "SECTION_PROPERTY" => $result["SECTION_PROPERTY"]
            );

            $SECTION_ID = $SECTION->Add($arFields);

            if (!$SECTION_ID) {
                echo $SECTION_ID->LAST_ERROR;
            }
        }
        unset($result, $res, $SECTION);

        #Элементы раздела
        $ELEMENT = new CIBlockElement;
        $res = $ELEMENT->GetList(
            array('*'),
            array("IBLOCK_SECTION_ID"=>$posts)
        );
        while($result = $res->GetNextElement())
        {
            $arFields = $result->GetFields();
            $arProps = $result->GetProperties();
            $arElements[] = [
                'fields' => $arFields,
                'props' => $arProps
            ];
        }

        foreach ($arElements as $key => $item)
        {
            $NAME = $item['NAME'] . ' (Архивная копия от ' . date('Y-m-d H:i:s') . ')';

            $arELEMENT = Array(
                "NAME" => $NAME,
                "IBLOCK_ID" => $ARCHIVE_ID,
                "IBLOCK_SECTION_ID" => $SECTION_ID,
                "PROPERTY_VALUES" => $item["props"],
                "ACTIVE" => "N",
                "CODE" => $item['fields']["CODE"],
                "PREVIEW_TEXT" => $item['fields']["PREVIEW_TEXT"],
                "DETAIL_TEXT" => $item['fields']["DETAIL_TEXT"],
                "PREVIEW_PICTURE" => $item['fields']["PREVIEW_PICTURE"],
                "DETAIL_PICTURE" => $item['fields']["DETAIL_PICTURE"]
            );

            $ELEMENT_ID = $ELEMENT->Add($arELEMENT);

            if (!$ELEMENT_ID) {
                var_dump($ELEMENT->LAST_ERROR);
            } else {
                var_dump($ELEMENT_ID);
            }
        }

    }




//
//    if ($ID)
//    {
//        $response['status'] = true;
//    }
//    else {
//        $response['status'] = false;
//    }
//
//
//    echo json_encode($response);
//}


}


?>
