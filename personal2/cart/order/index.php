<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>
<div class="my-4">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"bootstrap-cart", 
	array(
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"COMPONENT_TEMPLATE" => "bootstrap-cart",
		"COUNT_DELIVERY_TAX" => "N",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "/personal/",
		"PAY_FROM_ACCOUNT" => "N",
		"PRODUCT_COLUMNS" => "",
		"PROP_1" => "",
		"PROP_2" => "",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"USE_PREPAYMENT" => "N",
		"ALLOW_APPEND_ORDER" => "Y",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "N",
		"SPOT_LOCATION_BY_GEOIP" => "N",
		"SHOW_VAT_PRICE" => "N",
		"COMPATIBLE_MODE" => "Y",
		"USE_PRELOAD" => "Y",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "N",
		"USER_CONSENT_IS_LOADED" => "N",
		"ACTION_VARIABLE" => "soa-action",
		"EMPTY_BASKET_HINT_PATH" => "/catalog/",
		"USE_PHONE_NORMALIZATION" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PROPERTY_KFPO",
		),
		"ADDITIONAL_PICT_PROP_17" => "-",
		"ADDITIONAL_PICT_PROP_23" => "-",
		"ADDITIONAL_PICT_PROP_25" => "-",
		"ADDITIONAL_PICT_PROP_32" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"ALLOW_USER_PROFILES" => "N",
		"TEMPLATE_THEME" => "red",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "N",
		"SHOW_DELIVERY_INFO_NAME" => "N",
		"SHOW_DELIVERY_PARENT_NAMES" => "N",
		"SKIP_USELESS_BLOCK" => "Y",
		"BASKET_POSITION" => "after",
		"SHOW_BASKET_HEADERS" => "N",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"DELIVERIES_PER_PAGE" => "9",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"SHOW_PICKUP_MAP" => "N",
		"SHOW_MAP_IN_PROPS" => "N",
		"PICKUP_MAP_TYPE" => "yandex",
		"SHOW_COUPONS" => "Y",
		"PROPS_FADE_LIST_1" => array(
			0 => "1",
		),
		"PROPS_FADE_LIST_2" => array(
			0 => "7",
		),
		"ADDITIONAL_PICT_PROP_26" => "-",
		"ADDITIONAL_PICT_PROP_27" => "-",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"PRODUCT_COLUMNS_HIDDEN" => array(
		),
		"HIDE_ORDER_DESCRIPTION" => "Y",
		"USE_YM_GOALS" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "Y",
		"USE_CUSTOM_MAIN_MESSAGES" => "Y",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"PROPS_FADE_LIST_4" => array(
			0 => "21",
		),
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "N",
		"ADDITIONAL_PICT_PROP_35" => "-",
		"MESS_AUTH_BLOCK_NAME" => "Авторизация",
		"MESS_REG_BLOCK_NAME" => "Регистрация",
		"MESS_BASKET_BLOCK_NAME" => "Товары в заказе. Вставьте ваш промокод, нажав кнопку изменить",
		"MESS_REGION_BLOCK_NAME" => "Выберите тип плательщика",
		"MESS_PAYMENT_BLOCK_NAME" => "Оплата",
		"MESS_DELIVERY_BLOCK_NAME" => "Доставка",
		"MESS_BUYER_BLOCK_NAME" => "Покупатель",
		"MESS_BACK" => "Назад",
		"MESS_FURTHER" => "Далее",
		"MESS_EDIT" => "изменить",
		"MESS_ORDER" => "Оформить заказ",
		"MESS_PRICE" => "Стоимость",
		"MESS_PERIOD" => "Срок доставки",
		"MESS_NAV_BACK" => "Назад",
		"MESS_NAV_FORWARD" => "Вперед",
		"YM_GOALS_COUNTER" => "52918237",
		"YM_GOALS_INITIALIZE" => "BX-order-init",
		"YM_GOALS_EDIT_REGION" => "BX-region-edit",
		"YM_GOALS_EDIT_DELIVERY" => "BX-delivery-edit",
		"YM_GOALS_EDIT_PICKUP" => "BX-pickUp-edit",
		"YM_GOALS_EDIT_PAY_SYSTEM" => "BX-paySystem-edit",
		"YM_GOALS_EDIT_PROPERTIES" => "BX-properties-edit",
		"YM_GOALS_EDIT_BASKET" => "BX-basket-edit",
		"YM_GOALS_NEXT_REGION" => "BX-region-next",
		"YM_GOALS_NEXT_DELIVERY" => "BX-delivery-next",
		"YM_GOALS_NEXT_PICKUP" => "BX-pickUp-next",
		"YM_GOALS_NEXT_PAY_SYSTEM" => "BX-paySystem-next",
		"YM_GOALS_NEXT_PROPERTIES" => "BX-properties-next",
		"YM_GOALS_NEXT_BASKET" => "BX-basket-next",
		"YM_GOALS_SAVE_ORDER" => "BX-order-save",
		"DATA_LAYER_NAME" => "dataLayer",
		"BRAND_PROPERTY" => "PROPERTY_DOCUMENT_TYPE"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>
<? use Bitrix\Main\Web\HttpClient;
$key = "ТУТ МОЙ КЛЮЧ ОТ АПИ https://tinypng.com/developers";
$httpClient = new HttpClient(array(
    "waitResponse" => true
));
$httpClient->setAuthorization('api', $key);
$httpClient->setHeader('Content-Type', 'application/json', true);
$url = "https://bretel.kz/upload/iblock/ecd/ecd423080780dbae80bb088c911257e8.jpg";
$data = json_encode(array("source" => array("url" => $url)));
$response = $httpClient->post('https://api.tinify.com/shrink', $data);
//var_dump($data);
//var_dump($response);



?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>