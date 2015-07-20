<?php
namespace Entity;
class Marca extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Marca';

    protected static $table = 'marcas';
    public static function fields()
    {
        return [
            'id'		=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'nombre'  	=> ['type' => 'string', 'required' => true],
            'imagen'  	=> ['type' => 'string', 'required' => false]
        ];
    }
}
?>