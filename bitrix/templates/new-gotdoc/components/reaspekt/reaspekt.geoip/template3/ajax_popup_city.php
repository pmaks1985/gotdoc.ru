<?
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$module_id = "reaspekt.geobase";

if (!CModule::IncludeModule($module_id)) {
    ShowError("Error! Module no install");
	return;
}

$arData = ReaspGeoIP::GetAddr();
//print_r($arData);
$arResult["DEFAULT_CITY"] = ReaspGeoIP::DefaultCityList();
//print_r($arResult["DEFAULT_CITY"]);
?>
<script>
(function( $ ) {
  $.fn.selectbox = function() {
    var selectDefaultHeight = $('.selectboxss').height();
        $('.selectboxss .selectboxssvalue').click(function() {
          var currentHeight = $(this).closest(".selectboxss").height();
          if (currentHeight < 100 || currentHeight == selectDefaultHeight) {
              $(this).closest(".selectboxss").height("250px");
              $(this).find('.arrowselect').attr("style", "border-radius: 1000px;transition: 0.2s;transform: rotate(180deg);padding: 0px 0px 0px 10px;");
          }
          if (currentHeight >= 250) {
            $(this).closest(".selectboxss").height(selectDefaultHeight);
              $(this).find('.arrowselect').attr("style", "rotate(0deg);padding: 0px 10px 0px 0px;");
          }
      });
      $('li.selectoption').click(function() {
        $(this).closest(".selectboxss").height(selectDefaultHeight);
        $(this).closest(".selectboxss").find('.arrowselect').attr("style", "rotate(0deg);padding: 0px 10px 0px 0px;");
        $(this).closest(".selectboxss").find('.selectboxssvalue span').text($(this).text());
      });
  };
})( jQuery );
</script>
<div class="reaspektGeobaseWrapperPopup">
	<!--<div class="reaspektGeobaseFind">
		<input type="text" onkeyup="objJCReaspektGeobase.inpKeyReaspektGeobase(event);" autocomplete="off" placeholder="<?=Loc::getMessage("REASPEKT_INPUT_ENTER_CITY");?>" name="reaspekt_geobase_search" id="reaspektGeobaseSearch">
	</div>
	
	<div class="reaspektGeobaseTitle"><?=Loc::getMessage("REASPEKT_TITLE_ENTER_CITY");?>:</div>	-->			
	<div class="reaspektGeobaseCities reaspekt_clearfix">
		<div class="reaspekt_row selectboxss">
		<div class="selectboxssvalue"><span>Выберите регион</span><img src="/bitrix/templates/portal/components/reaspekt/reaspekt.geoip/template3/arrow.png" class="arrowselect" /></div>
		<ul class="selectboxssmenu">
			<?$arResult["DEFAULT_CITY"]?>
		<?
        if ($arResult["DEFAULT_CITY"]) :
	
			
			foreach($arResult["DEFAULT_CITY"] as $arCity):?>

			
				<li class="reaspektGeobaseAct selectoption">
					<?if($arData["REGION"] == $arCity["REGION"]):?>
					<strong><?=$arCity["REGION"]?></strong>
					<?else:?>
					<a onclick="objJCReaspektGeobase.onClickReaspektGeobase('<?=$arCity["CITY"]?>'); return false;" id="reaspekt_geobase_list_<?=$cell?>" title="<?=$arCity["REGION"]?>" href="javascript:void(0);"><?=$arCity["REGION"]?></a>
					<?endif;?>
				</li>
				
			<?
               
            endforeach;?>
		
        <?endif;?>
		</ul>
		</div>
	</div>
</div>

<script> $(document).ready(function(){ $('.selectboxss').selectbox(); }); </script>