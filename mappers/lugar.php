<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Lista extends Mapper
{
    /**
     * Get Lista by Key
     *
     * @return \Sector\Query
     */
    public function getBykey($key)
    {
        return $this->where(['llave' => strtoupper($key)]);
    }	
}
?>