<?php
header('Content-type: application/json');
header("access-control-allow-origin: *");
include "db.php";
include $root."/controllers/helper.php";

if(isset($_GET['type']) && (isset($_GET['e']) || isset($_GET['p']))) {
	$type = $_GET['type'];
	$email = $_GET['e'];
	$usuarioMapper = $spot->mapper('Entity\Usuario');
	if($type == 'cred'){
		$password = $_GET['p'];
		$usuario = $usuarioMapper->getByEmail($email);
		$result = '0';
		if($usuario && $usuario->password == $password){
			$result = $usuario->id;
		}
		echo json_encode(array('id' => $result));
	}
	else if($type == 'exists'){		
		$usuario = $usuarioMapper->getByEmail($email);
		$result = '0';
		$name = '';
		$lastname = '';
		$email = '';
		if($usuario && is_numeric($usuario->id)){
			$result = $usuario->id;
			$name = $usuario->nombre;
			$lastname = $usuario->apellido;
			$email = $usuario->email;
		}
		echo json_encode(array('id' => $result, 'name' => $name, 'lastname' => $lastname, 'email' => $email));
	}
	else if($type == 'manage'){
		$password = $_GET['p'];
		$nombre = $_GET['n'];
		$apellido = $_GET['a'];
		$id = $_GET['i'];
		if($id > 0) {
			$usuario = $usuarioMapper->get($id);
			$usuario->email = $email;
			$usuario->password = strlen($password) > 0 ? $password : $usuario->password;
			$usuario->nombre = $nombre;
			$usuario->apellido = $apellido;
			$result = $usuarioMapper->update($usuario);
			
			if($result){
				echo 'true';
			}
			else {
				echo 'false';		
			}
		}
		else {		
			$usuario = $usuarioMapper->build([	
				'email'  	=> $email,
		        'password' 	=> $password,
		        'nombre'  	=> $nombre,
		        'apellido'  => $apellido,
		        'esAdmin' 	=> FALSE
			]);	
			$result = $usuarioMapper->insert($usuario);
			
			if($result){				
				$lugarMapper = $spot->mapper('Entity\Lugar');
				$lugar = $lugarMapper->build([
						'nombre' => $nombre
						]);
				$lugarMapper->insert($lugar);
				$usuario_lugarMapper = $spot->mapper('Entity\Usuario_Lugar');
				$usuario_lugar = $usuario_lugarMapper->build([
					'usuarioid' => $usuario->id,
					'lugarid' => $lugar->id
				]);
				$usuario_lugarMapper->insert($usuario_lugar);
				echo 'true';
			}
			else {
				echo 'false';		
			}
		}
	}
}
?> 