<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "/db.php";
include $root."/controllers/helper.php";

if(isset($_GET['type']) && (isset($_GET['e']) || isset($_GET['p']))) {
	$type = $_GET['type'];
	$email = $_GET['e'];
	$password = $_GET['p'];
	$usuarioMapper = $spot->mapper('Entity\Usuario');
	if($type == 'cred'){
		$usuario = $usuarioMapper->getByEmail($email);
		$result = '0';
		if($usuario->password == $password){
			$result = $usuario->id;
		}
		echo json_encode(dismount(array('id' => $result)));
	}
	else if($type == 'exists'){		
		$usuario = $usuarioMapper->getByEmail($email);
		$result = '0';
		if(is_numeric($usuario->id)){
			$result = $usuario->id;
		}
		echo json_encode(dismount(array('id' => $result)));
	}
	else if($type == 'manage'){
		$nombre = $_GET['n'];
		$apellido = $_GET['a'];
		$id = $_GET['i'];
		
		if($id > 0) {
			$usuario = $usuarioMapper->get($id);
			$usuario->email = $email;
			$usuario->password = $password;
			$usuario->nombre = $nombre;
			$usuario->apellido = $apellido;
			$usuarioMapper->update($usuario);
			
			echo 'true';
		}
		else {		
			$usuario = $usuarioMapper->build([	
				'email'  	=> $email,
		        'password' 	=> $password,
		        'nombre'  	=> $nombre,
		        'apellido'  => $apellido
			]);	
			$result = $usuarioMapper->insert($producto);
			if($result){
				echo 'true';
			}
			else {
				echo 'false';		
			}
		}
	}
}
?> 