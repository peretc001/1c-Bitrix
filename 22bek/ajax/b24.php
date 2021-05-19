<?
$managerIDs = [6, 7, 17];

//var_dump($managerIDs);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

function getNewABID2()
{
    global $managerIDs;
    $abidNextI = \Bitrix\Main\Config\Option::get('main', 'abidNextI', 0);
    if($abidNextI >= count($managerIDs))
        $abidNextI = 0;
    \Bitrix\Main\Config\Option::set('main', 'abidNextI', $abidNextI+1);
    return $managerIDs[$abidNextI];
}

echo getNewABID() . ' ' . getNewABID() . ' ' . getNewABID() . ' ' . getNewABID();
