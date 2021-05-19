<?
// добавляем пункты меню в зависимости от прав
$aModuleMenuLinks[] = Array(
    'Список email',
    "/bitrix/admin/email_list.php",
    Array(),
    Array(
        "SEPARATOR"  => "Y",
        "SORT"       => 1000,
        "ICON"       => "/bitrix/images/support/mnu_support.gif",
        "BIG_ICON"   => "/bitrix/images/support/support.gif",
        "INDEX_PAGE" => "/bitrix/admin/email_list.php"
    )
);
?>
