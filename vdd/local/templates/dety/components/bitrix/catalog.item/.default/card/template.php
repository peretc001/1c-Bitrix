<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

$firstImg = !empty($actualItem['PREVIEW_PICTURE']['SRC'])
? $actualItem['PREVIEW_PICTURE']['SRC']
: $item['PREVIEW_PICTURE']['SRC'];

$secondImg = !empty($actualItem['DETAIL_PICTURE']['SRC'])
    ? $actualItem['DETAIL_PICTURE']['SRC']
    : $item['DETAIL_PICTURE']['SRC'];
$oldPrice = !empty($actualItem["PRICES"]['sale']['DISCOUNT_VALUE_VAT'])
    ? $actualItem["PRICES"]['sale']['DISCOUNT_VALUE_VAT']
    : $item["PRICES"]['sale']['DISCOUNT_VALUE_VAT'];
$bonus = !empty($actualItem["PRICES"]['sale']['DISCOUNT_VALUE_VAT'])
    ? ''
    : $price['PRICE']*0.02;

$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "PRODUCT_ID" => $item['ID'], //ID текущего товара
        "ORDER_ID" => "NULL",
        "DELAY" => "N" //Исключая отложенные
    ),
    false,
    false,
    array('PRODUCT_ID', 'QUANTITY')
);
while ($arItemsBasket = $dbBasketItems->Fetch()) {
    $inBasketID = $arItemsBasket['PRODUCT_ID'];
    $inBasketQTY = $arItemsBasket['QUANTITY'];
}

global $oneClickBtn;
$oneClickBtn = 'yes';

//Избранное
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$hlbl = 6;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$item['favorite'] = false;
if($USER->IsAuthorized()):
    $idUser = $USER->GetID();

    $data = array(
        "UF_FAVORITE_ID" => (int)$item['ID'],
        "UF_FAVORITE_USER_ID" => $idUser,
    );
    $rsData = $entity_data_class::getList(array(
        "select" => array('ID', 'UF_FAVORITE_ID', 'UF_FAVORITE_USER_ID'),
        "filter" => $data
    ));
    while($getID = $rsData->Fetch()):
        $id = $getID['ID'];
        if($id) $item['favorite'] = true;
    endwhile;
endif;

#Отзывы
$hlbl = 7;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$item['REVIEW'] = false;

$rsData = $entity_data_class::getList(array(
    "select" => array('ID', 'UF_REVIEW_RATING'),
    "filter" => array('UF_REVIEW_ID' => $item['ID'], 'UF_REVIEW_PARENT' => '')
));
while($getReview = $rsData->Fetch()):
    $item['REVIEW'][] = $getReview;
    $rating[] =  $getReview['UF_REVIEW_RATING'];
endwhile;


$item['REVIEW_PRODUCT'] = [
    'COUNT' => !empty($item['REVIEW']) ? count($item['REVIEW']) : 0,
    'RATING' => round(array_sum($rating)/count($item['REVIEW']))
];

if( $item["PROPERTIES"]["TOP"]["VALUE"]
    && $item["PROPERTIES"]["NEW"]["VALUE"]
    && ($item["PRICES"]['sale']['DISCOUNT_VALUE_VAT'] || $item["OFFERS"][0]["PRICES"]['sale']['DISCOUNT_VALUE_VAT'])
    && $item["PROPERTIES"]["INSTALLMENT"]["VALUE"]
) $tag_hidden = true;
?>

<div class="products-card">
    <div class="products-card__head">
        <?if($item["PROPERTIES"]["TOP"]["VALUE"]):?>
            <span class="top">хит</span>
        <?endif?>
        <?if($item["PROPERTIES"]["NEW"]["VALUE"]):?>
            <span class="new<?=$tag_hidden ? ' hidden': ''?>">new</span>
        <?endif?>
        <?if($item["PRICES"]['sale']['DISCOUNT_VALUE_VAT'] || $item["OFFERS"][0]["PRICES"]['sale']['DISCOUNT_VALUE_VAT']):?>
            <span class="sale"><?
                if ($item["PRICES"]['sale']['DISCOUNT_VALUE_VAT']):
                    echo round((1-$price['PRICE']/$item["PRICES"]['sale']['DISCOUNT_VALUE_VAT'])*(-100)) .'%';
                else:
                    echo round((1-$price['PRICE']/$item["OFFERS"][0]["PRICES"]['sale']['DISCOUNT_VALUE_VAT'])*(-100)) .'%';
                endif;
                ?></span>
        <?endif?>
        <?if($item["PROPERTIES"]["INSTALLMENT"]["VALUE"]):?>
            <span class="installment">0/0/6</span>
        <?endif?>
        <span data-id="<?=$item['ID']?>" class="wishlist <?if($item['favorite']):?>active <?endif?>addToFavorite" data-id="<?=$item['ID']?>"></span>
    </div>

	<a class="products-card__img<?if(!empty($secondImg)):?> hasDetail<?endif?>" href="<?=$item['DETAIL_PAGE_URL']?>">
	    <span style="background-image: url('<?=$firstImg?>');"></span>
        <?if(!empty($secondImg)):?><span style="background-image: url('<?=$secondImg?>');"></span><?endif?>
	</a>

    <div class="products-card__title">
        <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$productTitle?></a>
    </div>

    <div class="products-card__review">
        <div class="star">
            <span <?if($item['REVIEW_PRODUCT']['RATING'] > 0):?> class="active"<?endif?>></span>
            <span <?if($item['REVIEW_PRODUCT']['RATING'] > 1):?> class="active"<?endif?>></span>
            <span <?if($item['REVIEW_PRODUCT']['RATING'] > 2):?> class="active"<?endif?>></span>
            <span <?if($item['REVIEW_PRODUCT']['RATING'] > 3):?> class="active"<?endif?>></span>
            <span <?if($item['REVIEW_PRODUCT']['RATING'] > 4):?> class="active"<?endif?>></span>
        </div>
        <a class="quote"><?=$item['REVIEW_PRODUCT']['COUNT']?></a>
    </div>

    <div class="products-card__price">
        <?if(!empty($oldPrice)):?>
            <div class="old"><span><?=number_format($oldPrice, 0, ',', ' ');?></span> ₽</div>
            <?else:?>
            <span class="bonus">+<?=number_format($bonus, 0, ',', ' ');?> Б</span>
        <?endif?>
        <span class="price<?if($oldPrice):?> new<?endif?>"><?=number_format($price['PRICE'], 0, ',', ' ');?> ₽</span>
    </div>
    <?if($APPLICATION->GetCurPage() !== '/personal/cart/'):?>
        <div class="products-card__buy" data-maxqty="<?=$actualItem['PRODUCT']['QUANTITY']?>">
        <?if(!$inBasketID):?>
        <div class="addToBasket">
            <button
                class="btn btn-accent addBtn"
                data-id="<?=$item['ID']?>"
                <?=$item['PRODUCT']['QUANTITY'] == 0 ? 'disabled' : ''?>>В корзину</button>
            <button
                class="btn btn-outline-yellow"
                data-id="<?=$item['ID']?>"
                data-toggle="modal"
                data-target="oneclick">В 1 клик</button>
        </div>
        <?else:?>
        <div class="inBasket">
            <div class="btn hasBasket">
                <a href="/personal/cart/">В корзине<?if($inBasketID):?> <span><?=$inBasketQTY?></span> шт<?endif?>
                    <small>Перейти</small>
                </a>
            </div>
            <button
                class="btn addToBasketPlus"
                data-id="<?=$item['ID']?>"
                data-qty="<?=$inBasketQTY?>"
                <?if($item['PRODUCT']['QUANTITY'] == $inBasketQTY): echo 'disabled'; endif;?>>+1 шт</button>
        </div>
        <?endif?>
    </div>
    <?else:?>
        <div class="products-card__add" data-maxqty="<?=$actualItem['PRODUCT']['QUANTITY']?>">
            <button
                    class="btn btn-accent addToCart"
                    data-id="<?=$item['ID']?>"
                <?=$item['PRODUCT']['QUANTITY'] == 0 ? 'disabled' : ''?>>В корзину</button>
        </div>
    <?endif?>
</div>