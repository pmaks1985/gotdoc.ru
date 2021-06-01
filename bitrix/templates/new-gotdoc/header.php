<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? $APPLICATION->ShowHead() ?>

	<title>
        <? $APPLICATION->ShowTitle() ?>
    </title>
    <?

    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.5.1.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/popper.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
    ?>
    <?
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
    Asset::getInstance()->addString("<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css'>");
    ?>

</head>

<body>

<? $APPLICATION->ShowPanel(); ?>

<div class="container">
    <header>
        <div class="align-items-center banner">
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <nav class="navbar navbar-expand-lg p-0 d-none">
                    <div class="collapse navbar-collapse px-0" id="navbarNav">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top-menu",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N"
                            )
                        );
                        ?>
                    </div>
                </nav>
            </div>
            <div>
                <div class="d-flex mt-2 select-region">
                    <div class="mr-3">
                        <span class="select-region_text">Ваш регион:</span>
                        <span class="select-region_city">
                                <span class="dottedUnderline">
                                <? $APPLICATION->IncludeComponent(
                                    "reaspekt:reaspekt.geoip",
                                    "template",
                                    array(
                                        "COMPONENT_TEMPLATE" => "template",
                                        "CHANGE_CITY_MANUAL" => "N",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                                    ),
                                    false
                                ); ?>
                                </span>
                                <i class="bi bi-caret-down-fill"></i>
							</span>
                    </div>
                    <div>
                        <? if ($USER->IsAuthorized()): ?>
                            <a href="/personal/" class="user-name text-decoration-none"><?= $USER->GetFullName(); ?></a>
                        <? else: ?>
                            <a href="/personal/auth/"
                               class="btn-outline-danger select-region_button text-decoration-none">Войти</a>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div>
                <div><a class="site-name" href="/">Готовые документы</a></div>
                <div class="site-name_explanation">Автоматизированный помощник для подготовки к проверкам</div>
            </div>
            <div class="text-right">
                <img class="mr-1" src="/bitrix/templates/new-gotdoc/img/phone.png" alt="phone"><a
                        class="phone text-decoration-none" href="tel:+78005504908">8 (800) 550-49-08</a>
                <div class="opening-hours">пн-вс: 06:00 - 21:00</div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex">
                <div class="dropdown">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top-submenu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "top_submenu",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "4",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top_submenu",
                            "USE_EXT" => "Y",
                            "COMPONENT_TEMPLATE" => "top-submenu"
                        ),
                        false
                    ); ?>

                </div>
                <div>
                    <? $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"catalog-search-title", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_newgotdoc",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_newgotdoc" => array(
			0 => "32",
		),
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "catalog-search-title",
		"CONTAINER_ID" => "title-search",
		"CONVERT_CURRENCY" => "N",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/",
		"PREVIEW_HEIGHT" => "75",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PREVIEW_WIDTH" => "75",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "N",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"SHOW_PREVIEW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y"
	),
	false
); ?>

                </div>
            </div>
            <div id="basket-container">
                <? $APPLICATION->IncludeComponent(
	"bazarow:basket.small.bazarow", 
	"ajax", 
	array(
		"COMPONENT_TEMPLATE" => "ajax",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "/personal/cart/",
		"SHOW_DELAY" => "N",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_SUBSCRIBE" => "N"
	),
	false
); ?>
            </div>
        </div>
    </header>
    <div class="content">