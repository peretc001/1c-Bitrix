<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("TITLE", "Комплексное внедрение интернет маркетинга - smart satellite");
$APPLICATION->SetTitle("Внедряем комплексный интернет-марктетинг для любой компании. Большая и опытная команда, подберет для вас лучшие инструменты для привлечения клиентов.");

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/marketing.min.css');
?>

<section class="marketing">
    <div class="container">

        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/marketing/marketing-group.php"),
            false
        ); ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/marketing/services.php"),
            false
        ); ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/marketing/clients.php"),
            false
        ); ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/marketing/reputation.php"),
            false
        ); ?>
    </div>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR . "include/marketing/technology.php"),
        false
    ); ?>

    <div class="container is-hidden">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/marketing/callback.php"),
            false
        ); ?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/marketing/team.php"),
            false
        ); ?>
    </div>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR . "include/marketing/principle.php"),
        false
    ); ?>
</section>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
