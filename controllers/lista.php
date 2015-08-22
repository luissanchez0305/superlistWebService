<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";
include $root."/models/lista.php";

if(isset($_GET['type']) && isset($_GET['uid'])){
	$lugarMapper = $spot->mapper('Entity\Lugar');							
	$usuario_lugarMapper = $spot->mapper('Entity\Usuario_Lugar');
	
	if($_GET['type'] == 'userlists'){
		$userlists = $usuario_lugarMapper->getByUser($_GET['uid']);
		$lugaresArray = array();
		foreach ($userlists as $userlist) {
			$list = $lugarMapper->get($userlist->lugarid);
			if($list->activo){
				$lugarModel = new lista();
				$lugarModel->id = $userlist->lugarid;
				$lugarModel->nombre = $list->nombre;
				
				array_push($lugaresArray, dismount($lugarModel));
			}
		}
		echo json_encode($lugaresArray);		
	}
	else if($_GET['type'] == 'getfirst'){
		$userlists = $usuario_lugarMapper->getByUser($_GET['uid']);
		$userlist = $userlists->first();
		$list = $lugarMapper->get($userlist->lugarid);
		
		$lugar = array(
			'id' => $list->id,
			'nombre' => $list->nombre,
			'length' => count($userlists)
		);
		
		echo json_encode($lugar);
	}
}
?>