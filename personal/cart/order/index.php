<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?><?$APPLICATION->IncludeComponent(
	"crean:sale.order.ajax", 
	"template", 
	array(
		"ALLOW_AUTO_REGISTER" => "N",
		"ALLOW_NEW_PROFILE" => "N",
		"COMPONENT_TEMPLATE" => "template",
		"COUNT_DELIVERY_TAX" => "N",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "basket.php",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PAY_FROM_ACCOUNT" => "N",
		"PRODUCT_COLUMNS" => array(
		),
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"USE_PREPAYMENT" => "N"
	),
	false
);?><? use Bitrix\Main\Web\HttpClient;
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