<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
	
$categoriaMapper = $spot->mapper('Entity\Categoria');
$categoriaUsuarioMapper = $spot->mapper('Entity\Usuario_Categoria');
$usuarioCategorias = $categoriaUsuarioMapper->getByUsuario($_GET['id']);
$categoriasArray = array();
foreach ($usuarioCategorias as $usuarioCategoria){
	$categoria = $categoriaMapper->get($usuarioCategoria->categoriaid);
	$item = array(
		"nombre" 	=> $categoria->nombre,
		"id" 		=> $categoria->id,
		"imagen" 	=> $categoria->imagen 
	);		
	array_push($categoriasArray, $item);
}
echo json_encode($categoriasArray);
?>