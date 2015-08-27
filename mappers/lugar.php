<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Lugar extends Mapper
{
    /**
     * Get Lugar by Key
     *
     * @return \Sector\Query
     */
    public function getBykey($key)
    {
        return $this->where(['llave' => strtoupper($key)]);
    }	
}
?>