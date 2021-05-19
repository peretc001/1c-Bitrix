<?//Bonus
if(CModule::IncludeModule('iblock')):
    $arSelect = Array("ID", "NAME", "PROPERTY_BANNER_DESCTOP", "PROPERTY_BANNER_MOBILE", "PROPERTY_BANNER_LINK", "PROPERTY_BANNER_SHOW", "PROPERTY_BANNER_SHOW_COUNT");
    $arFilter = Array("IBLOCK_ID" => 6, "PROPERTY_BANNER_SHOW_VALUE" => 'Да', "PROPERTY_BANNER_SHOW_COUNT_VALUE" => '1', "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if ($res):?>
        <div class="bonus">
            <div class="container">
                <?while($ob = $res->GetNextElement()):
                    $arFields = $ob->GetFields();

                    if (!empty($arFields["PROPERTY_BANNER_DESCTOP_VALUE"])):
                        $photo_desctop = CFile::GetPath($arFields["PROPERTY_BANNER_DESCTOP_VALUE"]);
                    endif;
                    if (!empty($arFields["PROPERTY_BANNER_MOBILE_VALUE"])):
                        $photo_mobile = CFile::GetPath($arFields["PROPERTY_BANNER_MOBILE_VALUE"]);
                    endif;
                    if (!empty($arFields["PROPERTY_BANNER_LINK_VALUE"])):
                        $link = $arFields["PROPERTY_BANNER_LINK_VALUE"];
                    endif?>

                    <a class="bonus-item" href="<?=$link?>">
                        <img data-src="<?=$photo_desctop?>"
                             data-desctop="<?=$photo_desctop?>"
                             data-mobile="<?=$photo_mobile?>"
                             data-lazy="<?=$photo_desctop?>"
                             src="<?=$photo_desctop?>"
                             alt=""></a>
                <?endwhile;?>
            </div>
        </div>
    <?endif;
endif?>