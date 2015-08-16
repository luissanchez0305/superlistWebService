<?php
namespace Entity;
class Usuario_Lugar extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Usuario_Lugar';

    protected static $table = 'usuarios_lugares';
    public static function fields()
    {
        return [
            'id'		=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'usuarioid'	=> ['type' => 'integer', 'required' => true],
            'lugarid'  	=> ['type' => 'integer', 'required' => true]
        ];
    }
}
?>