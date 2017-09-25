<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Producto_Lista extends Mapper
{
    /**
     * Get Producto by Lista and Producto
     *
     * @return \Sector\Producto_Lista
     */
    public function getByProductoAndLista($productoid, $listaid)
    {
        return $this->where(['productoid' => $productoid])->andWhere(['listaid' => $listaid])->first();
    }	
	
    /**
     * Get Producto by Lista
     *
     * @return \Sector\Query
     */
    public function getByLista($listaid)
    {
        return $this->where(['listaid' => $listaid]);
    }	
}
?>