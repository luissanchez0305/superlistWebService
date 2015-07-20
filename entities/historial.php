<?php
namespace Entity;
class Historial extends \Spot\Entity
{
    protected static $mapper = 'Entity\Mapper\Historial';

    protected static $table = 'historial';
    public static function fields()
    {
        return [
            'id'			=> ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'lugarid'  		=> ['type' => 'integer', 'required' => true],
            'productoid'	=> ['type' => 'integer', 'required' => true],
            'cantidad'  	=> ['type' => 'integer', 'required' => true],
            'fecha'       	=> ['type' => 'datetime', 'required' => true, 'default' => new \DateTime()]
        ];
    }
}
?>