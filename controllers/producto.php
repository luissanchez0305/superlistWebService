<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/models/marca.php";
include $root."/controllers/helper.php";


$productoMapper = $spot->mapper('Entity\Producto');
$marcaMapper = $spot->mapper('Entity\Marca');
if($_GET['type'] == 'marcas'){
	$marcas = $marcaMapper->all();	
	$marcasArray = array();
	
	foreach ($marcas as $marca) {
		if (strpos(strtolower($marca->nombre), strtolower($_GET['q'])) !== false) {
			$marcaModel = new marca();
			$marcaModel->id = $marca->id;
			$marcaModel->nombre = $marca->nombre;
			array_push($marcasArray, dismount($marcaModel));
		}
	}
	echo json_encode($marcasArray);
}
else if($_GET['type'] == 'manejar'){
	$marcaId = $_GET['tmId'];
	$marcaNombre = $_GET['tmName'];
	if($marcaId == 0 && strlen($marcaNombre) > 0){
		$marca = $marcaMapper->build([
			'nombre' =>  $marcaNombre
		]);
		$marcaMapper->insert($marca);
		$marcaId = $marca->id;
	}
	$result = false;
	$productId = $_GET['pId'];
	if($productId == 0){
		$producto = $productoMapper->build([	
			'marcaid'  		=> $marcaId,
	        'categoriaid' 	=> $_GET['cId'],
	        'nombre'  		=> $_GET['name'],
	        'imagen'  		=> isset($_GET['image']) ? $_GET['image'] : null
		]);	
		$result = $productoMapper->insert($producto);
	}
	else {
		$producto = $productoMapper->get($productId);

		$producto->marcaid = $marcaId;
		$producto->categoriaid = $_GET['cId'];
		$producto->nombre = utf8_encode($_GET['name']);
		$producto->imagen = isset($_GET['image']) ? $_GET['image'] : $producto->imagen;
		$result = $productoMapper->update($producto);
		echo utf8_encode($_GET['name']) . '-' . $producto->nombre;
	}
	/*if($result){
		echo 'true';
	}
	else {
		echo 'false';		
	}*/
}
?>