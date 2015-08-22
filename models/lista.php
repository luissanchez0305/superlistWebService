<?php

class lista{			
	private $id;
	private $nombre;
	private $activa;
	
	public function __get($name) {
		return $this->$name;
	}
	public function __set($name, $value){
		return $this->$name = $value;
	}
}
?>