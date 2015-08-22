<?php
namespace Entity;
class Lugar extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Lugar';

    protected static $table = 'lugares';
    public static function fields()
    {
        return [
            'id'		=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'nombre'  	=> ['type' => 'string', 'required' => true],
            'usuarioid' => ['type' => 'integer', 'required' => true],
            'activo'  	=> ['type' => 'boolean', 'required' => true],
            'llave'		=> ['type' => 'string', 'required' => true]
        ];
    }
}
?>