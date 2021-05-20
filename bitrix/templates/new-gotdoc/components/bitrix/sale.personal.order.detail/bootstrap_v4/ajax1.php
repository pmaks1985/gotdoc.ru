<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application,
	Bitrix\Main\Web\HttpClient;

	$setId = $_POST['setId'];
	$customerId = $_POST['customerId'];
	$orderId = $_POST['orderId'];
	$product_id = $_POST['product_id'];

	$connection = Bitrix\Main\Application::getConnection();

	$query = "SELECT `PRODUCT_ID`, `XML_ID`, `privateUUID`, `FUSER_ID`, `ORDER_ID` FROM `b_sale_basket` WHERE `ORDER_ID` = '".$orderId."' AND `PRODUCT_ID` = '".$product_id."'";
	$result = $connection->query($query);
	if($ar=$result->fetch())
	{
		if($ar['privateUUID']>0){
			$response12 = $ar['privateUUID'];
		} 
	}	
	
	if(!$response12){
		$httpClient1 = new HttpClient(array($options = null));
		$httpClient1->setHeader('Content-Type', 'application/json', true);	
		$url1 = "https://service.gotdoc.ru/api/?class=Market&action=getPrivateId";
		$data1 = json_encode(array("setId" => $setId, "customerId" => $customerId, "orderId" => $orderId));		
		$response1 = $httpClient1->post($url1, $data1);
		//echo json_encode($response1);
		$obj = json_decode($response1);
		$response12 = $obj->{'uuid'}; 	
		$connection->queryExecute("UPDATE `b_sale_basket` SET  privateUUID='".$response12."' WHERE `ORDER_ID` = '".$orderId ."' AND `PRODUCT_ID` = '".$product_id."' ");				
		//echo json_encode($response1);	
	}
	if($response12){
		$httpClient2 = new HttpClient(array($options = null));
		$httpClient2->setHeader('Content-Type', 'application/json', true);
		$url2 = "https://service.gotdoc.ru/api/?class=Market&action=getSingleUseSetLink";
		$data2 = json_encode(array("privateUUID" => $response12));
		$response2 = $httpClient2->post($url2, $data2);
		echo json_encode($response2);
	}
	
	
	


//echo json_encode($response1);

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");

?>