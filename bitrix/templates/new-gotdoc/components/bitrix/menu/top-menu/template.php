<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="navbar-nav">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<li class="nav-item mr-4">
		<a class="nav-link nav-link_menu pl-0" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
	</li>
	
<?endforeach?>

</ul>
<?endif?>