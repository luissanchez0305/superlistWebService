<?php
	
class marca{			
	private $id;
	private $nombre;
	
	public function __get($name) {
		return $this->$name;
	}
	public function __set($name, $value){
		return $this->$name = $value;
	}
}
?>