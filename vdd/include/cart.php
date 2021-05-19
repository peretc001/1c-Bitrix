<?
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
CModule::IncludeModule('highloadblock');

$hlbl = 6;
$hlblock = HLBT::getById($hlbl)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();
if($USER->IsAuthorized()):
$idUser = $USER->GetID();
$data = array(
"UF_FAVORITE_USER_ID" => $idUser,
);
$rsData = $entity_data_class::getList(array(
"select" => array('ID'),
"filter" => $data
));
$favoriteCount = count($rsData->fetchAll());
endif;

use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketItem;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
    \Bitrix\Sale\Fuser::getId(),
    \Bitrix\Main\Context::getCurrent()->getSite()
);

$qty = count($basket->getQuantityList());
$total = $basket->getPrice();
?>
<a href="/personal/wishlist/" class="nav-search--right__wishlist<?=$favoriteCount > 0 ? ' active' : ''?>"><?
    if($favoriteCount > 0):?><span><?=$favoriteCount?></span><?endif?></a>
<span class="cart"><?
    if ($qty > 0):?>
        <a href="/personal/cart/"><?
            if ($qty > 0):
                echo '<span class="qty">'. $qty .'</span>';
            endif;

            if ($total > 0):
                echo '<span class="total">'. number_format($total, 0, ',', ' ') .' ₽</span>';
            endif;?>
    </a>
    <?endif?>
</span>
