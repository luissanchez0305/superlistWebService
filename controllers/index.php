<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
	
$categoriaMapper = $spot->mapper('Entity\Categoria');
$categorias = $categoriaMapper->all();
$categoriasArray = array();
foreach ($categorias as $categoria) {
	$item = array(
		"nombre" 	=> $categoria->nombre,
		"id" 		=> $categoria->id,
		"imagen" 	=> $categoria->imagen 
	);		
	array_push($categoriasArray, $item);
}
echo json_encode($categoriasArray);
?>