<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";

$usuario_lugarMapper = $spot->mapper('Entity\Usuario_Lugar');
$lugarMapper = $spot->mapper('Entity\Lugar');

if($_GET['type'] == 'userlist' && isset($_GET['uid'])){
	$userPlaces = $usuario_lugarMapper->getByUser($_GET['uid']);	
	$lugarMapper = $spot->mapper('Entity\Lugar');
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
	$usuario_lugarMapper = $spot->mapper('Entity\Usuario_Lugar');
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
?>