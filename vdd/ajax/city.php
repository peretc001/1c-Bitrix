<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
header('Content-Type: text/html; charset=utf-8');
global $DB;

if (isset($_REQUEST['term'])) {
    $connection = Bitrix\Main\Application::getConnection();
    $sqlHelper = $connection->getSqlHelper();

    $filterBy = $sqlHelper->convertFromDbString($_REQUEST['term']);
    $sql ="select * from b_city where city like '%".$filterBy."%' limit 10";

    $recordset = $connection->query($sql);
    while ($record = $recordset->fetch()):
        $response[] = ['value' => $record['city'], 'label' => $record['city']];
    endwhile;

    echo json_encode($response);
}


