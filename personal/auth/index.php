<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FORGOT_PASSWORD_URL" => "fogotpassw.php",
		"PROFILE_URL" => "/personal/",
		"REGISTER_URL" => "registration.php",
		"SHOW_ERRORS" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>