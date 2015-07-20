<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Producto extends Mapper
{
    /**
     * Get Producto by Categoria
     *
     * @return \Sector\Query
     */
    public function getByCategoria($id)
    {
        return $this->where(['categoriaId' => $id]);
    }	
}
?>