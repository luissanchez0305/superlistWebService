<?php
namespace Entity;
class Usuario_Lista extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Usuario_Lista';

    protected static $table = 'usuarios_listas';
    public static function fields()
    {
        return [
            'id'		=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'usuarioid'	=> ['type' => 'integer', 'required' => true],
            'listaid'  	=> ['type' => 'integer', 'required' => true]
        ];
    }
}
?>