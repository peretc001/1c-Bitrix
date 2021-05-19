<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 6; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$response = [];

global $USER;
if($USER->IsAuthorized()):
    $idUser = $USER->GetID();

    if (isset($_POST['ID'])):
        $productId = intval($_POST['ID']);

        $data = array(
            "UF_FAVORITE_ID" => (int)$productId,
            "UF_FAVORITE_USER_ID" => $idUser,
        );

        $rsData = $entity_data_class::getList(array(
            "select" => array('ID', 'UF_FAVORITE_ID', 'UF_FAVORITE_USER_ID'),
            "filter" => $data
        ));

        while($getID = $rsData->Fetch()):
            $id = $getID['ID'];
        endwhile;

        if ($id):
            $result = $entity_data_class::Delete($id);
            $response = [
                'status' => true,
                'message' => 'delete'
            ];
        else:
            $result = $entity_data_class::add($data);
            $response = [
                'status' => true,
                'message' => 'add'
            ];
        endif;

        //Count
        $rsData = $entity_data_class::getList(array(
            "select" => array('ID', 'UF_FAVORITE_USER_ID'),
            "filter" => array("UF_FAVORITE_USER_ID" => $idUser)
        ));
        while($countID = $rsData->Fetch()):
            $qty[] = $countID['ID'];
        endwhile;
        $response['count'] = count($qty);
    endif;
else:
    $response = [
        'status' => false,
        'message' => 'user'
    ];
endif;

echo json_encode($response);

?>
