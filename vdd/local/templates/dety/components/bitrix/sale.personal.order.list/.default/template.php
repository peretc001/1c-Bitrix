<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset,
    Bitrix\Sale;


Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/account/account.min.css');

Loc::loadMessages(__FILE__);


?>


<section class="account">
    <div class="container">
        <h1>Личный кабинет</h1>
        <div class="row">
            <ul class="account-menu">
                <li><a href="/personal/private/">Профиль</a></li>
                <li class="active"><a>История заказы</a></li>
                <li><a href="/personal/wishlist/">Избранные товары</a></li>
            </ul>
        </div>

        <?
        #Если не авторизован
        if (!empty($arResult['ERRORS']['FATAL'])) {
            foreach($arResult['ERRORS']['FATAL'] as $code => $error)
            {
                if ($code !== $component::E_NOT_AUTHORIZED)
                    ShowError($error);
            }

            $component = $this->__component;
            if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
        {
            ?>
            <div class="row">
                <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <div class="alert alert-danger"><?=$arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]?></div>
                </div>
                <? $authListGetParams = array(); ?>
                <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <?$APPLICATION->AuthForm('', false, false, 'N', false);?>
                </div>
            </div>
            <?
        }

        }

        #Если авторизован
        else {
            if (!empty($arResult['ERRORS']['NONFATAL']))
            {
                foreach($arResult['ERRORS']['NONFATAL'] as $error)
                {
                    ShowError($error);
                }
            }


            #Текущие заказы
            if ($_REQUEST["filter_history"] !== 'Y'):
                $paymentChangeData = array();
                $orderHeaderStatus = null;

                foreach ($arResult['ORDERS'] as $key => $order):
                    #API ORDER
                    $get_order = Bitrix\Sale\Order::load($order['ORDER']['ID']);
                ?>
                <div class="account-orders">
                    <div class="account-orders--header">
                        <div class="account-orders--header--left">
                            <h3><?= Loc::getMessage('SPOL_TPL_ORDER') ?>
                                <?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
                                <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?></h3>
                            <p>
                                <?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') ?> <?= $order['ORDER']['ACCOUNT_NUMBER'] ?>
                            </p>
                        </div>
                        <div class="account-orders--header--right">
                            <h3>
                                <?=$order['ORDER']['FORMATED_PRICE'] ?>
                            </h3>
                            <p class="status <?if($get_order->isPaid()):?>done<?endif?>">
                                <?if($get_order->isPaid()):
                                    echo 'Опалчен';
                                else:
                                    echo 'Не оплачен';
                                endif;?>
                            </p>
                        </div>
                    </div>

                    <?if(count($order['BASKET_ITEMS']) > 0):?>
                    <?
                        $WEIGHT = 0;
                        foreach ($order['BASKET_ITEMS'] as $key => $item):
                            #PHOTO
                            $res = CIBlockElement::GetByID($item["PRODUCT_ID"]);
                            if ($ar_res = $res->GetNext()):
                                if($ar_res['PREVIEW_PICTURE']):
                                    $PHOTO[$key] = CFile::ResizeImageGet($ar_res['PREVIEW_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_EXACT, true);
                                else:
                                    $PHOTO[$key] = CFile::ResizeImageGet($ar_res['DETAIL_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_EXACT, true);
                                endif;
                                #LINK
                                $PHOTO[$key]['LINK'] = $item['DETAIL_PAGE_URL'];
                            endif;
                            #WEIGHT
                            $WEIGHT +=  $item['WEIGHT'];
                        endforeach;
                    ?>
                    <div class="account-orders--body">
                        <div class="account-orders--body--left">
                            <div class="group">
                                <p class="name">Отправление 1</p>
                                <p class="btn btn-accent status">
                                <?
                                    if ($arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID'])):
                                        echo $arStatus['NAME'];
                                    endif;
                                ?>
                                </p>
                            </div>
                            <div class="group">
                                <p><?=count($order['BASKET_ITEMS'])?> <?
                                    $count = count($order['BASKET_ITEMS']) % 10;
                                    if ($count == '1')
                                    {
                                        echo Loc::getMessage('SPOL_TPL_GOOD');
                                    }
                                    elseif ($count >= '2' && $count <= '4')
                                    {
                                        echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                                    }
                                    else
                                    {
                                        echo Loc::getMessage('SPOL_TPL_GOODS');
                                    }
                                    ?> - <?=$WEIGHT?> грамм</p>
                                <p class="delivery">здесь будет дата доставки</p>
                            </div>
                        </div>
                        <div class="account-orders--body--right">
                        <?if($PHOTO):
                            foreach ($PHOTO as $FILE):?>
                            <a href="<?=$FILE['LINK']?>"><img src="<?=$FILE['src']?>"></a>
                            <?endforeach;?>
                        <?endif?>
                        </div>
                    </div>
                    <?endif?>


                </div>
                <?
                endforeach;

            #Старые заказы
            else:

                $orderHeaderStatus = null;

                foreach ($arResult['ORDERS'] as $key => $order):?>
                    <div class="account-orders">
                        <div class="account-orders--header">
                            <div class="account-orders--header--left">
                                <h3><?= Loc::getMessage('SPOL_TPL_ORDER') ?>
                                    <?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
                                    <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?></h3>

                                <p>
                                    <?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') ?> <?= $order['ORDER']['ACCOUNT_NUMBER'] ?>
                                </p>
                            </div>
                            <p class="total">
                                <?=$order['ORDER']['FORMATED_PRICE'] ?>
                            </p>
                        </div>

                        <?if(count($order['BASKET_ITEMS']) > 0):?>
                            <?
                            $WEIGHT = 0;
                            foreach ($order['BASKET_ITEMS'] as $key => $item):
                                #PHOTO
                                $res = CIBlockElement::GetByID($item["PRODUCT_ID"]);
                                if ($ar_res = $res->GetNext()):
                                    if($ar_res['PREVIEW_PICTURE']):
                                        $PHOTO[$key] = CFile::ResizeImageGet($ar_res['PREVIEW_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_EXACT, true);
                                    else:
                                        $PHOTO[$key] = CFile::ResizeImageGet($ar_res['DETAIL_PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_EXACT, true);
                                    endif;
                                    #LINK
                                    $PHOTO[$key]['LINK'] = $item['DETAIL_PAGE_URL'];
                                endif;
                                #WEIGHT
                                $WEIGHT +=  $item['WEIGHT'];
                            endforeach;
                            ?>
                            <div class="account-orders--body">
                                <div class="account-orders--body--left">
                                    <div class="group">
                                        <p class="name">Отправление 1</p>
                                        <p class="btn btn-accent status">
                                            <?
                                            if ($arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID'])):
                                                echo $arStatus['NAME'];
                                            endif;
                                            ?>
                                        </p>
                                    </div>
                                    <div class="group">
                                        <p><?=count($order['BASKET_ITEMS'])?> товара - <?=$WEIGHT?> грамм</p>
                                        <p class="delivery">здесь будет дата доставки</p>
                                    </div>
                                </div>
                                <div class="account-orders--body--right">
                                    <?if($PHOTO):
                                        foreach ($PHOTO as $FILE):?>
                                            <a href="<?=$FILE['LINK']?>"><img src="<?=$FILE['src']?>"></a>
                                        <?endforeach;?>
                                    <?endif?>
                                </div>
                            </div>
                        <?endif?>


                    </div>
                <?
                endforeach;

            endif;

            /*
        ?>

        <div class="order-menu">
        <?
			$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
			$clearFromLink = array("filter_history","filter_status","show_all", "show_canceled");

			if ($nothing || $_REQUEST["filter_history"] == 'N')
			{
				?>
				<a class="mr-4" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>"><?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?></a>
				<?
			}
			if ($_REQUEST["filter_history"] == 'Y')
			{
				?>
				<a class="mr-4" href="<?=$APPLICATION->GetCurPageParam("", $clearFromLink, false)?>"><?echo Loc::getMessage("SPOL_TPL_CUR_ORDERS")?></a>
				<?
				if ($_REQUEST["show_canceled"] == 'Y')
				{
					?>
					<a class="mr-4" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>"><?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?></a>
					<?
				}
				else
				{
					?>
					<a class="mr-4" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y&show_canceled=Y", $clearFromLink, false)?>"><?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_CANCELED")?></a>
					<?
				}
			}
			?>
	</div>


        <?php
            */

            if (!count($arResult['ORDERS']))
            {
                if ($_REQUEST["filter_history"] == 'Y')
                {
                    if ($_REQUEST["show_canceled"] == 'Y')
                    {
                        ?>
                        <h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
                        <?
                    }
                    else
                    {
                        ?>
                        <h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
                        <?
                    }
                }
                else
                {
                    ?>
                    <h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
                    <?
                }
            }


            echo $arResult["NAV_STRING"];
        }
        ?>
        </div>
    </div>
</section>
