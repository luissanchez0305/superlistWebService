<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";

$producto_lugarMapper = $spot->mapper('Entity\Producto_Lugar');	
$pl = $producto_lugarMapper->getByProductoAndLugar($_GET['pid'], $_GET['lid']);
$result = false;
if(is_null($pl->cantidad)){
	$pl = $producto_lugarMapper->build([
		'productoid' => (int)$_GET['pid'],
		'lugarid' => (int)$_GET['lid'],
		'cantidad' => (int)$_GET['qty']
	]);
	$result = $producto_lugarMapper->insert($pl);
}
else{
	$pl->cantidad = $_GET['qty'];
	$result = $producto_lugarMapper->save($pl);
}

if($result)
	echo 'true';
else 
	echo 'false';
?>