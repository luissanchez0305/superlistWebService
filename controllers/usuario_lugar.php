<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";

$usuario_listaMapper = $spot->mapper('Entity\Usuario_Lista');
$listaMapper = $spot->mapper('Entity\Lista');

if($_GET['type'] == 'userlist' && isset($_GET['uid'])){
	$userPlaces = $usuario_listaMapper->getByUser($_GET['uid']);	
	if(count($userPlaces) > 0){
		$userPlacesArray = array();
		foreach ($userPlaces as $userPlace) {
			$place = $listaMapper->get($userPlace->listaid);
			$item = array(
				"id" 			=> $userPlace->id,
				"nombreLista" 	=> $place->nombre,
				"listaid" 		=> $userPlace->listaid,
				"ownerid"		=> $place->usuarioid,
				"key"			=> $place->llave,
				"activo"		=> $place->activo
			);	
			array_push($userPlacesArray, $item);
		}
		echo json_encode(array(
			"status" => 'ok',
			"msg"	=> '',
			"user_places" => $userPlacesArray
		));	
	}
	else {
		echo json_encode(array(
			"status" => 'ok',
			"msg" => 'empty'
		));
	}
}
else if($_GET['type'] == 'adduserlist' && isset($_GET['uid']) && isset($_GET['n'])){
	createListAddToUser($listaMapper, $usuario_listaMapper, $_GET['uid'], $_GET['n']);
	echo json_encode(array(
		"status" => 'ok',
		"msg" => 'empty'
	));
}
else if($_GET['type'] == 'editplace' && isset($_GET['pid'])){
	$lista = $listaMapper->get($_GET['pid']);
	$lista->activo = !$lista->activo;
	$result = $listaMapper->update($lista);
	
	if($result){
		echo 'true';
	}
	else {
		echo 'false';		
	}	
}
else if($_GET['type'] == 'addlisttouser' && isset($_GET['uid']) && isset($_GET['k'])){
	$user = $_GET['uid'];
	$lista = $listaMapper->getBykey($_GET['k'])->first();
	if(isset($lista->id) && $lista->usuarioid != $user){
		$usuario_lista = $usuario_listaMapper->getByUserAndList($user,$lista->id);
		if(!isset($usuario_lista->id)){
			$usuario_lista = $usuario_listaMapper->build([
				'usuarioid' => $user,
				'listaid'	=> $lista->id
			]);	
			$result = $usuario_listaMapper->insert($usuario_lista);
			if($result){
				echo json_encode(array('response' => 'success'));
			}	
		}
		else {
			echo json_encode(array('response' => 'already'));			
		}
	}
	else {
		echo json_encode(array('response' => 'fail'));			
	}
}
?>