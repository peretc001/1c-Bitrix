<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>

    <div class="error-page">
        <div class="container">
            <div class="error-page--block">
                <div class="error-page--block--left">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/404/404.svg" alt="">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/404/error.svg" alt="">
                </div>
                <div class="error-page--block--right">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/404/pic.png" alt="">
                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>