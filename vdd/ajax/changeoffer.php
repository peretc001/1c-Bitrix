<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use \Bitrix\Catalog\Product;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketItem;

Loader::includeModule("sale");
Loader::includeModule("catalog");

header('Content-Type: text/html; charset=utf-8');

$request = Application::getInstance()->getContext()->getRequest();

$offerId = $request->getPost("ID");
$block = $request->getPost("BLOCK");

    $getProductId = CCatalogSku::GetProductInfo($offerId);
    if (is_array($getProductId))
    {
        $productId = $getProductId['ID'];
    }
    else
    {
        ShowError('Это не торговое предложение');
    }

    $old_price = GetCatalogProductPrice($offerId, 2);
    $price = GetCatalogProductPrice($offerId, 1);

    $arSKU = CCatalogSKU::getOffersList(
        $productId,
        0,
        $skuFilter = array('ACTIVE' => 'Y'),
        $fields = array('NAME', 'QUANTITY', 'PREVIEW_PICTURE'),
        $propertyFilter = array("CODE"=>array('SIZE', 'COLOR'))
    );

    $dbBasketItems = CSaleBasket::GetList(
        array(),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "PRODUCT_ID" => $offerId, "ORDER_ID" => "NULL", "DELAY" => "N"),
        false, false, array('PRODUCT_ID', 'QUANTITY')
    );
    while ($arItemsBasket = $dbBasketItems->Fetch()) {
        $inBasketID = $arItemsBasket['PRODUCT_ID'];
        $inBasketQTY = $arItemsBasket['QUANTITY'];
    }

    if($block == 'size'):
        $result = [
            'old_price' => $old_price['PRICE'],
            'price' => $price['PRICE'],
            'qty' => $arSKU[$productId][$offerId]['QUANTITY'],
            'inbasket' => !empty($inBasketID) ? true : false,
            'inbasketQTY' => $inBasketQTY
        ];
    endif;

    if($block == 'color'):
        #MORE_PHOTO
        $rsElem = CIBlockElement::GetById($productId);
        $arElem = $rsElem->GetNextElement();
        $arProps = $arElem->GetProperties(Array(), Array("CODE"=>"MORE_PHOTO") );
            $prodImg['THUMB'] = array();
            $prodImg['IMG'] = array();
            if(!empty($arElem->fields['PREVIEW_PICTURE'])):
                array_push($prodImg['THUMB'],CFile::ResizeImageGet($arElem->fields['PREVIEW_PICTURE'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                array_push($prodImg['IMG'],CFile::ResizeImageGet($arElem->fields['PREVIEW_PICTURE'], array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
            endif;
            if(!empty($arElem->fields['DETAIL_PICTURE'])):
                array_push($prodImg['THUMB'],CFile::ResizeImageGet($arElem->fields['DETAIL_PICTURE'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                array_push($prodImg['IMG'],CFile::ResizeImageGet($arElem->fields['DETAIL_PICTURE'], array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
            endif;
            if(!empty($arProps['MORE_PHOTO']['VALUE'])):
                foreach ($arProps['MORE_PHOTO']['VALUE'] as $arProp):
                    array_push($prodImg['THUMB'],CFile::ResizeImageGet($arProp, array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                    array_push($prodImg['IMG'],CFile::ResizeImageGet($arProp, array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                endforeach;
            endif;
        unset($rsElem,$arElem,$arProps);

        $rsElem = CIBlockElement::GetById($offerId);
        $arElem = $rsElem->GetNextElement();
        $arProps = $arElem->GetProperties(Array(), Array("CODE"=>"MORE_PHOTO") );
            if(!empty($arElem->fields['PREVIEW_PICTURE'])):
                array_push($prodImg['THUMB'],CFile::ResizeImageGet($arElem->fields['PREVIEW_PICTURE'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                array_push($prodImg['IMG'],CFile::ResizeImageGet($arElem->fields['PREVIEW_PICTURE'], array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
            endif;
            if(!empty($arElem->fields['DETAIL_PICTURE'])):
                array_push($prodImg['THUMB'],CFile::ResizeImageGet($arElem->fields['DETAIL_PICTURE'], array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                array_push($prodImg['IMG'],CFile::ResizeImageGet($arElem->fields['DETAIL_PICTURE'], array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
            endif;
            if(!empty($arProps['MORE_PHOTO']['VALUE'])):
                foreach ($arProps['MORE_PHOTO']['VALUE'] as $arProp):
                    array_push($prodImg['THUMB'],CFile::ResizeImageGet($arProp, array('width'=>98, 'height'=>98), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                    array_push($prodImg['IMG'],CFile::ResizeImageGet($arProp, array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true)['src']);
                endforeach;
            endif;
        unset($rsElem,$arElem,$arProps);

        #SIZE
        $size = array();
        foreach ($arSKU[$productId] as $item):
            if ($item['PROPERTIES']['COLOR']['VALUE'] == $arSKU[$productId][$offerId]['PROPERTIES']['COLOR']['VALUE']):
                $size[$item['ID']] = $item['PROPERTIES']['SIZE']['VALUE'];
            endif;
        endforeach;

        $result = [
            'old_price' => $old_price['PRICE'],
            'price' => $price['PRICE'],
            'qty' => $arSKU[$productId][$offerId]['QUANTITY'],
            'inbasket' => !empty($inBasketID) ? true : false,
            'inbasketQTY' => $inBasketQTY,
            'img' => $prodImg,
            'sizes' => $size
        ];
    endif;

    echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>
