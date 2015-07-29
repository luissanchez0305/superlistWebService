<?php
class categoria{			
	private $id;
	private $nombre;
	private $usuarioid;
	
	public function __get($name) {
		return $this->$name;
	}
	public function __set($name, $value){
		return $this->$name = $value;
	}
}
?>