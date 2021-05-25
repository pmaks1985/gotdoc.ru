<?php
	define("STOP_STATISTICS", true);
	define('NO_AGENT_CHECK', true);
	
	use Bitrix\Sale;
	use Bitrix\Sale\Order;

	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/akt/tcpdf_min/tcpdf.php"); // Подключаем библиотеку
	
	
class MdfPDF extends \TCPDF
{
	//Page header
	public function Header()
	{
		// Logo
		$headerdata = $this->getHeaderData();
		//$this->Image($headerdata['logo'], 20, 10, $headerdata['logo_width'], '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('dejavusans', '', 8);
		// Title
		/*
		// если нужно в верхнем колонтитуле вывести заголовок или какой-то текст, эти строки нужно раскомментировать 
		// и состыковать
		$this->Cell(0, 15, $headerdata['title'], 0, false, 'C', 0, '', 0, false, 'M', 'M'); 
		$this->Cell(0, 15, $headerdata['string'], 0, false, 'C', 0, '', 0, false, 'M', 'M');
		*/
		$html = "<br /><br /><br />"; // добавим линию, отделающую колонтитул от текста
		$this->writeHTML($html, true, false, true, false, '');
		$this->SetTextColor(0, 0, 0); // цвет шрифта
		$html = '<div><b>Поставщик</b>:ИП Чернова Наталья Викторовна, Ивановская область, Шуйский р-н, с. Горицы, ул. Октябрьская, д. 16-а</div>';
		$this->writeHTML($html, true, false, true, false, '');
		$html = '<div><b>Заказчик</b>:</div>';
		$this->writeHTML($html, true, false, true, false, '');
		$html = "<p>Основание:</p>";
		$this->writeHTML($html, true, false, true, false, '');
		$html = "<br /><hr /><br /><br />"; // добавим линию, отделающую колонтитул от текста
		$this->writeHTML($html, true, false, true, false, '');
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
				$resultfile = $_SERVER['DOCUMENT_ROOT'] .'/upload/invoices/' . $this->orderID . '.pdf';

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
		$receiver = $propertyCollection->getPayerName()->getValue();
		if (!$receiver && !empty($this->arUserData))
		{
			$resline = [];

			if (strlen($this->arUserData['WORK_COMPANY']) > 0)
			{
				$resline[] = $this->arUserData['WORK_COMPANY'];
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
		}

		return false;

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
		if ($receiver = $this->getInvoiceReceiver())
		{
			$this->pdf->Write(0, 'Покупатель: ' . $receiver, '', 0, 'L', true,
				0, false, false, 0);
		}

		$receiverContacts = $this->getInvoceContacts();
		if ($receiverContacts['phone'] && strlen($receiverContacts['phone']) > 0)
		{
			$this->pdf->Write(0, 'Тел: ' . $receiverContacts['phone'], '', 0, 'L', true,
				0, false, false, 0);
		}

		if ($receiverContacts['email'] && strlen($receiverContacts['email']) > 0)
		{
			$this->pdf->Write(0, 'E-mail: ' . $receiverContacts['email'], '', 0, 'L', true,
				0, false, false, 0);
		}

		if ($receiverContacts['address'] && strlen($receiverContacts['address']) > 0)
		{
			$this->pdf->Write(0, 'Адрес: ' . $receiverContacts['address'], '', 0, 'L', true,
				0, false, false, 0);
		}

		$this->pdf->Write(0, "", '', 0, 'C', true,
			0, false, false, 0);
	}
	
	function setTitleByOrderID()
	{
		$title = 'Акт №' . $this->orderID;
		$this->pdf->SetTitle($title);
		$this->pdf->SetHeaderData($this->siteLogo, 80, $title, $this->getInvoiceDate());
	}

	function GetOrderItems()
	{
		$this->pdf->SetTextColor(0);
		$this->pdf->SetLineWidth(0.3);
		$this->pdf->SetFont('dejavusans', 'B');

		$coloumns = array(
			0 => ['t' => 'ID', 'w' => '20'],
			1 => ['t' => 'Товар', 'w' => '100'],
			2 => ['t' => 'Цена', 'w' => '20'],
			3 => ['t' => 'Кол-во', 'w' => '17'],
			4 => ['t' => 'Сумма', 'w' => '20'],
		);

		foreach ($coloumns as $arColoumn)
		{
			$this->pdf->Cell($arColoumn['w'], 7, $arColoumn['t'], 1, 0, 'C', 1);
		}
		$this->pdf->Ln();

		$this->pdf->SetFillColor(224, 235, 255);
		$this->pdf->SetTextColor(0);
		$this->pdf->SetFont('dejavusans', '');

		$fill = 0;
		foreach ($this->order->getBasket()->getBasketItems() as $basketItem)
		{
			$this->pdf->Cell($coloumns[0]['w'], 6, $basketItem->getProductId(), 'LR', 0, 'C', $fill);
			$this->pdf->Cell($coloumns[1]['w'], 6, $basketItem->getField('NAME'), 'LR', 0, 'L', $fill);
			$this->pdf->Cell($coloumns[2]['w'], 6, $basketItem->getPrice(), 
				'LR', 0, 'L', $fill);
			$this->pdf->Cell($coloumns[3]['w'], 6, number_format($basketItem->getQuantity()), 'LR', 0, 'C', $fill);	
			$this->pdf->Cell($coloumns[3]['w'], 6, $basketItem->getFinalPrice(), 'LR', 0, 'L', $fill);
			$this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(array_reduce($coloumns, function (&$res, $item) {
			return $res + $item['w'];
		}, 0), 0, '', 'T');

		$this->pdf->Ln();
		$this->pdf->SetFont('dejavusans', 'U',8);
		$this->pdf->Write(0, 'Товаров на ' . $this->order->getBasket()->getPrice(), '', 0, 'R', true,
			0, false, false, 0);

	}
}
$orderID = $_POST['ZAKAZ_ID'];
if($orderID >0){
	$pdf = new pdfit($orderID, $_SERVER['DOCUMENT_ROOT'] . '/upload/sitelogo.jpg');
	$pdf->process();
} else {
	ShowError('Идентификатор заказа не указан!');
}
	
	
	
	require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");
?>