<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/models/producto.php";
include $root."/controllers/helper.php";

$productoMapper = $spot->mapper('Entity\Producto');
$marcaMapper = $spot->mapper('Entity\Marca');
$producto_lugarMapper = $spot->mapper('Entity\Producto_Lugar');	
if($_GET['type'] == 'productos'){
	$productos = $productoMapper->getByCategoria($_GET['id']);
	$productosArray = array();
	foreach ($productos as $producto) {
		$marca = $marcaMapper->get($producto->marcaid);		
		$pl = $producto_lugarMapper->getByProductoAndLugar($producto->id, $_GET['lid']);	
		array_push($productosArray, dismount(loadProducto($producto, $marca, $pl)));
	}
	echo json_encode($productosArray);
}
else if($_GET['type'] == 'producto'){
	$producto = $productoMapper->get($_GET['id']);
	$marca = $marcaMapper->get($producto->marcaid);		
	$pl = $producto_lugarMapper->getByProductoAndLugar($producto->id, $_GET['lid']);
	
	$historialMapper = $spot->mapper('Entity\Historial');
	$historial = $historialMapper->getByProductoAndLugar($producto->id, $_GET['lid']);
	$productoModel = loadProducto($producto, $marca, $pl);
	$date = $historial ? $historial->fecha : '';
	if($date){
		$productoModel->ultimaFecha = SpanishDate($date->getTimestamp());
		$productoModel->ultimaCantidad = $historial->cantidad;
	}
	else
		$productoModel->ultimaCantidad = 0;
	echo json_encode(dismount($productoModel));
}
else if($_GET['type'] == 'lista'){
	$pls = $producto_lugarMapper->getByLugar($_GET['lid']);
	$productosArray = array();
	foreach ($pls as $pl) {
		$producto = $productoMapper->get($pl->productoid);
		$marca = $marcaMapper->get($producto->marcaid);
		array_push($productosArray, dismount(loadProducto($producto, $marca, $pl)));		
	}
	echo json_encode($productosArray);
}
else if($_GET['type'] == 'compra'){
	$productos = $_GET['ids'];
	$success = count($productos);
	foreach($productos as $producto){
		$pl = $producto_lugarMapper->getByProductoAndLugar($producto, $_GET['lid']);	
		$historialMapper = $spot->mapper('Entity\Historial');
		$historial = $historialMapper->build([
			'lugarid' => (int)$_GET['lid'],
			'productoid' => (int)$producto,
			'cantidad' => (int)$pl->cantidad,
			'fecha' => new \DateTime()
		]);
		$result = $historialMapper->insert($historial);
		if($result){
			$producto_lugarMapper->delete($pl);
			$success -= 1;
		}
	}
	if($success == 0)
		echo 'true';
	else 
		echo 'false';
}

function loadProducto($producto, $marca, $producto_lugar){
	$productoModel = new producto();
	echo $producto->nombre.'-';
	$productoModel->nombre = $producto->nombre;
	$productoModel->id = $producto->id;
	$productoModel->imagen = !is_null($producto->imagen) ? '/uploads/users/' . $producto->imagen : '/uploads/default.jpg';
	$productoModel->marcaId = $marca->id;
	$productoModel->marcaImagen = $marca->imagen;
	$productoModel->marcaNombre = $marca->nombre;
	$productoModel->cantidad = $producto_lugar && !is_null($producto_lugar->cantidad) ? $producto_lugar->cantidad : 0;
	
	return $productoModel;
}
?>