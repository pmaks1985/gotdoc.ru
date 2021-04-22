<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?php
    $userLat = \Bitrix\Main\Service\GeoIp\Manager::getGeoPositionLatitude();
    $userLon = \Bitrix\Main\Service\GeoIp\Manager::getGeoPositionLongitude();
    $userCity = 'Вы в городе: ' . \Bitrix\Main\Service\GeoIp\Manager::getCityName();

    $arPlacemarks[] = array(
    "LAT" => $userLat,
    "LON" => $userLon,
    "TEXT" => $userCity,
    );

    $APPLICATION->IncludeComponent(
    "bitrix:map.yandex.view",
    ".default",
    Array(
    "INIT_MAP_TYPE" => "MAP",
    "MAP_DATA" =>  serialize(
    array(
    'yandex_scale' => 5,
    'yandex_lat' => $userLat,
    'yandex_lon' => $userLon,
    'PLACEMARKS' => $arPlacemarks
    )),
    "MAP_WIDTH" => "50%",
    "MAP_HEIGHT" => "300",
    "CONTROLS" => "",
    "OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DRAGGING",),
    "MAP_ID" => "",
    )
    );
?>

<?$APPLICATION->IncludeComponent(
    "reaspekt:reaspekt.geoip",
    "template3",
    array(
        "COMPONENT_TEMPLATE" => "template3",
        "CHANGE_CITY_MANUAL" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>