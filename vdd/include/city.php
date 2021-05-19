<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Service\GeoIp;
//use \Bitrix\Main\Service\GeoIp\SypexGeo;

//GeoIp\Manager::useCookieToStoreInfo(true);
//$geoResult = GeoIp\Manager::getDataResult($ip, 'ru', array('countryName', 'cityName'));
//debug($geoResult,1);

$ip = GeoIp\Manager::getRealIp();
global $city;
$city = !empty($_SESSION['city']) ? $_SESSION['city'] : GeoIp\Manager::getCityName($ip, 'ru');
if (empty($_SESSION['city'])):
    $_SESSION['city'] = $city;
endif;
?>
<a class="nav-top__city__location" data-toggle="modal" data-target="city" href="#"><?=$city?></a>
