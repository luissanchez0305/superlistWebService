<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";

$usuario_lugarMapper = $spot->mapper('Entity\Usuario_Lugar');

if($_GET['type'] == 'userlist'){
	$userPlaces = $usuario_lugarMapper->getByUser($_GET['uid']);	
	$lugarMapper = $spot->mapper('Entity\Lugar');
	if(count($userPlaces) > 0){
		$userPlacesArray = array();
		foreach ($userPlaces as $userPlace) {
			$lugar = $lugarMapper->get($userPlace->lugarid);
			$item = array(
			"id" 			=> $userPlace->id,
			"nombreLugar" 	=> $lugar->nombre,
			"lugarid" 		=> $userPlace->lugarid
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
?>