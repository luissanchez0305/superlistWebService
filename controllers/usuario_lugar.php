<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";

$usuario_lugarMapper = $spot->mapper('Entity\Usuario_Lugar');
$lugarMapper = $spot->mapper('Entity\Lugar');

if($_GET['type'] == 'userlist' && isset($_GET['uid'])){
	$userPlaces = $usuario_lugarMapper->getByUser($_GET['uid']);	
	if(count($userPlaces) > 0){
		$userPlacesArray = array();
		foreach ($userPlaces as $userPlace) {
			$place = $lugarMapper->get($userPlace->lugarid);
			$item = array(
				"id" 			=> $userPlace->id,
				"nombreLugar" 	=> $place->nombre,
				"lugarid" 		=> $userPlace->lugarid,
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
	createListAddToUser($lugarMapper, $usuario_lugarMapper, $_GET['uid'], $_GET['n']);
	echo json_encode(array(
		"status" => 'ok',
		"msg" => 'empty'
	));
}
else if($_GET['type'] == 'editplace' && isset($_GET['pid'])){
	$lugar = $lugarMapper->get($_GET['pid']);
	$lugar->activo = !$lugar->activo;
	$result = $lugarMapper->update($lugar);
	
	if($result){
		echo 'true';
	}
	else {
		echo 'false';		
	}	
}
else if($_GET['type'] == 'addlisttouser' && isset($_GET['uid']) && isset($_GET['k'])){
	$user = $_GET['uid'];
	$lugar = $lugarMapper->getBykey($_GET['k'])->first();
	if(isset($lugar->id) && $lugar->usuarioid != $user){
		$usuario_lugar = $usuario_lugarMapper->getByUserAndList($user,$lugar->id);
		if(!isset($usuario_lugar->id)){
			$usuario_lugar = $usuario_lugarMapper->build([
				'usuarioid' => $user,
				'lugarid'	=> $lugar->id
			]);	
			$result = $usuario_lugarMapper->insert($usuario_lugar);
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