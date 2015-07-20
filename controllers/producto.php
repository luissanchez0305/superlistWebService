<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "/db.php";
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
else if($_GET['type'] == 'agregar'){
	if($_GET['tmId'] == 0){
		$marca = $marcaMapper->build([
			'nombre' =>  $_GET['tmName']
		]);
		$marcaMapper->insert($marca);
	}
	$producto = $productoMapper->build([	
		'marcaid'  		=> $_GET['tmId'],
        'categoriaid' 	=> $_GET['cId'],
        'nombre'  		=> $_GET['name'],
        'imagen'  		=> isset($_GET['image']) ? $_GET['image'] : null
	]);	
	$result = $productoMapper->insert($producto);
	if($result){
		echo 'true';
	}
	else {
		echo 'false';		
	}
}
else if($_GET['type'] == 'cargaEditar'){
	$producto = $productoMapper;
}
else if($_GET['type'] == 'editar'){
	
}
?>