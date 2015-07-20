<?php

class producto{				
	private $id;
	private $nombre;
	private $imagen;
	private $marcaImagen;
	private $marcaNombre;
	private $marcaId;
	private $cantidad;
	private $ultimaFecha;
	private $ultimaCantidad;
	
	public function __get($name) {
		return $this->$name;
	}
	public function __set($name, $value){
		return $this->$name = $value;
	}
}
?>