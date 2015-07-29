<?php
namespace Entity;
class Usuario_Categoria extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Usuario_Categoria';

    protected static $table = 'usuarios_categorias';
    public static function fields()
    {
        return [
            'id'			=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'usuarioid'  	=> ['type' => 'integer', 'required' => true],
            'categoriaid'  	=> ['type' => 'integer', 'required' => true]
        ];
    }
}
?>