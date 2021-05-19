<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
mb_internal_encoding("UTF-8");


$arResult['WORD']['RUS'] = array('А','Б','В','Г','Д','Е','Ж','З','И','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Э','Ю','Я', 0);
$arResult['WORD']['ENG'] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

$IBLOCK_ID = $arParams['IBLOCK_ID'];
$arFilter = Array('IBLOCK_ID' => $IBLOCK_ID );
$res = CIBlockElement::GetList(Array('NAME' => 'ASC'), $arFilter, false, false, Array('ID', 'NAME', 'DETAIL_PAGE_URL'));
while($ob = $res->GetNextElement()):
    $arFields = $ob->GetFields();

    $WORD = mb_substr(trim($arFields["NAME"]), 0, 1);
    if(is_numeric($WORD)):
        $arResult['WORD']['BRAND'][0][] = [
            'ID' => $arFields["ID"],
            'NAME' => $arFields["NAME"],
            'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"]
        ];
    endif;
endwhile;
unset($arFilter, $res,$ob, $arFields);

$arFilter = Array('IBLOCK_ID' => $IBLOCK_ID );
$res = CIBlockElement::GetList(Array('NAME' => 'ASC'), $arFilter, false, false, Array('ID', 'NAME', 'DETAIL_PAGE_URL'));
while($ob = $res->GetNextElement()):
    $arFields = $ob->GetFields();
    $WORD = mb_substr(trim($arFields["NAME"]), 0, 1);
    switch ($WORD):
        case 'A':
            $arResult['WORD']['BRAND']['A'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'A'];
            break;
        case 'B':
            $arResult['WORD']['BRAND']['B'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'B'];
            break;
        case 'C':
            $arResult['WORD']['BRAND']['C'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'C'];
            break;
        case 'D':
            $arResult['WORD']['BRAND']['D'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'D'];
            break;
        case 'E':
            $arResult['WORD']['BRAND']['E'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'E'];
            break;
        case 'F':
            $arResult['WORD']['BRAND']['F'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'F'];
            break;
        case 'G':
            $arResult['WORD']['BRAND']['G'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'G'];
            break;
        case 'H':
            $arResult['WORD']['BRAND']['H'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'H'];
            break;
        case 'I':
            $arResult['WORD']['BRAND']['I'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'I'];
            break;
        case 'J':
            $arResult['WORD']['BRAND']['J'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'J'];
            break;
        case 'K':
            $arResult['WORD']['BRAND']['K'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'K'];
            break;
        case 'L':
            $arResult['WORD']['BRAND']['L'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'L'];
            break;
        case 'M':
            $arResult['WORD']['BRAND']['M'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'M'];
            break;
        case 'N':
            $arResult['WORD']['BRAND']['N'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'N'];
            break;
        case 'O':
            $arResult['WORD']['BRAND']['O'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'O'];
            break;
        case 'P':
            $arResult['WORD']['BRAND']['P'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'P'];
            break;
        case 'Q':
            $arResult['WORD']['BRAND']['Q'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Q'];
            break;
        case 'R':
            $arResult['WORD']['BRAND']['R'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'R'];
            break;
        case 'S':
            $arResult['WORD']['BRAND']['S'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'S'];
            break;
        case 'T':
            $arResult['WORD']['BRAND']['T'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'T'];
            break;
        case 'U':
            $arResult['WORD']['BRAND']['U'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'U'];
            break;
        case 'V':
            $arResult['WORD']['BRAND']['V'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'V'];
            break;
        case 'W':
            $arResult['WORD']['BRAND']['W'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'W'];
            break;
        case 'X':
            $arResult['WORD']['BRAND']['X'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'X'];
            break;
        case 'Y':
            $arResult['WORD']['BRAND']['Y'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Y'];
            break;
        case 'Z':
            $arResult['WORD']['BRAND']['Z'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Z'];
            break;

        case 'А':
            $arResult['WORD']['BRAND']['А'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'А'];
            break;
        case 'Б':
            $arResult['WORD']['BRAND']['Б'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Б'];
            break;
        case 'В':
            $arResult['WORD']['BRAND']['В'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'В'];
            break;
        case 'Г':
            $arResult['WORD']['BRAND']['Г'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Г'];
            break;
        case 'Д':
            $arResult['WORD']['BRAND']['Д'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Д'];
            break;
        case 'Е':
            $arResult['WORD']['BRAND']['Е'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Е'];
            break;
        case 'Ж':
            $arResult['WORD']['BRAND']['Ж'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Ж'];
            break;
        case 'З':
            $arResult['WORD']['BRAND']['З'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'З'];
            break;
        case 'И':
            $arResult['WORD']['BRAND']['И'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'И'];
            break;
        case 'К':
            $arResult['WORD']['BRAND']['К'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'К'];
            break;
        case 'Л':
            $arResult['WORD']['BRAND']['Л'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Л'];
            break;
        case 'М':
            $arResult['WORD']['BRAND']['М'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'М'];
            break;
        case 'Н':
            $arResult['WORD']['BRAND']['Н'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Н'];
            break;
        case 'О':
            $arResult['WORD']['BRAND']['О'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'О'];
            break;
        case 'П':
            $arResult['WORD']['BRAND']['П'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'П'];
            break;
        case 'Р':
            $arResult['WORD']['BRAND']['Р'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Р'];
            break;
        case 'С':
            $arResult['WORD']['BRAND']['С'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'С'];
            break;
        case 'Т':
            $arResult['WORD']['BRAND']['Т'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Т'];
            break;
        case 'У':
            $arResult['WORD']['BRAND']['У'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'У'];
            break;
        case 'Ф':
            $arResult['WORD']['BRAND']['Ф'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Ф'];
            break;
        case 'Х':
            $arResult['WORD']['BRAND']['Х'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Х'];
            break;
        case 'Ц':
            $arResult['WORD']['BRAND']['Ц'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Ц'];
            break;
        case 'Ч':
            $arResult['WORD']['BRAND']['Ч'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Ч'];
            break;
        case 'Ш':
            $arResult['WORD']['BRAND']['Ш'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Ш'];
            break;
        case 'Щ':
            $arResult['WORD']['BRAND']['Щ'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Щ'];
            break;
        case 'Э':
            $arResult['WORD']['BRAND']['Э'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Э'];
            break;
        case 'Ю':
            $arResult['WORD']['BRAND']['Ю'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Ю'];
            break;
        case 'Я':
            $arResult['WORD']['BRAND']['Я'][] = ['ID' => $arFields["ID"], 'NAME' => $arFields["NAME"], 'DETAIL_PAGE_URL' => $arFields["DETAIL_PAGE_URL"], 'WORD' => 'Я'];
            break;
    endswitch;
endwhile;
unset($arFilter, $res,$ob, $arFields);