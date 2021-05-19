<?session_start();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use \Bitrix\Main\Type\DateTime;

$hlbl = 8;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$response = [];

if ($_POST['adress'] != '' && $_POST['number'] != ''):

        $_POST['house'] == 'да' ? $house = true : $house = false;

        $insertData = array(
            "UF_USER_ID" => (int)$_POST['user'],
            "UF_CITY" => (string)$_POST['city'],
            "UF_STREET" => (string)$_POST['adress'],
            "UF_HOUSE_NUMBER" => (string)$_POST['number'],
            "UF_APARTMENT_NUMBER" => (string)$_POST['flat'],
            "UF_PRIVATE_HOUSE" => $house,
            "UF_PORCH_NUMBER" => (string)$_POST['entrance'],
            "UF_INTERCOM_NUMBER" => (string)$_POST['doorphone'],
            "UF_FLOOR_NUMBER" => (string)$_POST['floor'],
        );


        $result = $entity_data_class::add($insertData);


        $response = [
            'status' => true,
            'message' => 'add'
        ];

else:
        $response = [
            'status' => false,
            'message' => 'Не заполнены обязательные поля'
        ];
endif;


echo json_encode($response);
?>
