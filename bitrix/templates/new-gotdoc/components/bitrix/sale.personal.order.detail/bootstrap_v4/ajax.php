<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application,
	Bitrix\Main\Web\HttpClient;
$connection = Bitrix\Main\Application::getConnection();

$orderId = $_POST['orderId'];
$product_id = $_POST['product_id'];
$query = "SELECT `PRODUCT_ID`, `XML_ID`, `privateUUID`, `FUSER_ID`, `ORDER_ID` FROM `b_sale_basket` WHERE `ORDER_ID` = '".$orderId."' AND `PRODUCT_ID` = '".$product_id."'";
$result = $connection->query($query);
while($ar=$result->fetch())
{
	if($ar['privateUUID']){
		$data = $ar['privateUUID'];	
	}
}

$httpClient4 = new HttpClient(array($options = null));
$httpClient4->setHeader('Content-Type', 'application/json', true);
$url4 = "https://service.gotdoc.ru/api/?class=Market&action=getDocsList";
$data4 = json_encode(array("privateUUID" => $data));
$response4 = $httpClient4->post($url4, $data4);


echo json_encode($response4);
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");

?>