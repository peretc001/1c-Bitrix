<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]) || !$arResult['CATEGORIES_ITEMS_EXISTS'])
    return;
?>
<div class="bx_searche">
    <?
    //debug($arResult["CATEGORIES"]);
    foreach($arResult["CATEGORIES"] as $category_id => $arCategory):

    ?>
        <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
            <?if($category_id === "all"):?>
                <div class="bx_item_block all_result">
                    <a href="<?echo $arItem["URL"]?>" class="bx_item_block--wrapper">
                        <?echo $arItem["NAME"]?>
                    </a>
                </div>
            <?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
                $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
            ?>
                <div class="bx_item_block">
                    <a href="<?echo $arItem["URL"]?>" class="bx_item_block--wrapper">
                        <?if (!empty($arElement["PICTURE"])):?>
                            <div class="bx_image" style="background-image: url('<?echo $arElement["PICTURE"]["src"]?>')"></div>
                        <?endif;?>
                        <div class="bx_item_element">
                            <p><?echo $arItem["NAME"]?></p>
                            <?
                            if(!empty($arElement["PRICES"]['price']['VALUE'])):?>
                                <div class="bx_price"><?
                                    if(!empty($arElement["PRICES"]['sale']["VALUE"])):?>
                                    <span class="old"><?=$arElement["PRICES"]['sale']["VALUE"]?> ₽</span>
                                    <?endif;
                                    echo $arElement["PRICES"]['price']['VALUE']?> ₽</div>
                            <?endif?>
                        </div>
                    </a>
                </div>
            <?else:?>
                <div class="bx_item_block others_result">
                    <a href="<?echo $arItem["URL"]?>" class="bx_item_block--wrapper">
                        <div class="bx_item_element">
                            <p><?=substr($arItem["ITEM_ID"], 0, 1) == "S" ? '<span class="category">Категория:</span> ' : ''?><?echo $arItem["NAME"]?></p>
                        </div>
                    </a>
                </div>
            <?endif;?>
        <?endforeach;?>
    <?endforeach;?>
</div>