<?php
namespace Entity;
class Producto_Lista extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Producto_Lista';

    protected static $table = 'productos_listas';
    public static function fields()
    {
        return [
            'id'			=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'productoid'  	=> ['type' => 'integer', 'required' => true],
            'listaid' 		=> ['type' => 'integer', 'required' => true],
            'cantidad'  	=> ['type' => 'integer', 'required' => true]
        ];
    }
}
?>