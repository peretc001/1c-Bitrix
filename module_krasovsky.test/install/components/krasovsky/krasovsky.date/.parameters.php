<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParamList = array(
	'd-m-Y' => '01-01-2020',
	'd.m.Y' => '01-01-2020',
	'Y-m-d' => '2020-01-01',
	'Y.m.d' => '2020.01.01',
	'Y-m-d H:i:s' => '2020.01.01 00:00:00'
);

$arComponentParameters = array(
	"PARAMETERS" => array(
		'DATE_FORMAT'=>array(
			"PARENT" => "BASE",
			"NAME" => 'Формат даты',
			"TYPE" => 'LIST',
			"ADDITIONAL_VALUES" => "N",
			"MULTIPLE" => "N",
			"VALUES" => $arParamList,
			"DEFAULT" => 'Y-m-d',
		),
	),
);
?>
