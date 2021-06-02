<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Моя корзина");
?><h1>Корзина</h1>
<div class="my-4">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"",
	Array(
		"ACTION_VARIABLE" => "basketAction",
		"ADDITIONAL_PICT_PROP_17" => "-",
		"ADDITIONAL_PICT_PROP_23" => "-",
		"ADDITIONAL_PICT_PROP_25" => "-",
		"ADDITIONAL_PICT_PROP_26" => "-",
		"ADDITIONAL_PICT_PROP_27" => "-",
		"ADDITIONAL_PICT_PROP_32" => "-",
		"ADDITIONAL_PICT_PROP_35" => "-",
		"AUTO_CALCULATION" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BRAND_PROPERTY" => "PROPERTY_DOCUMENT_TYPE",
		"COLUMNS_LIST" => array(0=>"NAME",1=>"DISCOUNT",2=>"WEIGHT",3=>"DELETE",4=>"DELAY",5=>"TYPE",6=>"PRICE",7=>"QUANTITY",),
		"COLUMNS_LIST_EXT" => array("PREVIEW_PICTURE","DELETE","PROPERTY_KFPO"),
		"COLUMNS_LIST_MOBILE" => array(),
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CORRECT_RATIO" => "N",
		"DATA_LAYER_NAME" => "dataLayer",
		"DEFERRED_REFRESH" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_MODE" => "compact",
		"EMPTY_BASKET_HINT_PATH" => "/catalog/",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"HIDE_COUPON" => "Y",
		"LABEL_PROP" => array(),
		"OFFERS_PROPS" => array("KFPO"),
		"PATH_TO_ORDER" => "/personal/cart/order/",
		"PRICE_DISPLAY_MODE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_BLOCKS_ORDER" => "sku,props,columns",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FILTER" => "N",
		"SHOW_RESTORE" => "N",
		"TEMPLATE_THEME" => "red",
		"TOTAL_BLOCK_DISPLAY" => array("top"),
		"USE_DYNAMIC_SCROLL" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "Y",
		"USE_GIFTS" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_PRICE_ANIMATION" => "Y"
	)
);?>
</div><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>