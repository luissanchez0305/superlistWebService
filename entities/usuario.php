<?php
namespace Entity;
class Usuario extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Usuario';

    protected static $table = 'usuario';
    public static function fields()
    {
        return [
            'id'			=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'email'  	=> ['type' => 'string', 'required' => true],
            'nombre' 		=> ['type' => 'string', 'required' => false],
            'apellido'  	=> ['type' => 'string', 'required' => false],
            'password'  	=> ['type' => 'string', 'required' => true]
        ];
    }
}
?>