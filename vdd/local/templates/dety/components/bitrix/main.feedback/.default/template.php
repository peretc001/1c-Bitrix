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
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="email-form-block__form">
    <?if(!empty($arResult["ERROR_MESSAGE"]))
    {
        foreach($arResult["ERROR_MESSAGE"] as $v)
            ?><div class="msg error"><?=$v?></div><?
    }
    if(strlen($arResult["OK_MESSAGE"]) > 0)
    {
        ?><div class="msg good"><?=$arResult["OK_MESSAGE"]?></div><?
    }
    ?>
<?=bitrix_sessid_post()?>

    <input type="email" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="<?=GetMessage("MFT_EMAIL")?>" required>

	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" class="btn btn-send" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>