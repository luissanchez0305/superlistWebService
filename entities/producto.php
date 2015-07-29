<?php
namespace Entity;
class Producto extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Producto';

    protected static $table = 'productos';
    public static function fields()
    {
        return [
            'id'			=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'marcaid'  		=> ['type' => 'integer', 'required' => false],
            'categoriaid' 	=> ['type' => 'integer', 'required' => true],
            'nombre'  		=> ['type' => 'string', 'required' => true],
            'imagen'  		=> ['type' => 'string', 'required' => false]
        ];
    }
}
?>