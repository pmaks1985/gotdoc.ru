<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<script type="text/javascript">
$(document).ready(function() {
$('input.quantity').change(function() {
var obAddToCartLink = $('a.addtoCart:first', $(this).parent());
obAddToCartLink.attr('href', obAddToCartLink.attr('href').replace( /(quantity=)[0-9]+/ig, '$1'+$(this).val() ));
});
$('input.quantity').keypress(function() {
$(this).trigger('change');
});
$('a.minus1, a.plus1').click(function(e){
e.preventDefault();
e.stopPropagation();
var oThisQuntityInput = $('input.quantity:first', $(this).parent().parent());
var iThisQuantity = parseInt(oThisQuntityInput.val());
var iSubtrahend = 1;
if ($(this).hasClass("minus1"))
{
if (iThisQuantity < 2)
{
return false;
}
iSubtrahend = iSubtrahend * (-1);
}
var iThisQuantityNew = iThisQuantity + iSubtrahend;
oThisQuntityInput.val(iThisQuantityNew);
oThisQuntityInput.trigger('change');
});
});
</script>
<input class="quantity" type="text" name="QUANTITY_<?=$arElement['ID']?>" value="1" size="2" id="QUANTITY_<?=$arElement['ID']?>
">
<div class="count_nav">
 <a rel="nofollow" href="#" class="plus1">+</a> <a rel="nofollow" href="#" class="minus1">-</a>
</div>
<a href="<?echo $arElement["ADD_URL"]?>&quantity=1" rel="nofollow" class="addtoCart">В заказ</a>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>