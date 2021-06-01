<?php
	define("STOP_STATISTICS", true);
	define('NO_AGENT_CHECK', true);
	
	use Bitrix\Sale;
	use Bitrix\Sale\Order;

	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/akt/tcpdf_min/tcpdf.php"); // Подключаем библиотеку
	
	
class MdfPDF extends \TCPDF
{

function num2str($num) {
	$nul='ноль';
	$ten=array(
		array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
		array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
	);
	$a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
	$tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
	$hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
	$unit=array( // Units
		array('копейка' ,'копейки' ,'копеек',	 1),
		array('рубль'   ,'рубля'   ,'рублей'    ,0),
		array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
		array('миллион' ,'миллиона','миллионов' ,0),
		array('миллиард','милиарда','миллиардов',0),
	);
	//
	list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
	$out = array();
	if (intval($rub)>0) {
		foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
			if (!intval($v)) continue;
			$uk = sizeof($unit)-$uk-1; // unit key
			$gender = $unit[$uk][3];
			list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
			// mega-logic
			$out[] = $hundred[$i1]; # 1xx-9xx
			if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
			else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
			// units without rub & kop
			if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
		} //foreach
	}
	else $out[] = $nul;
	$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
	$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
	return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}	
/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
	$n = abs(intval($n)) % 100;
	if ($n>10 && $n<20) return $f5;
	$n = $n % 10;
	if ($n>1 && $n<5) return $f2;
	if ($n==1) return $f1;
	return $f5;
}	
	//Page header
	public function Header()
	{
		// Logo
		$headerdata = $this->getHeaderData();
		
		// Set font
		$this->SetFont('dejavusans', '', 8);
		// Title
				
		$html = "<br /><br /><br />"; // добавим линию, отделающую колонтитул от текста
		$this->writeHTML($html, true, false, true, false, '');
		$this->SetTextColor(0, 0, 0); // цвет шрифта

		

	}

	// Page footer
	public function Footer()
	{
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('dejavusans', 'I', 8);
		// Page number
		$this->SetTextColor(85, 85, 85);
		$html = "<hr />"; 
		$this->writeHTML($html, true, false, true, false, '');
		$this->SetTextColor(0, 0, 0);
		$this->Cell(0, 10, 'Страница ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, 
				'', 0, false, 'T', 'M');
	}
}

class pdfit
{
	var $pdf;
	var $orderID;
	var $siteInfo;
	var $siteLogo;
	var $order;
	var $arUserData;

	function __construct($orderID, $siteLogo = false)
	{
		\Bitrix\Main\Loader::includeModule('sale');
		$this->orderID = $_POST['ZAKAZ_ID'] ; // идентификатор заказа для обработки
		//$this->orderID = 425 ; // идентификатор заказа для обработки
		$this->siteLogo = $siteLogo; // пусть к файлу с логотипом сайта
	}

	function process()
	{
		if ($this->orderID > 0)
		{
			$this->getOrder();
			if($this->checkOrderAccess()){
				$this->getSiteInfo();

				// определяем файл, в котором будем хранить сгенерированные накладные, если нужно
				// к стати, при хранении файлов, стоит также написать обработчик, который эти файлы будет удалять 
				// при удалении заказов
				$resultfile = $_SERVER['DOCUMENT_ROOT'] .'/upload/scet/' . $this->orderID . '.pdf';

				if(file_exists($resultfile)){
					// если файл уже был создан - просто выводим его
					header('Content-type: application/pdf');
					readfile($resultfile);
				} else {
					// иначе - проходим процедуру создания
					$this->getUserData();
					$this->initPdf();
					$this->getInvoiceReceiver();
					$this->GetHead();
					$this->GetOrderItems();
					$this->pdf->Output($resultfile, 'I'); // выводим на экран
					$this->pdf->Output($resultfile, 'F'); // сохраняем файл по указанному пути
				}
			} else {
				ShowError('Возникла ошибка генерации файла с накладной! Свяжитесь с администрацией сайта.');
			}
		}
	}

	function getOrder()
	{
		$this->order = Sale\Order::load($this->orderID);
	}

	function checkOrderAccess(){
		global $USER;
		global $APPLICATION;

		if(!$this->order) return false;

		if($USER->IsAdmin()) return true;
		if(!$USER->IsAuthorized()) return false;
		if($USER->GetID()==$this->order->getUserId()){
			return true;
		}
		if($APPLICATION->GetUserRight("sale") >= "W")
			return true; // оставляем менеджерам возможность просматривать накладные
		else {
			$APPLICATION->AuthForm("Доступ к заказу запрещён.");
			return false;
		}
	}

	function getSiteInfo($siteId = SITE_ID)
	{
		if (empty($siteId))
		{
			$siteId = "s1";
		}
		$arSite = false;
		$obCache = new \CPHPCache();
		if ($obCache->InitCache(36000, 'site_' . $siteId, '/'))
		{
			$arSite = $obCache->GetVars();
		} elseif ($obCache->StartDataCache())
		{
			$arSite = \CSite::GetByID($siteId)->Fetch();
			$obCache->EndDataCache($arSite);
		}
		$this->siteInfo = $arSite;
	}

	function initPdf()
	{
		$this->pdf = new \MdfPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$this->pdf->SetMargins(20, 20, 10);
		$this->pdf->SetAutoPageBreak(true, 20);
		if (is_array($this->siteInfo) && strlen($this->siteInfo['NAME']) > 0)
		{
			$this->pdf->SetAuthor($this->siteInfo['NAME']);
		}
		$this->setTitleByOrderID();
	}

	function getInvoiceDate()
	{
		$date = $this->order->getDateInsert()->getTimestamp();
		return 'от ' . FormatDate("j F Y", $date);
	}

	function getUserData()
	{
		$user_id = (int)$this->order->getUserId();
		$rsUser = CUser::GetByID($user_id);
		$this->arUserData = $rsUser->Fetch();
	}

	function getInvoiceReceiver()
	{
		$propertyCollection = $this->order->getPropertyCollection();
		//$receiver = $propertyCollection->getPayerName()->getValue();
		$somePropValue = $propertyCollection->getItemByOrderPropertyId(21);
		$receiver = $somePropValue->getValue();

		//if (!$receiver && !empty($this->arUserData))
		//if (!$receiver)
		//{
		
			$resline = [];

		
			if (strlen($receiver ) > 0)
			{
				$resline[] = $receiver;
			}

			if (empty($resline))
			{
				if (strlen($this->arUserData['LAST_NAME']) > 0)
				{
					$resline[] = $this->arUserData['LAST_NAME'];
				}
				if (strlen($this->arUserData['NAME']) > 0)
				{
					$resline[] = $this->arUserData['NAME'];
				}
				if (strlen($this->arUserData['SECOND_NAME']) > 0)
				{
					$resline[] = $this->arUserData['SECOND_NAME'];
				}
			}

			if (empty($resline))
			{
				$resline[] = $this->arUserData['LOGIN'];
			}

			if (!empty($resline))
			{
				return implode(' ', $resline);
			}
		//}

		//return false;

	}

	function getInvoceContacts()
	{
		$phone = $this->order->getPropertyCollection()->getPhone();
		if ($phone) $phone = $phone->getValue;
		if (!$phone && !empty($this->arUserData))
		{
			if (strlen($this->arUserData['WORK_PHONE']) > 0)
			{
				$phone = $this->arUserData['WORK_PHONE'];
			} elseif (strlen($this->arUserData['PERSONAL_MOBILE']) > 0)
			{
				$phone = $this->arUserData['PERSONAL_MOBILE'];
			} elseif (strlen($this->arUserData['PERSONAL_PHONE']) > 0)
			{
				$phone = $this->arUserData['PERSONAL_PHONE'];
			} else
			{
				$phone = false;
			}
		} else $phone = false;

		$email = $this->order->getPropertyCollection()->getUserEmail();
		if ($email) $email = $email->getValue();

		if (!$email && !empty($this->arUserData))
		{
			if (strlen($this->arUserData['EMAIL']) > 0)
			{
				$email = $this->arUserData['EMAIL'];
			} else $email = false;
		} else $email = false;

		$address = $this->order->getPropertyCollection()->getAddress();
		if ($address) $address = $address->getValue();
		if (!$address) $address = false;

		return array(
			'phone' => $phone,
			'email' => $email,
			'address' => $address
		);

	}



	function GetHead()
	{
		$this->pdf->AddPage();

		$headerdata = $this->pdf->getHeaderData();
		$this->pdf->SetFont('dejavusans', '', 8);
		

		$this->pdf->Write(0, $headerdata['title'], '', 0, 'C', true,
			0, false, false, 0);
		$this->pdf->Write(0, $headerdata['string'], '', 0, 'C', true,
			0, false, false, 0);

		$this->pdf->SetFont('dejavusans', '', 8);
		$html = '
		<style>
		table.acc {
			border-collapse: collapse; /* Убираем двойные границы между ячейками */ 
		}
		table.acc , table.acc td ,table.acc th {
			padding: 5px; /* Поля вокруг текста */
			border: 1px solid #252525; /* Рамка вокруг ячеек */
		}
		</style>
		<table class="header">
		<tbody><tr><td><b>ИП Чернова Наталья Викторовна</b><br><b>Ивановская область, Шуйский р-н, с. Горицы, ул. Октябрьская, д. 16-а</b><br></td></tr></tbody></table>
		<table class="acc" width="100%"><colgroup><col width="29%"><col width="29%"><col width="10%"><col width="32%">
		</colgroup>
		<tbody><tr>
			<td>ИНН 890104464334</td>
			<td>&nbsp;</td>
			<td rowspan="2"><br><br>Сч. №</td>
			<td rowspan="2"><br><br>40802810370010259979</td>
		</tr>
		<tr>
			<td colspan="2">Получатель<br>ИП Чернова Наталья Викторовна			</td>
		</tr>
		<tr>
			<td colspan="2">Банк получателя<br>МОСКОВСКИЙ ФИЛИАЛ АО КБ "МОДУЛЬБАНК"</td>
			<td>БИК<br>Сч. №<br></td>
			<td>044525092<br>30101810645250000092			</td>
		</tr>
	</tbody></table>
<br>
<br>';
		$this->pdf->writeHTML($html, true, false, true, false, '');
		

		if ($receiver = $this->getInvoiceReceiver())
		{
			$html = '<div><b>Плательщик</b>: ' .$receiver. '</div><br/>';
			$this->pdf->writeHTML($html, true, false, true, false, '');	
		}

		$this->pdf->Write(0, "", '', 0, 'C', true,
			0, false, false, 0);
	}
	
	function setTitleByOrderID()
	{
		$title = 'Счет №' . $this->orderID;
		$this->pdf->SetTitle($title);
		//$this->pdf->SetHeaderData($this->siteLogo, 0, $title, $this->getInvoiceDate());
	}
	

	function GetOrderItems()
	{
		$html = '<table width="100%" >
	<tbody><tr>
		<td style="font-size: 2em; font-weight: bold; text-align: center">
			<nobr>
				СЧЕТ № '.$this->orderID.' '.$this->getInvoiceDate().'</nobr>
		</td>
	</tr>
</tbody></table>';
		$this->pdf->writeHTML($html, true, false, true, false, '');

		
		
$html = '
<style>
		table.acc {
			border-collapse: collapse; /* Убираем двойные границы между ячейками */ 
		}
		table.acc , table.acc td ,table.acc th {
			padding: 5px; /* Поля вокруг текста */
			border: 1px solid #252525; /* Рамка вокруг ячеек */
		}
		</style>
<table class="acc"><tr><th width="5%">№</th><th width="65%">Товар</th><th width="10%">Кол-во</th><th width="10%">Цена</th><th width="10%">Сумма</th></tr>';
$iii=0;
foreach ($this->order->getBasket()->getBasketItems() as $basketItem)
{
	$iii=$iii+1;	
	$html =$html."<tr><td>".$iii."</td><td>".$basketItem->getField('NAME')."</td><td>".number_format($basketItem->getQuantity())."</td><td>".$basketItem->getPrice()."</td><td>".$basketItem->getFinalPrice()."</td></tr>";
}

$html = $html."</table>";
$this->pdf->writeHTML($html, true, false, true, false, '');


		//$this->pdf->SetFont('dejavusans', 'U',8);
			
		$html = "Без налога (НДС)";
		$this->pdf->writeHTML($html, true, false, true, false, '');
	
		$html = "Итого: ".$this->order->getBasket()->getPrice()." руб.<br><br>";
		$this->pdf->writeHTML($html, true, false, true, false, '');
		
		$Number2Word_Rus = num2str($basketItem->getFinalPrice());
		
		$html = "Всего наименований, ".$iii.", на сумму ".$basketItem->getFinalPrice();
		$this->pdf->writeHTML($html, true, false, true, false, '');	
		$html =  "<b>".$Number2Word_Rus."</b>";
		$this->pdf->writeHTML($html, true, false, true, false, '');	


		$html = '<br><br><table border="0">
		<tr>
		<td>
			<b>ИСПОЛНИТЕЛЬ</b><br>ИП Чернова Наталья Викторовна
		</td>
		<td>
			<img src="/akt/pp.png" width="70">
		</td>
		<td>
			Чернова Н. В.
		</td>
		
		</tr>
		</table>';
		$this->pdf->writeHTML($html, true, false, true, false, '');
	}
}
$orderID = $_POST['ZAKAZ_ID'];
//$orderID = 425;
if($orderID >0){
	$pdf = new pdfit($orderID, $_SERVER['DOCUMENT_ROOT'] . '/upload/sitelogo.jpg');
	$pdf->process();
} else {
	ShowError('Идентификатор заказа не указан!');
}
	
	
	
	require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");
?>