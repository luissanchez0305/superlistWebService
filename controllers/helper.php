<?php
function dismount($object) {
    $reflectionClass = new ReflectionClass(get_class($object));
    $array = array();
    foreach ($reflectionClass->getProperties() as $property) {
        $property->setAccessible(true);
        $array[$property->getName()] = $property->getValue($object);
        $property->setAccessible(false);
    }
    return $array;
}

function SpanishDate($FechaStamp)
{
   $ano = date('Y',$FechaStamp);
   $mes = date('n',$FechaStamp);
   $dia = date('d',$FechaStamp);
   $diasemana = date('w',$FechaStamp);
   $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
                  "Jueves","Viernes","Sábado");
   $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   return "$dia de ". $mesesN[$mes] ." de $ano";
}  
function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function createListAddToUser($lugarMapper, $usuario_lugarMapper, $uid, $name){
	$random =generateRandomString();
	$lugar = $lugarMapper->build([
			'nombre' => $name,
			'usuarioid' => $uid,
			'llave' => $random,
			'activo' => TRUE
			]);
	$lugarMapper->insert($lugar);
	$usuario_lugar = $usuario_lugarMapper->build([
		'usuarioid' => $uid,
		'lugarid' => $lugar->id
	]);
	$usuario_lugarMapper->insert($usuario_lugar);
}
?>