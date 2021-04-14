<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div class="d-flex justify-content-center">
    <div class="col-lg-4">
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.smart.filter",
            "",
            array(
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "COMPONENT_TEMPLATE" => "visual_vertical-catalog",
                "CONVERT_CURRENCY" => "N",
                "DISPLAY_ELEMENT_COUNT" => "N",
                "FILTER_NAME" => "arrFilter",
                "FILTER_VIEW_MODE" => "vertical",
                "HIDE_NOT_AVAILABLE" => "Y",
                "IBLOCK_ID" => "32",
                "IBLOCK_TYPE" => "newgotdoc",
                "PAGER_PARAMS_NAME" => "arrPager",
                "POPUP_POSITION" => "left",
                "PREFILTER_NAME" => "smartPreFilter",
                "PRICE_CODE" => array(
                ),
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => "",
                "SECTION_DESCRIPTION" => "-",
                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                "SECTION_TITLE" => "-",
                "SEF_MODE" => "N",
                "TEMPLATE_THEME" => "blue",
                "XML_EXPORT" => "N"
            ),
            false
        ); ?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>