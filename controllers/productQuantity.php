<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";

$producto_listaMapper = $spot->mapper('Entity\Producto_Lista');	
$pl = $producto_listaMapper->getByProductoAndLista($_GET['pid'], $_GET['lid']);
$result = false;
if($pl){
	if($_GET['qty'] == '0'){
		$producto_listaMapper->delete($pl);
	}
	else{
		$pl->cantidad = $_GET['qty'];
		$result = $producto_listaMapper->save($pl);
	}
}
else{
	$pl = $producto_listaMapper->build([
		'productoid' => (int)$_GET['pid'],
		'listaid' => (int)$_GET['lid'],
		'cantidad' => $_GET['qty'] ? (int)$_GET['qty'] : 0
	]);
	$result = $producto_listaMapper->insert($pl);
}

if($result)
	echo 'true';
else 
	echo 'false';
?>