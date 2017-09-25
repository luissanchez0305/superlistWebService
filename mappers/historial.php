<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Historial extends Mapper
{
 
 	/**
     * Get Historial by Lista and Producto
     *
     * @return \Sector\Historial
     */
    public function getByProductoAndLista($productoid, $listaid)
    {
        return $this->where(['productoid' => $productoid])->andWhere(['listaid' => $listaid])->order(['fecha' => 'DESC'])->first();
    }	
}
?>