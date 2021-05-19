<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="callback-form">
    <h4>Подпишись на наши статьи</h4>
    <p>Мы периодически публикуем полезные статьи и интересные обзоры о европейском оборудовании для промышленных предприятий. Подпишись на наш блог и первым получай свежую информацию:</p>

    <div class="result">
        <?if(!empty($arResult["ERROR_MESSAGE"]))
        {
            foreach($arResult["ERROR_MESSAGE"] as $v)
                ShowError($v);
        }
        if(strlen($arResult["OK_MESSAGE"]) > 0)
        {
            ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
        }
        ?>
    </div>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">

    <input type="email" name="user_email" class="callback-email" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="Email" pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$" required>
	<input type="submit" name="submit" class="callback-send" value="Отправить">

    <?if($arParams["USE_CAPTCHA"] == "Y"):?>
        <div class="mf-captcha">
            <div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
            <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
            <div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
            <input type="text" name="captcha_word" size="30" maxlength="50" value="">
        </div>
    <?endif;?>
</form>
</div>
