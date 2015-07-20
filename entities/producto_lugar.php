<?php
namespace Entity;
class Producto_Lugar extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Producto_Lugar';

    protected static $table = 'productos_lugares';
    public static function fields()
    {
        return [
            'id'			=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'productoid'  	=> ['type' => 'integer', 'required' => true],
            'lugarid' 		=> ['type' => 'integer', 'required' => true],
            'cantidad'  	=> ['type' => 'integer', 'required' => true]
        ];
    }
}
?>