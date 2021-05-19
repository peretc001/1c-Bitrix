<?

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");


header('Content-Type: text/html; charset=utf-8');
global $DB;

$results = $DB->Query("SELECT * FROM `b_event` ORDER BY ID desc");

$EMAIL = array();

while ($row = $results->Fetch())
{
    $EMAIL[] = $row;
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>

<table class="adm-list-table" id="tbl_perfmon_tabled2151012c0d0c5270b58f94f563166f6">
    <thead>
    <tr class="adm-list-table-header">
        <td class="adm-list-table-cell adm-list-table-cell-sort-up">
            <div class="adm-list-table-cell-inner">ID</div>
        </td>
        <td class="adm-list-table-cell adm-list-table-cell-sort">
            <div class="adm-list-table-cell-inner">EMAIL</div>
        </td>
        <td class="adm-list-table-cell adm-list-table-cell-sort">
            <div class="adm-list-table-cell-inner">Дата</div>
        </td>
        <td class="adm-list-table-cell adm-list-table-cell-sort">
            <div class="adm-list-table-cell-inner">Успешная отправка</div>
        </td>
    </tr>
    </thead>
    <tbody>
    <? foreach ($EMAIL as $item): ?>
        <tr class="adm-list-table-row">
            <td class="adm-list-table-cell"><span><?=$item['ID']?></span></td>
            <td class="adm-list-table-cell"><span>
                    <?=unserialize($item['C_FIELDS'])['AUTHOR_EMAIL']?>
                </span></td>
            <td class="adm-list-table-cell"><span><?=$item['DATE_INSERT']?></span></td>
            <td class="adm-list-table-cell"><span><?=$item['SUCCESS_EXEC'] == 'Y' ? 'Да' : 'Нет' ?></span></td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>
