
<?
$data = ['success' => false; 'message' => 'Тест', 'phone' => $_POST['phone']];
header('Content-Type: application/json');
echo json_encode($data);
?>