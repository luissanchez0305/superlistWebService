<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Historial extends Mapper
{
 
 	/**
     * Get Historial by Lugar and Producto
     *
     * @return \Sector\Historial
     */
    public function getByProductoAndLugar($productoid, $lugarid)
    {
        return $this->where(['productoid' => $productoid])->andWhere(['lugarid' => $lugarid])->order(['fecha' => 'DESC'])->first();
    }	
}
?>