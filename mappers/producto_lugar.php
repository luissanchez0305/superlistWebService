<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Producto_Lugar extends Mapper
{
    /**
     * Get Producto by Lugar and Producto
     *
     * @return \Sector\Producto_Lugar
     */
    public function getByProductoAndLugar($productoid, $lugarid)
    {
        return $this->where(['productoid' => $productoid])->andWhere(['lugarid' => $lugarid])->first();
    }	
	
    /**
     * Get Producto by Lugar
     *
     * @return \Sector\Query
     */
    public function getByLugar($lugarid)
    {
        return $this->where(['lugarid' => $lugarid]);
    }	
}
?>