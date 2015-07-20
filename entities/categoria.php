<?php
namespace Entity;
class Categoria extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Categoria';

    protected static $table = 'categorias';
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