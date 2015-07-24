<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";

$producto_lugarMapper = $spot->mapper('Entity\Producto_Lugar');	
$pl = $producto_lugarMapper->getByProductoAndLugar($_GET['pid'], $_GET['lid']);
$result = false;
if($pl){
	if($_GET['qty'] == '0'){
		$producto_lugarMapper->delete($pl);
	}
	else{
		$pl->cantidad = $_GET['qty'];
		$result = $producto_lugarMapper->save($pl);
	}
}
else{
	$pl = $producto_lugarMapper->build([
		'productoid' => (int)$_GET['pid'],
		'lugarid' => (int)$_GET['lid'],
		'cantidad' => $_GET['qty'] ? (int)$_GET['qty'] : 0
	]);
	$result = $producto_lugarMapper->insert($pl);
}

if($result)
	echo 'true';
else 
	echo 'false';
?>