<?

use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketItem;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");

$response = array();
if (isset($_POST['ID'])) {
    $productId = intval($_POST['ID']);
    $quantity = 1;
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser(
        \Bitrix\Sale\Fuser::getId(),
        \Bitrix\Main\Context::getCurrent()->getSite()
    );

    if ($item = $basket->getExistsItem('catalog', $productId) ):
        $maxQTY = CCatalogProduct::GetByID($productId);
        $currentQTY = $item->getQuantity();

        if ($currentQTY < $maxQTY['QUANTITY']):
            //Обновление товара в корзине
            $item->setField('QUANTITY', $item->getQuantity() + $quantity);
        endif;
    else:
        //Добавление товара
        $item = $basket->createItem('catalog', $productId);
        $item->setFields([
            'QUANTITY' => $quantity,
            'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
            'PRODUCT_PROVIDER_CLASS' => \Bitrix\Catalog\Product\Basket::getDefaultProviderName() ,
        ]);
    endif;

    //Сохранение изменений
    $basket->save();

    //Отдаем обратно ответ
    $basketQntList = $basket->getQuantityList();

    $response = [
        'status' => true,
        'qty' => $item->getQuantity(),
        'count' => count($basketQntList),
        'total' => $basket->getPrice()
    ];
} else {
    $response = [
        'status' => false,
    ];
}

echo json_encode($response);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>
