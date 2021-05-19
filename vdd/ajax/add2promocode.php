<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Discount;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");


$promocode = implode('', $_POST['promocode']);

if($_POST['clear']):
    \Bitrix\Sale\DiscountCouponsManager::clear(true);
    $answer = ['status' => true];
else:
    $archeck = \Bitrix\Sale\DiscountCouponsManager::getData($promocode,true);
    $archeck2 =	\Bitrix\Sale\DiscountCouponsManager::getCheckCodeList(true);
    $rs = $archeck2[$archeck["CHECK_CODE"]];

    if($rs == 'активен и может быть использован'):

        \Bitrix\Main\Loader::includeModule('sale');

        \Bitrix\Sale\DiscountCouponsManager::clear(true);

        $sCoupon = $promocode;
        \Bitrix\Sale\DiscountCouponsManager::add($sCoupon);
        $oBasket = \Bitrix\Sale\Basket::loadItemsForFUser(
            \Bitrix\Sale\Fuser::getId(),
            \Bitrix\Main\Context::getCurrent()->getSite()
        );
        $oDiscounts = \Bitrix\Sale\Discount::loadByBasket($oBasket);
        $oBasket->refreshData([ 'PRICE' ,  'COUPONS']);
        $oDiscounts->calculate();
        $result = $oDiscounts->getApplyResult();

        $answer = ['status' => true];
    else:
        $answer = ['status' => false, 'message' => $rs];
    endif;
endif;

echo json_encode($answer);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>
