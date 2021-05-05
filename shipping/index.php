<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"bazarow:basket.small.bazarow", 
	"smallbasket", 
	array(
		"PATH_TO_BASKET" => "/personal/basket/",
		"PATH_TO_ORDER" => "/personal/cart/order/",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N",
		"COMPONENT_TEMPLATE" => "smallbasket"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>