<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<?
/*$url = $_SERVER['REQUEST_URI'];
$part = 'rr01';
$partRisk = 'rr02'; 
$pos = strpos($url, $part);
$posRisk = strpos($url, $partRisk);*/

?>
<?if(!in_array($_GET['program'],['rr02','rr03'])):?>
	<?if(CUser::IsAuthorized()):?>
 		<link rel="stylesheet" href="test.css?key=<?= md5(uniqid());?>">
		<div class="container-test"></div>
		<script src="test.js?key=<?= md5(uniqid());?>"></script>
		<script>
    		if (!program) {
        		var program,phase;
        		if (<?= strlen($_GET['program']) ?? 0?> > 0)  {
        		    program = '<?= $_GET['program']?>';
        		    phase = '<?= $_GET['phase']?>';
        	}	else location.href = '/';
    		}
		</script>
	<?else:?>
		<div class="text-center h4 mt-5">
			Для перехода к пробному тестированию необходимо авторизоваться на сайте.
		</div>
		<div class="text-center mb-4">
 			<a href="#win">Авторизоваться</a> / <a href="/personal/?register=yes" target="_blank">Зарегистрироваться</a>
		</div>
	<?endif;?>
<?elseif (in_array($_GET['program'],['rr03','rr02'])):?>
<div class="text-center h2 text-danger">Уже скоро!</div>
<?elseif (in_array($_GET['program'],['rr01'])):?>
	<div class="access__denied text-center font-weight-bold h4">
  		<p>Бесплатный доступ к курсу <span class="text-uppercase">завершен.</span></p>
  		<p><a href="https://ab-dpo.ru/trainings/raschet-pozharnykh-riskov/distantsionno/" target="_blank">Платный доступ</a> за <s>4990 руб.</s> <span style="color: #ff0000;">2990 руб.</span></p>
	</div>	
<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>