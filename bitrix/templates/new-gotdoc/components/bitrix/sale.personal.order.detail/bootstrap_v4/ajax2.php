<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application,
	Bitrix\Main\Web\HttpClient,
	Bitrix\Main\Web\HttpHeaders;
	
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
//$data2 = '786cc5e3-55eb-c75f-a841-e957c812f42d';
/*$httpClient5 = new HttpClient(array($options = null));
$httpClient5->setHeader('Content-Type', 'application/json', true);
$url5 = "https://service.gotdoc.ru/api/?class=Market&action=getDocs";
$data5 = json_encode(array("privateUUID" => $data));
$response5 = $httpClient5->post($url5, $data5);
header('Content-Type: application/octet-stream');
print_r($response5);
*/
$ch = curl_init("https://service.gotdoc.ru/api/?class=Market&action=getDocs");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt($ch, CURLOPT_VERBOSE, true);                                                                
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("privateUUID" => $data)));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/octet-stream'
));

$html = curl_exec ($ch);
header('Content-Type: application/octet-stream');
print_r($html);

AddEventHandler("main", "OnBeforeEventAdd", array("MainHandlers", "OnBeforeEventAddHandler"));
\Bitrix\Main\Mail\Event::sendImmediate(array(
    "EVENT_NAME" => "SEND_SUCCESS", 
    "LID" => "s1", 
    "C_FIELDS" => array( 
		"ORDER_ID" => $orderId,
		"EMAIL" => $email,
    ),
)); 

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_after.php");

?>