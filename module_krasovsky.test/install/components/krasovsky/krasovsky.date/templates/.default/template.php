<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<div class="current-date">
    <p><?
        echo Loc::getMessage("KRASOVSKY_DATE_TMP_DATE");
        if ($arParams["DATE_FORMAT"] == 'Y-m-d H:i:s')
            echo Loc::getMessage("KRASOVSKY_DATE_TMP_TIME");
        ?>: <b><?=$arResult['DATE'];?></b>
    </p>
</div>
