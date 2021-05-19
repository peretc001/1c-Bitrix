<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input-mobile";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search-mobile";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<form action="<?echo $arResult["FORM_ACTION"]?>" id="<?echo $CONTAINER_ID?>">
        <input id="<?echo $INPUT_ID?>" type="text" name="q" value="" maxlength="50" autocomplete="off" placeholder="Поиск по сайту"/>
        <span class="close js-close-search"></span>
    </form>
    <button class="search js-open-search">
        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEzLjI4IDUxMy4yOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEzLjI4IDUxMy4yODsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OTUuMDQsNDA0LjQ4TDQxMC41NiwzMjBjMTUuMzYtMzAuNzIsMjUuNi02Ni41NiwyNS42LTEwMi40QzQzNi4xNiw5Ny4yOCwzMzguODgsMCwyMTguNTYsMFMwLjk2LDk3LjI4LDAuOTYsMjE3LjYgICAgczk3LjI4LDIxNy42LDIxNy42LDIxNy42YzM1Ljg0LDAsNzEuNjgtMTAuMjQsMTAyLjQtMjUuNmw4NC40OCw4NC40OGMyNS42LDI1LjYsNjQsMjUuNiw4OS42LDAgICAgQzUxOC4wOCw0NjguNDgsNTE4LjA4LDQzMC4wOCw0OTUuMDQsNDA0LjQ4eiBNMjE4LjU2LDM4NGMtOTIuMTYsMC0xNjYuNC03NC4yNC0xNjYuNC0xNjYuNFMxMjYuNCw1MS4yLDIxOC41Niw1MS4yICAgIHMxNjYuNCw3NC4yNCwxNjYuNCwxNjYuNFMzMTAuNzIsMzg0LDIxOC41NiwzODR6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNDMjUxQzAiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==" alt=""/>
        Поиск
    </button>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
