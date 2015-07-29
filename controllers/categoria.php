<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/models/categoria.php";
include $root."/controllers/helper.php";

$categoriaUsuarioMapper = $spot->mapper('Entity\Usuario_Categoria');
if(isset($_GET['type']) && $_GET['type'] == 'categories'){
	$categoriaMapper = $spot->mapper('Entity\Categoria');
	$categories = $categoriaMapper->all();
	$userId = $_GET['id'];
	$userCategories = $categoriaUsuarioMapper->getByUsuario($userId);
	$categoriasArray = array();
	foreach ($categories as $category) {
		$categoryBelongsToUser = false;
		foreach ($userCategories as $userCategory) {
			if($userCategory->categoriaid == $category->id && $userCategory->usuarioid == $userId){
				$categoryBelongsToUser = true;
				break;
			}
		}
		if($categoryBelongsToUser)
			array_push($categoriasArray, dismount(loadCategoria($category, $userId)));
		else
			array_push($categoriasArray, dismount(loadCategoria($category, 0)));
	}
	echo json_encode($categoriasArray);
}
else if($_GET['type'] == 'delete' || $_GET['type'] == 'add'){
	$type = $_GET['type'];
	$result = '';
	$userId = $_GET['id'];
	$categoryid = $_GET['category'];
	if($type == 'delete'){
		$categoriaUsuario = $categoriaUsuarioMapper->getByUsuarioAndCategoria($userId, $categoryid);
		if(!$categoriaUsuarioMapper->delete([ 'id' => $categoriaUsuario->id ]))
			$result = 'error borrando';
		
	}
	else{		
		// agregar categoria
		$categoriaUsuario = $categoriaUsuarioMapper->build([
			'categoriaid' 	=> $categoryid,
			'usuarioid'		=> $userId
		]);
		if(!$categoriaUsuarioMapper->insert($categoriaUsuario))
			$result = 'error insertando';			
	}
		
	$response = array(
		'success' => strlen($result) > 0 ? false : true,
		'msg' => $result
	);
	echo json_encode($response);
}

function loadCategoria($categoria, $usuarioid){
	$categoriaModel = new categoria();
	$categoriaModel->nombre = utf8_encode($categoria->nombre);
	$categoriaModel->id = $categoria->id;
	$categoriaModel->usuarioid = $usuarioid;
	
	return $categoriaModel;
}
?>