<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Usuario extends Mapper
{
    /**
     * Get Producto by Categoria
     *
     * @return \Sector\Query
     */
    public function getByEmail($email)
    {
        return $this->where(['email' => $email])->first();
    }	
}
?>