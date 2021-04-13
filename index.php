<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сервис Готовые документы — подготовка комплекта документов для успешного прохождения проверок под ключ");
$APPLICATION->SetPageProperty("keywords", "документы для пожарной проверки, документы по охране труда, документы по ГО и ЧС, документы по экологической безопасности");
$APPLICATION->SetPageProperty("description","Получите полный комплект документов в короткие сроки. Документы готовятся лицензированной организацией в соответствии с чек-листами МЧС от 2018г.");
?><script src="<?=SITE_TEMPLATE_PATH?>/js/owl.carousel.min.js"></script> 
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/js/owl.carousel.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/js/owl.theme.default.min.css">

<section class="main"> 

<p><a name="complect"></a></p> 
	<div class="container backp">
		<div class="row"> 
			<div class="col-lg-5"> 
			</div> 
			<div class="col-lg-7"> 
				<div class="row pt-5">
					<div class="col-lg"> 
						<h1 class="display-5 mullerbold">Разработка комплектов<br>документов для успешного<br>прохождения проверок<br>"под ключ"</h1>
					</div>
				</div>
			<form id="btn1f" name="btnf">
				<div class="form-group row pt-4 pb-5 mb-4">
					<div class="col-md-4 pr-4 h5">
					</div>
					<div class="col-md-4 text-center pt-4">
<!--del-->
					</div>
					<div class="col-md-4">

					</div>
				</div>
			</form>
			</div> 
		</div>

<div class="mt-4 pt-4">
	<div class="mt-5">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/include/rdocrf/banner.php"
		)
		);?>
	</div>
</div> 

	<div class="row mt-5"> 
		<div class="container container2 p-4"> 
			<div class="row pt-5"> 
			 	<div class="col-md"> 
					 <h2 class="text-dark h1 mullerbold">Какие документы должны быть в организации для спокойной жизни руководителя</h2><br />
				</div> 
			</div> 
		</div> 
		<div class="container container1"> 
			<div class="row pt-3"> 
			 	<div class="col-md"> 
					<p class="text-dark myriadreg">В каждой организации должен быть соответствующий ее виду деятельности комплект документации. И речь 
не только об учредительных документах. Для полноценного функционирования и успешного прохождения проверок организация должна располагать большим количеством 
						планирующих, распорядительных, разрешительных, отчетных, рабочих документов по вопросам: 
						<a href="/go-i-chs/" target="_blank">гражданской обороны и защиты от чрезвычайных ситуаций;</a> 
						<a href="/pozharnaya-bezopasnost/" target="_blank">пожарной безопасности;</a> 
						<a href="/antiterroristicheskaya-zashchishchyennost/" target="_blank">антитеррористической</a> и 
						<a href="/ecology-safety/" target="_blank">экологической безопасности;</a>
						<a href="/okhrana-truda/" target="_blank">охране труда</a>.</p>
					<p class="text-dark h4 mullerbold">Какие документы потребуются именно вашей организации? </p>
					<p class="text-dark myriadreg">Ответить на этот вопрос поможет наш сайт. Выберите направление деятельности вашей организации и тип объекта. Всё остальное сделают наши специалисты:<br>
					<ul style="list-style-type: disc;">
						<li>составят перечень необходимой документации в соответствии с НПА;</li>
						<li>подготовят сами документы с учетом специфики деятельности вашей организации.</li>
					</ul>
					</p>
					<p class="text-dark h4 mullerbold">Что дальше?</p>
					<p class="text-dark myriadreg">Получите комплект готовых документов и отдайте на подпись руководителю.</p>
				</div> 
			</div> 
		</div> 
	</div> 



<p><a name="fulldoc"></a></p>
	<div class="container p-4"> 
			<div class="row pt-3"> 
			 	<div class="col-md"> 
					 <span class="text-dark h1 mullerbold ">Мы готовим комплекты документов<br>по нескольким направлениям:</span><br />
				</div> 
			</div> 
	</div>
	<div class="container">
		<div class="row pt-2"> 
		 	<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 main_div p-0">
				<img src="/images/rdocrf/main/main1.png" class="img-thumbnail border-0 p-0 w-100" alt="" title="">
				<div class="main_div_text">
					<p class="pl-5 pt-5 pb-3 text-dark h5 mullerbold">Пожарная безопасность<br><br></p>
					<p class="pl-5"><button type="submit" class="btn btn-primary myriadbold px-4 py-2"><a class="text-decoration-none" href="/pozharnaya-bezopasnost/" target="_blank"><span class="h5 text-white">Подробнее</span></a></button></p>
				</div>

			</div>

		 	<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 main_div p-0">
				<img src="/images/rdocrf/main/main2.png" class="img-thumbnail border-0 p-0 w-100" alt="" title="">
				<div class="main_div_text">
					<p class="pl-5 pt-5 pb-3 text-dark h5 mullerbold">ГО и ЧС<br><br></p>
					<p class="pl-5"><button type="submit" class="btn btn-primary myriadbold px-4 py-2"><a class="text-decoration-none" href="/go-i-chs/" target="_blank"><span class="h5 text-white">Подробнее</span></a></button></p>
				</div>
			</div>

		 	<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 main_div p-0">
				<img src="/images/rdocrf/main/main3.png" class="img-thumbnail border-0 p-0 w-100" alt="" title="">
				<div class="main_div_text">
					<p class="pl-5 pt-5 pb-3 text-dark h5 mullerbold">Антитеррористическая<br>защищенность</p>
					<p class="pl-5"><button type="submit" class="btn btn-primary myriadbold px-4 py-2"><a class="text-decoration-none" href="/antiterroristicheskaya-zashchishchyennost/" target="_blank"><span class="h5 text-white">Подробнее</span></a></button></p>
				</div>
			</div>

		 	<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 main_div p-0">
				<img src="/images/rdocrf/main/main4.png" class="img-thumbnail border-0 p-0 w-100" alt="" title="">
				<div class="main_div_text">
					<p class="pl-5 pt-5 pb-3 text-dark h5 mullerbold">Охрана труда<br><br></p>
					<p class="pl-5"><button type="submit" class="btn btn-primary myriadbold px-4 py-2"><a class="text-decoration-none" href="/okhrana-truda/" target="_blank"><span class="h5 text-white">Подробнее</span></a></button></p>
				</div>
			</div>
		 	<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 main_div p-0">
				<img src="/images/rdocrf/main/main5.png" class="img-thumbnail border-0 p-0 w-100" alt="" title="">
				<div class="main_div_text">
					<p class="pl-5 pt-5 pb-3 text-dark h5 mullerbold">Экологическая<br>безопасность</p>
					<p class="pl-5"><button type="submit" class="btn btn-primary myriadbold px-4 py-2"><a class="text-decoration-none" href="/ecology-safety/" target="_blank"><span class="h5 text-white">Подробнее</span></a></button></p>
				</div>
			</div>
		 	<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 main_div p-0">
				<img src="/images/rdocrf/main/main6.png" class="img-thumbnail border-0 p-0 w-100" alt="" title="">
				<div class="main_div_text">
					<p class="pl-5 pt-5 pb-3 text-dark h5 mullerbold">Оказание первой помощи<br><br></p>
					<p class="pl-5"><button type="submit" class="btn btn-primary myriadbold px-4 py-2"><a class="text-decoration-none" href="/pervaya-pomoshch/" target="_blank"><span class="h5 text-white">Подробнее</span></a></button></p>
				</div>
			</div>

		</div> 
	</div>


<!-- +как заказать -->
	<div class="container mt-5">
<p><a name="howorder"></a></p>
			<div class="row"> 
			 	<div class="col-md"> 
					 <span class="text-dark h1 mullerbold ">Как заказать разработку готового комплекта документов для конкретной организации</span><br />
				</div> 
			</div> 
			<div class="row pt-3"> 
			 	<div class="col-md"> 
					<span class="text-dark h4 myriadreg font-weight-bold">Как происходит процесс заказа:</span><br />
				</div> 
			</div> 
	</div>

		<div class="container pt-1 pb-2 d-none d-lg-block">
			<div class="row mt-2"> 
			 	<div class="col-lg-1 p-0">

				</div> 
			 	<div class="col-lg-2 p-0 align-self-end">
			 		<div class="row p-0 m-0">
			 			<div class="col-6 p-0">
							<img src="/images/rdocrf/img_in/1.png" alt="Отправка заявки" title="Отправка заявки">
						</div>
			 			<div class="col-6 p-0">
							<img src="/images/rdocrf/img_in/s_ri_op.png" class="top_img_s">
						</div>
					</div>
				</div>

			 	<div class="col-lg-2 p-0 align-self-end">
			 		<div class="row p-0 m-0">
			 			<div class="col-6 p-0">
							<img src="/images/rdocrf/img_in/22.png" alt="Заключение договора" title="Заключение договора" class="top_img_2">
						</div>
			 			<div class="col-6 p-0 align-self-end">
							<img src="/images/rdocrf/img_in/s_ri_do.png" class="top_img_s">
						</div>
					</div>
				</div> 

			 	<div class="col-lg-2 p-0 align-self-end">
			 		<div class="row p-0 m-0">
			 			<div class="col-6 p-0">
							<img src="/images/rdocrf/img_in/3.png" alt="Оплата" title="Оплата">
						</div>
			 			<div class="col-6 p-0">
							<img src="/images/rdocrf/img_in/s_ri_op.png" class="top_img_s">
						</div>
					</div>
				</div> 

			 	<div class="col-lg-2 p-0 align-self-end">
			 		<div class="row p-0 m-0">
			 			<div class="col-6 p-0">
							<img src="/images/rdocrf/img_in/4.png" alt="Подготовка документов" title="Подготовка документов">
						</div>
			 			<div class="col-6 p-0 align-self-end">
							<img src="/images/rdocrf/img_in/s_ri_do.png" class="top_img_s">
						</div>
					</div>
				</div> 

			 	<div class="col-lg-2 p-0 align-self-end">
			 		<div class="row p-0 m-0">
			 			<div class="col p-0">
							<img src="/images/rdocrf/img_in/5.png" alt="Отправка готовых документов на e-mail" title="Отправка готовых документов на e-mail">
						</div>
					</div>
				</div> 
			 	<div class="col-lg-1 p-0">

				</div> 

			</div>

			<div class="row pt-4">
			 	<div class="col-lg-1 p-0">

				</div> 
			 	<div class="col-lg-2 p-0">
				<span>Отправка <br>заявки</span>
				</div>

			 	<div class="col-lg-2 p-0">
					<span>Заключение <br>договора</span>
				</div> 

			 	<div class="col-lg-2 p-0">
					<span>Оплата</span>
				</div> 

			 	<div class="col-lg-2 p-0">
					<span>Подготовка <br>документов</span>
				</div> 

			 	<div class="col-lg-2 p-0">
					<span>Отправка готовых <br>документов на e-mail</span>
				</div> 
			 	<div class="col-lg-1 p-0">

				</div> 

			</div>

		</div> 

<!-- <b -->

		<div class="container pt-1 mb-5 pb-2 d-none d-block d-xs-block d-sm-block d-md-block d-lg-none">

			<div class="row mt-2 mx-3 px-3"> 
			 	<div class="col-4 align-self-end">
					<img src="/images/rdocrf/img_in/1.png">
				</div>

			 	<div class="col-4">
					<img src="/images/rdocrf/img_in/s_ri_op.png" class="top_img_s">
				</div>

			 	<div class="col-4 align-self-end">
					<img src="/images/rdocrf/img_in/22.png" class="top_img_2">
				</div> 

			</div> 
			<div class="row pt-4 mx-3 px-3">
			 	<div class="col-4">
				<span>Отправка <br>заявки</span>
				</div>
			 	<div class="col-4">
				</div>
			 	<div class="col-4">
					<span>Заключение <br>договора</span>
				</div> 
			</div> 

			<div class="row mx-3 px-3"> 
			 	<div class="col-4">
				</div>
			 	<div class="col-4">
				</div> 
			 	<div class="col-4 text-right">
					<img src="/images/rdocrf/img_in/s_do_le.png">
				</div>
			</div>

			<div class="row mt-2 mx-3 px-3"> 
			 	<div class="col-4 align-self-end">
					<img src="/images/rdocrf/img_in/4.png">
				</div>

			 	<div class="col-4">
					<img src="/images/rdocrf/img_in/s_le_up.png" class="top_img_s">
				</div>

			 	<div class="col-4 align-self-end">
					<img src="/images/rdocrf/img_in/3.png">
				</div> 

			</div> 
			<div class="row pt-4 mx-3 px-3">
			 	<div class="col-4">
				<span>Подготовка <br>документов</span>
				</div>
			 	<div class="col-4">
				</div>
			 	<div class="col-4">
				<span>Оплата</span>
				</div> 
			</div>

			<div class="row mx-3 px-3">
			 	<div class="col-4">
					<img src="/images/rdocrf/img_in/s_do_ri.png">
				</div>
			 	<div class="col-4">
				</div>
			 	<div class="col-4">
				</div> 
			</div>

			<div class="row mt-2 mx-3 px-3"> 
			 	<div class="col-4 align-self-end">
					<img src="/images/rdocrf/img_in/5.png">
				</div>

			 	<div class="col-4">
				</div>

			 	<div class="col-4 align-self-end">
				</div> 

			</div> 
			<div class="row pt-4 mx-3 px-3">
			 	<div class="col-4">
				<span>Отправка готовых <br>документов на e-mail</span>
				</div>
			 	<div class="col-4">
				</div>
			 	<div class="col-4">
				</div> 
			</div>

		</div> 
<!-- <b -->

<!-- -как заказать -->

<p><a name="review"></a></p>
<div class="container pb-5"> 

	<div class="row mt-3 block7_11"> 
		<div class="container"> 
<br /><br /><br /><br /><br /><br />
		</div>
	</div>

	<div class="row block7_12"> 
		<div class="container"> 
			<div class="row py-3 rowfront"> 
				<div class="container rowfront"> 
				 	<div class="col-md text-center rowfront"> 
						 <span class="rowfront text-dark h1 mullerbold">Отзывы наших клиентов</span><br />
					</div> 
				</div> 
			</div> 
			<div class="row pt-2"> 

<div class="container-fluid pb-4">

<div class="owl-carousel owl-carousel-o owl-theme">
<?
CModule::IncludeModule('iblock');
$arSelectO = Array("NAME","PREVIEW_PICTURE");
$arFilterO = Array("IBLOCK_CODE"=>"review", "ACTIVE"=>"Y");
$resO = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilterO, false, Array(), $arSelectO);

while($obO = $resO->GetNextElement())
{
	$arFieldsO = $obO->GetFields();
?>
	<div class="panel panel-default">
		<div class="item text-center panel-thumbnail">
			<a href="#" title="<?print_r($arFieldsO["NAME"]);?>" class="thumb" data-toggle="modal" data-target="#lightbox2">
			<img class="img-fluid mx-auto d-block" src="<?=CFile::GetPath($arFieldsO["PREVIEW_PICTURE"])?>" alt="<?print_r($arFieldsO["NAME"]);?>">
			</a>
		</div>
	</div>

<?};?>
</div>

</div>

			</div> 
		</div>
	</div>

</div>

<div id="lightbox2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>

<? $APPLICATION->IncludeFile('/include/rdocrf/bonus.php'); ?>

<div class="modal fade" id="OrgModal" tabindex="-1" role="dialog" aria-labelledby="OrgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OrgModalLabel">Оставить заявку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<form id="contactForm" enctype="multipart/form-data" method="post" action="/include/rdocrf/handler.php" >
    <div class="form-group">
        <label for="name">Ваше ФИО:</label>
        <input id="name" class="form-control" name="name" type="text" placeholder="Иванов Иван Иванович" required>
    </div>
    <div class="form-group">
        <label for="tel">Ваш телефон:</label>
        <input minlength="17" maxlength="18" pattern="^[0-9]{1} [(][0-9]{3}[)] [0-9]{3}-[0-9]{2}-[0-9]{2}$" type="text" id="tel" class="form-control" name="tel" placeholder="8 (123) 123-45-67" required>
    </div>
    <div class="form-group">
    	<label for="email">Ваш e-mail:</label>
    	<input type="text" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" id="email" class="form-control" name="email"
    	placeholder="example@yandex.ru" required>
    </div>
    <div class="form-group">
        <label for="city">Ваш город:</label>
        <input id="city" class="form-control" name="city" type="text" placeholder="Москва" required>
    </div>
    <div class="form-group">
  		<div class="row">
    		<div class="col-4">
            <? 
               $code = $APPLICATION->CaptchaGetCode();
            ?>
               <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$code;?>" alt="CAPTCHA" width="110" height="33" class="captcha_pic" />       
    		</div>
    		<div class="col-8">
				<input type="text" id="cworld" class="form-control" name="cworld" required placeholder="Введите символы:" value="" />
				<input type="hidden" id="csid" name="csid" value="<?=$code;?>" />
    		</div>
    	</div>
    </div>
    <div class="form-group form-check">
        <input id="check" class="form-check-input" checked type="checkbox" disabled>
        <label class="form-check-label" for="check">Я согласен(-на) на обработку персональных данных</label>
    </div>

	<div id="success"> </div> <!-- For success/fail messages -->

    <button id="buttonorg" name="buttonorg" class="btn btn-success" type="submit">Отправить</button>
    <div class="result p-1 rounded" id="result">
        <span id="answer"></span>
		<span id="loader" style="display:none"><img src="/images/rdocrf/loader.gif" alt=""></span>
    </div>
</form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="OrgModalUrl" tabindex="-1" role="dialog" aria-labelledby="OrgModalLabelUrl" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content container1">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold textunderline" id="OrgModalLabelUrl"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="urlList">
            </div>
        </div>
    </div>
</div>
	</div> 
</section>

<script type="text/javascript">
 $(document).ready(function(){
              var owlo = $('.owl-carousel-o');
              owlo.owlCarousel({
                margin: 10,
                nav: true,
				navText: ["<img src='/images/rdocrf/prev__act_pic.png'>","<img src='/images/rdocrf/next_act_pic.png'>"],
                loop: true,
		dots: false,
                responsive: {
                  0: {items: 1},
                  768: {items: 2},
                  1000: {items: 3}
                }
              });
 });
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>