<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";
include $root."/models/lista.php";

if(isset($_GET['type']) && isset($_GET['uid'])){
	$listaMapper = $spot->mapper('Entity\Lista');							
	$usuario_listaMapper = $spot->mapper('Entity\Usuario_Lista');
	
	if($_GET['type'] == 'userlists'){
		$userlists = $usuario_listaMapper->getByUser($_GET['uid']);
		$listasArray = array();
		foreach ($userlists as $userlist) {
			$list = $listaMapper->get($userlist->listaid);
			if($list->activo){
				$listaModel = new lista();
				$listaModel->id = $userlist->listaid;
				$listaModel->nombre = $list->nombre;
				
				array_push($listasArray, dismount($listaModel));
			}
		}
		echo json_encode($listasArray);		
	}
	else if($_GET['type'] == 'getfirst'){
		$userlists = $usuario_listaMapper->getByUser($_GET['uid']);
		foreach($userlists as $userlist){
			$list = $listaMapper->get($userlist->listaid);
			if($list->activo){			
				$lista = array(
					'id' => $list->id,
					'nombre' => $list->nombre,
					'length' => count($userlists)
				);	
				echo json_encode($lista);
				break;
			}
				
		}
	}
}
?>