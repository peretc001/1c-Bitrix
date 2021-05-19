<?session_start();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->RestartBuffer();
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use \Bitrix\Main\Type\DateTime;

$hlbl = 7;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$response = [];


if($_POST['ACTION'] == 'add'):

    parse_str($_POST['REVIEW'], $data);

    $PHOTO = array();
    if(!empty($_FILES)):
        foreach ($_FILES as $file):
            $arr_file = Array(
                "name" => $file['name'],
                "size" => $file['size'],
                "tmp_name" => $file['tmp_name'],
                "type" => $file['type'],
                "del" => "Y",
                false);
            $savePhoto = CFile::SaveFile($arr_file, "review");
            $PHOTO[] = CFile::MakeFileArray($savePhoto);
        endforeach;
    endif;

    if (!empty($_POST['ID']) && !empty($data['user']) && !empty($data['rating']) && !empty($data['advantage'])):

        $insertData = array(
            "UF_REVIEW_ID" => (int)$_POST['ID'],
            "UF_REVIEW_NAME" => (string)$data['user'],
            "UF_REVIEW_RATING" => (int)$data['rating'],
            "UF_REVIEW_ADVANTAGE" => (string)$data['advantage'],
            "UF_REVIEW_DISADVANTAGE" => (string)$data['disadvantage'],
            "UF_REVIEW_COMMENT" => (string)$data['review_comment'],
            "UF_REVIEW_LIKE" => 0,
            "UF_REVIEW_DISLIKE" => 0,
            "UF_REVIEW_DATE" => new DateTime(),
            "UF_REVIEW_PHOTO" => $PHOTO
        );


        $result = $entity_data_class::add($insertData);

        $response = [
            'status' => true,
            'message' => 'add'
        ];

        $_SESSION['REVIEW']['ID'] = (int)$_POST['ID'];

    else:
        $response = [
            'status' => false,
            'message' => 'Не заполнены обязательные поля'
        ];
    endif;

elseif($_POST['ACTION'] == 'like' || $_POST['ACTION'] == 'dislike'):

    $rsData = $entity_data_class::getList(array(
        "select" => array('UF_REVIEW_LIKE', 'UF_REVIEW_DISLIKE'),
        "filter" => array('ID' => (int)$_POST['ID'])
    ));

    while($arData = $rsData->Fetch()):
        $like = $arData['UF_REVIEW_LIKE'];
        $dislike = $arData['UF_REVIEW_DISLIKE'];
    endwhile;

    if($_POST['ACTION'] == 'like'):
        $newLike = $like + 1;
        $newDislike = $dislike;
    else:
        $newLike = $like;
        $newDislike = $dislike + 1;
    endif;

    $insertData = array(
        "UF_REVIEW_LIKE" => $newLike,
        "UF_REVIEW_DISLIKE" => $newDislike
    );

    $result = $entity_data_class::update((int)$_POST['ID'], $insertData);

    if($result):
        $response = [
            'status' => true,
            'like' => $newLike,
            'dislike' => $newDislike
        ];

        $_SESSION['REVIEW']['LIKE'][] = (int)$_POST['ID'];

    else:
        $response = [
            'status' => false,
            'message' => 'Ошибка'
        ];
    endif;
endif;

echo json_encode($response);
?>
