<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
   

                <? $APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd",
                    "",
                    Array()
                ); ?>


       
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>